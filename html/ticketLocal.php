
<?php
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		require_once ("../conexion.php");//Contiene funcion que conecta a la base de datos
		
		$solicitante = trim($_POST["solicitante"]);
		$asunto = trim($_POST["asunto"]);
		$estado = trim($_POST["estado"]);
		$edificio = trim($_POST["edificio"]);
		$ubicacion = trim($_POST["ubicacion"]);
		$comentarios = trim($_POST["comentarios"]);
		  
		if(!empty($asunto) && !empty($estado) && !empty($edificio) && !empty($comentarios)) {
			$t = obtenerNroTicket($con);
			$nroTicket = $t["ultimoid"];
			$nuevoNroTicket = $nroTicket + 1;
			$fecha = date("Y:m:d H:i:s");
			
$ticket = array(
	"ticket" => $nroTicket,
	"apertura" => $fecha,
	"asunto" => $asunto,
	"solicitante" => $solicitante,
	"email" => "",
	"area" => "INTENDENCIA CAB",
	"estado" => $estado,
	"ultima_actualizacion" => $fecha,
	"respondio" => 0,
	"ubicacion" => $ubicacion,
	"interno" => "",
	"edificio" => $edificio,
	"comentarios" => $comentarios,
	"resaltar" => 0,
	"archivado" => 0
);

$t1 = agregarTicketLocal($con, $ticket);
$t2 = actualizarNroTicket($con, $nuevoNroTicket);

			$log = "Se ha generado el Ticket Nro ".$nroTicket."!!";			
		} else {
			  $log = "Hay campos incompletos";
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

<link rel="stylesheet" href="css/custom.css">
</head>
<body>

<div class="container">


	<!-- Columns start at 50% wide on mobile and bump up to 33.3% wide on desktop -->
	<div class="row">
	  <div class="col-md-3"></div>
	  <div class="col-md-6">
	  <?php if ($_SERVER["REQUEST_METHOD"] != "POST"): ?>
			<h4>Nuevo Ticket Local</h4>
			<div class="modal-content">
				<form method="POST" action="<?php echo ($_SERVER['PHP_SELF']);?>" enctype="multipart/form-data">
						<div class="modal-body">
							<div class="form-group">
								<label>Solicitante</label>
								<input type="text" name="solicitante"  id="solicitante" class="form-control">
							</div>
							<div class="form-group">
								<label>Asunto</label>
								<input type="text" name="asunto"  id="asunto" class="form-control">
							</div>
							<div class="form-group">
								<label for="estado">Estado:</label>
								<select name="estado" id="estado">
								  <option value="abierto">Abierto</option>
								  <option value="cerrado">Cerrado</option>
								</select>
							</div>
							<div class="form-group">
								<label>Nro Edificio</label>
								<input type="text" name="edificio" id="edificio" class="form-control" style="width:5em">
							</div>
							<div class="form-group">
								<label>Ubicacion</label>
								<input type="text" name="ubicacion" id="ubicacion" class="form-control">
							</div>
							<div class="form-group">
								<label>Comentarios</label>
								<textarea name="comentarios" id="comentarios" class="form-control"></textarea>
							</div>
						</div>
						<div class="modal-footer">
							<a href="../" class="btn btn-default">Cancelar</a>
							<input type="submit" name="submit" value="Generar Ticket" class="btn btn-info">
						</div>
					</form>
			</div>
		  <?php else: ?>
			<div class="alert alert-info" role="alert">
					<strong>Info</strong><br />
					<span><?php echo $log; ?></span>
					<hr />
					<a href="../" class="btn btn-success">Regresar</a>
			</div>	
		  <?php endif; ?>
			
	  </div>
	  <div class="col-md-3"></div>
	</div>


  </div>
	
</body>
</html>