@extends('layouts.app')

@section('content')
    <div class="col">
        <div class="card">
            <div class="card-header bg-primary">
                <h5 class="text-white">Усі записи: користувачі</h5>
                <a class="btn btn-secondary d-print-none"
                   href="{{ route('admin.users.create') }}">
                    Створити новий
                </a>
            </div>
            <div class="card-body overflow-auto">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <td>Ідентифікатор</td>
                        <td>Ім'я</td>
                        <td>Роль</td>
                        <td>Читацький квиток</td>
                        <td>Заблоковано</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($usersPagination as $user)
                        @php /** @var \App\Models\User $user*/ @endphp
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>
                                <a class="card-link"
                                   href="{{ route('admin.users.edit', $user->id) }}">
                                    {{ $user->name }}
                                </a>
                            </td>
                            <td>{{ $user->role->name }}</td>
                            <td>
                                <a class="card-link"
                                   href="{{ route('admin.readercards.edit', $user->readercard->id) }}">
                                    {{ $user->readercard->code }}
                                </a>
                            </td>
                            <td>
                                @if($user->is_banned)
                                    Так
                                @else
                                    Ні
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                @if($usersPagination->total() > $usersPagination->count())
                    {{ $usersPagination->links() }}
                @endif
                <button class="btn btn-outline-primary float-right"
                        onclick="window.print();">
                    Надрукувати звіт
                </button>
            </div>
        </div>
    </div>
@endsection
