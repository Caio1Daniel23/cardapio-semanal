<?php
$arquivoJson = __DIR__ . "/cadastro_usuarios.json";

if (file_exists($arquivoJson)) {
    $usuariosJson = file_get_contents($arquivoJson);
    $usuarios = json_decode($usuariosJson, true);

    if(!is_array($usuarios)){
        $usuarios = [];
    }
}else{
    $usuarios = [];
}

echo "==============Cadastro de Usuário==============\n\n";

echo "Digite o nome do seu usuário:\n";
$nome = (string)trim(fgets(STDIN));

echo "\nDigite seu e-mail:\n";
$email = (string)trim(fgets(STDIN));

echo "\nDigite sua senha:\n";
$senha = trim(fgets(STDIN));

if (count($usuarios) === 0){
    $proximoID = 1;
}else{
    $ultimoIndice = count($usuarios) -1;
    $ultimoUsuario = $usuarios[$ultimoIndice];
    $proximoID = $ultimoUsuario["id"] + 1;
}

$novoUsuario = [
    "id" => $proximoID,
    "nome" => $nome,
    "email" => $email,
    "senha" => $senha,
];

$usuarios[] = $novoUsuario;

$usuariosJson = json_encode($usuarios, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
file_put_contents($arquivoJson, $usuariosJson);

echo "\nUsuário cadastrado com sucesso!\n\n";