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
$resMenu = $serviciosHTML->menu($_SESSION['nombre_predio'],"Boleteria",$_SESSION['refroll_predio'],'');


/////////////////////// Opciones pagina ///////////////////////////////////////////////
$singular = "Venta";

$plural = "Ventas";

$eliminar = "eliminarVentas";

$insertar = "insertarVentas";

$tituloWeb = "Gestión: Teatro Ciego";
//////////////////////// Fin opciones ////////////////////////////////////////////////


/////////////////////// Opciones para la creacion del formulario  /////////////////////
$tabla 			= "dbventas";

$lblCambio	 	= array();
$lblreemplazo	= array();


$cadRef 	= '';

$refdescripcion = array();
$refCampo 	=  array();
//////////////////////////////////////////////  FIN de los opciones //////////////////////////




/////////////////////// Opciones para la creacion del view  apellido,nombre,nrodocumento,fechanacimiento,direccion,telefono,email/////////////////////
$cabeceras 		= "	<th>Descripcion</th>
					<th>Obra</th>
					<th>Vig. Desde</th>
					<th>Vig. Hasta</th>
					<th>Porccentaje</th>
					<th>Monto</th>";
$cabeceras2 		= "	<th>Numero</th>
                    <th>Fecha</th>
                    <th>Tipo Pago</th>
					<th>Total</th>
					<th>Cliente</th>
                    <th>Cancelada</th>";	
//////////////////////////////////////////////  FIN de los opciones //////////////////////////




$lstTipoPago  = $serviciosFunciones->devolverSelectBox( $serviciosReferencias->traerTipopago(),array(1),'');
$lstFunciones = $serviciosFunciones->devolverSelectBox( $serviciosReferencias->traerObras(),array(1,3),' - Valor Entrada:');

$lstVentas	= $serviciosFunciones->camposTablaView($cabeceras2, $serviciosReferencias->traerVentasPorDia(date('Y-m-d')),96);



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
    
    <style>
		option {
			padding: 2px 3px;
		}
	</style>
    
 
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
				<div class="form-group col-md-6" style="display:block">
                	<label class="control-label" for="codigobarra" style="text-align:left">Función <span style="color:#F00;">*</span></label>
                    <div class="input-group col-md-12">
	                    <select data-placeholder="selecione la Obra..." id="refobras" name="refobras" class="chosen-select" tabindex="2" style="width:100%;">
                            
                            <?php echo $lstFunciones; ?>
                        </select>
                    </div>
                </div>
                
                
                <div class="form-group col-md-4" style="display:block">
                	<label class="control-label" for="codigobarra" style="text-align:left">Tipo Pago <span style="color:#F00;">*</span></label>
                    <div class="input-group col-md-12">
	                    <select data-placeholder="selecione el Tipo de Pago..." id="reftipopago" name="reftipopago" class="chosen-select" tabindex="2" style="width:100%;">
                            
                            <?php echo $lstTipoPago; ?>
                        </select>
                    </div>
                </div>
                
                
                <div class="form-group col-md-2 col-xs-4" style="display:block">
                    <label for="vigenciadesde" class="control-label" style="text-align:left">Fecha</label>
                    <div class="input-group col-md-12 col-xs-12">
                        <input class="form-control" name="fecha" id="fecha" type="text" value="<?php echo date('Y-m-d'); ?>"/>
                    </div>
                    
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-2" style="display:block">
                	<label class="control-label" for="codigobarra" style="text-align:left">Cantidad</label>
                    <div class="input-group col-md-12">
	                    <input id="cantidadbuscar" class="form-control" name="cantidadbuscar" placeholder="Cantidad..." required type="number" value="1">
                    </div>
                </div>
                
                <div class="form-group col-md-5" style="display:block">
                	<label class="control-label" for="codigobarra" style="text-align:left">Album</label>
                    <div class="input-group col-md-12">
	                    <select data-placeholder="selecione el Album..." id="refalbum" name="refalbum" class="form-control" />
                            
                            
                        </select>
                    </div>
                </div>
                
                
                <div class="form-group col-md-5" style="display:block">
                	<label class="control-label" for="codigobarra" style="text-align:left">Categorias - Promociones</label>
                    <div class="input-group col-md-12">
	                    <select placeholder="selecione la Categoria..." id="refcategoriaspromociones" name="refcategoriaspromociones" class="form-control" />
                            
                            
                        </select>
                    </div>
                </div>
                
                <div class="row">
                <div class="col-md-12">
                <ul class="list-inline" style="margin-left:15px;">
                    <li>
                    	Total:
                    </li>
                    <li>
						<input id="total" style="padding:12px; font-size:1.5em; width:150px;" name="total" placeholder="Paga con..." readonly required type="text" value="0">
                    </li>
                    <li>
                    	Paga con:
                    </li>
                    <li>
						<input id="paga" style="padding:12px; font-size:1.5em; width:150px;" name="paga" placeholder="Paga con..." required type="text" value="0">
                    </li>
                    <li>
                    	Su vuelto:
                    </li>
                    <li>
						<input id="vuelto" style="padding:12px; font-size:1.5em; width:150px;" name="vuelto" readonly placeholder="Su vuelto..." required type="text" value="0">
                    </li>
                    
                </ul>
                </div>
            </div>
            
            </div>
                

           

            <div class='row' style="margin-left:25px; margin-right:25px;">
                <div class='alert'>
                
                </div>
                <div id='load'>
                
                </div>
            </div>
            <input type="hidden" id="accion" name="accion" value="<?php echo $insertar; ?>"/>
            <div class="row">
                <div class="col-md-12">
                <ul class="list-inline" style="margin-top:15px;">
                    <li>
                        <button type="button" class="btn btn-primary" id="cargar" style="margin-left:0px;">Guardar</button>
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
        	<?php echo $lstVentas; ?>
            
    	</div>
    </div>
    
    

    
    
   
