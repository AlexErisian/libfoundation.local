@extends('layouts.app')

@section('content')
    <form class="col"
          method="POST"
          enctype="multipart/form-data"
          action="{{ route('admin.printing-comments.update', $comment->id) }}">
        @method('PATCH')
        @csrf
        <div class="row justify-content-center">
            <div class="col">
                @include('admin.printing-comments.includes.main_col')
                @include('admin.include-messages.result')
            </div>
            <div class="col-md-3">
                @include('admin.printing-comments.includes.add_col')
            </div>
        </div>
    </form>
@endsection
