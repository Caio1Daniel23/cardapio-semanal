<?php
require_once __DIR__ . '/funcoes.php';

$arquivoJson = __DIR__ . '/cardapio.json';
$cardapio = carregarCardapio($arquivoJson);
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Cardápio semanal</title>
    <link rel="stylesheet" href="assets/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>

    <main class="pagina-cardapio">
        <h1>Cardápio semanal: segunda a sexta</h1>

        <section class="grade-cardapio">
            <?php foreach ($cardapio as $indice => $item): ?>
                <article class="card-dia cor-<?php echo $indice + 1; ?>">
                    <h2 class="dia-<?php echo criarSlug($item['dia']); ?>">
                        <?php echo $item['dia']; ?>
                    </h2>

                    <div class="bloco-refeicao cafe-da-manha">
                        <img class="icone-refeicao" src="assets/img/cafe02.png" alt="">
                        <h3>Café da manhã</h3>
                        <p><?php echo $item['cafe_da_manha'] ?? 'Sem cardápio neste dia'; ?></p>
                    </div>

                    <div class="bloco-refeicao almoco">
                        <img class="icone-refeicao" src="assets/img/almoco.png" alt="">
                        <h3>
                            Almoço
                        </h3>
                        <p><?php echo $item['almoco'] ?? 'Sem cardápio neste dia'; ?></p>
                    </div>

                    <div class="bloco-refeicao jantar">
                        <img class="icone-refeicao" src="assets/img/jantar.png" alt="">
                        <h3>Jantar</h3>
                        <p><?php echo $item['jantar'] ?? 'Sem cardápio neste dia'; ?></p>
                    </div>
                </article>
            <?php endforeach; ?>
        </section>
    </main>

</body>

</html>