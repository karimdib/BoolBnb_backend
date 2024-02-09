console.log('validation JS payament');
const cardholderName = document.getElementById('cardholder-name');
const numberCard = document.getElementById('number-card');
const promo = document.getElementById('promo');
const form = document.getElementById('payment-form');

form.addEventListener('submit', function (event) {
    let finishCheckout = true;
    if (cardholderName.value.trim() === '') {
        cardholderName.nextElementSibling.innerText = 'the name field cannot be empty';
        cardholderName.classList.add('red')
        finishCheckout = false;
    }

    if (numberCard.value.trim() === '') {
        numberCard.nextElementSibling.innerText = 'the number card field cannot be empty';
        numberCard.classList.add('red');
        finishCheckout = false;
    }


    if (!finishCheckout) {
        event.preventDefault();
    }

    //rimozionx classe is-invalid, scrivendo nell'input
    numberCard.addEventListener('input', function () {
        numberCard.classList.remove('red');
        numberCard.nextElementSibling.innerText = '';
    });
    cardholderName.addEventListener('input', function () {
        cardholderName.classList.remove('red');
        cardholderName.nextElementSibling.innerText = '';
    });
})