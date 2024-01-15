let ensemble = document.getElementsByClassName('spectacle');
//let liste_selected = new Array();
//let liste_dispo = new Array();
let parent_selected = document.getElementById('parent-selected');
let parent_dispo = document.getElementById('parent-dispo');

let envoyer = document.getElementById('send');
let form = document.getElementsByTagName('form')[0];
let input_liste = document.getElementById('liste_a_envoyer');

for (let spectacle of ensemble) {
    spectacle.addEventListener('click', function () {
        if (spectacle.classList.contains('selected')) {
            spectacle.classList.remove('selected');
            parent_dispo.appendChild(spectacle);
        } else {
            spectacle.classList.add('selected');
            parent_selected.appendChild(spectacle);
        }
    });
}

envoyer.addEventListener('click', function () {
    let aEnvoyer = '';
    let liste_cards_selectionnees = document.getElementsByClassName('selected');

    if (liste_cards_selectionnees.length === 0) {
        aEnvoyer = 'none';
    } else {
        for (let selected of liste_cards_selectionnees) {
            aEnvoyer += selected.id + ',';
        }
    }
    input_liste.value = aEnvoyer;
    form.submit();
});
