@php
    /** @var \Illuminate\Support\Collection $authorOptions */
    /** @var \Illuminate\Support\Collection $pubhouseOptions */
    /** @var \Illuminate\Support\Collection $typeOptions */
    /** @var \Illuminate\Support\Collection $genreOptions */
@endphp
<div class="card">
    <div class="card-header bg-primary">
        <h5 class="text-white">Створення запису: друковане видання</h5>
    </div>
    <div class="card-body">
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active"
                   href="#mainData"
                   aria-controls="mainData"
                   role="tab"
                   data-toggle="tab">Основні дані</a>
            </li>
            <li class="nav-item">
                <a class="nav-link"
                   href="#addData"
                   aria-controls="addData"
                   role="tab"
                   data-toggle="tab">Інші дані</a>
            </li>
        </ul>
        <br>
        <div class="tab-content">
            <div id="mainData" class="tab-pane active" role="tabpanel">
                <div class="form-group">
                    <label for="title">Назва</label>
                    <input class="form-control"
                           type="text"
                           id="title"
                           name="title"
                           maxlength="250"
                           required
                           value="{{ old('title') }}">
                </div>
                <div class="form-group">
                    <label for="printing_author_id">Автор оригіналу</label>
                    <select class="form-control"
                            id="printing_author_id"
                            name="printing_author_id">
                        @foreach($authorOptions as $author)
                            <option value="{{ $author->id }}">
                                {{ $author->id.'. '.$author->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="printing_pubhouse_id">Видавництво</label>
                    <select class="form-control"
                            id="printing_pubhouse_id"
                            name="printing_pubhouse_id">
                        @foreach($pubhouseOptions as $pubhouse)
                            <option value="{{ $pubhouse->id }}">
                                {{ $pubhouse->id.'. '.$pubhouse->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="printing_type_id">Тип видання</label>
                    <select class="form-control"
                            id="printing_type_id"
                            name="printing_type_id">
                        @foreach($typeOptions as $type)
                            <option value="{{ $type->id }}">
                                {{ $type->id.'. '.$type->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="genre_ids">Жанр видання</label>
                    <select class="form-control custom-select"
                            id="genre_ids"
                            name="genre_ids[]"
                            multiple
                            size="5"
                            required>
                        @foreach($genreOptions as $genre)
                            <option value="{{ $genre->id }}">
                                {{ $genre->id.'. '.$genre->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="publication_year">Рік публікації</label>
                    <input class="form-control"
                           type="number"
                           id="publication_year"
                           name="publication_year"
                           required
                           value="{{ old('publication_year') }}">
                </div>
            </div>
            <div id="addData" class="tab-pane" role="tabpanel">
                <div class="form-group">
                    <label for="isbn">ISBN</label>
                    <input class="form-control"
                           type="text"
                           id="isbn"
                           name="isbn"
                           value="{{ old('isbn') }}">
                </div>
                <div class="form-group">
                    <label for="annotation">Анотація (короткий опис)</label>
                    <textarea class="form-control"
                              id="annotation"
                              name="annotation"
                              required
                              maxlength="2000"
                              rows="3">{{ old('annotation') }}</textarea>
                </div>
                <div class="form-group">
                    <label for="picture">Зображення обкладинки</label>
                    <input class="form-control-file"
                           id="picture"
                           name="picture"
                           type="file"
                           accept="image/*">
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <button class="btn btn-primary" type="submit">Зберегти</button>
    </div>
</div>
