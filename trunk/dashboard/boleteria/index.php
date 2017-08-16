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
                    <th>Obra</th>
                    <th>Dia</th>
					<th>Horario</th>
					<th>Fecha</th>
					<th>Cantidad Entradas</th>
					<th>Valor Entrada</th>
					<th>Total</th>
                    <th>Total Efectivo</th>
					<th>Total Tarjeta</th>
					<th>Cancelada</th>
					<th>Banda</th>
					<th>Album</th>";	
//////////////////////////////////////////////  FIN de los opciones //////////////////////////




$lstTipoPago  = $serviciosFunciones->devolverSelectBox( $serviciosReferencias->traerTipopago(),array(1),'');
$lstFunciones = $serviciosFunciones->devolverSelectBox( $serviciosReferencias->traerFunciones(),array(3,4,5),' - ');

$lstVentas	= $serviciosFunciones->camposTablaView($cabeceras2, $serviciosReferencias->traerVentasPorDia(date('Y-m-d')),13);



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
    
    <style>
   	.dropdown-menu {
  max-height: 500px;
  overflow-y: auto;
  overflow-x: hidden;
  z-index:999999999999;
 }
	.clickable{
    cursor: pointer;   
	}
	
	.panel-heading span {
		margin-top: -20px;
		font-size: 15px;
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
            
        	<div class='row' style="margin-left:25px; margin-right:25px;">
				
            <div class="panel panel-primary panel1">
				
                <div class="panel-heading">
					<h3 class="panel-title">Paso 1</h3>
					<span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-up"></i></span>
				</div>
                
                <div class="panel-body" id="primero">
                	<div class="form-group col-md-6" style="display:block">
                        <label class="control-label" for="codigobarra" style="text-align:left">Función <span style="color:#F00;">*</span></label>
                        <div class="input-group col-md-12">
                            <select data-placeholder="selecione la Función..." id="reffunciones" name="reffunciones" class="form-control" tabindex="2">
                                
                                <?php echo $lstFunciones; ?>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group col-md-2 col-xs-4" style="display:block">
                        <label for="vigenciadesde" class="control-label" style="text-align:left">Fecha</label>
                        <div class="input-group col-md-12 col-xs-12">
                            <input class="form-control" name="fecha" id="fecha" type="text" value="<?php echo date('Y-m-d'); ?>"/>
                        </div>
                        
                    </div>
                    
                    <div class="form-group col-md-2 col-xs-4" style="display:block">
                        <label for="vigenciadesde" class="control-label" style="text-align:left">Nro Venta</label>
                        <div class="input-group col-md-12 col-xs-12">
                            <input class="form-control" readonly name="numero" id="numero" type="text" value="<?php echo $serviciosReferencias->generarNroVenta(); ?>"/>
                        </div>
                        
                    </div>
                    
                    
                    <div class="form-group col-md-2 col-xs-4" style="display:block">
                        <label for="vigenciadesde" class="control-label" style="text-align:left">Valor Entrada</label>
                        <div class="input-group col-md-12 col-xs-12">
                            <input class="form-control" readonly name="valorentrada" id="valorentrada" type="text" value="0"/>
                        </div>
                        
                    </div>
                    
                    <div class="form-group col-md-2 col-xs-4" style="display:block">
                    	<button type="button" class="btn btn-succes" id="siguiente1" style="margin-left:0px;">Siguiente</button>
                    </div>
                    
				</div> <!-- fin del panel-body -->
            </div><!-- fin del panel -->
            </div><!-- fin del row -->
            
            <div class='row panel2' style="margin-left:0px; margin-right:0px; display:none;">
				<div class="panel panel-default" id="panel2">
				<div class="panel-heading">
					<h3 class="panel-title">Paso 2 (Cuponeras - Album)</h3>
					<span class="pull-right clickable panel-collapsed"><i class="glyphicon glyphicon-chevron-down"></i></span>
				</div>
                <div class="panel-body collapse" id="segundo">
                    <div class="form-group col-md-4" style="display:block">
                        <label class="control-label" for="codigobarra" style="text-align:left">Cantidad Entradas</label>
                        <div class="input-group col-md-12">
                            <input id="cantidadbuscar" class="form-control" name="cantidadbuscar" placeholder="Cantidad..." required type="number" value="1">
                        </div>
                    </div>
                    
                    
                    
                    <div id="lstCuponeras">
                    
                    
                    </div>
                    
                    <div class="form-group col-md-5" style="display:block">
                        <label class="control-label" for="codigobarra" style="text-align:left">Album</label>
                        <div class="input-group col-md-12">
                            <select data-placeholder="selecione el Album..." id="refalbum" name="refalbum" class="form-control" />
                                
                                
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group col-md-2 col-xs-4" style="display:block">
                    	<button type="button" class="btn btn-succes" id="siguiente2" style="margin-left:0px;">Siguiente</button>
                    </div>
                    
				</div> <!-- fin del panel-body -->
            </div><!-- fin del panel -->
            </div><!-- fin del row -->
            
            
            <div class='row panel3' style="margin-left:0px; margin-right:0px;display:none;">
				<div class="panel panel-default" id="panel3">
				
                    <div class="panel-heading">
                        <h3 class="panel-title">Paso 3 (Actores)</h3>
                        <span class="pull-right clickable panel-collapsed"><i class="glyphicon glyphicon-chevron-down"></i></span>
                    </div>
                    
                    <div class="panel-body collapse" id="tercero">
                        <div id="lstPersonal">
                        
                        
                        </div>
                        <div class="form-group col-md-2 col-xs-4" style="display:block">
                            <button type="button" class="btn btn-succes" id="siguiente3" style="margin-left:0px;">Siguiente</button>
                        </div>
                    </div>
            	</div>
            </div>
            
            <div class='row panel4' style="margin-left:0px; margin-right:0px;display:none;">
				<div class="panel panel-default" id="panel4">
				
                    <div class="panel-heading">
                        <h3 class="panel-title">Paso 4 (Montos)</h3>
                        <span class="pull-right clickable panel-collapsed"><i class="glyphicon glyphicon-chevron-down"></i></span>
                    </div>
                    
                    <div class="panel-body collapse" id="cuarto">
                        <div class="form-group col-md-4" style="display:block">
                            <label class="control-label" for="codigobarra" style="text-align:left">Total Efectivo</label>
                            <div class="input-group col-md-12">
                                <span class="input-group-addon">$</span>
                                <input id="totalefectivo" class="form-control" name="totalefectivo" placeholder="Total Efectivo..." required type="text" value="0">
                                <span class="input-group-addon">0.00</span>
                            </div>
                        </div>
                        
                        <div class="form-group col-md-4" style="display:block">
                            <label class="control-label" for="codigobarra" style="text-align:left">Total Tarjeta</label>
                            <div class="input-group col-md-12">
                                <span class="input-group-addon">$</span>
                                <input id="totaltarjeta" class="form-control" name="totaltarjeta" placeholder="Total Tarjeta..." required type="text" value="0">
                                <span class="input-group-addon">0.00</span>
                            </div>
                        </div>
                        
                        <div class="form-group col-md-4" style="display:block">
                            <label class="control-label" for="codigobarra" style="text-align:left">Total</label>
                            <div class="input-group col-md-12">
                                <span class="input-group-addon">$</span>
                                <input id="total" class="form-control" name="total" placeholder="Total..." required type="text" value="0">
                                <span class="input-group-addon">0.00</span>
                            </div>
                        </div>
                        
                        <div class="form-group col-md-12" style="display:block">
                            <label class="control-label" for="codigobarra" style="text-align:left">Observaciones</label>
                            <div class="input-group col-md-12">
                                <textarea type="text" rows="5" cols="6" class="form-control" id="observaciones" name="observaciones" placeholder="Ingrese las Observaciones..." required=""></textarea>
                            </div>
                        </div>
                        
                        <div class="form-group col-md-2 col-xs-4" style="display:block">
                            <button type="button" class="btn btn-succes" id="siguiente4" style="margin-left:0px;">Siguiente</button>
                        </div>
                        
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
            <input type="hidden" id="refcategorias" name="refcategorias" value="0"/>
            <input type="hidden" id="refpromosobras" name="refpromosobras" value="0"/>
            <input type="hidden" name="usuario" id="usuario" value="<?php echo utf8_encode($_SESSION['nombre_predio']); ?>" />
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
			data:  {id: idObra, accion: funcion},
					url:   '../../ajax/ajax.php',
					type:  'post',
			beforeSend: function () {
			
			},
			success:  function (response) {
				$('#'+contenedor).append(response);
			
			}
		});		
	}
	
	function traerAutocompleteVal(idObra, funcion, contenedor) {
		$.ajax({
			data:  {id: idObra, accion: funcion},
					url:   '../../ajax/ajax.php',
					type:  'post',
			beforeSend: function () {
			
			},
			success:  function (response) {
				$('#'+contenedor).val(response);
			
			}
		});		
	}
	
	function generarTotal(idDescuento, tipoDescuento, idObra, cantidad) {
		$.ajax({
			data:  {id: idDescuento, 
					tipoDescuento: tipoDescuento, 
					idObra: idObra,
					cantidad: cantidad,
					accion: 'traerTotal'},
					url:   '../../ajax/ajax.php',
					type:  'post',
			beforeSend: function () {
			
			},
			success:  function (response) {
				$('#total').val(response);
			
			}
		});		
	}
	
	$('#siguiente1').click(function(e) {

        $(this).removeClass('btn-primary').addClass('btn-success');
		$('.panel2').show();
		$('#panel2').removeClass('panel-default').addClass('panel-primary');
		$('.panel1').removeClass('panel-primary').addClass('panel-success');
		
		$('#panel2').find('.panel-body').slideDown();
		$('#panel2').removeClass('panel-collapsed');
		$('#panel2').find('i').removeClass('glyphicon-chevron-down').addClass('glyphicon-chevron-up');
			
		
    });
	
	
	$('#siguiente2').click(function(e) {

        $(this).removeClass('btn-primary').addClass('btn-success');
		$('.panel3').show();
		$('#panel3').removeClass('panel-default').addClass('panel-primary');
		$('#panel2').removeClass('panel-primary').addClass('panel-success');
		
		$(this).parents('.panel').find('.panel-body').slideUp();
		$(this).addClass('panel-collapsed');
		$(this).find('i').removeClass('glyphicon-chevron-up').addClass('glyphicon-chevron-down');
		
		
		$('#panel3').find('.panel-body').slideDown();
		$('#panel3').removeClass('panel-collapsed');
		$('#panel3').find('i').removeClass('glyphicon-chevron-down').addClass('glyphicon-chevron-up');
    });
	
	
	$('#siguiente3').click(function(e) {

        $(this).removeClass('btn-primary').addClass('btn-success');
		$('.panel4').show();
		$('#panel4').removeClass('panel-default').addClass('panel-primary');
		$('#panel3').removeClass('panel-primary').addClass('panel-success');
		
		$(this).parents('.panel').find('.panel-body').slideUp();
		$(this).addClass('panel-collapsed');
		$(this).find('i').removeClass('glyphicon-chevron-up').addClass('glyphicon-chevron-down');
		
		$('#panel4').find('.panel-body').slideDown();
		$('#panel4').removeClass('panel-collapsed');
		$('#panel4').find('i').removeClass('glyphicon-chevron-down').addClass('glyphicon-chevron-up');
    });
	
	
	$('#siguiente4').click(function(e) {
		$(this).removeClass('btn-primary').addClass('btn-success');

		$('#panel4').removeClass('panel-primary').addClass('panel-success');
		
		$(this).parents('.panel').find('.panel-body').slideUp();
		$(this).addClass('panel-collapsed');
		$(this).find('i').removeClass('glyphicon-chevron-up').addClass('glyphicon-chevron-down');
		
		$('#cargar').show();	
	});
	
	$('#reffunciones').change(function() {
		
		$('.panel2').hide();
		$('.panel3').hide();
		$('.panel4').hide();
		
		$('#siguiente1').removeClass('btn-success').addClass('btn-primary');
		$('#siguiente2').removeClass('btn-success').addClass('btn-primary');
		$('#siguiente3').removeClass('btn-success').addClass('btn-primary');
		$('#siguiente4').removeClass('btn-success').addClass('btn-primary');
		
		$('#panel2').removeClass('panel-success').addClass('panel-primary');
		$('#panel3').removeClass('panel-success').addClass('panel-primary');
		$('#panel4').removeClass('panel-success').addClass('panel-primary');
		
		$('#cargar').hide();
		
		$('#lstCuponeras').html('');
		$('#lstPersonal').html('');
		
		//cuponeras y promos		
		traerAutocomplete($(this).val(), 'traerCategoriasPorFuncion', 'lstCuponeras');
		traerAutocomplete($(this).val(), 'traerPromosObrasPorFuncion', 'lstCuponeras');	

		//valor entrada
		traerAutocompleteVal($(this).val(), 'traerValorEntradaPorFuncion', 'valorentrada');
		
		//personal
		traerAutocomplete($(this).val(), 'traerPlantelPorFuncion', 'lstPersonal');	
		
		$('#total').val(0);
		$('#totalefectivo').val(0);
		$('#totaltarjeta').val(0);

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
