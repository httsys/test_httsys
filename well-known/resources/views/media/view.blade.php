<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{ $photo->file }}</title>
    <style>
        * { box-sizing: border-box; }
        body {
            margin: 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #16181d;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Arial, sans-serif;
            padding: 20px;
        }
        .card {
            background: #ffffff;
            border-radius: 14px;
            padding: 24px;
            max-width: 900px;
            width: 100%;
            box-shadow: 0 10px 40px rgba(0,0,0,0.35);
        }
        .filename {
            font-size: 14px;
            color: #6e707e;
            word-break: break-all;
            margin: 0 0 16px 0;
            text-align: center;
        }
        .viewer { text-align: center; }
        .viewer img { max-width: 100%; max-height: 80vh; border-radius: 8px; display: block; margin: 0 auto; }
        .viewer video { max-width: 100%; max-height: 80vh; border-radius: 8px; background: #000; }
        .viewer audio { width: 100%; }
        .viewer iframe { width: 100%; height: 80vh; border: none; border-radius: 8px; }
        .other-file {
            text-align: center;
            padding: 60px 20px;
        }
        .other-file i { font-size: 56px; color: #4e73df; margin-bottom: 16px; display: block; }
        .actions {
            margin-top: 20px;
            display: flex;
            gap: 10px;
            justify-content: center;
            flex-wrap: wrap;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            border-radius: 30px;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            border: none;
        }
        .btn-primary { background: #4e73df; color: #fff; }
        .btn-secondary { background: #eaecf4; color: #444; }
    </style>
</head>
<body>

    <div class="card">
        <p class="filename">{{ $photo->file }}</p>

        <div class="viewer">
            @if ($type === 'image')
                <img src="{{ $url }}" alt="{{ $photo->file }}">
            @elseif ($type === 'video')
                <video controls preload="metadata" src="{{ $url }}"></video>
            @elseif ($type === 'audio')
                <div class="other-file" style="padding: 30px 20px;">
                    <span style="font-size:56px;">&#9835;</span>
                    <audio controls preload="metadata" src="{{ $url }}"></audio>
                </div>
            @elseif ($type === 'pdf')
                <iframe src="{{ $url }}"></iframe>
            @else
                <div class="other-file">
                    <span style="font-size:56px;">&#128196;</span>
                    <p>This file type can't be previewed in the browser.</p>
                </div>
            @endif
        </div>

        <div class="actions">
            <a href="{{ $url }}" download class="btn btn-primary">Download</a>
            <button type="button" class="btn btn-secondary" onclick="copyLink(this)">Copy Link</button>
        </div>
    </div>

    <script>
        function copyLink(btn) {
            navigator.clipboard.writeText(window.location.href).then(function () {
                var original = btn.textContent;
                btn.textContent = 'Copied!';
                setTimeout(function () { btn.textContent = original; }, 1500);
            });
        }
    </script>

</body>
</html>
