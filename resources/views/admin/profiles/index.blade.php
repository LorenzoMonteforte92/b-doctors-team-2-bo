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
                        {{-- faccio un if per le stelle in base al valore di score --}}
                        @if ($review->rating->score == 1)
                            <td><i class="fas fa-star brand-text-color-1"></i></td>
                        @elseif ($review->rating->score == 2)
                            <td><i class="fas fa-star brand-text-color-1"></i><i class="fas fa-star brand-text-color-1"></i>
                            </td>
                        @elseif ($review->rating->score == 3)
                            <td><i class="fas fa-star brand-text-color-1"></i>
                                <i class="fas fa-star brand-text-color-1"></i>
                                <i class="fas fa-star brand-text-color-1"></i>
                            </td>
                        @elseif ($review->rating->score == 4)
                            <td><i class="fas fa-star brand-text-color-1"></i>
                                <i class="fas fa-star brand-text-color-1"></i>
                                <i class="fas fa-star brand-text-color-1"></i>
                                <i class="fas fa-star brand-text-color-1"></i>
                            </td>
                        @elseif ($review->rating->score == 5)
                            <td><i class="fas fa-star brand-text-color-1"></i>
                                <i class="fas fa-star brand-text-color-1"></i>
                                <i class="fas fa-star brand-text-color-1"></i>
                                <i class="fas fa-star brand-text-color-1"></i>
                                <i class="fas fa-star brand-text-color-1"></i>
                            </td>
                        @endif

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

    {{-- {{dd($messages)}} --}}
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
