<?php
echo "Seção: ";
print_r($_SESSION);

$isLoged = isset($_SESSION['nome']) && !empty($_SESSION['nome']);
echo $isLoged ? "Logado" : "Não Logado";

?>

<nav>
    <ul>
        <li><a href="/index.php">Inicio</a></li>
        <?php if ($isLoged): ?>
            <li><a href="/profile.php">Meu Perfil</a></li>
            <li><a href="/logout.php">logout</a></li>
        <?php else: ?>
            <li><a href="/login.php">login</a></li>
        <?php endif; ?>
    </ul>
</nav>