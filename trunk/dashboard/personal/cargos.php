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

$serviciosFunciones = new Servicios();
$serviciosUsuario 	= new ServiciosUsuarios();
$serviciosHTML 		= new ServiciosHTML();
$serviciosReferencias 	= new ServiciosReferencias();

$fecha = date('Y-m-d');

//$resProductos = $serviciosProductos->traerProductosLimite(6);
$resMenu = $serviciosHTML->menu(utf8_encode($_SESSION['nombre_predio']),"Personal",$_SESSION['refroll_predio'],'');


$id = $_GET['id'];

$resResultado = $serviciosReferencias->traerPersonalcargosPorPersona($id);


/////////////////////// Opciones pagina ///////////////////////////////////////////////
$singular = "Cargo";

$plural = "Cargos";

$eliminar = "eliminarPersonalcargos";

$modificar = "modificarPersonalcargos";

$idTabla = "idpersonalcargo";

$insertar = "insertarPersonalcargos";

$tituloWeb = "Gestión: Teatro Ciego";
//////////////////////// Fin opciones ////////////////////////////////////////////////


/////////////////////// Opciones para la creacion del formulario  /////////////////////
$tabla 			= "dbpersonalcargos";

$lblCambio	 	= array("refpersonal","reftiposcargos","reffunciones","fechaalta","fechabaja","fechabajatentativa");
$lblreemplazo	= array("Persona","Tipo Cargo","Funciones","Fecha Alta","Fecha Baja","Fecha Baja Tentativa");

$resPersona	=	$serviciosReferencias->traerPersonalPorId($id);
$cadRef 	= 	$serviciosFunciones->devolverSelectBoxActivo($resPersona,array(3,4),', ',$id);

$resTipoC	=	$serviciosReferencias->traerTiposcargos();
$cadRef2 	= 	$serviciosFunciones->devolverSelectBox($resTipoC,array(1),'');

$resFuncion	=	$serviciosReferencias->traerFunciones();
$cadRef3 	= 	$serviciosFunciones->devolverSelectBox($resFuncion,array(1,4,5),' - ');

$refdescripcion = array(0=>$cadRef,1=>$cadRef2,2=>$cadRef3);
$refCampo 	=  array("refpersonal","reftiposcargos","reffunciones");
//////////////////////////////////////////////  FIN de los opciones //////////////////////////

$cabeceras 		= "	<th>Cargo</th>
					<th>Cooperativa</th>
					<th>Fecha Alta</th>
					<th>Fecha Baja</th>
					<th>Fecha Baja Tentativa</th>
					<th>Puntos</th>
					<th>Monto</th>
					<th>Funcion</th>
					<th>Horario</th>
					<th>Dia</th>";


$formulario 	= $serviciosFunciones->camposTabla($insertar ,$tabla,$lblCambio,$lblreemplazo,$refdescripcion,$refCampo);

$lstCargos		= $serviciosReferencias->traerPersonalcargosPorPersonaTodos($id);

$lstCargados 	= $serviciosFunciones->camposTablaView($cabeceras,$lstCargos,10);

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
	<link href='http://fonts.googleapis.com/css?family=Lato&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
    <!-- Latest compiled and minified JavaScript -->
    <script src="../../bootstrap/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="../../css/bootstrap-datetimepicker.min.css">
	<style type="text/css">
		
  
		
	</style>
    
   
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
        	<p style="color: #fff; font-size:18px; height:16px;">Cargar <?php echo $singular; ?></p>
        	
        </div>
    	<div class="cuerpoBox">
        	<form class="form-inline formulario" role="form">
        	
			<div class="row">
            	<div id="puntosobras" style="margin-left:15px;">
                	
                </div>
			<?php echo $formulario; ?>
            </div>
            
            
            <div class='row' style="margin-left:25px; margin-right:25px;">
                <div class='alert'>
                
                </div>
                <div id='load'>
                
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-12">
                <ul class="list-inline" style="margin-top:15px;">

                    <li>
                    <button type="button" class="btn btn-success" id="cargar" style="margin-left:0px;">Agregar</button>
                    </li>
                    <li>
                        <button type="button" class="btn btn-default volver" style="margin-left:0px;">Volver</button>
                    </li>
                </ul>
                </div>
            </div>
            </form>
    	</div>
    </div>


    <div class="boxInfoLargo">
        <div id="headBoxInfo">
        	<p style="color: #fff; font-size:18px; height:16px;"><?php echo $plural; ?> Cargados</p>
        	
        </div>
    	<div class="cuerpoBox">
        	<?php echo $lstCargados; ?>
            
    	</div>
    </div>
    
    
   
</div>


</div>

