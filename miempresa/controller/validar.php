<?php

	// if($_POST['loginUsername'] == "admin" && $_POST['loginPassword']=="unach"){
	// 	session_start();
	// 	$_SESSION['login'] = "true";
	// 	$_SESSION['nomusuario'] = $_POST['loginUsername'];
		
	// 	//header("location: menu.php");
	// 	echo json_encode(array('success' => 1));
	// }
	// else{
	// 	//header("location: index.php");	
	// 	echo json_encode(array('success' => 0));
	// }



	// include('../conexion.php');
	// $con = conectaDB();

	// $usuario = $_POST["loginUsername"];
	// $password = $_POST["loginPassword"];

	// // Consultar la base de datos
	// $sql = "SELECT * FROM tb_usuarios WHERE NomUser = '$usuario' AND Passwd = '$password'";

	// $result = mysqli_query($con, $sql);

	// if($result == 0){
	// 	session_start();
	// 	$_SESSION['login'] = "true";
	// 	$_SESSION['nomusuario'] = $_POST['loginUsername'];
		
	// 	//header("location: menu.php");
	// 	echo json_encode(array('success' => 1));
	// }
	// else{
	// 	//header("location: index.php");	
	// 	echo json_encode(array('success' => 0));
	// }



	// include('../conexion.php');
	// $con = conectaDB();

	// $usuario = $_POST["loginUsername"];
	// $password = $_POST["loginPassword"];

	// // Consultar la base de datos
	// $sql = "SELECT * FROM tb_usuarios WHERE NomUser = '$usuario' AND Passwd = '$password'";

	// $result = mysqli_query($con, $sql);

	// if($result == 0){
	// 	session_start();
	// 	$_SESSION['login'] = "true";
	// 	$_SESSION['nomusuario'] = $_POST['loginUsername'];
		
	// 	//header("location: menu.php");
	// 	echo json_encode(array('success' => 1));
	// }
	// else{
	// 	//header("location: index.php");	
	// 	echo json_encode(array('success' => 0));
	// }



	// if ($result->num_rows == 1) {
	// 	// Usuario encontrado
	// 	$row = $result->fetch_assoc();
	// 	$hashed_password = $row["Passwd"];

	// 	if (password_verify($password, $hashed_password)) {
	// 		// Inicio de sesión exitoso
	// 		session_start();
	// 		$_SESSION["login"] = "true";
	// 		$_SESSION["nomusuario"] = $usuario;
			
	// 		//header("location: menu.php");
	//  		echo json_encode(array('success' => 1));
	// 	} else {
	// 		// Contraseña incorrecta
	// 		//echo "Contraseña incorrecta";
			
	// 		//header("location: index.php");	
	// 		echo json_encode(array('success' => 0));
	// 	}
	// } else {
	// 	// Contraseña incorrecta
	// 	//echo "Contraseña incorrecta";
		
	// 	//header("location: index.php");	
	// 	echo json_encode(array('success' => 0));
	// }

	include('../conexion.php');
	$con = conectaDB();

	$usuario = $_POST["loginUsername"];
	$password = $_POST["loginPassword"];

	// Consultar la base de datos
	$consulta = "SELECT * FROM tb_usuarios WHERE NomUser = '$usuario' AND Passwd = '$password'";

	$result = mysqli_query($con, $consulta);

	if($result){

		if($user = mysqli_fetch_assoc($result)){
			session_start();
			$_SESSION['login'] = "true";
			$_SESSION['nomusuario'] = $_POST['loginUsername'];
			
			//header("location: menu.php");
			echo json_encode(array('success' => 1));
		} else{
			//header("location: index.php");	
			echo json_encode(array('success' => 0));	
		}
	}
	else{
		//header("location: index.php");	
		echo json_encode(array('success' => 0));
	}
?>
