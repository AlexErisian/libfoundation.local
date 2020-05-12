@extends('layouts.app')

@section('content')
    @php
        /** @var \Illuminate\Support\ViewErrorBag $errors */
    @endphp
    <form class="col"
          method="POST"
          action="{{ route('admin.bookshelves.store') }}">
        @csrf
        <div class="row justify-content-center">
            <div class="col">
                @include('admin.bookshelves.includes.main_col_create')
                @include('admin.include-messages.result')
            </div>
        </div>
    </form>
@endsection
