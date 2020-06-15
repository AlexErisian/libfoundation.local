@extends('layouts.app')

@section('content')
    <div class="col">
        @include('messages.result')
        <div class="card">
            <div class="card-header bg-primary">
                <h5 class="text-white">Усі записи: видавництва</h5>
                <a class="btn btn-secondary d-print-none"
                   href="{{ route('admin.printing-pubhouses.create') }}">
                    Створити новий
                </a>
            </div>
            <div class="card-body overflow-auto">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <td>Ідентифікатор</td>
                        <td>Назва</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($pubhousesPagination as $pubhouse)
                        @php /** @var \App\Models\PrintingPubhouse $pubhouse */ @endphp
                        <tr>
                            <td>
                                {{ $pubhouse->id }}
                            </td>
                            <td>
                                <a class="card-link"
                                   href="{{ route('admin.printing-pubhouses.edit', $pubhouse->id) }}">
                                    {{ $pubhouse->name }}
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                @if($pubhousesPagination->total() > $pubhousesPagination->count())
                    {{ $pubhousesPagination->links() }}
                @endif
                <button class="btn btn-outline-primary float-right"
                        onclick="window.print();">
                    Надрукувати звіт
                </button>
            </div>
        </div>
    </div>
@endsection
