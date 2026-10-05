@extends('layouts.admin')

@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Site Notification Popup</h1>

    @if ($message = Session::get('notification_success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert"><i class="fas fa-times"></i></button>
            <strong>{{ $message }}</strong>
        </div>
    @endif

    <div class="pb-2 text-right">
        @if (!empty($langs))
            <select name="language" class="form-control language-control" onchange="window.location='{{url()->current() . '?language='}}'+this.value">
                <option value="" selected disabled>{{clean( trans('niva-backend.select_language') , array('Attr.EnableID' => true))}}</option>
                @foreach ($langs as $lang)
                    <option value="{{$lang->code}}" {{$lang->code == request()->input('language') ? 'selected' : ''}}>{{$lang->name}}</option>
                @endforeach
            </select>
        @endif
    </div>

    @include('includes.form-errors')

    <div class="row">
        <div class="col-md-8">

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-dark">Notification Popup</h6>
                </div>
                <div class="card-body">

                    <form action="{{ route('notification-setting.update', $setting->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <strong>এই নোটিফিকেশন পপআপ সাইটে দেখাবে কিনা</strong>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="is_enabled" name="is_enabled" value="1" {{ $setting->is_enabled ? 'checked' : '' }}>
                                <label class="custom-control-label" for="is_enabled">{{ $setting->is_enabled ? 'On' : 'Off' }}</label>
                            </div>
                            <p class="text-muted small mb-0">অফ থাকলে সাইটে কোনো ভিজিটরই এই পপআপ দেখতে পাবে না।</p>
                        </div>

                        <hr>

                        <div class="form-group">
                            <strong>Icon / Image</strong>
                            <br>
                            <img style="padding-bottom:10px" class="img-fluid" width="60" src="{{ $setting->photo ? '/public/images/media/' . $setting->photo->file : '/public/img/200x200.png' }}" alt="">
                            <input type="file" name="photo_id" class="form-control-file">
                        </div>

                        <div class="form-group">
                            <strong>Badge Text (ছোট ব্যাজ, ঐচ্ছিক)</strong>
                            <input type="text" name="badge_text" class="form-control" placeholder="যেমন: OFFICIAL APP" value="{{ $setting->badge_text }}">
                        </div>

                        <div class="form-group">
                            <strong>Title</strong>
                            <input type="text" name="title" class="form-control" placeholder="বড় হেডলাইন" value="{{ $setting->title }}">
                        </div>

                        <div class="form-group">
                            <strong>Description</strong>
                            <textarea name="description" class="form-control" rows="4" placeholder="বিস্তারিত লেখা">{{ $setting->description }}</textarea>
                        </div>

                        <hr>

                        <p class="text-muted small">নিচের দুটো ফিল্ড খালি রাখলে শুধু লেখা ও ছবি দেখাবে, কোনো বাটন থাকবে না। বাটন টেক্সট আর লিংক দুটোই দিলে তবেই বাটন দেখাবে।</p>

                        <div class="form-group">
                            <strong>Button Text (ঐচ্ছিক)</strong>
                            <input type="text" name="button_text" class="form-control" placeholder="যেমন: Get it on Google Play" value="{{ $setting->button_text }}">
                        </div>

                        <div class="form-group">
                            <strong>Button Link (ঐচ্ছিক)</strong>
                            <input type="text" name="button_link" class="form-control" placeholder="https://..." value="{{ $setting->button_link }}">
                        </div>

                        <button type="submit" class="btn btn-primary">Save Changes</button>

                    </form>

                </div>
            </div>

        </div>
    </div>

</div>
<!-- /.container-fluid -->

@stop
