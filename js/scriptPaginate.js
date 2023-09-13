$(document).ready(function () {
    $('#example').DataTable({
        pagingType: 'full_numbers',
    });
/*	
	tinymce.init({
		selector: 'textarea#edit_comentarios'
	});
*/
});
/*
document.addEventListener('focusin', (e) => {
  if (e.target.closest(".tox-tinymce-aux, .moxman-window, .tam-assetmanager-root") !== null) {
    e.stopImmediatePropagation();
  }
});
*/
		
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
		$('#editProductModal').on('show.bs.modal', function (event) { //alert("edit en ScriptPaginate . js");
		  var button = $(event.relatedTarget) // Button that triggered the modal
		  var ticket = button.data('ticket') 
		  $('#edit_ticket').val(ticket)
		  var estado = button.data('estado') 
		  $('#edit_estado').val(estado)
		  var edificio = button.data('edificio') 
		  $('#edit_edificio').val(edificio)
		  var url = button.data('url') 
		  $('#edit_url').val(url)
		  var comentarios = button.data('comentarios') 
		  $('#edit_comentarios').val(comentarios)
		  
		  var obras = button.data('obras')
		  $('#edit_obras').val(obras)
		  var notificado = button.data('notificado')
		  $('#edit_notificado').val(notificado)
		  var resuelto = button.data('resuelto')
		  $('#edit_resuelto').val(resuelto)
		  var archivado = button.data('archivado')
		  $('#edit_archivado').val(archivado)
//			tinymce.activeEditor.setContent(comentarios);
		  var id = button.data('id') 
		  $('#edit_id').val(id)
		  
		  if(obras == 1) {
			document.getElementById("edit_obras").checked = true;			  
		  }
		  
		  if(notificado == 1) {
			document.getElementById("edit_notificado").checked = true;			  
		  }
		  
		  if(resuelto == 1) {
			document.getElementById("edit_resuelto").checked = true;			  
		  }
		  
		  if(archivado == 1) {
			document.getElementById("edit_archivado").checked = true;			  
		  }
		  
		})

		$( "#edit_product" ).submit(function( event ) {
		  var parametros = $(this).serialize();
//		  alert($('#edit_archivado').val());
//		  var txt = tinyMCE.activeEditor.getContent();
//		  parametros.edit_comentarios = txt;
//		  console.log(tinyMCE.activeEditor.getContent()); edit_comentarios
//		  console.log('\n');
//		  console.log(parametros); 
//		  alert(1);
			$.ajax({
					type: "POST",
					url: "ajax/editar_producto.php",
					data: parametros,
					 beforeSend: function(objeto){
						$("#resultados").html("Enviando...");
					  },
					success: function(datos){
					$("#resultados").html(datos);
					//load(1);
					$('#editProductModal').modal('hide');
				  }
			});
		  event.preventDefault();
		});