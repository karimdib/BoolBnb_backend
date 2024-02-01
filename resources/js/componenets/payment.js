// var button = document.querySelector('#submit-button');

    
//     braintree.dropin.create({
//         authorization: '{{$token}}',
//         container: '#dropin-container'
//     }, 
//     function (createErr, instance) {
//         button.addEventListener('click', function () {
//             instance.requestPaymentMethod(function (err,payload{
//                 // Submit payload.nonce to your server
//             }));
//         });
//     });