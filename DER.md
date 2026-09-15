# Diagrama de Entidade-Relacionamento (DER)

## Estrutura do Banco de Dados

```
┌─────────────────┐
│   PRODUCTS      │
├─────────────────┤
│ id (PK)         │
│ name            │
│ price           │
└────────┬────────┘
         │
         │ (1:N)
         │
    ┌────▼──────────────┐
    │  ORDER_PRODUCTS   │
    ├───────────────────┤
    │ order_id (FK, PK) │
    │ product_id(FK, PK)│  ◄── Relacionamento N:N
    │ quantity          │
    └────┬──────────────┘
         │
         │ (1:N)
         │
    ┌────▼────────────────┐
    │      ORDERS         │
    ├─────────────────────┤
    │ id (PK)             │
    │ customer_id (FK)    │
    │ order_date          │
    └────┬────────────────┘
         │
         │ (1:N)
         │
┌────────▼──────────┐
│    CUSTOMERS      │
├───────────────────┤
│ id (PK)           │
│ name              │
│ email             │
└───────────────────┘
```

## Relacionamentos

- **PRODUCTS** → **ORDER_PRODUCTS**: Um produto pode estar em múltiplos pedidos (1:N)
- **CUSTOMERS** → **ORDERS**: Um cliente pode fazer múltiplos pedidos (1:N)
- **ORDERS** ↔ **PRODUCTS**: Através de **ORDER_PRODUCTS** (N:N)

## Restrições

- Chaves primárias em todas as tabelas
- Foreign keys com ON DELETE CASCADE
- Validações: price ≥ 0, quantity > 0
- Charset UTF-8mb4