<div id="dialog2" title="Eliminar <?php echo $singular; ?>">
    	<p>
        	<span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span>
            ¿Esta seguro que desea eliminar el <?php echo $singular; ?>?.<span id="proveedorEli"></span>
        </p>
        <p><strong>Importante: </strong>Si elimina el cargo solo le pondra una fecha de baja actual</p>
        <input type="hidden" value="" id="idEliminar" name="idEliminar">
</div>
<script type="text/javascript" src="../../js/jquery.dataTables.min.js"></script>
<script src="../../bootstrap/js/dataTables.bootstrap.js"></script>

<script src="../../js/bootstrap-datetimepicker.min.js"></script>
<script src="../../js/bootstrap-datetimepicker.es.js"></script>

<script type="text/javascript">
$(document).ready(function(){

	$('#fechacrea').val('<?php echo date('Y-m-d'); ?>');
	$('#fechamodi').val('');
	$('#usuacrea').val('<?php echo $_SESSION['nombre_predio']; ?>');
	$('#usuamodi').val('');
	
	$('.volver').click(function(event){
		 
		url = "index.php";
		$(location).attr('href',url);
	});//fin del boton modificar
	
	$('.varborrar').click(function(event){
		  usersid =  $(this).attr("id");
		  if (!isNaN(usersid)) {
			$("#idEliminar").val(usersid);
			$("#dialog2").dialog("open");

			
			//url = "../clienteseleccionado/index.php?idcliente=" + usersid;
			//$(location).attr('href',url);
		  } else {
			alert("Error, vuelva a realizar la acción.");	
		  }
	});//fin del boton eliminar


	$('.varmodificar').click(function(event){
		  usersid =  $(this).attr("id");
		  if (!isNaN(usersid)) {

			url = "modificarcargos.php?id=" + usersid;
			$(location).attr('href',url);
		  } else {
			alert("Error, vuelva a realizar la acción.");	
		  }
	});//fin del boton eliminar

	 $( "#dialog2" ).dialog({
		 	
			autoOpen: false,
			resizable: false,
			width:600,
			height:240,
			modal: true,
			buttons: {
				"Eliminar": function() {

					$.ajax({
								data:  {id: $('#idEliminar').val(), accion: '<?php echo $eliminar; ?>'},
								url:   '../../ajax/ajax.php',
								type:  'post',
								beforeSend: function () {
										
								},
								success:  function (response) {
										url = "cargos.php?id="+<?php echo $id; ?>;
										$(location).attr('href',url);
										
								}
						});
					$( this ).dialog( "close" );
					$( this ).dialog( "close" );
						$('html, body').animate({
							scrollTop: '1000px'
						},
						1500);
				},
				Cancelar: function() {
					$( this ).dialog( "close" );
				}
			}
	 
	 
		}); //fin del dialogo para eliminar
	



	
	
	//al enviar el formulario
    $('#cargar').click(function(){
		

			//información del formulario
			var formData = new FormData($(".formulario")[0]);
			var message = "";
			//hacemos la petición ajax  
			$.ajax({
				url: '../../ajax/ajax.php',  
				type: 'POST',
				// Form data
				//datos del formulario
				data: formData,
				//necesario para subir archivos via ajax
				cache: false,
				contentType: false,
				processData: false,
				//mientras enviamos el archivo
				beforeSend: function(){
					$("#load").html('<img src="../../imagenes/load13.gif" width="50" height="50" />');       
				},
				//una vez finalizado correctamente
				success: function(data){

					if (data == '') {
                                            $(".alert").removeClass("alert-danger");
											$(".alert").removeClass("alert-info");
                                            $(".alert").addClass("alert-success");
                                            $(".alert").html('<strong>Ok!</strong> Se genero exitosamente el <strong><?php echo $singular; ?></strong>. ');
											$(".alert").delay(3000).queue(function(){
												/*aca lo que quiero hacer 
												  después de los 2 segundos de retraso*/
												$(this).dequeue(); //continúo con el siguiente ítem en la cola
												
											});
											$("#load").html('');
											url = "cargos.php?id="+<?php echo $id; ?>;
											$(location).attr('href',url);
                                            
											
                                        } else {
                                        	$(".alert").removeClass("alert-danger");
                                            $(".alert").addClass("alert-danger");
                                            $(".alert").html('<strong>Error!</strong> '+data);
                                            $("#load").html('');
                                        }
				},
				//si ha ocurrido un error
				error: function(){
					$(".alert").html('<strong>Error!</strong> Actualice la pagina');
                    $("#load").html('');
				}
			});
		
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
 
    $( "#fechabaja" ).datepicker();

    $( "#fechabaja" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
	
	$( "#fechaalta" ).datepicker();

    $( "#fechaalta" ).datepicker( "option", "dateFormat", "yy-mm-dd" );

    $("#fechaalta").datepicker("setDate", "getDate" );

    $( "#fechabajatentativa" ).datepicker();

    $( "#fechabajatentativa" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
  });
  </script>
<?php } ?>
</body>
</html>
