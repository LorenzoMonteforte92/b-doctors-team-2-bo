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
                <tr>
                    <td scope="row">Silver</td>
                    <td>24h</td>
                    <td>2.99€</td>
            
                    <td>
                        <a class="btn btn-bd-primary mt-2"
                            href="{{ route('admin.payments.silver') }}">
                            <i class="fa-solid fa-money-bill"></i></i> Acquista
                        </a>
                    </td>
                </tr>
                <tr>
                    <td scope="row">Gold</td>
                    <td>72h</td>
                    <td>5.99€</td>
            
                    <td>
                        <a class="btn btn-bd-primary mt-2"
                            href="{{ route('admin.payments.gold') }}">
                            <i class="fa-solid fa-money-bill"></i></i> Acquista
                        </a>
                    </td>
                </tr>
                <tr>
                    <td scope="row">Platinum</td>
                    <td>144h</td>
                    <td>9.99€</td>
            
                    <td>
                        <a class="btn btn-bd-primary mt-2"
                            href="{{ route('admin.payments.platinum') }}">
                            <i class="fa-solid fa-money-bill"></i></i> Acquista
                        </a>
                    </td>
                </tr>
                
        </tbody>
    </table>
@endsection
