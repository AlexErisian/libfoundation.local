@extends('layouts.app')

@section('content')
    <div class="col">
        @include('messages.result')
        <div class="card">
            <div class="card-header bg-primary">
                <h5 class="text-white">Усі записи: книжні шафи</h5>
                <a class="btn btn-secondary"
                   href="{{ route('admin.bookshelves.create') }}">
                    Створити новий
                </a>
            </div>
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <td>Ідентифікатор</td>
                        <td>Належить до бібліотеки</td>
                        <td>Зберігає видання</td>
                        <td>Екземплярів зареєстровано</td>
                        <td>Екземплярів зберігається</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($bookshelvesPagination as $bookshelf)
                        @php /** @var \App\Models\Bookshelf $bookshelf */ @endphp
                        <tr>
                            <td>
                                <a class="card-link"
                                   href="{{ route('admin.bookshelves.edit', $bookshelf->id) }}">
                                    {{ $bookshelf->id }}
                                </a>
                            </td>
                            <td>
                                <a class="card-link"
                                   href="{{ route('admin.libraries.edit', $bookshelf->library->id) }}">
                                    {{ $bookshelf->library->name }}
                                </a>
                            </td>
                            <td>
                                <a class="card-link"
                                   href="{{ route('admin.printings.edit', $bookshelf->printing->id) }}">
                                    {{ $bookshelf->printing->title }}
                                </a>
                            </td>
                            <td>{{ $bookshelf->exemplars_registered }}</td>
                            <td>{{ $bookshelf->exemplars_in_stock }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            @if($bookshelvesPagination->total() > $bookshelvesPagination->count())
                <div class="card-footer">
                    {{ $bookshelvesPagination->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
