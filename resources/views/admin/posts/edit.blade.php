@php
    /** @var \App\Models\Post $post */
@endphp
@extends('layouts.app')
@section('content')
    <div class="col">
        <div class="row justify-content-center">
            <form class="col"
                  id="editItem"
                  method="POST"
                  enctype="multipart/form-data"
                  action="{{ route('admin.posts.update', $post->id) }}">
                @method('PATCH')
                @csrf
                <div class="w-100">
                    @include('admin.posts.includes.main_col')
                    @include('admin.include-messages.result')
                </div>
            </form>
            <div class="col-md-3">
                @include('admin.posts.includes.add_col')
            </div>
        </div>
    </div>
@endsection
