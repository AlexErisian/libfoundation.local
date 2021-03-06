@extends('layouts.app')

@section('content')
    <div class="col">
        @include('messages.result')
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h4 class="card-title">Вибір видання для списання</h4>
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
                                   href="{{--{{ route('admin.printings.edit', $bookshelf->printing->id) }}--}}">
                                    {{ $bookshelf->printing->title }}
                                </a>
                            </td>
                            <td>{{ $bookshelf->exemplars_registered }}</td>
                            <td>{{ $bookshelf->exemplars_in_stock }}</td>
                            <td>
                                <form method="POST"
                                      action="{{ route('librarian.registration.write-off.confirm', $bookshelf->id) }}">
                                    @method('DELETE')
                                    @csrf
                                    <button class="btn btn-outline-danger @if($bookshelf->exemplars_in_stock < 1) disabled @endif"
                                            type="submit">
                                        Списати
                                    </button>
                                </form>

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
