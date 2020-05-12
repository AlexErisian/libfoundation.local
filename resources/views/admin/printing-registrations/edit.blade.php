@extends('layouts.app')

@section('content')
    @php
        /** @var \App\Models\Bookshelf $registration */
    @endphp
    <form class="col"
          method="POST"
          action="{{ route('admin.printing-registrations.update', $registration->id) }}">
        @method('PATCH')
        @csrf
        <div class="row justify-content-center">
            <div class="col">
                @include('admin.printing-registrations.includes.main_col')
                @include('admin.include-messages.result')
            </div>
            <div class="col-md-3">
                @include('admin.printing-registrations.includes.add_col')
            </div>
        </div>
    </form>
@endsection
