@extends('layouts.app')

@section('content')
    <div class="col">
        <div class="card">
            <div class="card-header bg-primary">
                <h5 class="text-white">Усі записи: реєстрації видань</h5>
            </div>
            <div class="card-body">
                <table class="table table-hover overflow-auto">
                    <thead>
                    <tr>
                        <td>Ідентифікатор</td>
                        <td>Користувач</td>
                        <td>Ідентифікатор книжної шафи</td>
                        <td class="d-none d-md-table-cell">Екземплярів зареєстровано</td>
                        <td class="d-none d-md-table-cell">Створено</td>
                        <td class="d-none d-md-table-cell">Оновлено</td>
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
                            <td class="d-none d-md-table-cell">{{ $registration->exemplars_registered_initially }}</td>
                            <td class="d-none d-md-table-cell">{{ $registration->created_at }}</td>
                            <td class="d-none d-md-table-cell">{{ $registration->updated_at }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            @if($registrationsPagination->total() > $registrationsPagination->count())
                <div class="card-footer">
                    {{ $registrationsPagination->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
