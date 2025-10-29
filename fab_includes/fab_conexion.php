<?php 
    function fab_connect() {
        global $fab_connection;
        // Editar la instancia de conexión con los valores de su motor de base de datos.
        try {
            $fab_connection = mysqli_connect("localhost", "root", "admin", "fab_parcial_plp3");
            $fab_connection -> set_charset("utf8");
            return True;
        } catch (Exception $e) {
            echo "<p style='color: orange; text-align: center;'>Ocurrió un error al conectarse a la base de datos: $e</p>";
            return False;
        }
    }

    function fab_disconnect() {
        global $fab_connection;
        mysqli_close($fab_connection);
    }
?>