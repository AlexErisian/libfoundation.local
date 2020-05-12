@php /** @var \App\Models\PrintingRegistration $registration */ @endphp
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
                    <label for="bookshelf_id">Зареєстровано у бібліотеці</label>
                    <input class="form-control"
                           type="text"
                           id="bookshelf_id"
                           readonly
                           value="{{ $registration->bookshelf->library->name }}">
                </div>
                <div class="form-group">
                    <label for="bookshelf_id">Видання</label>
                    <input class="form-control"
                           type="text"
                           id="bookshelf_id"
                           readonly
                           value="{{ $registration->bookshelf->printing->title }}">
                </div>
                <div class="form-group">
                    <label for="printing_title">Зареєстровано користувачем</label>
                    <input class="form-control"
                           type="text"
                           id="printing_title"
                           readonly
                           value="{{ $registration->user->name }}">
                </div>
                <div class="form-group">
                    <label for="exemplars_registered_initially">Екземплярів зареєстровано</label>
                    <input class="form-control"
                           type="number"
                           id="exemplars_registered_initially"
                           name="exemplars_registered_initially"
                           required
                           min="1"
                           value="{{ old('exemplars_registered_initially', $registration->exemplars_registered_initially) }}">
                </div>
            </div>
            <div id="addData" class="tab-pane" role="tabpanel">
                <div class="form-group">
                    <label for="notes">Примітки</label>
                    <textarea class="form-control"
                              id="notes"
                              name="notes"
                              rows="3">{{ old('notes', $registration->notes) }}</textarea>
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <button class="btn btn-primary" type="submit">Зберегти</button>
    </div>
</div>
