@extends('layouts.app')

@section('content')
    <div class="col">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h4 class="card-title">Усі видання, що зберігаються в бібліотеці</h4>
                <h5 class="card-subtitle">
                    Робоча бібліотека: {{ session('working_library_name') }}
                </h5>
            </div>
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <td>Ідентифікатор</td>
                        <td>Номер шафи</td>
                        <td>Номер полиці</td>
                        <td>Зберігається видання</td>
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
                                   href="{{ route('librarian.bookshelves.show', $bookshelf->id) }}">
                                    {{ $bookshelf->id }}
                                </a>
                            </td>
                            <td>{{ $bookshelf->shelf_number }}</td>
                            <td>{{ $bookshelf->shelf_floor }}</td>
                            <td>
                                <a class="card-link"
                                   href="">
                                    {{ $bookshelf->printing->title }}
                                </a>
                            </td>
                            <td>{{ $bookshelf->exemplars_registered }}</td>
                            <td>{{ $bookshelf->exemplars_in_stock }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot></tfoot>
                </table>
            </div>
            <div class="card-footer">
            @if($bookshelvesPagination->total() > $bookshelvesPagination->count())
                    {{ $bookshelvesPagination->links() }}
            @endif
                <a class="btn btn-outline-primary float-right"
                   href="">
                    Надрукувати звіт
                </a>
            </div>
        </div>
    </div>
@endsection
