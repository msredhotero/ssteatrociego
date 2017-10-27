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
$resMenu = $serviciosHTML->menu(utf8_encode($_SESSION['nombre_predio']),"Cooperativas",$_SESSION['refroll_predio'],$_SESSION['sede']);


$id = $_GET['id'];

$resResultado = $serviciosReferencias->traerCooperativasPorId($id);


/////////////////////// Opciones pagina ///////////////////////////////////////////////
$singular = "Cooperativa";

$plural = "Cooperativas";

$eliminar = "eliminarCooperativas";

$modificar = "modificarCooperativas";

$idTabla = "idcooperativa";

$tituloWeb = "Gestión: Teatro Ciego";
//////////////////////// Fin opciones ////////////////////////////////////////////////


/////////////////////// Opciones para la creacion del formulario  /////////////////////
$tabla 			= "dbcooperativas";

$lblCambio	 	= array("puntosproduccion","puntossinproduccion");
$lblreemplazo	= array("Puntos Prod.","Puntos S/Prod.");


$refdescripcion = array();
$refCampo 	=  array();
//////////////////////////////////////////////  FIN de los opciones //////////////////////////


$formulario 	= $serviciosFunciones->camposTablaModificar($id, $idTabla, $modificar,$tabla,$lblCambio,$lblreemplazo,$refdescripcion,$refCampo);


$lstContactos	= $serviciosFunciones->devolverSelectBox($serviciosReferencias->traerObras(),array(1),'');
$resContactos = $serviciosReferencias->traerObras();

$resContactosCountries = $serviciosReferencias->traerObrascooperativasPorCooperativa($id);


	while ($subrow = mysql_fetch_array($resContactosCountries)) {
			$arrayFS[] = $subrow;
	}



$cadUser = '<ul class="list-inline" id="lstObra">';
while ($rowFS = mysql_fetch_array($resContactos)) {
	$check = '';
	if (mysql_num_rows($resContactosCountries)>0) {
		foreach ($arrayFS as $item) {
			if (stripslashes($item['refobras']) == $rowFS[0]) {
				$check = 'checked';	
				$cadUser = $cadUser.'<li class="user'.$rowFS[0].'">'.'<input id="user'.$rowFS[0].'" '.$check.' class="form-control checkLstObras" type="checkbox" required="" style="width:50px;" name="user'.$rowFS[0].'"><p>'.$rowFS[1].'</p>'."</li>";
			}
		}
	}
	


}

$cadUser = $cadUser."</ul>";






$lstContactos2	= $serviciosFunciones->devolverSelectBox($serviciosReferencias->traerPersonal(),array(2,3,4),' - ');
$resContactos2 = $serviciosReferencias->traerPersonal();

$resContactosCountries2 = $serviciosReferencias->traerPersonalcooperativasPorCooperativa($id);


	while ($subrow2 = mysql_fetch_array($resContactosCountries2)) {
			$arrayFS2[] = $subrow2;
	}



$cadUser2 = '<ul class="list-inline" id="lstPersonal">';
while ($rowFS = mysql_fetch_array($resContactos2)) {
	$check = '';
	if (mysql_num_rows($resContactosCountries2)>0) {
		foreach ($arrayFS2 as $item) {
			if (stripslashes($item['refpersonal']) == $rowFS[0]) {
				$check = 'checked';	
				$cadUser2 = $cadUser2.'<li class="personal'.$rowFS[0].'">'.'<input id="personal'.$rowFS[0].'" '.$check.' class="form-control checkLstPersonal" type="checkbox" required="" style="width:50px;" name="personal'.$rowFS[0].'"><p>'.$rowFS[2].' '.$rowFS[3].' '.$rowFS[4].'</p>'."</li>";
			}
		}
	}
	


}

$cadUser = $cadUser."</ul>";

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
	<style type="text/css">
		
  
		
	</style>
    
   <link rel="stylesheet" href="../../css/chosen.css">
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
        	<p style="color: #fff; font-size:18px; height:16px;">Modificar <?php echo $singular; ?></p>
        	
        </div>
    	<div class="cuerpoBox">
        	<form class="form-inline formulario" role="form">
        	
			<div class="row">
			<?php echo $formulario; ?>
            </div>
            
            
            <div class='row' style="margin-left:25px; margin-right:25px;">
                <div class='alert'>
                
                </div>
                <div id='load'>
                
                </div>
            </div>
            
            <div class="row" id="contContacto" style="margin-left:0px; margin-right:25px;">
            	<div class="form-group col-md-6" style="display:'.$lblOculta.'">
                    <label for="buscarcontacto" class="control-label" style="text-align:left">Buscar Obras</label>
                    <div class="input-group col-md-12">
                        
                        <select data-placeholder="selecione la Obra..." id="buscarobra" name="buscarobra" class="chosen-select" tabindex="2" style="width:300px;">
                            <option value=""></option>
                            <?php echo $lstContactos; ?>
                        </select>
                        <button type="button" class="btn btn-success" id="asignarObra"><span class="glyphicon glyphicon-share-alt"></span> Asignar Obra</button>
                    </div>
                </div>
                
                <div class="form-group col-md-6">
                    <label for="contactosasignados" class="control-label" style="text-align:left">Obras Asignadas</label>
                    <div class="input-group col-md-12">
                        <?php echo $cadUser; ?>
                        
                    </div>
                </div>
                
            </div>
            
            <hr>
            
            <div class="row" id="contContacto" style="margin-left:0px; margin-right:25px;">
            	<div class="form-group col-md-6" style="display:'.$lblOculta.'">
                    <label for="buscarcontacto" class="control-label" style="text-align:left">Buscar Personas</label>
                    <div class="input-group col-md-12">
                        
                        <select data-placeholder="selecione la Persona..." id="buscarpersonal" name="buscarpersonal" class="chosen-select" tabindex="2" style="width:300px;">
                            <option value=""></option>
                            <?php echo $lstContactos2; ?>
                        </select>
                        <button type="button" class="btn btn-info" id="asignarPersonal"><span class="glyphicon glyphicon-share-alt"></span> Asignar Personal</button>
                    </div>
                </div>
                
                <div class="form-group col-md-6">
                    <label for="contactosasignados" class="control-label" style="text-align:left">Personal Asignado</label>
                    <div class="input-group col-md-12">
                        <ul class="list-inline" id="lstPersonal">
                        	<?php echo $cadUser2; ?>
                        </ul>
                        
                    </div>
                </div>
                
            </div>
            
            
            <div class="row">
                <div class="col-md-12">
                <ul class="list-inline" style="margin-top:15px;">
                    <li>
                        <button type="button" class="btn btn-warning" id="cargar" style="margin-left:0px;">Modificar</button>
                    </li>
                    <li>
                        <button type="button" class="btn btn-danger varborrar" id="<?php echo $id; ?>" style="margin-left:0px;">Eliminar</button>
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
    
    
   
