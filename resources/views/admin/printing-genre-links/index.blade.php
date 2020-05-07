@extends('layouts.app')

@section('content')
    <div class="col">
        <div class="card">
            <div class="card-header bg-primary">
                <h5 class="text-white">Усі записи: зв'язки "видання-жанр"</h5>
                <a class="btn btn-secondary"
                   href="{{ route('admin.printing-genre-links.create') }}">
                    Створити новий
                </a>
            </div>
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <td>Ідентифікатор</td>
                        <td>Ідентифікатор видання</td>
                        <td>Ідентифікатор жанру</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($linksPagination as $link)
                        <tr>
                            <td>
                                <a class="card-link"
                                   href="{{ route('admin.printing-genre-links.edit', $link->id) }}">
                                    {{ $link->id }}
                                </a>
                            </td>
                            <td>
                                <a class="card-link"
                                   href="{{ route('admin.printings.edit', $link->printing_id) }}">
                                    {{ $link->printing_id }}
                                </a>
                            </td>
                            <td>
                                <a class="card-link"
                                   href="{{ route('admin.printing-genres.edit', $link->printing_genre_id) }}">
                                    {{ $link->printing_genre_id }}
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            @if($linksPagination->total() > $linksPagination->count())
                <div class="card-footer">
                    {{ $linksPagination->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
