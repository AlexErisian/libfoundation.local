@extends('layouts.app')

@section('content')
    <div class="col">
        <div class="card">
            <div class="card-header bg-primary">
                <h5 class="text-white">Усі записи: читацькі квитки</h5>
                <a class="btn btn-secondary"
                   href="{{ route('admin.readercards.create') }}">
                    Створити новий
                </a>
            </div>
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <td>Ідентифікатор</td>
                        <td>Код</td>
                        <td>Створено</td>
                        <td>Оновлено</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($readercardsPagination as $readercard)
                        @php /** @var \App\Models\Readercard $readercard*/ @endphp
                        <tr>
                            <td>
                                {{ $readercard->id }}
                            </td>
                            <td>
                                <a class="card-link"
                                   href="{{ route('admin.readercards.edit', $readercard->id) }}">
                                    {{ $readercard->code }}
                                </a>
                            </td>
                            <td>
                                {{ $readercard->created_at }}
                            </td>
                            <td>
                                {{ $readercard->updated_at }}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            @if($readercardsPagination->total() > $readercardsPagination->count())
                <div class="card-footer">
                    {{ $readercardsPagination->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
