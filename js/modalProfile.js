document.addEventListener('DOMContentLoaded', () => {
    const openProfileModalButtons = document.querySelectorAll('.open-profile-modal');
    const profileModalContainer = document.getElementById('profile-modal-container');
    const closeProfileModal = document.getElementById('close-profile-modal');
    const blurOverlay = document.querySelector('.blur-overlay');

    openProfileModalButtons.forEach(button => {
        button.addEventListener('click', toggleModalProfile);
    });

    closeProfileModal.addEventListener('click', closeModalProfile);
    blurOverlay.addEventListener('click', closeModalProfile);

    function toggleModalProfile(event) {
        event.stopPropagation();
        profileModalContainer.style.display = 'block';
        setTimeout(() => {
            document.body.classList.toggle('open-profile-modal');
        }, 100);
    }

    function closeModalProfile(event) {
        event.stopPropagation();
        profileModalContainer.style.display = 'none';
        document.body.classList.remove('open-profile-modal');
    }
});