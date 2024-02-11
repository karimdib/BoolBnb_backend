@extends('layouts.app')

@section('content')

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="title">Processo pagamento</h5>
                </div>
                <div class="card-body" id="card-body">
                    <div id="success-payment" style="display: none">
                        <h3 class="payment-title">Il pagamento è avvenuto con successo <span>&check;</span></h3>
                    </div>
                    <div id="loader-overlay" class="loader-overlay">
                        <div class="loader"></div>
                        <div class="loading-text">Ci stiamo collegando con la tua banca</div>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <div class="d-flex gap-2  mt-3">
                                <div class="name-number-para">Nome Titolare:</div>
                                <div>{{$result->transaction->customer['firstName']}}</div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="d-flex gap-2 mt-3">
                                <div class="name-number-para">Numero della carta:</div>
                                <div>{{$cc_card}}</div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="d-flex gap-2 mt-3">
                                <div class="name-number-para">N°ordine</div>
                                <div>{{$result->transaction->id}}</div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <a href="{{route('admin.dashboard')}}">
                                <button type="button" class="btn btn-primary mt-3">Vedi il tuo ordine</button>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const cardBody = document.getElementById('card-body');
        const loaderOverlay = document.getElementById('loader-overlay');
        const loadingText = document.querySelector('.loading-text');
        const successPayment = document.getElementById('success-payment')

        if (cardBody && loaderOverlay && loadingText) {

            loaderOverlay.style.display = 'none';


            const loadingMessages = ["Ci stiamo collegando con la tua banca", "Stiamo processando il tuo pagamento"];


            function showLoadingMessages() {
                loadingMessages.forEach(function(message, index) {
                    setTimeout(function() {
                        loadingText.textContent = message;
                    }, index * 1000); 
                });
            }

            loaderOverlay.style.display = 'block';


            showLoadingMessages();
            

            setTimeout(function() {
                loaderOverlay.style.display = 'none';
                successPayment.style.display = 'block';

            }, 3000);
        } else {
            console.error("Elementi non trovati correttamente.");
        }
    });


</script>

@endsection