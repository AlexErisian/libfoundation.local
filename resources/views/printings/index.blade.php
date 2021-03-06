@extends('layouts.app')
@php
    /** @var \App\Models\Printing $printing */
    /** @var \Illuminate\Pagination\LengthAwarePaginator $printingsPagination */
@endphp
@section('content')
    <div class="col">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h4 class="card-title m-0">КАТАЛОГ ДРУКОВАНИХ ВИДАНЬ</h4>
            </div>
            <div class="card-header bg-info text-dark">
                <h5 class="card-title m-0">Опції фільтру</h5>
            </div>
            <div class="card-body">
                <form class="w-100"
                      id="formFilter"
                      @if(!empty(request()->all()))
                      onreset="location.replace('{{route('printings.index')}}');"
                      @endif
                      method="GET"
                      action="{{ route('printings.index') }}">
                    <div class="row row-cols-lg-2 row-cols-md-1">
                        <div class="col">
                            <div class="form-group">
                                <label for="printing_author_id">Автор
                                    оригіналу</label>
                                <select class="form-control"
                                        id="printing_author_id"
                                        name="printing_author_id">
                                    <option value="" selected>
                                        Виберіть автора
                                    </option>
                                    @foreach($authorOptions as $author)
                                        <option value="{{ $author->id }}"
                                                @if($author->id == request('printing_author_id')) selected @endif>
                                            {{ $author->id.'. '.$author->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label
                                    for="printing_pubhouse_id">Видавництво</label>
                                <select class="form-control"
                                        id="printing_pubhouse_id"
                                        name="printing_pubhouse_id">
                                    <option value="" selected>
                                        Виберіть видавництво
                                    </option>
                                    @foreach($pubhouseOptions as $pubhouse)
                                        <option value="{{ $pubhouse->id }}"
                                                @if($pubhouse->id == request('printing_pubhouse_id')) selected @endif>
                                            {{ $pubhouse->id.'. '.$pubhouse->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="printing_type_id">Тип
                                    видання</label>
                                <select class="form-control"
                                        id="printing_type_id"
                                        name="printing_type_id">
                                    <option value="" selected>
                                        Виберіть тип видання
                                    </option>
                                    @foreach($typeOptions as $type)
                                        <option value="{{ $type->id }}"
                                                @if($type->id == request('printing_type_id')) selected @endif>
                                            {{ $type->id.'. '.$type->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <p class="card-text">Жанри видань</p>
                            @foreach($genreOptions as $genre)
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input"
                                           type="checkbox"
                                           id="genre{{ $genre->id }}"
                                           name="genre_ids[]"
                                           value="{{ $genre->id }}"
                                           @if(in_array($genre->id, request('genre_ids') ?? [])) checked @endif>
                                    <label class="form-check-label"
                                           for="genre{{ $genre->id }}">
                                        {{ $genre->name }}
                                    </label>
                                </div>
                            @endforeach
                            <div class="form-group mt-3">
                                <label for="printing_title">Назва видання (або
                                    фраза у назві)</label>
                                <input class="form-control"
                                       type="text"
                                       id="printing_title"
                                       name="printing_title"
                                       value="{{ request('printing_title') ?? '' }}">
                            </div>
                        </div>
                    </div>
                    <hr class="w-100">
                    <input type="hidden" name="filter_required" value="1">
                    <button class="btn btn-info float-right"
                            type="submit">
                        Фільтрувати
                    </button>
                    <button class="btn btn-outline-secondary float-right mr-3"
                            type="reset">
                        Очистити опції
                    </button>
                </form>
            </div>
            <hr class="w-100 m-0">
            <div class="card-body">
                @if($printingsPagination->count() > 0)
                    <div class="row row-cols-1 row-cols-lg-2">
                        @foreach($printingsPagination as $printing)
                            <div class="col mb-4">
                                <div class="card h-100">
                                    <div class="row no-gutters">
                                        @if(!empty($printing->picture_path))
                                            <div class="col-4 col-md-5">
                                                <img
                                                    src="{{ asset('storage/'.$printing->picture_path) }}"
                                                    class="card-img img-thumbnail m-1"
                                                    alt="Зображення до друкованого видання">
                                            </div>
                                        @endif
                                        <div class="col">
                                            <div class="card-body">
                                                <h5 class="card-title">
                                                    <a href="{{ route('printings.show', $printing->id) }}">
                                                        {{ $printing->title }}
                                                    </a>
                                                </h5>
                                                <h6 class="card-subtitle text-muted mb-2">
                                                    Автор оригіналу:
                                                    {{ $printing->author->name }}
                                                    <br>
                                                    Видавництво:
                                                    {{ $printing->pubhouse->name }}
                                                    <br>
                                                    Тип видання:
                                                    {{ $printing->type->name }}
                                                    <br>
                                                    Рік публікації:
                                                    {{ $printing->publication_year }}
                                                    <br>
                                                    ISBN:
                                                    {{ $printing->isbn ?? '-' }}
                                                    <br>
                                                    Жанри:
                                                    {{ $printing->genres->count() > 0 ? $printing->genres->implode('name', ', ') : '-' }}
                                                    <br>
                                                </h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <hr class="w-100">
                                        <p class="card-text">
                                            Анотація:<br>
                                            {{ $printing->annotation }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <h5 class="card-title text-center">За даними опціями нічого
                        не знайдено.</h5>
                @endif
            </div>
            @if($printingsPagination->total() > $printingsPagination->count())
                <div class="card-footer">
                    {{ $printingsPagination->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
