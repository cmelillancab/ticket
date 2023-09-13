

  <?php

	if ($_SERVER["REQUEST_METHOD"] == "POST") {

		$rg = $_POST["daterange"];
		$ar = explode("-", $rg);

		$d = explode("/", $ar[0]);
		$h = explode("/", $ar[1]);

		$desde = trim($d[2])."-".trim($d[1])."-".trim($d[0]);
		$hasta = trim($h[2])."-".trim($h[1])."-".trim($h[0]);

		$estado = $_POST["estado"];
		$path = "rp-".$estado.date("Ymd");
//		$archivo = "C:\\Users\\Cecilio.Melillan\\Desktop\\$path.csv";
		$archivo = "D:\\Desktop\\$path.csv";
		$log = "";
		$contador = 0;

		// Check if $uploadOk is set to 0 by an error
			if ($estado) {				

				require_once ("../conexion.php");//Contiene funcion que conecta a la base de datos

				if($estado == "todos")
					$query = mysqli_query($con,"SELECT ticket, CONVERT(apertura, DATE) AS apertura, asunto, solicitante, estado, CONVERT(ultima_actualizacion, DATE) AS cierre, asignado, ubicacion, edificio, interno, comentarios FROM ticket.ticket WHERE apertura >= '".$desde." 00:00:00' AND apertura <= '".$hasta." 23:59:59'");
				else
					$query = mysqli_query($con,"SELECT ticket, CONVERT(apertura, DATE) AS apertura, asunto, solicitante, estado, CONVERT(ultima_actualizacion, DATE) AS cierre, asignado, ubicacion, edificio, interno, comentarios FROM ticket.ticket WHERE apertura >= '".$desde." 00:00:00' AND apertura <= '".$hasta." 23:59:59' AND estado = '".$estado."'");


				while($row = mysqli_fetch_assoc($query)){
					$str = "";	

					foreach($row as $key => $value) {
						if($contador == 0)
							$str .= $key.";";
						else
							$str .= empty($value) ? $value.";" : preg_replace("[;]", "-", $value).";";
					}
										
					escribirArchivo($archivo, $str); 
					
					if($contador == 0) {
						$str = "";
						foreach($row as $key => $value) {
							$str .= empty($value) ? $value.";" : preg_replace("[;]", "-", $value).";";
						}
						escribirArchivo($archivo, $str);
					}
						
					$contador++;

				}
				$log .= "Se procesaron ".$contador." registros. <br />";
				$log .= "Se ha generado el reporte en: ".$archivo;

			} else {
				$log .= "Error. Algo ha fallado al generar el pedido.<br />";
			}

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

<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />

<link rel="stylesheet" href="../css/custom.css">
</head>
<body>

    <div class="container">
        <div class="table-wrapper">
		  <?php if ($_SERVER["REQUEST_METHOD"] != "POST"): ?>
				<form method="POST" action="<?php echo ($_SERVER['PHP_SELF']);?>" enctype="multipart/form-data" class="form-inline">
					<div class="modal-header">						
						<h4 class="modal-title">Generar reporte</h4>
					</div>
					<div class="modal-body">
					
					<div class="form-group">
						<label>Rango</label>
						<input type="text" name="daterange" style="width: 20em;" />
					</div>

					<div class="form-group">
					  <label for="estado">Estado</label>
					  <select name="estado" id="estado">
						<option value="todos">Todos</option>
						<option value="Abierto">abiertos</option>
						<option value="Cerrado">Cerrados</option>
					  </select>
					</div>  
	
					<input type="submit" name="submit" value="Generar reporte" class="btn btn-default">
				   
					</div>
				</form>				
		  <?php else: ?>
			<div class="alert alert-info" role="alert">
					<strong>Info</strong><br />
					<span><?php echo $log; ?></span>
					<hr />
					<a href="../" class="btn btn-success">Regresar</a>
			</div>	
		  <?php endif; ?>
		  
        </div>
    </div>

	<script src="../js/script.js"></script>
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