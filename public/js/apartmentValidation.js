console.log('Prova validazione modulo appartamento JS');

const nameTitle = document.getElementById('name');
const description = document.getElementById('description');
const rooms = document.getElementById('rooms');
const beds = document.getElementById('beds');
const bathrooms = document.getElementById('bathrooms');
const squareMeters = document.getElementById('square_meters');
const form = document.querySelector('.apartment-form');
const service = document.querySelectorAll('.service');
const visible = document.getElementById('visible');
const invisible = document.getElementById('invisible');
const radioButtons = document.getElementById('radio-buttons');
const isInvalid = document.getElementById('service-error');
console.log(isInvalid);
console.log(service);

form.addEventListener('submit', function (event) {
    let isValid = true;
    let serviceChecked = false;
    let visibilityChecked = false;

    service.forEach((input) => {
        if (input.checked) {
            serviceChecked = true;
        }
    })
    if (!serviceChecked) {
        isInvalid.innerText = 'Choose at least one service';
        console.log('nessun sevizio selezionato');
        service.forEach((input) => {
            input.classList.add('is-invalid');
        })
        isValid = false;
    } else {
        isInvalid.innerText = '';
    }

    if (visible.checked) {
        visibilityChecked = true;
    } else if (invisible.checked) {
        visibilityChecked = true;
    } else {
        isValid = false;
        visibilityChecked = false;
        visible.classList.add('is-invalid');
        invisible.classList.add('is-invalid');
        radioButtons.classList.add('is-invalid');
        radioButtons.nextElementSibling.innerText = 'Select at least one option';
    }

    const validateNumber = (inputElement, fieldName) => {
        const value = parseFloat(inputElement.value);
        if (isNaN(value) || value <= 0 || inputElement.value.includes(',')) {
            inputElement.nextElementSibling.innerText = `"The ${fieldName} field must be an integer greater than 0 and without comma."`;
            isValid = false;
        } else {
            inputElement.nextElementSibling.innerText = '';
        }
    };

    validateNumber(rooms, 'rooms');
    validateNumber(beds, 'beds');
    validateNumber(bathrooms, 'bathrooms');
    validateNumber(squareMeters, 'square metres');

    if (rooms.value > 30) {
        rooms.nextElementSibling.innerText = 'the maximum number of rooms is 30.';
        isValid = false;
    }
    if (bathrooms.value > 7) {
        bathrooms.nextElementSibling.innerText = 'the maximum number of bathrooms is 7.';
        isValid = false;
    }
    if (beds.value > 15) {
        beds.nextElementSibling.innerText = 'the maximum number of beds is 15.';
        isValid = false;
    }
    if (squareMeters.value > 700) {
        squareMeters.nextElementSibling.innerText = 'the maximum number of square meters is 700.';
        isValid = false;
    }

    if (rooms.value < beds.value) {
        beds.nextElementSibling.innerText = 'the number of beds must be less than the number of rooms'
    }
    if (rooms.value < bathrooms.value) {
        bathrooms.nextElementSibling.innerText = 'the number of bathrooms must be less than the number of rooms'
    }

    if (nameTitle.value.trim() === '') {
        nameTitle.nextElementSibling.innerText = 'The name field cannot be empty.';
        isValid = false;
    } else if (nameTitle.value.trim().length > 70) {
        nameTitle.nextElementSibling.innerText = 'The number of characters must be less than 70.';
        isValid = false;
    }
    else {
        nameTitle.nextElementSibling.innerText = '';
    }

    if (description.value.trim() === '') {
        description.nextElementSibling.innerText = 'The description field cannot be empty.';
        isValid = false;
    } else if (description.value.trim().length > 150) {
        description.nextElementSibling.innerText = 'The number of characters must be less than 150.';
        isValid = false;
    }
    else {
        description.nextElementSibling.innerText = '';
    }

    if (!isValid) {
        event.preventDefault();
    }
});
