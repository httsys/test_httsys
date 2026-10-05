@extends('layouts.admin')

@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Homepage Sections</h1>
    <p class="mb-4 text-muted">Turn any homepage section on or off. A section that's off simply won't appear on the homepage — its content and settings elsewhere are not deleted, so you can turn it back on any time.</p>

    @if (session('status'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert"><i class="fas fa-times"></i></button>
            <strong>{{ session('status') }}</strong>
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-body">

            <form action="{{ route('home-section.update') }}" method="POST">
                @csrf
                @method('PUT')

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Section</th>
                            <th style="width: 120px;">Show on homepage</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sections as $section)
                            <tr>
                                <td class="align-middle">{{ $section->name }}</td>
                                <td class="align-middle">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="section_{{ $section->key }}" name="sections[{{ $section->key }}]" value="1" {{ $section->is_active ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="section_{{ $section->key }}">{{ $section->is_active ? 'On' : 'Off' }}</label>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <button type="submit" class="btn btn-primary">Save</button>
            </form>

        </div>
    </div>

</div>
<!-- /.container-fluid -->

@endsection
