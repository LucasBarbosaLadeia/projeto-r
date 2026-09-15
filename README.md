# Projeto Exemplo - Tech Forge

Projeto desenvolvido para demonstrar conceitos de banco de dados, arquitetura de redes e desenvolvimento web moderno com PHP, Docker e MySQL.

## 📁 Arquivos do Projeto

- [sql/schema.sql](sql/schema.sql) - Schema do banco de dados com 4 tabelas e relacionamento N:N
- [docker-compose.yml](docker-compose.yml) - Orquestração de containers (Web + DB)
- [public/index.php](public/index.php) - Interface principal com Bootstrap 5
- [public/config.php](public/config.php) - Configurações de conexão com BD
- [public/functions.php](public/functions.php) - Funções de lógica da aplicação
- [public/.htaccess](public/.htaccess) - Bloqueio de listagem de diretórios
- [DER.md](DER.md) - Diagrama de Entidade-Relacionamento

## 🚀 Instruções de Uso

### 1) Construir e subir containers

```bash
docker-compose up -d --build
```

### 2) Acessar a aplicação

A aplicação estará disponível em **http://localhost:8080/**

### 3) Configurar DNS Local (opcional)

Para acessar via `http://localapp.test/` em vez de `localhost`:

**Windows (como Administrador):**
1. Abra `C:\Windows\System32\drivers\etc\hosts`
2. Adicione a linha: `127.0.0.1  localapp.test`
3. Salve e acesse `http://localapp.test:8080/`

**Linux/Mac:**
```bash
echo "127.0.0.1  localapp.test" | sudo tee -a /etc/hosts
```

### 4) Segurança

- ✅ Listagem de diretórios bloqueada (.htaccess)
- ✅ IP fixo para banco de dados (172.20.0.10)
- ✅ Aplicação e BD em containers separados
- ✅ Conexão segura com charsets UTF-8mb4

## 📊 Estrutura do Banco de Dados

Veja o [Diagrama DER completo](DER.md)

**Tabelas:**
- `products` - Produtos (4 campos)
- `customers` - Clientes (3 campos)
- `orders` - Pedidos com FK para customers
- `order_products` - Relacionamento N:N entre orders e products

## 💻 Funcionalidades da Aplicação

- ✅ Exibição de produtos em tabela Bootstrap
- ✅ Filtro por preço mínimo
- ✅ Cálculo de desconto (10%)
- ✅ Validação de dados
- ✅ Busca em array
- ✅ Estrutura modular com funções

```
127.0.0.1 localapp.test
```

Observações relacionadas aos requisitos do trabalho:
- O banco foi configurado com IP fixo interno `172.20.0.10` (definido no `docker-compose.yml`).
- A aplicação roda na porta `8080` (mapeada no `docker-compose.yml`).
- `.htaccess` proíbe listagem de diretórios (`Options -Indexes`).
- O código PHP demonstra `if`, `while` (no fetch do banco), `foreach`, funções próprias com parâmetros/return, organização de dados em arrays, busca/filtragem e validação com `if/else`.
- O frontend usa Bootstrap via CDN (navbar, card, table — 3 componentes).

Próximos passos sugeridos:
- Ajustar credenciais/segurança para produção.
- Importar o schema e testar a interface.
