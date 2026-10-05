<?php

namespace App\Http\Controllers;

use App\Models\Language;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    public function index(Request $request)
    {
        $langs = Language::all();
        $lang = Language::where('code', $request->language)->first() ?? $langs->first();
        $lang_id = $lang->id;

        $categories = ProductCategory::where('language_id', $lang_id)->orderBy('id', 'desc')->paginate(20);

        return view('shop.categories.index', compact('categories', 'langs', 'lang_id'));
    }

    public function create(Request $request)
    {
        return redirect()->route('product-categories.index');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:191',
            'language_id' => 'required',
        ]);

        $input = $request->all();
        $input['slug'] = $this->uniqueSlug($request->name);

        ProductCategory::create($input);

        return back()->with('category_success', 'Category created successfully!');
    }

    public function edit(ProductCategory $category)
    {
        return view('shop.categories.edit', compact('category'));
    }

    public function update(Request $request, ProductCategory $category)
    {
        $this->validate($request, [
            'name' => 'required|string|max:191',
        ]);

        $input = $request->all();

        if ($category->name !== $request->name) {
            $input['slug'] = $this->uniqueSlug($request->name, $category->id);
        }

        $category->update($input);

        return redirect()->route('product-categories.index')->with('category_success', 'Category updated successfully!');
    }

    public function destroy(ProductCategory $category)
    {
        $category->delete();

        return back()->with('category_success', 'Category deleted successfully!');
    }

    protected function uniqueSlug($name, $ignoreId = null)
    {
        $base = $this->slugify($name) ?: 'category';
        $slug = $base;
        $i = 1;

        while (ProductCategory::where('slug', $slug)->when($ignoreId, function ($q) use ($ignoreId) {
            $q->where('id', '!=', $ignoreId);
        })->exists()) {
            $slug = $base . '-' . $i++;
        }

        return $slug;
    }

    /**
     * Unicode-aware slugify (spaces -> hyphens, strip unsafe chars) that
     * keeps non-Latin scripts like Bangla intact — Str::slug()'s default
     * ASCII-only transliteration would blank them out entirely. Matches
     * the same approach used for post slugs in PostController.
     */
    protected function slugify($string)
    {
        $string = trim($string);
        $string = preg_replace('/\s+/u', '-', $string);
        $string = preg_replace('/[^\p{L}\p{N}\-]+/u', '', $string);
        $string = preg_replace('/-+/', '-', $string);

        return trim($string, '-');
    }
}
