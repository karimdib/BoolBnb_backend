@extends('layouts.app')

@stack('payment')

@section('content')

<head>
    <script src="https://js.braintreegateway.com/web/dropin/1.24.0/js/dropin.min.js"></script>
</head>
<div class="py-12">
    @csrf
    <div id="dropin-container" style="display: flex;justify-content: center;align-items: center;"></div>
    <div style="display: flex;justify-content: center;align-items: center; color: white">
        <a id="submit-button" class="btn btn-sm btn-success">Submit payment</a>
    </div>
    
</div>
    
@endsection

<script>
    var button = document.querySelector('#submit-button');

    
    braintree.dropin.create({
        authorization: '{{$token}}',
        container: '#dropin-container'
    }, function (createErr, instance) {
        button.addEventListener('click', function () {
            instance.requestPaymentMethod(function (err,payload{
                // Submit payload.nonce to your server
            }));
        });a
    });
</script>