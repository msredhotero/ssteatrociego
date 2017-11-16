<?php

include ('../includes/funcionesUsuarios.php');
include ('../includes/funciones.php');
include ('../includes/funcionesHTML.php');
include ('../includes/funcionesReferencias.php');


$serviciosUsuarios  		= new ServiciosUsuarios();
$serviciosFunciones 		= new Servicios();
$serviciosHTML				= new ServiciosHTML();
$serviciosReferencias		= new ServiciosReferencias();


$accion = $_POST['accion'];


switch ($accion) {
    case 'login':
        enviarMail($serviciosUsuarios);
        break;
	case 'entrar':
		entrar($serviciosUsuarios);
		break;
	case 'insertarUsuario':
        insertarUsuario($serviciosUsuarios);
        break;
	case 'modificarUsuario':
        modificarUsuario($serviciosUsuarios);
        break;
	case 'registrar':
		registrar($serviciosUsuarios);
        break;
	case 'recuperar':
		recuperar($serviciosUsuarios);
		break;
	case 'cambiarSede':
		cambiarSede($serviciosUsuarios);
		break;


case 'insertarCajadiaria':
insertarCajadiaria($serviciosReferencias);
break;
case 'modificarCajadiaria':
modificarCajadiaria($serviciosReferencias);
break;
case 'eliminarCajadiaria':
eliminarCajadiaria($serviciosReferencias);
break; 
case 'traerCajadiariaPorFecha':
traerCajadiariaPorFecha($serviciosReferencias);
break;

case 'insertarClientes': 
insertarClientes($serviciosReferencias); 
break; 
case 'modificarClientes': 
modificarClientes($serviciosReferencias); 
break; 
case 'eliminarClientes': 
eliminarClientes($serviciosReferencias); 
break; 

	
case 'eliminarFoto':
	eliminarFoto($serviciosReferencias);
	break;
	
case 'insertarProveedores': 
insertarProveedores($serviciosReferencias); 
break; 
case 'modificarProveedores': 
modificarProveedores($serviciosReferencias); 
break; 
case 'eliminarProveedores': 
eliminarProveedores($serviciosReferencias); 
break; 
case 'insertarUsuarios': 
insertarUsuarios($serviciosReferencias); 
break; 
case 'modificarUsuarios': 
modificarUsuarios($serviciosReferencias); 
break; 
case 'eliminarUsuarios': 
eliminarUsuarios($serviciosReferencias); 
break; 

case 'insertarPredio_menu': 
insertarPredio_menu($serviciosReferencias); 
break; 
case 'modificarPredio_menu': 
modificarPredio_menu($serviciosReferencias); 
break; 
case 'eliminarPredio_menu': 
eliminarPredio_menu($serviciosReferencias); 
break; 

case 'insertarEstados': 
insertarEstados($serviciosReferencias); 
break; 
case 'modificarEstados': 
modificarEstados($serviciosReferencias); 
break; 
case 'eliminarEstados': 
eliminarEstados($serviciosReferencias); 
break; 
case 'insertarRoles': 
insertarRoles($serviciosReferencias); 
break; 
case 'modificarRoles': 
modificarRoles($serviciosReferencias); 
break; 
case 'eliminarRoles': 
eliminarRoles($serviciosReferencias); 
break; 
case 'insertarTipopago': 
insertarTipopago($serviciosReferencias); 
break; 
case 'modificarTipopago': 
modificarTipopago($serviciosReferencias); 
break; 
case 'eliminarTipopago': 
eliminarTipopago($serviciosReferencias); 
break; 

case 'insertarCooperativas': 
insertarCooperativas($serviciosReferencias); 
break; 
case 'modificarCooperativas': 
modificarCooperativas($serviciosReferencias); 
break; 
case 'eliminarCooperativas': 
eliminarCooperativas($serviciosReferencias); 
break; 
case 'insertarDatosbancos': 
insertarDatosbancos($serviciosReferencias); 
break; 
case 'modificarDatosbancos': 
modificarDatosbancos($serviciosReferencias); 
break; 
case 'eliminarDatosbancos': 
eliminarDatosbancos($serviciosReferencias); 
break; 
case 'insertarDomicilios': 
insertarDomicilios($serviciosReferencias); 
break; 
case 'modificarDomicilios': 
modificarDomicilios($serviciosReferencias); 
break; 
case 'eliminarDomicilios': 
eliminarDomicilios($serviciosReferencias); 
break; 
case 'insertarGastosobras': 
insertarGastosobras($serviciosReferencias); 
break; 
case 'modificarGastosobras': 
modificarGastosobras($serviciosReferencias); 
break; 
case 'eliminarGastosobras': 
eliminarGastosobras($serviciosReferencias); 
break; 
case 'insertarObras': 
insertarObras($serviciosReferencias); 
break; 
case 'modificarObras': 
modificarObras($serviciosReferencias); 
break; 
case 'eliminarObras': 
eliminarObras($serviciosReferencias); 
break; 

case 'traerSaldoPuntosObras':
	traerSaldoPuntosObras($serviciosReferencias);
	break;

case 'insertarObrascooperativas': 
insertarObrascooperativas($serviciosReferencias); 
break; 
case 'modificarObrascooperativas': 
modificarObrascooperativas($serviciosReferencias); 
break; 
case 'eliminarObrascooperativas': 
eliminarObrascooperativas($serviciosReferencias); 
break; 
case 'insertarPersonal': 
insertarPersonal($serviciosReferencias); 
break; 
case 'modificarPersonal': 
modificarPersonal($serviciosReferencias); 
break; 
case 'eliminarPersonal': 
eliminarPersonal($serviciosReferencias); 
break; 
case 'insertarPersonalcargos': 
insertarPersonalcargos($serviciosReferencias); 
break; 
case 'modificarPersonalcargos': 
modificarPersonalcargos($serviciosReferencias); 
break; 
case 'eliminarPersonalcargos': 
eliminarPersonalcargos($serviciosReferencias); 
break; 

case 'insertarEstadocivil': 
insertarEstadocivil($serviciosReferencias); 
break; 
case 'modificarEstadocivil': 
modificarEstadocivil($serviciosReferencias); 
break; 
case 'eliminarEstadocivil': 
eliminarEstadocivil($serviciosReferencias); 
break; 


case 'insertarSedes': 
	insertarSedes($serviciosReferencias); 
	break; 
case 'modificarSedes': 
	modificarSedes($serviciosReferencias); 
	break; 
case 'eliminarSedes': 
	eliminarSedes($serviciosReferencias); 
	break; 


case 'insertarSalas': 
insertarSalas($serviciosReferencias); 
break; 
case 'modificarSalas': 
modificarSalas($serviciosReferencias); 
break; 
case 'eliminarSalas': 
eliminarSalas($serviciosReferencias); 
break; 
case 'insertarTipoconceptos': 
insertarTipoconceptos($serviciosReferencias); 
break; 
case 'modificarTipoconceptos': 
modificarTipoconceptos($serviciosReferencias); 
break; 
case 'eliminarTipoconceptos': 
eliminarTipoconceptos($serviciosReferencias); 
break; 
case 'insertarTipodocumento': 
insertarTipodocumento($serviciosReferencias); 
break; 
case 'modificarTipodocumento': 
modificarTipodocumento($serviciosReferencias); 
break; 
case 'eliminarTipodocumento': 
eliminarTipodocumento($serviciosReferencias); 
break; 
 
case 'insertarTiposcargos': 
insertarTiposcargos($serviciosReferencias); 
break; 
case 'modificarTiposcargos': 
modificarTiposcargos($serviciosReferencias); 
break; 
case 'eliminarTiposcargos': 
eliminarTiposcargos($serviciosReferencias); 
break; 

case 'insertarCategorias': 
insertarCategorias($serviciosReferencias); 
break; 
case 'modificarCategorias': 
modificarCategorias($serviciosReferencias); 
break; 
case 'eliminarCategorias': 
eliminarCategorias($serviciosReferencias); 
break; 

case 'insertarPromosobras': 
insertarPromosobras($serviciosReferencias); 
break; 
case 'modificarPromosobras': 
modificarPromosobras($serviciosReferencias); 
break; 
case 'eliminarPromosobras': 
eliminarPromosobras($serviciosReferencias); 
break; 

case 'insertarVentas': 
insertarVentas($serviciosReferencias); 
break; 
case 'modificarVentas': 
modificarVentas($serviciosReferencias); 
break; 
case 'eliminarVentas': 
eliminarVentas($serviciosReferencias); 
break; 

case 'insertarCuponeras': 
insertarCuponeras($serviciosReferencias); 
break; 
case 'modificarCuponeras': 
modificarCuponeras($serviciosReferencias); 
break; 
case 'eliminarCuponeras': 
eliminarCuponeras($serviciosReferencias); 
break; 

case 'insertarAlbumobras':
insertarAlbumobras($serviciosReferencias);
break;
case 'modificarAlbumobras':
modificarAlbumobras($serviciosReferencias);
break;
case 'eliminarAlbumobras':
eliminarAlbumobras($serviciosReferencias);
break; 
case 'insertarAlbum':
insertarAlbum($serviciosReferencias);
break;
case 'modificarAlbum':
modificarAlbum($serviciosReferencias);
break;
case 'eliminarAlbum':
eliminarAlbum($serviciosReferencias);
break; 

case 'insertarFunciones': 
insertarFunciones($serviciosReferencias); 
break; 
case 'modificarFunciones': 
modificarFunciones($serviciosReferencias); 
break; 
case 'eliminarFunciones': 
eliminarFunciones($serviciosReferencias); 
break; 

////////////////////////////////*****    AUTO-COMPLETAR   *******/////////////////////////////////////
case 'traerPromosPorObras':
	traerPromosPorObras($serviciosReferencias, $serviciosFunciones);
break;
case 'traerCategoriasPorObras':
	traerCategoriasPorObras($serviciosReferencias, $serviciosFunciones);
break;
case 'traerAlbumPorObras':
	traerAlbumPorObras($serviciosReferencias, $serviciosFunciones);
break;
case 'traerCategoriasPromocionesPorObras':
	traerCategoriasPromocionesPorObras($serviciosReferencias, $serviciosFunciones);
break;

case 'traerPromosObrasPorFuncion':
	traerPromosObrasPorFuncion($serviciosReferencias);
	break;
case 'traerCategoriasPorFuncion':
	traerCategoriasPorFuncion($serviciosReferencias);
	break;
case 'traerPlantelConCargosPorFuncion':
	traerPlantelConCargosPorFuncion($serviciosReferencias);
	break;	
case 'traerPlantelPorFuncion':
	traerPlantelPorFuncion($serviciosReferencias);
	break;	
////////////////////////////////*****    FIN AUTO-COMPLETAR   *******/////////////////////////////////////

////////////////////////////////*****    Solo para que traigan valores   *******/////////////////////////////////////
case 'traerValorEntrada':
	traerValorEntrada($serviciosReferencias, $serviciosFunciones);
	break;
case 'traerValorEntradaPorFuncion':
	traerValorEntradaPorFuncion($serviciosReferencias, $serviciosFunciones);
	break;
case 'traerDescuentoCategoria':
	traerDescuentoCategoria($serviciosReferencias, $serviciosFunciones);
	break;
case 'traerDescuentoPromociones':
	traerDescuentoPromociones($serviciosReferencias, $serviciosFunciones);
	break;
case 'traerTotal':
	traerTotal($serviciosReferencias);
	break;
case 'traerVentasPorDiaFuncionActivos':
	traerVentasPorDiaFuncionActivos($serviciosReferencias);
	break;
////////////////////////////////*****    FIN   *******/////////////////////////////////////

}

