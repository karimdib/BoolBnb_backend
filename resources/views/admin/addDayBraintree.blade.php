@extends('layouts.app')

@section('content')

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="title">Payment Process</h5>
                </div>
                <div class="card-body" id="card-body">
                    <div id="success-payment" style="display: none">
                        <h3 class="payment-title">The payment was successful <span>&check;</span></h3>
                    </div>
                    <div id="loader-overlay" class="loader-overlay">
                        <div class="loader"></div>
                        <div class="loading-text">We are connecting with your bank</div>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <div class="d-flex gap-2  mt-3">
                                <div class="name-number-para">Owner Name:</div>
                                <div>{{$result->transaction->customer['firstName']}}</div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="d-flex gap-2 mt-3">
                                <div class="name-number-para">Card Number:</div>
                                <div>{{$cc_card}}</div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="d-flex gap-2 mt-3">
                                <div class="name-number-para">N°order</div>
                                <div>{{$result->transaction->id}}</div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <a href="{{route('admin.dashboard')}}">
                                <button type="button" class="btn btn-primary mt-3">See your order</button>
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


            const loadingMessages = ["We are connecting with your bank", "We are processing your payment"];


            function showLoadingMessages() {
                loadingMessages.forEach(function(message) {
                    setTimeout(function() {
                        loadingText.innerText = message;
                    }, 1000); 
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