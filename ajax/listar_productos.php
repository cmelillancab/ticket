<?php
	
	/* Connect To Database*/
	require_once ("../conexion.php");

	
$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
if($action == 'ajax'){
	$query = mysqli_real_escape_string($con,(strip_tags($_REQUEST['query'], ENT_QUOTES)));

	$tables="ticket";
	$campos="*";
	$sWhere=" ticket.ticket LIKE '%".$query."%' AND apertura >= '2023-03-01 00:00:00' AND apertura <= '2023-05-30 23:59:59'";
	$sWhere.=" order by ticket.apertura ASC";
	
	
	include 'pagination.php'; //include pagination file
	//pagination variables
	$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
	$per_page = intval($_REQUEST['per_page']); //how much records you want to show
	$adjacents  = 4; //gap between pages after number of adjacents
	$offset = ($page - 1) * $per_page;
	//Count the total number of row in your table*/
	$count_query   = mysqli_query($con,"SELECT count(*) AS numrows FROM $tables where $sWhere ");
	if ($row= mysqli_fetch_array($count_query)){$numrows = $row['numrows'];}
	else {echo mysqli_error($con);}
	$total_pages = ceil($numrows/$per_page);
	//main query to fetch the data
	$query = mysqli_query($con,"SELECT $campos FROM  $tables where $sWhere LIMIT $offset,$per_page");
	//loop through fetched data
	


		
	
	if ($numrows>0){
		
	?>
		<div class="table-responsive">
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th>Ticket</th>
						<th>Asunto </th>
						<th>Apertura </th>
						<th>Estado</th>
						<th>Cierre</th>
						<th>Tema</th>
						<th>Comentarios</th>
						<th>#</th>
					</tr>
				</thead>
				<tbody>	
						<?php 
						$finales=0;
						while($row = mysqli_fetch_array($query)){
							$id = $row['id'];
							$ticket=$row['ticket'];
							$asunto=$row['asunto'];
							$apertura=$row['apertura'];
							$estado=$row['estado'];
							$cierre=$row['cierre'];
							$tema=$row['tema'];						
							$comentarios=$row['comentarios'];
							
							$finales++;
						?>	
						<tr class="<?php echo $text_class;?>">
							<td><?php echo $ticket;?></td>
							<td><?php echo $asunto;?></td>
							<td><?php echo $apertura;?></td>
							<td><?php echo $estado;?></td>
							<td><?php echo $cierre;?></td>
							<td><?php echo $tema;?></td>
							<td><?php echo $comentarios;?></td>
							<td>
								<a href="#"  data-target="#deleteProductModal" class="edit" data-toggle="modal" 
									data-ticket='<?php echo $ticket;?>' 
									data-apertura='<?php echo $row['apertura'];?>' 
									data-asunto="<?php echo $asunto?>" 
									data-solicitante="<?php echo $row['solicitante']?>" 
									data-email="<?php echo $row['email']?>" 
									data-area="<?php echo $row['area']?>" 
									data-estado="<?php echo $estado?>"
									data-asignado="<?php echo $row['asignado']?>"
									data-ubicacion="<?php echo $row['ubicacion']?>" 
									data-interno="<?php echo $row['interno']?>" 
									data-tema="<?php echo $tema?>" 
									data-cierre="<?php echo $cierre?>" 
									data-comentarios="<?php echo $comentarios;?>" 
									data-url="<?php echo $row['url'];?>" 
									data-notificado="<?php echo $row['notificado'];?>" 
									data-resuelto="<?php echo $row['resuelto'];?>" 
									data-archivado="<?php echo $row['archivado'];?>"
									data-obras="<?php echo $row['obras'];?>"
									data-id="<?php echo $id; ?>">
								<i class="material-icons" data-toggle="tooltip" title="Ver" >&#xe417;</i>
								</a>
								<a href="#"  data-target="#editProductModal" class="edit" data-toggle="modal" 
									data-ticket='<?php echo $ticket;?>' 
									data-asunto="<?php echo $asunto?>" 
									data-estado="<?php echo $estado?>" 
									data-cierre="<?php echo $cierre?>" 
									data-tema="<?php echo $tema?>" 
									data-url="<?php echo $row['url'];?>"
									data-notificado="<?php echo $row['notificado'];?>" 
									data-resuelto="<?php echo $row['resuelto'];?>" 
									data-archivado="<?php echo $row['archivado'];?>" 
									data-obras="<?php echo $row['obras'];?>" 
									data-comentarios="<?php echo $comentarios;?>" 
									data-id="<?php echo $id; ?>">
								<i class="material-icons" data-toggle="tooltip" title="Editar" >&#xE254;</i>
								</a>
                    		</td>
						</tr>
						<?php }?>
						<tr>
							<td colspan='6'> 
								<?php 
									$inicios=$offset+1;
									$finales+=$inicios -1;
									echo "Mostrando $inicios al $finales de $numrows registros";
									echo paginate( $page, $total_pages, $adjacents);
								?>
							</td>
						</tr>
				</tbody>			
			</table>
		</div>	

	
	
	<?php	
	}	
}
?>          