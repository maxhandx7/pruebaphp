<!-- Ventana Editar Registros CRUD -->
<div class="modal fade" id="edit_<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<center>
					<h4 class="modal-title" id="myModalLabel">Editar Empleado</h4>
				</center>
			</div>
			<div class="modal-body">
				<div class="container-fluid">
					<form method="POST" action="EditarRegistro.php?id=<?php echo $row['id']; ?>">
						<div class="row form-group">
							<div class="col-sm-2">
								<label class="control-label" style="position:relative; top:7px;">Nombre Completo:</label>
							</div>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="txtnom" value="<?php echo $row['nombre']; ?>">
							</div>
						</div>
						<div class="row form-group">
							<div class="col-sm-2">
								<label class="control-label" style="position:relative; top:7px;">Correo:</label>
							</div>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="txtmail" value="<?php echo $row['email']; ?>">
							</div>
						</div>
						<div class="row form-group">
							<div class="col-sm-2">
								<label class="control-label" style="position:relative; top:7px;">Sexo:</label>
							</div>
							<div class="col-sm-10">
								<input type="radio" name="sex" value="M">Masculino <br>
								<input type="radio" name="sex" value="F">Femenino



							</div>
						</div>
						<div class="row form-group">
							<div class="col-sm-2">
								<label class="control-label" style="position:relative; top:7px;">Area:</label>
							</div>
							<div class="col-sm-10">
								<select class="form-select" name="Area">
									<option value="0"></option>
									<?php

									include_once('dbconect.php');

									$database = new Connection();
									$db = $database->open();
									try {
										$sql = 'SELECT * FROM areas';
										foreach ($db->query($sql) as $low) {

											// En esta sección estamos llenando el select con datos extraidos de una base de datos.
											echo '<option value="' . $low['id'] . '">' . $low['Nombre'] . '</option>';
										}

									?>
									<?php
									} catch (PDOException $e) {
										echo "Hubo un problema en la conexión: " . $e->getMessage();
									}
									//Cerrar la Conexion
									$database->close();



									?>

								</select>
							</div>
						</div>
						<div class="row form-group">
							<div class="col-sm-2">
								<label class="control-label" style="position:relative; top:7px;">Descripcion: </label>
							</div>
							<div class="col-sm-10">
								<textarea class="form-control" name="Descripcion"><?php echo $row['descripcion']; ?> </textarea>
							</div>
						</div>
						<div class="row form-group">
							<div class="col-sm-2">
								<label class="control-label" style="position:relative; top:7px;"></label>
							</div>
							<div class="col-sm-10">
								<input type="checkbox" name="chkboletin" value="1" checked="checked" id="chkboletin"> Deseo recibir boletin informativo
							</div>
						</div>

						<div class="row form-group">
							<div class="col-sm-2">
								<label class="control-label" style="position:relative; top:7px;">Roles:</label>
							</div>
							<div class="col-sm-10">
								<input type="checkbox" onclick="uncheck1()" name="chkrol" id="ch4" value="5">Profesional de Proyectos- Desarrollador <br>
								<input type="checkbox" onclick="uncheck1()" name="chkrol" id="ch5" value="8">Gerente estrategico <br>
								<input type="checkbox" onclick="uncheck1()" name="chkrol" id="ch6" value="7">Auxiliar administrativo
							</div>
						</div>
				</div>
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<center>
		<button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
		<button type="submit" name="editar" class="btn btn-success"><span class="glyphicon glyphicon-check"></span> Actualizar Ahora</a>
			</form></center>
	</div>

</div>
</div>
</div>

<!-- Borrar -->
<div class="modal fade" id="delete_<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<center>
					<h4 class="modal-title" id="myModalLabel">Borrar Empleado</h4>
				</center>
			</div>
			<div class="modal-body">
				<p class="text-center">¿Esta seguro de Borrarlo?</p>
				<h2 class="text-center"><?php echo $row['nombre'] . '<br>' . $row['email']; ?></h2>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancelar</button>
				<a href="BorrarRegistro.php?id=<?php echo $row['id']; ?>" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Si</a>
			</div>

		</div>
	</div>
</div>

<script src="js/jquery.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
<!--script para la validar datos en el cliente-->
<script src="js/val.js"></script>
<script>
	//script para agregar el boletin si y no y para seleccionar rol
	$('#chkboletin').on('change', function() {
		this.value = this.checked ? 1 : 0;

	}).change();

	function uncheck1() {
		var checkbox4 = document.getElementById("ch4");
		var checkbox5 = document.getElementById("ch5");
		var checkbox6 = document.getElementById("ch6");
		checkbox4.onclick = function() {
			if (checkbox4.checked != false) {
				checkbox5.checked = null;
				checkbox6.checked = null;
			}
		}
		checkbox5.onclick = function() {
			if (checkbox5.checked != false) {
				checkbox4.checked = null
				checkbox6.checked = null;
			}
		}
		checkbox6.onclick = function() {
			if (checkbox6.checked != false) {
				checkbox4.checked = null
				checkbox5.checked = null;
			}
		}
	}
</script>