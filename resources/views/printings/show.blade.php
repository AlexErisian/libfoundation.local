@extends('layouts.app')
@php
    /** @var \App\Models\Printing $printing */
@endphp
@section('content')
    <div class="col">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h4 class="card-title m-0">
                    &laquo;{{ $printing->title }}&raquo;</h4>
            </div>
            <div class="card-body">
                <div class="row justify-content-center">
                    @if(!empty($printing->picture_path))
                        <div class="col-10 col-sm-8 col-md-7 col-lg-5">
                            <img class="card-img img-fluid m-1"
                                 src="{{ asset('storage/'.$printing->picture_path) }}"
                                 alt="Зображення обкладинки друкованого видання">
                        </div>
                    @else
                        <div class="col">
                            <svg height="100%" width="100%"
                                 style="text-anchor: middle">
                                <rect width="100%" height="100%"
                                      fill="#6c757d"></rect>
                                <text fill="#fff" x="50%" y="50%">
                                    Немає зображення обкладинки
                                </text>
                            </svg>
                        </div>
                    @endif
                    <div class="col-md-12 col-lg-7 mt-2">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <p class="card-text text-muted">
                                    Автор оригіналу
                                </p>
                                <h5 class="card-subtitle mb-2">
                                    {{ $printing->author->name }}
                                </h5>
                            </li>
                            <li class="list-group-item">
                                <p class="card-text text-muted">
                                    Зберігається у бібліотеках
                                </p>
                                <h5 class="card-subtitle mb-2">
                                    {{ $printing->libraries->count() > 0 ? $printing->libraries->unique()->implode('name', ', ') : '-' }}
                                </h5>
                            </li>
                            <li class="list-group-item">
                                <p class="card-text text-muted">
                                    Рік публікації
                                </p>
                                <h6 class="card-subtitle mb-2">
                                    {{ $printing->publication_year }}
                                </h6>
                            </li>
                            <li class="list-group-item">
                                <p class="card-text text-muted">
                                    Видавництво
                                </p>
                                <h6 class="card-subtitle mb-2">
                                    {{ $printing->pubhouse->name }}
                                </h6>
                            </li>
                            <li class="list-group-item">
                                <p class="card-text text-muted">
                                    Тип видання
                                </p>
                                <h6 class="card-subtitle mb-2">
                                    {{ $printing->type->name }}
                                </h6>
                            </li>
                            <li class="list-group-item">
                                <p class="card-text text-muted">
                                    ISBN
                                </p>
                                <h6 class="card-subtitle mb-2">
                                    {{ $printing->isbn ?? '-' }}
                                </h6>
                            </li>
                            <li class="list-group-item">
                                <p class="card-text text-muted">
                                    Жанри
                                </p>
                                <h6 class="card-subtitle mb-2">
                                    {{ $printing->genres->count() > 0 ? $printing->genres->implode('name', ', ') : '-' }}
                                </h6>
                            </li>
                            <li class="list-group-item">
                                <p class="card-text text-muted">
                                    Анотація
                                </p>
                                <p class="card-text mb-2">
                                    {{ $printing->annotation }}
                                </p>
                            </li>
                        </ul>
                    </div>
                </div>
                <hr class="w-100">
                <h5 class="card-title">Читали це видання? Ви можете залишити
                    свій коментар для інших користувачів:</h5>
                @guest
                    <p class="card-text">Щоб залишити коментар, будь ласка,
                        <a href="{{ route('login') }}">увійдіть</a>
                        до свого облікового запису. Якщо у вас ще немає
                        облікового запису, ви можете <a
                            href="{{ route('register') }}">зареєструватися</a>.
                    </p>
                @endguest
                @auth
                    @can('create', App\Models\PrintingComment::class)
                        <form class="w-100"
                              method="POST"
                              action="{{ route('reader.printing-comments.store') }}">
                            @csrf
                            <div class="form-group">
                                <label for="text">Текст коментаря (до 1000
                                    символів)</label>
                                <textarea class="form-control"
                                          id="text"
                                          name="text"
                                          maxlength="1000"
                                          rows="3">{{ old('text') }}</textarea>
                            </div>
                            <input type="hidden"
                                   name="printing_id"
                                   value="{{ $printing->id }}">
                            <button class="btn btn-primary"
                                    type="submit">
                                Коментувати
                            </button>
                        </form>
                    @else
                        <p class="card-text text-danger">
                            Ви не можете залишати коментарі тому,
                            що ваш обліковий запис було заблоковано.
                        </p>
                    @endcan
                @endauth
            </div>
            <div id="comments" class="card-header bg-info">
                <h5 class="card-title mb-0">Коментарі читачів</h5>
            </div>
            <div class="card-body">
                @include('admin.include-messages.result')
                @if($printing->comments->count() < 1)
                    <h5 class="card-subtitle text-center text-muted">Коментарів
                        поки що немає.</h5>
                @else
                    @foreach($printing->comments as $comment)
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <div class="media">
                                    <div class="media-body">
                                        <h6 class="card-title font-italic">
                                            {{ $comment->user->name }} написав:
                                        </h6>
                                        <div class="row no-gutters">
                                            <div class="col">
                                                <p class="card-text m-0">
                                                    {{ $comment->text }}
                                                </p>
                                                <p class="card-text">
                                                    <small class="text-muted">
                                                        {{ $comment->created_at }}
                                                    </small>
                                                </p>
                                            </div>
                                            @can('delete', $comment)
                                                <div
                                                    class="col-2 align-self-center">
                                                    <form class="float-right"
                                                          method="POST"
                                                          action="{{ route('reader.printing-comments.destroy', $comment->id) }}">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button
                                                            class="btn btn-outline-danger"
                                                            type="submit">
                                                            Видалити
                                                        </button>
                                                    </form>
                                                </div>
                                            @endcan
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    @endforeach
                @endif
            </div>
        </div>
@endsection
