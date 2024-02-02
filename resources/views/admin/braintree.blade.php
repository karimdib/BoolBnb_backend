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
                            <input type="text" class="form-control" id="cardholder-name" name="cardholder_name"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="cardholder-name" class="form-label">Numero della Carta</label>
                            <input type="number" class="form-control" id="cardholder-name" name="cc-card" required>
                        </div>
                        <div class="form-floating mb-3">
                            <select class="form-select" id="floatingSelect" aria-label="Floating label select example">
                                <option value="1">Gold</option>
                                <option value="2">Diamond</option>
                                <option value="3">Platinum</option>
                            </select>
                            <label for="floatingSelect">Scegli la Promozione</label>
                        </div>
                        <input type="hidden" id="promotion" name="promotion_hidden">
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
        authorization: '{{$token}}',
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