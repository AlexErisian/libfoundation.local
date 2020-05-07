@extends('layouts.app')

@section('content')
    <div class="col">
        <div class="card">
            <div class="card-header bg-primary">
                <h5 class="text-white">Усі записи: видавництва</h5>
                <a class="btn btn-secondary"
                   href="{{ route('admin.printing-pubhouses.create') }}">
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
                    @foreach($pubhousesPagination as $pubhouse)
                        @php /** @var \App\Models\PrintingPubhouse $pubhouse*/ @endphp
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
            @if($pubhousesPagination->total() > $pubhousesPagination->count())
                <div class="card-footer">
                    {{ $pubhousesPagination->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
