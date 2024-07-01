@extends('layouts.admin')

@section('content')
        <h2 class="brand-text-color-1">Il tuo profilo</h2>

        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
        <div class="profile-wrapper">
            @if ($profile->photo)
                <img src="{{ asset('storage/' . $profile->photo) }}" alt="{{ $profile->name }}">
            @endif
            <div class="my-2"><strong class="brand-text-color-1 ">Email:</strong> {{ $user->email }}</div>
            <div class="my-2"><strong class="brand-text-color-1 ">Nome:</strong> {{ $user->name }}</div>
            <div class="my-2 "><strong class="brand-text-color-1 ">Indirizzo:</strong> {{ $user->address }}</div>
            <div class="my-2 "><strong class="brand-text-color-1 ">Numero di Telefono:</strong> {{ $profile->telephone_number }}</div>
            @if ($profile->curriculum_vitae)
                <div><strong class="brand-text-color-1 ">Curriculum Vitae</strong></div>
                <img src="{{ asset('storage/' . $profile->curriculum_vitae) }}" alt="{{ $profile->name }}">
            @endif
            <div><strong class="my-2 brand-text-color-1">Specializzazioni:</strong>
                @if (count($profile->specialisations) > 0)
                    @foreach ($profile->specialisations as $specialisation)
                        {{ $specialisation->name }}@if (!$loop->last),@endif
                    @endforeach
                @endif
            </div>
            <div class="my-2"><strong class="brand-text-color-1">Prestazioni:</strong> {{ $profile->performance }}</div>
            <div class="my-2"><strong class="brand-text-color-1">Biografia:</strong> {{ $profile->bio }}</div>
        </div>
@endsection