@extends('layouts.admin')

@section('styles')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .pos-product-card { cursor: pointer; transition: box-shadow .15s ease; }
        .pos-product-card:hover { box-shadow: 0 0 0 2px #4e73df; }
        #pos-cart-panel { position: sticky; top: 15px; max-height: calc(100vh - 30px); display: flex; flex-direction: column; }
        #pos-cart-items { overflow-y: auto; max-height: 260px; }
        .pos-thumb { width: 48px; height: 48px; object-fit: cover; border: 2px solid transparent; margin-right: 6px; cursor: pointer; border-radius: 4px; }
        .pos-thumb.active { border-color: #4e73df; }
        .pos-variant-pill.active { background: #4e73df; color: #fff; border-color: #4e73df; }
        .pos-payment-method-btn { flex: 1; }
        .pos-payment-method-btn.active { background: #4e73df; color: #fff; border-color: #4e73df; }
        .pos-numpad { display: grid; grid-template-columns: repeat(3, 1fr); gap: 6px; }
        .pos-numpad-btn { padding: 10px 0; font-size: 16px; }
        .pos-receipt { font-family: 'Courier New', Courier, monospace; font-size: 12px; }
        #pos-product-grid { transition: opacity .15s ease; }

        #pos-status-pill { cursor: pointer; padding: 4px 10px; border-radius: 12px; font-size: 12px; font-weight: bold; border: 1px solid #ddd; }
        #pos-status-pill.pos-status-online { color: #1cc88a; border-color: #1cc88a; }
        #pos-status-pill.pos-status-offline { color: #e74a3b; border-color: #e74a3b; background: #fdecea; }
        #pos-status-pill .dot { display: inline-block; width: 8px; height: 8px; border-radius: 50%; background: currentColor; margin-right: 5px; }
        #pos-status-popover { position: absolute; right: 0; top: 30px; z-index: 1050; width: 240px; background: #fff; border: 1px solid #ddd; border-radius: 6px; box-shadow: 0 2px 10px rgba(0,0,0,.15); padding: 12px; font-size: 12px; }
        #pos-status-popover .row-line { display: flex; justify-content: space-between; margin-bottom: 6px; }
        .pos-refund-result:hover { background: #f8f9fc; }
    </style>
@endsection

@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3 text-gray-800 mb-0">Point of Sale</h1>
        <div class="d-flex align-items-center" style="gap:10px;">
            <button type="button" id="pos-refund-btn" class="btn btn-outline-secondary btn-sm" @if(!$canRefund) style="display:none;" @endif>
                <i class="fas fa-undo mr-1"></i> Refund a sale
            </button>
            <div class="position-relative">
                <span id="pos-status-pill" class="pos-status-online"><span class="dot"></span><span id="pos-status-text">ONLINE</span></span>
                <div id="pos-status-popover" class="d-none">
                    <div class="row-line"><span class="text-muted">STATUS</span><span id="pos-status-value">online</span></div>
                    <div class="row-line"><span class="text-muted">LAST SYNCED</span><span id="pos-status-synced">never</span></div>
                    <div class="row-line"><span class="text-muted">SYNC QUEUE</span><span id="pos-status-queue">empty</span></div>
                    <button type="button" id="pos-refresh-data" class="btn btn-sm btn-outline-primary btn-block mt-2">
                        <i class="fas fa-sync-alt mr-1"></i> Refresh data now
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        {{-- Left: product browser --}}
        <div class="col-lg-8">
            <div class="card shadow mb-3">
                <div class="card-body py-2">
                    <div class="form-row">
                        <div class="col-md-6 mb-2">
                            <input type="text" id="pos-search" class="form-control" placeholder="Search Here...">
                        </div>
                        <div class="col-md-3 mb-2">
                            <select id="pos-category" class="form-control">
                                <option value="">Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3 mb-2">
                            <select id="pos-brand" class="form-control">
                                <option value="">Select Brand</option>
                                @foreach($brands as $brand)
                                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div id="pos-product-grid">
                @include('admin.pos._product-grid', ['products' => $products])
            </div>
        </div>

        {{-- Right: sale in progress --}}
        <div class="col-lg-4">
            <div id="pos-cart-panel" class="card shadow">
                <div class="card-body">

                    <form id="pos-barcode-form" class="form-inline mb-2 w-100">
                        <input type="text" id="pos-barcode-input" class="form-control flex-grow-1 mr-1" placeholder="Barcode — click here, then scan" autocomplete="off" autofocus>
                        <button type="submit" class="btn btn-outline-secondary"><i class="fas fa-barcode"></i></button>
                    </form>

                    <div class="input-group mb-3">
                        <select id="pos-customer-select" class="form-control">
                            <option value="">Walking Customer</option>
                            @foreach($customers as $customer)
                                <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                            @endforeach
                        </select>
                        <div class="input-group-append">
                            <button id="pos-add-customer-btn" type="button" class="btn btn-warning" title="Add Customer">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>

                    <div id="pos-cart-items" class="mb-3"></div>

                    <div class="form-row align-items-center mb-2">
                        <div class="col-5">
                            <select id="pos-discount-type" class="form-control form-control-sm">
                                <option value="percentage">Percentage</option>
                                <option value="fixed">Fixed</option>
                            </select>
                        </div>
                        <div class="col-4">
                            <input type="number" min="0" step="0.01" id="pos-discount-value" class="form-control form-control-sm" placeholder="Add Discount">
                        </div>
                        <div class="col-3">
                            <button id="pos-discount-apply" type="button" class="btn btn-info btn-sm btn-block">Apply</button>
                        </div>
                    </div>

                    <div class="small">
                        <div class="d-flex justify-content-between"><span>SubTotal</span><span id="pos-subtotal">{{ config('shop.currency_symbol') }}0.00</span></div>
                        <div class="d-flex justify-content-between"><span>Tax</span><span id="pos-tax">{{ config('shop.currency_symbol') }}0.00</span></div>
                        <div class="d-flex justify-content-between"><span>Discount</span><span id="pos-discount">{{ config('shop.currency_symbol') }}0.00</span></div>
                        <div class="d-flex justify-content-between font-weight-bold" style="font-size:15px;"><span>Total</span><span id="pos-total">{{ config('shop.currency_symbol') }}0.00</span></div>
                    </div>

                    <div class="form-row mt-3">
                        <div class="col-6">
                            <button id="pos-cancel-btn" type="button" class="btn btn-danger btn-block">Cancel</button>
                        </div>
                        <div class="col-6">
                            <button id="pos-order-btn" type="button" class="btn btn-success btn-block" disabled>Order</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>

{{-- Server-rendered initial cart state, so a page refresh mid-sale still
     shows what was in progress. See admin-pos.js renderCart(). --}}
<script id="pos-initial-cart" type="application/json">{!! json_encode($cart) !!}</script>

{{-- ============================= Modals ============================= --}}

{{-- Product Variation modal --}}
<div class="modal fade" id="posVariationModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Product Variation</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-5">
                        <img id="pos-variation-main-image" src="" class="img-fluid rounded mb-2" style="width:100%;height:260px;object-fit:cover;">
                        <div id="pos-variation-thumbs" class="d-flex"></div>
                    </div>
                    <div class="col-md-7">
                        <h4 id="pos-variation-title"></h4>
                        <div id="pos-variation-price" class="mb-3" style="font-size:18px;"></div>
                        <div id="pos-variation-groups"></div>
                        <div class="d-flex align-items-center my-3">
                            <span class="mr-3 font-weight-bold">Quantity:</span>
                            <button type="button" id="pos-variation-qty-minus" class="btn btn-sm btn-outline-secondary">-</button>
                            <input type="text" id="pos-variation-qty" class="form-control form-control-sm text-center mx-2" style="width:60px;" value="1" readonly>
                            <button type="button" id="pos-variation-qty-plus" class="btn btn-sm btn-outline-secondary">+</button>
                        </div>
                        <button type="button" id="pos-variation-add" class="btn btn-primary btn-block"><i class="fas fa-shopping-bag mr-1"></i> Add to Cart</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Customers quick-add modal --}}
<div class="modal fade" id="posCustomerModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Customers</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div id="pos-customer-errors" class="mb-2"></div>
                <form id="pos-customer-form">
                    <div class="form-row">
                        <div class="col-md-6 form-group">
                            <label>Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Email <span class="text-danger">*</span></label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6 form-group">
                            <label>Phone</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <select name="country_code" class="form-control" style="max-width:110px;">
                                        <option value="+880" selected>BD +880</option>
                                        <option value="+91">IN +91</option>
                                        <option value="+92">PK +92</option>
                                        <option value="+1">US +1</option>
                                        <option value="+44">GB +44</option>
                                        <option value="+971">AE +971</option>
                                        <option value="+966">SA +966</option>
                                        <option value="+974">QA +974</option>
                                        <option value="+965">KW +965</option>
                                        <option value="+968">OM +968</option>
                                        <option value="+973">BH +973</option>
                                        <option value="+60">MY +60</option>
                                        <option value="+65">SG +65</option>
                                        <option value="+86">CN +86</option>
                                        <option value="+61">AU +61</option>
                                        <option value="+49">DE +49</option>
                                        <option value="+33">FR +33</option>
                                        <option value="+39">IT +39</option>
                                        <option value="+7">RU +7</option>
                                        <option value="+81">JP +81</option>
                                        <option value="+82">KR +82</option>
                                        <option value="+977">NP +977</option>
                                        <option value="+94">LK +94</option>
                                        <option value="+95">MM +95</option>
                                        <option value="+20">EG +20</option>
                                    </select>
                                </div>
                                <input type="tel" name="phone" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Status <span class="text-danger">*</span></label>
                            <div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="is_active" value="1" id="pos-status-active" checked>
                                    <label class="form-check-label" for="pos-status-active">Active</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="is_active" value="0" id="pos-status-inactive">
                                    <label class="form-check-label" for="pos-status-inactive">Inactive</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6 form-group">
                            <label>Password <span class="text-danger">*</span></label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Confirm Password <span class="text-danger">*</span></label>
                            <input type="password" name="password_confirmation" class="form-control" required>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="pos-customer-save" class="btn btn-primary"><i class="fas fa-check mr-1"></i>Save</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times mr-1"></i>Close</button>
            </div>
        </div>
    </div>
</div>

{{-- Order Payment modal --}}
<div class="modal fade" id="posPaymentModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Order Payment</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="d-flex justify-content-between align-items-center bg-light rounded p-2 mb-3">
                    <span>Total Amount</span>
                    <span id="pos-payment-total" class="font-weight-bold text-warning" style="font-size:18px;">{{ config('shop.currency_symbol') }}0.00</span>
                </div>

                <div class="mb-2 font-weight-bold small">Select Payment Method</div>
                <div class="d-flex mb-3" style="gap:6px;">
                    <button type="button" class="btn btn-outline-secondary pos-payment-method-btn active" data-method="cash"><i class="fas fa-money-bill-wave mb-1 d-block"></i>Cash</button>
                    <button type="button" class="btn btn-outline-secondary pos-payment-method-btn" data-method="card"><i class="fas fa-credit-card mb-1 d-block"></i>Card</button>
                    <button type="button" class="btn btn-outline-secondary pos-payment-method-btn" data-method="mfs"><i class="fas fa-mobile-alt mb-1 d-block"></i>MFS</button>
                    <button type="button" class="btn btn-outline-secondary pos-payment-method-btn" data-method="other"><i class="fas fa-receipt mb-1 d-block"></i>Other</button>
                </div>

                <div class="mb-2 font-weight-bold small">Input Amount</div>
                <input type="text" id="pos-amount-input" class="form-control mb-2" readonly>

                <div class="pos-numpad mb-3">
                    <button type="button" class="btn btn-light pos-numpad-btn" data-key="1">1</button>
                    <button type="button" class="btn btn-light pos-numpad-btn" data-key="2">2</button>
                    <button type="button" class="btn btn-light pos-numpad-btn" data-key="3">3</button>
                    <button type="button" class="btn btn-light pos-numpad-btn" data-key="4">4</button>
                    <button type="button" class="btn btn-light pos-numpad-btn" data-key="5">5</button>
                    <button type="button" class="btn btn-light pos-numpad-btn" data-key="6">6</button>
                    <button type="button" class="btn btn-light pos-numpad-btn" data-key="7">7</button>
                    <button type="button" class="btn btn-light pos-numpad-btn" data-key="8">8</button>
                    <button type="button" class="btn btn-light pos-numpad-btn" data-key="9">9</button>
                    <button type="button" class="btn btn-light pos-numpad-btn" data-key="00">00</button>
                    <button type="button" class="btn btn-light pos-numpad-btn" data-key="0">0</button>
                    <button type="button" class="btn btn-light pos-numpad-btn" data-key=".">.</button>
                    <button type="button" class="btn btn-outline-secondary pos-numpad-btn" data-key="back"><i class="fas fa-backspace"></i></button>
                    <button type="button" class="btn btn-outline-danger pos-numpad-btn" data-key="clear" style="grid-column: span 2;">Clear</button>
                </div>

                <button type="button" id="pos-confirm-payment" class="btn btn-warning btn-block">Confirm &amp; Print Receipt</button>
            </div>
        </div>
    </div>
</div>

{{-- Receipt modal --}}
<div class="modal fade" id="posReceiptModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" id="pos-receipt-close" class="btn btn-danger btn-sm"><i class="fas fa-times mr-1"></i>Close</button>
                <button type="button" id="pos-print-invoice" class="btn btn-success btn-sm"><i class="fas fa-print mr-1"></i>Print Invoice</button>
            </div>
            <div class="modal-body">
                <div id="pos-receipt-content"></div>
            </div>
        </div>
    </div>
</div>

{{-- Refund a sale — search modal --}}
<div class="modal fade" id="posRefundSearchModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <div>
                    <h5 class="modal-title">Refund a sale</h5>
                    <p class="small text-muted mb-0">Type a sale number or customer name — recent sales show by default.</p>
                </div>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <input type="text" id="pos-refund-search-input" class="form-control mb-3" placeholder="Sale number, customer name...">
                <div id="pos-refund-results" style="max-height:400px;overflow-y:auto;"></div>
            </div>
        </div>
    </div>
</div>

{{-- Process refund modal --}}
<div class="modal fade" id="posRefundProcessModal" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <div>
                    <h5 class="modal-title" id="pos-refund-process-title">Process refund</h5>
                    <p class="small text-muted mb-0">Pick the lines and quantities being returned. Defaults to a full refund.</p>
                </div>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-8">
                        <table class="table table-sm">
                            <thead>
                                <tr><th>Item</th><th>Refund Qty</th><th>Unit Price</th><th>Line Total</th></tr>
                            </thead>
                            <tbody id="pos-refund-items-body"></tbody>
                        </table>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="small font-weight-bold">Reason <span class="text-danger">*</span></label>
                            <select id="pos-refund-reason" class="form-control">
                                <option value="">Select a reason…</option>
                                <option>Customer changed mind</option>
                                <option>Wrong item</option>
                                <option>Defective / damaged</option>
                                <option>Other</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="small font-weight-bold">Refund To</label>
                            <select id="pos-refund-method" class="form-control">
                                <option value="cash">Cash</option>
                                <option value="card">Card</option>
                                <option value="mfs">MFS</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" id="pos-refund-restock" checked>
                            <label class="form-check-label" for="pos-refund-restock">Restock these items</label>
                        </div>
                        <div class="form-group">
                            <label class="small font-weight-bold">Notes</label>
                            <textarea id="pos-refund-notes" class="form-control" rows="3" placeholder="Anything the next cashier should know about this refund…"></textarea>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between small"><span>Subtotal</span><span id="pos-refund-subtotal">{{ config('shop.currency_symbol') }}0.00</span></div>
                        <div class="d-flex justify-content-between small"><span>Tax</span><span id="pos-refund-tax">{{ config('shop.currency_symbol') }}0.00</span></div>
                        <div class="d-flex justify-content-between font-weight-bold" style="font-size:15px;"><span>Refund total</span><span id="pos-refund-total">{{ config('shop.currency_symbol') }}0.00</span></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="pos-refund-cancel" class="btn btn-secondary">Cancel</button>
                <button type="button" id="pos-refund-submit" class="btn btn-warning"><i class="fas fa-check mr-1"></i>Process refund</button>
            </div>
        </div>
    </div>
</div>

{{-- Refund success modal --}}
<div class="modal fade" id="posRefundSuccessModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content text-center">
            <div class="modal-body py-4">
                <div class="mb-3"><i class="fas fa-check-circle text-success" style="font-size:48px;"></i></div>
                <h5>Refund processed</h5>
                <p class="text-muted mb-1" id="pos-refund-success-number"></p>
                <h3 class="font-weight-bold" id="pos-refund-success-amount"></h3>
                <p class="text-muted">For sale <span id="pos-refund-success-order"></span></p>
                <button type="button" id="pos-refund-success-done" class="btn btn-primary px-4">Done</button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('footer')
<script>
    window.posRoutes = {
        products: @json(route('pos.products')),
        barcode: @json(route('pos.barcode')),
        variationBase: @json(route('pos.variation', ['product' => '__ID__'])),
        cartAdd: @json(route('pos.cart.add')),
        cartUpdate: @json(route('pos.cart.update')),
        cartRemove: @json(route('pos.cart.remove')),
        cartCancel: @json(route('pos.cart.cancel')),
        customerSet: @json(route('pos.customer.set')),
        customerStore: @json(route('pos.customer.store')),
        discountApply: @json(route('pos.discount.apply')),
        checkout: @json(route('pos.checkout')),
        orderShowBase: @json(route('pos-orders.show', ['order' => '__ID__'])),
        orderPrintBase: @json(route('pos-orders.print', ['order' => '__ID__'])),
        catalog: @json(route('pos.catalog')),
        sync: @json(route('pos.sync')),
        refundsSearch: @json(route('pos.refunds.search')),
        refundsDetailBase: @json(route('pos.refunds.detail', ['order' => '__ID__'])),
        refundsProcessBase: @json(route('pos.refunds.process', ['order' => '__ID__']))
    };
    window.posCurrency = @json(config('shop.currency_symbol'));
    @php $setting = \App\Models\Setting::first(); @endphp
    window.posShopName = @json($setting->title ?? config('app.name'));
    window.posShopAddress = @json($setting->address ?? '');
    window.posShopPhone = @json($setting->phone ?? '');
</script>
<script src="{{ asset('js/pos-offline.js') }}"></script>
<script src="{{ asset('js/admin-pos.js') }}"></script>
@endsection
