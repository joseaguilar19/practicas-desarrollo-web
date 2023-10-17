<?php
    // Incluir la conexion a BD
    include('../conexion.php');
    $con = conectaDB();

    // Recuperar los campos del formulario
    $nombre = $_POST["nombre"];
    $precio = $_POST["precio"];
    $ext = $_POST["ext"];

    // Consulta SQL
    $consulta = "INSERT INTO tb_productos (Nombre, Precio, Ext) VALUES ('$nombre', $precio, $ext)";

    if (mysqli_query($con, $consulta)) {
        //echo "Registro insertado correctamente.";

        //$resultado = "Registro insertado correctamente";

        header("location: ../dashboard.php");
    } else {
        //$resultado = "Error al insertar registro: " . mysqli_error($con);
        
        echo "Error al insertar registro: " . mysqli_error($con);
    }

    // Cerrar conexion de BD
    mysqli_close($con);
?>