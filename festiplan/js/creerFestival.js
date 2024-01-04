function alertWaitTillChange() {
    alert('Créez le festival pour accéder à cette fonction.');
}

let mode = document.getElementsByName('mode')[0];

if (mode.value == 'ajout') {
    for (let sc of document.getElementsByClassName('not_now')) {
        sc.addEventListener('click', alertWaitTillChange);
    }
}

let champs_titre = document.getElementsByName('titre');
let champs_desc = document.getElementsByName('desc');

for (let champ of champs_titre) {
    champ.addEventListener('change', function () {
        for (let champ2 of champs_titre) {
            champ2.value = champ.value;
        }
    });
}

for (let champ of champs_desc) {
    champ.addEventListener('change', function () {
        for (let champ2 of champs_desc) {
            champ2.value = champ.value;
        }
    });
}