/* Fin */


///////////////////////////////****  VENTAS  ********************///////////////////////////////////
function insertarVentas($serviciosReferencias) { 
	$numero = $serviciosReferencias->generarNroVenta(); 
	$reftipopago = 1; 
	$fecha = $_POST['fecha']; 
	$total = $_POST['total']; 
	
	$cantidad = $_POST['cantidadbuscar'];
	
	$cancelado = 0;  
	
	$usuario = $_POST['usuario']; 

	$reffunciones = $_POST['reffunciones']; 
	
	if (isset($_POST['refalbum'])) {
		$refalbum = $_POST['refalbum']; 
	} else {
		$refalbum = '';	
	}
	
	$fechacreacion = date('Y-m-d'); 
	$usuacrea = $_POST['usuario'];
	$fechamodi = ''; 
	$usuamodi = '';
	
	$valorentrada = $_POST['valorentrada'];
	
	$totalefectivo = $_POST['totalefectivo'];
	$totaltarjeta = $_POST['totaltarjeta'];
	$observacion = $_POST['observaciones'];
	
	$res = $serviciosReferencias->insertarVentas($numero,$reftipopago,$fecha,$total,$cancelado,$usuario,$reffunciones,$refalbum,$valorentrada,$observacion,$fechacreacion,$usuacrea,$fechamodi,$usuamodi,$cantidad, $totalefectivo,$totaltarjeta); 
	
	if ((integer)$res > 0) { 
		// si graba bien empiezo a recorrer para guardar Categorias - Promociones - Personal
		
		//	CATEGORIAS
		$resCategorias = $serviciosReferencias->traerCategoriasPorFuncion($reffunciones);
		$cad = 'categoria';
		$totalC = 0;
			while ($rowFS = mysql_fetch_array($resCategorias)) {
				$montoC 		= $rowFS['monto'];
				$porcentajeC 	= $rowFS['porcentaje'];
				$comisionC		= $rowFS['pocentajeretenido'];
				
				
				if (isset($_POST[$cad.$rowFS[0]])) {
					$cantidadC	=	$_POST[$cad.$rowFS[0]];
					
					if (($montoC > 0) && ($montoC != '')) {
						$totalC = (float)$montoC * $cantidadC;	
					} else {
						if ($porcentajeC > 0) {
							$totalC = ((float)$valorentrada - ((float)$valorentrada * (float)$porcentajeC / 100)) * $cantidadC;	
							$totalC = $totalC - ($totalC / 100 * $comisionC);
						} else {
							$totalC = (float)$valorentrada * $cantidadC;	
						}
					}
					$serviciosReferencias->insertarVentadetalle($res,$totalC,$rowFS[0],0,$montoC,$porcentajeC,$cantidadC);
				}
			}
			
		//		PROMOCIONES	
		$resPromociones = $serviciosReferencias->traerPromosObrasPorFuncion($reffunciones);
		$cad = 'promo';
		$totalP = 0;
			while ($rowFS = mysql_fetch_array($resPromociones)) {
				$montoP 		= $rowFS['monto'];
				$porcentajeP 	= $rowFS['porcentaje'];
				
				
				if (isset($_POST[$cad.$rowFS[0]])) {
					$cantidadP	=	$_POST[$cad.$rowFS[0]];
					
					if (($montoP > 0) && ($montoP != '')) {
						$totalP = (float)$montoP * $cantidadP;	
					} else {
						if ($porcentajeP > 0) {
							$totalP = ((float)$valorentrada - ((float)$valorentrada * (float)$porcentajeP / 100)) * $cantidadP;	
						} else {
							$totalP = (float)$valorentrada * $cantidadP;	
						}
					}
					$serviciosReferencias->insertarVentadetalle($res,$totalP,0,$rowFS[0],$montoP,$porcentajeP,$cantidadP);
				}
			}
			
		
		//		PERSONAL	
		$resPromociones = $serviciosReferencias->traerPlantelPorFuncion($reffunciones);
		$cad = 'plantel';
			while ($rowFS = mysql_fetch_array($resPromociones)) {
				$puntos 		= $rowFS['puntos'];
				
				if (isset($_POST[$cad.$rowFS[0]])) {
					$cantidadP	=	$_POST[$cad.$rowFS[0]];
					
					if (($montoP > 0) && ($montoP != '')) {
						$totalP = (float)$montoP * $cantidadP;	
					} else {
						if ($porcentajeP > 0) {
							$totalP = ((float)$valorentrada - ((float)$valorentrada * (float)$porcentajeP / 100)) * $cantidadP;	
						}
					}
					$serviciosReferencias->insertarPersonalventa($rowFS[0],$res,$puntos);
				}
			}
			
		
		echo ''; 
	} else { 
		echo 'Hubo un error al insertar datos';	 
	} 
} 



function modificarVentas($serviciosReferencias) { 
	$id = $_POST['id']; 
	$numero = $_POST['numero']; 
	$reftipopago = $_POST['reftipopago']; 
	$fecha = $_POST['fecha']; 
	$total = $_POST['total']; 
	$cantidad = $_POST['cantidad'];
	
	if (isset($_POST['cancelado'])) { 
		$cancelado	= 1; 
	} else { 
		$cancelado = 0; 
	} 
	
	$usuario = $_POST['usuario']; 
	
	 
	$reffunciones = $_POST['reffunciones']; 
	
	if (isset($_POST['refalbum'])) { 
		$refalbum = $_POST['refalbum']; 
	} else { 
		$refalbum = 0; 
	}
	 
	
	$valorentrada = $_POST['valorentrada'];
	$observacion = $_POST['observacion']; 
	$fechacreacion = $_POST['fechacreacion']; 
	$usuacrea = $_POST['usuacrea']; 
	$fechamodi = date('Y-m-d'); 
	$usuamodi = $_POST['usuamodi']; 
	$totalefectivo = $_POST['totalefectivo']; 
	$totaltarjeta = $_POST['totaltarjeta']; 
	
	$res = $serviciosReferencias->modificarVentas($id,$numero,$reftipopago,$fecha,$total,$cancelado,$usuario,$reffunciones,$refalbum,$valorentrada,$observacion,$fechacreacion,$usuacrea,$fechamodi,$usuamodi,$cantidad,$totalefectivo,$totaltarjeta); 
	
	if ($res == true) { 
		echo ''; 
	} else { 
		echo 'Hubo un error al modificar datos'; 
	} 
} 



//////////////////////////////***  FIN VENTAS  ****/////////////////////////////////////////////////


////////////////////////////////*****    AUTO-COMPLETAR   *******/////////////////////////////////////
function	traerPromosPorObras($serviciosReferencias, $serviciosFunciones) {
	$idObra	=	$_POST['idObra'];
	$datos	=	$serviciosFunciones->devolverSelectBoxArray( $serviciosReferencias->traerPromosobrasActivosPorObra($idObra),array(1,5,6),array(' - Porcentaje: ','% - Monto: ', ''),'--- Promociones ---');
	echo $datos;
}

function	traerCategoriasPorObras($serviciosReferencias, $serviciosFunciones) {
	$idObra	=	$_POST['idObra'];
	$datos	=	$serviciosFunciones->devolverSelectBoxArray( $serviciosReferencias->traerCategoriasPorObra($idObra),array(1,3,4,5),array(' - Cuponera: ',' - Monto: ',' - Porcentaje:',''),'--- Categorias ---');
	echo $datos;	
}

function	traerCategoriasPromocionesPorObras($serviciosReferencias, $serviciosFunciones) {
	$idObra	=	$_POST['idObra'];
	$datosCategorias	=	$serviciosFunciones->devolverSelectBoxArray( $serviciosReferencias->traerCategoriasPorObra($idObra),array(1,3,4,5),array(' - Cuponera: ',' - Monto: ',' - Porcentaje:',''),'--- Categorias ---');
	$datosPromociones	=	$serviciosFunciones->devolverSelectBoxArray( $serviciosReferencias->traerPromosobrasActivosPorObra($idObra),array(1,5,6),array(' - Porcentaje: ','% - Monto: ', ''),'--- Promociones ---');
	echo $datosCategorias.$datosPromociones;	
}

function	traerAlbumPorObras($serviciosReferencias, $serviciosFunciones) {
	$idObra	=	$_POST['idObra'];
	$datos	=	$serviciosFunciones->devolverSelectBox( $serviciosReferencias->traerAlbumobrasPorObra($idObra),array(3,4),' - ');
	echo $datos;	
}

