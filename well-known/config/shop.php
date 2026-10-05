<?php

// Simple, code-level checkout settings for now. These are prime candidates
// to move into an admin-editable Setting record in a later phase (Phase 5
// mentions a fuller admin sidebar) — kept as plain config for Phase 1 so
// checkout has *some* tax/shipping numbers to show, matching the
// Shopperz reference screenshots.

return [
    'currency_symbol' => env('SHOP_CURRENCY_SYMBOL', '$'),

    // Flat rate for now — percentage/rule-based tax can replace this later.
    'tax_rate' => (float) env('SHOP_TAX_RATE', 0.25), // 25% shown in the reference screenshots ($160 -> $40 tax)

    'shipping_charge' => (float) env('SHOP_SHIPPING_CHARGE', 10),
];
