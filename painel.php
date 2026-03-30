<?php

session_start();

// Verifica se o usuário está logado, caso contrário, redireciona para a página de login
if (!isset($_SESSION["usuario_logado"])) {
    header("Location: login.php");
    exit;
}

$arquivoCardapio = __DIR__ . "/cardapio.json";

if (file_exists($arquivoCardapio)) {
    $cardapioJson = file_get_contents($arquivoCardapio);
    $cardapio = json_decode($cardapioJson, true);
} else {
    $cardapio = [];
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["cardapio"])) {
        $novoCardapio = $_POST["cardapio"];

        file_put_contents($arquivoCardapio, json_encode($novoCardapio, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

        header("Location: painel.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel do Restaurante</title>
    <link rel="stylesheet" href="assets/style.css">
    <link rel="stylesheet" href="assets/painel.css">
</head>

<body>

<body>

    <div class="pagina-painel">

        <div class="topo-painel">
            <div class="topo-painel-textos">
                <h1>Painel do Usuário</h1>
                <p>Bem-vindo, <?php echo htmlspecialchars($_SESSION["nome"]); ?>!</p>
            </div>

            <form action="logout.php" method="POST" class="form-logout">
                <button type="submit" class="botao-sair">Sair</button>
            </form>
        </div>

        <div class="bloco-cardapio">
            <h2>Cardápio da Semana</h2>

            <form method="POST" class="form-cardapio">

                <div class="grade-cardapio">
                    <?php foreach ($cardapio as $dia => $refeicoes): ?>

                        <div class="card-dia">
                            <h3><?php echo htmlspecialchars($refeicoes["dia"] ?? "Dia não informado"); ?></h3>

                            <input
                                type="hidden"
                                name="cardapio[<?php echo $dia; ?>][dia]"
                                value="<?php echo htmlspecialchars($refeicoes["dia"] ?? ""); ?>">

                            <label for="cafe-<?php echo $dia; ?>">Café da manhã</label>
                            <input
                                type="text"
                                id="cafe-<?php echo $dia; ?>"
                                name="cardapio[<?php echo $dia; ?>][cafe]"
                                value="<?php echo htmlspecialchars($refeicoes["cafe"] ?? ""); ?>">

                            <label for="almoco-<?php echo $dia; ?>">Almoço</label>
                            <input
                                type="text"
                                id="almoco-<?php echo $dia; ?>"
                                name="cardapio[<?php echo $dia; ?>][almoco]"
                                value="<?php echo htmlspecialchars($refeicoes["almoco"] ?? ""); ?>">

                            <label for="jantar-<?php echo $dia; ?>">Jantar</label>
                            <input
                                type="text"
                                id="jantar-<?php echo $dia; ?>"
                                name="cardapio[<?php echo $dia; ?>][jantar]"
                                value="<?php echo htmlspecialchars($refeicoes["jantar"] ?? ""); ?>">
                        </div>

                    <?php endforeach; ?>
                </div>

                <div class="acoes-cardapio">
                    <button type="submit" class="botao-salvar">Salvar Cardápio</button>
                </div>

            </form>
        </div>

    </div>

</body>

</body>

</html>