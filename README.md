# Role-Based Access Control (RBAC) com Laravel e Spatie

O Role-Based Access Control (RBAC) é um modelo de controle de acesso baseado em funções que ajuda a gerenciar as permissões de acesso dos usuários em um sistema. Ele permite que você defina funções ou papéis para os usuários e atribua permissões a esses papéis, facilitando o controle granular do acesso aos recursos do sistema.

Este projeto é um exemplo de como implementar o RBAC usando Laravel, um framework PHP popular, juntamente com a biblioteca Spatie Laravel Permission para facilitar a implementação do RBAC.

## Configuração

1. Clone este repositório para sua máquina local.
2. Execute o comando `composer install` para instalar as dependências do Laravel e do Spatie Laravel Permission.
3. Crie um banco de dados MySQL e configure as credenciais de acesso no arquivo `.env`.
4. Execute o comando `php artisan migrate` para executar as migrações do banco de dados.
5. Execute o comando `php artisan db:seed` para popular o banco de dados com dados de exemplo.

## Funcionalidades

- Autenticação de usuário: O projeto já possui um sistema básico de autenticação implementado com Laravel.
- Gerenciamento de papéis e permissões: Você pode criar, editar e excluir papéis e permissões no sistema.
- Atribuição de papéis aos usuários: Os usuários podem ser atribuídos a um ou mais papéis para definir suas permissões.
- Middleware de autorização: O projeto inclui um middleware que pode ser aplicado a rotas para verificar se o usuário possui as permissões necessárias para acessá-las.

## Uso

- Faça login como administrador usando as credenciais de administrador fornecidas (geralmente, um usuário com o papel "admin" é criado durante a execução das sementes).
- Acesse a página de gerenciamento de papéis e permissões no painel administrativo.
- Crie os papéis necessários para o seu sistema e atribua as permissões correspondentes a cada papel.
- Atribua os papéis aos usuários conforme necessário.
- Utilize o middleware de autorização para proteger as rotas que requerem permissões específicas.

