DROP DATABASE IF EXISTS fab_parcial_plp3;
CREATE DATABASE fab_parcial_plp3;
USE fab_parcial_plp3;

-- Tabla para Categorías
CREATE TABLE fab_categorias (
    id_categoria INT AUTO_INCREMENT PRIMARY KEY,
    nombre_categoria VARCHAR(100) NOT NULL
);

-- Tabla para Productos
CREATE TABLE fab_productos (
    id_producto INT AUTO_INCREMENT PRIMARY KEY,
    nombre_producto VARCHAR(150) NOT NULL,
    descripcion TEXT,
    precio DECIMAL(10, 2) NOT NULL,
    imagen_url VARCHAR(255) DEFAULT 'fab_assets/images/default.jpg',
    id_categoria INT,
    CONSTRAINT fk_prod_categoria FOREIGN KEY (id_categoria) REFERENCES fab_categorias(id_categoria)
);

-- Tabla para Pedidos
CREATE TABLE fab_pedidos (
    id_pedido INT AUTO_INCREMENT PRIMARY KEY,
    nombre_cliente VARCHAR(200) NOT NULL,
    direccion_entrega TEXT NOT NULL,
    telefono_cliente VARCHAR(50),
    total_pedido DECIMAL(10, 2) NOT NULL,
    fecha_pedido TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabla de relación entre Pedidos y Productos)
CREATE TABLE fab_pedidos_items (
    id_item INT AUTO_INCREMENT PRIMARY KEY,
    id_pedido INT NOT NULL,
    id_producto INT NOT NULL,
    cantidad INT NOT NULL,
    precio_unitario DECIMAL(10, 2) NOT NULL,
    CONSTRAINT fk_item_pedido FOREIGN KEY (id_pedido) REFERENCES fab_pedidos(id_pedido),
    CONSTRAINT fk_item_producto FOREIGN KEY (id_producto) REFERENCES fab_productos(id_producto)
);