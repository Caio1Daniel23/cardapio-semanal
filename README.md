# 🍽️ Cardápio Semanal

Sistema web simples para gerenciamento de cardápio semanal (segunda a sexta), com autenticação de usuário e painel administrativo.

---

## 🚀 Funcionalidades

- Cadastro de usuários com validação
- Login com verificação de senha (`password_verify`)
- Controle de sessão (login/logout)
- Página protegida (painel administrativo)
- Edição do cardápio semanal:
  - Café da manhã
  - Almoço
  - Jantar
- Persistência dos dados em arquivo JSON
- Exibição pública do cardápio
- Layout responsivo e organizado

---

## 🛠️ Tecnologias utilizadas

- PHP (puro)
- HTML5
- CSS3
- JavaScript
- JSON (armazenamento de dados)

---

## 📂 Estrutura do projeto

cardapio-semanal/
│
├── index.php # Página pública do cardápio
├── login.php # Tela de login e cadastro
├── painel.php # Painel administrativo
├── logout.php # Encerrar sessão
├── funcoes.php # Funções auxiliares
│
├── cardapio.json # Dados do cardápio
├── cadastro_usuarios.json # Dados dos usuários
│
└── assets/
├── style.css # Estilo geral
└── painel.css # Estilo do painel


---

## 🔐 Autenticação

O sistema utiliza:

- `password_hash()` para criptografar 

---

## 🔐 Autenticação

O sistema utiliza:

- `password_hash()` para criptografar senhas
- `password_verify()` para validação no login
- `$_SESSION` para controle de acesso

---

## ✏️ Como funciona a edição

No painel administrativo, o usuário pode:

- editar os campos do cardápio
- salvar alterações
- os dados são atualizados diretamente no `cardapio.json`

---

## 💡 Aprendizados do projeto

- Manipulação de JSON com PHP
- Estrutura de autenticação sem banco de dados
- Organização de código com funções reutilizáveis
- Uso de sessões (`$_SESSION`)
- Separação de responsabilidades (frontend/backend)
- Boas práticas básicas de segurança

---

## 📌 Melhorias futuras

- Sistema com banco de dados (MySQL)
- Níveis de acesso (admin/usuário)
- Upload de imagens para os pratos
- Uso de framework (Laravel)
- API para consumo externo

---

## 👨‍💻 Autor

Caio Daniel

Projeto desenvolvido para aprendizado e portfólio.