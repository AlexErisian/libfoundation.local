<form class="col"
      method="POST"
      action="{{ route('librarian.set-lib') }}">
    @csrf
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="card-title m-0">Вибір робочої бібліотеки</h4>
        </div>
        <div class="card-body">
            <div class="form-group">
                <label for="library_id">Список бібліотек системи</label>
                <select class="form-control"
                        id="library_id"
                        name="library_id">
                    @foreach($libraryOptions as $library)
                        <option value="{{ $library->id }}">
                            {{ $library->id.'. '.$library->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="card-footer">
            <button class="btn btn-primary" type="submit">Вибрати</button>
        </div>
    </div>
</form>
