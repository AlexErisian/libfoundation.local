<div class="card">
    <div class="card-header bg-primary">
        <h5 class="text-white">Редагування запису: бібліотека</h5>
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
                    <label for="name">Назва</label>
                    <input class="form-control"
                           type="text"
                           id="name"
                           name="name"
                           required
                           value="{{ old('name', $library->name) }}">
                </div>
                <div class="form-group">
                    <label for="address">Адреса</label>
                    <input class="form-control"
                           type="text"
                           id="address"
                           name="address"
                           required
                           value="{{ old('address', $library->address) }}">
                </div>
            </div>
            <div id="addData" class="tab-pane" role="tabpanel">
                <div class="form-group">
                    <label for="notes">Примітки</label>
                    <textarea class="form-control"
                              id="notes"
                              name="notes"
                              rows="3">{{ old('notes', $library->notes) }}</textarea>
                </div>
                <div class="form-group">
                    <label for="picture">Фотографія будівлі</label>
                    @if(!empty($library->picture_path))
                        <br>
                        <img src="{{ asset('storage/'.$library->picture_path) }}"
                             class="img-thumbnail mb-3"
                             width="50%"
                             alt="Зображення бібліотеки">
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
        <button class="btn btn-primary"
                form="editItem"
                type="submit">
            Зберегти
        </button>
    </div>
</div>
