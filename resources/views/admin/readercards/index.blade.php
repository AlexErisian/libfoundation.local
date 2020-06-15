@extends('layouts.app')

@section('content')
    <div class="col">
        @include('messages.result')
        <div class="card">
            <div class="card-header bg-primary">
                <h5 class="text-white">Усі записи: читацькі квитки</h5>
                <a class="btn btn-secondary d-print-none"
                   href="{{ route('admin.readercards.create') }}">
                    Створити новий
                </a>
            </div>
            <div class="card-body overflow-auto">
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
            <div class="card-footer">
                @if($readercardsPagination->total() > $readercardsPagination->count())
                    {{ $readercardsPagination->links() }}
                @endif
                <button class="btn btn-outline-primary float-right"
                        onclick="window.print();">
                    Надрукувати звіт
                </button>
            </div>
        </div>
    </div>
@endsection
