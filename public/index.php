<?php

require __DIR__ . '/../vendor/autoload.php';

use App\Utilities\Modals;

session_start();

if (isset($_GET['login']) && $_GET['login'] == 'true') {
    $HTMLModal = Modals::getModal('Login bem sucedido', 'Login efetuado com sucesso', 'success');
}

if (isset($_GET['logout']) && $_GET['logout'] == 'true') {
    $HTMLModal = Modals::getModal('Logout', 'Logout realizado com sucesso','info');
}
?>


<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/main_nav.css">
    <link rel="stylesheet" href="/css/modals.css">
    <link rel="stylesheet" href="/css/index.css">
    <script src="/js/main.js"></script>
    <title>Inicio</title>
</head>

<body>
    <?php
    include '../src/templates/nav/main_nav.php';
    ?>

    <?= $HTMLModal ?? '' ?>

    <section class="main-field">
        <div class="light-ball"></div>
        <div class="container">
            <div class="index-container">
                <h1>Seja bem vindo ao nosso site</h1>

                <p>Este é um site teste para um Teste de vaga</p>

                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec consectetur placerat dolor sit amet lacinia. Integer malesuada tristique elit, eu rhoncus mi fringilla malesuada. Pellentesque egestas, nisl hendrerit porta fermentum, urna tellus congue nulla, eget mattis magna ligula vitae enim. Ut ut tincidunt urna, at congue mauris. Sed et lacus turpis. In a finibus lacus, vel tincidunt enim. Nulla nec libero pretium enim viverra rutrum eu nec tortor. In imperdiet ex condimentum lectus laoreet tristique. Aliquam faucibus blandit feugiat. Quisque ut consequat enim. Maecenas at vehicula risus. Pellentesque leo arcu, iaculis non aliquam eget, viverra nec est. Quisque porttitor tincidunt posuere. Phasellus sed est id risus accumsan blandit at ac sapien. Mauris tincidunt sapien est, in condimentum enim maximus sit amet.
                    Phasellus massa eros, fermentum quis magna nec, rhoncus ornare quam. Fusce pulvinar fermentum vehicula. Sed vel imperdiet massa, eget fringilla sem. Integer laoreet vel sem sed laoreet. Nulla facilisi. Vivamus mollis quam non nulla lobortis rhoncus. Nulla facilisi. Etiam mollis molestie nisl sagittis convallis. Ut fermentum eleifend efficitur.
                    Phasellus commodo augue consectetur, fringilla quam eget, vestibulum dui. Fusce quis fermentum tellus. Sed tincidunt pharetra sem sed sodales. Nulla vel urna sed augue egestas maximus quis malesuada turpis. Pellentesque et tempor tortor. Phasellus sed massa porttitor, semper magna vel, vehicula eros. Nam malesuada aliquet orci, eu vehicula nunc euismod ac. Aliquam eu gravida lorem. Cras at varius quam. Vivamus augue massa, maximus id enim ut, vulputate pellentesque libero. Nam aliquet nisl urna, vel viverra lorem tristique vel.
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec consectetur placerat dolor sit amet lacinia. Integer malesuada tristique elit, eu rhoncus mi fringilla malesuada. Pellentesque egestas, nisl hendrerit porta fermentum, urna tellus congue nulla, eget mattis magna ligula vitae enim. Ut ut tincidunt urna, at congue mauris. Sed et lacus turpis. In a finibus lacus, vel tincidunt enim. Nulla nec libero pretium enim viverra rutrum eu nec tortor. In imperdiet ex condimentum lectus laoreet tristique. Aliquam faucibus blandit feugiat. Quisque ut consequat enim. Maecenas at vehicula risus. Pellentesque leo arcu, iaculis non aliquam eget, viverra nec est. Quisque porttitor tincidunt posuere. Phasellus sed est id risus accumsan blandit at ac sapien. Mauris tincidunt sapien est, in condimentum enim maximus sit amet.
                    Phasellus massa eros, fermentum quis magna nec, rhoncus ornare quam. Fusce pulvinar fermentum vehicula. Sed vel imperdiet massa, eget fringilla sem. Integer laoreet vel sem sed laoreet. Nulla facilisi. Vivamus mollis quam non nulla lobortis rhoncus. Nulla facilisi. Etiam mollis molestie nisl sagittis convallis. Ut fermentum eleifend efficitur.
                    Phasellus commodo augue consectetur, fringilla quam eget, vestibulum dui. Fusce quis fermentum tellus. Sed tincidunt pharetra sem sed sodales. Nulla vel urna sed augue egestas maximus quis malesuada turpis. Pellentesque et tempor tortor. Phasellus sed massa porttitor, semper magna vel, vehicula eros. Nam malesuada aliquet orci, eu vehicula nunc euismod ac. Aliquam eu gravida lorem. Cras at varius quam. Vivamus augue massa, maximus id enim ut, vulputate pellentesque libero. Nam aliquet nisl urna, vel viverra lorem tristique vel.
                </p>
            </div>
        </div>
    </section>

</body>

</html>