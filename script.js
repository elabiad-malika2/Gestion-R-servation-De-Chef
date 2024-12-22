document.querySelectorAll('.carousel').forEach(carousel => {
    const inner = carousel.querySelector('.carousel-inner');
    const leftBtn = carousel.querySelector('.carousel-btn.left');
    const rightBtn = carousel.querySelector('.carousel-btn.right');
    let index = 0;

    // Fonction pour mettre à jour le défilement
    function updateCarousel() {
        const offset = -index * 100;
        inner.style.transform = `translateX(${offset}%)`;
    }

    // Bouton gauche
    leftBtn.addEventListener('click', () => {
        index = (index > 0) ? index - 1 : inner.children.length - 1;
        updateCarousel();
    });

    // Bouton droit
    rightBtn.addEventListener('click', () => {
        index = (index < inner.children.length - 1) ? index + 1 : 0;
        updateCarousel();
    });
});
    const cards = document.querySelectorAll('.card');

    const observer = new IntersectionObserver(entries => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('show');
            }
        });
    });

    cards.forEach(card => {
        observer.observe(card);
    });




    // Fonction pour ouvrir la modale
function openModal(menuId) {
    // Remplir le champ caché de l'ID du menu
    document.getElementById('menu_id').value = menuId;

    // Afficher la modale
    document.getElementById('reservationModal').classList.remove('hidden');
}

// Fonction pour fermer la modale
function closeModal() {
    document.getElementById('reservationModal').classList.add('hidden');
}

// Fermeture de la modale lorsque l'utilisateur clique en dehors de la fenêtre de la modale
window.onclick = function(event) {
    var modal = document.getElementById('reservationModal');
    if (event.target === modal) {
        closeModal();
    }
}