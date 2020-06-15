@extends('layouts.app')

@section('content')
    <div class="col">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h4 class="card-title">Усі записи про реєстрації видань у бібліотеці</h4>
                <h5 class="card-subtitle">
                    Робоча бібліотека: {{ session('working_library_name') }}
                </h5>
            </div>
            <div class="card-body overflow-auto">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <td>Ідентифікатор</td>
                        <td>Бібліотекар</td>
                        <td>Ідентифікатор книжної шафи</td>
                        <td>Зареєстровано екземплярів</td>
                        <td>Коли зареєстровано</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($printingRegistrationsPagination as $printingRegistration)
                        @php /** @var \App\Models\PrintingRegistration $printingRegistration */ @endphp
                        <tr>
                            <td>
                                <a class="card-link"
                                   href="{{ route('librarian.printing-registrations.show', $printingRegistration->id) }}">
                                    {{ $printingRegistration->id }}
                                </a>
                            </td>
                            <td>
                                {{ $printingRegistration->user->name }}
                            </td>
                            <td>
                                <a class="card-link"
                                   href="{{ route('librarian.bookshelves.show', $printingRegistration->bookshelf_id) }}">
                                    {{ $printingRegistration->bookshelf_id }}
                                </a>
                            </td>
                            <td>
                                {{ $printingRegistration->exemplars_registered_initially }}
                            </td>
                            <td>
                                {{ $printingRegistration->created_at }}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot></tfoot>
                </table>
            </div>
            <div class="card-footer">
            @if($printingRegistrationsPagination->total() > $printingRegistrationsPagination->count())
                    {{ $printingRegistrationsPagination->links() }}
            @endif
                <button class="btn btn-outline-primary float-right"
                   onclick="window.print();">
                    Надрукувати звіт
                </button>
            </div>
        </div>
    </div>
@endsection
