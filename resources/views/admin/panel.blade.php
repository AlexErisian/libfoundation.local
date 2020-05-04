@extends('layouts.app')

@section('content')
    <div class="col">
        <div id="dbControls" class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h3>Управління записами бази даних</h3>
            </div>
            <div class="card-body">
                <a class="btn btn-link"
                   href="{{ route('admin.printing-authors.index') }}">
                    1. Автори видань
                </a>
                <a class="btn btn-link"
                   href="{{ route('admin.printing-authors.index') }}">
                    2. Автори видань
                </a>
                <a class="btn btn-link"
                   href="{{ route('admin.printing-authors.index') }}">
                    3. Автори видань
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
