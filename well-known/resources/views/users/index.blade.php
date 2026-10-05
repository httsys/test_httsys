@extends('layouts.admin')

@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">


    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">{{clean( trans('niva-backend.all_users') , array('Attr.EnableID' => true))}}</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{clean( trans('niva-backend.all_users') , array('Attr.EnableID' => true))}}</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">


                @if ($message = Session::get('user_success'))
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert"><i class="fas fa-times"></i></button>    
                        <strong>{{ $message }}</strong>
                    </div>
                @endif
                @if ($message = Session::get('user_fail'))
                    <div class="alert alert-danger alert-block">
                        <button type="button" class="close" data-dismiss="alert"><i class="fas fa-times"></i></button>    
                        <strong>{{ $message }}</strong>
                    </div>
                @endif

               

                <form action="{{route('delete.users')}}" method="POST" class="form-inline">
                @csrf
                @method('DELETE')
                <div class="form-group">
                    <select name="checkbox_array" id="" class="form-control">
                        <option value="">{{clean( trans('niva-backend.delete') , array('Attr.EnableID' => true))}}</option>
                    </select>
                </div>

                <div class="form-group">
                    <input type="submit" name="delete_all" class="btn btn-primary">
                    <input type="hidden" name="current_user" value="{{ auth()->user()->id }}">
                </div>



                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th><input type="checkbox" id="options"></th>
                            <th>{{clean( trans('niva-backend.name') , array('Attr.EnableID' => true))}}</th>
                            <th>{{clean( trans('niva-backend.email') , array('Attr.EnableID' => true))}}</th>
                            <th>{{clean( trans('niva-backend.role') , array('Attr.EnableID' => true))}}</th>
                            <th>Last Login</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th><input type="checkbox" id="options1"></th>
                            <th>{{clean( trans('niva-backend.name') , array('Attr.EnableID' => true))}}</th>
                            <th>{{clean( trans('niva-backend.email') , array('Attr.EnableID' => true))}}</th>
                            <th>{{clean( trans('niva-backend.role') , array('Attr.EnableID' => true))}}</th>
                            <th>Last Login</th>
                            <th>Status</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @if($users)
                            @foreach($users as $user)
                                <tr>
                                    <td><input class="checkboxes" type="checkbox" name="checkbox_array[]" value="{{$user->id}}"></td>
                                    <td data-label="Name">
                                        <div class="float-left-avatar">
                                            <img width="35" height="35" src="{{$user->photo ? '/public/images/media/' . $user->photo->file : '/public/img/200x200.png'}}" alt="">
                                        </div>
                                        <div class="float-left-user-name">
                                            <p>{{$user->name}}</p>
                                            <a href="{{ route('users.edit', $user->id) }}">{{clean( trans('niva-backend.edit') , array('Attr.EnableID' => true))}}</a>
                                            &nbsp;|&nbsp;
                                            <a href="{{ route('users.show', $user->id) }}">View</a>
                                        </div>
                                    </td>
                                    <td data-label="Name and surname">{{$user->email}}</td>
                                    <td data-label="Role">{{$user->role ? $user->role->name : ''}}</td>
                                    <td data-label="Last Login">
                                        @if($user->last_login_at)
                                            {{ $user->last_login_at->format('Y-m-d H:i') }}<br>
                                            <small class="text-muted">{{ $user->last_login_ip }}</small>
                                        @else
                                            <span class="text-muted">Never</span>
                                        @endif
                                    </td>
                                    <td data-label="Status">
                                        @if($user->id === auth()->user()->id)
                                            <span class="badge badge-success">Active</span>
                                            <br><small class="text-muted">This is you</small>
                                        @else
                                            <label class="user-switch" title="Turn off to deactivate this account">
                                                <input type="checkbox" class="user-active-toggle"
                                                       data-user="{{ $user->id }}"
                                                       {{ $user->isActive() ? 'checked' : '' }}>
                                                <span class="user-slider"></span>
                                            </label>
                                            <span class="user-status-label" data-user="{{ $user->id }}">
                                                {{ $user->isActive() ? 'Active' : 'Inactive' }}
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                             @endforeach
                        @endif


                        
                    </tbody>
                </table>

                </form>
                 {!! $users->render() !!}
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->


<style>
    .user-switch { position: relative; display: inline-block; width: 44px; height: 24px; margin: 0; vertical-align: middle; }
    .user-switch input { opacity: 0; width: 0; height: 0; }
    .user-slider {
        position: absolute; cursor: pointer; top: 0; left: 0; right: 0; bottom: 0;
        background-color: #ccc; transition: .2s; border-radius: 24px;
    }
    .user-slider:before {
        position: absolute; content: ""; height: 18px; width: 18px; left: 3px; bottom: 3px;
        background-color: #fff; transition: .2s; border-radius: 50%;
    }
    .user-switch input:checked + .user-slider { background-color: #1cc88a; }
    .user-switch input:checked + .user-slider:before { transform: translateX(20px); }
    .user-status-label { font-size: 12.5px; font-weight: 600; margin-left: 8px; vertical-align: middle; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
    var csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    document.querySelectorAll('.user-active-toggle').forEach(function (box) {
        box.addEventListener('change', function () {
            var id = this.dataset.user;
            var self = this;
            var wanted = this.checked;

            fetch('/admin/users/' + id + '/toggle-active', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrf
                },
                body: JSON.stringify({ is_active: wanted ? 1 : 0 })
            })
            .then(function (res) {
                if (!res.ok) { throw new Error('failed'); }
                return res.json();
            })
            .then(function (data) {
                var label = document.querySelector('.user-status-label[data-user="' + id + '"]');
                if (label) { label.textContent = data.is_active ? 'Active' : 'Inactive'; }
            })
            .catch(function () {
                // Put the switch back where it was so what's on screen always
                // matches what actually saved.
                self.checked = !wanted;
                alert('Could not change that account. Please try again.');
            });
        });
    });
});
</script>

@stop
