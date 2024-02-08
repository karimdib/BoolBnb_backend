console.log('validation JS payament');

const cardholderName = document.getElementById('cardholder-name');
const numberCard = document.getElementById('number-card');
const promo = document.getElementById('promo');
const form = document.getElementById('payment-form');

form.addEventListener('submit', function (event) {
    let finishCheckout = true;
    if (cardholderName.value.trim() === '') {
        cardholderName.nextElementSibling.innerText = 'the name field cannot be empty'; 4
        cardholderName.classList.add('border-red')
        finishCheckout = false;
    }

    if (numberCard.value.trim() === '') {
        numberCard.nextElementSibling.innerText = 'the number card field cannot be empty';
        numberCard.classList.add('border-red');
        finishCheckout = false;
    }


    if (!finishCheckout) {
        event.preventDefault();
    }
})