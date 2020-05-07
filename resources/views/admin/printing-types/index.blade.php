@extends('layouts.app')

@section('content')
    <div class="col">
        <div class="card">
            <div class="card-header bg-primary">
                <h5 class="text-white">Усі записи: типи видань</h5>
                <a class="btn btn-secondary"
                   href="{{ route('admin.printing-types.create') }}">
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
                    @foreach($typesPagination as $type)
                        @php /** @var \App\Models\PrintingType $type*/ @endphp
                        <tr>
                            <td>
                                {{ $type->id }}
                            </td>
                            <td>
                                <a class="card-link"
                                   href="{{ route('admin.printing-types.edit', $type->id) }}">
                                    {{ $type->name }}
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            @if($typesPagination->total() > $typesPagination->count())
                <div class="card-footer">
                    {{ $typesPagination->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
