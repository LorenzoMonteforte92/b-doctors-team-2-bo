@extends('layouts.admin')
@section('title')
    {{ 'Interazioni' }}
@endsection
@section('content')

<body class="ms-b">
   <div class="container">
        <div class="text-center my-5">
         
            <div class=" border-success my-5" style="width: 44rem; margin: auto;">
                <img src="https://i.pinimg.com/originals/0d/e4/1a/0de41a3c5953fba1755ebd416ec109dd.gif" alt="" class="card-img-top">
            </div>
            <h1 class="my-3 text-success">Pagamento riuscito!</h1>
            <small class="text-success">Il pagamento è stato completato con successo.</small>
            <div class="mt-2">
                <a class="btn btn-bd-primary {{ Route::currentRouteName() === 'admin.sponsorships.index' ? 'brand-color-2' : '' }}"
                href="{{ route('admin.sponsorships.index', ['profile' => Auth::user()->profile->user_slug]) }}">Torna alle sponsorizzazioni</a>
            </div>
        </div>
        @if($errors->any())
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