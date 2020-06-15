@extends('layouts.app')

@section('content')
    <div class="col">
        <div class="card">
            <div class="card-header bg-primary">
                <h5 class="text-white">Усі записи: списання видань</h5>
            </div>
            <div class="card-body overflow-auto">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <td>Ідентифікатор</td>
                        <td>Користувач</td>
                        <td>Ідентифікатор книжної шафи</td>
                        <td>Екземплярів списано</td>
                        <td>Створено</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($writingOffsPagination as $writingOff)
                        @php /** @var \App\Models\PrintingWritingOff $writingOff*/ @endphp
                        <tr>
                            <td>
                                <a class="card-link"
                                   href="{{ route('admin.printing-writing-offs.edit', $writingOff->id) }}">
                                    {{ $writingOff->id }}
                                </a>
                            </td>
                            <td>
                                <a class="card-link"
                                   href="{{ route('admin.users.edit', $writingOff->user->id) }}">
                                    {{ $writingOff->user->name }}
                                </a>
                            </td>
                            <td>
                                <a class="card-link"
                                   href="{{ route('admin.bookshelves.edit', $writingOff->bookshelf_id) }}">
                                    {{ $writingOff->bookshelf_id }}
                                </a>
                            </td>
                            <td>{{ $writingOff->exemplars_written_off }}</td>
                            <td>{{ $writingOff->created_at }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                @if($writingOffsPagination->total() > $writingOffsPagination->count())
                    {{ $writingOffsPagination->links() }}
                @endif
                <button class="btn btn-outline-primary float-right"
                        onclick="window.print();">
                    Надрукувати звіт
                </button>
            </div>
        </div>
    </div>
@endsection
