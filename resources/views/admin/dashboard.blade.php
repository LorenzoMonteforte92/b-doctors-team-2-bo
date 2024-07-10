@extends('layouts.admin')
@section('title') {{Auth::user()->name}} @endsection

@section('content')

    <h2 class="fs-4 my-4 brand-text-color-1 ">
        {{ __('Dashboard') }}
    </h2>
    <div class="row justify-content-center brand-text-color-1 ">
        <div class="col">
            <div class="card">
                <div class="card-header">{{ __('User Dashboard') }}</div>

                <div class="card-body brand-text-color-1 ">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    {{ __('You are logged in!') }}

                    <div>
                        Benvenuto: {{ Auth::user()->name }}.
                    </div>
                </div>
            </div>
            <div class="container-fluid gap-3 my-3 d-flex">
                <div class="w-50">
                    <h2>Statistiche messaggi ricevuti</h2>
                    <canvas id="messageChart" ></canvas>
                </div>
                <div class="w-50">
                    <h2>Statistiche recensioni ricevute</h2>
                    <canvas id="myChart"></canvas>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let ctx = document.getElementById('messageChart').getContext('2d');

            // Converti i dati di PHP in JavaScript
            let messageChartData  = @json($messageChartData);
           
            // Verifica se messagechartData contiene dati
            if (messageChartData.length === 0) {
                console.error("Nessun dato disponibile");
                return;
            }

            // Estrai i dati necessari per il grafico
            let labels = messageChartData.map(item => item.date);
            let values = messageChartData.map(item => item.count);

            // Crea il grafico
            let messageChart  = new Chart(ctx, {
                type: 'bar', // Tipo di grafico: 'bar', 'line', 'pie', ecc.
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Numero di Messaggi',
                        data: values,
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
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