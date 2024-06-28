@extends('layouts.admin')

@section('content')
    <h2 class="brand-text-color-1">IL TUO PROFILO</h2>

    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
    <div class="profile-wrapper">
        @if ($profile->photo)
            <img src="{{ asset('storage/' . $profile->photo) }}" alt="{{ $profile->name }}">
        @endif
        <div class="my-2"><strong class="brand-text-color-1 ">ID</strong>: {{ $profile->id }}</div>
        <div class="my-2"><strong class="brand-text-color-1 ">EMAIL</strong>: {{ $user->email }}</div>
        <div class="my-2"><strong class="brand-text-color-1 ">NOME</strong>: {{ $user->name }}</div>
        <div class="my-2 "><strong class="brand-text-color-1 ">INDIRIZZO</strong>: {{ $user->address }}</div>
        <div class="my-2 "><strong class="brand-text-color-1 ">TELEFONO</strong>: {{ $profile->telephone_number }}</div>
        @if ($profile->curriculum_vitae)
            <div><strong class="brand-text-color-1 ">CURRICULUM:</strong></div>
            <img src="{{ asset('storage/' . $profile->curriculum_vitae) }}" alt="{{ $profile->name }}">
        @endif
        <div class="my-2"><strong>PRESTAZIONI</strong>: {{ $profile->performance }}</div>
        <div class="my-2"><strong>BIO</strong>: {{ $profile->bio }}</div>
        <button class="btn btn-dark mt-4">
            <a href="{{ route('admin.profiles.edit', $profile->id) }}">Modifica profilo</a>
        </button>
    </div>
@endsection