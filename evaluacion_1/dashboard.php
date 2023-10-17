<?php
	session_start();
	if (!isset($_SESSION['login']))
		header("location: index.php");	
?>

<html>
	<head>
		<title>Sistema de Pruebas UNACH</title>
		<!-- Bootstrap core CSS -->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootswatch@4.5.2/dist/cerulean/bootstrap.min.css">
		<link href="css/cmce-styles.css" rel="stylesheet">
		<!-- Bootstrap core JavaScript -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>    
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
	</head>

	<body>
		<nav class="navbar navbar-dark bg-dark">
			<div class="container-fluid">
				<a class="navbar-brand"><b>Nombre de usuario:</b> <?php echo $_SESSION['nomusuario']; ?></a> 
				<a href="cerrar.php"><button class="btn btn-warning">Cerrar Sesión</button></a>
			</div>
		</nav>

		<center>
			<br>
			<br>
			<br>
			<br>	

			<form action="dashboard.php" method="GET">
				<div class="formpanel" id="f1">
					<b>Buscar producto por precio mayor a:</b> <input type="text" name="pre" size="4">
					<button class="btn btn-primary" type="submit">Buscar</button>
				</div>
			</form>
			
			<br>
			<br>
			<hr>
			<br>
			<br>

			<button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
				Nuevo Producto
			</button>

			<br>
			<br>

			<?php

				include('conexion.php');
				$con = conectaDB();
				if(isset($_GET['pre'])==true)		
					$sql ="select idPro,Nombre,Precio from tb_productos where Precio > ".$_GET['pre'];
				else
					$sql ="select idPro,Nombre,Precio from tb_productos";
					
				echo "<table class='table' style='width:570;'>";
				echo "<thead class='table-dark'>";
				echo "<th>Nombre</th>";
				echo "<th>Precio</th>";
				echo "<th></th>";
				echo "</thead>";
				echo "<tbody>";
				
				$resultado = mysqli_query($con,$sql);  
				while($fila = mysqli_fetch_row($resultado)){
				
					echo "<tr>";
						echo "<td>".$fila[1]."</td>";
						echo "<td>".$fila[2]."</td>";

						// Ponemos la ruta donde se encuentra el archivo eliminar, dentro de la carpeta "controller"
						echo "<td><a href='controller/eliminar.php?idp=".$fila[0]."' onclick='return confirmarEliminacion()'><img src='iconoeliminar.png' width='20' heigth='20'></a></td>";
					echo "</tr>";
				
				}
				
				echo "</tbody> </table>";
			?>

			<br>
			<br>
			<!-- Modal Ventada de Nuevo Producto -->
			<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Registrar nuevo producto</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">
							...Diseñar formulario de producto

							<!-- Diseñamos el formulario para registro
								añadimos el archivo donde se hara el proceso de registro -->
							<form action="controller/insertar.php" method="post">
								<div class="row mb-3">
									<label class="col-sm-5 col-form-label">Nombre de producto</label>
									<div class="col-sm-7">
										<input type="text" class="form-control" id="nombre" name="nombre" required>
									</div>
								</div>

								<div class="row mb-3">
									<label class="col-sm-5 col-form-label">Precio</label>
									<div class="col-sm-7">
										<input type="text" class="form-control" id="precio" name="precio" required>
									</div>
								</div>

								<div class="row mb-3">
									<label class="col-sm-5 col-form-label">Cantidad existente</label>
									<div class="col-sm-7">
										<input type="text" class="form-control" id="ext" name="ext" required>
									</div>
								</div>

								<div class="modal-footer">
									<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
									<button type="submit" class="btn btn-success" onclick="return confirmarRegistro()">Guardar </button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>

		</center>

		<!-- Footer -->
		<footer class="footer bg-dark">
			<div class="container">
				<p class="m-0 text-center text-white" ><b> UC: Desarrollo de aplicaciones web y móviles   [ Dr. Christian Mauricio Castillo Estrada ] </b></p>
			</div>
		</footer>

		<!-- SCRIPT PARA AVISOS DE INSERTAR Y ELIMINAR -->
		<script>
			function confirmarEliminacion(){

				return confirm('¿Estas seguro que desea eliminar este dato?');
			}

			function confirmarRegistro(){
				
				alert("Registro insertado correctamente");
			}
		</script>
	</body>
</html>