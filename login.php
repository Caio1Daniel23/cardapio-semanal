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
            <h2 id="titulo-login">LOGIN DO RESTAURANTE</h2>
            <h2 id="titulo-cadastro" style="display: none;">CADASTRO DE USUÁRIO</h2>
        </div>

        <div class="card-login">

    <div class="icone-topo">
        <img src="assets/img/jantar.png" alt="Ícone restaurante">
    </div>

    <div class="area-formularios">

        <form id="form-login">
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
        </form>

<!------------------------------------Formulário de cadastro----------------------------------------------------------------->

        <form id="form-cadastro" style="display: none;">
            <label for="cadastro-nome">Nome Completo</label>
            <div class="grupo-input">
                <div class="icone-input">
                    <img src="assets/img/icone-usuario.png" alt="Nome">
                </div>
                <input type="text" id="cadastro-nome" name="nome">
            </div>

            <label for="cadastro-email">E-mail</label>
            <div class="grupo-input">
                <div class="icone-input">
                    <img src="assets/img/email.png" alt="E-mail">
                </div>
                <input type="email" id="cadastro-email" name="email">
            </div>

            <label for="cadastro-senha">Senha</label>
            <div class="grupo-input">
                <div class="icone-input">
                    <img src="assets/img/icone-senha.png" alt="Senha">
                </div>
                <input type="password" id="cadastro-senha" name="senha">
            </div>

            <button type="submit">CADASTRAR</button>
        </form>

    </div>



</div>
    <p class="link-cadastro" id="texto-login">
        Ainda não tem conta?
        <a href="#" id="abrir-cadastro">Cadastre-se</a>
    </p>

    <p class="link-cadastro" id="texto-cadastro" style="display: none;">
        Já tem conta?
        <a href="#" id="voltar-login">Entrar</a>
    </p>

    <script src="assets/script.js"></script>
</body>

</html>