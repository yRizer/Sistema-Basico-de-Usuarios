<?php
echo session_id();

require __DIR__ . '/../vendor/autoload.php';

use App\library\Security;
use App\db\DataBase;
use App\Utilities\Modals;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $isNameValid = Security::checkUsername($_POST['name']);
    $isEmailValid = Security::checkEmail($_POST['email']);
    $isPasswordValid = Security::checkPassword($_POST['password']);

    // echo '<br>Nome válido: ';
    // echo $isNameValid ? '<strong>true</strong>' : '<strong>false</strong>';
    // echo '<br>Email válido: ';
    // echo $isEmailValid ? '<strong>true</strong>' : '<strong>false</strong>';
    // echo '<br>Senha válida: ';
    // echo $isPasswordValid ? '<strong>true</strong>' : '<strong>false</strong>';

    if ($isNameValid && $isEmailValid && $isPasswordValid) {
        $db = new DataBase();
        if ($db->cadastrar($_POST['name'], $_POST['email'], $_POST['password'])) {
            header('Location: login.php?cadastro=true');
        } else {
            $HTMLModal = Modals::getModal('Email Existente','Email já cadastrado, tente eoutro.', 'alert');
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
    <link rel="stylesheet" href="/css/main_nav.css">
    <link rel="stylesheet" href="/css/cadastro.css">
    <link rel="stylesheet" href="/css/modals.css">
    <link rel="stylesheet" href="/css/index.css">
    <script src="/js/validations.js"></script>
    <script src="/js/main.js"></script>
    <title>Document</title>
</head>

<body>
    
    <?php
    include '../src/templates/nav/main_nav.php';
    ?>

    <?=$HTMLModal?>

    <div class="light-ball"></div>
    <section class="main-field">
        <div class="container">
            <div class="cadastro-container">
                <h1>Cadastro</h1>
                <form action="cadastro.php" method="post">
                    <div class="input-container">
                        <label for="name">Nome</label>
                        <input type="text" name="name" id="name">
                    </div>

                    <div class="input-container">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email">
                    </div>

                    <div class="input-container">
                        <label for="password">Senha</label>
                        <input type="password" name="password" id="password">
                    </div>

                    <button class="btn-submit" type="submit">Cadastrar</button>
                </form>
            </div>
        </div>
    </section>

</body>

</html>