@extends('layouts.admin')

@section('content')
    <h2>IL TUO PROFILO</h2>
    <div class="profile-wrapper">
        
        @if ($profile->photo)
            <img src="{{ asset('storage/' . $profile->photo) }}" alt="{{ $profile->name }}">
        @endif
        <div class="my-2"><strong>ID</strong>: {{ $profile->id }}</div>
        <div class="my-2"><strong>EMAIL</strong>: {{ $profile->email }}</div>
        <div class="my-2"><strong>NOME</strong>: {{ $profile->name }}</div>
        <div class="my-2"><strong>INDIRIZZO</strong>: {{ $profile->address }}</div>
        <div class="my-2"><strong>TELEFONO</strong>: {{ $profile->telephone_number }}</div>
        @if ($profile->curriculum_vitae)
            <img src="{{ asset('storage/' . $profile->curriculum_vitae) }}" alt="{{ $profile->name }}">
        @endif
        <div class="my-2"><strong>PRESTAZIONI</strong>: {{ $profile->performance }}</div>
        <div class="my-2"><strong>BIO</strong>: {{ $profile->bio }}</div>
        <button class="btn btn-dark mt-4">
            <a href="{{ route('admin.profiles.edit', $profile->id) }}">Modifica profilo</a>
        </button>
    </div>
@endsection