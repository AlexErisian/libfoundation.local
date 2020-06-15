@extends('layouts.app')

@section('content')
    <div class="col">
        <div class="card">
            <div class="card-header bg-primary">
                <h5 class="text-white">Усі записи: ролі користувачів</h5>
            </div>
            <div class="card-body overflow-auto">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <td>Ідентифікатор</td>
                        <td>Назва</td>
                        <td>Створено</td>
                        <td>Оновлено</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($roles as $role)
                        @php /** @var \App\Models\Role $role*/ @endphp
                        <tr>
                            <td>{{ $role->id }}</td>
                            <td>{{ $role->name }}</td>
                            <td>{{ $role->created_at }}</td>
                            <td>{{ $role->updated_at }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                <p class="alert alert-warning m-0">
                    Увага! Змінення записів ролей призведе до збоїв роботи додатку.
                </p>
            </div>
        </div>
    </div>
@endsection
