@extends('layouts.admin')
@section('title')
    {{ 'Interazioni' }}
@endsection
@section('content')

<body>
    <form id="payment-form" action="{{ route('admin.payments.checkout') }}" method="post" enctype="multipart/form-data">
        @csrf
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
                            <label for="{{$sponsorship->id}}"></label>
                            <input type="checkbox" name="{{$sponsorship->id}}" id="{{$sponsorship->id}}" value="{{$sponsorship->id}}">
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div id="dropin-container"></div>
        <input type="hidden" name="sponsorhip_id" value="{{ $sponsorship->id }}">
        <input type="hidden" name="sponsorhip_name" value="{{ $sponsorship->name }}">
        <input type="hidden" name="profile_id" value="{{ $user->id }}">
        <input type="hidden" name="amount" value="{{$sponsorship->price}}">
        <button type="submit">Submit Payment</button>
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
                console.log('Create Error', createErr);
                return;
            }
            form.addEventListener('submit', function(event) {
                event.preventDefault();

                instance.requestPaymentMethod(function(err, payload) {
                    if (err) {
                        console.log('Request Payment Method Error', err);
                        return;
                    }

                    // serve a controllare se la carta finisce con 1115 se è così forza l'errore di pagamento
                    const cardNumber = payload.details.lastFour;
                    if (cardNumber === '1115') {
                        window.location.href = "{{ route('admin.payments.error') }}";
                        return;
                    }

                    // Aggiungi il nonce al form e invia il form
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

</html>
@endsection