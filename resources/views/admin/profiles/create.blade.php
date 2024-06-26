@extends('layouts.admin')

@section('content')
    <h2>Inserisci il tuo profilo</h2>

    <form action="{{ route('admin.profiles.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="mb-4">
            <label for="cover_image" class="form-label">Curriculum</label>
            <input class="form-control" type="file" id="cover_image" name="cover_image">
        </div>

        <div class="mb-4">
            <label for="client_name" class="form-label">Specializzazioni</label>
            @foreach ($specialisations as $specialisation)
            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
            <label class="form-check-label" for="flexCheckDefault">
                {{ $specialisation }}
            </label>
        </div>

        <div class="mb-4">
            <label for="cover_image" class="form-label">Fotografia</label>
            <input class="form-control" type="file" id="cover_image" name="cover_image">
        </div>

        <div class="mb-4">
            <label for="summary" class="form-label">Indirizzo</label>
            <input class="form-control" type="text" id="summary" name="summary"></input>
        </div>

        <div class="mb-4">
            <label for="summary" class="form-label">Telefono</label>
            <input class="form-control" type="text" id="summary" name="summary"></input>
        </div>

        <button type="submit" class="btn btn-primary">Salva</button>
    </form>
@endsection