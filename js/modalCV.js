document.addEventListener('DOMContentLoaded', () => {
    const createCvButton = document.querySelector('.create-cv');
    const cvModalContainer = document.getElementById('cv-modal-container');
    const closeCvModal = document.getElementById('close-cv-modal');
    const blurOverlay = document.querySelector('.blur-overlay');

    createCvButton.addEventListener('click', toggleModalCV);
    closeCvModal.addEventListener('click', closeModalCV);
    blurOverlay.addEventListener('click', closeModalCV);
    
    blurOverlay.style.pointerEvents = 'auto';
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

    const editCvButtons = document.querySelectorAll('.edit-cv-btn');
    editCvButtons.forEach(button => {
        button.addEventListener('click', function() {
            const cvCard = this.closest('.cv-card');
            const cvFields = cvCard.querySelector('.cv-fields');
            cvFields.style.display = cvFields.style.display === 'none' ? 'block' : 'none';
            this.textContent = cvFields.style.display === 'block' ? 'Cancel Edit' : 'Edit CV';
            document.querySelectorAll('.cv-card').forEach(cvCard => {
                const cvFields = cvCard.querySelector('.cv-fields');
                if (cvFields.style.display === 'none') {
                    cvCard.style.height = '180px';
                }
                else if (cvFields.style.display === 'block') {
                    cvCard.style.height = 'auto';
                }
            });
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
