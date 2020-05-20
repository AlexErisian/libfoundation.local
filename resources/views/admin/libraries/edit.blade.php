@extends('layouts.app')

@section('content')
    @php
        /** @var \App\Models\Library $library */
        /** @var \Illuminate\Support\ViewErrorBag $errors */
    @endphp
    <div class="col">
        <div class="row justify-content-center">
            <form class="col"
                  id="editItem"
                  method="POST"
                  enctype="multipart/form-data"
                  action="{{ route('admin.libraries.update', $library->id) }}">
                @method('PATCH')
                @csrf
                <div class="w-100">
                    @include('admin.libraries.includes.main_col')
                    @include('admin.include-messages.result')
                </div>
            </form>
            <div class="col-md-3">
                @include('admin.libraries.includes.add_col')
            </div>
        </div>
    </div>
@endsection
