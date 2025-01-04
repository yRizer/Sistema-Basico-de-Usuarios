<?php
session_start();

require __DIR__ . '/../vendor/autoload.php';

use App\utilities\Upload;
use App\db\DataBase;
use App\library\Updates;

$isLoged = isset($_SESSION['nome']) && !empty($_SESSION['nome']);

if (!$isLoged) {
    header('Location: /login.php');
    exit;
}

if (isset($_FILES['file']) && $_FILES['file']['name'] && $_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_SESSION['newProfileImageName']) && $_FILES['file'] || $_FILES['file']['name'] !== $_SESSION['newProfileImageName']) {
        echo 'Mudando imagem';

        $file = $_FILES['file'];

        if (($file['type'] === 'image/jpeg') && $file['type'] !== 'image/png') {
            $path = __DIR__ . '\\images\\uploadeds\\profiles\\';
            $fileResult = Upload::uploadFile($file, $path);
        } else {
            echo 'Tipo de arquivo inválido';
        }

        if (isset($fileResult)) {
            if ($_SESSION['profile_image'] !== 'Profile.jpg') {
                unlink($path . $_SESSION['profile_image']);
            }

            $db = new DataBase();
            $sendedImg = $db->SetNewProfileImage($_SESSION['id_user'], $fileResult);

            if ($sendedImg) {
                $_SESSION['newProfileImagePath'] = $fileResult;
                $_SESSION['newProfileImageName'] = $file['name'];

                $userInfos = $db->Login($_SESSION['email'], $_SESSION['senha']);



                Updates::updateSession($userInfos);
            } else {
                echo 'Erro ao enviar imagem';
            }
        } else {
            echo 'Erro ao enviar arquivo';
        }
    }
}

if (isset($_POST['nome']) && $_POST['nome'] !== $_SESSION['nome']) {
    echo 'Mudando nome';

    $db = new DataBase();
    $db->updateName($_SESSION['id_user'], $_POST['nome']);

    $userInfos = $db->Login($_SESSION['email'], $_SESSION['senha']);

    Updates::updateSession($userInfos);
}


if ($_SESSION['profile_image'] !== 'Profile.jpg') {
    $profileImgSrc = '\\images\\uploadeds\\profiles\\' . $_SESSION['profile_image'];
} else {
    $profileImgSrc = '\\images\\defaults\\' . $_SESSION['profile_image'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/profile.css">
    <link rel="stylesheet" href="/css/main_nav.css">
    <link rel="stylesheet" href="/css/index.css">
    <script src="/js/main.js"></script>
    <script src="/js/profile.js"></script>
    <title>Document</title>
</head>

<body>
    <?php
    include '../src/templates/nav/main_nav.php';
    ?>
    <div class="light-ball"></div>
    <section class="main-field">
        <div class="container">
            <div class="profile-info">
                <div class="head-profile">
                    <div class="img-profile-container">
                        <label class="input-file" for="profile"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                                <path fill="#fefefe" d="M0 96C0 60.7 28.7 32 64 32l384 0c35.3 0 64 28.7 64 64l0 320c0 35.3-28.7 64-64 64L64 480c-35.3 0-64-28.7-64-64L0 96zM323.8 202.5c-4.5-6.6-11.9-10.5-19.8-10.5s-15.4 3.9-19.8 10.5l-87 127.6L170.7 297c-4.6-5.7-11.5-9-18.7-9s-14.2 3.3-18.7 9l-64 80c-5.8 7.2-6.9 17.1-2.9 25.4s12.4 13.6 21.6 13.6l96 0 32 0 208 0c8.9 0 17.1-4.9 21.2-12.8s3.6-17.4-1.4-24.7l-120-176zM112 192a48 48 0 1 0 0-96 48 48 0 1 0 0 96z" />
                            </svg></label><input form="infosProfile" type="file" name="file" id="profile">
                        <div class="img-profile">
                            <img src="<?= $profileImgSrc ?>" alt="Imagem de Perfil" id="profileImg">
                        </div>
                    </div>
                    <label for="nome">
                        <h3><?= $_SESSION['nome'] ?></h3>
                    </label>
                    <label for="email">Email: <?= $_SESSION['email'] ?></label>
                </div>

                <form id="infosProfile" class="update-infos" action="profile.php" method="post" enctype="multipart/form-data">
                    <h4>Editar dados</h4>
                    <label for="nome">Nome: </label>
                    <input id="nome" type="text" name="nome" value="<?= $_SESSION['nome'] ?>">
                    <button class="btn-update" type="submit" value="Submit">Enviar</button>
                </form>
            </div>
        </div>
    </section>
</body>

</html>