{{-- Renders one ad zone by its unique key. If the zone doesn't exist yet in the
     database, it is auto-created (inactive, empty) so it shows up in the admin
     "Ads" settings page ready to be filled in. Nothing is shown until an admin
     turns it on and pastes a code (Google AdSense or any third-party HTML/JS).

     The ad code is rendered inside a sandboxed iframe (via srcdoc). This is
     deliberate: third-party ad snippets often ship their own CSS/JS that isn't
     scoped to their own box, and can otherwise break the site's header, menu,
     or mobile layout. Sandboxing keeps every ad self-contained and mobile-safe,
     and the iframe auto-resizes to fit whatever the ad actually renders. --}}
@php
    $__adZone = \App\Models\AdZone::firstOrCreate(
        ['key' => $key],
        ['name' => $label ?? $key, 'is_active' => false]
    );
@endphp
@if($__adZone->is_active && trim((string) $__adZone->code) !== '')
    @php
        $__frameId = 'ad-frame-' . $key . '-' . $__adZone->id;
        $__srcdoc = '<!DOCTYPE html><html><head>'
            . '<meta name="viewport" content="width=device-width, initial-scale=1">'
            . '<style>html,body{margin:0;padding:0;overflow-x:hidden;background:transparent;}'
            . '*{max-width:100% !important;box-sizing:border-box;}'
            . 'img,iframe,video,table,ins{height:auto;}</style>'
            . '</head><body>'
            . $__adZone->code
            . '<script>(function(){'
            . 'function reportSize(){try{var h=document.body.scrollHeight;parent.postMessage({adFrameId:"' . $__frameId . '",height:h},"*");}catch(e){}}'
            . 'window.addEventListener("load",reportSize);'
            . 'if(window.ResizeObserver){new ResizeObserver(reportSize).observe(document.body);}'
            . 'setInterval(reportSize,1500);'
            . '})();</' . 'script>'
            . '</body></html>';
    @endphp
    <div class="ad-zone ad-zone-{{ $key }}" style="max-width:100%; overflow:hidden;">
        <iframe
            id="{{ $__frameId }}"
            data-ad-frame="1"
            title="{{ $label ?? $key }}"
            style="width:100%; border:0; display:block; height:50px;"
            scrolling="no"
            loading="lazy"
            srcdoc="{{ $__srcdoc }}"
        ></iframe>
    </div>
    @once
        <script>
        window.addEventListener('message', function (e) {
            if (e.data && e.data.adFrameId) {
                var el = document.getElementById(e.data.adFrameId);
                if (el && e.data.height) {
                    el.style.height = e.data.height + 'px';
                }
            }
        });
        </script>
    @endonce
@endif