@php
    /** @var \App\Models\Post $post */
@endphp
<div class="card">
    <div class="card-header bg-primary">
        <h5 class="text-white">Редагування запису: пост з новинами</h5>
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
                    <label for="title">Заголовок</label>
                    <input class="form-control"
                           type="text"
                           id="title"
                           name="title"
                           required
                           minlength="3"
                           maxlength="250"
                           value="{{ old('title', $post->title) }}">
                </div>
                <div class="form-group">
                    <label for="slug">Посилання</label>
                    <input class="form-control"
                           type="text"
                           id="slug"
                           name="slug"
                           minlength="3"
                           maxlength="250"
                           value="{{ old('slug', $post->slug) }}">
                </div>
                <div class="form-group">
                    <label for="description">Короткий зміст</label>
                    <textarea class="form-control"
                              id="description"
                              name="description"
                              required
                              rows="3">{{ old('description', $post->description) }}</textarea>
                </div>
                <div class="form-group">
                    <label for="content">Повний зміст</label>
                    <textarea class="form-control"
                              id="content"
                              name="content"
                              required
                              rows="6">{{ old('content', $post->content) }}</textarea>
                </div>
            </div>
            <div id="addData" class="tab-pane" role="tabpanel">
                <div class="form-group">
                    <label for="user_name">Автор</label>
                    <input class="form-control"
                           type="text"
                           id="user_name"
                           readonly
                           value="{{ $post->user->name }}">
                </div>
                <fieldset class="form-group">
                    <div class="form-check form-check-inline">
                        <input type="hidden"
                               name="is_published"
                               id="is_published0"
                               value="0">
                        <input class="form-check-input"
                               type="checkbox"
                               name="is_published"
                               id="is_published1"
                               value="1"
                               @if(old('is_published', $post->is_published)) checked @endif>
                        <label class="form-check-label"
                               for="is_published1">Опубліковано</label>
                    </div>
                </fieldset>
                <div class="form-group">
                    <label for="picture">Рисунок до новини</label>
                    @if(!empty($post->picture_path))
                        <br>
                        <img src="{{ asset('storage/'.$post->picture_path) }}"
                             class="img-thumbnail mb-3"
                             width="50%"
                             alt="Рисунок до новини">
                    @endif
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
