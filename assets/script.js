
        const formLogin = document.getElementById('form-login');
        const formCadastro = document.getElementById('form-cadastro');

        const textoLogin = document.getElementById('texto-login');
        const textoCadastro = document.getElementById('texto-cadastro');

        const abrirCadastro = document.getElementById('abrir-cadastro');
        const voltarLogin = document.getElementById('voltar-login');

        const tituloLogin = document.getElementById('titulo-login');
        const tituloCadastro = document.getElementById('titulo-cadastro');

        abrirCadastro.addEventListener('click', function (event) {
            event.preventDefault();

            formLogin.style.display = 'none';
            formCadastro.style.display = 'flex';

            textoLogin.style.display = 'none';
            textoCadastro.style.display = 'block';

            tituloLogin.style.display = 'none';
            tituloCadastro.style.display = 'block';
        });

        voltarLogin.addEventListener('click', function (event) {
            event.preventDefault();

            formCadastro.style.display = 'none';
            formLogin.style.display = 'flex';

            textoCadastro.style.display = 'none';
            textoLogin.style.display = 'block';

            tituloCadastro.style.display = 'none';
            tituloLogin.style.display = 'block';
        });
