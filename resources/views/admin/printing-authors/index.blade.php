@extends('layouts.app')

@section('content')
    <div class="col">
        @include('messages.result')
        <div class="card">
            <div class="card-header bg-primary">
                <h5 class="text-white">Усі записи: автори видань</h5>
                <a class="btn btn-secondary d-print-none"
                   href="{{ route('admin.printing-authors.create') }}">
                    Створити новий
                </a>
            </div>
            <div class="card-body overflow-auto">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <td>Ідентифікатор</td>
                        <td>Ім'я</td>
                        <td>Народився</td>
                        <td>Помер</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($authorsPagination as $author)
                        @php /** @var \App\Models\PrintingAuthor $author*/ @endphp
                        <tr>
                            <td>
                                {{ $author->id }}
                            </td>
                            <td>
                                <a class="card-link"
                                   href="{{ route('admin.printing-authors.edit', $author->id) }}">
                                    {{ $author->name }}
                                </a>
                            </td>
                            <td>
                                {{ $author->born_in }}
                            </td>
                            <td>
                                {{ $author->died_in }}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                @if($authorsPagination->total() > $authorsPagination->count())
                    {{ $authorsPagination->links() }}
                @endif
                <button class="btn btn-outline-primary float-right"
                        onclick="window.print();">
                    Надрукувати звіт
                </button>
            </div>
        </div>
    </div>
@endsection
