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
$resMenu = $serviciosHTML->menu($_SESSION['nombre_predio'],"Dashboard",$_SESSION['refroll_predio'],$_SESSION['sede']);

$resDatosActor = $serviciosReferencias->traerDatosObrasFuncionesPorActor(129); 

$resSumDatosActor = $serviciosReferencias->traerDatosSumObrasFuncionesPorActor(129);

$resDetalleObrasPorActor = $serviciosReferencias->traerDatosObrasPorActor(129);

$resDetalleCooperativasPorActor = $serviciosReferencias->traerDatosCooperativasPorActor(129);



if (mysql_num_rows($resSumDatosActor)>0) {
	$obras 			= mysql_result($resSumDatosActor, 0,1);
	$cooperativas 	= mysql_result($resSumDatosActor, 0,0);
	$funciones 		= mysql_result($resSumDatosActor, 0,2);
} else {
	$obras 			= 0;
	$cooperativas 	= 0;
	$funciones 		= 0;
}


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
	171
    <!-- Latest compiled and minified JavaScript -->
    <script src="../bootstrap/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="../css/chosen.css">
	<link rel="stylesheet" href="../css/bootstrap-datetimepicker.min.css">


    
   
   <link href="../css/perfect-scrollbar.css" rel="stylesheet">
   <link rel="stylesheet" href="../css/sb-admin-2.css"/>
      <!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>-->
      <script src="../js/jquery.mousewheel.js"></script>
      <script src="../js/perfect-scrollbar.js"></script>
      <script>
      jQuery(document).ready(function ($) {
        "use strict";
        $('#navigation').perfectScrollbar();
      });
    </script>
    
    <style>
    	.valor {
    		color: #922B21;
    		text-align: right;
    	}

    	.horario {
    		display: inline-block;
		    font: normal normal normal 14px/1 FontAwesome;
		    font-size: inherit;
		    text-rendering: auto;
		    -webkit-font-smoothing: antialiased;
    	}

    	a.list-group-item-fuscia.active, a.list-group-item-fuscia.active:hover, a.list-group-item-fuscia.active:focus {
		    z-index: 2;
		    color: #fff;
		    background-color: #FF0DFF;
		    border-color: #FF0DFF;
		}

		a.list-group-item-yellow.active, a.list-group-item-yellow.active:hover, a.list-group-item-yellow.active:focus {
		    z-index: 2;
		    color: #fff;
		    background-color: #f0ad4e;
		    border-color: #f0ad4e;
		}

		.list-group-item-fuscia, .list-group-item-yellow:first-child {
		    border-top-right-radius: 4px;
		    border-top-left-radius: 4px;
		}

		.letraChica {
			display: inline-block;
		    font-size: 12px;
		    text-rendering: auto;
		    -webkit-font-smoothing: antialiased;
		}

		

    </style>
    <script src="../js/jquery.color.min.js"></script>
	<script src="../js/jquery.animateNumber.min.js"></script>
</head>

<body>

 
<?php echo str_replace('..','../dashboard',$resMenu); ?>

