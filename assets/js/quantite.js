// Boutons - et + de la fiche produit : ils changent le chiffre du champ quantité.
// Sans JavaScript, le visiteur peut toujours taper la quantité dans le champ.
const champ = document.querySelector('.quantite-champ');

document.querySelectorAll('[data-quantite]').forEach(function (bouton) {
    bouton.addEventListener('click', function () {
        const valeur = (parseInt(champ.value, 10) || 1) + Number(bouton.dataset.quantite);
        champ.value = Math.min(Math.max(valeur, Number(champ.min)), Number(champ.max));
    });
});
