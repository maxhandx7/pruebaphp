<?php
session_start();
include_once('dbconect.php');
$database = new Connection();
$db = $database->open();

//valkidar si el usuario existe en la base de datos

if (isset($_REQUEST['txtmail']) && !empty($_REQUEST['txtmail']) && isset($_REQUEST['txtnom']) && !empty($_REQUEST['txtnom'])) {

	$email = trim($_REQUEST['txtmail']);
	$email = strip_tags($email);
	$nombre = trim($_REQUEST['txtnom']);
	$nombre = strip_tags($nombre);

	// Consulta para verificar la existencia del nombre y correo

	$query = "SELECT nombre, email FROM empleado WHERE email=:email || nombre =:nombre";
	$stmt = $db->prepare($query);
	$stmt->execute(array(':email' => $email, ':nombre' => $nombre));

	if ($stmt->rowCount() == 1) {

		//Si el correo electrónico ya existe muestra mensaje

		$_SESSION['message'] = 'Ya Hay un registro con el mismo nombre o correo';
		$database->close();
	} else {

		if (isset($_POST['agregar'])) {






			try {

				//hacer uso de una declaración preparada para prevenir la inyección de sql

				$stmt = $db->prepare("INSERT INTO empleado (nombre, email, sexo, area_id, boletin,descripcion) VALUES (:Nombre, :Email, :Sexo, :Area_id, :Boletin, :Descripcion)");

				//instrucción if-else en la ejecución de nuestra declaración preparada

				$_SESSION['message'] = ($stmt->execute(array(':Nombre' => $_POST['txtnom'], ':Email' => $_POST['txtmail'], ':Sexo' => $_POST['sex'], ':Area_id' => $_POST['Area'], ':Boletin' => $_POST['chkboletin'], ':Descripcion' => $_POST['txtarea'],))) ? 'Empleado guardado correctamente' : 'Algo salió mal. No se puede agregar miembro';

				//tomar el ultimo id para registrar usuario en un rol

				$id = $db->lastInsertId();
				$chkrol1 = $_POST['chkrol'];
				$stmt1 = $db->prepare("INSERT INTO  empleado_rol (empleado_id, rol_id) VALUES (:Id,:Chkrol)");
				$stmt1->bindParam(":Id", $id);
				$stmt1->bindParam(":Chkrol", $chkrol1);
				$stmt1->execute();

			} catch (PDOException $e) {
				$_SESSION['message'] = $e->getMessage();
			}



			//cerrar la conexion
			$database->close();
		} else {
			$_SESSION['message'] = 'Llene el formulario';
		}
	}
}


header('location: index.php');
