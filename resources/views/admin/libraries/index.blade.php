@extends('layouts.app')

@section('content')
    <div class="col">
        @include('messages.result')
        <div class="card">
            <div class="card-header bg-primary">
                <h5 class="text-white">Усі записи: бібліотеки</h5>
                <a class="btn btn-secondary d-print-none"
                   href="{{ route('admin.libraries.create') }}">
                    Створити новий
                </a>
            </div>
            <div class="card-body overflow-auto">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <td>Ідентифікатор</td>
                        <td>Назва</td>
                        <td>Адреса</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($librariesPagination as $library)
                        @php /** @var \App\Models\Library $library*/ @endphp
                        <tr>
                            <td>
                                {{ $library->id }}
                            </td>
                            <td>
                                <a class="card-link"
                                   href="{{ route('admin.libraries.edit', $library->id) }}">
                                    {{ $library->name }}
                                </a>
                            </td>
                            <td>
                                {{ $library->address }}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                @if($librariesPagination->total() > $librariesPagination->count())
                    {{ $librariesPagination->links() }}
                @endif
                <button class="btn btn-outline-primary float-right"
                        onclick="window.print();">
                    Надрукувати звіт
                </button>
            </div>
        </div>
    </div>
@endsection
