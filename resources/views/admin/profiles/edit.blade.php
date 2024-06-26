@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Edita Profilo</h2>
    <form action="{{ route('admin.profiles.update', $profile->slug) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')


        <div class="form-group">
            <label for="photo">Foto Profilo:</label>
            <input type="text" class="form-control" id="photo" name="photo" value="{{ $profiles->photo }}">
        </div>

        <div class="form-group">
            <label for="telephone_number">Numero di telefono:</label>
            <input type="text" class="form-control" id="telephone_number" name="telephone_number" value="{{ $profiles->telephone_number }}">
        </div>

        <div class="form-group">
            <label for="curriculum_vitae">Curriculum Vitae:</label>
            <textarea class="form-control" id="curriculum_vitae" name="curriculum_vitae">{{ $profiles->curriculum_vitae }}</textarea>
        </div>

        <div class="form-group">
            <label for="bio">Bio:</label>
            <textarea class="form-control" id="bio" name="bio">{{ $profiles->bio }}</textarea>
        </div>

        <div class="form-group">
            <label for="performance">Prestazioni:</label>
            <textarea class="form-control" id="performance" name="performance">{{ $profiles->performance }}</textarea>
        </div>

        <div class="form-group">
            <label for="visibility">Visibility:</label>
            <input type="checkbox" id="visibility" name="visibility" {{ $profiles->visibility ? 'checked' : '' }}>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection