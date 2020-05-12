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
                    <label for="library_id">Належить до бібліотеки</label>
                    <select class="form-control"
                            id="library_id"
                            name="library_id"
                            required>
                        @foreach($libraryOptions as $library)
                            <option value="{{ $library->id }}">
                                {{ $library->id.'. '.$library->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="printing_id">Зберігає видання</label>
                    <select class="form-control"
                            id="printing_id"
                            name="printing_id"
                            required>
                        @foreach($printingOptions as $printing)
                            <option value="{{ $printing->id }}">
                                {{ $printing->id.'. '.$printing->title }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="exemplars_registered">Екземплярів зареєстровано</label>
                    <input class="form-control"
                           type="number"
                           id="exemplars_registered"
                           name="exemplars_registered"
                           required
                           min="1"
                           value="{{ old('exemplars_registered') }}">
                </div>
                <div class="form-group">
                    <label for="exemplars_in_stock">Екземплярів зберігається</label>
                    <input class="form-control"
                           type="number"
                           id="exemplars_in_stock"
                           name="exemplars_in_stock"
                           required
                           min="0"
                           value="{{ old('exemplars_in_stock') }}">
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
                           value="{{ old('shelf_number') }}">
                </div>
                <div class="form-group">
                    <label for="shelf_floor">Номер полиці шафи</label>
                    <input class="form-control"
                           type="number"
                           id="shelf_floor"
                           name="shelf_floor"
                           min="1"
                           value="{{ old('shelf_floor') }}">
                </div>
                <div class="form-group">
                    <label for="notes">Примітки</label>
                    <textarea class="form-control"
                              id="notes"
                              name="notes"
                              rows="3">{{ old('notes') }}</textarea>
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <button class="btn btn-primary" type="submit">Зберегти</button>
    </div>
</div>
