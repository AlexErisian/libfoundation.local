@extends('layouts.app')

@section('content')
    <div class="col">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h4 class="card-title">Пошук інсуючого видання у системі</h4>
            </div>
            <div class="card-body">
                <form class="w-100"
                      method="POST"
                      action="{{ route('librarian.registration.options') }}">
                    @csrf
                    <div class="form-group">
                        <label for="printing_title">Назва видання (або фраза у назві)</label>
                        <input class="form-control"
                               type="text"
                               id="printing_title"
                               name="printing_title"
                               required
                               value="{{ old('printing_title') }}">
                    </div>
                    <button class="btn btn-primary"
                            type="submit">
                        Знайти видання
                    </button>
                </form>
            </div>
            <div class="card-footer">
                <a class="btn btn-secondary mr-1"
                   href="{{--{{ route('') }}--}}">
                    Вивести перелік усіх видань у системі
                </a>
                <a class="btn btn-secondary"
                   href="{{--{{ route('') }}--}}">
                    Перейти до створення нового запису про видання
                </a>
            </div>
        </div>
        @include('messages.result')
    </div>
@endsection
