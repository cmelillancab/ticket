<?php
	
	/* Connect To Database*/
	require_once ("conexion.php");
	
	//main query to fetch the data
	$query = mysqli_query($con,"select * from ticket.ticket where apertura >= '2023-01-01 00:00:00' order by ticket.apertura ASC");
//	$query = mysqli_query($con,"select * from ticket.ticket where estado = 'Abierto' order by ticket.apertura ASC");
	//loop through fetched data
	?>
		<div class="table-responsive">
			<table id="example" class="display" style="width:100%">
				<thead>
					<tr>
						<th>Ticket</th>
						<th>Asunto </th>
						<th>Apertura </th>
						<th>Estado</th>
						<th>Ed</th>
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
//							$apertura=$row['apertura'];
//							$apertura=date('d/m/Y', strtotime($row['apertura']));
							$apertura=date('Y-m-d', strtotime($row['apertura']));
							$estado=$row['estado'];
							$edificio=$row['edificio'];
							$tema=$row['tema'];						
							$comentarios=$row['comentarios'];
							$url = empty($row['url']) ? $ticket : '<a href="'.$row["url"].'" target="_blank">'.$ticket.'</a>';
							
							$finales++;
						?>	
						<tr>
							<td><?php echo $url;?></td>
							<td><?php echo $asunto;?></td>
							<td style="width:6em;"><?php echo $apertura;?></td>
							<td><?php echo $estado;?></td>
							<td><?php echo $edificio;?></td>
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
									data-edificio="<?php echo $edificio?>" 
									data-comentarios="<?php echo $comentarios;?>" 
									data-url="<?php echo $row['url'];?>" 
									data-id="<?php echo $id; ?>">
								<i class="material-icons" data-toggle="tooltip" title="Ver" >&#xe417;</i>
								</a>
								<a href="#" data-target="#editProductModal" class="edit" data-toggle="modal" 
									data-ticket='<?php echo $ticket;?>' 
									data-asunto="<?php echo $asunto?>" 
									data-estado="<?php echo $estado?>" 
									data-edificio="<?php echo $edificio?>" 
									data-tema="<?php echo $tema?>" 
									data-url="<?php echo $row['url'];?>"
									data-comentarios="<?php echo $comentarios;?>" 
									data-notificado="<?php echo $row['notificado'];?>" 
									data-resuelto="<?php echo $row['resuelto'];?>" 
									data-archivado="<?php echo $row['archivado'];?>" 
									data-id="<?php echo $id; ?>">
								<i class="material-icons" data-toggle="tooltip" title="Editar" >&#xE254;</i>
								</a>
                    		</td>
						</tr>
						<?php } ?>
				</tbody>			
			</table>
		</div>	
