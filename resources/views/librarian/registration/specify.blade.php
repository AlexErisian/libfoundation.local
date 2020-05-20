@extends('layouts.app')

@section('content')
    <form class="col"
          method="POST"
          action="{{ route('librarian.registration.confirm') }}">
        @csrf
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h4 class="card-title">Остаточні дані для реєстрації</h4>
            </div>
            <div class="card-body">
                @php /** @var \App\Models\Printing $printing */ @endphp
                <h5 class="card-title">Назва видання: {{ $printing->title }}</h5>
                <h5 class="card-title">Автор: {{ $printing->author->name }}</h5>
                <h5 class="card-title">Видавництво: {{ $printing->pubhouse->name }}</h5>
                <h5 class="card-title">Рік публікації: {{ $printing->publication_year }}</h5>
                <h5 class="card-title">ISBN: {{ $printing->isbn ?? '-' }}</h5>
                <hr class="w-100">
                <div class="form-group">
                    <label for="exemplars_registered_initially">Кількість екземплярів</label>
                    <input class="form-control"
                           type="number"
                           id="exemplars_registered_initially"
                           name="exemplars_registered_initially"
                           min="1"
                           required
                           value="{{ old('exemplars_registered_initially') }}">
                </div>
                <div class="form-group">
                    <label for="shelf_number">Номер шафи</label>
                    <input class="form-control"
                           type="number"
                           id="shelf_number"
                           name="shelf_number"
                           min="1"
                           required
                           value="{{ old('shelf_number') }}">
                </div>
                <div class="form-group">
                    <label for="shelf_floor">Номер полиці</label>
                    <input class="form-control"
                           type="number"
                           id="shelf_floor"
                           name="shelf_floor"
                           min="1"
                           required
                           value="{{ old('shelf_floor') }}">
                </div>
                <div class="form-group">
                    <label for="notes">Примітки для реєстрації (необов'язково)</label>
                    <textarea class="form-control"
                              id="notes"
                              name="notes"
                              rows="3">{{ old('notes') }}</textarea>
                </div>
            </div>
            <div class="card-footer">
                <input type="hidden"
                       id="printing_id"
                       name="printing_id"
                       value="{{ old('printing_id', $printing->id) }}">
                <button class="btn btn-primary" type="submit">
                    Підтвердити видачу
                </button>
            </div>
        </div>
        @include('messages.result')
    </form>
@endsection
