document.addEventListener('DOMContentLoaded', () => {
    const createCvButton = document.querySelector('.create-cv');
    const cvModalContainer = document.getElementById('cv-modal-container');
    const closeCvModal = document.getElementById('close-cv-modal');
    const blurOverlay = document.querySelector('.blur-overlay');

    createCvButton.addEventListener('click', toggleModalCV);
    closeCvModal.addEventListener('click', closeModalCV);
    blurOverlay.addEventListener('click', closeModalCV);

    function toggleModalCV(event) {
        event.stopPropagation();
        cvModalContainer.style.display = 'block';
        setTimeout(() => {
            document.body.classList.toggle('open-cv-modal');
        }, 100);
    }

    function closeModalCV(event) {
    event.stopPropagation();
    cvModalContainer.style.display = 'none';
    document.body.classList.remove('open-cv-modal');
    }
    const cvCards = document.querySelectorAll('.cv-card');
    cvCards.forEach(card => {
        const deleteButton = card.querySelector('.delete-cv-btn');
        deleteButton.addEventListener('click', () => {
            const cvId = card.dataset.cvId; 
            if (confirm("Are you sure you want to delete this CV?")) {
                fetch('includesCV/cv_delete.inc.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: 'cvId=' + cvId,
                })
                .then(response => {
                    if (response.ok) {
                        location.reload();
                    } else {
                        console.error("Error deleting CV.");
                    }
                });
            }
        });
    });

    cvCards.forEach(card => {
        const editButton = card.querySelector('.edit-cv-btn');
        const cvFields = card.querySelector('.cv-fields');

        editButton.addEventListener('click', () => {
            cvFields.style.display = cvFields.style.display === 'none' ? 'block' : 'none';
            if (cvFields.style.display === 'block') {
                editButton.textContent = 'Cancel Edit';
            } else {
                editButton.textContent = 'Edit CV';
            }
            cvFields.classList.toggle('active');
        });
    });
});

function populateCVForm(cvData) {
    const cvForm = document.getElementById("cv-form");
    if (cvForm) {
        for (const [key, value] of Object.entries(cvData)) {
            const inputElement = cvForm.querySelector(`[name="${key}"]`);
            if (inputElement) {
                inputElement.value = value;
            }
        }
    }
}

function openEditModal(modalId, cvData) {
    populateCVForm(cvData); 
    const modal = document.getElementById(modalId);
    const form = modal.querySelector('form');
    const inputs = form.querySelectorAll('input, select, textarea');

    //Enable inputs and show the form
    inputs.forEach(input => {
        input.disabled = false;
    });
    form.style.display = 'block';

    toggleModalCV(event); 
}