function traerTotal($serviciosReferencias) {
	$idDescuento = $_POST['id'];
	$idObra		 = $_POST['idObra'];
	$tipoDescuento = $_POST['tipoDescuento'];	
	$cantidad	=	$_POST['cantidad'];
	
	$refObra = $serviciosReferencias->traerObrasPorId($idObra);
	
	$total = mysql_result($refObra,0,'valorentrada');
	
	if ($idDescuento != '') {
		if ($tipoDescuento == 1) {
			//categorias
			$refDescuento 	= $serviciosReferencias->traerCategoriasPorId($idDescuento);	
		} else {
			//promos
			$refDescuento	= $serviciosReferencias->traerPromosobrasPorId($idDescuento);
		}
		
		$monto			= mysql_result($refDescuento,0,'monto');
		$porcentaje		= mysql_result($refDescuento,0,'porcentaje');
		
		if (($monto > 0) && ($monto != '')) {
			$total = (float)$monto;	
		} else {
			if ($porcentaje > 0) {
				$total = (float)$total - ((float)$total * (float)$porcentaje / 100);	
			}
		}
	}
	
	echo round($cantidad * $total,2,PHP_ROUND_HALF_UP);
}


function traerCategoriasPorFuncion($serviciosReferencias) {
	$idfuncion		=	$_POST['id'];
	
	$res	=	$serviciosReferencias->traerCategoriasPorFuncion($idfuncion);
	
	$cad = '';
	while ($row = mysql_fetch_array($res)) {
		$cad .= '<div class="form-group col-md-4 col-xs-6" style="display:block">
                        <label for="vigenciadesde" class="control-label" style="text-align:left">'.$row['descripcion'].'</label>
                        <div class="input-group col-md-12 col-xs-12">
                            <input class="form-control" name="categoria'.$row[0].'" id="categoria'.$row[0].'" type="text" value="0"/>
                        </div>
                        
                    </div>';
	}
	
	echo $cad;
}


function traerPromosObrasPorFuncion($serviciosReferencias) {
	$idfuncion		=	$_POST['id'];
	
	$res	=	$serviciosReferencias->traerPromosObrasPorFuncion($idfuncion);
	
	$cad = '';
	while ($row = mysql_fetch_array($res)) {
		$cad .= '<div class="form-group col-md-4 col-xs-6" style="display:block">
                        <label for="vigenciadesde" class="control-label" style="text-align:left">'.$row['descripcion'].'</label>
                        <div class="input-group col-md-12 col-xs-12">
                            <input class="form-control" name="promo'.$row[0].'" id="promo'.$row[0].'" type="text" value="0"/>
                        </div>
                        
                    </div>';
	}
	
	echo $cad;
}

// se modifica por traer el plantel por cooperativa
function traerPlantelPorFuncion($serviciosReferencias) {
	$idfuncion		=	$_POST['id'];
	
	$res	=	$serviciosReferencias->traerPlantelPorFuncion($idfuncion);
	
	$cad = '';
	while ($row = mysql_fetch_array($res)) {
		$cad .= '<div class="form-group col-md-6 col-xs-8" style="display:block">
                        
                        <div class="input-group col-md-12 col-xs-12">
							<span class="input-group-addon">'.$row['apellido'].' '.$row['nombre'].' - Nro. Documento: '.$row['nrodocumento'].'</span> 
                            <input class="form-control" name="plantel'.$row[0].'" id="plantel'.$row[0].'" type="text" value="'.$row['puntos'].'"/>
                        </div>
                        
                    </div>';
	}
	
	echo $cad;
}


function traerPlantelConCargosPorFuncion($serviciosReferencias) {
	$idfuncion		=	$_POST['id'];
	
	$res	=	$serviciosReferencias->traerPlantelConCargosPorFuncion($idfuncion);
	
	$cad = '';
	while ($row = mysql_fetch_array($res)) {
		$cad .= '<div class="form-group col-md-6 col-xs-8" style="display:block">
                        
                        <div class="input-group col-md-12 col-xs-12">
							<span class="input-group-addon">'.$row['apellido'].' '.$row['nombre'].' - Nro. Documento: '.$row['nrodocumento'].'</span> 
                            <input class="form-control" name="plantel'.$row[0].'" id="plantel'.$row[0].'" type="text" value="'.$row['puntos'].'"/>
                        </div>
                        
                    </div>';
	}
	
	echo $cad;
}
////////////////////////////////*****    FIN AUTO-COMPLETAR   *******/////////////////////////////////////

////////////////////////////////*****    Solo para que traigan valores   *******/////////////////////////////////////
function traerVentasPorDiaFuncionActivos($serviciosReferencias) {

	$fecha 		= $_GET['fecha'];
	$reffuncion = $_GET['reffuncion'];

	$resVenta = $serviciosReferancias->traerVentasPorDiaFuncionActivos($fecha, $reffuncion);
	
	$ar = array();	
	while ($row = mysql_fetch_array($resTraerDatos)) {
		//$cadJugadores .= '"'.$row[0].'": "'.$row['apellido'].', '.$row['nombres'].' - '.$row['nrodocumento'].'",';
		if ($datos == 1) {

			array_push($ar,array('equipo'=>$row[0].' - '.$row['nombre'], 'id'=> $row[0], 'categoria'=>$row['categoria'], 'imagen'=>$row['imagen']));
		} else {

			array_push($ar,array('equipo'=>$row[0].' - '.$row['nombre'].' - '.$row['categoria'].' - '.$row['division'], 'id'=> $row[0], 'categoria'=>$row['categoria'], 'imagen'=>$row['imagen']));
		}
	}
	
	echo $token.'('.json_encode($ar).');';
}


function traerValorEntrada($serviciosReferencias) {
	$id		=	$_POST['id'];
	
	echo $serviciosReferencias->traerValorEntrada($id);
}

function traerValorEntradaPorFuncion($serviciosReferencias) {
	$id		=	$_POST['id'];
	
	echo $serviciosReferencias->traerValorEntradaPorFuncion($id);
}

function traerDescuentoPorcentualCategorias($serviciosReferencias) {
	$id		=	$_POST['id'];
	
	echo $serviciosReferencias->traerDescuentoPorcentualCategorias($id);
}

function traerDescuentoMontoCategorias($serviciosReferencias) {
	$id		=	$_POST['id'];
	
	echo $serviciosReferencias->traerDescuentoMontoCategorias($id);
}

function traerDescuentoPorcentualPromociones($serviciosReferencias) {
	$id		=	$_POST['id'];
	
	echo $serviciosReferencias->traerDescuentoPorcentualPromociones($id);
}

function traerDescuentoMontoPromociones($serviciosReferencias) {
	$id		=	$_POST['id'];
	
	echo $serviciosReferencias->traerDescuentoMontoPromociones($id);
}

function traerDescuentoPromociones($serviciosReferencias) {
	$id		=	$_POST['id'];
	
	$porcentaje	 = $serviciosReferencias->traerDescuentoPorcentualPromociones($id);
	$monto		 = $serviciosReferencias->traerDescuentoMontoPromociones($id);
	
	if ($monto >0) {
		echo $monto;	
	} else {
		if ($porcentaje > 0) {
			echo $porcentaje;
		} else {
			echo 0;	
		}
	}
}

function traerDescuentoCategorias($serviciosReferencias) {
	$id		=	$_POST['id'];
	
	$porcentaje	 = $serviciosReferencias->traerDescuentoPorcentualCategorias($id);
	$monto		 = $serviciosReferencias->traerDescuentoMontoCategorias($id);
	
	if ($monto >0) {
		echo $monto;	
	} else {
		if ($porcentaje > 0) {
			echo $porcentaje;
		} else {
			echo 0;	
		}
	}
}


////////////////////////////////*****    FIN   *******/////////////////////////////////////


/* nuevo */

function insertarFunciones($serviciosReferencias) { 
	$refobras = $_POST['refobras']; 
	$refcooperativas = $_POST['refcooperativas']; 
	$horario = $_POST['horario']; 
	$refdias = $_POST['refdias']; 
	
	$res = $serviciosReferencias->insertarFunciones($refobras,$refcooperativas,$horario,$refdias); 
	
	if ((integer)$res > 0) { 
		echo ''; 
	} else { 
		echo 'Hubo un error al insertar datos ';	 
	} 
} 


function modificarFunciones($serviciosReferencias) { 
	$id = $_POST['id']; 
	$refobras = $_POST['refobras']; 
	$refcooperativas = $_POST['refcooperativas']; 
	$horario = $_POST['horario']; 
	$refdias = $_POST['refdias']; 
	
	$res = $serviciosReferencias->modificarFunciones($id,$refobras,$refcooperativas,$horario,$refdias); 
	
	if ($res == true) { 
		echo ''; 
	} else { 
		echo 'Hubo un error al modificar datos'; 
	} 
} 


function eliminarFunciones($serviciosReferencias) { 
	$id = $_POST['id']; 
	
	$res = $serviciosReferencias->eliminarFunciones($id); 
	
	echo $res; 
} 


function insertarAlbumobras($serviciosReferencias) {
$refobras = $_POST['refobras'];
$refalbum = $_POST['refalbum'];
$res = $serviciosReferencias->insertarAlbumobras($refobras,$refalbum);
if ((integer)$res > 0) {
echo '';
} else {
echo 'Hubo un error al insertar datos';
}
}
function modificarAlbumobras($serviciosReferencias) {
$id = $_POST['id'];
$refobras = $_POST['refobras'];
$refalbum = $_POST['refalbum'];
$res = $serviciosReferencias->modificarAlbumobras($id,$refobras,$refalbum);
if ($res == true) {
echo '';
} else {
echo 'Hubo un error al modificar datos';
}
}
function eliminarAlbumobras($serviciosReferencias) {
$id = $_POST['id'];
$res = $serviciosReferencias->eliminarAlbumobras($id);
echo $res;
} 

