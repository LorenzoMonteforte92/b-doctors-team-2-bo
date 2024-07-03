@extends('layouts.admin')
@section('title')
    {{ 'Interazioni' }}
@endsection


@section('content')

    {{-- se ha recensioni mostra le recensioni, altrimenti mostra un messaggio 'non hai ancora recensioni' e propone una sponsorship --}}
    <a href="" class="btn btn-bd-primary">Sponsor<i class="fas fa-hand-holding-usd"></i></a>
    @if ($reviews->count() > 0)
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
    @else
        <h1 class="brand-text-color-1">Recensioni</h1>
        <p class="brand-text-color-1">Non hai ancora ricevuto recensioni</p>
        <p class="brand-text-color-1">Vuoi ricevere recensioni? Sponsorizza il tuo account!</p>
    @endif

    {{-- Mostra i messaggi ricevuti se ce ne sono, altrimenti 'Non hai ricevuto messaggi' --}}
    @if ($messages->count() > 0)
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
                        <td>{{ $message->message }}</td>
                        <td>{{ $message->email }}</td>
                        <td>{{ $message->date }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <h1 class="brand-text-color-1">Messaggi</h1>
        <p class="brand-text-color-1">Non hai ancora ricevuto messaggi</p>
    @endif
@endsection
