@extends('layouts.app')

@section('content')
    <div class="col">
        <div id="dbControls" class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h4 class="card-title">Панель адміністратора</h4>
            </div>
            <div class="card-body">
                <div class="row justify-content-center">
                    <div class="col-lg-3 col-md-4 col-sm-5">
                        <ul class="navbar-nav nav-pills">
                            <li class="nav-item">
                                <h5 class="card-title">Управління записами БД</h5>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link btn btn-outline-primary my-1"
                                   href="{{ route('admin.libraries.index') }}">
                                    1. Бібліотеки
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link btn btn-outline-primary my-1"
                                   href="{{ route('admin.printing-authors.index') }}">
                                    2. Автори видань
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link btn btn-outline-primary my-1"
                                   href="{{ route('admin.printing-genres.index') }}">
                                    3. Жанри видань
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link btn btn-outline-primary my-1"
                                   href="{{ route('admin.printing-pubhouses.index') }}">
                                    4. Видавництва
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link btn btn-outline-primary my-1"
                                   href="{{ route('admin.printing-types.index') }}">
                                    5. Типи видань
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link btn btn-outline-primary my-1"
                                   href="{{ route('admin.readercards.index') }}">
                                    6. Читацькі квитки
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link btn btn-outline-primary my-1"
                                   href="{{ route('admin.roles.index') }}">
                                    7. Ролі користувачів
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link btn btn-outline-primary my-1"
                                   href="{{ route('admin.users.index') }}">
                                    8. Користувачі
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link btn btn-outline-primary my-1"
                                   href="{{ route('admin.posts.index') }}">
                                    9. Новини
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link btn btn-outline-primary my-1"
                                   href="{{ route('admin.printings.index') }}">
                                    10. Друковані видання
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link btn btn-outline-primary my-1"
                                   href="{{ route('admin.printing-comments.index') }}">
                                    11. Коментарі до видань
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link btn btn-outline-primary my-1"
                                   href="{{ route('admin.bookshelves.index') }}">
                                    12. Книжні шафи
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link btn btn-outline-primary my-1"
                                   href="{{ route('admin.printing-genre-links.index') }}">
                                    13. Зв'язки "видання-жанр"
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link btn btn-outline-primary my-1"
                                   href="{{ route('admin.printing-registrations.index') }}">
                                    14. Реєстрації видань
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link btn btn-outline-primary my-1"
                                   href="{{ route('admin.printing-writing-offs.index') }}">
                                    15. Списання видань
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link btn btn-outline-primary my-1"
                                   href="{{ route('admin.library-services.index') }}">
                                    16. Позичання видань
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
@endsection
