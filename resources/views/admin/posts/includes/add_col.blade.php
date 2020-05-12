<div class="card">
    <div class="card-header bg-primary">
        <h5 class="text-white">Статистичні дані</h5>
    </div>
    <div class="card-body">
        <div class="form-group">
            <label for="id">Ідентифікатор</label>
            <input class="form-control"
                   type="text"
                   id="id"
                   readonly
                   value="{{ $post->id }}">
        </div>
        <div class="form-group">
            <label for="created_at">Створено</label>
            <input class="form-control"
                   type="text"
                   id="created_at"
                   readonly
                   value="{{ $post->created_at }}">
        </div>
        <div class="form-group">
            <label for="updated_at">Оновлено</label>
            <input class="form-control"
                   type="text"
                   id="updated_at"
                   readonly
                   value="{{ $post->updated_at }}">
        </div>
        <div class="form-group">
            <label for="published_at">Опубліковано</label>
            <input class="form-control"
                   type="text"
                   id="published_at"
                   readonly
                   value="{{ $post->published_at }}">
        </div>
    </div>
</div>
