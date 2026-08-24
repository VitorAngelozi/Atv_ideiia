# Estuda UFMS

Sistema Web de Gerenciamento de Estudos desenvolvido para o Projeto Integrador II da UFMS.

## Descrição

O Estuda UFMS é uma aplicação acadêmica simples para organizar atividades de estudo. O usuário pode cadastrar tarefas, definir disciplina, prazo, prioridade e status, acompanhar um resumo no dashboard e filtrar a lista de atividades.

## Objetivo

Demonstrar, em uma aplicação pequena e funcional, o uso do Laravel como framework web, seguindo o padrão MVC, com persistência em banco de dados, validação de formulários e interface HTML semântica e responsiva.

## Funcionalidades

- Dashboard com total de atividades e contadores por status.
- Lista das próximas atividades.
- Cadastro, edição e exclusão de atividades.
- Alteração rápida de status.
- Filtros por status e disciplina.
- Validação dos formulários com mensagens em português.
- Seed com dados fictícios para demonstração.
- Testes automatizados dos fluxos principais.

## Tecnologias utilizadas

- PHP 8.3 ou superior
- Laravel 13
- Blade
- HTML5 semântico
- CSS responsivo
- SQLite
- Vite apenas para compilar o arquivo CSS do Laravel
- PHPUnit
- Git/GitHub

Não são utilizadas APIs externas, Docker, React, Vue ou outras bibliotecas frontend.

## Requisitos

- PHP com as extensões `pdo_sqlite` e `sqlite3` habilitadas.
- Composer.
- Node.js e npm, necessários para gerar os assets CSS.

No Windows, verifique as extensões com:

```powershell
php -m | Select-String "sqlite|pdo"
```

## Instalação

Clone o projeto e entre na pasta:

```bash
git clone <url-do-repositorio>
cd projetoIntegrador2
```

Instale as dependências PHP e frontend:

```bash
composer install
npm install
```

Crie o arquivo de ambiente e gere a chave:

```bash
copy .env.example .env
php artisan key:generate
```

No `.env`, mantenha:

```env
DB_CONNECTION=sqlite
```

Crie o arquivo do banco no PowerShell:

```powershell
New-Item database/database.sqlite -ItemType File
```

Execute migrations e seed:

```bash
php artisan migrate --seed
```

Gere os assets e inicie o Laravel:

```bash
npm run build
php artisan serve
```

Acesse `http://localhost:8000`.

## Banco de dados

A tabela `study_activities` possui título, descrição, disciplina, data de entrega, prioridade, status e datas de criação/atualização. A estrutura é criada por migration e os dados são acessados pelo Eloquent.

Para recriar o banco com dados fictícios:

```bash
php artisan migrate:fresh --seed
```

## Testes

```bash
php artisan test
```

Os testes verificam dashboard, listagem, filtros, cadastro, validação, edição, mudança de status e exclusão.

## Estrutura básica

```text
app/Models/StudyActivity.php
app/Http/Controllers/StudyActivityController.php
app/Http/Requests/StudyActivityRequest.php
database/migrations/
database/seeders/
resources/views/
resources/css/app.css
routes/web.php
tests/Feature/StudyActivityTest.php
```

## Decisões de desenvolvimento

### Por que Laravel

Laravel foi escolhido por oferecer uma estrutura organizada para rotas, controllers, models, migrations, validação e views Blade, facilitando a demonstração dos conceitos pedidos no trabalho.

### Uso do MVC

O model `StudyActivity` representa os dados e consultas, o controller coordena as requisições e as views Blade cuidam da apresentação. Assim, a regra de negócio não fica misturada ao HTML.

### Responsividade

A responsividade foi implementada com CSS próprio, usando grid, flexbox e media queries. A tabela possui rolagem horizontal em telas pequenas e os formulários se reorganizam para uma coluna no celular.

### HTML semântico

As páginas usam `header`, `nav`, `main`, `section`, `article`, `form`, `label`, `button` e `footer`. Todos os campos têm labels associadas, mensagens de erro próximas aos campos e textos auxiliares para leitores de tela.

### Armazenamento dos dados

Os dados são armazenados em SQLite, um banco local em arquivo que dispensa servidor separado e simplifica a apresentação. O acesso é feito pelo Eloquent ORM e a estrutura é controlada por migrations.
