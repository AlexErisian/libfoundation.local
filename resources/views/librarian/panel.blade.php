@extends('layouts.app')

@section('content')
    @if(empty(session('working_library_id')))
        @include('librarian.includes.set-lib')
    @else
        <div class="col">
            @include('messages.result')
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="card-title">Панель бібліотекара</h4>
                    <h5 class="card-subtitle">
                        Робоча бібліотека: {{ session('working_library_name') }}
                    </h5>
                    @include('librarian.includes.unset-lib')
                </div>
                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-lg-3 col-md-4 col-sm-5">
                            <ul class="navbar-nav nav-pills">
                                <li class="nav-item">
                                    <h5 class="card-title">Управління виданнями</h5>
                                </li>
                                <li class="nav-item my-1">
                                    <a class="nav-link btn btn-outline-primary"
                                       href="{{ route('librarian.service.options') }}">
                                        Позичити видання читачеві
                                    </a>
                                </li>
                                <li class="nav-item my-1">
                                    <a class="nav-link btn btn-outline-primary"
                                       href="">
                                        Повернути видання до сховища
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link btn btn-outline-success my-1"
                                       href="">
                                        Зареєструвати нове видання
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link btn btn-outline-danger my-1"
                                       href="">
                                        Списати видання
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <h5 class="card-title mt-2">Переглянути
                                        записи</h5>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link btn btn-outline-secondary my-1"
                                       href="">
                                        Видання, що зберігаються
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link btn btn-outline-secondary my-1"
                                       href="">
                                        Позичені видання
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link btn btn-outline-secondary my-1"
                                       href="">
                                        Реєстрації видань
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link btn btn-outline-secondary my-1"
                                       href="">
                                        Списання видань
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <h5 class="card-title mt-2">Додаткові
                                        дії</h5>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link btn btn-outline-secondary my-1"
                                       href="">
                                        Видати читацький квиток
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link btn btn-outline-secondary my-1"
                                       href="">
                                        Перевірити заборгованість
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="col">
                            Stat content
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
