@extends('layouts.admin')
@section('title')
    {{ 'Interazioni' }}
@endsection
@section('content')

    <body>
        <h1>Payment Successful!</h1>
        <div class="d-flex justify-content-center align-items-center position-relative mt-2">
            <a class="btn btn-bd-primary {{ Route::currentRouteName() === 'admin.sponsorships.index' ? 'brand-color-2' : '' }}"
                href="{{ route('admin.sponsorships.index', ['profile' => Auth::user()->profile->user_slug]) }}">Torna alle sponsorizzazioni</a>
        </div>
    </body>
@endsection
