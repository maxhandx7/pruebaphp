<?php
	session_start();
	include_once('dbconect.php');
	//Obtenemos los datos con el 'id' para eliminar
	if(isset($_GET['id'])){
		$database = new Connection();
		$db = $database->open();
		try{
			$sql = "DELETE FROM empleado WHERE id = '".$_GET['id']."'";
			//menasaje de error
			$_SESSION['message'] = ( $db->exec($sql) ) ? 'Empleado Borrado' : 'Hubo un error al borrar empleado';
		}
		catch(PDOException $e){
			$_SESSION['message'] = $e->getMessage();
		}

		//Cerrar conexión
		$database->close();

	}
	else{
		$_SESSION['message'] = 'Seleccionar empleado para eliminar primero';
	}

	header('location: index.php');
