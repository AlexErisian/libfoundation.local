@extends('layouts.app')

@section('content')
    <div class="col">
        <div class="card">
            <div class="card-header bg-primary">
                <h5 class="text-white">Усі записи: жанри видань</h5>
                <a class="btn btn-secondary"
                   href="{{ route('admin.printing-genres.create') }}">
                    Створити новий
                </a>
            </div>
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <td>Ідентифікатор</td>
                        <td>Назва</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($genresPagination as $genre)
                        @php /** @var \App\Models\PrintingGenre $genre*/ @endphp
                        <tr>
                            <td>
                                {{ $genre->id }}
                            </td>
                            <td>
                                <a class="card-link"
                                   href="{{ route('admin.printing-genres.edit', $genre->id) }}">
                                    {{ $genre->name }}
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            @if($genresPagination->total() > $genresPagination->count())
                <div class="card-footer">
                    {{ $genresPagination->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
