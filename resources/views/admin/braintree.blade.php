@extends('layouts.app')

@section('content')

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Modulo di Pagamento</h4>
                </div>
                <div class="card-body">
                    <!-- Aggiungi il tuo form action al controller Laravel che gestisce il pagamento -->
                    <form action="{{ route('admin.processPayment') }}" method="POST" id="payment-form">
                        @csrf
                        <div class="mb-3">
                            <label for="cardholder-name" class="form-label">Nome del Titolare della Carta</label>
                            <input type="text" class="form-control" id="cardholder-name" name="cardholder_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="card-element" class="form-label">Dettagli della Carta</label>
                            <div id="card-element"></div>
                        </div>
                        <!-- Aggiungi il tuo campo per il payment_method_nonce di Braintree -->
                        <input type="hidden" id="nonce" name="payment_method_nonce">
                        <button type="submit" class="btn btn-primary" id="submit-button">Effettua Pagamento</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- <script src="https://js.braintreegateway.com/web/dropin/1.31.0/js/dropin.min.js"></script> --}}

<script>
    var form = document.getElementById('payment-form');
    var submitButton = document.getElementById('submit-button');

    braintree.dropin.create({
        authorization: 'YOUR_BRAINTREE_CLIENT_TOKEN',
        selector: '#card-element',
        paypal: {
            flow: 'vault'
        }
    }, function (createErr, instance) {
        if (createErr) {
            console.log('Errore durante la creazione di Braintree Drop-in:', createErr);
            return;
        }

        form.addEventListener('submit', function (event) {
            event.preventDefault();

            instance.requestPaymentMethod(function (err, payload) {
                if (err) {
                    console.log('Errore durante la richiesta del metodo di pagamento:', err);
                    return;
                }

                // Imposta il valore del payment_method_nonce nel campo nascosto
                document.getElementById('nonce').value = payload.nonce;

                // Invia il modulo al tuo controller Laravel per elaborare il pagamento
                form.submit();
            });
        });

        submitButton.removeAttribute('disabled');
    });
</script>


    
@endsection

