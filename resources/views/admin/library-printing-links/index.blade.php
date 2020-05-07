@extends('layouts.app')

@section('content')
    <div class="col">
        <div class="card">
            <div class="card-header bg-primary">
                <h5 class="text-white">Усі записи: зв'язки "бібліотека-видання"</h5>
                <a class="btn btn-secondary"
                   href="{{ route('admin.library-printing-links.create') }}">
                    Створити новий
                </a>
            </div>
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <td>Ідентифікатор</td>
                        <td>Ідентифікатор бібліотеки</td>
                        <td>Ідентифікатор видання</td>
                        <td>Екземплярів зареєстровано</td>
                        <td>Екземплярів зберігається</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($linksPagination as $link)
                        <tr>
                            <td>
                                <a class="card-link"
                                   href="{{ route('admin.library-printing-links.edit', $link->id) }}">
                                    {{ $link->id }}
                                </a>
                            </td>
                            <td>
                                <a class="card-link"
                                   href="{{ route('admin.libraries.edit', $link->library_id) }}">
                                    {{ $link->library_id }}
                                </a>
                            </td>
                            <td>
                                <a class="card-link"
                                   href="{{ route('admin.printings.edit', $link->printing_id) }}">
                                    {{ $link->printing_id }}
                                </a>
                            </td>
                            <td>{{ $link->exemplars_registered }}</td>
                            <td>{{ $link->exemplars_stored }}</td>
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
