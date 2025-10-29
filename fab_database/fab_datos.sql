USE fab_parcial_plp3;

INSERT INTO fab_categorias (id_categoria, nombre_categoria) VALUES
(1, 'Pizzas'),
(2, 'Hamburguesas'),
(3, 'Bebidas');

INSERT INTO fab_productos (id_producto, nombre_producto, descripcion, precio, id_categoria) VALUES
(1, 'Pizza Muzzarella', 'Salsa de tomate, muzzarella y aceitunas.', 5000.00, 1),
(2, 'Pizza Napolitana', 'Muzzarella, rodajas de tomate fresco, ajo y perejil.', 5500.00, 1),
(3, 'Pizza Pepperoni', 'Muzzarella y pepperoni picante.', 6000.00, 1),
(4, 'Hamburguesa Clásica', 'Carne 150g, lechuga, tomate, queso cheddar.', 4500.00, 2),
(5, 'Hamburguesa Doble', 'Doble carne 150g, doble cheddar, bacon.', 5500.00, 2),
(6, 'Hamburguesa Veggie', 'Medallón de lentejas, lechuga, tomate, mayonesa de zanahoria.', 4800.00, 2),
(7, 'Papas Fritas', 'Porción de papas fritas clásicas.', 2500.00, 2),
(8, 'Agua Mineral', 'Botella 500ml sin gas.', 1500.00, 3),
(9, 'Gaseosa Cola', 'Lata 350ml.', 1800.00, 3),
(10, 'Cerveza Artesanal', 'Pinta de IPA.', 2500.00, 3);