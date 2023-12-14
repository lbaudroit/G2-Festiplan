<!DOCTYPE html>
<html lang=fr">

<head>
    <title>Dashboard - Festiplan</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./css/common/css">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"
        rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</head>



<body>
    <div class="container">
        <div class="row">
            <div class="col-12 text-center bg-primary-subtle">
                <?php
                foreach ($listeFestivals as $fest) {
                    foreach ($fest as $info) {
                        echo $info;
                    }
                }
                echo "<hr>";
                foreach ($listeSpectacles as $fest) {
                    foreach ($fest as $info) {
                        echo $info;
                    }
                }
                ?>
            </div>
        </div>
    </div>
</body>

</html>