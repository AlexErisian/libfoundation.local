@extends('layouts.app')
@php
    /** @var \App\Models\Library $library */
@endphp
@section('content')
    <div class="col">
        <div class="card shadow-sm">
            <div id="news" class="card-header bg-primary text-white">
                <h4 class="card-title m-0">БІБЛІОТЕКИ СИСТЕМИ LibFoundation</h4>
            </div>
        </div>
        <ul class="list-group list-group-flush">
            @foreach($librariesPagination as $library)
                <li class="list-group-item">
                    <h4 class="card-title">
                        <a href="">
                            {{ $library->name }}
                        </a>
                    </h4>
                    <h6 class="card-subtitle text-muted mb-2">
                        Адреса: {{ $library->address }}
                    </h6>
                    <div class="row justify-content-center">
                        <div class="col">
                            <p class="card-text">
                                Додаткова інформація:<br>
                                {{ $library->notes }}
                            </p>
                        </div>
                        @if(!empty($library->picture_path))
                            <div class="d-none d-md-block col-md-5">
                                <img
                                    src="{{ asset('storage/'.$library->picture_path) }}"
                                    class="img-fluid"
                                    alt="Зображення до бібліотеки">
                            </div>
                        @endif
                    </div>
                </li>
            @endforeach
        </ul>
        @if($librariesPagination->total() > $librariesPagination->count())
            <div class="card-footer">
                {{ $librariesPagination->links() }}
            </div>
        @endif
    </div>
@endsection
