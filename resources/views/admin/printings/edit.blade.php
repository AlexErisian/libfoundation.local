@extends('layouts.app')
@php
    /** @var \App\Models\Printing $printing */
@endphp
@section('content')
    <div class="col">
        <div class="row justify-content-center">
            <form class="col"
                  id="editItem"
                  method="POST"
                  enctype="multipart/form-data"
                  action="{{ route('admin.printings.update', $printing->id) }}">
                @method('PATCH')
                @csrf
                <div class="w-100">
                    @include('admin.printings.includes.main_col')
                    @include('admin.include-messages.result')
                </div>
            </form>
            <div class="col-md-3">
                @include('admin.printings.includes.add_col')
            </div>
        </div>
    </div>
@endsection