</div>


</div>

<div id="dialog2" title="Eliminar <?php echo $singular; ?>">
    	<p>
        	<span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span>
            ¿Esta seguro que desea eliminar el <?php echo $singular; ?>?.<span id="proveedorEli"></span>
        </p>
        <p><strong>Importante: </strong>Si elimina el equipo se perderan todos los datos de este</p>
        <input type="hidden" value="" id="idEliminar" name="idEliminar">
</div>
<script type="text/javascript" src="../../js/jquery.dataTables.min.js"></script>
<script src="../../bootstrap/js/dataTables.bootstrap.js"></script>

<script src="../../js/bootstrap-datetimepicker.min.js"></script>
<script src="../../js/bootstrap-datetimepicker.es.js"></script>

<script type="text/javascript">
$(document).ready(function(){

	<?php
		$serviciosFunciones->jsBit('activo',mysql_result($resResultado,0,'activo'));
	?>
	
	$('#asignarObra').click(function(e) {
		//alert($('#buscarcontacto option:selected').html());
		if (existeAsiganado('user'+$('#buscarobra').chosen().val()) == 0) {
			$('#lstObra').prepend('<li class="user'+ $('#buscarobra').chosen().val() +'"><input id="user'+ $('#buscarobra').chosen().val() +'" class="form-control checkLstObras" checked type="checkbox" required="" style="width:50px;" name="user'+ $('#buscarobra').chosen().val() +'"><p>' + $('#buscarobra option:selected').html() + ' </p></li>');
		}
	});
	
	
	function existeAsiganado(id) {
		var existe = 0;	
		$('#lstObra li input').each(function (index, value) { 
		  if (id == $(this).attr('id')) {
			return existe = 1;  
		  }
		});
		
		return existe;
	}
	
	$("#lstObra").on("click",'.checkLstObras', function(){
		usersid =  $(this).attr("id");
		
		if  (!($(this).prop('checked'))) {
			$('.'+usersid).remove();	
		}
	});
	
	
	
	$('#asignarPersonal').click(function(e) {
		//alert($('#buscarcontacto option:selected').html());
		if (existeAsiganadoPersonal('personal'+$('#buscarpersonal').chosen().val()) == 0) {
			$('#lstPersonal').prepend('<li class="personal'+ $('#buscarpersonal').chosen().val() +'"><input id="personal'+ $('#buscarpersonal').chosen().val() +'" class="form-control checkLstPersonal" checked type="checkbox" required="" style="width:50px;" name="personal'+ $('#buscarpersonal').chosen().val() +'"><p>' + $('#buscarpersonal option:selected').html() + ' </p></li>');
		}
	});
	
	
	function existeAsiganadoPersonal(id) {
		var existe = 0;	
		$('#lstPersonal li input').each(function (index, value) { 
		  if (id == $(this).attr('id')) {
			return existe = 1;  
		  }
		});
		
		return existe;
	}
	
	$("#lstPersonal").on("click",'.checkLstPersonal', function(){
		usersid =  $(this).attr("id");
		
		if  (!($(this).prop('checked'))) {
			$('.'+usersid).remove();	
		}
	});
	
	
	$('#fechacreacion').val('<?php echo mysql_result($resResultado,0,'fechacreacion'); ?>');
	$('#fechamodi').val('<?php echo date('Y-m-d'); ?>');
	$('#usuacrea').val('<?php echo mysql_result($resResultado,0,'usuacrea'); ?>');
	$('#usuamodi').val('<?php echo $_SESSION['nombre_predio']; ?>');
	
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
											url = "index.php";
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
	
	
	<?php 
		echo $serviciosHTML->validacion($tabla);
	
	?>
	

	
	
	//al enviar el formulario
    $('#cargar').click(function(){
		
		if (validador() == "")
        {
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
                                            $(".alert").html('<strong>Ok!</strong> Se modifico exitosamente el <strong><?php echo $singular; ?></strong>. ');
											$(".alert").delay(3000).queue(function(){
												/*aca lo que quiero hacer 
												  después de los 2 segundos de retraso*/
												$(this).dequeue(); //continúo con el siguiente ítem en la cola
												
											});
											$("#load").html('');
											//url = "index.php";
											//$(location).attr('href',url);
                                            
											
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
		}
    });

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

<script src="../../js/chosen.jquery.js" type="text/javascript"></script>
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
