function showErrorMessage(errors) {
    const errorMessageDiv = document.getElementById('error-message');
    const errorHeading = document.querySelector('.modal3 h2'); 
    errorMessageDiv.innerHTML = "";

    const blurOverlay = document.querySelector('.blur-overlay');
    blurOverlay.addEventListener('click', closeModalError);
    
    if (document.body.classList.contains('open-error')) {
        closeModalError();
    }

    if (Array.isArray(errors)) {
        errors.forEach(error => {
            const errorElement = document.createElement('h4');
            errorElement.textContent = error;
            errorMessageDiv.appendChild(errorElement);
        });
    } else {
        const errorElement = document.createElement('h4');
        errorElement.textContent = errors;
        errorMessageDiv.appendChild(errorElement);
    }

    if (errorHeading) {
        errorHeading.style.display = 'block';
        errorHeading.textContent = "Error";
    }
    document.body.classList.add('open-error');
}

function showSuccessMessage(message) {
    const errorMessageDiv = document.getElementById('error-message');
    const errorHeading = document.querySelector('.modal3 h2');
    errorMessageDiv.innerHTML = ""; 
    
    if (document.body.classList.contains('open-error')) {
        closeModalError();
    }

    const successElement = document.createElement('h4');
    successElement.textContent = message;
    successElement.style.color = "green"; 
    errorMessageDiv.appendChild(successElement);

    if (errorHeading) {
        errorHeading.style.display = 'none';
    }

    document.body.classList.add('open-error');
}

const closeModalError = (event) => {
    if (event) event.stopPropagation();
    document.body.classList.remove('open-error');
};