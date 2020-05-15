@extends('layouts.app')

@section('content')
    <div class="col">
        <div class="card">
            <div class="card-header bg-primary">
                <h5 class="text-white">Усі записи: позичання видань</h5>
            </div>
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <td>Ідентифікатор</td>
                        <td>Бібліотекар</td>
                        <td>Код квитка</td>
                        <td>Ідентифікатор книжної шафи</td>
                        <td class="d-none d-md-table-cell">Позичено екземплярів</td>
                        <td class="d-none d-md-table-cell">Коли позичено</td>
                        <td class="d-none d-md-table-cell">Строком до</td>
                        <td class="d-none d-md-table-cell">Коли повернено</td>
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
                            <td>
                                <a class="card-link"
                                   href="{{ route('admin.readercards.edit', $libraryService->readercard->id) }}">
                                    {{ $libraryService->readercard->code }}
                                </a>
                            </td>
                            <td>
                                <a class="card-link"
                                   href="{{ route('admin.bookshelves.edit', $libraryService->bookshelf_id) }}">
                                    {{ $libraryService->bookshelf_id }}
                                </a>
                            </td>
                            <td class="d-none d-md-table-cell">
                                {{ $libraryService->exemplars_given }}
                            </td>
                            <td class="d-none d-md-table-cell">
                                {{ $libraryService->created_at }}
                            </td>
                            <td class="d-none d-md-table-cell">
                                {{ $libraryService->given_up_to }}
                            </td>
                            <td class="d-none d-md-table-cell">
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
