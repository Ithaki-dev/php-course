CREATE DATABASE IF NOT EXISTS practica5_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE practica5_db;

CREATE TABLE ventas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fecha DATE NOT NULL,
    cantidad_elementos INT NOT NULL,
    monto_total_venta DECIMAL(10,2) NOT NULL,
    es_gravado TINYINT(1) NOT NULL DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Datos de ejemplo
INSERT INTO ventas (fecha, cantidad_elementos, monto_total_venta, es_gravado) VALUES
('2024-01-15', 5, 50000.00, 1),   -- Producto gravado
('2024-01-16', 3, 30000.00, 0),   -- Producto NO gravado (exento)
('2024-01-17', 10, 125000.00, 1), -- Producto gravado
('2024-01-18', 2, 15000.00, 1),   -- Producto gravado
('2024-01-19', 7, 45000.00, 0),   -- Producto NO gravado
('2024-01-20', 4, 60000.00, 1),   -- Producto gravado
('2024-01-21', 8, 80000.00, 1),   -- Producto gravado
('2024-01-22', 6, 35000.00, 0);   -- Producto NO gravado