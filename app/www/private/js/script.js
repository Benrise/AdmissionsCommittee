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
const paragraph = document.getElementById('paragraph');
const input = document.getElementById('editEmailInput');
const editButton = document.getElementById('edit');
const cancelButton = document.getElementById('cancel');
const saveButton = document.getElementById('save');
const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;


function submitForm(){
    emailInput.addEventListener('input', () => {
        const email = emailInput.value.trim();
        if (emailRegex.test(email)) {
            saveButton.addEventListener('click', (e) => {
                // Отображаем параграф и скрываем input
                paragraph.style.visibility = 'visible';
                input.style.visibility = 'hidden';
                // Отображаем кнопку "Изменить" и скрываем кнопки "Отмена" и "Готово"
                editButton.style.display = 'block';
                cancelButton.style.visibility = 'hidden';
                saveButton.style.visibility = 'hidden';
                return false
            });

        } else {
            console.log('Email is invalid');
        }
    });
}

editButton.addEventListener('click', (e) => {

// Скрываем параграф и отображаем input
    paragraph.style.visibility = 'hidden';
    input.style.visibility = 'visible';
// Скрываем кнопку "Изменить" и отображаем кнопки "Отмена" и "Готово"
    editButton.style.display = 'none';
    cancelButton.style.visibility = 'visible';
    saveButton.style.visibility = 'visible';
    return false
});

cancelButton.addEventListener('click', (e) => {
// Отображаем параграф и скрываем input
    paragraph.style.visibility = 'visible';
    input.style.visibility = 'hidden';
// Отображаем кнопку "Изменить" и скрываем кнопки "Отмена" и "Готово"
    editButton.style.display = 'block';
    cancelButton.style.visibility = 'hidden';
    saveButton.style.visibility = 'hidden';
    return false
});

