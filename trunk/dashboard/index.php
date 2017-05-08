<?php

session_start();

if (!isset($_SESSION['usua_predio']))
{
	header('Location: ../error.php');
} else {


include ('../includes/funcionesUsuarios.php');
include ('../includes/funcionesHTML.php');
include ('../includes/funciones.php');
include ('../includes/funcionesReferencias.php');

$serviciosUsuario = new ServiciosUsuarios();
$serviciosHTML = new ServiciosHTML();
$serviciosFunciones = new Servicios();
$serviciosReferencias 	= new ServiciosReferencias();

$fecha = date('Y-m-d');

//$resProductos = $serviciosProductos->traerProductosLimite(6);
$resMenu = $serviciosHTML->menu($_SESSION['nombre_predio'],"Dashboard",$_SESSION['refroll_predio'],'');




?>

<!DOCTYPE HTML>
<html>

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes">



<title>Gesti&oacute;n: Teatro Ciego</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">


<link href="../css/estiloDash.css" rel="stylesheet" type="text/css">
    

    
    <script type="text/javascript" src="../js/jquery-1.8.3.min.js"></script>
    <link rel="stylesheet" href="../css/jquery-ui.css">

    <script src="../js/jquery-ui.js"></script>
    
	<!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css"/>
	<link href='http://fonts.googleapis.com/css?family=Lato&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
    <!-- Latest compiled and minified JavaScript -->
    <script src="../bootstrap/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="../css/chosen.css">
	<link rel="stylesheet" href="../css/bootstrap-datetimepicker.min.css">


    
   
   <link href="../css/perfect-scrollbar.css" rel="stylesheet">
      <!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>-->
      <script src="../js/jquery.mousewheel.js"></script>
      <script src="../js/perfect-scrollbar.js"></script>
      <script>
      jQuery(document).ready(function ($) {
        "use strict";
        $('#navigation').perfectScrollbar();
      });
    </script>
    
    <script src="../js/jquery.color.min.js"></script>
	<script src="../js/jquery.animateNumber.min.js"></script>
</head>

<body>

 
<?php echo str_replace('..','../dashboard',$resMenu); ?>

<div id="content">
	

    
    <div class="row" style="margin-right:15px;">
    <div class="col-md-12">
		<h3>Bienvenidos</h3>
    
    </div>
    </div>
    
    

    
   
</div>


</div>





<div class="modal fade" id="myModalcaja" tabindex="1" style="z-index:500000;" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Inicio de Caja</h4>
      </div>
      <div class="modal-body inicioCaja">
      	<div class="row">
        <div class="form-group col-md-6 col-xs-6" style="display:'.$lblOculta.'">
            <label for="'.$campo.'" class="control-label" style="text-align:left">Fecha</label>
            <div class="input-group date form_date col-md-6 col-xs-6" data-date="" data-date-format="dd MM yyyy" data-link-field="fechacaja" data-link-format="yyyy-mm-dd">
                <input class="form-control" size="50" type="text" value="<?php echo date('Y-m-d'); ?>" readonly>
                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
            </div>
            <input type="hidden" name="fechacaja" id="fechacaja" value="<?php echo date('Y-m-d'); ?>" />
        </div>
        <div class="col-md-6">
        	<label class="control-label">Ingresa Inicio de Caja</label>
            <div class="col-md-12 input-group">
            	<input type="number" class="form-control valor" id="cajainicio" name="cajainicio" value="5" required />
            </div>
        </div>
        </div>
      </div>
      <div class="modal-footer">
      	<button type="button" class="btn btn-primary" data-dismiss="modal" id="guardarcaja">Guardar</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>


<script type="text/javascript" src="../js/jquery.dataTables.min.js"></script>
<script src="../bootstrap/js/dataTables.bootstrap.js"></script>

<script src="../js/bootstrap-datetimepicker.min.js"></script>
<script src="../js/bootstrap-datetimepicker.es.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	
	
	$(document).on('click', '.panel-heading span.clickable', function(e){
		var $this = $(this);
		if(!$this.hasClass('panel-collapsed')) {
			$this.parents('.panel').find('.panel-body').slideUp();
			$this.addClass('panel-collapsed');
			$this.find('i').removeClass('glyphicon-chevron-up').addClass('glyphicon-chevron-down');
		} else {
			$this.parents('.panel').find('.panel-body').slideDown();
			$this.removeClass('panel-collapsed');
			$this.find('i').removeClass('glyphicon-chevron-down').addClass('glyphicon-chevron-up');
		}
	});
	
	$('table.table').dataTable({
		"order": [[ 0, "asc" ]],
		"language": {
			"emptyTable":     "No hay datos cargados",
			"info":           "Mostrar _START_ hasta _END_ del total de _TOTAL_ filas",
			"infoEmpty":      "Mostrar 0 hasta 0 del total de 0 filas",
			"infoFiltered":   "(filtrados del total de _MAX_ filas)",
			"infoPostFix":    "",
			"thousands":      ",",
			"lengthMenu":     "Mostrar _MENU_ filas",
			"loadingRecords": "Cargando...",
			"processing":     "Procesando...",
			"search":         "Buscar:",
			"zeroRecords":    "No se encontraron resultados",
			"paginate": {
				"first":      "Primero",
				"last":       "Ultimo",
				"next":       "Siguiente",
				"previous":   "Anterior"
			},
			"aria": {
				"sortAscending":  ": activate to sort column ascending",
				"sortDescending": ": activate to sort column descending"
			}
		  }
	} );
	
	
	
	$('#guardarcaja').click(function() {

		$.ajax({
			data:  {fecha: $('#fechacaja').val(),
					inicio: $('.valor').val(), 
					accion: 'insertarCajadiaria'},
			url:   '../ajax/ajax.php',
			type:  'post',
			beforeSend: function () {
					
			},
			success:  function (response) {
				$('.detallePedido').html(response);	
				traerCaja();
			}
		});
	});
	
	function traerCaja() {
		$.ajax({
			data:  {fecha: $('#fechacaja').val(),
					accion: 'traerCajadiariaPorFecha'},
			url:   '../ajax/ajax.php',
			type:  'post',
			beforeSend: function () {
					
			},
			success:  function (response) {
				$('.valor').val(response);
			}
		});
	}
	
	traerCaja();
	
	

	
	
	


});
</script>

<script type="text/javascript">

		
$('.form_date').datetimepicker({
	language:  'es',
	weekStart: 1,
	todayBtn:  1,
	autoclose: 1,
	todayHighlight: 1,
	startView: 2,
	minView: 2,
	forceParse: 0,
	format: 'dd/mm/yyyy'
});
</script>
   
    <script src="../js/chosen.jquery.js" type="text/javascript"></script>
<script type="text/javascript">
    var config = {
      '.chosen-select'           : {},
      '.chosen-select-deselect'  : {allow_single_deselect:true},
      '.chosen-select-no-single' : {disable_search_threshold:10},
      '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
      '.chosen-select-width'     : {width:"95%"}
    }
    for (var selector in config) {
      $(selector).chosen(config[selector]);
    }
  </script>
<?php } ?>
</body>
</html>