function insertarAlbum($serviciosReferencias) {
	$banda = $_POST['banda'];
	$album = $_POST['album'];
	$genero = $_POST['genero'];
	$res = $serviciosReferencias->insertarAlbum($banda,$album,$genero);
	
	if ((integer)$res > 0) {
		echo '';
	} else {
		echo 'Hubo un error al insertar datos';
	}
}
function modificarAlbum($serviciosReferencias) {
	$id = $_POST['id'];
	$banda = $_POST['banda'];
	$album = $_POST['album'];
	$genero = $_POST['genero'];
	$res = $serviciosReferencias->modificarAlbum($id,$banda,$album,$genero);
	
	if ($res == true) {
		echo '';
	} else {
		echo 'Hubo un error al modificar datos';
	}
}

function eliminarAlbum($serviciosReferencias) {
	$id = $_POST['id'];
	$res = $serviciosReferencias->eliminarAlbum($id);
	echo $res;
} 

function insertarCategorias($serviciosReferencias) { 
	$descripcion = $_POST['descripcion']; 
	$refobras = $_POST['refobras']; 
	$refcuponeras = $_POST['refcuponeras']; 
	$porcentaje = $_POST['porcentaje']; 
	$monto = $_POST['monto']; 
	$pocentajeretenido = $_POST['pocentajeretenido']; 
	
	if (isset($_POST['aplicar'])) { 
		$aplicar = 1; 
	} else { 
		$aplicar = 0; 
	}
	
	if ($aplicar == 0) {
		$res = $serviciosReferencias->insertarCategorias($descripcion,$refobras,$refcuponeras,$porcentaje,$monto,$pocentajeretenido); 
	} else {
		$res = $serviciosReferencias->insertarCategoriasMasivo($descripcion,$refobras,$refcuponeras,$porcentaje,$monto,$pocentajeretenido); 
	}
	
	if ((integer)$res > 0) { 
		echo ''; 
	} else { 
		echo 'Hubo un error al insertar datos';	 
	} 
} 

function modificarCategorias($serviciosReferencias) { 
	$id = $_POST['id']; 
	$descripcion = $_POST['descripcion']; 
	$refobras = $_POST['refobras']; 
	$refcuponeras = $_POST['refcuponeras']; 
	$porcentaje = $_POST['porcentaje']; 
	$monto = $_POST['monto']; 
	$pocentajeretenido = $_POST['pocentajeretenido']; 
	
	$res = $serviciosReferencias->modificarCategorias($id,$descripcion,$refobras,$refcuponeras,$porcentaje,$monto,$pocentajeretenido); 
	
	if ($res == true) { 
		echo ''; 
	} else { 
		echo 'Hubo un error al modificar datos'; 
	} 
} 

function eliminarCategorias($serviciosReferencias) { 
	$id = $_POST['id']; 
	$res = $serviciosReferencias->eliminarCategorias($id); 
	echo $res; 
} 


function insertarPromosobras($serviciosReferencias) { 
	$descripcion = $_POST['descripcion']; 
	$refobras = $_POST['refobras']; 
	$vigenciadesde = $_POST['vigenciadesde']; 
	$vigenciahasta = $_POST['vigenciahasta']; 
	$porcentaje = $_POST['porcentaje']; 
	$monto = $_POST['monto']; 
	
	if (isset($_POST['aplicar'])) { 
		$aplicar = 1; 
	} else { 
		$aplicar = 0; 
	}
	
	if ($aplicar == 0) {
		$res = $serviciosReferencias->insertarPromosobras($descripcion,$refobras,$vigenciadesde,$vigenciahasta,$porcentaje,$monto); 
	} else {
		$res = $serviciosReferencias->insertarPromosobrasMasivo($descripcion,$refobras,$vigenciadesde,$vigenciahasta,$porcentaje,$monto); 
	}
	
	if ((integer)$res > 0) { 
		echo ''; 
	} else { 
		echo 'Hubo un error al insertar datos ';	 
	} 
} 

function modificarPromosobras($serviciosReferencias) { 
	$id = $_POST['id']; 
	$descripcion = $_POST['descripcion']; 
	$refobras = $_POST['refobras']; 
	$vigenciadesde = $_POST['vigenciadesde']; 
	$vigenciahasta = $_POST['vigenciahasta']; 
	$porcentaje = $_POST['porcentaje']; 
	$monto = $_POST['monto']; 
	
	$res = $serviciosReferencias->modificarPromosobras($id,$descripcion,$refobras,$vigenciadesde,$vigenciahasta,$porcentaje,$monto); 
	
	if ($res == true) { 
		echo ''; 
	} else { 
		echo 'Hubo un error al modificar datos'; 
	} 
} 


function eliminarPromosobras($serviciosReferencias) { 
	$id = $_POST['id']; 
	$res = $serviciosReferencias->eliminarPromosobras($id); 
	echo $res; 
} 

function insertarCuponeras($serviciosReferencias) { 
	$nombre = $_POST['nombre']; 
	$direccion = $_POST['direccion']; 
	$telefono = $_POST['telefono']; 
	$cuit = $_POST['cuit']; 
	$email = $_POST['email']; 
	
	if (isset($_POST['activo'])) { 
		$activo	= 1; 
	} else { 
		$activo = 0; 
	} 
	
	$res = $serviciosReferencias->insertarCuponeras($nombre,$direccion,$telefono,$cuit,$email,$activo); 
	
	if ((integer)$res > 0) { 
		echo ''; 
	} else { 
		echo 'Hubo un error al insertar datos';	 
	} 
} 

function modificarCuponeras($serviciosReferencias) { 
	$id = $_POST['id']; 
	$nombre = $_POST['nombre']; 
	$direccion = $_POST['direccion']; 
	$telefono = $_POST['telefono']; 
	$cuit = $_POST['cuit']; 
	$email = $_POST['email']; 
	
	if (isset($_POST['activo'])) { 
		$activo	= 1; 
	} else { 
		$activo = 0; 
	} 
	
	$res = $serviciosReferencias->modificarCuponeras($id,$nombre,$direccion,$telefono,$cuit,$email,$activo); 
	
	if ($res == true) { 
		echo ''; 
	} else { 
		echo 'Hubo un error al modificar datos'; 
	} 
} 

function eliminarCuponeras($serviciosReferencias) { 
	$id = $_POST['id']; 
	$res = $serviciosReferencias->eliminarCuponeras($id); 
	echo $res; 
} 

function insertarClientes($serviciosReferencias) { 
$nombrecompleto = $_POST['nombrecompleto']; 
$cuil = $_POST['cuil']; 
$dni = $_POST['dni']; 
$direccion = $_POST['direccion']; 
$telefono = $_POST['telefono']; 
$email = $_POST['email']; 
$observaciones = $_POST['observaciones']; 
$res = $serviciosReferencias->insertarClientes($nombrecompleto,$cuil,$dni,$direccion,$telefono,$email,$observaciones); 
if ((integer)$res > 0) { 
echo ''; 
} else { 
echo 'Hubo un error al insertar datos';	
} 
} 
function modificarClientes($serviciosReferencias) { 
$id = $_POST['id']; 
$nombrecompleto = $_POST['nombrecompleto']; 
$cuil = $_POST['cuil']; 
$dni = $_POST['dni']; 
$direccion = $_POST['direccion']; 
$telefono = $_POST['telefono']; 
$email = $_POST['email']; 
$observaciones = $_POST['observaciones']; 
$res = $serviciosReferencias->modificarClientes($id,$nombrecompleto,$cuil,$dni,$direccion,$telefono,$email,$observaciones); 
if ($res == true) { 
echo ''; 
} else { 
echo 'Hubo un error al modificar datos'; 
} 
} 
function eliminarClientes($serviciosReferencias) { 
$id = $_POST['id']; 
$res = $serviciosReferencias->eliminarClientes($id); 
echo $res; 
}



function borrarMasivo($serviciosReferencias) {
	$numero = count($_POST);
	$tags = array_keys($_POST);// obtiene los nombres de las varibles
	$valores = array_values($_POST);// obtiene los valores de las varibles
	$cantEncontrados = 0;
	$cantidad = 1;
	$idProducto = 0;
	
	$cad = '';
	
	for($i=0;$i<$numero;$i++){
		
		if (strpos($tags[$i],"produ") !== false) {
			
			if (isset($valores[$i])) {
				
				$idProducto = str_replace("produ","",$tags[$i]);
				
				$res = $serviciosReferencias->eliminarProductos($idProducto); 
			}
		}
	}
	
	echo '';

}


function insertarProveedores($serviciosReferencias) { 
$nombre = $_POST['nombre']; 
$cuit = $_POST['cuit']; 
$dni = $_POST['dni']; 
$direccion = $_POST['direccion']; 
$telefono = $_POST['telefono']; 
$celular = $_POST['celular']; 
$email = $_POST['email']; 
$observacionces = $_POST['observacionces']; 
$res = $serviciosReferencias->insertarProveedores($nombre,$cuit,$dni,$direccion,$telefono,$celular,$email,$observacionces); 
if ((integer)$res > 0) { 
echo ''; 
} else { 
echo 'Hubo un error al insertar datos';	
} 
} 
function modificarProveedores($serviciosReferencias) { 
$id = $_POST['id']; 
$nombre = $_POST['nombre']; 
$cuit = $_POST['cuit']; 
$dni = $_POST['dni']; 
$direccion = $_POST['direccion']; 
$telefono = $_POST['telefono']; 
$celular = $_POST['celular']; 
$email = $_POST['email']; 
$observacionces = $_POST['observacionces']; 
$res = $serviciosReferencias->modificarProveedores($id,$nombre,$cuit,$dni,$direccion,$telefono,$celular,$email,$observacionces); 
if ($res == true) { 
echo ''; 
} else { 
echo 'Hubo un error al modificar datos'; 
} 
} 
function eliminarProveedores($serviciosReferencias) { 
$id = $_POST['id']; 
$res = $serviciosReferencias->eliminarProveedores($id); 
echo $res; 
} 
function insertarUsuarios($serviciosReferencias) { 
$usuario = $_POST['usuario']; 
$password = $_POST['password']; 
$refroles = $_POST['refroles']; 
$email = $_POST['email']; 
$nombrecompleto = $_POST['nombrecompleto']; 
$res = $serviciosReferencias->insertarUsuarios($usuario,$password,$refroles,$email,$nombrecompleto); 
if ((integer)$res > 0) { 
echo ''; 
} else { 
echo 'Hubo un error al insertar datos';	
} 
} 
function modificarUsuarios($serviciosReferencias) { 
$id = $_POST['id']; 
$usuario = $_POST['usuario']; 
$password = $_POST['password']; 
$refroles = $_POST['refroles']; 
$email = $_POST['email']; 
$nombrecompleto = $_POST['nombrecompleto']; 
$res = $serviciosReferencias->modificarUsuarios($id,$usuario,$password,$refroles,$email,$nombrecompleto); 
if ($res == true) { 
echo ''; 
} else { 
echo 'Hubo un error al modificar datos'; 
} 
} 
function eliminarUsuarios($serviciosReferencias) { 
$id = $_POST['id']; 
$res = $serviciosReferencias->eliminarUsuarios($id); 
echo $res; 
} 

