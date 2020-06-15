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
                   value="{{ $bookshelf->id }}">
        </div>
        <div class="form-group">
            <label for="created_at">Створено</label>
            <input class="form-control"
                   type="text"
                   id="created_at"
                   readonly
                   value="{{ $bookshelf->created_at }}">
        </div>
        <div class="form-group">
            <label for="updated_at">Оновлено</label>
            <input class="form-control"
                   type="text"
                   id="updated_at"
                   readonly
                   value="{{ $bookshelf->updated_at }}">
        </div>
    </div>
    <div class="card-footer">
        <form class="w-100"
              method="POST"
              action="{{ route('admin.bookshelves.destroy', $bookshelf->id) }}">
            @method('DELETE')
            @csrf
            <button class="btn btn-outline-danger"
                    type="submit">
                Видалити запис
            </button>
        </form>
    </div>
</div>
