@extends('layouts.app')

@section('content')
    <div class="col">
        @include('messages.result')
        <div class="card">
            <div class="card-header bg-primary">
                <h5 class="text-white">Усі записи: бібліотеки</h5>
                <a class="btn btn-secondary"
                   href="{{ route('admin.libraries.create') }}">
                    Створити новий
                </a>
            </div>
            <div class="card-body">
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
            @if($librariesPagination->total() > $librariesPagination->count())
                <div class="card-footer">
                    {{ $librariesPagination->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
