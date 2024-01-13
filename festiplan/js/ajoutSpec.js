let ensemble = document.getElementsByClassName('spectacle');
let liste_selected = new Array();
let liste_dispo = new Array();
let parent_selected = document.getElementById('parent-selected');
let parent_dispo = document.getElementById('parent-dispo');

let envoyer = document.getElementById('send');
let form = document.getElementsByTagName('form')[0];

for (let spectacle of ensemble) {
    if (spectacle.classList.contains('selected')) {
        liste_selected.push(spectacle);
    } else {
        liste_dispo.push(spectacle);
    }
}

for (let spectacle of ensemble) {
    spectacle.addEventListener('click', function () {
        if (spectacle.classList.contains('selected')) {
            spectacle.classList.remove('selected');
            liste_selected.pop(spectacle);
            liste_dispo.push(spectacle);
            parent_dispo.appendChild(spectacle);
        } else {
            spectacle.classList.add('selected');
            liste_dispo.pop(spectacle);
            liste_selected.push(spectacle);
            parent_selected.appendChild(spectacle);
        }
    });
}

envoyer.addEventListener('click', function () {
    let liste = document.createElement('input');
    liste.name = 'selection_fin';
    liste.type = 'hidden';
    let chiffres = '';
    if (liste_selected.length === 0) {
        chiffres = 'none';
    } else {
        for (let selected of liste_selected) {
            chiffres += selected.id + ',';
        }
    }
    liste.value = chiffres;
    parent_selected.appendChild(liste);
    form.submit();
});
