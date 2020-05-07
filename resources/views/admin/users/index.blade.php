@extends('layouts.app')

@section('content')
    <div class="col">
        <div class="card">
            <div class="card-header bg-primary">
                <h5 class="text-white">Усі записи: користувачі</h5>
            </div>
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <td>Ідентифікатор</td>
                        <td>Роль</td>
                        <td>Ім'я</td>
                        <td>Заблоковано</td>
                        <td>Створено</td>
                        <td>Оновлено</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($usersPagination as $user)
                        @php /** @var \App\Models\user $user*/ @endphp
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->role->name }}</td>
                            <td>
                                <a class="card-link"
                                   href="{{ route('admin.users.edit', $user->id) }}">
                                    {{ $user->name }}
                                </a>
                            </td>
                            <td>
                                @if($user->is_banned)
                                    Так
                                @else
                                    Ні
                                @endif
                            </td>
                            <td>{{ $user->created_at }}</td>
                            <td>{{ $user->updated_at }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                @if($usersPagination->total() > $usersPagination->count())
                    <div class="card-footer">
                        {{ $usersPagination->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
