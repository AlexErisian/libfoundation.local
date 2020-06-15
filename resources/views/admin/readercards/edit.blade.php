@extends('layouts.app')
@php
    /** @var \App\Models\Readercard $readercard */
@endphp
@section('content')
    <div class="col">
        <div class="row justify-content-center">
            <form class="col"
                  id="editItem"
                  method="POST"
                  enctype="multipart/form-data"
                  action="{{ route('admin.readercards.update', $readercard->id) }}">
                @method('PATCH')
                @csrf
                <div class="w-100">
                    @include('admin.readercards.includes.main_col')
                    @include('admin.include-messages.result')
                </div>
            </form>
            <div class="col-md-3">
                @include('admin.readercards.includes.add_col')
            </div>
        </div>
    </div>
@endsection
