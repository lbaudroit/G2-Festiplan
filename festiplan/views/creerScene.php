<!DOCTYPE HTML>
<html lang="fr">
    <head>
        <meta charset="utf-8">
		<title>FESTIPLAN - Création de Scène</title>
		
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" rel="stylesheet" />
    
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"
        rel="stylesheet">
    
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
        <link rel="icon" href="favicon.ico" />
        <link rel="stylesheet" href="css\style.css">
    </head>
    <body>
    <div class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <u><h2 class="modal-title">
                        Ajout d'une scène :    
                    </h2></u>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class = "container text-center">
                        <div class = "row grandEspacementHauteur">
                            <div class ="col-6">
                                Nom de la scène :
                            </div>
                            <div class = "col-6">
                                <input type="text" id="nomScene" name="nomScene" placeholder="Entrer le nom de la scène (35 caractères max.)">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-rouge">Annuler</button>
                    <button type="button" class="btn btn-bleu" data-dismiss="modal">Ajouter la scène</button>
                </div>
            </div>
        </div>
    </div>
    </body>
</html>