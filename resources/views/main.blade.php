@extends('layouts.app')

@section('content')
    <div class="col">
        <div class="card shadow-sm">
            <div id="news" class="card-header bg-primary text-white">
                <h3>Новини</h3>
            </div>
            <div class="card-body">
                NEWS<br>
            </div>
            <div class="card-footer">
                <a class="card-link"
                   href="">
                    Подивитися усі новини
                </a>
            </div>
            <div id="popularPrintings" class="card-header bg-primary text-white">
                <h3>Популярні видання</h3>
            </div>
            <div class="card-body">
                PRINTINGS<br>
            </div>
            <div class="card-footer">
                <a class="card-link"
                   href="">
                    Подивитися усі видання за популярністю
                </a>
            </div>
        </div>
    </div>
    <div class="col-lg-2 d-none d-lg-block px-0">
        <div class="card shadow-sm">
            <div class="card-body">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link"
                           href="#news">
                            Новини
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"
                           href="#popularPrintings">
                            Популярні видання
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endsection
