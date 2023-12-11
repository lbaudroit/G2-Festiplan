<?php
require $_SERVER['DOCUMENT_ROOT'] . PREFIX_TO_RELATIVE_PATH . '/libs/autoload.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Accueil - Festiplan</title>
</head>

<body>
    <h1>Mezabi</h1>

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

    <form>
        <input type="hidden" name="controller" value="">
        <input type="hidden" name="action" value="">
    </form>



</body>

</html>