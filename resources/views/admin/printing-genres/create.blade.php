@extends('layouts.app')

@section('content')
    <form class="col"
          method="POST"
          action="{{ route('admin.printing-genres.store') }}">
        @csrf
        <div class="row justify-content-center">
            <div class="col">
                @include('admin.printing-genres.includes.main_col_create')
                @include('admin.include-messages.result')
            </div>
        </div>
    </form>
@endsection
