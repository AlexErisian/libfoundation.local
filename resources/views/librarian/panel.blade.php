@extends('layouts.app')

@section('content')
    <div class="col">
        @include('messages.result')
        @if(empty(session('working_library_id')))
            @include('librarian.includes.set-lib')
        @else

            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="card-title">Панель бібліотекара</h4>
                    <h5 class="card-subtitle">
                        Робоча бібліотека: {{ session('working_library_name') }}
                    </h5>
                    @include('librarian.includes.unset-lib')
                </div>
                <div class="card-body">
                    <h5 class="card-title">Управління виданнями</h5>
                    <ul class="nav">
                        <li class="nav-item m-1">
                            <a class="nav-link btn btn-outline-primary"
                               href="{{ route('librarian.service.options') }}">
                                Позичити видання читачеві
                            </a>
                        </li>
                        <li class="nav-item m-1">
                            <a class="nav-link btn btn-outline-primary"
                               href="{{ route('librarian.service.enter-code') }}">
                                Повернути видання до сховища
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn btn-outline-success m-1"
                               href="{{ route('librarian.registration.enter-title') }}">
                                Зареєструвати нове видання
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn btn-outline-danger m-1"
                               href="{{ route('librarian.registration.write-off') }}">
                                Списати видання
                            </a>
                        </li>
                    </ul>
                    <hr class="w-100">
                    <h5 class="card-title mt-2">Переглянути облікові дані</h5>
                    <ul class="nav">
                        <li class="nav-item">
                            <a class="nav-link btn btn-outline-secondary m-1"
                               href="{{ route('librarian.bookshelves.index') }}">
                                Перелік видань, що зберігаються
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn btn-outline-secondary m-1"
                               href="{{ route('librarian.library-services.index') }}">
                                Перелік позичених видань
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn btn-outline-secondary m-1"
                               href="{{ route('librarian.printing-registrations.index') }}">
                                Перелік записів про реєстрацію видань
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn btn-outline-secondary m-1"
                               href="{{ route('librarian.printing-writing-offs.index') }}">
                                Перелік записів про списання видань
                            </a>
                        </li>
                    </ul>
                    <hr class="w-100">
                    <h5 class="card-title mt-2">Додаткові дії</h5>
                    <ul class="nav">
                        <li class="nav-item">
                            <a class="nav-link btn btn-outline-secondary m-1"
                               href="">
                                Видати читацький квиток
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn btn-outline-secondary m-1"
                               href="">
                                Перевірити заборгованість читача
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        @endif
    </div>
@endsection
