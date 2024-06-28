@extends('layouts.admin')

@section('content')
<div class="container">
    <h2 class="brand-text-color-1">Edita Profilo</h2>
    @if ($errors->any())
        <div class="alert alert-danger">
            {{$errors}}
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
            <label for="photo" class="brand-text-color-1">Foto Profilo:</label>
            <input type="file" class="form-control @error('photo') is-invalid @enderror" id="photo" name="photo" value="{{ old('photo', $profile->photo) }}">
            @error('photo')
                <div class="invalid-feedback">{{$message}}</div>
            @enderror
            @if ($profile->photo)
                <div>
                    <img src="{{ asset('storage/' . $profile->photo) }}" class="img-thumbnail" alt="{{ $profile->photo }}"
                        width="150">
                </div>
            @endif
        </div>

        <div class="form-group py-2">
            <label for="telephone_number" class="brand-text-color-1">Numero di telefono: *</label>
            <input type="text" class="form-control @error('telephone_number') is-invalid @enderror" id="telephone_number" name="telephone_number" value="{{ old('telephone_number', $profile->telephone_number) }}">
            @error('telephone_number')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4 py-2">
            <label for="curriculum_vitae" class="form-label brand-text-color-1"><strong>Curriculum Vitae:</strong></label>
            <input class="form-control @error('curriculum_vitae') is-invalid @enderror" type="file" id="curriculum_vitae" name="curriculum_vitae">
            @error('curriculum_vitae')
                <div class="invalid-feedback">{{$message}}</div>
            @enderror
            @if($profile->curriculum_vitae)
                <a href="{{ asset('storage/' . $profile->curriculum_vitae) }}" target="_blank">Visualizza CV attuale</a>
            @endif
        </div>

        <div class="form-group py-2">
            <label for="bio" class="brand-text-color-1">Bio:</label>
            <textarea class="form-control @error('bio') is-invalid @enderror" rows="8" id="bio" name="bio">{{ old('bio', $profile->bio) }}</textarea>
            @error('bio')
                <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>

        <div class="form-group py-2">
            <label for="performance" class="brand-text-color-1">Prestazioni:</label>
            <textarea class="form-control @error('performance') is-invalid @enderror " rows="8" id="performance" name="performance">{{ old('performance', $profile->performance) }}</textarea>
            @error('performance')
                <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>

        <div class="form-group py-2">
            <label for="visibility" class="brand-text-color-1">Visibilità:</label>
            <input type="checkbox" id="visibility" name="visibility" {{ $profile->visibility ? 'checked' : '' }}>
            <input type="hidden" name="visibility" value="0">
        </div>

        <button type="submit" class="btn btn-bd-primary mb-4">Aggiorna</button>
    </form>
</div>
@endsection