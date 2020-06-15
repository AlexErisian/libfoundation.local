@extends('layouts.app')

@section('content')
    <div class="col">
        @include('messages.result')
        <div class="card">
            <div class="card-header bg-primary">
                <h5 class="text-white">Усі записи: новини</h5>
                <a class="btn btn-secondary d-print-none"
                   href="{{ route('admin.posts.create') }}">
                    Створити новий
                </a>
            </div>
            <div class="card-body overflow-auto">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <td>Ідентифікатор</td>
                        <td>Автор</td>
                        <td>Заголовок</td>
                        <td>Чи опубліковано</td>
                        <td>Опубліковано</td>
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
                            <td>@if($post->is_published) Так @else Ні @endif</td>
                            <td>{{ $post->published_at }}</td>
                            <td class="d-none d-lg-table-cell">{{ $post->updated_at }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                @if($postsPagination->total() > $postsPagination->count())
                    {{ $postsPagination->links() }}
                @endif
                <button class="btn btn-outline-primary float-right"
                        onclick="window.print();">
                    Надрукувати звіт
                </button>
            </div>
        </div>
    </div>
@endsection
