<?php


session_start();

if (!isset($_SESSION['usua_predio']))
{
	header('Location: ../../error.php');
} else {


include ('../../includes/funciones.php');
include ('../../includes/funcionesUsuarios.php');
include ('../../includes/funcionesHTML.php');
include ('../../includes/funcionesReferencias.php');

$serviciosFunciones 	= new Servicios();
$serviciosUsuario 		= new ServiciosUsuarios();
$serviciosHTML 			= new ServiciosHTML();
$serviciosReferencias 	= new ServiciosReferencias();

$fecha = date('Y-m-d');

//$resProductos = $serviciosProductos->traerProductosLimite(6);
$resMenu = $serviciosHTML->menu($_SESSION['nombre_predio'],"Pagos",$_SESSION['refroll_predio'],$_SESSION['sede']);


/////////////////////// Opciones pagina ///////////////////////////////////////////////
$singular = "Personal";

$plural = "Personal";

$eliminar = "eliminarPersonal";

$insertar = "insertarPersonal";

$tituloWeb = "Gestión: Teatro Ciego";
//////////////////////// Fin opciones ////////////////////////////////////////////////


if ($_SESSION['refroll_predio'] != 1) {

} else {

	
}


?>

<!DOCTYPE HTML>
<html>

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">



<title><?php echo $tituloWeb; ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">


<link href="../../css/estiloDash.css" rel="stylesheet" type="text/css">
    

    
    <script type="text/javascript" src="../../js/jquery-1.8.3.min.js"></script>
    <link rel="stylesheet" href="../../css/jquery-ui.css">

    <script src="../../js/jquery-ui.js"></script>
    
	<!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css"/>
	171
    <!-- Latest compiled and minified JavaScript -->
    <script src="../../bootstrap/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="../../css/bootstrap-datetimepicker.min.css">
	
    
   
   <link href="../../css/perfect-scrollbar.css" rel="stylesheet">
      <!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>-->
      <script src="../../js/jquery.mousewheel.js"></script>
      <script src="../../js/perfect-scrollbar.js"></script>
      <script>
      jQuery(document).ready(function ($) {
        "use strict";
        $('#navigation').perfectScrollbar();
      });
    </script>
    
 
</head>

<body>

 <?php echo $resMenu; ?>

<div id="content">

<h3><?php echo $plural; ?></h3>

    <div class="boxInfoLargo">
        <div id="headBoxInfo">
        	<p style="color: #fff; font-size:18px; height:16px;">Carga de <?php echo $plural; ?></p>
        	
        </div>
    	<div class="cuerpoBox">

			<form class="form-inline formulario" role="form">
        	<div class="row">
            	<div class="form-group col-md-4 col-xs-6" style="display:'.$lblOculta.'">
                    <label for="fecha1" class="control-label" style="text-align:left">Fecha Desde</label>
                    <div class="input-group col-md-6 col-xs-12">
                    <input class="form-control" type="text" name="fecha2" id="fecha2" value="Date"/>
                    </div>
                </div>
                
                <div class="form-group col-md-4 col-xs-6" style="display:'.$lblOculta.'">
                    <label for="fecha1" class="control-label" style="text-align:left">Fecha Hasta</label>
                    <div class="input-group col-md-6 col-xs-12">
                    <input class="form-control" type="text" name="fecha3" id="fecha3" value="Date"/>
                    </div>
                </div>
                
                
                <div class="form-group col-md-6">
                    <label class="control-label" style="text-align:left" for="refcliente">Acción</label>

                    	<ul class="list-inline">
                        	<li>
                    			<button type="button" class="btn btn-primary" id="traerPagos" style="margin-left:0px;">Buscar</button>
                            </li>
                            
                        </ul>

                </div>
                
                <div class="form-group col-md-12">
                	<div class="lstLiquidacion">
                        
                        
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Haberes del Personal
                            </div>
                            <div class="panel-body">
                                <div class="list-group lstPagos">
                                    
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                
                </div>
                
                
                <div class="form-group col-md-6">
                    <label class="control-label" style="text-align:left" for="refcliente">Acción</label>

                    	<ul class="list-inline">
                        	<li>
                    			<button type="button" class="btn btn-success" id="rptPagos" style="margin-left:0px;">Generar PDF</button>
                            </li>
                            <li>
                        		<button type="button" class="btn btn-default" id="rptPagosExcel" style="margin-left:0px;">Generar Excel</button>
                            </li>
                        </ul>

                </div>
                

            </div>
            
            
            <div class='row' style="margin-left:25px; margin-right:25px;">
                <div class='alert'>
                
                </div>
                <div id='load'>
                
                </div>
            </div>

            </form>
            </div>


    	</div>
    </div>



</div>

<script type="text/javascript" src="../../js/jquery.dataTables.min.js"></script>
<script src="../../bootstrap/js/dataTables.bootstrap.js"></script>

<script src="../../js/bootstrap-datetimepicker.min.js"></script>
<script src="../../js/bootstrap-datetimepicker.es.js"></script>

<script type="text/javascript">
$(document).ready(function(){
	
	$('#traerPagos').click(function() {

		$.ajax({
			data:  {desde: $('#fecha2').val(),
					hasta: $('#fecha3').val(), 
					accion: 'traerPagos'},
			url:   '../../ajax/ajax.php',
			type:  'post',
			beforeSend: function () {
					
			},
			success:  function (response) {
				$('.lstPagos').html(response);	
			}
		});
	});
	
	$('#rptPagos').click(function(e) {
        window.open("../../reportes/rptLiquidacion.php?desde=" + $("#fecha2").val() + '&hasta=' + $("#fecha3").val(),'_blank');
    });
	
	$('#rptPagosExcel').click(function(e) {
        window.open("../../reportes/rptLiquidacionExcel.php?desde=" + $("#fecha2").val() + '&hasta=' + $("#fecha3").val(),'_blank');
    });

});
</script>

<script>
  $(function() {
	  $.datepicker.regional['es'] = {
 closeText: 'Cerrar',
 prevText: '<Ant',
 nextText: 'Sig>',
 currentText: 'Hoy',
 monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
 monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
 dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
 dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
 dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
 weekHeader: 'Sm',
 dateFormat: 'dd/mm/yy',
 firstDay: 1,
 isRTL: false,
 showMonthAfterYear: false,
 yearSuffix: ''
 };
 $.datepicker.setDefaults($.datepicker.regional['es']);
 
    $( "#fecha1" ).datepicker();
    $( "#fecha1" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
	
	$( "#fecha2" ).datepicker();
    $( "#fecha2" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
	
	$( "#fecha3" ).datepicker();
    $( "#fecha3" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
	
	$( "#fecha4" ).datepicker();
    $( "#fecha4" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
	
	$( "#fecha5" ).datepicker();
    $( "#fecha5" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
	
	$( "#fechadesde2" ).datepicker();
    $( "#fechadesde2" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
	
	$( "#fechadesde3" ).datepicker();
    $( "#fechadesde3" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
	
	$( "#fechadesde4" ).datepicker();
    $( "#fechadesde4" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
	
	$( "#fechadesde5" ).datepicker();
    $( "#fechadesde5" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
	
	
	$( "#fechahasta1" ).datepicker();
    $( "#fechahasta1" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
	
	$( "#fechahasta2" ).datepicker();
    $( "#fechahasta2" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
	
	$( "#fechahasta3" ).datepicker();
    $( "#fechahasta3" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
	
	$( "#fechahasta4" ).datepicker();
    $( "#fechahasta4" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
	
	$( "#fechahasta5" ).datepicker();
    $( "#fechahasta5" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
	
  });
  </script>
<?php } ?>
</body>
</html>
