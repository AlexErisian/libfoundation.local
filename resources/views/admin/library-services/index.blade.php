@extends('layouts.app')

@section('content')
    <div class="col">
        <div class="card">
            <div class="card-header bg-primary">
                <h5 class="text-white">Усі записи: позичання видань</h5>
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
