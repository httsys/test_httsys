<?php

namespace App\Http\Controllers;

use App\Models\Fund;
use App\Models\Language;
use App\Models\Photo;
use Illuminate\Http\Request;

class FundController extends Controller
{
    public function index(Request $request)
    {
        $langs = Language::all();
        $lang = Language::where('code', $request->language)->first() ?? $langs->first();
        $lang_id = $lang->id;

        $funds = Fund::where('language_id', $lang_id)->orderBy('sort_order')->orderBy('id', 'desc')->paginate(20);

        return view('donations.funds.index', compact('funds', 'langs', 'lang_id'));
    }

    public function create(Request $request)
    {
        return redirect()->route('funds.index');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'language_id' => 'required',
            'title' => 'required|string|max:191',
            'short_description' => 'nullable|string|max:191',
            'description' => 'nullable|string',
            'target_amount' => 'nullable|numeric|min:0',
            'photo_id' => 'nullable|mimes:jpg,jpeg,png,webp,gif,svg',
        ]);

        $input = $request->except('photo_id');
        $input['slug'] = $this->uniqueSlug($request->title);
        $input['is_active'] = $request->boolean('is_active');

        if ($file = $request->file('photo_id')) {
            $name = time() . $file->getClientOriginalName();
            $file->move('images/media/', $name);
            $photo = Photo::create(['file' => $name]);
            $input['photo_id'] = $photo->id;
        }

        Fund::create($input);

        return back()->with('fund_success', 'Fund created successfully!');
    }

    public function edit(Fund $fund)
    {
        return view('donations.funds.edit', compact('fund'));
    }

    public function update(Request $request, Fund $fund)
    {
        $this->validate($request, [
            'title' => 'required|string|max:191',
            'short_description' => 'nullable|string|max:191',
            'description' => 'nullable|string',
            'target_amount' => 'nullable|numeric|min:0',
            'photo_id' => 'nullable|mimes:jpg,jpeg,png,webp,gif,svg',
        ]);

        $input = $request->except('photo_id');
        $input['is_active'] = $request->boolean('is_active');

        if ($fund->title !== $request->title) {
            $input['slug'] = $this->uniqueSlug($request->title, $fund->id);
        }

        if ($file = $request->file('photo_id')) {
            $name = time() . $file->getClientOriginalName();
            $file->move('images/media/', $name);
            $photo = Photo::create(['file' => $name]);
            $input['photo_id'] = $photo->id;
        }

        $fund->update($input);

        return redirect()->route('funds.index')->with('fund_success', 'Fund updated successfully!');
    }

    public function destroy(Fund $fund)
    {
        $fund->delete();

        return back()->with('fund_success', 'Fund deleted successfully!');
    }

    protected function uniqueSlug($title, $ignoreId = null)
    {
        $base = $this->slugify($title) ?: 'fund';
        $slug = $base;
        $i = 1;

        while (Fund::where('slug', $slug)->when($ignoreId, function ($q) use ($ignoreId) {
            $q->where('id', '!=', $ignoreId);
        })->exists()) {
            $slug = $base . '-' . $i++;
        }

        return $slug;
    }

    protected function slugify($string)
    {
        $string = trim($string);
        $string = preg_replace('/\s+/u', '-', $string);
        $string = preg_replace('/[^\p{L}\p{N}\-]+/u', '', $string);
        $string = preg_replace('/-+/', '-', $string);

        return trim($string, '-');
    }
}
