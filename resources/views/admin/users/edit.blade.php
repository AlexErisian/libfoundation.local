@extends('layouts.app')

@section('content')
    <form class="col"
          method="POST"
          action="{{ route('admin.users.update', $user->id) }}">
        @method('PATCH')
        @csrf
        <div class="row justify-content-center">
            <div class="col">
                @include('admin.users.includes.main_col')
                @include('admin.include-messages.result')
            </div>
            <div class="col-md-3">
                @include('admin.users.includes.add_col')
            </div>
        </div>
    </form>
@endsection
