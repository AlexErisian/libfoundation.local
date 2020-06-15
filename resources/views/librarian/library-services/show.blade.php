@extends('layouts.app')

@section('content')
    <div class="col">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h5 class="card-title">Перегляд запису про позичене видання</h5>
            </div>
            @php /** @var \App\Models\LibraryService $libraryService */ @endphp
            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    <h6 class="card-title">Позичено видання</h6>
                    <h5 class="card-text">
                        <a class="card-link"
                           href="{{ route('printings.show', $libraryService->bookshelf->printing->id) }}">
                            {{ $libraryService->bookshelf->printing->title }}
                        </a>
                    </h5>
                </li>
                <li class="list-group-item">
                    <h6 class="card-title">Ідентифікатор місця зберігання видання (шафи)</h6>
                    <h5 class="card-text">
                        <a class="card-link"
                           href="{{ route('librarian.bookshelves.show', $libraryService->bookshelf_id) }}">
                            {{ $libraryService->bookshelf_id }}
                        </a>
                    </h5>
                </li>
                <li class="list-group-item">
                    <h6 class="card-title">Хто позичив</h6>
                    <h5 class="card-text">
                        {{ $libraryService->user->name }}
                    </h5>
                </li>
                <li class="list-group-item">
                    <h6 class="card-title">Кількість позичених екземплярів</h6>
                    <h5 class="card-text">
                        {{ $libraryService->exemplars_given }}
                    </h5>
                </li>
                <li class="list-group-item">
                    <h6 class="card-title">Коли позичено</h6>
                    <h5 class="card-text">
                        {{ $libraryService->created_at }}
                    </h5>
                </li>
                <li class="list-group-item">
                    <h6 class="card-title">Позичено строком до</h6>
                    <h5 class="card-text">
                        {{ $libraryService->given_up_to }}
                    </h5>
                </li>
                <li class="list-group-item">
                    <h6 class="card-title">Коли повернено</h6>
                    <h5 class="card-text">
                        {{ $libraryService->returned_at ?? 'Ще не повернено.' }}
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
                           value="{{ $libraryService->id }}">
                </div>
                <div class="form-group">
                    <label for="created_at">Створено</label>
                    <input class="form-control"
                           type="text"
                           id="created_at"
                           readonly
                           value="{{ $libraryService->created_at }}">
                </div>
                <div class="form-group">
                    <label for="updated_at">Оновлено</label>
                    <input class="form-control"
                           type="text"
                           id="updated_at"
                           readonly
                           value="{{ $libraryService->updated_at }}">
                </div>
            </div>
        </div>
    </div>
@endsection
