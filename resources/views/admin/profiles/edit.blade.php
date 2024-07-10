@extends('layouts.admin')
@section('title')
    {{ 'Modifica Profilo' }}
@endsection

@section('content')

    <h2 class="brand-text-color-1">Edita Profilo</h2>
    @if ($errors->any())
        <div class="alert alert-danger">
            {{ $errors }}
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.profiles.update', $profile->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group py-2">
            <label for="visibility" class="brand-text-color-1"><strong>Visibilità:</strong></label>
            {{-- edita la visibilità, seleziona di default il valore attivo --}}
            <select name="visibility" id="visibility" class="form-control" required>
                <option value="1" {{ $profile->visibility == 1 ? 'selected' : '' }}>Visibile</option>
                <option value="0" {{ $profile->visibility == 0 ? 'selected' : '' }}>Nascosto</option>
            </select>
        </div>
        <div class="form-group py-2">
            <label for="photo" class="brand-text-color-1"><strong>Foto Profilo:</strong></label>
            <input type="file" class="form-control @error('photo') is-invalid @enderror" id="photo" name="photo"
                value="{{ old('photo', $profile->photo) }}">
            @error('photo')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            @if ($profile->photo)
                <div>
                    <img src="{{ asset('storage/' . $profile->photo) }}" class="img-thumbnail" alt="{{ $profile->photo }}"
                        width="150">
                </div>
            @endif
        </div>

        <div class="form-group py-2">
            <label for="telephone_number" class="brand-text-color-1"><strong>Numero di telefono:</strong> <strong
                    class="text-danger">*</strong></label>
            <input type="text" class="form-control @error('telephone_number') is-invalid @enderror" id="telephone_number"
                name="telephone_number" value="{{ old('telephone_number', $profile->telephone_number) }}">
            @error('telephone_number')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="specialisations" class="form-label brand-text-color-1"><strong>Specializzazioni <strong
                        class="text-danger">*</strong></strong></label><br>
            <div class="spec-wrapper">
                @foreach ($specialisations as $specialisation)
                    <span class="form-check w-50">
                        @if ($errors->any())
                            <input class="form-check-input @error('specialisations') is-invalid @enderror "
                                @checked(in_array($specialisation->id, old('specialisations', []))) name="specialisations[]" type="checkbox"
                                value="{{ $specialisation->id }}" id="specialisation-{{ $specialisation->id }}">
                        @else
                            <input @checked($profile->specialisations->contains($specialisation)) class="form-check-input" type="checkbox"
                                name="specialisations[]" value="{{ $specialisation->id }}"
                                id="specialisation-{{ $specialisation->id }}">
                        @endif
                        <label class="form-check-label" for="specialisation-{{ $specialisation->id }}">
                            {{ $specialisation->name }}
                        </label>
                        @if ($loop->last)
                            @error('specialisations')
                                <div class=" ps-0 pt-2 invalid-feedback">{{ $message }}</div>
                            @enderror
                        @endif
                    </span>
                @endforeach
            </div>
        </div>

        <div class="mb-4 py-2">
            <label for="curriculum_vitae" class="form-label brand-text-color-1"><strong>Curriculum Vitae:</strong></label>
            <input class="form-control @error('curriculum_vitae') is-invalid @enderror" type="file" id="curriculum_vitae"
                name="curriculum_vitae">
            @error('curriculum_vitae')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            @if ($profile->curriculum_vitae)
                <a href="{{ asset('storage/' . $profile->curriculum_vitae) }}" target="_blank">Visualizza CV attuale</a>
            @endif
        </div>

        <div class="form-group py-2">
            <label for="bio" class="brand-text-color-1"><strong>Biografia:</strong></label>
            <textarea class="form-control @error('bio') is-invalid @enderror" rows="8" id="bio" name="bio">{{ old('bio', $profile->bio) }}</textarea>
            @error('bio')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group py-2">
            <label for="performance" class="brand-text-color-1"><strong>Prestazioni:</strong></label>
            <textarea class="form-control @error('performance') is-invalid @enderror " rows="8" id="performance"
                name="performance">{{ old('performance', $profile->performance) }}</textarea>
            @error('performance')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>


        <button type="submit" class="btn btn-bd-primary mb-4">Aggiorna</button>
    </form>

@endsection
