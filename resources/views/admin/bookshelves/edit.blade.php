@extends('layouts.app')

@section('content')
    @php
        /** @var \App\Models\Bookshelf $bookshelf */
        /** @var \Illuminate\Support\ViewErrorBag $errors */
    @endphp
    <form class="col"
          method="POST"
          action="{{ route('admin.bookshelves.update', $bookshelf->id) }}">
        @method('PATCH')
        @csrf
        <div class="row justify-content-center">
            <div class="col">
                @include('admin.bookshelves.includes.main_col')
                @include('admin.include-messages.result')
            </div>
            <div class="col-md-3">
                @include('admin.bookshelves.includes.add_col')
            </div>
        </div>
    </form>
@endsection
