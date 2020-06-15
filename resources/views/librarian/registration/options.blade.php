@extends('layouts.app')

@section('content')
    <div class="col">
        @include('messages.result')
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="card-title">Вибір існуючуго видання для реєстрації у
                    бібліотеці</h5>
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
                        <td>Дія</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($printingsPagination as $printing)
                        @php /** @var \App\Models\Printing $printing*/ @endphp
                        <tr>
                            <td>{{ $printing->id }}</td>
                            <td>
                                {{ $printing->title }}
                            </td>
                            <td>
                                {{ $printing->author->name }}
                            </td>
                            <td>
                                {{ $printing->pubhouse->name }}
                            </td>
                            <td>
                                {{ $printing->type->name }}
                            </td>
                            <td>
                                {{ $printing->publication_year }}
                            </td>
                            <td>{{ $printing->isbn }}</td>
                            <td>
                                <a class="btn btn-outline-primary"
                                   href="{{ route('librarian.registration.specify', $printing->id) }}">
                                    До реєстрації
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot></tfoot>
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