function insertarPredio_menu($serviciosReferencias) { 
$url = $_POST['url']; 
$icono = $_POST['icono']; 
$nombre = $_POST['nombre']; 
$Orden = $_POST['Orden']; 
$hover = $_POST['hover']; 
$permiso = $_POST['permiso']; 
$res = $serviciosReferencias->insertarPredio_menu($url,$icono,$nombre,$Orden,$hover,$permiso); 
if ((integer)$res > 0) { 
echo ''; 
} else { 
echo 'Hubo un error al insertar datos';	
} 
} 
function modificarPredio_menu($serviciosReferencias) { 
$id = $_POST['id']; 
$url = $_POST['url']; 
$icono = $_POST['icono']; 
$nombre = $_POST['nombre']; 
$Orden = $_POST['Orden']; 
$hover = $_POST['hover']; 
$permiso = $_POST['permiso']; 
$res = $serviciosReferencias->modificarPredio_menu($id,$url,$icono,$nombre,$Orden,$hover,$permiso); 
if ($res == true) { 
echo ''; 
} else { 
echo 'Hubo un error al modificar datos'; 
} 
} 
function eliminarPredio_menu($serviciosReferencias) { 
$id = $_POST['id']; 
$res = $serviciosReferencias->eliminarPredio_menu($id); 
echo $res; 
} 


function insertarEstados($serviciosReferencias) { 
$estado = $_POST['estado']; 
$icono = $_POST['icono']; 
$res = $serviciosReferencias->insertarEstados($estado,$icono); 
if ((integer)$res > 0) { 
echo ''; 
} else { 
echo 'Hubo un error al insertar datos';	
} 
} 
function modificarEstados($serviciosReferencias) { 
$id = $_POST['id']; 
$estado = $_POST['estado']; 
$icono = $_POST['icono']; 
$res = $serviciosReferencias->modificarEstados($id,$estado,$icono); 
if ($res == true) { 
echo ''; 
} else { 
echo 'Hubo un error al modificar datos'; 
} 
} 
function eliminarEstados($serviciosReferencias) { 
$id = $_POST['id']; 
$res = $serviciosReferencias->eliminarEstados($id); 
echo $res; 
} 

function insertarRoles($serviciosReferencias) { 
$descripcion = $_POST['descripcion']; 
if (isset($_POST['activo'])) { 
$activo	= 1; 
} else { 
$activo = 0; 
} 
$res = $serviciosReferencias->insertarRoles($descripcion,$activo); 
if ((integer)$res > 0) { 
echo ''; 
} else { 
echo 'Hubo un error al insertar datos';	
} 
} 
function modificarRoles($serviciosReferencias) { 
$id = $_POST['id']; 
$descripcion = $_POST['descripcion']; 
if (isset($_POST['activo'])) { 
$activo	= 1; 
} else { 
$activo = 0; 
} 
$res = $serviciosReferencias->modificarRoles($id,$descripcion,$activo); 
if ($res == true) { 
echo ''; 
} else { 
echo 'Hubo un error al modificar datos'; 
} 
} 
function eliminarRoles($serviciosReferencias) { 
$id = $_POST['id']; 
$res = $serviciosReferencias->eliminarRoles($id); 
echo $res; 
} 
function insertarTipopago($serviciosReferencias) { 
$descripcion = $_POST['descripcion']; 
$res = $serviciosReferencias->insertarTipopago($descripcion); 
if ((integer)$res > 0) { 
echo ''; 
} else { 
echo 'Hubo un error al insertar datos';	
} 
} 
function modificarTipopago($serviciosReferencias) { 
$id = $_POST['id']; 
$descripcion = $_POST['descripcion']; 
$res = $serviciosReferencias->modificarTipopago($id,$descripcion); 
if ($res == true) { 
echo ''; 
} else { 
echo 'Hubo un error al modificar datos'; 
} 
} 
function eliminarTipopago($serviciosReferencias) { 
$id = $_POST['id']; 
$res = $serviciosReferencias->eliminarTipopago($id); 
echo $res; 
} 



function insertarCajadiaria($serviciosReferencias) {
	$fecha = $_POST['fecha'];
	$inicio = $_POST['inicio'];
	$fin = 0;
	
	$existe = $serviciosReferencias->traerCajadiariaPorFecha($fecha);
	
	if (mysql_num_rows($existe)>0) {
		$res = $serviciosReferencias->modificarCajadiaria(mysql_result($existe,0,0),$fecha,$inicio,$fin);
	} else {
		$res = $serviciosReferencias->insertarCajadiaria($fecha,$inicio,$fin);
	}
	
	if ((integer)$res > 0) {
		echo '';
	} else {
		echo 'Hubo un error al insertar datos';
	}
}

function traerCajadiariaPorFecha($serviciosReferencias) {
	$fecha = $_POST['fecha'];	
	
	$res = $serviciosReferencias->traerCajadiariaPorFecha($fecha);
	
	if (mysql_num_rows($res)>0) {
		echo mysql_result($res,0,'inicio');	
	} else {
		echo 0;
	}
}

function modificarCajadiaria($serviciosReferencias) {
$id = $_POST['id'];
$fecha = $_POST['fecha'];
$inicio = $_POST['inicio'];
$fin = $_POST['fin'];
$res = $serviciosReferencias->modificarCajadiaria($id,$fecha,$inicio,$fin);
if ($res == true) {
echo '';
} else {
echo 'Hubo un error al modificar datos';
}
}
function eliminarCajadiaria($serviciosReferencias) {
$id = $_POST['id'];
$res = $serviciosReferencias->eliminarCajadiaria($id);
echo $res;
} 














/* PARA Tiposcargos */

function insertarCooperativas($serviciosReferencias) { 
	$descripcion = $_POST['descripcion']; 
	$puntos = $_POST['puntos']; 
	$numero = $_POST['numero']; 
	$puntosproduccion = $_POST['puntosproduccion']; 
	$puntossinproduccion = $_POST['puntossinproduccion']; 
	$fechacreacion = $_POST['fechacreacion']; 
	$usuacrea = $_POST['usuacrea']; 
	$fechamodi = $_POST['fechamodi']; 
	$usuamodi = $_POST['usuamodi']; 
	
	if (isset($_POST['activo'])) { 
		$activo	= 1; 
	} else { 
		$activo = 0; 
	} 
	
	$res = $serviciosReferencias->insertarCooperativas($descripcion,$numero,$puntos,$puntosproduccion,$puntossinproduccion,$fechacreacion,$usuacrea,$fechamodi,$usuamodi,$activo); 
	
	if ((integer)$res > 0) { 
		$resUser = $serviciosReferencias->traerObras();
				$cad = 'user';
				while ($rowFS = mysql_fetch_array($resUser)) {
					if (isset($_POST[$cad.$rowFS[0]])) {
						$serviciosReferencias->insertarObrascooperativas($rowFS[0],$res);
					}
				}
				
		$resPersonal = $serviciosReferencias->traerPersonal();
				$cad = 'personal';
				$cadPuntos = "puntospersonal";
				while ($rowFS = mysql_fetch_array($resPersonal)) {
					if (isset($_POST[$cad.$rowFS[0]])) {
						$serviciosReferencias->insertarPersonalcooperativas($rowFS[0],$res, $_POST[$cadPuntos.$rowFS[0]]);
					}
				}
				
		echo ''; 
	} else { 
		echo 'Hubo un error al insertar datos';	 
	} 
} 

function modificarCooperativas($serviciosReferencias) { 
	$id = $_POST['id']; 
	$descripcion = $_POST['descripcion']; 
	$numero = $_POST['numero'];
	$puntos = $_POST['puntos']; 
	$puntosproduccion = $_POST['puntosproduccion']; 
	$puntossinproduccion = $_POST['puntossinproduccion']; 
	$fechacreacion = $_POST['fechacreacion']; 
	$usuacrea = $_POST['usuacrea']; 
	$fechamodi = $_POST['fechamodi']; 
	$usuamodi = $_POST['usuamodi']; 
	
	if (isset($_POST['activo'])) { 
		$activo	= 1; 
	} else { 
		$activo = 0; 
	} 
	
	$res = $serviciosReferencias->modificarCooperativas($id,$numero,$descripcion,$numero,$puntos,$puntosproduccion,$puntossinproduccion,$fechacreacion,$usuacrea,$fechamodi,$usuamodi,$activo); 
	
	if ($res == true) { 
		$serviciosReferencias->eliminarObrascooperativasPorCooperativa($id);
		$resUser = $serviciosReferencias->traerObras();
		$cad = 'user';
		while ($rowFS = mysql_fetch_array($resUser)) {
			if (isset($_POST[$cad.$rowFS[0]])) {
				$serviciosReferencias->insertarObrascooperativas($rowFS[0],$id);
			}
		}
		
		$serviciosReferencias->eliminarPersonalcooperativasPorCooperativa($id);
		$resPersonal = $serviciosReferencias->traerPersonal();
		$cad = 'personal';
		$cadPuntos = "puntospersonal";
		while ($rowFS = mysql_fetch_array($resPersonal)) {
			if (isset($_POST[$cad.$rowFS[0]])) {
				$serviciosReferencias->insertarPersonalcooperativas($rowFS[0],$id, $_POST[$cadPuntos.$rowFS[0]]);
			}
		}
		
		echo ''; 
	} else { 
		echo 'Hubo un error al modificar datos'; 
	} 
} 


