
const form = document.getElementById('form');
const firstName = document.getElementById('first_name');
const lastName = document.getElementById('last_name');
const dateOfBirth = document.getElementById('date_of_birth');
const email = document.getElementById('email');
const password = document.getElementById('password');
const passwordConfirm = document.getElementById('password-confirm');
let isValid;


form.addEventListener('submit',function (event){

    isStringEmpty(firstName,'first name');
    capitalizeFirstLetter(firstName);
    console.log('name',isValid);

    isStringEmpty(lastName,'last name');
    capitalizeFirstLetter(lastName);
    console.log('last name',isValid);

    validateDate(dateOfBirth,'date of birth')
    console.log('data',isValid);

    validateEmail(email,'email');
    console.log('email',isValid);

    validatePassword(password,'password');
    console.log('pw',isValid);

    console.log(isValid);
    if (!isValid) {
        console.log(isValid);
        event.preventDefault();
    }
})



const isStringEmpty = (inputElement,fieldName) => {
    if (inputElement.value.trim() === '') {
        isValid = false;
        inputElement.nextElementSibling.innerText = `The ${fieldName} field cannot be empty.`;
        inputElement.nextElementSibling.classList.add('is-invalid');
        inputElement.classList.add('is-invalid');
    } else {
        isValid = true;
        if (inputElement.nextElementSibling.classList.contains('is-invalid')) {
            inputElement.nextElementSibling.innerText = '';
            inputElement.nextElementSibling.classList.remove('is-invalid');
            inputElement.classList.remove('is-invalid');
        }
    }
}

const validatePassword = (inputElement,fieldName) => {
    isStringEmpty(password,'password');
    isStringEmpty(passwordConfirm,'password confirm');
    // Definisci un'espressione regolare per ogni requisito
    const lowercaseRegex = /[a-z]/;
    const uppercaseRegex = /[A-Z]/;
    const numberRegex = /[0-9]/;
    const symbolRegex = /[$&+,:;=?@#|'<>.^*()%!-]/;

    // Verifica se la password soddisfa tutti i requisiti
    const isLowercase = lowercaseRegex.test(inputElement.value);
    const isUppercase = uppercaseRegex.test(inputElement.value);
    const hasNumber = numberRegex.test(inputElement.value);
    const hasSymbol = symbolRegex.test(inputElement.value);

    // Verifica se tutti i requisiti sono soddisfatti
    if (!(isLowercase 
        && isUppercase 
        && hasNumber 
        && hasSymbol)) {
        isValid = false;
        inputElement.nextElementSibling.innerText = `Insert at least one uppercase,lowercase,number,symbol`;
        inputElement.nextElementSibling.classList.add('is-invalid');
        inputElement.classList.add('is-invalid')
    } else if (inputElement.value.length < 8) {
        isValid = false;
        inputElement.nextElementSibling.innerText = `The ${fieldName} must be at least 8 characters long.`;
        inputElement.nextElementSibling.classList.add('is-invalid');
        inputElement.classList.add('is-invalid')
    } else {
        if (passwordConfirm.value !== password.value || passwordConfirm.value.trim() === '') {
            isValid = false;
            passwordConfirm.nextElementSibling.innerText = `The passwords do not match.`;
            passwordConfirm.nextElementSibling.classList.add('is-invalid');
            passwordConfirm.classList.add('is-invalid');
        }
    }
}

function capitalizeFirstLetter(inputElement) {
    inputElement.value = inputElement.value.charAt(0).toUpperCase() + inputElement.value.slice(1);
}


const validateDate = (inputElement,fieldName) => {
    const today = new Date();
    const year = today.getFullYear();
    const month = String(today.getMonth() + 1).padStart(2, '0');
    const day = String(today.getDate()).padStart(2, '0');
    const formattedDateToday = `${year}-${month}-${day}`;
    if (inputElement.value > formattedDateToday || isStringEmpty(dateOfBirth,'date of birth')) {
        isValid = false;
        inputElement.nextElementSibling.innerText = `The ${fieldName} cannot be in the future!`;
        inputElement.classList.add('is-invalid');
    }
}

const validateEmail = (inputElement,fieldName) => {
    isStringEmpty(email,'email');
    // Espressione regolare per la validazione dell'email
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(inputElement.value)) {
        isValid = false;
        inputElement.nextElementSibling.innerText = `Invalid email format`;
        inputElement.nextElementSibling.classList.add('is-invalid');
        inputElement.classList.add('is-invalid');
    }
}
