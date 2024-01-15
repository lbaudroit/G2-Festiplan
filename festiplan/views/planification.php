<!DOCTYPE HTML>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <title>FESTIPLAN - Login</title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" rel="stylesheet" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"
        rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar/index.global.min.js'></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialDate: '<?php echo $date["date_deb"] ?>',
                initialView: 'timeGridFest',
                timeZone: 'UTC+1',
                validRange: {
                    start: '<?php echo $date["date_deb"] ?>',
                    end: '<?php echo $date["date_fin"] ?>'
                },
                slotMinTime: '<?php echo $GRIJ["heure_deb"] ?>',
                slotMaxTime: '<?php echo $GRIJ["heure_fin"] ?>',
                expandRows: true,
                views: {
                    timeGridFest: {
                        type: 'timeGrid',
                        duration: { days: <?php if ($duree>3){echo "3";}else{echo $duree;} ?> },
                    }
                }
            });
            <?php 
            foreach($plannification as &$event) {
                $horaire_deb = date('Y-m-d', strtotime($date["date_deb"]. ' + '.($event[2]-1).' day')).'T'.date_format($event[1], 'H:i:s');
                echo 'calendar.addEvent({';
                    echo 'title: "Second Event",';
                    echo 'start: "'.$horaire_deb.'",';
                    echo 'end: "2020-08-08T13:30:00"});';
            }
            ?>
            calendar.render();
        });
    </script>

    <link rel="icon" href="favicon.ico" />
    <link rel="stylesheet" href=".\css\style.css">
</head>

<body>
    <?php include("./views/header.php"); 
    var_dump($plannification["0"]);
    echo '<br/>';
    var_dump($horaire_deb);
    ?>
    <div class="contenue container mb-2">
        <div class="underline titre2 width-to-size">
            Planification de
            <?php echo $nomFestival["titre"] ?>
        </div>


        <div id='calendar'></div>
    </div>
    <?php include("./views/footer.php"); ?>
</body>

</html>