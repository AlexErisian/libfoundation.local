@extends('layouts.app')

@section('content')
    <form class="col"
          method="POST"
          enctype="multipart/form-data"
          action="{{ route('admin.printings.store') }}">
        @csrf
        <div class="row justify-content-center">
            <div class="col">
                @include('admin.printings.includes.main_col_create')
                @include('admin.include-messages.result')
            </div>
        </div>
    </form>
@endsection
