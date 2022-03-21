<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>CRUD PHP</title>
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
</head>

<body>

	<div class="container">
		<h1 class="page-header text-center">Lista de Empleados</h1>
		<div class="row">
			<div class="col-sm-8 col-sm-offset-2">
				<a href="#addnew" class="btn btn-primary" data-toggle="modal"><span class="glyphicon glyphicon-plus"></span> Crear</a>
				<?php
				//mensaje de alerta por si surge algun error
				session_start();
				if (isset($_SESSION['message'])) {
				?>
					<div class="alert alert-info text-center" style="margin-top:20px;">
						<?php echo $_SESSION['message']; ?>
					</div>
				<?php

					unset($_SESSION['message']);
				}
				?>
				<table class="table table-bordered table-striped" style="margin-top:20px;">
					<thead>
						<th>Nombre</th>
						<th>Email</th>
						<th>Sexo</th>
						<th>Area</th>
						<th>Boletin</th>
						<th>Estado</th>

					</thead>
					<tbody>


						<?php
						//incluimos el fichero de conexion
						include_once('dbconect.php');

						$database = new Connection();
						$db = $database->open();
						//realizamos la consulta a la base de datos utilizamos un CASE para agregar un condicion si el campo es 'M' muestra mujer de lo contrario muestra Hombre, introducimos un Inner para buscar coincidencias
						try {
							$sql = 'SELECT empleado.id,empleado.nombre, email, sexo, areas.Nombre, boletin, descripcion, CASE WHEN Sexo = "F" THEN "Mujer" ELSE "Hombre"  END AS sexo,  CASE WHEN Boletin = 1 THEN "si" ELSE "no"  END AS boletin FROM empleado INNER JOIN areas ON empleado.area_id = areas.id 
				';


							foreach ($db->query($sql) as $row) {
						?>
								<tr>
									<td><?php echo $row['nombre']; ?></td>
									<td><?php echo $row['email']; ?></td>
									<td><?php echo $row['sexo']; ?></td>
									<td><?php echo $row['Nombre']; ?></td>
									<td><?php echo $row['boletin']; ?></td>





									<td>
										<a href="#edit_<?php echo $row['id']; ?>" class="btn btn-success btn-sm" data-toggle="modal"><span class="glyphicon glyphicon-edit"></span> Editar</a>
										<a href="#delete_<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" data-toggle="modal"><span class="glyphicon glyphicon-trash"></span> Borrar</a>
									</td>

									<?php include('BorrarEditarModal.php'); ?>
								</tr>
						<?php
							}
						} catch (PDOException $e) {
							echo "Hubo un problema en la conexión: " . $e->getMessage();
						}

						//Cerrar la Conexion
						$database->close();

						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<?php include('AgregarModal.php'); ?>
	<script src="js/jquery.min.js"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>
</body>

</html>