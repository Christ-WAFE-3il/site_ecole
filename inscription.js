function gererCheckbox() {
    // Récupérer les éléments HTML
    const checkboxPere = document.querySelector('input[name="pere"]');
    const checkboxMere = document.querySelector('input[name="mere"]');
    const sectionPere = document.getElementById('spere');
    const sectionMere = document.getElementById('smere');
    const formulaire = document.querySelector('form');

    // Ajouter un écouteur d'événement au formulaire
    formulaire.addEventListener('submit', function(event) {
        // Empêcher le comportement par défaut du formulaire
        event.preventDefault();

        // Vérifier si les deux cases sont cochées
        if (checkboxPere.checked && checkboxMere.checked) {
            alert("Il faut obligatoirement les informations d'au moins un parent.");
        } else {
            // Envoyer le formulaire
            formulaire.submit();
        }
    });

    // Ajouter des écouteurs d'événement aux cases à cocher
checkboxPere.addEventListener('change', function() {
    // Vérifier si la case à cocher du père est cochée
    if (this.checked) {
        // Cacher la section du père et afficher un message d'erreur si la case à cocher de la mère est également cochée
        if (checkboxMere.checked) {
            sectionPere.style.display = 'block';
            alert("Il faut obligatoirement les informations d'au moins un parent.");
        } else {
            sectionPere.style.display = 'none';
        }
    } else {
        // Afficher la section du père
        sectionPere.style.display = 'block';
    }
});

checkboxMere.addEventListener ('change', function() {
    // Vérifier si la case à cocher de la mère est cochée
    if (this.checked) {
        // Cacher la section de la mère et afficher un message d'erreur si la case à cocher du père est également cochée
        if (checkboxPere.checked) {
            sectionMere.style.display = 'block';
            alert("Il faut obligatoirement les informations d'au moins un parent.");
        } else {
            sectionMere.style.display = 'none';
        }
    } else {
        // Afficher la section de la mère
        sectionMere.style.display = 'block';
    }
});

}// Appel de la fonction pour l'exécuter
gererCheckbox();
