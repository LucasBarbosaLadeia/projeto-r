-- DER e esquema SQL
-- Tabelas: products, customers, orders, order_products (N:N)

CREATE DATABASE IF NOT EXISTS appdb;
USE appdb;

-- produtos
CREATE TABLE IF NOT EXISTS products (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(150) NOT NULL,
  price DECIMAL(10,2) NOT NULL CHECK (price >= 0)
);

-- clientes
CREATE TABLE IF NOT EXISTS customers (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(150) NOT NULL,
  email VARCHAR(150)
);

-- pedidos
CREATE TABLE IF NOT EXISTS orders (
  id INT AUTO_INCREMENT PRIMARY KEY,
  customer_id INT NOT NULL,
  order_date DATETIME DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (customer_id) REFERENCES customers(id) ON DELETE CASCADE
);

-- relacionamento N:N entre orders e products
CREATE TABLE IF NOT EXISTS order_products (
  order_id INT NOT NULL,
  product_id INT NOT NULL,
  quantity INT NOT NULL DEFAULT 1 CHECK (quantity > 0),
  PRIMARY KEY (order_id, product_id),
  FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE,
  FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
);

-- dados de exemplo
INSERT INTO products (name, price) VALUES
('Caneta', 2.50),
('Caderno', 15.00),
('Mochila', 120.00),
('Calculadora', 85.00);

INSERT INTO customers (name, email) VALUES
('João Silva', 'joao@example.com'),
('Maria Souza', 'maria@example.com');

INSERT INTO orders (customer_id) VALUES (1), (2);
INSERT INTO order_products (order_id, product_id, quantity) VALUES
(1,1,3), (1,2,1), (2,4,2);
