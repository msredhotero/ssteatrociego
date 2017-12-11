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


if ($_SESSION['idroll_predio'] == 2) {
    $columnas = 4;
} else {
    $columnas = 3;
}
if ($_SESSION['idroll_predio'] == 3) {

    $sumTotalEfectivoAnual = 0;
    $sumTotalTarjetasAnual = 0;

    $resDatosActor = $serviciosReferencias->traerDatosObrasFuncionesPorActor($_SESSION['idpersonal']); 

    $resSumDatosActor = $serviciosReferencias->traerDatosSumObrasFuncionesPorActor($_SESSION['idpersonal']);

    $resDetalleObrasPorActor = $serviciosReferencias->traerDatosObrasPorActor($_SESSION['idpersonal']);

    $resDetalleCooperativasPorActor = $serviciosReferencias->traerDatosCooperativasPorActor($_SESSION['idpersonal']);

    $resDatosActorAux = $serviciosReferencias->traerDatosObrasFuncionesPorActor($_SESSION['idpersonal']); 

    $resDatosActorAuxEstadisticas = $serviciosReferencias->traerDatosObrasFuncionesPorActor($_SESSION['idpersonal']); 


    $month = date('Y-m');
	$aux = date('Y-m-d', strtotime("{$month} + 1 month"));
	$last_day = date('Y-m-d', strtotime("{$aux} - 1 day"));
	
	//echo "El último día del mes es: {$last_day}";
	
	$total = 0;
	while ($row = mysql_fetch_array($resDatosActorAux)) {
		$resCalculo = $serviciosReferencias->calcularPuntoPorFuncionDesdeHasta($_SESSION['idpersonal'],$row['idfuncion'], date('Y-m').'-01', $last_day);
		if (mysql_num_rows($resCalculo)>0) {
			$total += mysql_result($resCalculo, 0,0);    
		}
	}
	
	
	$estadistica = '';
	$fechaCalculo = '';
	
	$totalMesual = 0;
	
	$totalParcial = array();
	
	while ($row = mysql_fetch_array($resDatosActorAuxEstadisticas)) {
		for ($i=1;$i<=12;$i++) {


			$month = date('Y-').substr('0'.$i,-2);
            if ($i==12) {
			    $fechaCalculo = (date('Y') + 1).'-01-01';
			    $aux = date($fechaCalculo, strtotime("{$month} + 1 month"));
            } else {
                $fechaCalculo = date('Y').'-'.substr('0'.($i + 1),-2).'-01';
                $aux = date($fechaCalculo, strtotime("{$month} + 1 month"));    
            }
			$last_day = date('Y-m-d', strtotime("{$aux} - 1 day"));
            /*
            if ($i==12) {
                echo $month.'<br>';
                echo $fechaCalculo.'<br>';
                echo $aux.'<br>';
                echo $last_day.'<br>';die();
            }
	        */
			$resCalculo = $serviciosReferencias->calcularPuntoPorFuncionDesdeHasta($_SESSION['idpersonal'],$row['idfuncion'], $month.'-01', $last_day);
			if (mysql_num_rows($resCalculo)>0) {
				if (mysql_result($resCalculo, 0,0) != '') {
					$totalMesual += mysql_result($resCalculo, 0,0);      
				}
				
				 
			}
	
			array_push($totalParcial, ["mes" => $i, "total" => $totalMesual]);
	
			$totalMesual = 0;
		}
	
		//$totalParcial = array($totalMesual);
		//$totalMesual = 0;
		
	}
	
	$enero      = 0;
	$febrero    = 0;
	$marzo      = 0;
	$abril      = 0;
	$mayo       = 0;
	$junio      = 0;
	$julio      = 0;
	$agosto     = 0;
	$septiembre = 0;
	$octubre    = 0;
	$noviembre  = 0;
	$diciembre  = 0;
	
	foreach ($totalParcial as $key => $value) {
	
		switch ($value['mes']) {
			case 1:
				$enero += $value['total'];
				break;
			case 2:
				$febrero += $value['total'];
				break;
			case 3:
				$marzo += $value['total'];
				break;
			case 4:
				$abril += $value['total'];
				break;
			case 5:
				$mayo += $value['total'];
				break;
			case 6:
				$junio += $value['total'];
				break;
			case 7:
				$julio += $value['total'];
				break;
			case 8:
				$agosto += $value['total'];
				break;
			case 9:
				$septiembre += $value['total'];
				break;
			case 10:
				$octubre += $value['total'];
				break;
			case 11:
				$noviembre += $value['total'];
				break;
			case 12:
				$diciembre += $value['total'];
				break; 
			 default:
				 # code...
				 break;
		 }
	}

    


} else {

    

    $resDatosActor = $serviciosReferencias->traerDatosObrasFuncionesTodas(); 

    $resSumDatosActor = $serviciosReferencias->traerDatosSumObrasFuncionesTodas();

    $resDetalleObrasPorActor = $serviciosReferencias->traerDatosObrasTodas();

    $resDetalleCooperativasPorActor = $serviciosReferencias->traerDatosCooperativasTodas();

    $resDatosActorAux = $serviciosReferencias->traerDatosObrasFuncionesTodas(); 

    $resDatosActorAuxEstadisticas = $serviciosReferencias->traerDatosObrasFuncionesTodas(); 

    $resEstadisticasMensuales = $serviciosReferencias->traerMontosGeneralesMensuales(date('Y'));
    
    $resTotalMes = $serviciosReferencias->traerMontosGeneralesMensual(date('Y'),date('m'));

    if (mysql_num_rows($resTotalMes)>0) {
        $total = mysql_result($resTotalMes, 0,4);
    } else {
        $total = 0;
    }


    $enero      = array();
    $febrero    = array();
    $marzo      = array();
    $abril      = array();
    $mayo       = array();
    $junio      = array();
    $julio      = array();
    $agosto     = array();
    $septiembre = array();
    $octubre    = array();
    $noviembre  = array();
    $diciembre  = array();
    
    while ($rowEM = mysql_fetch_array($resEstadisticasMensuales)) {
    
        switch ($rowEM['mes']) {
            case 1:
                array_push($enero ,['total'=>$rowEM['total'],'totalefectivo'=>$rowEM['totalefectivo'],'totaltarjeta'=>$rowEM['totaltarjeta']]);
                break;
            case 2:
                array_push($febrero ,['total'=>$rowEM['total'],'totalefectivo'=>$rowEM['totalefectivo'],'totaltarjeta'=>$rowEM['totaltarjeta'] ]);
                break;
            case 3:
                array_push($marzo ,['total'=>$rowEM['total'],'totalefectivo'=>$rowEM['totalefectivo'],'totaltarjeta'=>$rowEM['totaltarjeta'] ]);
                break;
            case 4:
                array_push($abril ,['total'=>$rowEM['total'],'totalefectivo'=>$rowEM['totalefectivo'],'totaltarjeta'=>$rowEM['totaltarjeta']]);
                break;
            case 5:
                array_push($mayo ,['total'=>$rowEM['total'],'totalefectivo'=>$rowEM['totalefectivo'],'totaltarjeta'=>$rowEM['totaltarjeta']]);
                break;
            case 6:
                array_push($junio ,['total'=>$rowEM['total'],'totalefectivo'=>$rowEM['totalefectivo'],'totaltarjeta'=>$rowEM['totaltarjeta']]);
                break;
            case 7:
                array_push($julio ,['total'=>$rowEM['total'],'totalefectivo'=>$rowEM['totalefectivo'],'totaltarjeta'=>$rowEM['totaltarjeta']]);
                break;
            case 8:
                array_push($agosto ,['total'=>$rowEM['total'],'totalefectivo'=>$rowEM['totalefectivo'],'totaltarjeta'=>$rowEM['totaltarjeta']]);
                break;
            case 9:
                array_push($septiembre ,['total'=>$rowEM['total'],'totalefectivo'=>$rowEM['totalefectivo'],'totaltarjeta'=>$rowEM['totaltarjeta']]);
                break;
            case 10:
                array_push($octubre ,['total'=>$rowEM['total'],'totalefectivo'=>$rowEM['totalefectivo'],'totaltarjeta'=>$rowEM['totaltarjeta']]);
                break;
            case 11:
                array_push($noviembre ,['total'=>$rowEM['total'],'totalefectivo'=>$rowEM['totalefectivo'],'totaltarjeta'=>$rowEM['totaltarjeta']]);
                break;
            case 12:
                array_push($diciembre ,['total'=>$rowEM['total'],'totalefectivo'=>$rowEM['totalefectivo'],'totaltarjeta'=>$rowEM['totaltarjeta']]);
                break; 
             default:
                 # code...
                 break;
         }
    }

    $sumTotalEfectivoAnual = ($enero[0]['totalefectivo']+$febrero[0]['totalefectivo']+$marzo[0]['totalefectivo']+$abril[0]['totalefectivo']+$mayo[0]['totalefectivo']+$junio[0]['totalefectivo']+$julio[0]['totalefectivo']+$agosto[0]['totalefectivo']+$septiembre[0]['totalefectivo']+$octubre[0]['totalefectivo']+$noviembre[0]['totalefectivo']+$diciembre[0]['totalefectivo']);

    $sumTotalTarjetasAnual = ($enero[0]['totaltarjeta']+$febrero[0]['totaltarjeta']+$marzo[0]['totaltarjeta']+$abril[0]['totaltarjeta']+$mayo[0]['totaltarjeta']+$junio[0]['totaltarjeta']+$julio[0]['totaltarjeta']+$agosto[0]['totaltarjeta']+$septiembre[0]['totaltarjeta']+$octubre[0]['totaltarjeta']+$noviembre[0]['totaltarjeta']+$diciembre[0]['totaltarjeta']);
    
    
}

