@extends('layouts.app')
@php
    /** @var \App\Models\User $user */
    /** @var \Illuminate\Database\Eloquent\Collection $services */
@endphp
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header bg-primary">
                <h5 class="text-white">Персональна сторінка користувача</h5>
            </div>
            <div class="card-body">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active"
                           href="#personalData"
                           aria-controls="personalData"
                           role="tab"
                           data-toggle="tab">Особисті дані</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"
                           href="#serviceData"
                           aria-controls="serviceData"
                           role="tab"
                           data-toggle="tab">Позичена література</a>
                    </li>
                </ul>
                <br>
                <div class="tab-content">
                    <div id="personalData" class="tab-pane active"
                         role="tabpanel">
                        <form class="w-100"
                              method="POST"
                              action="{{ route('reader.users.update', $user) }}">
                            @method('PATCH')
                            @csrf
                            <div class="form-group">
                                <label for="name">Ім'я</label>
                                <input class="form-control"
                                       type="text"
                                       id="name"
                                       readonly
                                       value="{{ $user->name }}">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input class="form-control"
                                       type="text"
                                       id="email"
                                       readonly
                                       value="{{ $user->email }}">
                            </div>
                            <div class="form-group">
                                <label for="readercard_code">Код читацького
                                    квитка</label>
                                <input class="form-control"
                                       type="text"
                                       id="readercard_code"
                                       readonly
                                       value="{{ $user->readercard->code }}">
                            </div>
                            <div class="form-group">
                                <label for="phone">Номер телефону</label>
                                <input class="form-control"
                                       type="tel"
                                       id="phone"
                                       readonly
                                       value="{{ $user->phone }}">
                            </div>
                            <div class="form-group">
                                <label for="notes">Примітки (про себе)</label>
                                <textarea class="form-control"
                                          id="notes"
                                          name="notes"
                                          maxlength="1000"
                                          rows="3">{{ old('notes', $user->notes) }}</textarea>
                            </div>
                            @if($user->is_banned)
                                <p class="text-danger">Цей обліковий запис
                                    заблоковано.</p>
                            @endif
                            <button class="btn btn-primary"
                                    type="submit">
                                Зберегти дані
                            </button>
                        </form>
                        @include('messages.result')
                    </div>
                    <div id="serviceData"
                         class="tab-pane overflow-auto"
                         role="tabpanel">
                        @if($services->count() > 0)
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <td>Позичено літературу</td>
                                    <td>Кількість екземплярів</td>
                                    <td>У бібліотеці</td>
                                    <td>Коли позичено</td>
                                    <td>Строком до</td>
                                    <td>Коли повернено</td>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($services as $libraryService)
                                    @php /** @var \App\Models\LibraryService $libraryService */ @endphp
                                    <tr
                                        @if(empty($libraryService->returned_at))
                                        @if($libraryService->given_up_to > \Carbon\Carbon::now())
                                        style="background-color: #fff6a1;"
                                        @else
                                        style="background-color: #ffa1a1;"
                                        @endif
                                        @else
                                        style="background-color: #a7ffa1;"
                                        @endif>
                                        <td>
                                            <a class="card-link"
                                               href="{{ route('printings.show', $libraryService->bookshelf->printing->id) }}">
                                                {{ $libraryService->bookshelf->printing->title }}
                                            </a>
                                        </td>
                                        <td>
                                            {{ $libraryService->exemplars_given }}
                                        </td>
                                        <td>
                                            <a class="card-link"
                                               href="">
                                                {{ $libraryService->bookshelf->library->name }}
                                            </a>
                                        </td>
                                        <td>
                                            {{ $libraryService->created_at }}
                                        </td>
                                        <td>
                                            {{ $libraryService->given_up_to }}
                                        </td>
                                        <td>
                                            {{ $libraryService->returned_at }}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot></tfoot>
                            </table>
                            <p class="alert alert-info m-0">
                                Повернена література позначається зеленим,
                                неповернена - жовтим, заборгована -
                                червоним.<br>
                                Будь ласка, своєчасно повертайте літературу до
                                бібліотеки.
                            </p>
                        @else
                            <p class="alert alert-info m-0">
                                Поки що немає позиченої літератури.
                            </p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
