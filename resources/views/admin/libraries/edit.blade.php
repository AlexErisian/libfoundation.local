@extends('layouts.app')

@section('content')
    @php
        /** @var \App\Models\Library $library */
        /** @var \Illuminate\Support\ViewErrorBag $errors */
    @endphp
    <form class="col"
          method="POST"
          enctype="multipart/form-data"
          action="{{ route('admin.libraries.update', $library->id) }}">
        @method('PATCH')
        @csrf
        <div class="row justify-content-center">
            <div class="col">
                @include('admin.libraries.includes.main_col')
                @include('admin.include-messages.result')
            </div>
            <div class="col-md-3">
                @include('admin.libraries.includes.add_col')
            </div>
        </div>
    </form>
@endsection
