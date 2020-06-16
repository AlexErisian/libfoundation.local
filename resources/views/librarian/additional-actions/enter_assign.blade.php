@extends('layouts.app')

@section('content')
    <div class="col">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h4 class="card-title">Видача читацького квитка</h4>
            </div>
            <div class="card-body">
                <form class="w-100"
                      method="POST"
                      action="{{ route('librarian.additional.assign') }}">
                    @csrf
                    <div class="form-group">
                        <label for="readercard_code">Код читацького
                            квитка</label>
                        <input class="form-control"
                               type="number"
                               id="readercard_code"
                               name="readercard_code"
                               min="1"
                               required
                               value="{{ old('readercard_code') }}">
                    </div>
                    <div class="form-group">
                        <label for="user_email">Email читача</label>
                        <input class="form-control"
                               type="email"
                               id="user_email"
                               name="user_email"
                               required
                               value="{{ old('user_email') }}">
                    </div>
                    <button class="btn btn-primary"
                            type="submit">
                        Видати квиток
                    </button>
                </form>
            </div>
        </div>
        @include('messages.result')
    </div>
@endsection
