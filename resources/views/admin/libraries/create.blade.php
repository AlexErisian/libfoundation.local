@extends('layouts.app')

@section('content')
    @php
        /** @var \Illuminate\Support\ViewErrorBag $errors */
    @endphp
    <form class="col"
          method="POST"
          enctype="multipart/form-data"
          action="{{ route('admin.libraries.store') }}">
        @csrf
        <div class="row justify-content-center">
            <div class="col">
                @include('admin.libraries.includes.main_col_create')
                @include('admin.include-messages.result')
            </div>
        </div>
    </form>
@endsection
