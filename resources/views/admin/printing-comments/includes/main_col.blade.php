@php
    /** @var \App\Models\PrintingComment $comment */
@endphp
<div class="card">
    <div class="card-header bg-primary">
        <h5 class="text-white">Редагування запису: користувач</h5>
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
                    <label for="text">Текст коментаря</label>
                    <textarea class="form-control"
                              id="text"
                              name="text"
                              required
                              maxlength="1000"
                              rows="3">{{ old('text', $comment->text) }}</textarea>
                </div>
            </div>
            <div id="addData" class="tab-pane" role="tabpanel">
                <div class="form-group">
                    <label for="printing_title">До видання</label>
                    <input class="form-control"
                           type="text"
                           id="printing_title"
                           readonly
                           value="{{ $comment->printing->title }}">
                </div>
                <div class="form-group">
                    <label for="user_name">Користувач-автор</label>
                    <input class="form-control"
                           type="text"
                           id="user_name"
                           readonly
                           value="{{ $comment->user->name }}">
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <button class="btn btn-primary" type="submit">Зберегти</button>
    </div>
</div>
