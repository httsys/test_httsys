<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Photo;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::orderBy('name')->paginate(20);

        return view('shop.brands.index', compact('brands'));
    }

    public function create()
    {
        return redirect()->route('brands.index');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:191',
            'photo_id' => 'nullable|mimes:jpg,jpeg,png,webp,gif,svg',
        ]);

        $input = $request->except('photo_id');

        if ($file = $request->file('photo_id')) {
            $name = time() . $file->getClientOriginalName();
            $file->move('images/media/', $name);
            $photo = Photo::create(['file' => $name]);
            $input['photo_id'] = $photo->id;
        }

        Brand::create($input);

        return back()->with('brand_success', 'Brand created successfully!');
    }

    public function edit(Brand $brand)
    {
        return view('shop.brands.edit', compact('brand'));
    }

    public function update(Request $request, Brand $brand)
    {
        $this->validate($request, [
            'name' => 'required|string|max:191',
            'photo_id' => 'nullable|mimes:jpg,jpeg,png,webp,gif,svg',
        ]);

        $input = $request->except('photo_id');

        if ($file = $request->file('photo_id')) {
            $name = time() . $file->getClientOriginalName();
            $file->move('images/media/', $name);
            $photo = Photo::create(['file' => $name]);
            $input['photo_id'] = $photo->id;
        }

        $brand->update($input);

        return redirect()->route('brands.index')->with('brand_success', 'Brand updated successfully!');
    }

    public function destroy(Brand $brand)
    {
        $brand->delete();

        return back()->with('brand_success', 'Brand deleted successfully!');
    }
}
