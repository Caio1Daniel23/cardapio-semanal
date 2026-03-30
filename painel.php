<?php

session_start();

// Verifica se o usuário está logado, caso contrário, redireciona para a página de login
if (!isset($_SESSION["usuario_logado"])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel do Restaurante</title>
    <link rel="stylesheet" href="assets/style.css">
</head>

<body>
    
    <h1>Painel do Usuário</h1>

    <p>Bem-vindo, <?php echo htmlspecialchars($_SESSION["nome"]); ?>!</p>


    <form action="logout.php" method="POST">
        <button type="submit">Sair</button>
    </form>

</body>
</html>