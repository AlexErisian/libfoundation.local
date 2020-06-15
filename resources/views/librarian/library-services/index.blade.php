@extends('layouts.app')

@section('content')
    <div class="col">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h4 class="card-title">Усі записи про позичання видань у бібліотеці</h4>
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
                        <td>Код квитка</td>
                        <td>Ідентифікатор книжної шафи</td>
                        <td>Позичено екземплярів</td>
                        <td>Коли позичено</td>
                        <td>Строком до</td>
                        <td>Коли повернено</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($libraryServicesPagination as $libraryService)
                        @php /** @var \App\Models\LibraryService $libraryService */ @endphp
                        <tr>
                            <td>
                                <a class="card-link"
                                   href="{{ route('librarian.library-services.show', $libraryService->id) }}">
                                    {{ $libraryService->id }}
                                </a>
                            </td>
                            <td>
                                {{ $libraryService->user->name }}
                            </td>
                            <td>
                                {{ $libraryService->readercard->code }}
                            </td>
                            <td>
                                <a class="card-link"
                                   href="{{ route('librarian.bookshelves.show', $libraryService->bookshelf_id) }}">
                                    {{ $libraryService->bookshelf_id }}
                                </a>
                            </td>
                            <td>
                                {{ $libraryService->exemplars_given }}
                            </td>
                            <td>
                                {{ $libraryService->created_at }}
                            </td>
                            <td>
                                {{ $libraryService->given_up_to }}
                            </td>
                            <td>
                                {{ $libraryService->returned_at }}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot></tfoot>
                </table>
            </div>
            <div class="card-footer">
            @if($libraryServicesPagination->total() > $libraryServicesPagination->count())
                    {{ $libraryServicesPagination->links() }}
            @endif
                <button class="btn btn-outline-primary float-right"
                   onclick="window.print();">
                    Надрукувати звіт
                </button>
            </div>
        </div>
    </div>
@endsection
