@extends('layouts.app')

@section('content')
    <div class="col">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h4 class="card-title">Усі записи про списання видань у
                    бібліотеці</h4>
                <h5 class="card-subtitle">
                    Робоча бібліотека: {{ session('working_library_name') }}
                </h5>
            </div>
            <div class="card-body overflow-auto">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <td>Ідентифікатор</td>
                        <td>Бібліотекар</td>
                        <td>Ідентифікатор книжної шафи</td>
                        <td>Списано екземплярів</td>
                        <td>Коли списано</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($printingWritingOffsPagination as $printingWritingOff)
                        @php /** @var \App\Models\PrintingWritingOff $printingWritingOff */ @endphp
                        <tr>
                            <td>
                                <a class="card-link"
                                   href="{{ route('librarian.printing-writing-offs.show', $printingWritingOff->id) }}">
                                    {{ $printingWritingOff->id }}
                                </a>
                            </td>
                            <td>
                                {{ $printingWritingOff->user->name }}
                            </td>
                            <td>
                                <a class="card-link"
                                   href="{{ route('librarian.bookshelves.show', $printingWritingOff->bookshelf_id) }}">
                                    {{ $printingWritingOff->bookshelf_id }}
                                </a>
                            </td>
                            <td>
                                {{ $printingWritingOff->exemplars_written_off }}
                            </td>
                            <td>
                                {{ $printingWritingOff->created_at }}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot></tfoot>
                </table>
            </div>
            <div class="card-footer">
                @if($printingWritingOffsPagination->total() > $printingWritingOffsPagination->count())
                    {{ $printingWritingOffsPagination->links() }}
                @endif
                <button class="btn btn-outline-primary float-right"
                   onclick="window.print();">
                    Надрукувати звіт
                </button>
            </div>
        </div>
    </div>
@endsection
