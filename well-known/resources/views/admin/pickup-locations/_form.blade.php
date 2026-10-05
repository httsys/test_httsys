<form action="{{ $action }}" method="POST">
    @csrf
    @if($location) @method('PUT') @endif

    <div class="form-group">
        <label>Name</label>
        <input type="text" name="name" class="form-control" required value="{{ old('name', $location->name ?? '') }}" placeholder="e.g. Dhanmondi 27">
    </div>
    <div class="form-group">
        <label>Address (House/Road/Block)</label>
        <input type="text" name="address_line" class="form-control" required value="{{ old('address_line', $location->address_line ?? '') }}">
    </div>
    <div class="form-group">
        <label>City</label>
        <input type="text" name="city" class="form-control" required value="{{ old('city', $location->city ?? '') }}">
    </div>
    <div class="form-group">
        <label>State / Division</label>
        <input type="text" name="state" class="form-control" value="{{ old('state', $location->state ?? '') }}">
    </div>
    <div class="form-group">
        <label>Country</label>
        <input type="text" name="country" class="form-control" required value="{{ old('country', $location->country ?? 'Bangladesh') }}">
    </div>
    <div class="form-group">
        <label>Postal Code</label>
        <input type="text" name="postal_code" class="form-control" value="{{ old('postal_code', $location->postal_code ?? '') }}">
    </div>
    <div class="form-group">
        <label>Phone (optional)</label>
        <input type="text" name="phone" class="form-control" value="{{ old('phone', $location->phone ?? '') }}">
    </div>
    <div class="form-group">
        <label>Sort Order</label>
        <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', $location->sort_order ?? 0) }}">
    </div>
    <div class="form-group form-check">
        <input type="checkbox" name="is_active" class="form-check-input" id="loc_active" value="1" {{ old('is_active', $location->is_active ?? true) ? 'checked' : '' }}>
        <label class="form-check-label" for="loc_active">Active (visible at checkout)</label>
    </div>

    <button type="submit" class="btn btn-primary">{{ $submitLabel }}</button>
</form>