</div>


</div>
<div id="dialog2" title="Eliminar <?php echo $singular; ?>">
    	<p>
        	<span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span>
            ¿Esta seguro que desea eliminar el <?php echo $singular; ?>?.<span id="proveedorEli"></span>
        </p>
        <p><strong>Importante: </strong>Si elimina el <?php echo $singular; ?> se perderan todos los datos de este</p>
        <input type="hidden" value="" id="idEliminar" name="idEliminar">
</div>
<script type="text/javascript" src="../../js/jquery.dataTables.min.js"></script>
<script src="../../bootstrap/js/dataTables.bootstrap.js"></script>

<script src="../../js/bootstrap-datetimepicker.min.js"></script>
<script src="../../js/bootstrap-datetimepicker.es.js"></script>

<script type="text/javascript">
$(document).ready(function(){
	var table = $('#example').dataTable({
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
	
	
	function devolverPosicionPromos() {
		var i = 0;
		$("#refcategoriaspromociones").each(function(){

			$(this).children("option").each(function(){
				i = i + 1;
				if ( $(this).html() == '--- Promociones ---') {
						
					return false;
				}
				
			});
		});	
		return i;
	}
	
	$('#refcategoriaspromociones').change(function() {
		var indiceSelect = $(this).prop('selectedIndex');
		alert(devolverPosicionPromos());
		if (indiceSelect > devolverPosicionPromos()) {
			//voy por las promociones	
			alert($('#refcategoriaspromociones option:eq('+indiceSelect+')').val());  // To select via value
		} else {
			//voy por las categorias
			alert($('#refcategoriaspromociones option:eq('+indiceSelect+')').val());  // To select via value
		}
	});
	
	$('#fechacreacion').val('<?php echo date('Y-m-d'); ?>');
	$('#fechamodi').val('');
	$('#usuacrea').val('<?php echo $_SESSION['nombre_predio']; ?>');
	$('#usuamodi').val('');

	
	$("#example").on("click",'.varborrar', function(){
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
	
	$("#example").on("click",'.varmodificar', function(){
		  usersid =  $(this).attr("id");
		  if (!isNaN(usersid)) {
			
			url = "modificar.php?id=" + usersid;
			$(location).attr('href',url);
		  } else {
			alert("Error, vuelva a realizar la acción.");	
		  }
	});//fin del boton modificar
	
	
	function traerAutocomplete(idObra, funcion, contenedor) {
		$.ajax({
			data:  {idObra: idObra, accion: funcion},
					url:   '../../ajax/ajax.php',
					type:  'post',
			beforeSend: function () {
			
			},
			success:  function (response) {
				$('#'+contenedor).html(response);
			
			}
		});		
	}
	
	function generarTotal(idDescuento, funcion, contenedor) {
		$.ajax({
			data:  {id: idDescuento, accion: funcion},
					url:   '../../ajax/ajax.php',
					type:  'post',
			beforeSend: function () {
			
			},
			success:  function (response) {
				$('#total').html($('#total').val());
			
			}
		});		
	}

	$('#refobras').change(function() {
		traerAutocomplete($(this).val(), 'traerCategoriasPromocionesPorObras', 'refcategoriaspromociones');
		traerAutocomplete($(this).val(), 'traerAlbumPorObras', 'refalbum');	
	});
	


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
                                            $(".alert").html('<strong>Ok!</strong> Se cargo exitosamente el <strong><?php echo $singular; ?></strong>. ');
											$(".alert").delay(3000).queue(function(){
												/*aca lo que quiero hacer 
												  después de los 2 segundos de retraso*/
												$(this).dequeue(); //continúo con el siguiente ítem en la cola
												
											});
											$("#load").html('');
											url = "index.php";
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
		}
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
 
    $( "#fecha" ).datepicker();

    $( "#fecha" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
	$( "#fecha" ).datepicker("setDate", 'getDate');
	

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
