<form action="{{ $action }}" method="POST">
    @csrf
    @if($ad) @method('PUT') @endif

    <div class="form-row">
        <div class="form-group col-md-4">
            <label for="ad_title">Title <span class="text-danger">*</span></label>
            <input type="text" id="ad_title" name="title" class="form-control" required maxlength="191" placeholder="Title" value="{{ old('title', $ad->title ?? '') }}">
        </div>

        <div class="form-group col-md-4">
            <label for="ad_duration">Duration <span class="text-danger">*</span></label>
            <div class="input-group">
                <input type="number" id="ad_duration" name="duration" class="form-control" required min="5" max="600" placeholder="Duration" value="{{ old('duration', $ad->duration ?? 30) }}">
                <div class="input-group-append"><span class="input-group-text">SECONDS</span></div>
            </div>
            <small class="form-text text-muted">The countdown the player must wait after the ad has loaded (30 = 30 seconds).</small>
        </div>

        <div class="form-group col-md-4">
            <label for="ad_max_show">Maximum Show <span class="text-danger">*</span></label>
            <div class="input-group">
                <input type="number" id="ad_max_show" name="max_show" class="form-control" required min="0" placeholder="Maximum Show" value="{{ old('max_show', $ad->max_show ?? 0) }}">
                <div class="input-group-append"><span class="input-group-text">Times</span></div>
            </div>
            <small class="form-text text-muted">The ad stops being shown after this many plays. <strong>0 = unlimited.</strong></small>
        </div>
    </div>

    <hr>

    @php $type = old('ad_type', $ad->ad_type ?? 'link'); @endphp

    <div class="form-row">
        <div class="form-group col-md-4">
            <label for="ad_type">Advertisement Type <span class="text-danger">*</span></label>
            <select id="ad_type" name="ad_type" class="form-control">
                @foreach(\App\Models\GameAd::$types as $value => $label)
                    <option value="{{ $value }}" {{ $type === $value ? 'selected' : '' }}>{{ $label }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group col-md-8" id="wrap_link">
            <label for="ad_link" id="label_link">Link</label>
            <input type="url" id="ad_link" name="link" class="form-control" maxlength="2000" placeholder="http://example.com" value="{{ old('link', $ad->link ?? '') }}">
            <small class="form-text text-muted" id="help_link"></small>
        </div>
    </div>

    <div class="form-group" id="wrap_image" style="display:none;">
        <label for="ad_image_url">Image URL <span class="text-danger">*</span></label>
        <input type="url" id="ad_image_url" name="image_url" class="form-control" maxlength="2000" placeholder="https://example.com/banner.jpg" value="{{ old('image_url', $ad->image_url ?? '') }}">
        <small class="form-text text-muted">Direct link to the banner image. The optional Link above opens when the player clicks the image.</small>
    </div>

    <div class="form-group" id="wrap_code" style="display:none;">
        <label for="ad_code">HTML / Script Code <span class="text-danger">*</span></label>
        <textarea id="ad_code" name="code" rows="6" class="form-control" placeholder="Paste the ad code here">{{ old('code', $ad->code ?? '') }}</textarea>
    </div>

    <div class="form-group form-check">
        <input type="checkbox" name="is_active" class="form-check-input" id="ad_active" value="1" {{ old('is_active', $ad->is_active ?? true) ? 'checked' : '' }}>
        <label class="form-check-label" for="ad_active">Active</label>
    </div>

    <div class="text-right">
        <button type="submit" class="btn btn-primary px-4">{{ $submitLabel }}</button>
    </div>
</form>

<script>
    (function () {
        var typeEl = document.getElementById('ad_type');
        var wrapLink = document.getElementById('wrap_link');
        var wrapImage = document.getElementById('wrap_image');
        var wrapCode = document.getElementById('wrap_code');
        var labelLink = document.getElementById('label_link');
        var helpLink = document.getElementById('help_link');
        var linkInput = document.getElementById('ad_link');

        function sync() {
            var t = typeEl.value;
            wrapLink.style.display = (t === 'link' || t === 'image') ? '' : 'none';
            wrapImage.style.display = (t === 'image') ? '' : 'none';
            wrapCode.style.display = (t === 'code') ? '' : 'none';

            if (t === 'link') {
                labelLink.textContent = 'Link *';
                helpLink.textContent = 'This page is shown to the player full-screen. Some websites (Google, Facebook, YouTube watch pages, many banks) refuse to open inside another page, so always test your link with a real play.';
                linkInput.required = true;
            } else {
                labelLink.textContent = 'Click-through Link (optional)';
                helpLink.textContent = '';
                linkInput.required = false;
            }
        }

        typeEl.addEventListener('change', sync);
        sync();
    })();
</script>
