@extends('layouts.admin')

@section('content')
    <h2>Inserisci il tuo profilo</h2>

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
        
        <div class="mb-4">
            <label for="curriculum_vitae" class="form-label"><strong>Curriculum</strong></label>
            <input class="form-control @error('curriculum_vitae') is-invalid @enderror " type="file" id="curriculum_vitae" name="curriculum_vitae">
            @error('curriculum_vitae')
                <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>
        

        <div class="mb-4">
            <label for="specialisations" class="form-label"><strong>Specializzazioni *</strong></label><br>
            @foreach ($specialisations as $specialisation)
                <span class="form-check">
                    <input class="form-check-input @error('specialisations') is-invalid @enderror " @checked(in_array($specialisation->id, old('specialisations', []))) name="specialisations[]" type="checkbox" value="{{ $specialisation->id }}" id="specialisation-{{ $specialisation->id }}">
                    <label class="form-check-label" for="specialisation-{{ $specialisation->id }}">
                        {{ $specialisation->name }}
                    </label>
                </span>
            @endforeach
        </div>

        <div class="mb-4">
            <label for="photo" class="form-label"><strong>Fotografia</strong></label>
            <input class="form-control @error('photo') is-invalid @enderror " type="file" id="photo" name="photo">
            @error('photo')
                <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="address" class="form-label"><strong>Indirizzo *</strong></label>
            <input class="form-control @error('address') is-invalid @enderror " type="text" id="address" name="address"></input>
            @error('address')
                <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="telephone_number" class="form-label"><strong>Telefono *</strong></label>
            <input class="form-control @error('telephone_number') is-invalid @enderror " type="text" id="telephone_number" name="telephone_number"></input>
            @error('telephone_number')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="bio" class="form-label"><strong>Bio</strong></label>
            <textarea class="form-control @error ('bio') is-invalid @enderror " rows="8" id="bio" name="bio"></textarea>
            @error('bio')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="performance" class="form-label"><strong>Prestazioni</strong></label>
            <textarea class="form-control @error ('performance') is-invalid @enderror " rows="8" id="performance" name="performance"></textarea>
            @error('performance')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary mb-4">Salva</button>
    </form>
@endsection