@extends('layouts.app')

@section('content')
    @php /** @var \App\Models\Library $library */ @endphp
    <form method="POST"
          action="{{ route('admin.libraries.update', $library->id) }}">
        @method('PATCH')
        @csrf
        <div class="col">
            @include('admin.libraries.includes.main_col')
        </div>
        <div class="col-md-2">

        </div>
    </form>
@endsection
