<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Festiplan</title>
    <link rel="stylesheet" href="/mezabi/static/css/mezabi.css">
</head>

<body>


    <h1>Festiplan</h1>

    <table>
        <?php while ($row = $searchStmt->fetch()) {
            echo "<tr>";
            foreach ($row as $info) {
                echo "<td>$info</td>";
            }
            echo "</tr>";
        }
        ?>
    </table>



</body>

</html>