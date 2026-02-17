<<<<<<< HEAD
📚 Sistema de Livros
Sistema de gerenciamento de livros desenvolvido em PHP com arquitetura MVC, permitindo cadastro, listagem, edição e controle de usuários e empréstimos.
Projeto criado com foco em organização de código, boas práticas e aprendizado em desenvolvimento web.
🚀 Funcionalidades
📖 Cadastro de livros
👤 Cadastro de usuários
🔄 Controle de empréstimos
✏️ Edição e exclusão de registros
🖼️ Upload de capa dos livros
🔐 Sistema de login
🗂️ Estrutura MVC (Models, Views, Controllers)
💾 Integração com banco de dados MySQL
🛠️ Tecnologias Utilizadas
PHP 8+
MySQL
HTML5
Bootstrap
Sistema_livros/
│── Config/
│   ├── Config.php
│   └── Database.php
│── Controllers/
│── Models/
│   ├── Livro.php
│   ├── Usuario.php
│   └── Emprestimo.php
│── Views/
│── Public/
│── uploads/
│── css/
│── index.php
│── .env
│── .gitignore
⚙️ Como Executar o Projeto
1️⃣ Clonar o repositório
git clone https://github.com/Jaosuzart/Sistema_livros.git
2️⃣ Configurar o servidor local
Coloque o projeto na pasta do WAMP/XAMPP:
C:\wamp64\www\
3️⃣ Configurar o banco de dados
Crie um banco MySQL
Configure os dados no arquivo .env ou Config.php
4️⃣ Executar no navegador
http://localhost/Sistema_livros
🧠 Objetivo do Projeto
Este projeto foi desenvolvido para praticar:
Programação orientada a objetos (POO)
Arquitetura MVC
Integração com banco de dados
Versionamento com Git
Organização de projetos PHP
👨‍💻 Autor
Desenvolvido por João Suzart 💻
GitHub: https://github.com/Jaosuzart
⭐ Se você gostou do projeto
Deixe uma estrela no repositório ⭐😄
Print do sistema 🖼️
<img width="1370" height="697" alt="image (2)" src="https://github.com/user-attachments/assets/26219404-7f7c-418f-a69a-f1df6f0fe10c" />
=======
# 📚 Sistema Livros (Cadastro e Empréstimo) | PHP + Bootstrap
Aplicação web para **cadastrar livros** e **gerenciar empréstimos**, feita em **PHP** com **Bootstrap**.  
Ideal para praticar **CRUD**, organização em camadas (**MVC**) e o fluxo de **empréstimo/devolução**.
## ✨ Funcionalidades
### 📖 Livros
- Listagem de livros cadastrados
- Adicionar novo livro
- Editar e remover livros
- (Opcional) Upload de **capa** do livro
### 🔁 Empréstimos
- Registrar empréstimo de livro
- Acompanhar status (**emprestado/devolvido**)
- Histórico por usuário e/ou por livro (dependendo da implementação)
### 👤 Sessão / Usuário
- Exibição do usuário logado no topo
- Botão de sair (**logout**)
 **Observação:** os detalhes exatos (campos e regras) podem variar conforme os *Models* e *Controllers* do projeto.
## 🧱 Tecnologias
- **PHP**
- **Bootstrap**
- **HTML/CSS**
- **MySQL/MariaDB** (recomendado)
## 🗂️ Estrutura do Projeto
text
Sistema_livros/
├─ Config/         # configurações (ex: conexão com BD)
├─ Controllers/    # regras/rotas/fluxo das páginas
├─ Models/         # acesso a dados e regras de negócio
├─ Views/          # telas (HTML/PHP)
├─ uploads/        # arquivos enviados (ex: capas)
└─ index.php       # entrada principal do sistema
✅ Requisitos
PHP 8.0+ (recomendado)
MySQL ou MariaDB
Servidor local: XAMPP, WAMP, Laragon ou similar
🚀 Como rodar localmente
1) Clonar o projeto
bash
Copiar código
git clone https://github.com/Jaosuzart/Sistema_livros.git
cd Sistema_livros
2) Colocar no servidor local
Exemplos:
XAMPP: C:\xampp\htdocs\Sistema_livros
WAMP: C:\wamp64\www\Sistema_livros
Laragon: C:\laragon\www\Sistema_livros
Depois acesse:
http://localhost/Sistema_livros/
3) Configurar o Banco de Dados
Procure o(s) arquivo(s) dentro de Config/ e ajuste:
Host
Nome do banco
Usuário
Senha
🗄️ Banco de dados (modelo sugerido)
Se você ainda não tiver um .sql pronto, aqui vai um exemplo de estrutura básica (ajuste para bater com seus Models):
sql
CREATE DATABASE IF NOT EXISTS sistema_livros
  DEFAULT CHARACTER SET utf8mb4
  DEFAULT COLLATE utf8mb4_unicode_ci;
USE sistema_livros;
-- usuários
CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(120) NOT NULL,
  email VARCHAR(160) NOT NULL UNIQUE,
  password_hash VARCHAR(255) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
-- livros
CREATE TABLE books (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(180) NOT NULL,
  author VARCHAR(160) NOT NULL,
  year INT NULL,
  cover_path VARCHAR(255) NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
- empréstimos
CREATE TABLE loans (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  book_id INT NOT NULL,
  loan_date DATE NOT NULL,
  due_date DATE NULL,
  return_date DATE NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT fk_loans_user FOREIGN KEY (user_id) REFERENCES users(id),
  CONSTRAINT fk_loans_book FOREIGN KEY (book_id) REFERENCES books(id)
);
🖼️ Upload de capas (importante)
A pasta uploads/ precisa ter permissão de escrita.
Em Windows geralmente funciona direto. Em Linux pode ser necessário:
bash
Copiar código
chmod -R 775 uploads
🧭 Rotas / Navegação
O sistema normalmente inicia pelo index.php e carrega as páginas via Controllers.
No menu, você encontrará:
Livros (lista)
Novo Livro (formulário)
Empréstimos (gestão)
Logout
>>>>>>> 93397753d6862e1aa284ec4922a3cd2ebda0a820
