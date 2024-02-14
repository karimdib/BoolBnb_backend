console.log('validation JS payament');
const cardholderName = document.getElementById('cardholder-name');
const numberCard = document.getElementById('number-card');
const promo = document.getElementById('promo');
const form = document.getElementById('payment-form');
const image = document.getElementById('image-credit');
const errorCard = document.getElementById('error-card');
const defaultImageSrc = image.src;
const data = document.getElementById('data');
const cvv = document.getElementById('cvv');
console.log(cvv);
console.log(data);

console.log(image);

form.addEventListener('submit', function (event) {
    let finishCheckout = true;

    if (cardholderName.value.trim() === '') {
        cardholderName.nextElementSibling.innerText = 'the name field cannot be empty';
        cardholderName.classList.add('red')
        finishCheckout = false;
    }
    if (data.value.trim() === '') {
        data.nextElementSibling.innerText = 'invalid';
        data.classList.add('red')
        finishCheckout = false;
    }
    let month = parseInt(data.value.substring(0, 2));
    let year = parseInt(data.value.substring(3));

    if (month < 1 || month > 12 || year < 24) {
        data.nextElementSibling.innerHTML = 'Invalid date';
        data.classList.add('red');
        finishCheckout = false;
    } else {
        data.nextElementSibling.innerHTML = '';
        data.classList.remove('red');
    }

    if (cvv.value.trim() === '') {
        cvv.nextElementSibling.innerText = 'invalid';
        cvv.classList.add('red')
        finishCheckout = false;
    } else if (!/^\d{3}$/.test(cvv.value)) {
        cvv.nextElementSibling.innerText = 'Only number';
        cvv.classList.add('red');
        finishCheckout = false;
    } else {
        cvv.nextElementSibling.innerText = '';
        cvv.classList.remove('red');
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
        errorCard.innerHTML = 'the number card field cannot be empty';
        numberCard.classList.add('red');
        finishCheckout = false;
    }

    const cardRegex = /^(4\d{15}|5[1-9]\d{14})$/; // Visa or Mastercard
    if (!cardRegex.test(numberCard.value.replace(/\s/g, ''))) {
        errorCard.innerText = 'Invalid Visa or Mastercard number';
        numberCard.classList.add('red');
        finishCheckout = false;
    }

    if (!finishCheckout) {
        event.preventDefault();
    }

    //rimozionx classe is-invalid, scrivendo nell'input
    numberCard.addEventListener('input', function () {
        numberCard.classList.remove('red');
        errorCard.innerText = '';
        console.log('ccc');

    });
    cardholderName.addEventListener('input', function () {
        cardholderName.classList.remove('red');
        cardholderName.nextElementSibling.innerText = '';
    });



    data.addEventListener('input', function () {
        let dataNumber = data.value.replace(/[^\d]/g, '');
        let formattedNumber = '';
        for (let i = 0; i < dataNumber.length; i++) {
            if (i === 2) {
                formattedNumber += '/';
            }
            formattedNumber += dataNumber[i];
        }
        data.value = formattedNumber;


        data.classList.remove('red');
        data.nextElementSibling.innerHTML = '';
    });



    cvv.addEventListener('input', function () {
        cvv.classList.remove('red');
        cvv.nextElementSibling.innerText = '';
    })
})
numberCard.addEventListener('input', function () {
    let cardNumber = numberCard.value.replace(/[^\d]/g, '');
    let formattedNumber = '';

    for (let i = 0; i < cardNumber.length; i++) {
        if (i > 0 && i % 4 === 0) {
            formattedNumber += ' ';
        }
        formattedNumber += cardNumber[i];
    }

    numberCard.value = formattedNumber;
    console.log(numberCard.value.length);
    const firstDigit = numberCard.value.trim().charAt(0);
    // Cambia l'immagine in base al primo carattere del numero della carta
    if (firstDigit === '4') {
        image.src = '/images/visa-logo.png';
    } else if (firstDigit === '5') {
        image.src = '/images/mastercard-logo.png';
    } else {
        image.src = defaultImageSrc;
    }
});

data.addEventListener('input', function () {
    let dataNumber = data.value.replace(/[^\d]/g, '');
    let formattedNumber = '';
    for (let i = 0; i < dataNumber.length; i++) {
        if (i === 2) {
            formattedNumber += '/';
        }
        formattedNumber += dataNumber[i];
    }
    data.value = formattedNumber;


});