function eliminarCooperativas($serviciosReferencias) { 
$id = $_POST['id']; 
$res = $serviciosReferencias->eliminarCooperativas($id); 
echo $res; 
} 
function insertarDatosbancos($serviciosReferencias) { 
$refpersonal = $_POST['refpersonal']; 
$cbu = $_POST['cbu']; 
$nrocuenta = $_POST['nrocuenta']; 
$tipoproducto = $_POST['tipoproducto']; 
$formaoperar = $_POST['formaoperar']; 
$fechacrea = $_POST['fechacrea']; 
$usuacrea = $_POST['usuacrea']; 
$fechamodi = $_POST['fechamodi']; 
$usuamodi = $_POST['usuamodi']; 
$res = $serviciosReferencias->insertarDatosbancos($refpersonal,$cbu,$nrocuenta,$tipoproducto,$formaoperar,$fechacrea,$usuacrea,$fechamodi,$usuamodi); 
if ((integer)$res > 0) { 
echo ''; 
} else { 
echo 'Hubo un error al insertar datos';	 
} 
} 
function modificarDatosbancos($serviciosReferencias) { 
$id = $_POST['id']; 
$refpersonal = $_POST['refpersonal']; 
$cbu = $_POST['cbu']; 
$nrocuenta = $_POST['nrocuenta']; 
$tipoproducto = $_POST['tipoproducto']; 
$formaoperar = $_POST['formaoperar']; 
$fechacrea = $_POST['fechacrea']; 
$usuacrea = $_POST['usuacrea']; 
$fechamodi = $_POST['fechamodi']; 
$usuamodi = $_POST['usuamodi']; 
$res = $serviciosReferencias->modificarDatosbancos($id,$refpersonal,$cbu,$nrocuenta,$tipoproducto,$formaoperar,$fechacrea,$usuacrea,$fechamodi,$usuamodi); 
if ($res == true) { 
echo ''; 
} else { 
echo 'Hubo un error al modificar datos'; 
} 
} 
function eliminarDatosbancos($serviciosReferencias) { 
$id = $_POST['id']; 
$res = $serviciosReferencias->eliminarDatosbancos($id); 
echo $res; 
} 
function insertarDomicilios($serviciosReferencias) { 
	$refpersonal = $_POST['refpersonal']; 
	$calle = $_POST['calle']; 
	$nro = $_POST['nro']; 
	$piso = $_POST['piso']; 
	$departamento = $_POST['departamento']; 
	$codigopostal = $_POST['codigopostal']; 
	$localidad = $_POST['localidad']; 
	$provincia = $_POST['provincia']; 
	$telefonoparticular = $_POST['telefonoparticular']; 
	$telefonocelular = $_POST['telefonocelular']; 
	
	$res = $serviciosReferencias->insertarDomicilios($refpersonal,$calle,$nro,$piso,$departamento,$codigopostal,$localidad,$provincia,$telefonoparticular,$telefonocelular); 
	
	if ((integer)$res > 0) { 
		echo ''; 
	} else { 
		echo 'Hubo un error al insertar datos ';	 
	} 
} 
function modificarDomicilios($serviciosReferencias) { 
	$id = $_POST['id']; 
	$refpersonal = $_POST['refpersonal']; 
	$calle = $_POST['calle']; 
	$nro = $_POST['nro']; 
	$piso = $_POST['piso']; 
	$departamento = $_POST['departamento']; 
	$codigopostal = $_POST['codigopostal']; 
	$localidad = $_POST['localidad']; 
	$provincia = $_POST['provincia']; 
	$telefonoparticular = $_POST['telefonoparticular']; 
	$telefonocelular = $_POST['telefonocelular']; 
	
	$res = $serviciosReferencias->modificarDomicilios($id,$refpersonal,$calle,$nro,$piso,$departamento,$codigopostal,$localidad,$provincia,$telefonoparticular,$telefonocelular); 
	
	if ($res == true) { 
		echo ''; 
	} else { 
		echo 'Hubo un error al modificar datos'; 
	} 
} 
function eliminarDomicilios($serviciosReferencias) { 
$id = $_POST['id']; 
$res = $serviciosReferencias->eliminarDomicilios($id); 
echo $res; 
}
 
function insertarGastosobras($serviciosReferencias) { 
	$reffunciones = $_POST['reffunciones']; 
	$descripcion = $_POST['descripcion']; 
	$monto = $_POST['monto']; 
	$fecha = $_POST['fecha']; 
	$fechacreacion = date('Y-m-d'); 
	$usuacrea = $_POST['usuacrea']; 
	
	$res = $serviciosReferencias->insertarGastosobras($reffunciones,$descripcion,$monto,$fecha,$fechacreacion,$usuacrea); 
	
	if ((integer)$res > 0) { 
		echo ''; 
	} else { 
		echo 'Hubo un error al insertar datos';	 
	} 
} 


function modificarGastosobras($serviciosReferencias) { 
	$id = $_POST['id']; 
	$reffunciones = $_POST['reffunciones']; 
	$descripcion = $_POST['descripcion']; 
	$monto = $_POST['monto']; 
	$fecha = $_POST['fecha']; 
	$fechacreacion = $_POST['fechacreacion']; 
	$usuacrea = $_POST['usuacrea']; 
	
	$res = $serviciosReferencias->modificarGastosobras($id,$reffunciones,$descripcion,$monto,$fecha,$fechacreacion,$usuacrea); 
	
	if ($res == true) { 
		echo ''; 
	} else { 
		echo 'Hubo un error al modificar datos'; 
	} 
} 

function eliminarGastosobras($serviciosReferencias) { 
	$id = $_POST['id']; 
	
	$res = $serviciosReferencias->eliminarGastosobras($id); 
	
	echo $res; 
} 


function traerSaldoPuntosObras($serviciosReferencias) {
	$idObra =	$_POST['idobra']; 
	
	$res = $serviciosReferencias->traerSaldoPuntosObras($idObra); 
	
	echo $res; 
}
 
function insertarObras($serviciosReferencias) { 
	$nombre = $_POST['nombre']; 
	$refsalas = $_POST['refsalas']; 
	$valorentrada = $_POST['valorentrada']; 
	$cantpulicidad = $_POST['cantpulicidad']; 
	$valorpulicidad = $_POST['valorpulicidad']; 
	$valorticket = $_POST['valorticket']; 
	$costotranscciontarjetaiva = $_POST['costotranscciontarjetaiva']; 
	$porcentajeargentores = $_POST['porcentajeargentores']; 
	$porcentajereparto = $_POST['porcentajereparto']; 
	$porcentajeretencion = $_POST['porcentajeretencion']; 
	$fechacreacion = $_POST['fechacreacion']; 
	$usuacrea = $_POST['usuacrea']; 
	$fechamodi = $_POST['fechamodi']; 
	$usuamodi = $_POST['usuamodi']; 
	$refsedes = $_POST['refsedes'];
	
	if (isset($_POST['activo'])) { 
		$activo	= 1; 
	} else { 
		$activo = 0; 
	} 
	
	$res = $serviciosReferencias->insertarObras($nombre,$refsalas,$valorentrada,$cantpulicidad,$valorpulicidad,$valorticket,$costotranscciontarjetaiva,$porcentajeargentores,$porcentajereparto,$porcentajeretencion,$fechacreacion,$usuacrea,$fechamodi,$usuamodi,$activo,$refsedes); 
	
	if ((integer)$res > 0) { 
		$resUser = $serviciosReferencias->traerAlbum();
		$cad = 'user';
		while ($rowFS = mysql_fetch_array($resUser)) {
			if (isset($_POST[$cad.$rowFS[0]])) {
				$serviciosReferencias->insertarAlbumobras($res,$rowFS[0]);
			}
		}
		echo ''; 
	} else { 
		echo 'Hubo un error al insertar datos';	 
	} 
} 


function modificarObras($serviciosReferencias) { 
	$id = $_POST['id']; 
	$nombre = $_POST['nombre']; 
	$refsalas = $_POST['refsalas']; 
	$valorentrada = $_POST['valorentrada']; 
	$cantpulicidad = $_POST['cantpulicidad']; 
	$valorpulicidad = $_POST['valorpulicidad']; 
	$valorticket = $_POST['valorticket']; 
	$costotranscciontarjetaiva = $_POST['costotranscciontarjetaiva']; 
	$porcentajeargentores = $_POST['porcentajeargentores']; 
	$porcentajereparto = $_POST['porcentajereparto']; 
	$porcentajeretencion = $_POST['porcentajeretencion']; 
	$fechacreacion = $_POST['fechacreacion']; 
	$usuacrea = $_POST['usuacrea']; 
	$fechamodi = $_POST['fechamodi']; 
	$usuamodi = $_POST['usuamodi']; 
	$refsedes = $_POST['refsedes'];
	
	if (isset($_POST['activo'])) { 
		$activo	= 1; 
	} else { 
		$activo = 0; 
	} 
	
	$res = $serviciosReferencias->modificarObras($id,$nombre,$refsalas,$valorentrada,$cantpulicidad,$valorpulicidad,$valorticket,$costotranscciontarjetaiva,$porcentajeargentores,$porcentajereparto,$porcentajeretencion,$fechacreacion,$usuacrea,$fechamodi,$usuamodi,$activo, $refsedes); 
	if ($res == true) { 
		$serviciosReferencias->eliminarAlbumobrasPorObra($id);
			$resUser = $serviciosReferencias->traerAlbum();
			$cad = 'user';
			while ($rowFS = mysql_fetch_array($resUser)) {
				if (isset($_POST[$cad.$rowFS[0]])) {
					$serviciosReferencias->insertarAlbumobras($id,$rowFS[0]);
				}
			}
		echo ''; 
	} else { 
		echo 'Hubo un error al modificar datos'; 
	} 
} 


