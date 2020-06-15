@extends('layouts.app')

@section('content')
    <div class="col">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h5 class="card-title">Перегляд запису про реєстрацію видання</h5>
            </div>
            @php /** @var \App\Models\PrintingRegistration $printingRegistration */ @endphp
            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    <h6 class="card-title">Зареєстровано видання</h6>
                    <h5 class="card-text">
                        <a class="card-link"
                           href="{{ route('printings.show', $printingRegistration->bookshelf->printing->id) }}">
                            {{ $printingRegistration->bookshelf->printing->title }}
                        </a>
                    </h5>
                </li>
                <li class="list-group-item">
                    <h6 class="card-title">Ідентифікатор місця зберігання видання (шафи)</h6>
                    <h5 class="card-text">
                        <a class="card-link"
                           href="{{ route('librarian.bookshelves.show', $printingRegistration->bookshelf_id) }}">
                            {{ $printingRegistration->bookshelf_id }}
                        </a>
                    </h5>
                </li>
                <li class="list-group-item">
                    <h6 class="card-title">Хто зареєстрував</h6>
                    <h5 class="card-text">
                        {{ $printingRegistration->user->name }}
                    </h5>
                </li>
                <li class="list-group-item">
                    <h6 class="card-title">Кількість екземплярів (зареєстровано початково)</h6>
                    <h5 class="card-text">
                        {{ $printingRegistration->exemplars_registered_initially }}
                    </h5>
                </li>
                <li class="list-group-item">
                    <h6 class="card-title">Коли зареєстровано</h6>
                    <h5 class="card-text">
                        {{ $printingRegistration->created_at }}
                    </h5>
                </li>
                <li class="list-group-item">
                    <h6 class="card-title">Примітки</h6>
                    <h5 class="card-text">
                        {{ $printingRegistration->notes ?? 'Приміток немає.' }}
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
                           value="{{ $printingRegistration->id }}">
                </div>
                <div class="form-group">
                    <label for="created_at">Створено</label>
                    <input class="form-control"
                           type="text"
                           id="created_at"
                           readonly
                           value="{{ $printingRegistration->created_at }}">
                </div>
                <div class="form-group">
                    <label for="updated_at">Оновлено</label>
                    <input class="form-control"
                           type="text"
                           id="updated_at"
                           readonly
                           value="{{ $printingRegistration->updated_at }}">
                </div>
            </div>
        </div>
    </div>
@endsection
