<?php
    // Incluir la conexion a BD
    include('../conexion.php');
    $con = conectaDB();

    // Recuperar el ID de la URL
    $id = $_GET["idp"];

    // Consulta SQL
    $consulta = "DELETE FROM tb_productos WHERE idpro = $id";

    if (mysqli_query($con, $consulta)) {
        //echo "Registro eliminado correctamente.";

        // Regresamos al dashboard
        header("location: ../dashboard.php");
    } else {
        echo "Error al eliminar registro: " . mysqli_error($con);
    }

    // Cerrar conexion de BD
    mysqli_close($con);
?>