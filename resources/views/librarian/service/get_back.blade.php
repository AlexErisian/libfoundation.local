@extends('layouts.app')

@section('content')
    <div class="col">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h4 class="card-title">Повернення позичених видань</h4>
            </div>
            <div class="card-body">
                <form class="w-100"
                      method="POST"
                      action="{{ route('') }}">
                    @csrf
                    <div class="form-group">
                        <label for="readercard_code">Код читацького квитка</label>
                        <input class="form-control"
                               type="text"
                               id="readercard_code"
                               name="readercard_code"
                               required
                               value="{{ old('readercard_code') }}">
                    </div>
                    <button class="btn btn-primary"
                            type="submit">
                        Вивести позичання за читацьким квитком
                    </button>
                </form>
            </div>
            <div class="card-footer">
                <a class="btn btn-secondary"
                   href="">
                    Повернути позичені видання з загального переліку
                </a>
            </div>
        </div>
        @include('messages.result')
    </div>
@endsection
