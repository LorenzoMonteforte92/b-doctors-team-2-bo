@extends('layouts.admin')
@section('title')
    {{ 'Interazioni' }}
@endsection
@section('content')

    <body class="ms-b">
        <div class="container">
            <div class="text-center my-5">
                <div class="wrapper d-flex flex-wrap flex-column text-center">

                    <div class="border-danger my-5">
                        <img src="https://i0.wp.com/nrifuture.com/wp-content/uploads/2022/05/comp_3.gif?fit=800%2C600&ssl=1"
                            alt="" class="card-img-top">
                    </div>
                    <h1 class="my-3 text-danger">Pagamento non riuscito!</h1>
                    <small class="text-danger">Siamo spiacenti, ma qualcosa ha impedito il completamento del pagamento. Per
                        favore, riprova.</small>
                    <div class="mt-2">
                        <a class="btn btn-bd-primary {{ Route::currentRouteName() === 'admin.sponsorships.index' ? 'brand-color-2' : '' }}"
                            href="{{ route('admin.sponsorships.index', ['profile' => Auth::user()->profile->user_slug]) }}">Ritenta
                            il pagamento</a>
                    </div>
                </div>
            </div>
            @if ($errors->any())
                <div class="alert alert-danger mt-2">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


        </div>

    </body>

@endsection
