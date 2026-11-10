CREATE TABLE IF NOT EXISTS products(
id SERIAL PRIMARY KEY,
product_name VARCHAR(50) NOT NULL,
description TEXT,
price NUMERIC(10,2) NOT NULL CHECK (price >= 0),
stock INT NOT NULL DEFAULT 0 CHECK (stock >= 0),
category VARCHAR(50) NOT NULL,
image_patch  VARCHAR(255),
created_at TIMESTAMPTZ NOT NULL DEFAULT NOW()
);

CREATE INDEX IF NOT EXISTS idx_products_category ON products (category);

CREATE TABLE IF NOT EXISTS orders (
id SERIAL PRIMARY KEY,
firstname VARCHAR(50) NOT NULL,
lastname VARCHAR(70) NOT NULL,
customer_email VARCHAR(255) NOT NULL,
subtotal NUMERIC(10,2) NOT NULL CHECK (subtotal >= 0),
tax NUMERIC(10,2) NOT NULL CHECK (tax>=0),
total NUMERIC(10,2) NOT NULL CHECK (total >= 0),
status VARCHAR(20) NOT NULL DEFAULT 'pending'
CHECK (status IN ('pending', 'shipped','completed','cancelled')),
created_at TIMESTAMPTZ NOT NULL DEFAULT NOW()
);

CREATE TABLE IF NOT EXISTS order_items(
id SERIAL PRIMARY KEY,
order_id INT NOT NULL REFERENCES orders (id) ON DELETE CASCADE,
product_id INT REFERENCES products (id) ON DELETE SET NULL,
product_name VARCHAR(150) NOT NULL,
quantity INT NOT NULL CHECK (quantity > 0),
unit_price NUMERIC(10,2) NOT NULL CHECK  (unit_price > 0)
);

CREATE INDEX IF NOT EXISTS idx_order_items_order ON order_items (order_id);

CREATE TABLE IF NOT EXISTS admins(
id SERIAL PRIMARY KEY,
email VARCHAR(255) NOT NULL UNIQUE,
password_hash VARCHAR(255) NOT NULL,
created_at TIMESTAMPTZ NOT NULL DEFAULT NOW()
);