@extends('layouts.app')

@section('content')
    <div class="col">
        <div class="card">
            <div class="card-header bg-primary">
                <h5 class="text-white">Усі записи: коментарі до видань</h5>
                <a class="btn btn-secondary"
                   href="{{ route('admin.printing-comments.create') }}">
                    Створити новий
                </a>
            </div>
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <td>Ідентифікатор</td>
                        <td>До якого видання</td>
                        <td>Користувач-автор</td>
                        <td class="d-none d-md-table-cell">Текст</td>
                        <td class="d-none d-md-table-cell">Створено</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($commentsPagination as $comment)
                        @php /** @var \App\Models\PrintingComment $comment*/ @endphp
                        <tr>
                            <td>
                                <a class="card-link"
                                   href="{{ route('admin.printing-comments.edit', $comment->id) }}">
                                    {{ $comment->id }}
                                </a>
                            </td>
                            <td>
                                {{ $comment->printing->title }}
                            </td>
                            <td>
                                {{ $comment->user->name }}
                            </td>
                            <td class="d-none d-md-table-cell">
                                {{ $comment->text }}
                            </td>
                            <td class="d-none d-md-table-cell">
                                {{ $comment->created_at }}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            @if($commentsPagination->total() > $commentsPagination->count())
                <div class="card-footer">
                    {{ $commentsPagination->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
