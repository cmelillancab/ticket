<?php
	if (empty($_POST['edit_id'])){
		$errors[] = "ID está vacío.";
	} elseif (!empty($_POST['edit_id'])){ 
	
	//array(5) { ["edit_ticket"]=> string(6) "485711" ["edit_id"]=> string(3) "524" ["edit_tema"]=> string(0) "" ["edit_cierre"]=> string(18) "02/03/23 12:31 pm " ["edit_comentarios"]=> string(37) "la guardia sur se encuentra sin AGUA." }
	
	require_once ("../conexion.php");//Contiene funcion que conecta a la base de datos
	// escaping, additionally removing everything that could be (html/javascript-) code
    $edificio = mysqli_real_escape_string($con,(strip_tags($_POST["edit_edificio"],ENT_QUOTES)));
	$url = mysqli_real_escape_string($con,(strip_tags($_POST["edit_url"],ENT_QUOTES)));
	$comentarios = mysqli_real_escape_string($con,(strip_tags($_POST["edit_comentarios"],ENT_QUOTES)));
//	var_dump($_POST); 
//	exit;
	$notificado = isset($_POST["edit_notificado"]) ? 1 : 0;
	$resuelto = isset($_POST["edit_resuelto"]) ? 1 : 0;
	$archivado = isset($_POST["edit_archivado"]) ? 1 : 0;
	$obras = isset($_POST["edit_obras"]) ? 1 : 0;
	/*
	var_dump($notificado);
	var_dump($resuelto);
	var_dump($archivado);
	var_dump($obras);
	exit;
	*/
	$id=intval($_POST['edit_id']);
	// UPDATE data into database
    $sql = "UPDATE ticket SET edificio='".$edificio."', comentarios='".$comentarios."', url='".$url."', notificado='".$notificado."', resuelto='".$resuelto."', archivado='".$archivado."', obras='".$obras."' WHERE id='".$id."' ";
    $query = mysqli_query($con,$sql);
    // if product has been added successfully
    if ($query) {
        $messages[] = "El ticket ha sido actualizado con éxito.";
    } else {
        $errors[] = "Lo sentimos, la actualización falló. Por favor, regrese y vuelva a intentarlo.";
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
?>