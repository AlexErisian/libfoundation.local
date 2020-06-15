@extends('layouts.app')
@php
    /** @var \App\Models\Bookshelf $bookshelf */
@endphp
@section('content')
    <div class="col">
        <div class="row justify-content-center">
            <form class="col"
                  id="editItem"
                  method="POST"
                  enctype="multipart/form-data"
                  action="{{ route('admin.bookshelves.update', $bookshelf->id) }}">
                @method('PATCH')
                @csrf
                <div class="w-100">
                    @include('admin.bookshelves.includes.main_col')
                    @include('admin.include-messages.result')
                </div>
            </form>
            <div class="col-md-3">
                @include('admin.bookshelves.includes.add_col')
            </div>
        </div>
    </div>
@endsection
