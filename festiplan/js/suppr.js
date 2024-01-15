let id_field = document.getElementsByName('festival')[0];
let id = id_field.value;

let form = document.getElementsByTagName('form')[0];
let button = document.getElementById('delete');
button.addEventListener('click', function (ev) {
    if (confirm('Êtes-vous sûr de vouloir supprimer ce festival ?')) {
        window.location.href =
            'index.php?controller=festival&action=delete&festival=' + id;
    }
});
