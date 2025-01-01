<?php
session_start();

$isLoged = isset($_SESSION['nome']) && !empty($_SESSION['nome']);

if (!$isLoged) {
    header('Location: /login.php');
}

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
    <h1>Profile</h1>
</body>

</html>