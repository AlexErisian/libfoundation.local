@extends('layouts.app')

@section('content')
    <form class="col"
          method="POST"
          enctype="multipart/form-data"
          action="{{ route('admin.posts.store') }}">
        @csrf
        <div class="row justify-content-center">
            <div class="col">
                @include('admin.posts.includes.main_col_create')
                @include('admin.include-messages.result')
            </div>
        </div>
    </form>
@endsection
