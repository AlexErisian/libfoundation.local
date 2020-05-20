@extends('layouts.app')

@section('content')
    <div class="col">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h5 class="card-title">Перегляд запису про списання видання</h5>
            </div>
            @php /** @var \App\Models\PrintingWritingOff $printingWritingOff */ @endphp
            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    <h6 class="card-title">Списано видання</h6>
                    <h5 class="card-text">
                        <a class="card-link"
                           href="{{--{{ route('') }}--}}">
                            {{ $printingWritingOff->bookshelf->printing->title }}
                        </a>
                    </h5>
                </li>
                <li class="list-group-item">
                    <h6 class="card-title">Ідентифікатор місця зберігання видання (шафи)</h6>
                    <h5 class="card-text">
                        <a class="card-link"
                           href="{{ route('librarian.bookshelves.show', $printingWritingOff->bookshelf_id) }}">
                            {{ $printingWritingOff->bookshelf_id }}
                        </a>
                    </h5>
                </li>
                <li class="list-group-item">
                    <h6 class="card-title">Хто списав</h6>
                    <h5 class="card-text">
                        {{ $printingWritingOff->user->name }}
                    </h5>
                </li>
                <li class="list-group-item">
                    <h6 class="card-title">Кількість списаних екземплярів</h6>
                    <h5 class="card-text">
                        {{ $printingWritingOff->exemplars_written_off }}
                    </h5>
                </li>
                <li class="list-group-item">
                    <h6 class="card-title">Коли списано</h6>
                    <h5 class="card-text">
                        {{ $printingWritingOff->created_at }}
                    </h5>
                </li>
                <li class="list-group-item">
                    <h6 class="card-title">Примітки</h6>
                    <h5 class="card-text">
                        {{ $printingWritingOff->notes ?? 'Приміток немає.' }}
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
                           value="{{ $printingWritingOff->id }}">
                </div>
                <div class="form-group">
                    <label for="created_at">Створено</label>
                    <input class="form-control"
                           type="text"
                           id="created_at"
                           readonly
                           value="{{ $printingWritingOff->created_at }}">
                </div>
                <div class="form-group">
                    <label for="updated_at">Оновлено</label>
                    <input class="form-control"
                           type="text"
                           id="updated_at"
                           readonly
                           value="{{ $printingWritingOff->updated_at }}">
                </div>
            </div>
        </div>
    </div>
@endsection
