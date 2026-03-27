<?php

// Função para carregar o cardápio do arquivo JSON ou inicializar com os dias da semana se o arquivo não existir ou estiver vazio
function carregarCardapio($arquivoJson)
{
    if (file_exists($arquivoJson)) {
        $cardapioJson = file_get_contents($arquivoJson);
        $cardapio = json_decode($cardapioJson, true);

        if (!is_array($cardapio) || !isset($cardapio[0]['dia'])) {
            $cardapio = [
                ["dia" => "Segunda-"],
                ["dia" => "Terça"],
                ["dia" => "Quarta"],
                ["dia" => "Quinta"],
                ["dia" => "Sexta"]
            ];
        }
    } else {
        $cardapio = [
            ["dia" => "Segunda"],
            ["dia" => "Terça"],
            ["dia" => "Quarta"],
            ["dia" => "Quinta"],
            ["dia" => "Sexta"]
        ];
    }

    return $cardapio;
}
//__________________________________________________________________________________________________

// Função para mostrar os dias da semana para o usuário escolher
function mostrarDias($cardapio)
{

    echo "\nEscolha um dia da semana para acrescentar o cardápio correspondente:\n\n";
    foreach ($cardapio as $indice => $item) {
        echo ($indice + 1) . " - " . $item['dia'] . "\n"; // Exibe as opções numeradas para o usuário
    }
}
//__________________________________________________________________________________________________

// Função para adicionar o cardápio do dia escolhido
function adicionarCardapio(&$cardapio, $indice)
{
    $dia = $cardapio[$indice]['dia']; // Acessa o dia correspondente ao número escolhido
    echo "\nA opção escolhida é $dia\n";

    echo "\n--------------Digite o café da manhã para $dia--------------\n\n";
    $cafeDaManha = trim(fgets(STDIN));
    $cardapio[$indice]['cafe_da_manha'] = $cafeDaManha;
    echo "\nO café da manhã para $dia é: $cafeDaManha\n";

    echo "\n--------------Digite o almoço para $dia--------------\n\n";
    $almoco = trim(fgets(STDIN));
    $cardapio[$indice]['almoco'] = $almoco;
    echo "\nO almoço para $dia é: $almoco\n";

    echo "\n--------------Digite o jantar para $dia--------------\n\n";
    $jantar = trim(fgets(STDIN));
    $cardapio[$indice]['jantar'] = $jantar;
    echo "\nO jantar para $dia é: $jantar\n";

    echo "\n\n--------------Aqui está o cardápio atualizado para $dia--------------\n\n";
    echo "Café da manhã: {$cardapio[$indice]['cafe_da_manha']}\n";
    echo "Almoço: {$cardapio[$indice]['almoco']}\n";
    echo "Jantar: {$cardapio[$indice]['jantar']}\n";
}

//__________________________________________________________________________________________________

function criarSlug($texto) {

    // remover acentos
    $texto = iconv('UTF-8', 'ASCII//TRANSLIT', $texto);

    // converter para minúsculo
    $texto = strtolower($texto);

    // substituir espaços por hífen
    $texto = str_replace(' ', '-', $texto);

    // remover caracteres que não sejam letra, número ou hífen
    $texto = preg_replace('/[^a-z0-9\-]/', '', $texto);

    return $texto;
}

//__________________________________________________________________________________________________
// Função para carregar os usuários do arquivo JSON
function carregarUsuarios($arquivoJson) {
    if (file_exists($arquivoJson)) {
        $conteudo = file_get_contents($arquivoJson);
        $usuarios = json_decode($conteudo, true);

        if (is_array($usuarios)) {
            return $usuarios;
        }
    }

    return [];
}

//__________________________________________________________________________________________________
// Função para gerar o ID do novo usuário
function gerarProximoID($usuarios) {
    $maiorID = 0;

    foreach ($usuarios as $usuario) {
        if (isset($usuario['id']) && $usuario['id'] > $maiorID) {
            $maiorID = $usuario['id'];
        }
    }

    return $maiorID + 1;
}

//__________________________________________________________________________________________________

// Função para cadastrar um novo usuário
function cadastrarUsuario($arquivoJson, $nome, $email, $senha) {
    $usuarios = carregarUsuarios($arquivoJson);
    $proximoID = gerarProximoID($usuarios);

    $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
    $novoUsuario = [
        "id" => $proximoID,
        "nome" => $nome,
        "email" => $email,
        "senha" => $senhaHash
    ];

    $usuarios[] = $novoUsuario;

    file_put_contents(
        $arquivoJson,
        json_encode($usuarios, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
    );
}

//__________________________________________________________________________________________________

// Função para verificar se o e-mail ja existe
function emailJaExiste($usuarios, $email) {
    foreach ($usuarios as $usuario) {
        if (isset($usuario['email']) && $usuario['email'] === $email) {
            return true;
        }
    }

    return false;
}

//__________________________________________________________________________________________________

function buscarUsuarioPorLogin($usuarios, $loginDigitado) {
    foreach ($usuarios as $usuario) {
        if(
            (isset($usuario['email']) && $usuario['email'] === $loginDigitado) ||
            (isset($usuario['nome']) && $usuario['nome'] === $loginDigitado)
        ){
            return $usuario;
        }
    }
    return null;
}