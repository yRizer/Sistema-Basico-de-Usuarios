# Cadastro e Login de Usuários

Sistema de usuários feito como teste técnico para uma vaga de back-end: cadastro, login, edição de perfil e upload de foto, com layout responsivo do desktop ao celular.

## Funcionalidades

- Cadastro com validação de nome, e-mail e senha no servidor e no navegador.
- Login e logout com sessão PHP; senhas guardadas com `password_hash` (bcrypt).
- Página de perfil com edição dos dados.
- Upload de foto de perfil (JPG ou PNG, tipo validado pelo conteúdo do arquivo), apagando a foto antiga ao trocar.
- Modais de feedback para sucesso e erro.

## Stack

- PHP com PDO (consultas preparadas) e autoload PSR-4 via Composer
- MySQL
- JavaScript e CSS puros, com a fonte Hanken Grotesk

## Como rodar

1. Crie um banco MySQL chamado `testevaga` com a tabela `users`. A coluna `senha` precisa ser `VARCHAR(255)` para guardar o hash.
2. Defina o acesso ao banco por variáveis de ambiente (a senha nunca fica no código):

   ```bash
   export DB_HOST=localhost DB_PORT=3306 DB_NAME=testevaga DB_USER=root DB_PASSWORD=sua_senha
   ```

3. Gere o autoload e suba o servidor apontando para `public/`:

   ```bash
   composer dump-autoload
   php -S localhost:8000 -t public
   ```

4. Acesse `http://localhost:8000`.

## Estrutura

```
public/        páginas (index, login, cadastro, perfil), CSS, JS e imagens
src/app/
  db/          conexão e consultas com PDO
  library/     validações e atualizações de perfil
  utilities/   upload de imagens e modais
src/templates/ navegação
```

---

Mais projetos no meu portfólio: [yrizer.github.io/Portifolio](https://yrizer.github.io/Portifolio/)
