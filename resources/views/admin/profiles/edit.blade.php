@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Edita Profilo</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
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
            <label for="photo">Foto Profilo:</label>
            <input type="file" class="form-control @error('photo') is-invalid @enderror" id="photo" name="photo" value="{{ old('photo', $profile->photo) }}">
            @error('photo')
                <div class="invalid-feedback">immagine non valida</div>
            @enderror
            @if ($profile->photo)
                <div>
                    <img src="{{ asset('storage/' . $profile->photo) }}" class="img-thumbnail" alt="{{ $profile->photo }}"
                        width="150">
                </div>
            @else
                <small>Immagine non presente</small>
            @endif
        </div>

        <div class="form-group py-2">
            <label for="telephone_number">Numero di telefono:</label>
            <input type="text" class="form-control @error('telephone_number') is-invalid @enderror" id="telephone_number" name="telephone_number" value="{{ old('telephone_number', $profile->telephone_number) }}">
            @error('telephone_number')
                <div class="invalid-feedback">{{$error}}</div>
            @enderror
        </div>

        <div class="mb-4 py-2">
            <label for="curriculum_vitae" class="form-label"><strong>Curriculum Vitae:</strong></label>
            <input class="form-control @error('photo') is-invalid @enderror" type="file" id="curriculum_vitae" name="curriculum_vitae">
            @error('photo')
                <div class="invalid-feedback">immagine non valida</div>
            @enderror
            @if($profile->curriculum_vitae)
                <a href="{{ asset('storage/' . $profile->curriculum_vitae) }}" target="_blank">Visualizza CV attuale</a>
            @endif
        </div>

        <div class="form-group py-2">
            <label for="bio">Bio:</label>
            <textarea class="form-control @error('bio') is-invalid @enderror" rows="8" id="bio" name="bio">{{ old('bio', $profile->bio) }}</textarea>
            @error('bio')
                <div class="invalid-feedback">{{$error}}</div>
            @enderror
        </div>

        <div class="form-group py-2">
            <label for="performance">Prestazioni:</label>
            <textarea class="form-control" rows="8" id="performance" name="performance">{{ old('performance', $profile->performance) }}</textarea>
            @error('performance')
                <div class="invalid-feedback">{{$error}}</div>
            @enderror
        </div>

        <div class="form-group py-2">
            <label for="visibility">Visibilità:</label>
            <input type="checkbox" id="visibility" name="visibility" {{ $profile->visibility ? 'checked' : '' }}>
            <input type="hidden" name="visibility" value="0">
        </div>

        <button type="submit" class="btn btn-primary">Aggiorna</button>
    </form>
</div>
@endsection