
			$('input[name="daterange"]').daterangepicker({
				locale: {
					format: 'DD/MM/YYYY'
				}
			});
			/*
		$(function() {
			load(1);		alert(2);	
//			$('input[name="daterange"]').daterangepicker();
			$('input[name="daterange"]').daterangepicker({
				locale: {
					format: 'DD/MM/YYYY'
				}
			});
  
		});
		
		
		function load(page){
			var query=$("#q").val();
			var per_page=10;
			var parametros = {"action":"ajax","page":page,'query':query,'per_page':per_page};
			$("#loader").fadeIn('slow');
			$.ajax({
				url:'ajax/listar_productos.php',
				data: parametros,
				 beforeSend: function(objeto){
				$("#loader").html("Cargando...");
			  },
				success:function(data){
					$(".outer_div").html(data).fadeIn('slow');
					$("#loader").html("");
				}
			})
		}
		$('#editProductModal').on('show.bs.modal', function (event) { alert("edit event en script.js");
		  var button = $(event.relatedTarget) // Button that triggered the modal
		  var ticket = button.data('ticket') 
		  $('#edit_ticket').val(ticket)
		  var estado = button.data('estado') 
		  $('#edit_estado').val(estado)
		  var cierre = button.data('cierre') 
		  $('#edit_cierre').val(cierre)
		  var tema = button.data('tema') 
		  $('#edit_tema').val(tema)
		  var comentarios = button.data('comentarios') 
		  $('#edit_comentarios').val(comentarios)
		  var id = button.data('id') 
		  $('#edit_id').val(id)
		})
		
		$('#deleteProductModal').on('show.bs.modal', function (event) {
		  var button = $(event.relatedTarget) // Button that triggered the modal
		  var id = button.data('id') 
		  
		  var inf1 = button.data('apertura')+" ("+button.data('estado')+")"
		  var dataSolicitante = button.data('solicitante')+" ("+button.data('email')+")"+" - ("+button.data('interno')+")"
		  var modal = $(this)
		  modal.find('.modal-title').text('Ticket Nro: '+ button.data('ticket'))
  
		  $('#delete_id').val(id)
		  $('#info1').text(inf1)
		  $('#verAsunto').text(button.data('asunto'))
		  $('#verUbicacion').text(button.data('ubicacion'))		  
		  $('#verSolicitante').text(dataSolicitante)
		  $('#verAsignado').text(button.data('asignado'))
		  $('#verCierre').text(button.data('cierre'))
		  $('#verComentarios').text(button.data('comentarios'))
		})

		$( "#edit_product" ).submit(function( event ) {
		  var parametros = $(this).serialize();
			$.ajax({
					type: "POST",
					url: "ajax/editar_producto.php",
					data: parametros,
					 beforeSend: function(objeto){
						$("#resultados").html("Enviando...");
					  },
					success: function(datos){
					$("#resultados").html(datos);
					load(1);
					$('#editProductModal').modal('hide');
				  }
			});
		  event.preventDefault();
		});
		
		
		$( "#add_product" ).submit(function( event ) {
		  var parametros = $(this).serialize();
			$.ajax({
					type: "POST",
					url: "ajax/guardar_producto.php",
					data: parametros,
					 beforeSend: function(objeto){
						$("#resultados").html("Enviando...");
					  },
					success: function(datos){
					$("#resultados").html(datos);
					load(1);
					$('#addProductModal').modal('hide');
				  }
			});
		  event.preventDefault();
		});
		
		$( "#delete_product" ).submit(function( event ) {
		  var parametros = $(this).serialize();
			$.ajax({
					type: "POST",
					url: "ajax/eliminar_producto.php",
					data: parametros,
					 beforeSend: function(objeto){
						$("#resultados").html("Enviando...");
					  },
					success: function(datos){
					$("#resultados").html(datos);
					load(1);
					$('#deleteProductModal').modal('hide');
				  }
			});
		  event.preventDefault();
		});
		
	
*/