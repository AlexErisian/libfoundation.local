@extends('layouts.app')

@section('content')
    @php
        /** @var \Illuminate\Support\ViewErrorBag $errors */
    @endphp
    <form class="col"
          method="POST"
          action="{{ route('admin.readercards.store') }}">
        @csrf
        <div class="row justify-content-center">
            <div class="col">
                @include('admin.readercards.includes.main_col_create')
                @include('admin.include-messages.result')
            </div>
        </div>
    </form>
@endsection
