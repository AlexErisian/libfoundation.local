@extends('layouts.app')

@section('content')
    @php
        /** @var \App\Models\PrintingGenre $genre */
    @endphp
    <form class="col"
          method="POST"
          action="{{ route('admin.printing-genres.update', $genre->id) }}">
        @method('PATCH')
        @csrf
        <div class="row justify-content-center">
            <div class="col">
                @include('admin.printing-genres.includes.main_col')
                @include('admin.include-messages.result')
            </div>
            <div class="col-md-3">
                @include('admin.printing-genres.includes.add_col')
            </div>
        </div>
    </form>
@endsection
