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
    const onlyLettersAndSpacesRegex = /^[A-Za-z\s]+$/;

    if (!onlyLettersAndSpacesRegex.test(cardholderName.value.trim())) {
        cardholderName.nextElementSibling.innerText = 'The name field can only contain letters and spaces';
        cardholderName.classList.add('red');
        finishCheckout = false;
    } else {
        cardholderName.nextElementSibling.innerText = '';
        cardholderName.classList.remove('red');
    }

    if (numberCard.value.trim() === '') {
        numberCard.nextElementSibling.innerText = 'the number card field cannot be empty';
        numberCard.classList.add('red');
        finishCheckout = false;
    }

    const cardRegex = /^(4\d{15}|5[1-5]\d{14})$/; // Visa or Mastercard
    if (!cardRegex.test(numberCard.value.replace(/\s/g, ''))) {
        numberCard.nextElementSibling.innerText = 'Invalid Visa or Mastercard number';
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