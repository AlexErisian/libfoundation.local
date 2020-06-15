@extends('layouts.app')

@section('content')
    <div class="col">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h4 class="card-title">Вибір видання для позичання</h4>
                <h5 class="card-subtitle">
                    Робоча бібліотека: {{ session('working_library_name') }}
                </h5>
            </div>
            <div class="card-body overflow-auto">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <td>Номер шафи</td>
                        <td>Номер полиці</td>
                        <td>Зберігається видання</td>
                        <td>Екземплярів зареєстровано</td>
                        <td>Екземплярів зберігається</td>
                        <td>Дія</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($bookshelvesPagination as $bookshelf)
                        @php /** @var \App\Models\Bookshelf $bookshelf */ @endphp
                        <tr>
                            <td>{{ $bookshelf->shelf_number }}</td>
                            <td>{{ $bookshelf->shelf_floor }}</td>
                            <td>
                                <a class="card-link"
                                   href="{{ route('printings.show', $bookshelf->printing->id) }}">
                                    {{ $bookshelf->printing->title }}
                                </a>
                            </td>
                            <td>{{ $bookshelf->exemplars_registered }}</td>
                            <td>{{ $bookshelf->exemplars_in_stock }}</td>
                            <td>
                                <a class="btn btn-outline-primary @if($bookshelf->exemplars_in_stock < 1) disabled @endif"
                                   href="{{ route('librarian.service.specify', $bookshelf->id) }}">
                                    На видачу
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot></tfoot>
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
