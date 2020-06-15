@extends('layouts.app')

@section('content')
    <div class="col">
        <div id="dbControls" class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h4 class="card-title">Панель адміністратора</h4>
            </div>
            <div class="card-body">
                <h5 class="card-title">Управління записами БД</h5>
                <div class="row row-cols-lg-4">
                    <a class="nav-link btn btn-outline-primary m-2"
                       href="{{ route('admin.libraries.index') }}">
                        1. Бібліотеки
                    </a>
                    <a class="nav-link btn btn-outline-primary m-2"
                       href="{{ route('admin.printing-authors.index') }}">
                        2. Автори видань
                    </a>
                    <a class="nav-link btn btn-outline-primary m-2"
                       href="{{ route('admin.printing-genres.index') }}">
                        3. Жанри видань
                    </a>
                    <a class="nav-link btn btn-outline-primary m-2"
                       href="{{ route('admin.printing-pubhouses.index') }}">
                        4. Видавництва
                    </a>
                    <a class="nav-link btn btn-outline-primary m-2"
                       href="{{ route('admin.printing-types.index') }}">
                        5. Типи видань
                    </a>
                    <a class="nav-link btn btn-outline-primary m-2"
                       href="{{ route('admin.readercards.index') }}">
                        6. Читацькі квитки
                    </a>
                    <a class="nav-link btn btn-outline-primary m-2"
                       href="{{ route('admin.roles.index') }}">
                        7. Ролі користувачів
                    </a>
                    <a class="nav-link btn btn-outline-primary m-2"
                       href="{{ route('admin.users.index') }}">
                        8. Користувачі
                    </a>
                    <a class="nav-link btn btn-outline-primary m-2"
                       href="{{ route('admin.posts.index') }}">
                        9. Новини
                    </a>
                    <a class="nav-link btn btn-outline-primary m-2"
                       href="{{ route('admin.printings.index') }}">
                        10. Друковані видання
                    </a>
                    <a class="nav-link btn btn-outline-primary m-2"
                       href="{{ route('admin.printing-comments.index') }}">
                        11. Коментарі до видань
                    </a>
                    <a class="nav-link btn btn-outline-primary m-2"
                       href="{{ route('admin.bookshelves.index') }}">
                        12. Книжні шафи (зберігання видань)
                    </a>
                    <a class="nav-link btn btn-outline-primary m-2"
                       href="{{ route('admin.printing-genre-links.index') }}">
                        13. Зв'язки "видання-жанр"
                    </a>
                    <a class="nav-link btn btn-outline-primary m-2"
                       href="{{ route('admin.printing-registrations.index') }}">
                        14. Реєстрації видань
                    </a>
                    <a class="nav-link btn btn-outline-primary m-2"
                       href="{{ route('admin.printing-writing-offs.index') }}">
                        15. Списання видань
                    </a>
                    <a class="nav-link btn btn-outline-primary m-2"
                       href="{{ route('admin.library-services.index') }}">
                        16. Позичання видань
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
