// POUR CREER UN BOUTON RETOUR, juste utiliser l'attribut name ci-dessous
let page_precedente = document.getElementsByName('page_precedente');
for (let lien of page_precedente) {
    lien.addEventListener('click', function () {
        history.go(-1);
    });
}
