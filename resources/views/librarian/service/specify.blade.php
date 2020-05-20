@extends('layouts.app')

@section('content')
    <form class="col"
          method="POST"
          action="{{ route('librarian.service.confirm') }}">
        @csrf
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h4 class="card-title">Остаточні дані для позичання</h4>
            </div>
            <div class="card-body">
                @php /** @var \App\Models\Bookshelf $bookshelf */ @endphp
                <h5 class="card-title">Позичається видання: {{ $bookshelf->printing->title }}</h5>
                <h5 class="card-title">Автор: {{ $bookshelf->printing->author->name }}</h5>
                <h5 class="card-title">Видавництво: {{ $bookshelf->printing->pubhouse->name }}</h5>
                <h5 class="card-title">Рік публікації: {{ $bookshelf->printing->publication_year }}</h5>
                <h5 class="card-title">ISBN: {{ $bookshelf->printing->isbn ?? '-' }}</h5>
                <h5 class="card-title text-info">Екземплярів доступно: {{ $bookshelf->exemplars_in_stock }}</h5>
                <hr class="w-100">
                <div class="form-group">
                    <label for="exemplars_given">Кількість екземплярів до позичання</label>
                    <input class="form-control"
                           type="number"
                           id="exemplars_given"
                           name="exemplars_given"
                           min="1"
                           max="{{ $bookshelf->exemplars_in_stock }}"
                           required
                           value="{{ old('exemplars_given') }}">
                </div>
                <div class="form-group">
                    <label for="readercard_code">Код читацького квитка</label>
                    <input class="form-control"
                           type="text"
                           id="readercard_code"
                           name="readercard_code"
                           required
                           value="{{ old('readercard_code') }}">
                </div>
                <div class="form-group">
                    <label for="given_up_to">Видати строком до</label>
                    <input class="form-control"
                           type="date"
                           id="given_up_to"
                           name="given_up_to"
                           required
                           value="{{ old('given_up_to') }}">
                </div>
            </div>
            <div class="card-footer">
                <input type="hidden"
                       id="bookshelf_id"
                       name="bookshelf_id"
                       value="{{ old('bookshelf_id', $bookshelf->id) }}">
                <input type="hidden"
                       id="exemplars_in_stock"
                       name="exemplars_in_stock"
                       value="{{ old('exemplars_in_stock', $bookshelf->exemplars_in_stock) }}">
                <button class="btn btn-primary" type="submit">
                    Підтвердити видачу
                </button>
            </div>
        </div>
        @include('messages.result')
    </form>
@endsection
