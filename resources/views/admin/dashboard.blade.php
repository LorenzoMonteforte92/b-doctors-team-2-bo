@extends('layouts.admin')

@section('content')

    <h2 class="fs-4 my-4 brand-text-color-1 ">
        {{ __('Dashboard') }}
    </h2>
    <div class="row justify-content-center brand-text-color-1 ">
        <div class="col">
            <div class="card">
                <div class="card-header">{{ __('User Dashboard') }}</div>

                <div class="card-body brand-text-color-1 ">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    {{ __('You are logged in!') }}

                    <div>
                        Benvenuto: {{ $user->name }}.
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection