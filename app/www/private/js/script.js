// Example starter JavaScript for disabling form submissions if there are invalid fields
(() => {
    'use strict'

    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    const forms = document.querySelectorAll('.needs-validation')

    // Loop over them and prevent submission
    Array.from(forms).forEach(form => {
        form.addEventListener('submit', event => {
            if (!form.checkValidity()) {
                event.preventDefault()
                event.stopPropagation()
            }

            form.classList.add('was-validated')
        }, false)
    })
})()


const currentEmail = document.getElementById('currentEmail');
const input = document.getElementById('editEmailInput');
const editButton = document.getElementById('edit');
const cancelButton = document.getElementById('cancel');
const saveButton = document.getElementById('save');
const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
const successAlert = document.getElementById('successEditEmail');
const failAlert = document.getElementById('failEditEmail');
const spacing = document.getElementById('current-new-email-spacing');


editButton.addEventListener('click', (e) => {

    currentEmail.style.position = "absolute";
    spacing.style.display = "none"
    response.style.display = "none"
    currentEmail.style.visibility = 'hidden';
    input.style.visibility = 'visible';
    input.style.position = 'relative';
    editButton.style.display = 'none';
    cancelButton.style.visibility = 'visible';
    saveButton.style.visibility = 'visible';
    return false
});

cancelButton.addEventListener('click', (e) => {
    input.style.position = 'absolute';
    currentEmail.style.position = "relative";
    currentEmail.style.visibility = 'visible';
    input.style.visibility = 'hidden';
    editButton.style.display = 'block';
    cancelButton.style.visibility = 'hidden';
    saveButton.style.visibility = 'hidden';
    return false
});

saveButton.addEventListener('click', (e) => {
    input.style.position = 'absolute';
    currentEmail.style.position = "relative";
    let userInput = input.value;
    userInput = encodeURIComponent(userInput);
    if (validateEmail(userInput, emailRegex)) {
        response.style.display = "block"
        currentEmail.style.visibility = 'visible';
        input.style.visibility = 'hidden';
        editButton.style.display = 'block';
        cancelButton.style.visibility = 'hidden';
        saveButton.style.visibility = 'hidden';
        return false;
    }
    else{
        console.log('Email is invalid');
        e.preventDefault()
    }

});

function validateEmail(inputString, regexPattern) {
// Создаем объект RegExp с заданным шаблоном regexPattern
    const regex = new RegExp(regexPattern);
    inputString = decodeEmail(inputString);
// Проверяем, соответствует ли inputString заданному шаблону
    if (regex.test(inputString)) {
        console.log("Строка соответствует заданному шаблону");
        failAlert.style.display = "none";
        spacing.style.display = "block"
        return true;
    } else {
        console.log(regex)
        console.log(inputString)
        console.log("Строка не соответствует заданному шаблону");
        failAlert.style.display = "block";
        spacing.style.display = "block"
        return false;
    }
}

function decodeEmail(email){
    return email.replace(/%40/g, '@');
}