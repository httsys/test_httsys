<?php

namespace App\Http\Controllers;

use App\Models\PickupLocation;
use Illuminate\Http\Request;

class PickupLocationController extends Controller
{
    public function index()
    {
        $locations = PickupLocation::orderBy('sort_order')->orderBy('id', 'desc')->get();

        return view('admin.pickup-locations.index', compact('locations'));
    }

    public function create()
    {
        return redirect()->route('pickup-locations.index');
    }

    public function store(Request $request)
    {
        $this->validateLocation($request);

        PickupLocation::create($request->only([
            'name', 'address_line', 'city', 'state', 'country', 'postal_code', 'phone', 'sort_order',
        ]) + ['is_active' => $request->boolean('is_active')]);

        return back()->with('pickup_location_success', 'Pickup location created successfully!');
    }

    public function edit(PickupLocation $pickupLocation)
    {
        return view('admin.pickup-locations.edit', compact('pickupLocation'));
    }

    public function update(Request $request, PickupLocation $pickupLocation)
    {
        $this->validateLocation($request);

        $pickupLocation->update($request->only([
            'name', 'address_line', 'city', 'state', 'country', 'postal_code', 'phone', 'sort_order',
        ]) + ['is_active' => $request->boolean('is_active')]);

        return redirect()->route('pickup-locations.index')->with('pickup_location_success', 'Pickup location updated successfully!');
    }

    public function destroy(PickupLocation $pickupLocation)
    {
        $pickupLocation->delete();

        return back()->with('pickup_location_success', 'Pickup location deleted successfully!');
    }

    protected function validateLocation(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:191',
            'address_line' => 'required|string|max:255',
            'city' => 'required|string|max:191',
            'state' => 'nullable|string|max:191',
            'country' => 'required|string|max:191',
            'postal_code' => 'nullable|string|max:30',
            'phone' => 'nullable|string|max:30',
            'sort_order' => 'nullable|integer',
        ]);
    }
}
