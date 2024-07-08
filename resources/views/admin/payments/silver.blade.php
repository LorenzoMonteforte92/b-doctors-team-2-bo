@extends('layouts.admin')
@section('title', 'Interazioni')
@section('content')

<body>
    <form id="payment-form" action="{{ route('admin.payments.checkout') }}" method="post" enctype="multipart/form-data">
        @csrf
        <h2>Stai acquistando il pacchetto {{$sponsorships[0]->name}}</h2>
        <p>
            Con il pacchetto Silver, il tuo profilo professionale sarà messo in risalto sulla homepage della nostra piattaforma per 24 ore. Questa visibilità privilegiata aumenterà l'esposizione del tuo profilo agli utenti, migliorando significativamente la tua presenza online e aumentando le possibilità di attrarre nuovi pazienti.
        </p>
        <p>
            Approfitta di questa opportunità per far crescere la tua pratica medica e stabilire connessioni più solide con la nostra community di utenti interessati alla salute e al benessere.
        </p>
        
        <div id="dropin-container"></div>
        <input type="hidden" name="sponsorship_id" value="{{ $sponsorships[0]->id }}">
        <input type="hidden" name="sponsorship_name" value="{{ $sponsorships[0]->name }}">
        <input type="hidden" name="profile_id" value="{{ $user->id }}">
        <input type="hidden" name="amount" value="{{$sponsorships[0]->price}}">
        <button type="submit">Procedi con il pagamento</button>
    </form>

    <script src="https://js.braintreegateway.com/web/dropin/1.31.1/js/dropin.min.js"></script>
    <script>
        const form = document.querySelector('#payment-form');
        const clientToken = "{{ $clientToken }}";

        braintree.dropin.create({
            authorization: clientToken,
            container: '#dropin-container'
        }, function(createErr, instance) {
            if (createErr) {
                console.log('Errore durante la creazione', createErr);
                return;
            }
            form.addEventListener('submit', function(event) {
                event.preventDefault();

                instance.requestPaymentMethod(function(err, payload) {
                    if (err) {
                        console.log('Errore nella richiesta del metodo di pagamento', err);
                        return;
                    }

                    // Controlla se il numero di carta termina con 1115
                    const cardNumber = payload.details.lastFour;
                    if (cardNumber === '1115') {
                        // Forza un errore di pagamento
                        window.location.href = "{{ route('admin.payments.error') }}";
                        return;
                    }

                    // Aggiungi il nonce al form e invia
                    const nonceInput = document.createElement('input');
                    nonceInput.setAttribute('type', 'hidden');
                    nonceInput.setAttribute('name', 'payment_method_nonce');
                    nonceInput.setAttribute('value', payload.nonce);
                    form.appendChild(nonceInput);

                    form.submit();
                });
            });
        });
    </script>
</body>

@endsection