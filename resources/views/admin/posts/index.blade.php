@extends('layouts.app')

@section('content')
    <div class="col">
        <div class="card">
            <div class="card-header bg-primary">
                <h5 class="text-white">Усі записи: новини</h5>
                <a class="btn btn-secondary"
                   href="{{ route('admin.posts.create') }}">
                    Створити новий
                </a>
            </div>
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <td>Ідентифікатор</td>
                        <td>Автор</td>
                        <td>Заголовок</td>
                        <td class="d-none d-md-table-cell">Чи опубліковано</td>
                        <td class="d-none d-md-table-cell">Опубліковано</td>
                        <td class="d-none d-lg-table-cell">Створено</td>
                        <td class="d-none d-lg-table-cell">Змінено</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($postsPagination as $post)
                        @php /** @var \App\Models\Post $post*/ @endphp
                        <tr>
                            <td>{{ $post->id }}</td>
                            <td>{{ $post->user->name }}</td>
                            <td>
                                <a class="card-link"
                                   href="{{ route('admin.posts.edit', $post->id) }}">
                                    {{ $post->title }}
                                </a>
                            </td>
                            <td class="d-none d-md-table-cell">@if($post->is_published)Так@elseНі@endif</td>
                            <td class="d-none d-md-table-cell">{{ $post->published_at }}</td>
                            <td class="d-none d-lg-table-cell">{{ $post->created_at }}</td>
                            <td class="d-none d-lg-table-cell">{{ $post->updated_at }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            @if($postsPagination->total() > $postsPagination->count())
                <div class="card-footer">
                    {{ $postsPagination->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
