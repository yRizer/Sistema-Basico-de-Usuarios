<?php

session_start();
echo session_id();
echo '<br>';
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    include '../src/templates/nav/main_nav.php';
    ?>

    <h1>Inicio</h1>

</body>

</html>