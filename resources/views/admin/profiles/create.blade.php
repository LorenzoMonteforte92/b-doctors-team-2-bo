@extends('layouts.admin')
@section('title') {{'Crea Profilo'}} @endsection
@section('content')
    <h2 class="brand-text-color-1"><strong>Inserisci il tuo profilo</strong></h2>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    <form action="{{ route('admin.profiles.store') }}" method="POST" enctype="multipart/form-data">
        @csrf        

        <div class="mb-4 ">
            <label for="specialisations" class="form-label brand-text-color-1"><strong>Specializzazioni *</strong></label><br>
            <div class="spec-wrapper w-50">
                @foreach ($specialisations as $specialisation)
                    <span class="form-check w-50">
                        <input class="form-check-input @error('specialisations') is-invalid @enderror " @checked(in_array($specialisation->id, old('specialisations', []))) name="specialisations[]" type="checkbox" value="{{ $specialisation->id }}" id="specialisation-{{ $specialisation->id }}">
                        <label class="form-check-label" for="specialisation-{{ $specialisation->id }}">
                            {{ $specialisation->name }}
                        </label>
                        @if ($loop->last)
                        @error('specialisations')
                            <div class=" ps-0 pt-2 invalid-feedback">{{$message}}</div>
                        @enderror
                        @endif
                    </span>
                @endforeach
            </div>
        </div>

        <div class="mb-4">
            <label for="photo" class="form-label brand-text-color-1"><strong>Fotografia</strong></label>
            <input class="form-control @error('photo') is-invalid @enderror " type="file" id="photo" name="photo" value="{{ old('photo') }}">
            @error('photo')
                <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="telephone_number" class="form-label brand-text-color-1"><strong>Telefono *</strong></label>
            <input class="form-control @error('telephone_number') is-invalid @enderror " type="text" id="telephone_number" name="telephone_number" value="{{ old('telephone_number') }}"></input>
            @error('telephone_number')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="bio" class="form-label brand-text-color-1"><strong>Bio</strong></label>
            <textarea class="form-control @error ('bio') is-invalid @enderror " rows="8" id="bio" name="bio">{{ old('bio') }}</textarea>
            @error('bio')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="performance" class="form-label brand-text-color-1"><strong>Prestazioni</strong></label>
            <textarea class="form-control @error ('performance') is-invalid @enderror " rows="8" id="performance" name="performance">{{ old('performance') }}</textarea>
            @error('performance')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="curriculum_vitae" class="form-label brand-text-color-1"><strong>Curriculum</strong></label>
            <input class="form-control @error('curriculum_vitae') is-invalid @enderror " type="file" id="curriculum_vitae" name="curriculum_vitae" value="{{ old('curriculum_vitae') }}">
            @error('curriculum_vitae')
                <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>
        
        <button type="submit" class="btn btn-bd-primary mb-4">Salva</button>
    </form>
@endsection