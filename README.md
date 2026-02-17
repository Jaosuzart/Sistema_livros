# 📚 Sistema de Livros (Cadastro e Empréstimo)
Sistema de gerenciamento de livros desenvolvido em **PHP** com arquitetura **MVC**. O projeto permite o cadastro de livros, controle de usuários, gestão de empréstimos e upload de capas.
Focado em organização de código, boas práticas de desenvolvimento web e Programação Orientada a Objetos (POO).
![Screenshot do Sistema](https://github.com/user-attachments/assets/26219404-7f7c-418f-a69a-f1df6f0fe10c)
## 🚀 Funcionalidades
### 📖 Livros
- [x] Cadastro de novos livros
- [x] Listagem completa
- [x] Edição e exclusão de registros
- [x] Upload de capa dos livros
### 🔄 Empréstimos
- [x] Controle de empréstimos (Saída/Devolução)
- [x] Acompanhamento de status (Emprestado/Devolvido)
- [x] Histórico por usuário
### 🔐 Segurança
- [x] Sistema de Login
- [x] Sessão de usuário
- [x] Logout seguro
## 🛠️ Tecnologias Utilizadas

*   **Backend:** PHP 8+
*   **Banco de Dados:** MySQL / MariaDB
*   **Frontend:** HTML5, CSS3, Bootstrap
*   **Arquitetura:** MVC (Model-View-Controller)
*   **Versionamento:** Git
## 🗂️ Estrutura do Projeto
Sistema_livros/
│── Config/
│   ├── Config.php          # Configurações gerais
│   └── Database.php        # Conexão com o banco
│── Controllers/            # Lógica de negócios e rotas
│── Models/
│   ├── Livro.php           # Modelo de Livro
│   ├── Usuario.php         # Modelo de Usuário
│   └── Emprestimo.php      # Modelo de Empréstimo
│── Views/                  # Interface (HTML/PHP)
│── Public/                 # Arquivos públicos (CSS/JS)
│── uploads/                # Imagens das capas enviadas
│── css/                    # Estilos personalizados
│── index.php               # Ponto de entrada
│── .env                    # Variáveis de ambiente (se houver)
└── .gitignore
