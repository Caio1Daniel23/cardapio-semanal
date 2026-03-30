<?php

session_start();

require_once __DIR__ . "/funcoes.php";

$arquivoJson = __DIR__ . "/cadastro_usuarios.json";

$mensagem = "";
$tipoMensagem = "";
$mostrarCadastro = false;
$emailComErro = false;
$formularioMensagem = "";

if (isset($_GET["status"])) {
    if ($_GET["status"] === "sucesso") {
        $mensagem = "Login realizado com sucesso!";
        $tipoMensagem = "sucesso";
        $formularioMensagem = "login";
    }

    if ($_GET["status"] === "senha_incorreta") {
        $mensagem = "Senha incorreta.";
        $tipoMensagem = "erro";
        $formularioMensagem = "login";
    }

    if ($_GET["status"] === "usuario_nao_encontrado") {
        $mensagem = "Usuário NÃO encontrado!";
        $tipoMensagem = "erro";
        $formularioMensagem = "login";
    }
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $acao = $_POST["acao"] ?? "";

    // Verifica se o formulário de cadastro foi submetido
    if ($acao === "cadastro") {
        $nome = trim($_POST["nome"] ?? "");
        $email = trim($_POST["email"] ?? "");
        $senha = trim($_POST["senha"] ?? "");

        $usuarios = carregarUsuarios($arquivoJson);

        if ($nome === "" || $email === "" || $senha === "") {
            $mensagem = "Preencha todos os campos do cadastro.";
            $tipoMensagem = "erro";
            $mostrarCadastro = true;
            $formularioMensagem = "cadastro";
        } elseif (emailJaExiste($usuarios, $email)) {
            $mensagem = "Este e-mail já está cadastrado.";
            $tipoMensagem = "erro";
            $mostrarCadastro = true;
            $emailComErro = true;
            $formularioMensagem = "cadastro";
        } else {
            cadastrarUsuario($arquivoJson, $nome, $email, $senha);
            $mensagem = "Usuário cadastrado com sucesso!";
            $tipoMensagem = "sucesso";
            $mostrarCadastro = true;
            $formularioMensagem = "cadastro";
        }
    }

    // Verifica se o formulário de login foi submetido 
    if ($acao === "login") {
        $usuario = trim($_POST["usuario"] ?? "");
        $senhaLogin = trim($_POST["senha"] ?? "");

        if ($usuario === "" || $senhaLogin === "") {
            $mensagem = "Preencha usuário e senha para entrar.";
            $tipoMensagem = "erro";
            $formularioMensagem = "login";
        } else {
            $usuarios = carregarUsuarios($arquivoJson);

            $usuarioEncontrado = buscarUsuarioPorLogin($usuarios, $usuario);

            if ($usuarioEncontrado) {
                if (password_verify($senhaLogin, $usuarioEncontrado["senha"])) {
                    $_SESSION["usuario_logado"] = true;
                    $_SESSION["nome"] = $usuarioEncontrado["nome"];
                    $_SESSION["email"] = $usuarioEncontrado["email"];

                    header("Location: painel.php");
                    exit;
                } else {
                    header("Location: login.php?status=senha_incorreta");
                    exit;
                }
            } else {
                header("Location: login.php?status=usuario_nao_encontrado");
                exit;
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login do Restaurante</title>
    <link rel="stylesheet" href="assets/style.css">
</head>

<body>
    <div class="pagina-login">

        <div class="cabecalho-login">
            <h1>ACESSO EXCLUSIVO AO CARDÁPIO E RESERVAS</h1>
            <h2 id="titulo-login" style="<?php echo $mostrarCadastro ? 'display: none;' : 'display: block;'; ?>">
                LOGIN DO RESTAURANTE
            </h2>
            <h2 id="titulo-cadastro" style="<?php echo $mostrarCadastro ? 'display: block;' : 'display: none;'; ?>">
                CADASTRO DE USUÁRIO
            </h2>
        </div>

        <div class="card-login">

            <div class="icone-topo">
                <img src="assets/img/jantar.png" alt="Ícone restaurante">
            </div>

            <div class="area-formularios">

                <form id="form-login" method="POST" style="<?php echo $mostrarCadastro ? 'display: none;' : 'display: flex;'; ?>">
                    <input type="hidden" name="acao" value="login">

                    <label for="usuario">E-mail ou nome de usuário</label>
                    <div class="grupo-input">
                        <div class="icone-input">
                            <img src="assets/img/icone-usuario.png" alt="Usuário">
                        </div>
                        <input type="text" id="usuario" name="usuario">
                    </div>

                    <label for="senha">Senha</label>
                    <div class="grupo-input">
                        <div class="icone-input">
                            <img src="assets/img/icone-senha.png" alt="Senha">
                        </div>
                        <input type="password" id="senha" name="senha">
                    </div>

                    <button type="submit">ENTRAR</button>

                    <?php if ($mensagem !== "" && $formularioMensagem === "login"): ?>
                        <p class="mensagem <?php echo $tipoMensagem; ?>" id="mensagem-login">
                            <?php echo htmlspecialchars($mensagem); ?>
                        </p>
                    <?php endif; ?>
                </form>

                <form id="form-cadastro" method="POST" style="<?php echo $mostrarCadastro ? 'display: flex;' : 'display: none;'; ?>">
                    <input type="hidden" name="acao" value="cadastro">

                    <label for="cadastro-nome">Nome Completo</label>
                    <div class="grupo-input">
                        <div class="icone-input">
                            <img src="assets/img/icone-usuario.png" alt="Nome">
                        </div>
                        <input
                            type="text"
                            id="cadastro-nome"
                            name="nome"
                            value="<?php echo htmlspecialchars($_POST['nome'] ?? ''); ?>">
                    </div>

                    <label for="cadastro-email">E-mail</label>
                    <div class="grupo-input <?php echo $emailComErro ? 'grupo-input-erro' : ''; ?>">
                        <div class="icone-input">
                            <img src="assets/img/email.png" alt="E-mail">
                        </div>
                        <input
                            type="email"
                            id="cadastro-email"
                            name="email"
                            value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>">
                    </div>

                    <label for="cadastro-senha">Senha</label>
                    <div class="grupo-input">
                        <div class="icone-input">
                            <img src="assets/img/icone-senha.png" alt="Senha">
                        </div>
                        <input type="password" id="cadastro-senha" name="senha">
                    </div>

                    <button type="submit">CADASTRAR</button>

                    <?php if ($mensagem !== "" && $formularioMensagem === "cadastro"): ?>
                        <p class="mensagem <?php echo $tipoMensagem; ?>" id="mensagem-cadastro">
                            <?php echo htmlspecialchars($mensagem); ?>
                        </p>
                    <?php endif; ?>
                </form>

            </div>

        </div>

        <p class="link-cadastro" id="texto-login" style="<?php echo $mostrarCadastro ? 'display: none;' : 'display: block;'; ?>">
            Ainda não tem conta?
            <a href="#" id="abrir-cadastro">Cadastre-se</a>
        </p>

        <p class="link-cadastro" id="texto-cadastro" style="<?php echo $mostrarCadastro ? 'display: block;' : 'display: none;'; ?>">
            Já tem conta?
            <a href="#" id="voltar-login">Entrar</a>
        </p>

    </div>

    <script src="assets/script.js"></script>
</body>

</html>