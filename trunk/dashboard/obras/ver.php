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
$resMenu = $serviciosHTML->menu(utf8_encode($_SESSION['nombre_predio']),"Obras",$_SESSION['refroll_predio'],$_SESSION['sede']);


$id = $_GET['id'];

$resResultado = $serviciosReferencias->traerObrasPorId($id);


/////////////////////// Opciones pagina ///////////////////////////////////////////////
$singular = "Obra";

$plural = "Obras";

$eliminar = "eliminarObras";

$modificar = "modificarObras";

$idTabla = "idobra";

$tituloWeb = "Gestión: Teatro Ciego";
//////////////////////// Fin opciones ////////////////////////////////////////////////


/////////////////////// Opciones para la creacion del formulario  /////////////////////
$tabla 			= "dbobras";

$lblCambio	 	= array("refsalas","valorentrada","cantpulicidad","valorpulicidad","valorticket","costotranscciontarjetaiva","porcentajeargentores","porcentajereparto","porcentajeretencion");
$lblreemplazo	= array("Sala","Valor Entrada","Cant. para Publicidad","Valor Publicidad","Valor Ticket","Costo Trans. Tarj. IVA","% Argentores","% Reparto","% Retencion");

$resSalas	=	$serviciosReferencias->traerSalas();
$cadRef 	= 	$serviciosFunciones->devolverSelectBoxActivo($resSalas,array(1),'',mysql_result($resResultado,0,'refsalas'));

$refdescripcion = array(0=>$cadRef);
$refCampo 	=  array("refsalas");
//////////////////////////////////////////////  FIN de los opciones //////////////////////////





$formulario 	= $serviciosFunciones->camposTablaVer($id, $idTabla,$tabla,$lblCambio,$lblreemplazo,$refdescripcion,$refCampo);

$resGastos		= $serviciosReferencias->traerGastosobrasPorObra($id);

$resPromos		= $serviciosReferencias->traerPromosobrasActivosPorObra($id);

$resCategorias	= $serviciosReferencias->traerCategoriasPorObra($id);

$resAlbum		= $serviciosReferencias->traerAlbumobrasPorObra($id);

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
    
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBzxyoH5wuPmahQIZLUBjPfDuu_cUHUBQY"
  type="text/javascript"></script>
    <style type="text/css">
		#map
		{
			width: 100%;
			height: 600px;
			border: 1px solid #d0d0d0;
		}
  		body p {
			text-decoration:none;
			font-weight:normal;	
		}
		
	</style>
   
</head>

<body>

 <?php echo $resMenu; ?>

<div id="content">

<h3><?php echo $plural; ?></h3>

    <div class="boxInfoLargo">
        <div id="headBoxInfo">
        	<p style="color: #fff; font-size:18px; height:16px;">Ver <?php echo $singular; ?></p>
        	
        </div>
    	<div class="cuerpoBox">
        	<form class="form-inline formulario" role="form">
        	
			<div class="row">
			<?php echo $formulario; ?>
            </div>
            <hr>
            <div class="row">
            	<div class="col-md-12">
            	<p>Gastos</p>
                <table class="table table-bordered table-striped">
                	<thead>
                    	<th>Descripción</th>
                        <th>Monto</th>
                    </thead>
                    <tbody>
                    	<?php 
							$total = 0;
							while ($row = mysql_fetch_array($resGastos)) {
								$total += $row['monto'];
						?>
                        <tr>
                    	<td><?php echo $row['descripcion']; ?></td>
                        <td><?php echo number_format($row['monto'],2,'.',','); ?></td>
                        </tr>
                        <?php
							}
						?>
                    </tbody>
                    <tfoot>
                    	<td>Total:</td>
                        <td><?php echo number_format($total,2,'.',','); ?></td>
                    </tfoot>
                </table>
                </div>
            </div>
            
            
            <hr>
            <div class="row">
            	<div class="col-md-12">
            	<p>Promos</p>
                <table class="table table-bordered table-striped">
                	<thead>
                    	<th>Descripción</th>
                        <th>Porcentaje</th>
                        <th>Monto</th>
                    </thead>
                    <tbody>
                    	<?php 
							
							while ($row = mysql_fetch_array($resPromos)) {
								
						?>
                        <tr>
                    	<td><?php echo $row['descripcion']; ?></td>
                        <td><?php echo '% '.number_format($row['porcentaje'],2,'.',','); ?></td>
                        <td><?php echo number_format($row['monto'],2,'.',','); ?></td>
                        </tr>
                        <?php
							}
						?>
                    </tbody>

                </table>
                </div>
            </div>
            
            
            
            <hr>
            <div class="row">
            	<div class="col-md-12">
            	<p>Categorias</p>
                <table class="table table-bordered table-striped">
                	<thead>
                    	<th>Descripción</th>
                        <th>Cuponera</th>
                        <th>Porcentaje</th>
                        <th>Monto</th>
                        <th>Pocentaje Retenido</th>
                    </thead>
                    <tbody>
                    	<?php 
							
							while ($row = mysql_fetch_array($resCategorias)) {
						?>
                        <tr>
                    	<td><?php echo $row['descripcion']; ?></td>
                        <td><?php echo $row['cuponera']; ?></td>
                        <td><?php echo '% '.number_format($row['porcentaje'],2,'.',','); ?></td>
                        <td><?php echo number_format($row['monto'],2,'.',','); ?></td>
                        <td><?php echo '% '.number_format($row['pocentajeretenido'],2,'.',','); ?></td>
                        </tr>
                        <?php
							}
						?>
                    </tbody>

                </table>
                </div>
            </div>

            <hr>
            <div class="row">
            	<div class="col-md-12">
            	<p>Album</p>
                <table class="table table-bordered table-striped">
                	<thead>
                    	<th>Banda</th>
                        <th>Album</th>
                    </thead>
                    <tbody>
                    	<?php 
							
							while ($row = mysql_fetch_array($resAlbum)) {
								
						?>
                        <tr>
                    	<td><?php echo $row['banda']; ?></td>
						<td><?php echo $row['album']; ?></td>
                        </tr>
                        <?php
							}
						?>
                    </tbody>

                </table>
                </div>
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
                        <button type="button" class="btn btn-warning modificar" id="<?php echo $id; ?>" style="margin-left:0px;">Modificar</button>
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




<script type="text/javascript" src="../../js/jquery.dataTables.min.js"></script>
<script src="../../bootstrap/js/dataTables.bootstrap.js"></script>

<script src="../../js/bootstrap-datetimepicker.min.js"></script>
<script src="../../js/bootstrap-datetimepicker.es.js"></script>

<script type="text/javascript">
$(document).ready(function(){

	$('.volver').click(function(event){
		 
		url = "index.php";
		$(location).attr('href',url);
	});//fin del boton modificar
	

	$('.modificar').click(function(event){
		 
		usersid =  $(this).attr("id");
		  if (!isNaN(usersid)) {
			
			url = "modificar.php?id=" + usersid;
			$(location).attr('href',url);
		  } else {
			alert("Error, vuelva a realizar la acción.");	
		  }
	});//fin del boton modificar
	
	

});
</script>


<?php } ?>
</body>
</html>
