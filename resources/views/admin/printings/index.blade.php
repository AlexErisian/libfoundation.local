@extends('layouts.app')

@section('content')
    <div class="col">
        <div class="card">
            <div class="card-header bg-primary">
                <h5 class="text-white">Усі записи: друковані видання</h5>
                <a class="btn btn-secondary"
                   href="{{ route('admin.printings.create') }}">
                    Створити новий
                </a>
            </div>
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <td>Ідентифікатор</td>
                        <td>Назва</td>
                        <td>Автор</td>
                        <td class="d-none d-md-table-cell">Видавництво</td>
                        <td class="d-none d-md-table-cell">Тип</td>
                        <td class="d-none d-md-table-cell">Рік публікації</td>
                        <td>ISBN</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($printingsPagination as $printing)
                        @php /** @var \App\Models\Printing $printing*/ @endphp
                        <tr>
                            <td>{{ $printing->id }}</td>
                            <td>
                                <a class="card-link"
                                   href="{{ route('admin.printings.edit', $printing->id) }}">
                                    {{ $printing->title }}
                                </a>
                            </td>
                            <td>
                                <a class="card-link"
                                   href="{{ route('admin.printing-authors.edit', $printing->author->id) }}">
                                    {{ $printing->author->name }}
                                </a>
                            </td>
                            <td class="d-none d-md-table-cell">
                                <a class="card-link"
                                   href="{{ route('admin.printing-pubhouses.edit', $printing->pubhouse->id) }}">
                                    {{ $printing->pubhouse->name }}
                                </a>
                            </td>
                            <td class="d-none d-md-table-cell">
                                <a class="card-link"
                                   href="{{ route('admin.printing-types.edit', $printing->type->id) }}">
                                    {{ $printing->type->name }}
                                </a>
                            </td>
                            <td class="d-none d-md-table-cell">{{ $printing->publication_year }}</td>
                            <td>{{ $printing->isbn }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            @if($printingsPagination->total() > $printingsPagination->count())
                <div class="card-footer">
                    {{ $printingsPagination->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
