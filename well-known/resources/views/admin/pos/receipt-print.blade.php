<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Receipt #{{ $order->order_number }}</title>
    <style>
        * { box-sizing: border-box; }
        body {
            font-family: 'Courier New', Courier, monospace;
            width: 300px;
            margin: 0 auto;
            padding: 12px;
            color: #000;
        }
        table { width: 100%; border-collapse: collapse; }
        hr { border: none; border-top: 1px dashed #000; }
        .text-right { text-align: right; }
        .text-center { text-align: center; }
        .text-muted { color: #555; }
        .font-weight-bold { font-weight: bold; }
        .small { font-size: 11px; }
        .d-flex { display: flex; }
        .justify-content-between { justify-content: space-between; }
        .mb-1 { margin-bottom: 4px; }
        .mb-2 { margin-bottom: 8px; }
        .mt-2 { margin-top: 8px; }
        .my-2 { margin: 8px 0; }
        @media print {
            body { width: 100%; }
        }
    </style>
</head>
<body>
    @include('admin.pos._receipt-content', ['order' => $order, 'setting' => $setting])

    <script>
        window.onload = function () {
            window.print();
        };
    </script>
</body>
</html>
