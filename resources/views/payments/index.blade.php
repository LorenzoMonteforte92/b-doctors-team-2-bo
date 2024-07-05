@extends('layouts.admin')
@section('title')
    {{ 'Interazioni' }}
@endsection
@section('content')

    <body>
        <form id="payment-form" action="{{ route('admin.payments.checkout') }}" method="post">
            @csrf
            <div id="dropin-container"></div>
            <input type="hidden" name="amount" value="10.00">
            <button type="submit">Submit Payment</button>
        </form>

        <script src="https://js.braintreegateway.com/web/dropin/1.31.1/js/dropin.min.js"></script>
        <script>
            var form = document.querySelector('#payment-form');
            var clientToken = "{{ $clientToken }}";

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

                        // Add the nonce to the form and submit
                        var nonceInput = document.createElement('input');
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
