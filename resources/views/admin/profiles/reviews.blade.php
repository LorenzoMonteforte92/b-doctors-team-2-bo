@extends('layouts.admin')
@section('title')
    {{ 'Interazioni' }}
@endsection


@section('content')
    <div class="container">
        <h2>Statistiche recensioni ricevute</h2>
        <canvas id="myChart" width="400" height="200"></canvas>
    </div>
    {{-- se ha recensioni mostra le recensioni, altrimenti mostra un messaggio 'non hai ancora recensioni' e propone una sponsorship --}}
    @if ($reviews->count() > 0)
        <h1 class="brand-text-color-1">Recensioni Ricevute</h1>
        <table class="table table-bordered brand-color-2-border  align-middle">
            <thead>
                <th class="text-center brand-text-color-1">Nome utente</th>
                <th class="text-center brand-text-color-1">Descrizione</th>
                <th class="text-center brand-text-color-1">Valutazione</th>
                <th class="text-center brand-text-color-1">Data</th>
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
                            <td><i class="fas fa-star brand-text-color-1"></i>
                                <i class="fas fa-star brand-text-color-1"></i>
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
                        <td>{{ \Carbon\Carbon::parse($review->created_at)->format('d/m/Y H:i') }}</td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <h1 class="brand-text-color-1">Recensioni</h1>
        <p class="brand-text-color-1">Non hai ancora ricevuto recensioni</p>
        <p class="brand-text-color-1">Vuoi ricevere recensioni? Sponsorizza il tuo account!</p>

        <a href="{{ route('admin.sponsorships.index') }}" class="btn btn-bd-primary">Sponsor<i class="fas fa-hand-holding-usd"></i></a>
    @endif
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let ctx = document.getElementById('myChart').getContext('2d');

            // Converti i dati di PHP in JavaScript
            let chartData = @json($chartData);

            // Verifica se chartData contiene dati
            if (chartData.length === 0) {
                console.error("Nessun dato disponibile");
                return;
            }

            // Estrai i dati necessari per il grafico
            let labels = chartData.map(item => item.date);
            let values = chartData.map(item => item.average_rating);

            // Crea il grafico
            let myChart = new Chart(ctx, {
                type: 'bar', // Tipo di grafico: 'bar', 'line', 'pie', ecc.
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Valutazione Media Mensile',
                        data: values,
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>
@endsection
