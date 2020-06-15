@extends('layouts.app')
@php
    /** @var \App\Models\PrintingAuthor $author */
    /** @var \Illuminate\Support\ViewErrorBag $errors */
@endphp
@section('content')
    <div class="col">
        <div class="row justify-content-center">
            <form class="col"
                  id="editItem"
                  method="POST"
                  enctype="multipart/form-data"
                  action="{{ route('admin.printing-authors.update', $author->id) }}">
                @method('PATCH')
                @csrf
                <div class="w-100">
                    @include('admin.printing-authors.includes.main_col')
                    @include('admin.include-messages.result')
                </div>
            </form>
            <div class="col-md-3">
                @include('admin.printing-authors.includes.add_col')
            </div>
        </div>
    </div>
@endsection
