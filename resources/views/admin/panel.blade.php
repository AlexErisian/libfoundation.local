@extends('layouts.app')

@section('content')
    <div class="col">
        <div id="dbControls" class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h3>Управління записами бази даних</h3>
            </div>
            <div class="card-body">
                <a class="btn btn-link"
                   href="{{ route('admin.libraries.index') }}">
                    1. Бібліотеки
                </a>
                <a class="btn btn-link"
                   href="{{ route('admin.printing-authors.index') }}">
                    2. Автори видань
                </a>
                <a class="btn btn-link"
                   href="{{ route('admin.printing-genres.index') }}">
                    3. Жанри видань
                </a>
                <a class="btn btn-link"
                   href="{{ route('admin.printing-pubhouses.index') }}">
                    4. Видавництва
                </a>
                <a class="btn btn-link"
                   href="{{ route('admin.printing-types.index') }}">
                    5. Типи видань
                </a>
                <a class="btn btn-link"
                   href="{{ route('admin.readercards.index') }}">
                    6. Читацькі квитки
                </a>
                <a class="btn btn-link"
                   href="{{ route('admin.roles.index') }}">
                    7. Ролі користувачів
                </a>
                <a class="btn btn-link"
                   href="{{ route('admin.users.index') }}">
                    8. Користувачі
                </a>
                <a class="btn btn-link"
                   href="{{ route('admin.posts.index') }}">
                    9. Новини
                </a>
                <a class="btn btn-link"
                   href="{{ route('admin.printings.index') }}">
                    10. Друковані видання
                </a>
                <a class="btn btn-link"
                   href="{{ route('admin.printing-comments.index') }}">
                    11. Коментарі до видань
                </a>
                <a class="btn btn-link"
                   href="{{ route('admin.bookshelves.index') }}">
                    12. Книжні шафи
                </a>
                <a class="btn btn-link"
                   href="{{ route('admin.printing-genre-links.index') }}">
                    13. Зв'язки "видання-жанр"
                </a>
                <a class="btn btn-link"
                   href="{{ route('admin.printing-registrations.index') }}">
                    14. Реєстрації видань
                </a>
                <a class="btn btn-link"
                   href="{{ route('admin.printing-writing-offs.index') }}">
                    15. Списання видань
                </a>
                <a class="btn btn-link"
                   href="{{ route('admin.library-services.index') }}">
                    16. Позичання видань
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
                           href="#dbControls">
                            Управління записами БД
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endsection
