<?php
require __DIR__ . '/../vendor/autoload.php';
session_start();

use App\library\Updates;
use App\Utilities\Modals;

$HTMLModal = '';

if (isset($_GET['cadastro'])) {
    $HTMLModal = Modals::getModal('Usuário cadastrado com sucesso', '', 'success');
};

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $db = new App\db\DataBase();
    $login = $db->Login($_POST['email'], md5($_POST['senha']));
    if ($login) {
        if (count($login) > 0) {
            Updates::updateSession($login);

            header('Location: /?login=true');
            exit;
        }
    } else {
        $HTMLModal = Modals::getModal('Login inválido', 'Email ou senha inválidos', 'error');
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/main_nav.css">
    <link rel="stylesheet" href="/css/index.css">
    <link rel="stylesheet" href="/css/login.css">
    <link rel="stylesheet" href="/css/modals.css">
    <script src="/js/main.js"></script>
    <script src="/js/validations.js"></script>
    <title>Login</title>
</head>

<body>

    <?php
    include '../src/templates/nav/main_nav.php';
    ?>
    <?= $HTMLModal ?? '' ?>
    <div class="light-ball"></div>
    <section class="main-field">
        <div class="container">
            <div class="login-container">
                <h1>Login</h1>
                <form class="login-form" action="login.php" method="post">

                    <div class="input-container">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email">
                    </div>


                    <div class="input-container">
                        <label for="senha">Senha</label>
                        <input type="password" name="senha" id="senha">
                    </div>

                    <button class="btn-submit" type="submit">Login</button>
                </form>
                <span><a href="/cadastro.php">Não possuo cadastro</a></span>
            </div>
        </div>
    </section>
</body>

</html>