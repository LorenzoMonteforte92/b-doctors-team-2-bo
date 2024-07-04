@extends('layouts.admin')
@section('title')
    {{ 'Interazioni' }}
@endsection


@section('content')
    {{-- se ha recensioni mostra le recensioni, altrimenti mostra un messaggio 'non hai ancora recensioni' e propone una sponsorship --}}
    
    
    {{-- Mostra i messaggi ricevuti se ce ne sono, altrimenti 'Non hai ricevuto messaggi' --}}

    {{-- {{dd($messages)}} --}}
    @if ($messages->count() > 0)
        <h1 class="brand-text-color-1">Messaggi Ricevuti</h1>
        <table class="table table-bordered brand-color-2-border align-middle">
            <thead>
                <th class="text-center brand-text-color-1">Nome utente</th>
                <th class="text-center brand-text-color-1">Oggetto</th>
                <th class="text-center brand-text-color-1">Descrizione</th>
                <th class="text-center brand-text-color-1">Email</th>
                <th class="text-center brand-text-color-1">Data</th>
            </thead>
            <tbody>
                {{-- mostra i messaggi in ordine di data decrescente --}}
                
                @foreach ($messages as $message)
                    <tr>
                        <td>{{ $message->name }}</td>
                        <td>{{ $message->object }}</td>
                        <td>{{ $message->message }}</td>
                        <td>{{ $message->email }}</td>
                        <td>{{ \Carbon\Carbon::parse($message->date)->format('d/m/Y H:i') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <h1 class="brand-text-color-1">Messaggi</h1>
        <p class="brand-text-color-1">Non hai ancora ricevuto messaggi</p>
    @endif
@endsection
