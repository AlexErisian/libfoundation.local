@extends('layouts.app')

@section('content')
    <div class="col">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h5 class="card-title">Перегляд запису про зберігання видання</h5>
            </div>
            @php /** @var \App\Models\Bookshelf $bookshelf */ @endphp
            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    <h6 class="card-title">Зберігається видання</h6>
                    <h5 class="card-text">
                        <a class="card-link"
                           href="{{--{{ route('') }}--}}">
                            {{ $bookshelf->printing->title }}
                        </a>
                    </h5>
                </li>
                <li class="list-group-item">
                    <h6 class="card-title">Номер шафи / номер полиці</h6>
                    <h5 class="card-text">
                        {{ $bookshelf->shelf_number }}
                        / {{ $bookshelf->shelf_floor }}
                    </h5>
                </li>
                <li class="list-group-item">
                    <h6 class="card-title">Кількість екземплярів в наявності /
                        всього зареєстровано </h6>
                    <h5 class="card-text">
                        {{ $bookshelf->exemplars_in_stock }}
                        / {{ $bookshelf->exemplars_registered }}
                    </h5>
                </li>
                <li class="list-group-item">
                    <h6 class="card-title">Примітки</h6>
                    <h5 class="card-text">
                        {{ $bookshelf->notes ?? 'Приміток немає.' }}
                    </h5>
                </li>
            </ul>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="card-title">Статистичні дані</h5>
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
                <div class="form-group">
                    <label for="updated_at">Видалено</label>
                    <input class="form-control"
                           type="text"
                           id="updated_at"
                           readonly
                           value="{{ $bookshelf->deleted_at }}">
                </div>
            </div>
        </div>
    </div>
@endsection
