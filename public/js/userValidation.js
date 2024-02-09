
const form = document.getElementById('form');
const firstName = document.getElementById('first_name');
const lastName = document.getElementById('last_name');
const dateOfBirth = document.getElementById('date_of_birth');
const email = document.getElementById('email');
const password = document.getElementById('password');
const passwordConfirm = document.getElementById('password-confirm');
let isFirstNameValid;
let isLastNameValid;
let isDateOfBirthValid;
let isEmailValid;
let isPasswordValid;


form.addEventListener('submit', function (event) {

    validateName(firstName);
    capitalizeFirstLetter(firstName);
    console.log('first name', isFirstNameValid);

    validateLastName(lastName);
    capitalizeFirstLetter(lastName);
    console.log('last name', isLastNameValid);

    validateDate(dateOfBirth, 'date of birth')
    console.log('date of birth', isDateOfBirthValid);

    validateEmail(email, 'email');
    console.log('email', isEmailValid);

    validatePassword(password, 'password');
    console.log('password', isPasswordValid);

    if (isFirstNameValid
        && isLastNameValid
        && isDateOfBirthValid
        && isEmailValid
        && isPasswordValid) {
        console.log('passed');
    } else {
        console.log('not passed');
        event.preventDefault();
    }
})

const isStringEmpty = (inputElement, fieldName) => {
    if (inputElement.value.trim() === '') {
        isValid = false;

        inputElement.nextElementSibling.innerText = `The ${fieldName} field cannot be empty.`;
        inputElement.nextElementSibling.classList.add('is-invalid');
        inputElement.classList.add('is-invalid');
    } else {
        isValid = true;
        
        if(inputElement == firstName) {
            isFirstNameValid = true;
        } else if (inputElement == lastName)
            isLastNameValid = true;

        if (inputElement.nextElementSibling.classList.contains('is-invalid')) {
            inputElement.nextElementSibling.innerText = '';
            inputElement.nextElementSibling.classList.remove('is-invalid');
            inputElement.classList.remove('is-invalid');
        }
    }
}

const validateName = (inputElement) => {
    if (inputElement.value.trim() === '') {
        isFirstNameValid = false;

        inputElement.nextElementSibling.innerText = `The first name field cannot be empty.`;
        inputElement.nextElementSibling.classList.add('is-invalid');
        inputElement.classList.add('is-invalid');

    } else if (inputElement.value.length > 20) {
        isFirstNameValid = false;
        inputElement.nextElementSibling.innerText = 'Name too long!';
        inputElement.nextElementSibling.classList.add('is-invalid');
        inputElement.classList.add('is-invalid');

    } else if (!(/^[a-zA-Z]+$/.test(inputElement.value))) {
        isFirstNameValid = false;
        inputElement.nextElementSibling.innerText = 'Invalid characters! Only letters allowed';
        inputElement.nextElementSibling.classList.add('is-invalid');
        inputElement.classList.add('is-invalid');

    } else {
        isFirstNameValid = true;
        if (inputElement.nextElementSibling.classList.contains('is-invalid')) {
            inputElement.nextElementSibling.innerText = '';
            inputElement.nextElementSibling.classList.remove('is-invalid');
            inputElement.classList.remove('is-invalid');
        }
    }
}

const validateLastName = (inputElement) => {
    if (inputElement.value.trim() === '') {
        isLastNameValid = false;

        inputElement.nextElementSibling.innerText = `The last name field cannot be empty.`;
        inputElement.nextElementSibling.classList.add('is-invalid');
        inputElement.classList.add('is-invalid');

    } else if (inputElement.value.length > 20) {
        isLastNameValid = false;
        inputElement.nextElementSibling.innerText = 'Name too long!';
        inputElement.nextElementSibling.classList.add('is-invalid');
        inputElement.classList.add('is-invalid');
    } else if (!(/^[a-zA-Z]+$/.test(inputElement.value))) {
        isLastNameValid = false;
        inputElement.nextElementSibling.innerText = 'Invalid characters! Only letters allowed';
        inputElement.nextElementSibling.classList.add('is-invalid');
        inputElement.classList.add('is-invalid');
    } else {
        isLastNameValid = true;
        if (inputElement.nextElementSibling.classList.contains('is-invalid')) {
            inputElement.nextElementSibling.innerText = '';
            inputElement.nextElementSibling.classList.remove('is-invalid');
            inputElement.classList.remove('is-invalid');
        }
    }
}

const validatePassword = (inputElement, fieldName) => {
    isStringEmpty(password, 'password');
    // isStringEmpty(passwordConfirm,'password confirm');
    if (isValid) {
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
            isPasswordValid = false;
            inputElement.nextElementSibling.innerText = `Insert at least one uppercase,lowercase,number,symbol`;
            inputElement.nextElementSibling.classList.add('is-invalid');
            inputElement.classList.add('is-invalid')
        } else if (inputElement.value.length < 8) {
            isPasswordValid = false;
            inputElement.nextElementSibling.innerText = `The ${fieldName} must be at least 8 characters long.`;
            inputElement.nextElementSibling.classList.add('is-invalid');
            inputElement.classList.add('is-invalid')
        } else {
            if (passwordConfirm.value !== password.value || passwordConfirm.value.trim() === '') {
                isPasswordValid = false;
                passwordConfirm.nextElementSibling.innerText = `The passwords do not match.`;
                passwordConfirm.nextElementSibling.classList.add('is-invalid');
                passwordConfirm.classList.add('is-invalid');
            } else {
                isPasswordValid = true;
            }
        }
    }
}

function capitalizeFirstLetter(inputElement) {
    inputElement.value = inputElement.value.charAt(0).toUpperCase() + inputElement.value.slice(1);
}


const validateDate = (inputElement, fieldName) => {

    const dateFormatRegex = /^\d{4}-\d{2}-\d{2}$/;
    const today = new Date();
    const year = today.getFullYear();
    const month = String(today.getMonth() + 1).padStart(2, '0');
    const day = String(today.getDate()).padStart(2, '0');
    const formattedDateToday = `${year}-${month}-${day}`;

    isStringEmpty(dateOfBirth, 'date of birth')
    if (isValid) {
        isDateOfBirthValid = true;

        if (inputElement.value > formattedDateToday) {
            isDateOfBirthValid = false;
            inputElement.nextElementSibling.innerText = `The ${fieldName} cannot be in the future!`;
            inputElement.nextElementSibling.classList.add('is-invalid');
            inputElement.classList.add('is-invalid');
        }

        if (!dateFormatRegex.test(dateOfBirth.value)) {
            isDateOfBirthValid = false;
            inputElement.nextElementSibling.innerText = `Invalid date format`;
            inputElement.nextElementSibling.classList.add('is-invalid');
            inputElement.classList.add('is-invalid');
        }

    } else {
        isEmailValid = false;
    }
}


const validateEmail = (inputElement, fieldName) => {
    isStringEmpty(email, 'email');
    if (isValid) {
        // Espressione regolare per la validazione dell'email
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(inputElement.value)) {
            isEmailValid = false;
            inputElement.nextElementSibling.innerText = `Invalid email format`;
            inputElement.nextElementSibling.classList.add('is-invalid');
            inputElement.classList.add('is-invalid');
        } else {
            isEmailValid = true;
        }
    } else {
        isEmailValid = false;
    }
}
