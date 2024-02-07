console.log('Prova validazione modulo appartamento JS');

const nameTitle = document.getElementById('name');
const description = document.getElementById('description');
const rooms = document.getElementById('rooms');
const beds = document.getElementById('beds');
const bathrooms = document.getElementById('bathrooms');
const squareMeters = document.getElementById('square_meters');
const form = document.querySelector('.apartment-form');
const service = document.querySelectorAll('.service');
const isInvalid = document.getElementById('service-error');
console.log(isInvalid);
console.log(service);

form.addEventListener('submit', function (event) {
    let isValid = true;
    let serviceChecked = false;

    service.forEach((input) => {
        if (input.checked) {
            serviceChecked = true;
        }
    })
    if (!serviceChecked) {
        isInvalid.innerText = 'Scegli almeno un servizio';
        console.log('nessun sevizio selezionato');
        service.forEach((input) => {
            input.classList.add('is-invalid');
        })
        isValid = false;
    } else {
        isInvalid.innerText = '';
    }

    const validateNumber = (inputElement, fieldName) => {
        const value = parseFloat(inputElement.value);
        if (isNaN(value) || value <= 0) {
            inputElement.nextElementSibling.innerText = `Il campo ${fieldName} deve essere un numero maggiore di 0.`;
            isValid = false;
        } else {
            inputElement.nextElementSibling.innerText = '';
        }
    };

    validateNumber(rooms, 'rooms', beds, 'beds', bathrooms, 'bathrooms', squareMeters, 'square_metres');

    if (nameTitle.value.trim() === '') {
        nameTitle.nextElementSibling.innerText = 'Il campo name non può essere vuoto.';
        isValid = false;
    } else {
        nameTitle.nextElementSibling.innerText = '';
    }

    if (description.value.trim() === '') {
        description.nextElementSibling.innerText = 'Il campo description non può essere vuoto.';
        isValid = false;
    } else {
        description.nextElementSibling.innerText = '';
    }

    if (!isValid) {
        event.preventDefault();
    }
});
