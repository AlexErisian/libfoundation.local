@extends('layouts.app')

@section('content')
    <div class="col">
        <div class="card">
            <div class="card-header bg-primary">
                <h5 class="text-white">Усі записи: позичання видань</h5>
                <a class="btn btn-secondary"
                   href="{{ route('admin.library-services.create') }}">
                    Створити новий
                </a>
            </div>
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <td>Ідентифікатор</td>
                        <td>Бібліотекар</td>
                        <td class="d-none d-table-cell">Код квитка</td>
                        <td class="d-none d-table-cell">Ідентифікатор зв'язку</td>
                        <td class="d-none d-table-cell">Позичено екземплярів</td>
                        <td>Коли позичено</td>
                        <td class="d-none d-table-cell">Строком до</td>
                        <td>Коли повернено</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($libraryServicesPagination as $libraryService)
                        @php /** @var \App\Models\LibraryService $libraryService*/ @endphp
                        <tr>
                            <td>
                                <a class="card-link"
                                   href="{{ route('admin.library-services.edit', $libraryService->id) }}">
                                    {{ $libraryService->id }}
                                </a>
                            </td>
                            <td>
                                <a class="card-link"
                                   href="{{ route('admin.users.edit', $libraryService->id) }}">
                                    {{ $libraryService->user->name }}
                                </a>
                            </td>
                            <td class="d-none d-table-cell">
                                <a class="card-link"
                                   href="{{ route('admin.readercards.edit', $libraryService->readercard->id) }}">
                                    {{ $libraryService->readercard->code }}
                                </a>
                            </td>
                            <td class="d-none d-table-cell">
                                <a class="card-link"
                                   href="{{ route('admin.library-printing-links.edit', $libraryService->readercard->id) }}">
                                    {{ $libraryService->library_printing_id }}
                                </a>
                            </td>
                            <td class="d-none d-table-cell">
                                {{ $libraryService->exemplars_given }}
                            </td>
                            <td>
                                {{ $libraryService->created_at }}
                            </td>
                            <td class="d-none d-table-cell">
                                {{ $libraryService->given_up_to }}
                            </td>
                            <td>
                                {{ $libraryService->returned_at }}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            @if($libraryServicesPagination->total() > $libraryServicesPagination->count())
                <div class="card-footer">
                    {{ $libraryServicesPagination->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
