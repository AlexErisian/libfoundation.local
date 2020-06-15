@extends('layouts.app')

@section('content')
    <div class="col">
        @include('messages.result')
        <div class="card">
            <div class="card-header bg-primary">
                <h5 class="text-white">Усі записи: друковані видання</h5>
                <a class="btn btn-secondary d-print-none"
                   href="{{ route('admin.printings.create') }}">
                    Створити новий
                </a>
            </div>
            <div class="card-body overflow-auto">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <td>Ідентифікатор</td>
                        <td>Назва</td>
                        <td>Автор</td>
                        <td>Видавництво</td>
                        <td>Тип</td>
                        <td>Рік публікації</td>
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
                            <td>
                                <a class="card-link"
                                   href="{{ route('admin.printing-pubhouses.edit', $printing->pubhouse->id) }}">
                                    {{ $printing->pubhouse->name }}
                                </a>
                            </td>
                            <td>
                                <a class="card-link"
                                   href="{{ route('admin.printing-types.edit', $printing->type->id) }}">
                                    {{ $printing->type->name }}
                                </a>
                            </td>
                            <td>{{ $printing->publication_year }}</td>
                            <td>{{ $printing->isbn }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                @if($printingsPagination->total() > $printingsPagination->count())
                    {{ $printingsPagination->links() }}
                @endif
                <button class="btn btn-outline-primary float-right"
                        onclick="window.print();">
                    Надрукувати звіт
                </button>
            </div>
        </div>
    </div>
@endsection
