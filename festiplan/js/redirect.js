let go_back = document.getElementById('go_back');

if (go_back != null) {
    go_back.addEventListener('click', function () {
        history.go(-1);
    });
}
