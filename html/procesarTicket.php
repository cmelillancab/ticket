

  <?php

	if (isset($_FILES['uploadedFile']) && $_FILES['uploadedFile']['error'] === UPLOAD_ERR_OK) {

		$target_dir = dirname(dirname(__FILE__))."\\uploads\\";
		$target_file = $target_dir . basename($_FILES["uploadedFile"]["name"]);
		$uploadOk = 1;
		$fileType = $_FILES["uploadedFile"]["type"] == "text/csv";
		
		$log = "";

		// Check if file already exists
		if (file_exists($target_file)) {
		  $log .= "El archivo con este nombre ya fue procesado.<br />";
		  $uploadOk = 0;
		}

		// Check if $uploadOk is set to 0 by an error
		if ($fileType && $uploadOk) {
			if (move_uploaded_file($_FILES["uploadedFile"]["tmp_name"], $target_file)) {
				
				$log .= "El archivo ". htmlspecialchars( basename( $_FILES["uploadedFile"]["name"])). " se ha subido correctamente!<br />";
				
				require_once ("../conexion.php");//Contiene funcion que conecta a la base de datos
				
				
				$fp = fopen ($target_file,"r");
				$contador = 0;
				$procesados = 0;
				$actualizados = 0;

				while ($data = fgetcsv ($fp, 1000, ",")) {
					if($contador > 0) {
						$num = count ($data);
						if(is_null(existeTicket($con, $data[0]))) {
							$d = agregarTicket($con, $data);
							$procesados++;
						} else {
							actualizarRegistro($con, $data);
							$actualizados++;
					//	echo $data[0].' -> '.$data[1]."<br />";
						}
					}
					
					$contador++;
				}
				$log .= "Total registros en el archivo: $contador<br />";
				$log .= "Registros procesados: $procesados<br />";
				$log .= "Registros actualizados: $actualizados<br />";
				$log .= "Eliminando archivo temporal ....<br />";
				unlink($target_file);

			} else {
				$log .= "Error. Algo ha fallado al subir el archivo.<br />";
			}
		} 
  ?>

			<div class="alert alert-info" role="alert">
					<strong>Info</strong><br />
					<span><?php echo $log; ?></span>
					<hr />
					<a href="../" class="btn btn-success">Regresar</a>
			</div>	
  <?php
		 } 

  ?>
  



<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Ticket</title>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="css/custom.css">
</head>
<body>

    <div class="container">
        <div class="table-wrapper">
		  <?php if (!isset($_FILES['uploadedFile'])): ?>
				<form method="POST" action="procesarTicket.php" enctype="multipart/form-data" style="width: 30em;">
					<div class="modal-header">						
						<h4 class="modal-title">Procesar nuevo lote de ticket</h4>
					</div>
					<div class="modal-body">					
						<div class="form-group">
							<label>Archivo</label>
							<input type="file" name="uploadedFile" />							
						</div>						
					</div>
					<div class="modal-footer">
						<a href="../" class="btn btn-success">Cancelar</a>						
						<input type="submit" class="btn btn-success" name="uploadBtn" value="Subir archivo" />
					</div>
				</form>				
		  <?php endif; ?>
		  
        </div>
    </div>

	<script src="js/script.js"></script>
</body>
</html>

<?php
/*
	if (empty($_POST['delete_id'])){
		$errors[] = "Id vacío.";
	} elseif (!empty($_POST['delete_id'])){
	require_once ("../conexion.php");//Contiene funcion que conecta a la base de datos
	// escaping, additionally removing everything that could be (html/javascript-) code
    $id_producto=intval($_POST['delete_id']);
	

	// DELETE FROM  database
    $sql = "DELETE FROM  tblprod WHERE id='$id_producto'";
    $query = mysqli_query($con,$sql);
    // if product has been added successfully
    if ($query) {
        $messages[] = "El producto ha sido eliminado con éxito.";
    } else {
        $errors[] = "Lo sentimos, la eliminación falló. Por favor, regrese y vuelva a intentarlo.";
    }
		
	} else 
	{
		$errors[] = "desconocido.";
	}
if (isset($errors)){
			
			?>
			<div class="alert alert-danger" role="alert">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong>Error!</strong> 
					<?php
						foreach ($errors as $error) {
								echo $error;
							}
						?>
			</div>
			<?php
			}
			if (isset($messages)){
				
				?>
				<div class="alert alert-success" role="alert">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<strong>¡Bien hecho!</strong>
						<?php
							foreach ($messages as $message) {
									echo $message;
								}
							?>
				</div>
				<?php
			}
*/


// *********************************************************************
/*
array(20) {
  [0]=>
  string(22) "﻿"Número de Ticket""
  [1]=>
  string(5) "Fecha"
  [2]=>
  string(6) "Asunto"
  [3]=>
  string(2) "De"
  [4]=>
  string(22) "De correo electrónico"
  [5]=>
  string(9) "Prioridad"
  [6]=>
  string(12) "Departamento"
  [7]=>
  string(14) "Temas de ayuda"
  [8]=>
  string(6) "Fuente"
  [9]=>
  string(13) "Estado actual"
  [10]=>
  string(22) "Última actualización"
  [11]=>
  string(20) "Fecha de Vencimiento"
  [12]=>
  string(7) "Vencido"
  [13]=>
  string(10) "Respondió"
  [14]=>
  string(10) "Asignado a"
  [15]=>
  string(15) "Agente asignado"
  [16]=>
  string(15) "Equipo asignado"
  [17]=>
  string(9) "Ubicacion"
  [18]=>
  string(19) "Interno de contacto"
  [19]=>
  string(14) "Datos Adjuntos"
}
array(20) {
  [0]=>
  string(6) "689729"
  [1]=>
  string(19) "2023-05-22 11:07:37"
  [2]=>
  string(41) "Consulta por entrada de agua en el techo."
  [3]=>
  string(15) "Claudia Chludil"
  [4]=>
  string(31) "claudia.chludil@cab.cnea.gov.ar"
  [5]=>
  string(6) "Normal"
  [6]=>
  string(15) "Intendencia CAB"
  [7]=>
  string(15) "INTENDENCIA CAB"
  [8]=>
  string(3) "Web"
  [9]=>
  string(7) "Cerrado"
  [10]=>
  string(19) "2023-05-29 10:35:26"
  [11]=>
  string(0) ""
  [12]=>
  string(1) "0"
  [13]=>
  string(1) "1"
  [14]=>
  string(16) "Colinier Jonatan"
  [15]=>
  string(16) "Jonatan Colinier"
  [16]=>
  string(0) ""
  [17]=>
  string(15) "PAB 8. - GCCAB-"
  [18]=>
  string(4) "5135"
  [19]=>
  string(0) ""
}
*/
// *********************************************************************
?>