<div id="content">
	

    
    <div class="row" style="margin-right:15px;">


    	<div class="row" style="margin-left:15px;">
    		<div class="col-lg-3 col-md-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-comments fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge"><?php echo $obras; ?></div>
                                <div>Obras</div>
                            </div>
                        </div>
                    </div>
                    <a href="javascript:void(0)" id="verObras">
                        <div class="panel-footer">
                            <span class="pull-left">Ver Detalles</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>


            <div class="col-lg-3 col-md-6">
                <div class="panel panel-yellow">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-comments fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge"><?php echo $cooperativas; ?></div>
                                <div>Cooperativas</div>
                            </div>
                        </div>
                    </div>
                    <a href="javascript:void(0)" id="verCooperativas">
                        <div class="panel-footer">
                            <span class="pull-left">Ver Detalles</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>


            <div class="col-lg-3 col-md-6">
                <div class="panel panel-fuscia">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-comments fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge"><?php echo $funciones; ?></div>
                                <div>Funciones</div>
                            </div>
                        </div>
                    </div>
                    <a href="javascript:void(0)" id="verFunciones">
                        <div class="panel-footer">
                            <span class="pull-left">Ver Detalles</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>



            <div class="col-lg-3 col-md-6">
                <div class="panel panel-green">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-comments fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">26</div>
                                <div>Liquidación</div>
                            </div>
                        </div>
                    </div>
                    <a href="javascript:void(0)" id="verLiquidacion">
                        <div class="panel-footer">
                            <span class="pull-left">Ver Detalles</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>

    	</div>


    	<div class="row" style="margin-left:15px;; margin-right: 10px;">
    	<div class="lstFunciones">
    	<?php
    		$idobra = 0;
    		$primero = 0;
    		$primeroRow = 1;
    		$cadbecera = '';
    		$body = '';
    		$footer = '';
    		$divRow = 0;
    		echo '<div class="row">';

    		while ($row = mysql_fetch_array($resDatosActor)) {

    			if ($idobra != $row['idobra']) {
    				$idobra = $row['idobra'];
    				if ($primero == 1) {
    					echo '</div>
    							</div>';
    					$primero = 0;		
    				}

    				$divRow += 1;

	    			if ($divRow == 4) {
	    				if ($primeroRow == 1) {
	    					echo '</div>';
	    					$primeroRow = 0;
	    				}
	    				echo '<div class="row">';
	    				$divRow = 0;
	    			}
    				echo '<div class="col-md-4">
					    		<div class="list-group">
								  <a href="#" class="list-group-item list-group-item-fuscia active">
								    '.$row['obra'].' <span class="valor pull-right">Entrada: $'.$row['valorentrada'].'</span>
								  </a>';
					$primero = 1;
    			}

    			echo '<a href="#" id="'.$row['idfuncion'].'" class="list-group-item">Función: '.$row['dia'].' <span class="horario pull-right"><span class="glyphicon glyphicon-time"></span> '.$row['horario'].'</span></a>';

    	?>

    	<?php
    			
    		}
    		if ($primeroRow == 0) {
				echo "</div></div>";
			}
    		if ($primero == 1) {
				echo "</div></div>";
			}
    	?>

    	</div>
    	</div>

    	<div class="row" style="margin-left:15px; margin-right: 10px;">
    	<div class="lstObras">
    	<?php
    		$idobra = 0;
    		$primero = 0;
    		$primeroRow = 1;
    		$cadbecera = '';
    		$body = '';
    		$footer = '';
    		$divRow = 0;
    		echo '<div class="row">';
    		while ($row2 = mysql_fetch_array($resDetalleObrasPorActor)) {
    			if ($idobra != $row2['idobra']) {
    				$idobra = $row2['idobra'];
    				if ($primero == 1) {
    					echo '</div>
    							</div>';
    					$primero = 0;		
    				}

    				$divRow += 1;

	    			if ($divRow == 4) {
	    				if ($primeroRow == 1) {
	    					echo '</div>';
	    					$primeroRow = 0;
	    				}
	    				echo '<div class="row">';
	    				$divRow = 0;
	    			}

    				echo '<div class="col-md-4">
					    		<div class="list-group">
								  <a href="#" class="list-group-item active">
								    '.$row2['obra'].'
								  </a>';
					$primero = 1;
    			}

    			echo '<a href="#" id="'.$row2['idobra'].'" class="list-group-item"><span class="">Entrada: $'.$row2['valorentrada'].'</span></a>';

    	?>

    	<?php
    		}
    		if ($primeroRow == 0) {
				echo "</div>";
			}
    		if ($primero == 1) {
				echo "</div></div>";
			}
    	?>

    	</div>
    	</div>



    	<div class="row" style="margin-left:15px;; margin-right: 10px;">
    	<div class="lstCooperativas">
    	<?php
    		$idobra = 0;
    		$primero = 0;
    		$primeroRow = 1;
    		$cadbecera = '';
    		$body = '';
    		$footer = '';
    		$divRow = 0;
    		echo '<div class="row">';
    		while ($row2 = mysql_fetch_array($resDetalleCooperativasPorActor)) {
    			

    			if ($idobra != $row2['idobra']) {
    				
    				$idobra = $row2['idobra'];
    				if ($primero == 1) {
    					echo '</div>
    							</div>';
    					$primero = 0;		
    				}

    				$divRow += 1;

	    			if ($divRow == 4) {
	    				if ($primeroRow == 1) {
	    					echo '</div>';
	    					$primeroRow = 0;
	    				}
	    				echo '<div class="row">';
	    				$divRow = 0;
	    			}
    				echo '<div class="col-md-4">
					    		<div class="list-group">
								  <a href="#" class="list-group-item list-group-item-yellow active">
								    '.$row2['obra'].'
								  </a>';
					$primero = 1;
    			}

    			echo '<a href="#" id="'.$row2['idobra'].'" class="list-group-item "><span class="letraChica">'.$row2['cooperativa'].'</span> <span class="pull-right">Puntos: '.$row2['puntos'].'</span></a>';

    	?>

    	<?php
    		}
    		if ($primeroRow == 0) {
				echo "</div></div>";
			}
    		if ($primero == 1) {
				echo "</div></div>";
			}
    	?>

    	</div>
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
	
	$('.lstFunciones').hide();
	$('.lstObras').hide();
	$('.lstCooperativas').hide();
	$('.lstLiquidacion').hide();


	$('#verFunciones').click(function() {
		$('.lstFunciones').show();
		$('.lstObras').hide();
		$('.lstCooperativas').hide();
		$('.lstLiquidacion').hide();
	});

	$('#verObras').click(function() {
		$('.lstObras').show();
		$('.lstFunciones').hide();
		$('.lstCooperativas').hide();
		$('.lstLiquidacion').hide();
	});

	$('#verCooperativas').click(function() {
		$('.lstObras').hide();
		$('.lstFunciones').hide();
		$('.lstCooperativas').show();
		$('.lstLiquidacion').hide();
	});

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
