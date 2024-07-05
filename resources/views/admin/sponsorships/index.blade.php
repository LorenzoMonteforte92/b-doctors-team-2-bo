@extends('layouts.admin')

@section('content')
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Sponsorizzazione</th>
                <th scope="col">Durata</th>
                <th scope="col">Prezzo</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sponsorships as $sponsorship)
                <tr>
                    <td scope="row">{{ $sponsorship->name }}</td>
                    <td>{{ $sponsorship->duration }}</td>
                    <td>{{ $sponsorship->price }}</td>
                    <td>
                        <a class="btn btn-bd-primary mt-2"
                            href="{{ route('payments.index') }}">
                            <i class="fa-solid fa-money-bill"></i></i> Acquista
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
