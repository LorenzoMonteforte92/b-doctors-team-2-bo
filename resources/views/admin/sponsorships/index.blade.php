@extends('layouts.admin')

@section('content')
    <table class="table">
        <thead>
            <tr>
                <th scope="col"><span class="brand-text-color-1">Sponsorizzazione</span></th>
                <th scope="col"><span class="brand-text-color-1">Durata  <i class="fa-regular fa-clock"></i></span></th>
                <th scope="col"><span class="brand-text-color-1">Prezzo</span></th>
                <th scope="col"><span class="brand-text-color-1">Actions <i class="fa-solid fa-hand-holding-dollar"></i></span></th>
            </tr>
        </thead>
        <tbody>
                <tr>
                    <td scope="row"><span class="ms-silver fw-bold">Silver</span></td>
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
                    <td scope="row"><span class="ms-gold fw-bold">Gold</span></td>
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
                    <td scope="row"><span class="ms-platinum fw-bold">Platinum</td>
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
