<?php
	/*-------------------------
	Autor: Obed Alvarado
	Web: obedalvarado.pw
	Mail: info@obedalvarado.pw
	---------------------------*/
    // DB credentials.
	define('DB_HOST','localhost');
	define('DB_USER','root');
	define('DB_PASS','');
	define('DB_NAME','ticket');
	# conectare la base de datos
    $con=@mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if(!$con){
        die("imposible conectarse: ".mysqli_error($con));
    }
    if (@mysqli_connect_errno()) {
        die("Conexión falló: ".mysqli_connect_errno()." : ". mysqli_connect_error());
    }
	
	
	function existeTicket($con, $ticket) {		
		// DELETE FROM  database
		$sql = "SELECT id FROM  ticket WHERE ticket='$ticket'";
		$query = mysqli_query($con,$sql);
		
		return mysqli_fetch_array($query);
	}
	
	function agregarTicket($con, $t) {	
		// DELETE FROM  database
		$sql = "INSERT INTO ticket (id, ticket, apertura, asunto, solicitante, email, area, estado, ultima_actualizacion, respondio, asignado, ubicacion, interno) VALUES
(null, '$t[0]', '$t[1]', '$t[2]', '$t[3]', '$t[4]', '$t[7]', '$t[9]', '$t[10]', '$t[13]', '$t[14]', '$t[17]', '$t[18]')";
	//	$sql = "SELECT id FROM  ticket WHERE ticket='$ticket'";
		$query = mysqli_query($con,$sql);
		
		return $query;
//return $sql;
	}
	
	function agregarTicketLocal($con, $t) {	
		// DELETE FROM  database
		$sql = "INSERT INTO ticket (ticket, apertura, asunto, solicitante, email, area, estado, ultima_actualizacion, respondio, ubicacion, interno, edificio, comentarios, archivado) VALUES (
		'".$t["ticket"]."', 
		'".$t["apertura"]."', 
		'".$t["asunto"]."',
		'".$t["solicitante"]."',
		'".$t["email"]."',
		'".$t["area"]."',
		'".$t["estado"]."',
		'".$t["ultima_actualizacion"]."',
		'".$t["respondio"]."',
		'".$t["ubicacion"]."',
		'".$t["interno"]."',
		'".$t["edificio"]."',
		'".$t["comentarios"]."',
		'".$t["archivado"]."'
		)";
	//	$sql = "SELECT id FROM  ticket WHERE ticket='$ticket'";
		$query = mysqli_query($con,$sql);
		
///*********
/*
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
	*/
///*********
		return $query;
//return $sql;
	}
	
	function actualizarRegistro($con, $data) {
		$sql = "UPDATE ticket SET estado = '$data[9]', ultima_actualizacion = '$data[10]', respondio = '$data[13]', asignado = '$data[14]' WHERE ticket.ticket = '$data[0]'";
		
		$query = mysqli_query($con,$sql);
		
		return $query;
	}
	
	function actualizarNroTicket($con, $nroTicket) {
		$sql = "UPDATE ticket.ultimoid SET ultimoid = '$nroTicket' WHERE id = 1";
		
		$query = mysqli_query($con,$sql);
		
		return $query;
	}
	
	function generarCSV($arreglo, $ruta, $delimitador, $encapsulador){
	  $file_handle = fopen($ruta, 'w');
	  foreach ($arreglo as $linea) {
		fputcsv($file_handle, $linea, $delimitador, $encapsulador);
	  }
	  rewind($file_handle);
	  fclose($file_handle);
	  
	  return 0;
	}
	
	function escribirArchivo($archivo, $str) {

		$str = preg_replace("[\n|\r|\n\r]", "", $str);
		$str = substr($str, 0, -1);
					
		$file = fopen($archivo, "a");
		fwrite($file, $str . PHP_EOL);
		fclose($file);
		
		return true;
	}
	
	function obtenerNroTicket($con) {
		// DELETE FROM  database
		$sql = "SELECT ultimoid FROM ultimoid";
		$query = mysqli_query($con,$sql);
		
		return mysqli_fetch_array($query);		
	}


	
/*
$original_date = "2019-03-31";
 
// Creating timestamp from given date
$timestamp = strtotime($original_date);
 
// Creating new date format from that timestamp
$new_date = date("d-m-Y", $timestamp);

date("Y-m-d", strtotime($t[1]));

  [0]=>   string(22) ""Número de Ticket"
  [1]=>  string(5) "Fecha"
  [2]=>  string(6) "Asunto"
  [3]=>  string(2) "De"
  [4]=>  string(22) "De correo electrónico"
  [5]=>  string(9) "Prioridad"
  [6]=>  string(12) "Departamento"
  [7]=>  string(14) "Temas de ayuda"
  [8]=>  string(6) "Fuente"
  [9]=>  string(13) "Estado actual"
  [10]=>  string(22) "Última actualización"
  [11]=>  string(20) "Fecha de Vencimiento"
  [12]=>  string(7) "Vencido"
  [13]=>  string(10) "Respondió"
  [14]=>  string(10) "Asignado a"
  [15]=>  string(15) "Agente asignado"
  [16]=>  string(15) "Equipo asignado"
  [17]=>  string(9) "Ubicacion"
  [18]=>  string(19) "Interno de contacto"
  [19]=>  string(14) "Datos Adjuntos"
  */
?>