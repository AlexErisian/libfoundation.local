@extends('layouts.app')

@section('content')
    <div class="col">
        <div class="card">
            <div class="card-header bg-primary">
                <h5 class="text-white">Усі записи: списання видань</h5>
            </div>
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <td>Ідентифікатор</td>
                        <td>Користувач</td>
                        <td>Ідентифікатор зв'язку</td>
                        <td class="d-none d-table-cell">
                            Екземплярів списано
                        </td>
                        <td class="d-none d-table-cell">Створено</td>
                        <td class="d-none d-table-cell">Оновлено</td>
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
                                   href="{{ route('admin.bookshelves.edit', $writingOff->library_printing_id) }}">
                                    {{ $writingOff->library_printing_id }}
                                </a>
                            </td>
                            <td class="d-none d-table-cell">{{ $writingOff->exemplars_written_off }}</td>
                            <td class="d-none d-table-cell">{{ $writingOff->created_at }}</td>
                            <td class="d-none d-table-cell">{{ $writingOff->updated_at }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            @if($writingOffsPagination->total() > $writingOffsPagination->count())
                <div class="card-footer">
                    {{ $writingOffsPagination->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
