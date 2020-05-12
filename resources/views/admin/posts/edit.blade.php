@extends('layouts.app')

@section('content')
    <form class="col"
          method="POST"
          enctype="multipart/form-data"
          action="{{ route('admin.posts.update', $post->id) }}">
        @method('PATCH')
        @csrf
        <div class="row justify-content-center">
            <div class="col">
                @include('admin.posts.includes.main_col')
                @include('admin.include-messages.result')
            </div>
            <div class="col-md-3">
                @include('admin.posts.includes.add_col')
            </div>
        </div>
    </form>
@endsection
