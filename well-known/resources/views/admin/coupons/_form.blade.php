<form action="{{ $action }}" method="POST">
    @csrf
    @if($coupon) @method('PUT') @endif

    <div class="form-group">
        <label>Coupon Code</label>
        <input type="text" name="code" class="form-control text-uppercase" required maxlength="50" value="{{ old('code', $coupon->code ?? '') }}" placeholder="e.g. EID50">
    </div>
    <div class="form-group">
        <label>Discount Type</label>
        <select name="type" class="form-control">
            <option value="fixed" {{ old('type', $coupon->type ?? '') == 'fixed' ? 'selected' : '' }}>Fixed amount off</option>
            <option value="percent" {{ old('type', $coupon->type ?? '') == 'percent' ? 'selected' : '' }}>Percent off</option>
        </select>
    </div>
    <div class="form-group">
        <label>Value</label>
        <input type="number" step="0.01" name="value" class="form-control" required value="{{ old('value', $coupon->value ?? '') }}" placeholder="Fixed: e.g. 100 — Percent: e.g. 10">
    </div>
    <div class="form-group">
        <label>Max Discount (only applies to percent coupons, optional)</label>
        <input type="number" step="0.01" name="max_discount" class="form-control" value="{{ old('max_discount', $coupon->max_discount ?? '') }}">
    </div>
    <div class="form-group">
        <label>Minimum Cart Subtotal (optional)</label>
        <input type="number" step="0.01" name="min_subtotal" class="form-control" value="{{ old('min_subtotal', $coupon->min_subtotal ?? '') }}">
    </div>
    <div class="form-group">
        <label>Usage Limit (optional — leave blank for unlimited)</label>
        <input type="number" name="usage_limit" class="form-control" value="{{ old('usage_limit', $coupon->usage_limit ?? '') }}">
    </div>
    <div class="form-group">
        <label>Expires At (optional)</label>
        <input type="date" name="expires_at" class="form-control" value="{{ old('expires_at', isset($coupon->expires_at) ? $coupon->expires_at->format('Y-m-d') : '') }}">
    </div>
    <div class="form-group form-check">
        <input type="checkbox" name="is_active" class="form-check-input" id="coupon_active" value="1" {{ old('is_active', $coupon->is_active ?? true) ? 'checked' : '' }}>
        <label class="form-check-label" for="coupon_active">Active</label>
    </div>

    <button type="submit" class="btn btn-primary">{{ $submitLabel }}</button>
</form>
