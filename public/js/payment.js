console.log('validation JS payament');
const cardholderNameFather = document.getElementById('card-name-father');
const numberCardFather = document.getElementById('card-number-father');
const cardholderName = document.getElementById('cardholder-name');
const numberCard = document.getElementById('number-card');
const promo = document.getElementById('promo');
const form = document.getElementById('payment-form');

form.addEventListener('submit', function (event) {
    let finishCheckout = true;
    if (cardholderName.value.trim() === '') {
        cardholderName.nextElementSibling.innerText = 'the name field cannot be empty';
        cardholderNameFather.classList.add('red');
        cardholderName.classList.add('red')
        finishCheckout = false;
    }

    if (numberCard.value.trim() === '') {
        numberCard.nextElementSibling.innerText = 'the number card field cannot be empty';
        numberCardFather.classList.add('red');
        numberCard.classList.add('red');
        finishCheckout = false;
    }


    if (!finishCheckout) {
        event.preventDefault();
    }
})