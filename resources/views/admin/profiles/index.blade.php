@extends('layouts.admin')

@section('content')

    <h1>RECENSIONI RICEVUTE</h1>
    <table class="table table-bordered border-primary align-middle">
        <thead>
            <th class="text-center">Nome utente</th>
            <th class="text-center">Descrizione</th>
            <th class="text-center">Valutazione</th>
        </thead>
        <tbody>
            @foreach ($reviews as $review)
                <tr>
                    <td><strong>{{ $review->name }}</strong></td>
                    <td>{{ $review->description }}</td>
                    {{-- <td>{{ $review->score }}</td> --}}
                </tr>
            @endforeach
        </tbody>
    </table>
    <h1>MESSAGGI RICEVUTI</h1>
    <table class="table table-bordered border-primary align-middle">
        <thead>
            <th class="text-center">Nome utente</th>
            <th class="text-center">Descrizione</th>
            <th class="text-center">Email</th>
            <th class="text-center">Data</th>
        </thead>
        <tbody>
            @foreach ($messages as $message)
                <tr>
                    <td><strong>{{ $message->name }}</strong></td>
                    <td>{{ $message->description }}</td>
                    <td>{{ $message->email }}</td>
                    <td>{{ $message->date }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection