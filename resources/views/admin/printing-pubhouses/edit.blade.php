@extends('layouts.app')

@section('content')
    @php
        /** @var \App\Models\PrintingPubhouse $pubhouse */
    @endphp
    <form class="col"
          method="POST"
          action="{{ route('admin.printing-pubhouses.update', $pubhouse->id) }}">
        @method('PATCH')
        @csrf
        <div class="row justify-content-center">
            <div class="col">
                @include('admin.printing-pubhouses.includes.main_col')
                @include('admin.include-messages.result')
            </div>
            <div class="col-md-3">
                @include('admin.printing-pubhouses.includes.add_col')
            </div>
        </div>
    </form>
@endsection
