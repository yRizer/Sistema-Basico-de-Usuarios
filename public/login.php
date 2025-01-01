<?php
require __DIR__ . '/../vendor/autoload.php';
session_start();
echo '<br>SESSION ID: ' . session_id();
echo '<br>';

if (isset($_GET['cadastro'])) {
    echo 'Cadastro realizado com sucesso';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $db = new App\db\DataBase();
    $login = $db->Login($_POST['email'], $_POST['password']);
    echo '<br>Login: ' . $login;
    if ($login) {
        if (count($login) > 0) {
            foreach ($login as $key => $value) {
                echo '' . $key . '' . $value . '<br>';
                $_SESSION[$key] = $value;
            }

            header('Location: /');
            exit;
        }
    } else {
        echo 'Login inválido';
    }
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
    <h1>Login</h1>
    <form action="login.php" method="post">
        <label for="name">Nome</label>
        <input type="text" name="name" id="name">

        <label for="email">Email</label>
        <input type="email" name="email" id="email">

        <label for="password">Senha</label>
        <input type="password" name="password" id="password">

        <button type="submit">Login</button>
    </form>
    <span><a href="/cadastro.php">Cadastrar</a></span>
</body>

</html>