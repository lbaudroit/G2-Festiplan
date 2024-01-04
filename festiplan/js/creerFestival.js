function alertWaitTillChange() {
    alert('Créez le festival pour accéder à cette fonction.');
}

let mode = document.getElementsByName('mode')[0];

if (mode.value == 'ajout') {
    for (let sc of document.getElementsByClassName('wait_till_change')) {
        sc.addEventListener('click', alertWaitTillChange);
    }
}
