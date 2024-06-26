@extends('layouts.admin')

@section('content')
    <h2>Inserisci il tuo profilo</h2>

    <form action="{{ route('admin.profiles.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="mb-4">
            <label for="curriculum_vitae" class="form-label"><strong>Curriculum</strong></label>
            <input class="form-control" type="file" id="curriculum_vitae" name="curriculum_vitae">
        </div>

        <div class="mb-4">
            <label for="specialisations" class="form-label"><strong>Specializzazioni</strong></label><br>
            @foreach ($specialisations as $specialisation)
                <span class="form-check">
                    <input class="form-check-input" @checked(in_array($specialisation->id, old('specialisations', []))) name="specialisations[]" type="checkbox" value="{{ $specialisation->id }}" id="specialisation-{{ $specialisation->id }}">
                    <label class="form-check-label" for="specialisation-{{ $specialisation->id }}">
                        {{ $specialisation->name }}
                    </label>
                </span>
            @endforeach
        </div>

        <div class="mb-4">
            <label for="photo" class="form-label"><strong>Fotografia</strong></label>
            <input class="form-control" type="file" id="photo" name="photo">
        </div>

        <div class="mb-4">
            <label for="address" class="form-label"><strong>Indirizzo</strong></label>
            <input class="form-control" type="text" id="address" name="address"></input>
        </div>

        <div class="mb-4">
            <label for="telephone_number" class="form-label"><strong>Telefono</strong></label>
            <input class="form-control" type="text" id="telephone_number" name="telephone_number"></input>
        </div>
        <div class="mb-4">
            <label for="bio" class="form-label"><strong>Bio</strong></label>
            <textarea class="form-control" rows="15" id="bio" name="bio"></textarea>
        </div>
        <div class="mb-4">
            <label for="performance" class="form-label"><strong>Prestazioni</strong></label>
            <textarea class="form-control" rows="15" id="performance" name="performance"></textarea>
        </div>

        <button type="submit" class="btn btn-primary mb-4">Salva</button>
    </form>
@endsection