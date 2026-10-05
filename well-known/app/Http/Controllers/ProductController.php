<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Language;
use App\Models\Photo;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $langs = Language::all();
        $lang = Language::where('code', $request->language)->first() ?? $langs->first();
        $lang_id = $lang->id;

        $products = Product::with(['category', 'brand'])
            ->where('language_id', $lang_id)
            ->orderBy('id', 'desc')
            ->paginate(15);

        return view('shop.products.index', compact('products', 'langs', 'lang_id'));
    }

    public function create(Request $request)
    {
        $langs = Language::all();
        $lang = Language::where('code', $request->language)->first() ?? $langs->first();
        $lang_id = $lang->id;

        $categories = ProductCategory::where('language_id', $lang_id)->get();
        $brands = Brand::orderBy('name')->get();

        return view('shop.products.create', compact('langs', 'lang_id', 'categories', 'brands'));
    }

    public function store(Request $request)
    {
        $this->validateProduct($request);

        $input = $request->except(['photo_id', 'digital_file_id', 'variant_groups']);
        $user = Auth::user();

        $input['slug'] = $this->uniqueSlug($request->title);
        $input['is_flash_sale'] = $request->has('is_flash_sale');
        $input['is_active'] = $request->has('is_active');
        $input['user_id'] = $user->id;
        $input['sku'] = $request->filled('sku') ? trim($request->sku) : null;
        $input['tax_rate'] = $request->filled('tax_rate') ? $request->tax_rate : null;

        if ($file = $request->file('photo_id')) {
            $input['photo_id'] = $this->storeUpload($file);
        }

        if ($request->type === 'digital' && $file = $request->file('digital_file_id')) {
            $input['digital_file_id'] = $this->storeUpload($file);
        }

        $product = Product::create($input);

        $this->syncVariantGroups($product, $request);

        return back()->with('product_success', 'Product created successfully!');
    }

    public function edit(Product $product)
    {
        $categories = ProductCategory::where('language_id', $product->language_id)->get();
        $brands = Brand::orderBy('name')->get();
        $product->load('variantGroups.options');

        return view('shop.products.edit', compact('product', 'categories', 'brands'));
    }

    public function update(Request $request, Product $product)
    {
        $this->validateProduct($request, $product->id);

        $input = $request->except(['photo_id', 'digital_file_id', 'variant_groups']);

        if ($product->title !== $request->title) {
            $input['slug'] = $this->uniqueSlug($request->title, $product->id);
        }

        $input['is_flash_sale'] = $request->has('is_flash_sale');
        $input['is_active'] = $request->has('is_active');

        $input['sku'] = $request->filled('sku') ? trim($request->sku) : null;
        $input['tax_rate'] = $request->filled('tax_rate') ? $request->tax_rate : null;

        if ($file = $request->file('photo_id')) {
            $input['photo_id'] = $this->storeUpload($file);
        }

        if ($request->type === 'digital' && $file = $request->file('digital_file_id')) {
            $input['digital_file_id'] = $this->storeUpload($file);
        }

        $product->update($input);

        $this->syncVariantGroups($product, $request);

        return redirect()->route('products.index')->with('product_success', 'Product updated successfully!');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return back()->with('product_success', 'Product deleted successfully!');
    }

    protected function validateProduct(Request $request, $ignoreId = null)
    {
        $this->validate($request, [
            'product_category_id' => 'required|exists:product_categories,id',
            'brand_id' => 'nullable|exists:brands,id',
            'title' => 'required|string|max:191',
            'type' => 'required|in:digital,physical',
            'price' => 'required|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0',
            'stock' => 'nullable|integer|min:0',
            'sku' => [
                'nullable', 'string', 'max:64',
                \Illuminate\Validation\Rule::unique('products', 'sku')->ignore($ignoreId),
            ],
            'tax_rate' => 'nullable|numeric|min:0|max:100',
            'photo_id' => 'nullable|mimes:jpg,jpeg,png,webp,gif,svg',
            'digital_file_id' => 'nullable|file|max:512000',
            'digital_link' => 'nullable|string|max:2000',
            'warranty_duration' => 'nullable|integer|min:0',
            'warranty_unit' => 'nullable|in:days,months,years',
            'video_url' => 'nullable|string|max:500',
            'shipping_return_info' => 'nullable|string',
            'variant_groups' => 'nullable|array',
            'variant_groups.*.name' => 'nullable|string|max:191',
            'variant_groups.*.options' => 'nullable|string',
        ]);
    }

    protected function storeUpload($file)
    {
        $name = time() . $file->getClientOriginalName();
        $file->move('images/media/', $name);
        $photo = Photo::create(['file' => $name]);

        return $photo->id;
    }

    protected function uniqueSlug($title, $ignoreId = null)
    {
        $base = $this->slugify($title) ?: 'product';
        $slug = $base;
        $i = 1;

        while (Product::where('slug', $slug)->when($ignoreId, function ($q) use ($ignoreId) {
            $q->where('id', '!=', $ignoreId);
        })->exists()) {
            $slug = $base . '-' . $i++;
        }

        return $slug;
    }

    /**
     * Unicode-aware slugify (spaces -> hyphens, strip unsafe chars) that
     * keeps non-Latin scripts like Bangla intact. Matches the same
     * approach used for post slugs in PostController.
     */
    protected function slugify($string)
    {
        $string = trim($string);
        $string = preg_replace('/\s+/u', '-', $string);
        $string = preg_replace('/[^\p{L}\p{N}\-]+/u', '', $string);
        $string = preg_replace('/-+/', '-', $string);

        return trim($string, '-');
    }

    /**
     * Replace a product's variant groups/options from the admin form.
     *
     * Each group in the `variant_groups[]` array has a `name` (e.g. Color,
     * Ram, Storage, Region/Variant) and an `options` textarea, one option
     * per line, in the format:
     *   Label
     *   Label|#hexcode              (color groups)
     *   Label|#hexcode|extraPrice   (color group with a price add-on)
     *   Label||extraPrice           (non-color group with a price add-on)
     */
    protected function syncVariantGroups(Product $product, Request $request)
    {
        // Deleting the groups also deletes their options (FK cascade).
        $product->variantGroups()->delete();

        if (! $request->has('variant_groups') || ! is_array($request->variant_groups)) {
            return;
        }

        $groupOrder = 0;

        foreach ($request->variant_groups as $groupInput) {
            $name = trim($groupInput['name'] ?? '');
            $optionsRaw = trim($groupInput['options'] ?? '');

            if ($name === '' || $optionsRaw === '') {
                continue;
            }

            $group = $product->variantGroups()->create([
                'name' => $name,
                'sort_order' => $groupOrder++,
            ]);

            $lines = preg_split('/\r\n|\r|\n/', $optionsRaw);
            $optionOrder = 0;

            foreach ($lines as $line) {
                $line = trim($line);

                if ($line === '') {
                    continue;
                }

                $parts = array_map('trim', explode('|', $line));

                $group->options()->create([
                    'value' => $parts[0],
                    'color_code' => (isset($parts[1]) && $parts[1] !== '') ? $parts[1] : null,
                    'price_modifier' => (isset($parts[2]) && is_numeric($parts[2])) ? $parts[2] : 0,
                    'sort_order' => $optionOrder++,
                ]);
            }
        }
    }
}