function eliminarObras($serviciosReferencias) { 
$id = $_POST['id']; 
$res = $serviciosReferencias->eliminarObras($id); 
echo $res; 
} 
function insertarObrascooperativas($serviciosReferencias) { 
$refobras = $_POST['refobras']; 
$refcooperativas = $_POST['refcooperativas']; 
$res = $serviciosReferencias->insertarObrascooperativas($refobras,$refcooperativas); 
if ((integer)$res > 0) { 
echo ''; 
} else { 
echo 'Hubo un error al insertar datos';	 
} 
} 
function modificarObrascooperativas($serviciosReferencias) { 
$id = $_POST['id']; 
$refobras = $_POST['refobras']; 
$refcooperativas = $_POST['refcooperativas']; 
$res = $serviciosReferencias->modificarObrascooperativas($id,$refobras,$refcooperativas); 
if ($res == true) { 
echo ''; 
} else { 
echo 'Hubo un error al modificar datos'; 
} 
} 
function eliminarObrascooperativas($serviciosReferencias) { 
$id = $_POST['id']; 
$res = $serviciosReferencias->eliminarObrascooperativas($id); 
echo $res; 
} 
function insertarPersonal($serviciosReferencias) { 
$reftipodocumento = $_POST['reftipodocumento']; 
$nrodocumento = $_POST['nrodocumento']; 
$apellido = $_POST['apellido']; 
$nombre = $_POST['nombre']; 
$fechanacimiento = $_POST['fechanacimiento']; 
$cuil = $_POST['cuil']; 
$sexo = $_POST['sexo']; 
$refestadocivil = $_POST['refestadocivil']; 
$paisorigen = $_POST['paisorigen']; 
$fechacrea = $_POST['fechacrea']; 
$usuacrea = $_POST['usuacrea']; 
$fechamodi = $_POST['fechamodi']; 
$usuamodi = $_POST['usuamodi']; 
$res = $serviciosReferencias->insertarPersonal($reftipodocumento,$nrodocumento,$apellido,$nombre,$fechanacimiento,$cuil,$sexo,$refestadocivil,$paisorigen,$fechacrea,$usuacrea,$fechamodi,$usuamodi); 
if ((integer)$res > 0) { 
echo ''; 
} else { 
echo 'Hubo un error al insertar datos';	 
} 
} 
function modificarPersonal($serviciosReferencias) { 
$id = $_POST['id']; 
$reftipodocumento = $_POST['reftipodocumento']; 
$nrodocumento = $_POST['nrodocumento']; 
$apellido = $_POST['apellido']; 
$nombre = $_POST['nombre']; 
$fechanacimiento = $_POST['fechanacimiento']; 
$cuil = $_POST['cuil']; 
$sexo = $_POST['sexo']; 
$refestadocivil = $_POST['refestadocivil']; 
$paisorigen = $_POST['paisorigen']; 
$fechacrea = $_POST['fechacrea']; 
$usuacrea = $_POST['usuacrea']; 
$fechamodi = $_POST['fechamodi']; 
$usuamodi = $_POST['usuamodi']; 
$res = $serviciosReferencias->modificarPersonal($id,$reftipodocumento,$nrodocumento,$apellido,$nombre,$fechanacimiento,$cuil,$sexo,$refestadocivil,$paisorigen,$fechacrea,$usuacrea,$fechamodi,$usuamodi); 
if ($res == true) { 
echo ''; 
} else { 
echo 'Hubo un error al modificar datos'; 
} 
} 
function eliminarPersonal($serviciosReferencias) { 
$id = $_POST['id']; 
$res = $serviciosReferencias->eliminarPersonal($id); 
echo $res; 
} 
function insertarPersonalcargos($serviciosReferencias) { 
	$refpersonal = $_POST['refpersonal']; 
	$reftiposcargos = $_POST['reftiposcargos']; 
	$reffunciones = $_POST['reffunciones']; 
	$fechaalta = $_POST['fechaalta']; 
	$fechabaja = $_POST['fechabaja']; 
	$fechabajatentativa = $_POST['fechabajatentativa']; 
	$puntos = $_POST['puntos']; 
	$monto = $_POST['monto']; 
	$fechacrea = date('Y-m-d'); 
	$usuacrea = $_POST['usuacrea']; 
	$fechamodi = date('Y-m-d'); 
	$usuamodi = $_POST['usuamodi']; 
	
	
	
	if ($serviciosReferencias->existeCargo($refpersonal,$reffunciones)>0) {
		echo 'El cargo ya existe para esa funcion';
	} else {
		$res = $serviciosReferencias->insertarPersonalcargos($refpersonal,$reftiposcargos,$reffunciones,$fechaalta,$fechabaja,$fechabajatentativa,$puntos,$monto,$fechacrea,$usuacrea,$fechamodi,$usuamodi); 
		if ((integer)$res > 0) { 
			echo ''; 
		} else { 
			echo 'Hubo un error al insertar datos';	 
		} 
	}
} 


function modificarPersonalcargos($serviciosReferencias) { 
	$id = $_POST['id']; 
	$refpersonal = $_POST['refpersonal']; 
	$reftiposcargos = $_POST['reftiposcargos']; 
	$reffunciones = $_POST['reffunciones']; 
	$fechaalta = $_POST['fechaalta']; 
	$fechabaja = $_POST['fechabaja']; 
	$fechabajatentativa = $_POST['fechabajatentativa']; 
	$puntos = $_POST['puntos']; 
	$monto = $_POST['monto']; 
	$fechacrea = $_POST['fechacrea']; 
	$usuacrea = $_POST['usuacrea']; 
	$fechamodi = $_POST['fechamodi']; 
	$usuamodi = $_POST['usuamodi']; 
	
	$resCargo = $serviciosReferencias->traerPersonalcargosPorId($id);
	
	if (mysql_result($resCargo,0,'reffunciones') == $reffunciones) {
		$existe = 0;	
	} else {
		$existe = $serviciosReferencias->existeCargo($refpersonal,$reffunciones);
	}
	
	if ($existe == 0) {
		$res = $serviciosReferencias->modificarPersonalcargos($id,$refpersonal,$reftiposcargos,$reffunciones,$fechaalta,$fechabaja,$fechabajatentativa,$puntos,$monto,$fechacrea,$usuacrea,$fechamodi,$usuamodi); 
		
		if ($res == true) { 
			echo ''; 
		} else { 
			echo 'Hubo un error al modificar datos'; 
		} 
	} else {
		echo 'Ya existe el cargo para esa funcion'; 	
	}
} 


function eliminarPersonalcargos($serviciosReferencias) { 
	$id = $_POST['id']; 
	$res = $serviciosReferencias->eliminarPersonalcargos($id); 
	echo $res; 
} 



function insertarEstadocivil($serviciosReferencias) { 
$estadocivil = $_POST['estadocivil']; 
if (isset($_POST['activo'])) { 
$activo	= 1; 
} else { 
$activo = 0; 
} 
$res = $serviciosReferencias->insertarEstadocivil($estadocivil,$activo); 
if ((integer)$res > 0) { 
echo ''; 
} else { 
echo 'Hubo un error al insertar datos';	 
} 
} 
function modificarEstadocivil($serviciosReferencias) { 
$id = $_POST['id']; 
$estadocivil = $_POST['estadocivil']; 
if (isset($_POST['activo'])) { 
$activo	= 1; 
} else { 
$activo = 0; 
} 
$res = $serviciosReferencias->modificarEstadocivil($id,$estadocivil,$activo); 
if ($res == true) { 
echo ''; 
} else { 
echo 'Hubo un error al modificar datos'; 
} 
} 
function eliminarEstadocivil($serviciosReferencias) { 
$id = $_POST['id']; 
$res = $serviciosReferencias->eliminarEstadocivil($id); 
echo $res; 
} 




function insertarSalas($serviciosReferencias) { 
$descripcion = $_POST['descripcion']; 
$capacidad = $_POST['capacidad']; 
if (isset($_POST['activa'])) { 
$activa	= 1; 
} else { 
$activa = 0; 
} 
$res = $serviciosReferencias->insertarSalas($descripcion,$capacidad,$activa); 
if ((integer)$res > 0) { 
echo ''; 
} else { 
echo 'Hubo un error al insertar datos';	 
} 
} 
function modificarSalas($serviciosReferencias) { 
$id = $_POST['id']; 
$descripcion = $_POST['descripcion']; 
$capacidad = $_POST['capacidad']; 
if (isset($_POST['activa'])) { 
$activa	= 1; 
} else { 
$activa = 0; 
} 
$res = $serviciosReferencias->modificarSalas($id,$descripcion,$capacidad,$activa); 
if ($res == true) { 
echo ''; 
} else { 
echo 'Hubo un error al modificar datos'; 
} 
} 
function eliminarSalas($serviciosReferencias) { 
$id = $_POST['id']; 
$res = $serviciosReferencias->eliminarSalas($id); 
echo $res; 
} 



function insertarSedes($serviciosReferencias) { 
	$sede = $_POST['sede']; 
	
	if (isset($_POST['activo'])) { 
		$activo	= 1; 
	} else { 
		$activo = 0; 
	} 
	
	$res = $serviciosReferencias->insertarSedes($sede,$activo); 
	
	if ((integer)$res > 0) { 
		echo ''; 
	} else { 
		echo 'Hubo un error al insertar datos';	 
	} 
} 


function modificarSedes($serviciosReferencias) { 
	$id = $_POST['id']; 
	$sede = $_POST['sede']; 
	
	if (isset($_POST['activo'])) { 
		$activo	= 1; 
	} else { 
		$activo = 0; 
	} 
	
	$res = $serviciosReferencias->modificarSedes($id,$sede,$activo); 
	
	if ($res == true) { 
		echo ''; 
	} else { 
		echo 'Hubo un error al modificar datos'; 
	} 
} 

