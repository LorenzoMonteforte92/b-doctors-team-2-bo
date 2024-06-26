@extends('layouts.admin')

@section('content')
    <h2>Inserisci il tuo profilo</h2>

    <form action="{{ route('admin.profiles.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="mb-4">
            <label for="cover_image" class="form-label"><strong>Curriculum</strong></label>
            <input class="form-control" type="file" id="cover_image" name="cover_image">
        </div>

        <div class="mb-4">
            <label for="client_name" class="form-label"><strong>Specializzazioni</strong></label><br>
            @foreach ($specialisations as $specialisation)
                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault">
                    {{ $specialisation->name }}
                </label>
            @endforeach
        </div>

        <div class="mb-4">
            <label for="cover_image" class="form-label"><strong>Fotografia</strong></label>
            <input class="form-control" type="file" id="cover_image" name="cover_image">
        </div>

        <div class="mb-4">
            <label for="summary" class="form-label"><strong>Indirizzo</strong></label>
            <input class="form-control" type="text" id="summary" name="summary"></input>
        </div>

        <div class="mb-4">
            <label for="summary" class="form-label"><strong>Telefono</strong></label>
            <input class="form-control" type="text" id="summary" name="summary"></input>
        </div>

        <button type="submit" class="btn btn-primary">Salva</button>
    </form>
@endsection