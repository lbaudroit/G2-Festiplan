<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Accueil - Festiplan</title>
    <link rel="stylesheet" href="/mezabi/static/css/mezabi.css">
</head>

<body>


    <h1>Mezabi</h1>

    <a href="/mezabi">Catégories</a> > Articles

    <h2>Articles de la catégorie
        <?php echo $categorie ?>
    </h2>

    <table>
        <?php while ($row = $searchStmt->fetch()) {
            echo "<tr>";
            foreach ($row as $val) {
                echo "<td>$val</td>";
            }
            echo "</tr>";
        }
        ?>
    </table>



</body>

</html>