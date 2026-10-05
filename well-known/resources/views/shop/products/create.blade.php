@extends('layouts.admin')

@section('content')

@include('includes.tinyeditor')

<div class="container-fluid">

    <h1 class="h3 mb-2 text-gray-800">Create Product</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Create Product</h6>
        </div>
        <div class="card-body">

            <div class="row">
                <div class="col-lg-6">
                    <a href="{{ route('products.index') }}?language={{ request()->input('language') }}" class="btn btn-primary btn-back">Back to Products</a>
                </div>
                <div class="col-lg-6 text-right">
                    @if (!empty($langs))
                        <select name="language" class="form-control language-control" onchange="window.location='{{url()->current() . '?language='}}'+this.value">
                            <option value="" selected disabled>{{clean( trans('niva-backend.select_language') , array('Attr.EnableID' => true))}}</option>
                            @foreach ($langs as $lang)
                                <option value="{{$lang->code}}" {{$lang->code == request()->input('language') ? 'selected' : ''}}>{{$lang->name}}</option>
                            @endforeach
                        </select>
                    @endif
                </div>
            </div>

            @include('includes.form-errors')

            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="language_id" value="{{ $lang_id }}">

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <strong>Title</strong>
                            <input type="text" name="title" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <strong>Category</strong>
                            <select name="product_category_id" class="form-control" required>
                                <option value="">Choose category</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <strong>Brand (optional)</strong>
                            <select name="brand_id" class="form-control">
                                <option value="">No brand</option>
                                @foreach($brands as $brand)
                                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <strong>Product Type</strong>
                            <select name="type" id="productType" class="form-control" required onchange="toggleProductTypeFields()">
                                <option value="physical">Physical (shipped item)</option>
                                <option value="digital">Digital (source code / theme / account / key / gift card / game coin etc.)</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <strong>Price</strong>
                            <input type="number" step="0.01" min="0" name="price" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <strong>Sale Price (optional)</strong>
                            <input type="number" step="0.01" min="0" name="sale_price" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-4" id="stockField">
                        <div class="form-group">
                            <strong>Stock (physical products)</strong>
                            <input type="number" min="0" name="stock" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <strong>Barcode / SKU (optional)</strong>
                            <input type="text" name="sku" maxlength="64" class="form-control" placeholder="e.g. 8901030826319">
                            <small class="form-text text-muted">
                                Used by the POS barcode box to instantly find this product. Scan the product's
                                existing barcode (from a supplier label, or one you print yourself) with a USB/Bluetooth
                                barcode scanner while this field is focused — it will type the number in automatically.
                                You can also type/paste any code by hand. Leave empty if this product has no barcode;
                                in the POS you can then just type its numeric Product ID into the barcode box instead.
                            </small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <strong>Tax / VAT % (optional)</strong>
                            <input type="number" step="0.01" min="0" max="100" name="tax_rate" class="form-control" placeholder="e.g. 10">
                            <small class="form-text text-muted">
                                Only used by the POS receipt. Leave empty to use the site's default tax rate for this
                                product; enter a number like 10 for 10% to override it just for this product.
                            </small>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <strong>Main Image</strong>
                            <input type="file" name="photo_id" class="form-control-file">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="is_flash_sale" name="is_flash_sale" value="1">
                                <label class="custom-control-label" for="is_flash_sale">Flash Sale</label>
                            </div>
                            <div class="custom-control custom-switch mt-2">
                                <input type="checkbox" class="custom-control-input" id="is_active" name="is_active" value="1" checked>
                                <label class="custom-control-label" for="is_active">Active (visible on site)</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <strong>Gallery Image 1</strong> <span>upload <a target="_blank" href="{{route('media.create')}}">here</a> then copy URL <a target="_blank" href="{{route('media.index')}}">here</a></span>
                            <input type="text" name="img_gal1" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <strong>Gallery Image 2</strong>
                            <input type="text" name="img_gal2" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <strong>Gallery Image 3</strong>
                            <input type="text" name="img_gal3" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <strong>Gallery Image 4</strong>
                            <input type="text" name="img_gal4" class="form-control">
                        </div>
                    </div>
                </div>

                <div id="digitalFields" style="display:none;">
                    <hr>
                    <p class="text-muted small">ডিজিটাল প্রোডাক্ট কেনার পর গ্রাহক তার প্যানেল থেকে যেই ফাইল ডাউনলোড করবে বা যেই লিংকে অ্যাক্সেস পাবে, তা এখানে সেট করুন।</p>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <strong>Digital File (source code, key file, gift card image etc.)</strong>
                                <input type="file" name="digital_file_id" class="form-control-file">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <strong>Or an External Link (optional, e.g. Drive folder / redeem page)</strong>
                                <input type="text" name="digital_link" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>

                <hr>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <strong>Warranty Duration (optional)</strong>
                            <input type="number" min="0" name="warranty_duration" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <strong>Warranty Unit</strong>
                            <select name="warranty_unit" class="form-control">
                                <option value="">-</option>
                                <option value="days">Days</option>
                                <option value="months">Months</option>
                                <option value="years">Years</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <strong>Short Description</strong>
                    <textarea name="short_description" class="form-control no-rte" rows="3"></textarea>
                </div>

                <div class="form-group">
                    <strong>Full Description</strong>
                    <textarea name="body" class="form-control" id="body" rows="8"></textarea>
                </div>

                <hr>
                <h6 class="font-weight-bold">Video (shown in the "Videos" tab)</h6>
                <div class="form-group">
                    <strong>Video URL (YouTube / Facebook link)</strong>
                    <input type="text" name="video_url" class="form-control" placeholder="https://www.youtube.com/watch?v=...">
                </div>

                <hr>
                <h6 class="font-weight-bold">Shipping &amp; Return (shown in the "Shipping &amp; Return" tab)</h6>
                <div class="form-group">
                    <textarea name="shipping_return_info" class="form-control no-rte" rows="4" placeholder="ডেলিভারি সময়, চার্জ, রিটার্ন/ওয়ারেন্টি পলিসি..."></textarea>
                </div>

                <hr>
                <h6 class="font-weight-bold">Product Variants (Color / Ram / Storage / Region etc.)</h6>
                <p class="text-muted small">
                    প্রতিটি গ্রুপের জন্য একটি নাম দিন (যেমনঃ Color, Ram, Storage, Region/Variant) এবং প্রতি লাইনে একটি করে অপশন লিখুন।
                    Color গ্রুপের অপশনে চাইলে হেক্স কালার কোড দিতে পারবেনঃ <code>Cosmic Orange|#c2703d</code>।
                    কোনো অপশনে বাড়তি দাম যোগ করতে চাইলেঃ <code>1TB|#c2703d|5000</code> (তৃতীয় অংশটি এক্সট্রা প্রাইস)।
                </p>

                <div id="variantGroups"></div>
                <button type="button" id="addVariantGroup" class="btn btn-sm btn-secondary mb-4">+ Add Variant Group</button>

                <hr>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <strong>Meta Title</strong>
                            <input type="text" name="meta_title" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <strong>Meta Description</strong>
                            <input type="text" name="meta_description" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="text-right">
                    <button type="submit" class="btn btn-primary">Create</button>
                </div>

            </form>

        </div>
    </div>

