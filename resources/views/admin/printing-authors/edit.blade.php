@extends('layouts.app')

@section('content')
    @php
        /** @var \App\Models\PrintingAuthor $author */
        /** @var \Illuminate\Support\ViewErrorBag $errors */
    @endphp
    <form class="col"
          method="POST"
          action="{{ route('admin.printing-authors.update', $author->id) }}">
        @method('PATCH')
        @csrf
        <div class="row justify-content-center">
            <div class="col">
                @include('admin.printing-authors.includes.main_col')
                @include('admin.include-messages.result')
            </div>
            <div class="col-md-3">
                @include('admin.printing-authors.includes.add_col')
            </div>
        </div>
    </form>
@endsection
