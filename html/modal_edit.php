<div id="editProductModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content modal-lg">
				<form name="edit_product" id="edit_product">
					<div class="modal-header">						
						<h4 class="modal-title">Editar Ticket</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label>Ticket</label>
							<input type="text" name="edit_ticket"  id="edit_ticket" class="form-control" readonly>
							<input type="hidden" name="edit_id" id="edit_id" >
						</div>
						<div class="form-group">
							<label>Edificio</label>
							<input type="text" name="edit_edificio" id="edit_edificio" class="form-control">
						</div>
						<div class="form-group">
							<label>Link</label>
							<input type="text" name="edit_url" id="edit_url" class="form-control">
						</div>
						<div class="form-group">
							<label>Comentarios</label>
							<textarea name="edit_comentarios" id="edit_comentarios" class="form-control" rows="10" cols="100"></textarea>
						</div>
						
					  <div class="form-check">						
						<input type="checkbox" class="form-check-input" name="edit_obras" id="edit_obras">
						<label class="form-check-label" for="edit_obras">Obras</label>
						
						<input type="checkbox" class="form-check-input" name="edit_notificado" id="edit_notificado">
						<label class="form-check-label" for="edit_notificado">Notificado</label>
						
						<input type="checkbox" class="form-check-input" name="edit_resuelto" id="edit_resuelto">
						<label class="form-check-label" for="edit_resuelto">Resuelto</label>
						
						<input type="checkbox" class="form-check-input" name="edit_archivado" id="edit_archivado">
						<label class="form-check-label" for="edit_archivado">Archivado</label>
					  </div>
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
						<input type="submit" class="btn btn-info" value="Guardar datos">
					</div>
				</form>
			</div>
		</div>
	</div>