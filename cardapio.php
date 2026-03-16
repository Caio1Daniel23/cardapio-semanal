<?php

require_once __DIR__ . "/funcoes.php"; // Inclui o arquivo de funções para carregar o cardápio

$arquivoJson = __DIR__ . '/cardapio.json';

$cardapio = carregarCardapio($arquivoJson); // Carrega o cardápio do arquivo JSON ou inicializa com os dias da semana se o arquivo não existir ou estiver vazio

echo "\n\nBem vindo ao cardápio do restaurante! Aqui estão as opções disponíveis:\n\n";

while (true) {
    //função para mostrar os dias da semana para o usuário escolher
    mostrarDias($cardapio);

    // Loop para garantir que o usuário escolha uma opção válida
    while (true) {
        echo "\nDigite a opção desejada: ";
        $opcaoEscolhida = (int)trim(fgets(STDIN));

        if ($opcaoEscolhida >= 1 && $opcaoEscolhida <= 5) {
            $indice = (int)$opcaoEscolhida - 1; // Ajusta o índice para acessar o array
            $dia = $cardapio[$indice]['dia']; // Acessa o dia correspondente ao número escolhido
            break;
        } else {
            echo "Opção inválida. Por favor, escolha um número entre 1 e 5.\n";
        }
    }

    //função para adicionar o cardápio do dia escolhido
       adicionarCardapio($cardapio, $indice);

    while (true) {
        echo "\n\nDeseja adicionar mais um dia ao cardápio? (s/n): ";
        $resposta = strtolower(trim(fgets(STDIN))); // Converte a resposta para minúscula para facilitar a comparação

        if ($resposta === "s") {
            break; // Sai do loop principal se o usuário não quiser adicionar mais dias
        } elseif ($resposta === "n") {
            break 2; // Sai do loop principal se o usuário não quiser adicionar mais dias
        } else {
            echo "Resposta inválida. Por favor, digite 's' para sim ou 'n' para não.\n";
        }
    }
}

echo "\n===== CARDÁPIO DA SEMANA =====\n\n";
foreach ($cardapio as $dia) {
    echo "{$dia['dia']}\n";
    echo "Café da manhã: " . ($dia['cafe_da_manha'] ?? "Não definido") . "\n";
    echo "Almoço: " . ($dia['almoco'] ?? "Não definido") . "\n";
    echo "Jantar: " . ($dia['jantar'] ?? "Não definido") . "\n";
    echo "----------------------------\n";
}

$cardapioJson = json_encode($cardapio, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE); // Converte o array associativo para JSON com formatação legível e sem escapar caracteres Unicode
file_put_contents($arquivoJson, $cardapioJson); // Salva o JSON atualizado no arquivo

echo "\nCardápio salvo com sucesso em $arquivoJson\n\n";
