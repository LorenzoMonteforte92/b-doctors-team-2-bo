@extends('layouts.admin')

@section('content')
    <h2>IL TUO PROFILO</h2>

    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <div class="profile-wrapper">
        {{ dd($profile)}}
        @if ($profile->photo)
            <img src="{{ asset('storage/' . $profile->photo) }}" alt="{{ $profile->name }}">
        @endif
        <div class="my-2"><strong>EMAIL</strong>: {{ $user->email }}</div>
        <div class="my-2"><strong>NOME</strong>: {{ $user->name }}</div>
        <div class="my-2"><strong>INDIRIZZO</strong>: {{ $user->address }}</div>
        <div class="my-2"><strong>TELEFONO</strong>: {{ $profile->telephone_number }}</div>
        @if ($profile->curriculum_vitae)
            <div><strong>CURRICULUM:</strong></div>
            <img src="{{ asset('storage/' . $profile->curriculum_vitae) }}" alt="{{ $profile->name }}">
        @endif
        <div class="my-2"><strong>SPECIALIZZAIONI</strong>: {{ $profile->specialisations }}</div>
        <div class="my-2"><strong>PRESTAZIONI</strong>: {{ $profile->performance }}</div>
        <div class="my-2"><strong>BIO</strong>: {{ $profile->bio }}</div>
        <button class="btn btn-dark mt-4">
            <a href="{{ route('admin.profiles.edit', $profile->id) }}">Modifica profilo</a>
        </button>
    </div>
@endsection