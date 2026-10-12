<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>Media library</title>
<style>
    * { box-sizing: border-box; }
    body { margin: 0; font-family: Arial, Helvetica, sans-serif; background: #f4f6f9; color: #222; }
    header { position: sticky; top: 0; background: #fff; border-bottom: 1px solid #ddd; padding: 10px 14px; z-index: 5; }
    header form { display: flex; gap: 8px; flex-wrap: wrap; align-items: center; }
    input[type=text] { padding: 7px 10px; border: 1px solid #bbb; border-radius: 4px; min-width: 180px; }
    button, .btn { padding: 7px 14px; border: 0; border-radius: 4px; background: #4e73df; color: #fff; cursor: pointer; font-size: 14px; }
    #drop { margin: 12px 14px; padding: 18px; border: 2px dashed #9aa5c4; border-radius: 6px; text-align: center; background: #fff; color: #555; }
    #drop.over { background: #eaf0ff; border-color: #4e73df; }
    #status { margin: 0 14px; font-size: 13px; color: #555; min-height: 18px; }
    #status .err { color: #c0392b; }
    .grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(130px, 1fr)); gap: 10px; padding: 14px; }
    .item { background: #fff; border: 2px solid transparent; border-radius: 6px; overflow: hidden; cursor: pointer; }
    .item:hover { border-color: #4e73df; }
    .thumb { height: 100px; display: flex; align-items: center; justify-content: center; background: #e9ecef; font-size: 34px; color: #6c757d; }
    .thumb img { max-width: 100%; max-height: 100%; object-fit: contain; }
    .name { padding: 6px; font-size: 11px; word-break: break-all; max-height: 46px; overflow: hidden; }
    .pager { padding: 0 14px 20px; display: flex; gap: 6px; flex-wrap: wrap; }
    .pager a, .pager span { padding: 5px 10px; background: #fff; border: 1px solid #ccc; border-radius: 4px; font-size: 13px; text-decoration: none; color: #333; }
    .pager .cur { background: #4e73df; color: #fff; border-color: #4e73df; }
    .empty { padding: 30px; text-align: center; color: #777; }
</style>
</head>
<body>
<header>
    <form method="get" action="{{ route('media.picker') }}">
        <input type="hidden" name="type" value="{{ $type }}">
        <input type="text" name="q" value="{{ $search }}" placeholder="Search by file name">
        <button type="submit">Search</button>
        <span style="font-size:13px;color:#666;">Click a file to insert it.</span>
    </form>
</header>

<div id="drop">
    Drop files here or <label style="color:#4e73df;cursor:pointer;text-decoration:underline;">choose files<input id="pick" type="file" multiple style="display:none"></label> to upload
    <div style="font-size:12px;margin-top:4px;">.jpg .png .gif .webp .svg .mp3 .wav .ogg .m4a .mp4 .mov .avi .mkv .webm .pdf</div>
</div>
<div id="status"></div>

@if(count($items))
<div class="grid">
    @foreach($items as $it)
        <div class="item" data-url="{{ $it['url'] }}" data-name="{{ $it['name'] }}">
            <div class="thumb">
                @if($it['is_image'])
                    <img src="{{ $it['url'] }}" loading="lazy" alt="">
                @else
                    &#9654;
                @endif
            </div>
            <div class="name">{{ $it['name'] }}</div>
        </div>
    @endforeach
</div>
<div class="pager">
    @for($p = 1; $p <= $photos->lastPage(); $p++)
        @if($p == $photos->currentPage())
            <span class="cur">{{ $p }}</span>
        @else
            <a href="{{ $photos->url($p) }}">{{ $p }}</a>
        @endif
    @endfor
</div>
@else
<div class="empty">No files found. Upload one above.</div>
@endif

<script>
(function () {
    var uploadUrl = @json(route('media.picker.upload'));
    var token = document.querySelector('meta[name="csrf-token"]').content;
    var drop = document.getElementById('drop');
    var status = document.getElementById('status');

    document.addEventListener('click', function (e) {
        var el = e.target.closest ? e.target.closest('.item') : null;
        if (!el) { return; }
        var item = { url: el.getAttribute('data-url'), name: el.getAttribute('data-name') };
        if (window.opener && typeof window.opener.SetUrl === 'function') {
            window.opener.SetUrl([item]);
        }
        window.close();
    });

    function uploadAll(files) {
        var list = Array.prototype.slice.call(files);
        var done = 0, failed = 0;
        status.innerHTML = '';
        (function next() {
            if (!list.length) {
                status.innerHTML += '<div>Finished: ' + done + ' uploaded' + (failed ? ', ' + failed + ' failed' : '') + '.</div>';
                if (done) { setTimeout(function () { window.location.reload(); }, 600); }
                return;
            }
            var f = list.shift();
            var line = document.createElement('div');
            line.textContent = 'Uploading ' + f.name + ' ...';
            status.appendChild(line);

            var fd = new FormData();
            fd.append('file', f);
            var xhr = new XMLHttpRequest();
            xhr.open('POST', uploadUrl);
            xhr.setRequestHeader('X-CSRF-TOKEN', token);
            xhr.setRequestHeader('Accept', 'application/json');
            xhr.upload.onprogress = function (ev) {
                if (ev.lengthComputable) { line.textContent = 'Uploading ' + f.name + ' ' + Math.round(ev.loaded / ev.total * 100) + '%'; }
            };
            xhr.onload = function () {
                if (xhr.status >= 200 && xhr.status < 300) {
                    done++; line.textContent = 'Uploaded ' + f.name;
                } else {
                    failed++;
                    var msg = 'failed';
                    try { msg = JSON.parse(xhr.responseText).error || msg; } catch (x) {}
                    line.innerHTML = '<span class="err"></span>';
                    line.firstChild.textContent = f.name + ': ' + msg;
                }
                next();
            };
            xhr.onerror = function () {
                failed++; line.innerHTML = '<span class="err"></span>';
                line.firstChild.textContent = f.name + ': network error';
                next();
            };
            xhr.send(fd);
        })();
    }

    document.getElementById('pick').addEventListener('change', function () { if (this.files.length) { uploadAll(this.files); } });
    ['dragenter', 'dragover'].forEach(function (n) { drop.addEventListener(n, function (e) { e.preventDefault(); drop.classList.add('over'); }); });
    ['dragleave', 'drop'].forEach(function (n) { drop.addEventListener(n, function (e) { e.preventDefault(); drop.classList.remove('over'); }); });
    drop.addEventListener('drop', function (e) { if (e.dataTransfer.files.length) { uploadAll(e.dataTransfer.files); } });
})();
</script>
</body>
</html>