</div>

<script>
    function toggleProductTypeFields() {
        var type = document.getElementById('productType').value;
        document.getElementById('digitalFields').style.display = type === 'digital' ? 'block' : 'none';
        document.getElementById('stockField').style.display = type === 'digital' ? 'none' : 'block';
    }
    document.addEventListener('DOMContentLoaded', toggleProductTypeFields);

    (function () {
        var container = document.getElementById('variantGroups');
        var addBtn = document.getElementById('addVariantGroup');
        var groupIndex = 0;

        function addGroup() {
            var wrap = document.createElement('div');
            wrap.className = 'variant-group card p-3 mb-3';
            wrap.innerHTML =
                '<div class="form-group">' +
                    '<strong>Group Name</strong>' +
                    '<input type="text" name="variant_groups[' + groupIndex + '][name]" class="form-control" placeholder="e.g. Color">' +
                '</div>' +
                '<div class="form-group mb-2">' +
                    '<strong>Options (one per line)</strong>' +
                    '<textarea name="variant_groups[' + groupIndex + '][options]" class="form-control no-rte" rows="3" placeholder="Cosmic Orange|#c2703d"></textarea>' +
                '</div>' +
                '<button type="button" class="btn btn-sm btn-outline-danger remove-group">Remove Group</button>';
            container.appendChild(wrap);
            groupIndex++;
        }

        addBtn.addEventListener('click', addGroup);

        container.addEventListener('click', function (e) {
            if (e.target.classList.contains('remove-group')) {
                e.target.closest('.variant-group').remove();
            }
        });
    })();
</script>

@endsection