function eliminarSedes($serviciosReferencias) { 
	$id = $_POST['id']; 
	$res = $serviciosReferencias->eliminarSedes($id); 
	echo $res; 
} 



function insertarTipoconceptos($serviciosReferencias) { 
$tipoconcepto = $_POST['tipoconcepto']; 
if (isset($_POST['activo'])) { 
$activo	= 1; 
} else { 
$activo = 0; 
} 
$res = $serviciosReferencias->insertarTipoconceptos($tipoconcepto,$activo); 
if ((integer)$res > 0) { 
echo ''; 
} else { 
echo 'Hubo un error al insertar datos';	 
} 
} 
function modificarTipoconceptos($serviciosReferencias) { 
$id = $_POST['id']; 
$tipoconcepto = $_POST['tipoconcepto']; 
if (isset($_POST['activo'])) { 
$activo	= 1; 
} else { 
$activo = 0; 
} 
$res = $serviciosReferencias->modificarTipoconceptos($id,$tipoconcepto,$activo); 
if ($res == true) { 
echo ''; 
} else { 
echo 'Hubo un error al modificar datos'; 
} 
} 
function eliminarTipoconceptos($serviciosReferencias) { 
$id = $_POST['id']; 
$res = $serviciosReferencias->eliminarTipoconceptos($id); 
echo $res; 
} 
function insertarTipodocumento($serviciosReferencias) { 
$tipodocumento = $_POST['tipodocumento']; 
if (isset($_POST['activo'])) { 
$activo	= 1; 
} else { 
$activo = 0; 
} 
$res = $serviciosReferencias->insertarTipodocumento($tipodocumento,$activo); 
if ((integer)$res > 0) { 
echo ''; 
} else { 
echo 'Hubo un error al insertar datos';	 
} 
} 
function modificarTipodocumento($serviciosReferencias) { 
$id = $_POST['id']; 
$tipodocumento = $_POST['tipodocumento']; 
if (isset($_POST['activo'])) { 
$activo	= 1; 
} else { 
$activo = 0; 
} 
$res = $serviciosReferencias->modificarTipodocumento($id,$tipodocumento,$activo); 
if ($res == true) { 
echo ''; 
} else { 
echo 'Hubo un error al modificar datos'; 
} 
} 
function eliminarTipodocumento($serviciosReferencias) { 
$id = $_POST['id']; 
$res = $serviciosReferencias->eliminarTipodocumento($id); 
echo $res; 
} 


 
function insertarTiposcargos($serviciosReferencias) { 
$cargo = $_POST['cargo']; 
if (isset($_POST['activo'])) { 
$activo	= 1; 
} else { 
$activo = 0; 
} 
$res = $serviciosReferencias->insertarTiposcargos($cargo,$activo); 
if ((integer)$res > 0) { 
echo ''; 
} else { 
echo 'Hubo un error al insertar datos';	 
} 
} 
function modificarTiposcargos($serviciosReferencias) { 
$id = $_POST['id']; 
$cargo = $_POST['cargo']; 
if (isset($_POST['activo'])) { 
$activo	= 1; 
} else { 
$activo = 0; 
} 
$res = $serviciosReferencias->modificarTiposcargos($id,$cargo,$activo); 
if ($res == true) { 
echo ''; 
} else { 
echo 'Hubo un error al modificar datos'; 
} 
} 
function eliminarTiposcargos($serviciosReferencias) { 
$id = $_POST['id']; 
$res = $serviciosReferencias->eliminarTiposcargos($id); 
echo $res; 
} 

/* Fin */
////////////////////////// FIN DE TRAER DATOS ////////////////////////////////////////////////////////////

//////////////////////////  BASICO  /////////////////////////////////////////////////////////////////////////

function toArray($query)
{
    $res = array();
    while ($row = @mysql_fetch_array($query)) {
        $res[] = $row;
    }
    return $res;
}


function entrar($serviciosUsuarios) {
	$email		=	$_POST['email'];
	$pass		=	$_POST['pass'];
	echo $serviciosUsuarios->loginUsuario($email,$pass);
}


function cambiarSede($serviciosUsuarios) {
	$sede		=	$_POST['sede'];

	echo $serviciosUsuarios->cambiarSede($sede);
}


function registrar($serviciosUsuarios) {
	$usuario			=	$_POST['usuario'];
	$password			=	$_POST['password'];
	$refroll			=	$_POST['refroll'];
	$email				=	$_POST['email'];
	$nombre				=	$_POST['nombrecompleto'];
	
	$res = $serviciosUsuarios->insertarUsuario($usuario,$password,$refroll,$email,$nombre);
	if ((integer)$res > 0) {
		echo '';	
	} else {
		echo $res;	
	}
}

function recuperar($serviciosUsuarios) {
	$email		=		$_POST['email'];
	
	$res		=	$serviciosUsuarios->recuperar($email);
	
	echo $res;
}


function insertarUsuario($serviciosUsuarios) {
	$usuario			=	$_POST['usuario'];
	$password			=	$_POST['password'];
	$refroll			=	$_POST['refroles'];
	$email				=	$_POST['email'];
	$nombre				=	$_POST['nombrecompleto'];
	$sedes				=	$_POST['refsedes'];
	$refpersonal		=	$_POST['refpersonal'];
	
	$res = $serviciosUsuarios->insertarUsuario($usuario,$password,$refroll,$email,$nombre,$sedes,$refpersonal);
	if ((integer)$res > 0) {
		echo '';	
	} else {
		echo $res;	
	}
}


function modificarUsuario($serviciosUsuarios) {
	$id					=	$_POST['id'];
	$usuario			=	$_POST['usuario'];
	$password			=	$_POST['password'];
	$refroll			=	$_POST['refroles'];
	$email				=	$_POST['email'];
	$nombre				=	$_POST['nombrecompleto'];
	$sedes				=	$_POST['refsedes'];
	$refpersonal		=	$_POST['refpersonal'];
	
	echo $serviciosUsuarios->modificarUsuario($id,$usuario,$password,$refroll,$email,$nombre,$sedes,$refpersonal);
}


function enviarMail($serviciosUsuarios) {
	$email		=	$_POST['email'];
	$pass		=	$_POST['pass'];
	$idsede  =	$_POST['sede'];
	
	echo $serviciosUsuarios->login($email,$pass,$idsede);
}


function devolverImagen($nroInput) {
	
	if( $_FILES['archivo'.$nroInput]['name'] != null && $_FILES['archivo'.$nroInput]['size'] > 0 ){
	// Nivel de errores
	  error_reporting(E_ALL);
	  $altura = 100;
	  // Constantes
	  # Altura de el thumbnail en píxeles
	  //define("ALTURA", 100);
	  # Nombre del archivo temporal del thumbnail
	  //define("NAMETHUMB", "/tmp/thumbtemp"); //Esto en servidores Linux, en Windows podría ser:
	  //define("NAMETHUMB", "c:/windows/temp/thumbtemp"); //y te olvidas de los problemas de permisos
	  $NAMETHUMB = "c:/windows/temp/thumbtemp";
	  # Servidor de base de datos
	  //define("DBHOST", "localhost");
	  # nombre de la base de datos
	  //define("DBNAME", "portalinmobiliario");
	  # Usuario de base de datos
	  //define("DBUSER", "root");
	  # Password de base de datos
	  //define("DBPASSWORD", "");
	  // Mime types permitidos
	  $mimetypes = array("image/jpeg", "image/pjpeg", "image/gif", "image/png");
	  // Variables de la foto
	  $name = $_FILES["archivo".$nroInput]["name"];
	  $type = $_FILES["archivo".$nroInput]["type"];
	  $tmp_name = $_FILES["archivo".$nroInput]["tmp_name"];
	  $size = $_FILES["archivo".$nroInput]["size"];
	  // Verificamos si el archivo es una imagen válida
	  if(!in_array($type, $mimetypes))
		die("El archivo que subiste no es una imagen válida");
	  // Creando el thumbnail
	  switch($type) {
		case $mimetypes[0]:
		case $mimetypes[1]:
		  $img = imagecreatefromjpeg($tmp_name);
		  break;
		case $mimetypes[2]:
		  $img = imagecreatefromgif($tmp_name);
		  break;
		case $mimetypes[3]:
		  $img = imagecreatefrompng($tmp_name);
		  break;
	  }
	  
	  $datos = getimagesize($tmp_name);
	  
	  $ratio = ($datos[1]/$altura);
	  $ancho = round($datos[0]/$ratio);
	  $thumb = imagecreatetruecolor($ancho, $altura);
	  imagecopyresized($thumb, $img, 0, 0, 0, 0, $ancho, $altura, $datos[0], $datos[1]);
	  switch($type) {
		case $mimetypes[0]:
		case $mimetypes[1]:
		  imagejpeg($thumb, $NAMETHUMB);
			  break;
		case $mimetypes[2]:
		  imagegif($thumb, $NAMETHUMB);
		  break;
		case $mimetypes[3]:
		  imagepng($thumb, $NAMETHUMB);
		  break;
	  }
	  // Extrae los contenidos de las fotos
	  # contenido de la foto original
	  $fp = fopen($tmp_name, "rb");
	  $tfoto = fread($fp, filesize($tmp_name));
	  $tfoto = addslashes($tfoto);
	  fclose($fp);
	  # contenido del thumbnail
	  $fp = fopen($NAMETHUMB, "rb");
	  $tthumb = fread($fp, filesize($NAMETHUMB));
	  $tthumb = addslashes($tthumb);
	  fclose($fp);
	  // Borra archivos temporales si es que existen
	  //@unlink($tmp_name);
	  //@unlink(NAMETHUMB);
	} else {
		$tfoto = '';
		$type = '';
	}
	$tfoto = utf8_decode($tfoto);
	return array('tfoto' => $tfoto, 'type' => $type);	
}


?>