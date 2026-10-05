@php
    $type = old('type', $method->type ?? 'manual');
    $cfg = $method->config ?? [];
@endphp

<form action="{{ $action }}" method="POST">
    @csrf
    @if ($method) @method('PUT') @endif

    <div class="form-group">
        <strong>Name shown to donors</strong>
        <input type="text" name="name" class="form-control" value="{{ old('name', $method->name ?? '') }}" required placeholder="e.g. bKash, Bank Transfer, Rocket">
    </div>

    <div class="form-group">
        <strong>Type</strong>
        <select name="type" id="paymentTypeSelect" class="form-control" required>
            <option value="manual" {{ $type == 'manual' ? 'selected' : '' }}>Manual (bank transfer, personal number, cash, etc.)</option>
            <option value="sslcommerz" {{ $type == 'sslcommerz' ? 'selected' : '' }}>SSLCommerz (automatic gateway)</option>
            <option value="bkash" {{ $type == 'bkash' ? 'selected' : '' }}>bKash (automatic gateway)</option>
            <option value="nagad" {{ $type == 'nagad' ? 'selected' : '' }}>Nagad (automatic gateway)</option>
        </select>
    </div>

    <div class="payment-fields" data-type="manual" style="{{ $type == 'manual' ? '' : 'display:none;' }}">
        <div class="form-group">
            <strong>Number / Account to pay to</strong>
            <input type="text" name="config_account_number" class="form-control" value="{{ old('config_account_number', $cfg['account_number'] ?? '') }}" placeholder="e.g. 01876101515">
            <small class="text-muted">Shown to the donor on its own with a copy button.</small>
        </div>
        <div class="form-group">
            <strong>Account Name (optional)</strong>
            <input type="text" name="config_account_name" class="form-control" value="{{ old('config_account_name', $cfg['account_name'] ?? '') }}" placeholder="e.g. Sadakah Fund">
        </div>
        <div class="form-group">
            <strong>Additional instructions shown to the donor</strong>
            <textarea name="instructions" class="form-control" rows="3" placeholder="e.g. Send money using 'Send Money', not 'Payment', then paste the Trx ID below.">{{ old('instructions', $method->instructions ?? '') }}</textarea>
        </div>
    </div>

    <div class="payment-fields" data-type="sslcommerz" style="{{ $type == 'sslcommerz' ? '' : 'display:none;' }}">
        <div class="form-group">
            <strong>Store ID</strong>
            <input type="text" name="config_store_id" class="form-control" value="{{ old('config_store_id', $cfg['store_id'] ?? '') }}">
        </div>
        <div class="form-group">
            <strong>Store Password</strong>
            <input type="text" name="config_store_password" class="form-control" value="{{ old('config_store_password', $cfg['store_password'] ?? '') }}" placeholder="{{ $method ? 'Leave blank to keep current' : '' }}">
        </div>
        <div class="form-group">
            <label><input type="checkbox" name="config_sandbox" value="1" {{ old('config_sandbox', $cfg['sandbox'] ?? true) ? 'checked' : '' }}> Use sandbox (test mode)</label>
        </div>
    </div>

    <div class="payment-fields" data-type="bkash" style="{{ $type == 'bkash' ? '' : 'display:none;' }}">
        <div class="form-group">
            <strong>App Key</strong>
            <input type="text" name="config_app_key" class="form-control" value="{{ old('config_app_key', $cfg['app_key'] ?? '') }}">
        </div>
        <div class="form-group">
            <strong>App Secret</strong>
            <input type="text" name="config_app_secret" class="form-control" value="{{ old('config_app_secret', $cfg['app_secret'] ?? '') }}" placeholder="{{ $method ? 'Leave blank to keep current' : '' }}">
        </div>
        <div class="form-group">
            <strong>Username</strong>
            <input type="text" name="config_username" class="form-control" value="{{ old('config_username', $cfg['username'] ?? '') }}">
        </div>
        <div class="form-group">
            <strong>Password</strong>
            <input type="text" name="config_password" class="form-control" value="{{ old('config_password', $cfg['password'] ?? '') }}" placeholder="{{ $method ? 'Leave blank to keep current' : '' }}">
        </div>
        <div class="form-group">
            <label><input type="checkbox" name="config_sandbox" value="1" {{ old('config_sandbox', $cfg['sandbox'] ?? true) ? 'checked' : '' }}> Use sandbox (test mode)</label>
        </div>
    </div>

    <div class="payment-fields" data-type="nagad" style="{{ $type == 'nagad' ? '' : 'display:none;' }}">
        <p class="small text-muted">Nagad's checkout requires an additional RSA key-signing step that still needs development — see the handoff notes. You can save credentials here now and it can be finished later.</p>
        <div class="form-group">
            <strong>Merchant ID</strong>
            <input type="text" name="config_merchant_id" class="form-control" value="{{ old('config_merchant_id', $cfg['merchant_id'] ?? '') }}">
        </div>
        <div class="form-group">
            <strong>Merchant Number</strong>
            <input type="text" name="config_merchant_number" class="form-control" value="{{ old('config_merchant_number', $cfg['merchant_number'] ?? '') }}">
        </div>
        <div class="form-group">
            <strong>Public Key</strong>
            <textarea name="config_public_key" class="form-control" rows="2">{{ old('config_public_key', $cfg['public_key'] ?? '') }}</textarea>
        </div>
        <div class="form-group">
            <strong>Private Key</strong>
            <textarea name="config_private_key" class="form-control" rows="2">{{ old('config_private_key', $cfg['private_key'] ?? '') }}</textarea>
        </div>
        <div class="form-group">
            <label><input type="checkbox" name="config_sandbox" value="1" {{ old('config_sandbox', $cfg['sandbox'] ?? true) ? 'checked' : '' }}> Use sandbox (test mode)</label>
        </div>
    </div>

    <div class="form-group">
        <strong>Sort Order</strong>
        <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', $method->sort_order ?? 0) }}" style="max-width: 120px;">
    </div>

    <div class="form-group">
        <label><input type="checkbox" name="is_active" value="1" {{ old('is_active', $method->is_active ?? true) ? 'checked' : '' }}> Active (shown to donors)</label>
    </div>

    <div class="text-right">
        @if ($method)
            <a href="{{ route('payment-methods.index') }}" class="btn btn-secondary">Cancel</a>
        @endif
        <button type="submit" class="btn btn-primary">{{ $submitLabel }}</button>
    </div>
</form>

<script>
(function () {
    var select = document.getElementById('paymentTypeSelect');
    if (!select) return;
    select.addEventListener('change', function () {
        document.querySelectorAll('.payment-fields').forEach(function (el) {
            el.style.display = (el.dataset.type === select.value) ? '' : 'none';
        });
    });
})();
</script>
