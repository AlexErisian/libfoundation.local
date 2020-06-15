@extends('layouts.app')

@section('content')
    <div class="col">
        <div class="card">
            <div class="card-header bg-primary">
                <h5 class="text-white">Усі записи: реєстрації видань</h5>
            </div>
            <div class="card-body overflow-auto">
                <table class="table table-hover overflow-auto">
                    <thead>
                    <tr>
                        <td>Ідентифікатор</td>
                        <td>Користувач</td>
                        <td>Ідентифікатор книжної шафи</td>
                        <td>Екземплярів зареєстровано</td>
                        <td>Створено</td>
                        <td>Оновлено</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($registrationsPagination as $registration)
                        @php /** @var \App\Models\PrintingRegistration $registration*/ @endphp
                        <tr>
                            <td>
                                <a class="card-link"
                                   href="{{ route('admin.printing-registrations.edit', $registration->id) }}">
                                    {{ $registration->id }}
                                </a>
                            </td>
                            <td>
                                <a class="card-link"
                                   href="{{ route('admin.users.edit', $registration->user->id) }}">
                                    {{ $registration->user->name }}
                                </a>
                            </td>
                            <td>
                                <a class="card-link"
                                   href="{{ route('admin.bookshelves.edit', $registration->bookshelf_id) }}">
                                    {{ $registration->bookshelf_id }}
                                </a>
                            </td>
                            <td>{{ $registration->exemplars_registered_initially }}</td>
                            <td>{{ $registration->created_at }}</td>
                            <td>{{ $registration->updated_at }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                @if($registrationsPagination->total() > $registrationsPagination->count())
                    {{ $registrationsPagination->links() }}
                @endif
                <button class="btn btn-outline-primary float-right"
                        onclick="window.print();">
                    Надрукувати звіт
                </button>
            </div>
        </div>
    </div>
@endsection
