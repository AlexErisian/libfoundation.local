<div class="card">
    <div class="card-header bg-primary">
        <h5 class="text-white">Створення запису: автор видань</h5>
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
                    <label for="name">Ім'я</label>
                    <input class="form-control"
                           type="text"
                           id="name"
                           name="name"
                           required
                           value="{{ old('name') }}">
                </div>
            </div>
            <div id="addData" class="tab-pane" role="tabpanel">
                <div class="form-group">
                    <label for="born_in">Народився</label>
                    <input class="form-control"
                           type="date"
                           id="born_in"
                           name="born_in"
                           value="{{ old('born_in') }}">
                </div>
                <div class="form-group">
                    <label for="died_in">Помер</label>
                    <input class="form-control"
                           type="date"
                           id="died_in"
                           name="died_in"
                           value="{{ old('died_in') }}">
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
