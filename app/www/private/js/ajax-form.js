const current = document.querySelector('#currentEmail');
const response = document.querySelector('#ajaxResponse');


document.forms.editEmailForm.onsubmit = function(e) {
    e.preventDefault()
    var userInput = document.forms.editEmailForm.editEmailInput.value;
    userInput = encodeURIComponent(userInput);
    var xhr = new XMLHttpRequest();

    xhr.open('POST', 'vendor/ajax-response.php')
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onreadystatechange = function(){
        if(xhr.readyState === 4 && xhr.status === 200) {
            console.log(xhr.responseText);
            response.textContent = xhr.responseText;
        }
    }
    xhr.send('newEmail=' + userInput);
};