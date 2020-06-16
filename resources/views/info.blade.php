@extends('layouts.app')
@php
    /** @var \App\Models\Post $post */
    /** @var \App\Models\Printing $printing */
@endphp
@section('content')
    <div class="col">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h4 class="card-title m-0">Інформація про систему</h4>
            </div>
            <div class="card-body">
                <p class="card-text">
                    Сайт &laquo;{{ config('app.name') }}&raquo; створено для
                    <b>інформаційної системи обліку друкованих видань</b>
                    для мережі бібліотек у межах міста.
                    Система використовує єдиний читацький квиток для надання
                    послуг.<br>
                    Ви можете звернутися до будь-якої з
                    <a href="{{ route('libraries.index') }}">бібліотек</a>
                    для надання додаткової інформації.
                </p>
                <div class="alert alert-info">
                    <p>При розробці були використані наступні технології:</p>
                    <ul class="m-0">
                        <li>
                            <a href="https://laravel.com/docs/7.x">
                                Laravel Framework 7;
                            </a>
                        </li>
                        <li>
                            <a href="https://getbootstrap.com/docs/4.4/getting-started/introduction/">
                                Bootstrap 4;
                            </a>
                        </li>
                        <li>
                            <a href="https://mariadb.org/documentation/">
                                MariaDB 10.
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
