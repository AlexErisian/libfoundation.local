@php /** @var \App\Models\Bookshelf $bookshelf */ @endphp
<div class="card">
    <div class="card-header bg-primary">
        <h5 class="text-white">Редагування запису: книжна шафа</h5>
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
                    <label for="library_name">Належить до бібліотеки</label>
                    <input class="form-control"
                           type="text"
                           id="library_name"
                           readonly
                           value="{{ $bookshelf->library->name }}">
                </div>
                <div class="form-group">
                    <label for="printing_title">Зберігає видання</label>
                    <input class="form-control"
                           type="text"
                           id="printing_title"
                           readonly
                           value="{{ $bookshelf->printing->title }}">
                </div>
                <div class="form-group">
                    <label for="exemplars_registered">Екземплярів зареєстровано</label>
                    <input class="form-control"
                           type="number"
                           id="exemplars_registered"
                           name="exemplars_registered"
                           required
                           min="1"
                           value="{{ old('exemplars_registered', $bookshelf->exemplars_registered) }}">
                </div>
                <div class="form-group">
                    <label for="exemplars_in_stock">Екземплярів зберігається</label>
                    <input class="form-control"
                           type="number"
                           id="exemplars_in_stock"
                           name="exemplars_in_stock"
                           required
                           min="0"
                           value="{{ old('exemplars_in_stock', $bookshelf->exemplars_in_stock) }}">
                </div>
            </div>
            <div id="addData" class="tab-pane" role="tabpanel">
                <div class="form-group">
                    <label for="shelf_number">Номер шафи</label>
                    <input class="form-control"
                           type="number"
                           id="shelf_number"
                           name="shelf_number"
                           min="1"
                           value="{{ old('shelf_number', $bookshelf->shelf_number) }}">
                </div>
                <div class="form-group">
                    <label for="shelf_floor">Номер полиці шафи</label>
                    <input class="form-control"
                           type="number"
                           id="shelf_floor"
                           name="shelf_floor"
                           min="1"
                           value="{{ old('shelf_floor', $bookshelf->shelf_floor) }}">
                </div>
                <div class="form-group">
                    <label for="notes">Примітки</label>
                    <textarea class="form-control"
                              id="notes"
                              name="notes"
                              rows="3">{{ old('notes', $bookshelf->notes) }}</textarea>
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <button class="btn btn-primary" type="submit">Зберегти</button>
    </div>
</div>
