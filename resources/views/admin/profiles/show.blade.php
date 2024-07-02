@extends('layouts.admin')
@section('title') {{'Profilo di ' . Auth::user()->name}} @endsection

@section('content')

    <h2 class="brand-text-color-1">Il tuo profilo</h2>

    {{-- condizione che se la visibility è su '0' mostra: 'è nascosto a tutti' altrimenti 'è visibile a tutti' --}}
    @if ($user->visibility == 0)
        <div class="alert alert-danger" role="alert">
            <i class="fa fa-exclamation-triangle"></i> Il tuo profilo è nascosto a tutti.
        </div>
    @else
        <div class="alert alert-success" role="alert">
            <i class="fa fa-check-circle"></i> Il tuo profilo è visibile a
            tutti.
        </div>
    @endif


    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
    <div class="profile-wrapper">
        @if ($profile->photo)
            <img class="img-fluid" src="{{ asset('storage/' . $profile->photo) }}" alt="{{ $profile->name }}">
        @endif
        <div class="my-2"><strong class="brand-text-color-1 ">Email:</strong> {{ $user->email }}</div>
        <div class="my-2"><strong class="brand-text-color-1 ">Nome:</strong> {{ $user->name }}</div>
        <div class="my-2 "><strong class="brand-text-color-1 ">Indirizzo:</strong> {{ $user->address }}</div>
        <div class="my-2 "><strong class="brand-text-color-1 ">Numero di Telefono:</strong>
            {{ $profile->telephone_number }}</div>
        @if ($profile->curriculum_vitae)
            <div><strong class="brand-text-color-1 ">Curriculum Vitae</strong></div>
            <img class="img-fluid" src="{{ asset('storage/' . $profile->curriculum_vitae) }}" alt="{{ $profile->name }}">
        @endif
        <div><strong class="my-2 brand-text-color-1">Specializzazioni:</strong>
            @if (count($profile->specialisations) > 0)
                @foreach ($profile->specialisations as $specialisation)
                    {{ $specialisation->name }}@if (!$loop->last)
                        ,
                    @endif
                @endforeach
            @endif
        </div>
        <div class="my-2"><strong class="brand-text-color-1">Prestazioni:</strong> {{ $profile->performance }}</div>

        <div class="my-2"><strong class="brand-text-color-1">Biografia:</strong> {{ $profile->bio }}</div>
    </div>
@endsection
