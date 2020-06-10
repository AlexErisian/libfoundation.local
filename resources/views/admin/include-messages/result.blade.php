@php
    /** @var \Illuminate\Support\ViewErrorBag $errors */
@endphp
@if($errors->any())
    <div class="row justify-content-center no-gutters">
        <div class="col">
            <div class="alert alert-danger alert-dismissible my-2"
                 role="alert">
                <ul class="m-0">
                    @foreach($errors->all() as $errorMsg)
                        <li>{{ $errorMsg }}</li>
                    @endforeach
                </ul>
                <button type="button" class="close"
                        data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    </div>
@elseif(session('success'))
    <div class="row justify-content-center no-gutters">
        <div class="col">
            <div class="alert alert-success alert-dismissible my-2"
                 role="alert">
                {{ session('success') }}
                <button type="button" class="close"
                        data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    </div>
@endif
