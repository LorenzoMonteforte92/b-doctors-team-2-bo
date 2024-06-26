@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Edita Profilo</h2>
    <form action="{{ route('admin.profiles.update', $profile->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group py-2">
            <label for="photo">Foto Profilo:</label>
            <input type="text" class="form-control" id="photo" name="photo" value="{{ old('photo', $profile->photo) }}">
        </div>

        <div class="form-group py-2">
            <label for="telephone_number">Numero di telefono:</label>
            <input type="text" class="form-control" id="telephone_number" name="telephone_number" value="{{ old('telephone_number', $profile->telephone_number) }}">
        </div>

        <div class="mb-4 py-2">
            <label for="curriculum_vitae" class="form-label"><strong>Curriculum Vitae:</strong></label>
            <input class="form-control" type="file" id="curriculum_vitae" name="curriculum_vitae">
        </div>

        

        <div class="form-group py-2">
            <label for="bio">Bio:</label>
            <textarea class="form-control" id="bio" name="bio">{{ old('bio', $profile->bio) }}</textarea>
        </div>

        <div class="form-group py-2">
            <label for="performance">Prestazioni:</label>
            <textarea class="form-control" id="performance" name="performance">{{ old('performance', $profile->performance) }}</textarea>
        </div>

        <div class="form-group py-2">
            <label for="visibility">Visibilità:</label>
            <input type="checkbox" id="visibility" name="visibility" {{ old('visibility', $profile->visibility) ? 'checked' : '' }}>
        </div>

        <button type="submit" class="btn btn-primary">Aggiorna</button>
    </form>
</div>
@endsection