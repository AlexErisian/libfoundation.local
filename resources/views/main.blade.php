@extends('layouts.app')
@php
    /** @var \App\Models\Post $post */
    /** @var \App\Models\Printing $printing */
@endphp
@section('content')
    <div class="col">
        <div class="card shadow-sm">
            <div id="news" class="card-header bg-primary text-white">
                <h4 class="card-title m-0">ОСТАННІ НОВИНИ</h4>
            </div>
            <ul class="list-group list-group-flush">
                @foreach($posts as $post)
                    <li class="list-group-item">
                        <h4 class="card-title">
                            <a href="">
                                {{ $post->title }}
                            </a>
                        </h4>
                        <h6 class="card-subtitle text-muted mb-2">
                            Опубліковано: {{ $post->published_at }}&nbsp;&nbsp;&nbsp;
                            Автор: {{ $post->user->name }}
                        </h6>
                        <hr class="w-100">
                        <div class="row justify-content-center">
                            <div class="col">
                                <p class="card-text">
                                    {{ $post->description }}
                                </p>
                            </div>
                            @if(!empty($post->picture_path))
                                <div class="d-none d-md-block col-md-5">
                                    <img
                                        src="{{ asset('storage/'.$post->picture_path) }}"
                                        class="img-fluid"
                                        alt="Зображення до новини">
                                </div>
                            @endif
                        </div>
                    </li>
                @endforeach
            </ul>
            <div class="card-footer">
                <a class="card-link"
                   href="">
                    Подивитися усі новини
                </a>
            </div>
            <div id="popularPrintings"
                 class="card-header bg-primary text-white">
                <h4 class="card-title m-0">СВІЖІ ВИДАННЯ</h4>
            </div>
            <div class="card-body">
                <div class="row row-cols-1 row-cols-lg-2">
                    @foreach($printings as $printing)
                        <div class="col mb-4">
                            <div class="card h-100">
                                <div class="row no-gutters">
                                    @if(!empty($printing->picture_path))
                                        <div class="d-none d-md-block col-md-5">
                                            <img
                                                src="{{ asset('storage/'.$printing->picture_path) }}"
                                                class="card-img img-thumbnail m-1"
                                                alt="Зображення до друкованого видання">
                                        </div>
                                    @endif
                                    <div class="col">
                                        <div class="card-body">
                                            <h5 class="card-title">
                                                <a href="">
                                                    {{ $printing->title }}
                                                </a>
                                            </h5>
                                            <h6 class="card-subtitle text-muted mb-2">
                                                Автор: {{ $printing->author->name }}
                                                <br>
                                                Рік публікації: {{ $printing->publication_year }}
                                                <br>
                                                Зареєстровано: {{ $printing->created_at->toDateString() }}
                                            </h6>
                                            <hr class="w-100">
                                            <p class="card-text">
                                                Анотація:<br>
                                                {{ $printing->annotation }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="card-footer">
                <a class="card-link"
                   href="{{ route('printings.index') }}">
                    Подивитися перелік усіх видань
                </a>
            </div>
        </div>
    </div>
    <div class="col-lg-2 d-none d-lg-block px-0">
        <div class="card shadow-sm">
            <div class="card-body">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link"
                           href="#news">
                            Останні новини
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"
                           href="#popularPrintings">
                            Свіжі видання
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endsection
