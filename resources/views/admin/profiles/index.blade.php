@extends('layouts.admin')

@section('content')

    <h1 class="brand-text-color-1">Recensioni Ricevute</h1>
    <table class="table table-bordered brand-color-2-border  align-middle">
        <thead>
            <th class="text-center brand-text-color-1">Nome utente</th>
            <th class="text-center brand-text-color-1">Descrizione</th>
            <th class="text-center brand-text-color-1">Valutazione</th>
        </thead>
        <tbody>
            @foreach ($reviews as $review)
                <tr>
                    <td>{{ $review->name }}</td>
                    <td>{{ $review->description }}</td>
                    <td>{{ $review->score }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <h1 class="brand-text-color-1">Messaggi Ricevuti</h1>
    <table class="table table-bordered brand-color-2-border align-middle">
        <thead>
            <th class="text-center brand-text-color-1">Nome utente</th>
            <th class="text-center brand-text-color-1">Descrizione</th>
            <th class="text-center brand-text-color-1">Email</th>
            <th class="text-center brand-text-color-1">Data</th>
        </thead>
        <tbody>
            @foreach ($messages as $message)
                <tr>
                    <td>{{ $message->name }}</td>
                    <td>{{ $message->description }}</td>
                    <td>{{ $message->email }}</td>
                    <td>{{ $message->date }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection