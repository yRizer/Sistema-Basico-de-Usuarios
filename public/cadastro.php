<?php
echo session_id();

require __DIR__ . '/../vendor/autoload.php';

use App\library\Security;
use App\db\DataBase;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    print_r($_POST);

    $isNameValid = Security::checkUsername($_POST['name']);
    $isEmailValid = Security::checkEmail($_POST['email']);
    $isPasswordValid = Security::checkPassword($_POST['password']);

    echo '<br>Nome válido: ';
    echo $isNameValid ? '<strong>true</strong>' : '<strong>false</strong>';
    echo '<br>Email válido: ';
    echo $isEmailValid ? '<strong>true</strong>' : '<strong>false</strong>';
    echo '<br>Senha válida: ';
    echo $isPasswordValid ? '<strong>true</strong>' : '<strong>false</strong>';

    if($isNameValid && $isEmailValid && $isPasswordValid) {
        $db = new DataBase();
        if ($db->cadastrar($_POST['name'], $_POST['email'], $_POST['password'])){
            header('Location: login.php?cadastro=true');
        };
    } else {
        echo 'Cadastro inválido';
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
    <h1>Cadastro</h1>
    <form action="cadastro.php" method="post">
        <label for="name">Nome</label>
        <input type="text" name="name" id="name">

        <label for="email">Email</label>
        <input type="email" name="email" id="email">

        <label for="password">Senha</label>
        <input type="password" name="password" id="password">

        <button type="submit">Cadastrar</button>
    </form>
</body>

</html>