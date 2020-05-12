@extends('layouts.app')

@section('content')
    @php
        /** @var \App\Models\Readercard $readercard */
    @endphp
    <form class="col"
          method="POST"
          action="{{ route('admin.readercards.update', $readercard->id) }}">
        @method('PATCH')
        @csrf
        <div class="row justify-content-center">
            <div class="col">
                @include('admin.readercards.includes.main_col')
                @include('admin.include-messages.result')
            </div>
            <div class="col-md-3">
                @include('admin.readercards.includes.add_col')
            </div>
        </div>
    </form>
@endsection
