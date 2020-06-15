@extends('layouts.app')
@php
    /** @var \App\Models\PrintingGenre $genre */
@endphp
@section('content')
    <div class="col">
        <div class="row justify-content-center">
            <form class="col"
                  id="editItem"
                  method="POST"
                  enctype="multipart/form-data"
                  action="{{ route('admin.printing-genres.update', $genre->id) }}">
                @method('PATCH')
                @csrf
                <div class="w-100">
                    @include('admin.printing-genres.includes.main_col')
                    @include('admin.include-messages.result')
                </div>
            </form>
            <div class="col-md-3">
                @include('admin.printing-genres.includes.add_col')
            </div>
        </div>
    </div>
@endsection
