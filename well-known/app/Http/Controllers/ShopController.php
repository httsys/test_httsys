<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\HeaderFooterSetting;
use App\Models\Language;
use App\Models\Menu;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        if (session()->has('lang')) {
            $currentLang = Language::where('code', session()->get('lang'))->first();
        } else {
            $currentLang = Language::where('is_default', 1)->first();
        }
        $lang_id = $currentLang->id;
        $langs = Language::all();
        $headerfooter = HeaderFooterSetting::find($lang_id);
        $menus = Menu::where('language_id', $lang_id)->get();

        $query = Product::where('language_id', $lang_id)->where('is_active', 1);

        if ($request->filled('category')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        if ($request->filled('brand')) {
            $brandSlugs = (array) $request->brand;
            $query->whereHas('brand', function ($q) use ($brandSlugs) {
                $q->whereIn('id', $brandSlugs);
            });
        }

        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        switch ($request->get('sort')) {
            case 'price_low':
                $query->orderBy('price', 'asc');
                break;
            case 'price_high':
                $query->orderBy('price', 'desc');
                break;
            case 'newest':
            default:
                $query->orderBy('id', 'desc');
                break;
        }

        $products = $query->paginate(12)->withQueryString();

        $categories = ProductCategory::where('language_id', $lang_id)->orderBy('name')->get();
        $brands = Brand::orderBy('name')->get();
        $priceMax = Product::where('language_id', $lang_id)->where('is_active', 1)->max('price') ?: 100;

        return view('shop.index', compact('products', 'categories', 'brands', 'priceMax', 'currentLang', 'langs', 'headerfooter', 'menus'));
    }

    public function show($slug)
    {
        if (session()->has('lang')) {
            $currentLang = Language::where('code', session()->get('lang'))->first();
        } else {
            $currentLang = Language::where('is_default', 1)->first();
        }
        $lang_id = $currentLang->id;
        $langs = Language::all();
        $headerfooter = HeaderFooterSetting::find($lang_id);
        $menus = Menu::where('language_id', $lang_id)->get();

        $product = Product::with(['variantGroups.options', 'reviews.user'])
            ->where('slug', $slug)
            ->where('language_id', $lang_id)
            ->where('is_active', 1)
            ->firstOrFail();

        $related = Product::where('language_id', $lang_id)
            ->where('is_active', 1)
            ->where('product_category_id', $product->product_category_id)
            ->where('id', '!=', $product->id)
            ->limit(4)
            ->get();

        $userReview = null;
        if (Auth::check()) {
            $userReview = $product->reviews->firstWhere('user_id', Auth::id());
        }

        return view('shop.show', compact('product', 'related', 'currentLang', 'langs', 'headerfooter', 'menus', 'userReview'));
    }

    /**
     * Store or update the logged-in user's review for a product. One
     * review per user per product — re-submitting updates the existing one.
     */
    public function storeReview(Request $request, $slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();

        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:2000',
        ]);

        ProductReview::updateOrCreate(
            ['product_id' => $product->id, 'user_id' => Auth::id()],
            ['rating' => $request->rating, 'comment' => $request->comment]
        );

        // Laravel 8 doesn't have withFragment(); the Reviews tab is
        // reopened client-side instead when this flash is present.
        return back()->with('review_success', 'ধন্যবাদ! আপনার রিভিউ যুক্ত করা হয়েছে।');
    }
}