if (mysql_num_rows($resSumDatosActor)>0) {
    $obras          = mysql_result($resSumDatosActor, 0,1);
    $cooperativas   = mysql_result($resSumDatosActor, 0,0);
    $funciones      = mysql_result($resSumDatosActor, 0,2);
} else {
    $obras          = 0;
    $cooperativas   = 0;
    $funciones      = 0;
}

$sumTotalAnual = ($enero[0]['total']+$febrero[0]['total']+$marzo[0]['total']+$abril[0]['total']+$mayo[0]['total']+$junio[0]['total']+$julio[0]['total']+$agosto[0]['total']+$septiembre[0]['total']+$octubre[0]['total']+$noviembre[0]['total']+$diciembre[0]['total']);

$sumTotalCuponerasAnual = $sumTotalAnual - $sumTotalTarjetasAnual - $sumTotalEfectivoAnual;
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
		    font-size: 11px;
		    text-rendering: auto;
		    -webkit-font-smoothing: antialiased;
		}

		

    </style>
    
    <script src="../js/jquery.color.min.js"></script>
	<script src="../js/jquery.animateNumber.min.js"></script>
    
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
    
</head>

<body>

 
<?php echo str_replace('..','../dashboard',$resMenu); ?>

<div id="content">
	

    



    <div class="row" style="margin-left:15px;">
        <div class="col-lg-<?php echo $columnas; ?> col-md-6">
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


        <div class="col-lg-<?php echo $columnas; ?> col-md-6">
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


        <div class="col-lg-<?php echo $columnas; ?> col-md-6">
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


        <?php
        if ($_SESSION['idroll_predio'] != 2) {
        ?>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-green">
                <div class="panel-heading">
                    <div class="row">

                        <div class="col-xs-12 text-right" style="padding-bottom:14px;">
                            <div class="hugeChico">$ <?php echo $total; ?></div>
                            <div>Liquidación (mes actual)</div>
                        </div>
                    </div>
                </div>
                <a href="javascript:void(0)" id="verLiquidacion">
                    <div class="panel-footer">
                        <span class="pull-left">Liquidacion Anual</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <?php } ?>

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
            echo "</div>";
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

            echo '<a href="#" id="'.$row2['idobra'].'" class="list-group-item "><span class="letraChica">'.$row2['cooperativa'].'</span> <span class="pull-right">Pts: '.$row2['puntos'].'</span></a>';

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
    <div class="lstLiquidacion">
        
        
        <div class="panel panel-green">
            <div class="panel-heading">
                Estadistica por Mes
            </div>
            <div class="panel-body">
                <div id="myfirstchart" style="height: 250px;"></div>
                <div class="list-group">
                    <a href="#" class="list-group-item list-group-item-success active">Liquidacion Anual</a>
                    <a href="#" class="list-group-item">Total: <?php echo '$ '.number_format($sumTotalAnual,2,',','.'); ?></a>
                    <?php if ($_SESSION['idroll_predio'] == 1) { ?>
                    <a href="#" class="list-group-item">Total Efectivo: <?php echo '$ '.number_format($sumTotalEfectivoAnual,2,',','.'); ?></a>
                    <a href="#" class="list-group-item">Total Tarjeta: <?php echo '$ '.number_format($sumTotalTarjetasAnual,2,',','.'); ?></a>
                    <a href="#" class="list-group-item">Total Cuponeras: <?php echo '$ '.number_format($sumTotalCuponerasAnual,2,',','.'); ?></a>
                    <?php } ?>
                </div>
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
	var months = ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"];
    <?php
        if ($_SESSION['idroll_predio'] == 1) {

    ?>
    new Morris.Line({
      // ID of the element in which to draw the chart.
      element: 'myfirstchart',
      
      // Chart data records -- each entry in this array corresponds to a point on
      // the chart.
      data: [
        { month: '2015-01', value: <?php echo $enero[0]['total']; ?>, value2: <?php echo $enero[0]['totalefectivo']; ?>,value3: <?php echo $enero[0]['totaltarjeta']; ?>, value4: <?php echo $enero[0]['total'] - $enero[0]['totalefectivo'] - $enero[0]['totaltarjeta']; ?> },
        { month: '2015-02', value: <?php echo $febrero[0]['total']; ?>,value2: <?php echo $febrero[0]['totalefectivo']; ?>,value3: <?php echo $febrero[0]['totaltarjeta']; ?>, value4: <?php echo $febrero[0]['total'] - $febrero[0]['totalefectivo'] - $febrero[0]['totaltarjeta']; ?> },
        { month: '2015-03', value: <?php echo $marzo[0]['total']; ?>,value2: <?php echo $marzo[0]['totalefectivo']; ?>,value3: <?php echo $marzo[0]['totaltarjeta']; ?>, value4: <?php echo $marzo[0]['total'] - $marzo[0]['totalefectivo'] - $marzo[0]['totaltarjeta']; ?> },
        { month: '2015-04', value: <?php echo $abril[0]['total']; ?>,value2: <?php echo $abril[0]['totalefectivo']; ?>,value3: <?php echo $abril[0]['totaltarjeta']; ?>, value4: <?php echo $abril[0]['total'] - $abril[0]['totalefectivo'] - $abril[0]['totaltarjeta']; ?> },
        { month: '2015-05', value: <?php echo $mayo[0]['total']; ?>,value2: <?php echo $mayo[0]['totalefectivo']; ?>,value3: <?php echo $mayo[0]['totaltarjeta']; ?>, value4: <?php echo $mayo[0]['total'] - $mayo[0]['totalefectivo'] - $mayo[0]['totaltarjeta']; ?> },
        { month: '2015-06', value: <?php echo $junio[0]['total']; ?>,value2: <?php echo $junio[0]['totalefectivo']; ?>,value3: <?php echo $junio[0]['totaltarjeta']; ?>, value4: <?php echo $junio[0]['total'] - $junio[0]['totalefectivo'] - $junio[0]['totaltarjeta']; ?> },
        { month: '2015-07', value: <?php echo $julio[0]['total']; ?>,value2: <?php echo $julio[0]['totalefectivo']; ?>,value3: <?php echo $julio[0]['totaltarjeta']; ?>, value4: <?php echo $julio[0]['total'] - $julio[0]['totalefectivo'] - $julio[0]['totaltarjeta']; ?> },
        { month: '2015-08', value: <?php echo $agosto[0]['total']; ?>,value2: <?php echo $agosto[0]['totalefectivo']; ?>,value3: <?php echo $agosto[0]['totaltarjeta']; ?>, value4: <?php echo $agosto[0]['total'] - $agosto[0]['totalefectivo'] - $agosto[0]['totaltarjeta']; ?> },
        { month: '2015-09', value: <?php echo $septiembre[0]['total']; ?>,value2: <?php echo $septiembre[0]['totalefectivo']; ?>,value3: <?php echo $septiembre[0]['totaltarjeta']; ?>, value4: <?php echo $septiembre[0]['total'] - $septiembre[0]['totalefectivo'] - $septiembre[0]['totaltarjeta']; ?> },
        { month: '2015-10', value: <?php echo $octubre[0]['total']; ?>,value2: <?php echo $octubre[0]['totalefectivo']; ?>,value3: <?php echo $octubre[0]['totaltarjeta']; ?>, value4: <?php echo $octubre[0]['total'] - $octubre[0]['totalefectivo'] - $octubre[0]['totaltarjeta']; ?> },
        { month: '2015-11', value: <?php echo $noviembre[0]['total']; ?>,value2: <?php echo $noviembre[0]['totalefectivo']; ?>,value3: <?php echo $noviembre[0]['totaltarjeta']; ?>, value4: <?php echo $noviembre[0]['total'] - $noviembre[0]['totalefectivo'] - $noviembre[0]['totaltarjeta']; ?> },
        { month: '2015-12', value: <?php echo $diciembre[0]['total']; ?>,value2: <?php echo $diciembre[0]['totalefectivo']; ?>,value3: <?php echo $diciembre[0]['totaltarjeta']; ?>, value4: <?php echo $diciembre[0]['total'] - $diciembre[0]['totalefectivo'] - $diciembre[0]['totaltarjeta']; ?> },
      ],
      // The name of the data record attribute that contains x-values.
      xkey: 'month',
      xLabelFormat: function(x) { // <--- x.getMonth() returns valid index
        var month = months[x.getMonth()];
        return month;
      },
      dateFormat: function(x) {
        var month = months[new Date(x).getMonth()];
        return month;
      },
      // A list of names of data record attributes that contain y-values.
      ykeys: ['value','value2','value3','value4'],
      // Labels for the ykeys -- will be displayed when you hover over the
      // chart.
      labels: ['Total', 'Total Efectivo','Total Tarjeta','Cuponeras'],
      lineColors: ['#04E71C','#1FC1CC','#FF4D62','#CC3F1F']
    });
    <?php
        } else {
    ?>

    new Morris.Line({
      // ID of the element in which to draw the chart.
      element: 'myfirstchart',
      
      // Chart data records -- each entry in this array corresponds to a point on
      // the chart.
      data: [
        { month: '2015-01', value: <?php echo $enero; ?> },
        { month: '2015-02', value: <?php echo $febrero; ?> },
        { month: '2015-03', value: <?php echo $marzo; ?> },
        { month: '2015-04', value: <?php echo $abril; ?> },
        { month: '2015-05', value: <?php echo $mayo; ?> },
        { month: '2015-06', value: <?php echo $junio; ?> },
        { month: '2015-07', value: <?php echo $julio; ?> },
        { month: '2015-08', value: <?php echo $agosto; ?> },
        { month: '2015-09', value: <?php echo $septiembre; ?> },
        { month: '2015-10', value: <?php echo $octubre; ?> },
        { month: '2015-11', value: <?php echo $noviembre; ?> },
        { month: '2015-12', value: <?php echo $diciembre; ?> },
      ],
      // The name of the data record attribute that contains x-values.
      xkey: 'month',
      xLabelFormat: function(x) { // <--- x.getMonth() returns valid index
        var month = months[x.getMonth()];
        return month;
      },
      dateFormat: function(x) {
        var month = months[new Date(x).getMonth()];
        return month;
      },
      // A list of names of data record attributes that contain y-values.
      ykeys: ['value'],
      // Labels for the ykeys -- will be displayed when you hover over the
      // chart.
      labels: ['Liquidado'],
      lineColors: ['#04E71C']
    });
    <?php
         
        }
    ?>
	
	
	
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

    $('#verLiquidacion').click(function() {
        $('.lstObras').hide();
        $('.lstFunciones').hide();
        $('.lstCooperativas').hide();
        $('.lstLiquidacion').show();
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
