@extends('layouts.app')

@section('content')
    <form class="col"
          method="POST"
          action="{{ route('admin.printing-comments.store') }}">
        @csrf
        <div class="row justify-content-center">
            <div class="col">
                @include('admin.printing-comments.includes.main_col_create')
                @include('admin.include-messages.result')
            </div>
        </div>
    </form>
@endsection
