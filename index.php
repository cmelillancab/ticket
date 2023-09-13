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

<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.5.0/tinymce.min.js"></script>

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="css/custom.css">
</head>
<body>

    <div class="container">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6">
						<h2>Administrar <b>Ticket</b></h2>
					</div>
					<div class="col-sm">
						<a href="html/ticketLocal.php" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Ticket Local</span></a>
					</div>
					<div class="col-sm">
						<a href="html/reporte.php" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Generar Reporte</span></a>
					</div>
					<div class="col-sm">
						<a href="html/procesarTicket.php" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Procesar Ticket</span></a>
					</div>
                </div>
            </div>
			<div class='clearfix'></div>
			<hr>
			<!-- Edit Modal HTML -->
			<?php include("html/paginate.php");?>
        </div>
    </div>
	<!-- Edit Modal HTML -->
	<?php include("html/modal_edit.php");?>
	<!-- Delete Modal HTML -->
	<?php include("html/modal_delete.php");?>
	<script src="js/scriptPaginate.js"></script>
</body>
</html>