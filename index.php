<?php
/*
    Página Principal
*/
    include "fab_includes/fab_conexion.php";
    if (fab_connect()) {
        echo "<p style='color: beige;'><b>Base de datos conectada.</b></p>";
    } else {
        echo "<p style='color: red;'><b>Base de datos no conectada.</b></p>";
    }

    $fab_categoria_filtro = "";
    $fab_titulo_categoria = "Todos los Productos";
    if (isset($_GET['fab_categoria_id']) && is_numeric($_GET['fab_categoria_id'])) {
        $fab_id_cat = (int)$_GET['fab_categoria_id'];
        $fab_categoria_filtro = "WHERE p.id_categoria = $fab_id_cat";
    }

    // Obtener Categorías para el filtro
    $fab_sql_cats = "SELECT * FROM fab_categorias ORDER BY nombre_categoria";
    $fab_result_cats = mysqli_query($fab_connection, $fab_sql_cats);
    if (isset($fab_id_cat)) {
        mysqli_data_seek($fab_result_cats, 0);
        while($fab_cat_row = mysqli_fetch_assoc($fab_result_cats)) {
            if ($fab_cat_row['id_categoria'] == $fab_id_cat) {
                $fab_titulo_categoria = htmlspecialchars($fab_cat_row['nombre_categoria']);
                break;
            }
        }
    }

    // Obtener Productos
    $fab_sql_prods = "SELECT p.*, c.nombre_categoria
                    FROM fab_productos p
                    JOIN fab_categorias c ON p.id_categoria = c.id_categoria
                    $fab_categoria_filtro
                    ORDER BY c.nombre_categoria, p.nombre_producto";
    $fab_result_prods = mysqli_query($fab_connection, $fab_sql_prods);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FoodExpress</title>
    <link rel="stylesheet" href="fab_css/fab_estilos.css">
</head>
<body>

    <header class="fab-header">
        <a href="index.php" class="fab-logo">FoodExpress</a>
        <nav id="fab-main-nav" class="fab-nav">
            <ul class="fab-nav-list">
                <li><a href="index.php">Menú</a></li>
                <li><a href="fab_pages/fab_checkout.php">Ver Carrito</a></li>
                <li><a href="fab_pages/fab_admin.php">Admin</a></li>
            </ul>
        </nav>
        <div class="fab-cart-icon">
            <a href="fab_pages/fab_checkout.php">
                <span id="fab-cart-count">Carrito: 0</span>
            </a>
        </div>
    </header>

    <main>
        <h1><?php echo $fab_titulo_categoria; ?></h1>

        <nav class="fab-filters">
            <a href="index.php">Todos</a>
            <?php
                if ($fab_result_cats && mysqli_num_rows($fab_result_cats) > 0) {
                    mysqli_data_seek($fab_result_cats, 0);
                    while ($fab_cat = mysqli_fetch_assoc($fab_result_cats)) {
                        $fab_cat_id = $fab_cat['id_categoria'];
                        $fab_cat_nombre = htmlspecialchars($fab_cat['nombre_categoria']);
                        echo " | <a href='index.php?fab_categoria_id=$fab_cat_id'>$fab_cat_nombre</a>";
                    }
                }
            ?>
        </nav>

        <section class="fab-menu-grid">
            <?php
                if ($fab_result_prods && mysqli_num_rows($fab_result_prods) > 0) {
                    while ($fab_prod = mysqli_fetch_assoc($fab_result_prods)) {
                        echo "<article class='fab-product-card'>";
                        echo "<img src='" . htmlspecialchars($fab_prod['imagen_url']) . "' alt='" . htmlspecialchars($fab_prod['nombre_producto']) . "'>";
                        echo "<div class='fab-product-card-body'>";
                        echo "<h3>" . htmlspecialchars($fab_prod['nombre_producto']) . "</h3>";
                        echo "<p>" . htmlspecialchars($fab_prod['descripcion']) . "</p>";
                        echo "<strong>$" . number_format($fab_prod['precio'], 2) . "</strong>";
                        echo "</div>";
                        echo "<button class='fab-add-to-cart'
                                data-id='" . $fab_prod['id_producto'] . "'
                                data-name='" . htmlspecialchars($fab_prod['nombre_producto']) . "'
                                data-price='" . $fab_prod['precio'] . "'>
                                Agregar al Carrito
                            </button>";
                        echo "</article>";
                    }
                } else {
                    echo "<p>No hay productos disponibles en esta categoría.</p>";
                }
            ?>
        </section>
    </main>

    <script src="fab_js/fab_script.js"></script>
</body>
</html>
<?php
    fab_disconnect();
?>