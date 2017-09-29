<?php

date_default_timezone_set('America/Buenos_Aires');

include ('../includes/funcionesUsuarios.php');
include ('../includes/funciones.php');
include ('../includes/funcionesHTML.php');
include ('../includes/funcionesReferencias.php');


$serviciosUsuarios  		= new ServiciosUsuarios();
$serviciosFunciones 		= new Servicios();
$serviciosHTML				= new ServiciosHTML();
$serviciosReferencias 		= new ServiciosReferencias();
//$serviciosReportes			= new ServiciosReportes();

$fecha = date('Y-m-d');

require('fpdf.php');

//$header = array("Hora", "Cancha 1", "Cancha 2", "Cancha 3");

$id				=	$_GET['id'];
$desde			=	$_GET['desde'];
$hasta			=	$_GET['hasta'];

$mes 			=	date('M', strtotime($desde));

$resObra		=	$serviciosReferencias->traerObrascooperativasPorObra($id);

$resBruto		=	$serviciosReferencias->traerTotalCooperativaPorObra($id,$desde, $hasta);

$resFactura		=	$serviciosReferencias->traerPersonalcooperativasPorObra($id);


$TotalIngresos = 0;
$TotalEgresos = 0;
$Totales = 0;
$Caja = 0;



class PDF extends FPDF
{
// Cargar los datos




// Tabla coloreada
function ingresosFacturacion($header, $data, &$TotalIngresos)
{
	
	/*
	$this->SetFont('Arial','',12);
	$this->Ln();
	$this->Ln();
	$this->Cell(60,7,'Facturación General',0,0,'L',false);
	$this->SetFont('Arial','',11);
    // Colores, ancho de línea y fuente en negrita
    $this->SetFillColor(255,0,0);
    $this->SetTextColor(255);
    $this->SetDrawColor(128,0,0);
    $this->SetLineWidth(.3);
	$this->Ln();
	
	
    // Cabecera
    $w = array(80,30,30,30);
    for($i=0;$i<count($header);$i++)
        $this->Cell($w[$i],6,$header[$i],1,0,'C',true);
    $this->Ln();
    // Restauración de colores y fuentes
    $this->SetFillColor(224,235,255);
    $this->SetTextColor(0);
    $this->SetFont('');
    // Datos
    $fill = false;
	
	$total = 0;
	$totalcant = 0;
	$sumSaldos = 0;
	$sumAbonos = 0;
	
	$this->SetFont('Arial','',9);
    while ($row = mysql_fetch_array($data))
    {
		$sumSaldos = $sumSaldos + $row['total'];
		$total = $total + $row['total'];
		$totalcant = $totalcant + 1;
		
        $this->Cell($w[0],5,$row['nombre'],'LR',0,'L',$fill);
		$this->Cell($w[1],5,number_format($row['cantidad'],0,',','.'),'LR',0,'C',$fill);
		$this->Cell($w[2],5,number_format($row['precio'],2,',','.'),'LR',0,'R',$fill);
		$this->Cell($w[3],5,number_format($row['total'],2,',','.'),'LR',0,'R',$fill);
        $this->Ln();
        
		
		if ($totalcant == 25) {
			$this->AddPage();
			$this->SetFont('Arial','',11);
			// Colores, ancho de línea y fuente en negrita
			$this->SetFillColor(255,0,0);
			$this->SetTextColor(255);
			$this->SetDrawColor(128,0,0);
			$this->SetLineWidth(.3);
			for($i=0;$i<count($header);$i++)
				$this->Cell($w[$i],6,$header[$i],1,0,'C',true);
			$this->Ln();
			$this->SetFillColor(224,235,255);
			$this->SetTextColor(0);
			$this->SetFont('');
			// Datos
			$fill = false;
			$this->SetFont('Arial','',9);
		}
    }
	
	$this->Cell($w[0]+$w[1]+$w[2],5,'Totales:','LRT',0,'L',$fill);
	$this->Cell($w[3],5,number_format($total,2,',','.'),'LRT',0,'R',$fill);

	$fill = !$fill;
	$this->Ln();
    // Línea de cierre
    $this->Cell(array_sum($w),0,'','T');
	$this->SetFont('Arial','',12);
	$this->Ln();
	$this->Ln();
	$this->Cell(60,7,'Cantidad de items: '.$totalcant,0,0,'L',false);
	$this->Ln();
	$this->Cell(60,7,'Total: $'.number_format($sumSaldos, 2, '.', ','),0,0,'L',false);
	
	$TotalIngresos = $TotalIngresos + $total;
	*/
}


}






$pdf = new PDF('L','mm','A4');

$pdf->SetMargins(3,3,3);
// Títulos de las columnas

$headerFacturacion = array("Tipo Doc", "Nro Documento", "Apellido y Nombre Artístico","Puntaje", "Remuneracion","Aporte Sindical", "Aporte Social");
// Carga de datos

$pdf->AddPage();



$pdf->SetXY(7,7);

$pdf->SetFillColor(188,188,188);
$pdf->Rect(7.5,7.5,195,20.5,'F');


$pdf->SetXY(138.5,8);
$pdf->SetFillColor(232,232,232);
$pdf->Rect(7.8,7.8,115.5,20,'F');
$pdf->Rect(123.8,7.8,78.5,20,'F');

$pdf->Image('../imagenes/logoactores2.jpg',13,11,60);

$pdf->SetFont('Arial','b',8);
$pdf->SetXY(165,10);
$pdf->Cell(35,4,'PLANILLA DE APORTES',0,0,'R');
$pdf->SetFont('Arial','b',7);
$pdf->SetXY(126,14);
$pdf->Cell(74,4,'Para ser entregada en la Asociación Argentina de Actores',0,0,'R');
$pdf->SetFont('Arial','b',13);
$pdf->SetXY(149,21);
$pdf->Cell(30,6,'RAMA: ',0,0,'R');


$pdf->SetFillColor(88,88,88);
$pdf->Rect(7.8,27.8,194.5,6,'F');

$wA = 22;
$wB = 41;
$wC = 47;

$pdf->SetFont('Arial','b',6);
$pdf->SetDrawColor(188, 188, 188);
$pdf->SetFillColor(255,255,255);
$pdf->SetXY(7.8,33.8);
$pdf->Cell($wA,8,'N°COOPERATIVA',1,0,'L',1);
$pdf->SetFont('Arial','',6);
$pdf->Cell($wB,8,mysql_result($resObra,0,'numero'),1,0,'C',1);
$pdf->SetFont('Arial','b',6);
$pdf->MultiCell($wA,4,'AP Y NOMB. DEL RESPONSABLE',1,'L',1);
$pdf->SetXY(92.8,33.8);
$pdf->SetFont('Arial','',6);
$pdf->Cell($wC,8,'A CIEGAS TEATRO POR LA INTEGRACION',1,0,'C',1);
$pdf->SetFont('Arial','b',6);
$pdf->Cell($wA,8,'NRO de CUIT',1,0,'L',1);
$pdf->SetFont('Arial','',6);
$pdf->Cell($wB,8,'30712485961',1,0,'C',1);


$pdf->SetFont('Arial','b',6);
$pdf->SetDrawColor(188, 188, 188);
$pdf->SetFillColor(255,255,255);
$pdf->SetXY(7.8,41.8);
$pdf->Cell($wA,8,'DOMICILIO LEGAL',1,0,'L',1);
$pdf->SetFont('Arial','',6);
$pdf->Cell($wB,8,'',1,0,'L',1);
$pdf->SetFont('Arial','b',6);
$pdf->MultiCell($wA,4,'AP Y NOMB. DEL CONTACTO',1,'L',1);
$pdf->SetXY(92.8,41.8);
$pdf->SetFont('Arial','',6);
$pdf->Cell($wC,8,'ASOC. CIVIL',1,0,'C',1);
$pdf->SetFont('Arial','b',6);
$pdf->Cell($wA,8,'INGRESOS BRUTOS',1,0,'L',1);
$pdf->SetFont('Arial','',6);
$pdf->Cell($wB,8,'',1,0,'L',1);



$pdf->SetFont('Arial','b',6);
$pdf->SetDrawColor(188, 188, 188);
$pdf->SetFillColor(255,255,255);
$pdf->SetXY(7.8,49.8);
$pdf->Cell($wA,8,'DOMICILIO REAL',1,0,'L',1);
$pdf->SetFont('Arial','',6);
$pdf->Cell($wB,8,'',1,0,'L',1);
$pdf->SetFont('Arial','b',6);
$pdf->MultiCell($wA,4,'TELEFONO FIJO DEL CONTACTO',1,'L',1);
$pdf->SetXY(92.8,49.8);
$pdf->SetFont('Arial','',6);
$pdf->Cell($wC,8,'',1,0,'L',1);
$pdf->SetFont('Arial','b',6);
$pdf->Cell($wA,8,'',1,0,'L',1);
$pdf->SetFont('Arial','',6);
$pdf->Cell($wB,8,'',1,0,'L',1);



$pdf->SetFont('Arial','b',6);
$pdf->SetDrawColor(188, 188, 188);
$pdf->SetFillColor(255,255,255);
$pdf->SetXY(7.8,57.8);
$pdf->Cell($wA,8,'TELEFONO / FAX',1,0,'L',1);
$pdf->SetFont('Arial','',6);
$pdf->Cell($wB,8,'',1,0,'L',1);
$pdf->SetFont('Arial','b',6);
$pdf->MultiCell($wA,4,'TELEFONO MOVIL DEL CONTACTO',1,'L',1);
$pdf->SetXY(92.8,57.8);
$pdf->SetFont('Arial','',6);
$pdf->Cell($wC,8,'',1,0,'L',1);
$pdf->SetFont('Arial','b',6);
$pdf->Cell($wA,8,'',1,0,'L',1);
$pdf->SetFont('Arial','',6);
$pdf->Cell($wB,8,'',1,0,'L',1);



$pdf->SetFont('Arial','b',6);
$pdf->SetDrawColor(188, 188, 188);
$pdf->SetFillColor(255,255,255);
$pdf->SetXY(7.8,65.8);
$pdf->Cell($wA,8,'EMAIL',1,0,'L',1);
$pdf->SetFont('Arial','',6);
$pdf->Cell($wB,8,'',1,0,'L',1);
$pdf->SetFont('Arial','b',6);
$pdf->MultiCell($wA,4,'EMAIL DEL CONTACTO',1,'L',1);
$pdf->SetXY(92.8,65.8);
$pdf->SetFont('Arial','',6);
$pdf->Cell($wC,8,'',1,0,'L',1);
$pdf->SetFont('Arial','b',6);
$pdf->Cell($wA,8,'',1,0,'L',1);
$pdf->SetFont('Arial','',6);
$pdf->Cell($wB,8,'',1,0,'L',1);


$pdf->SetFillColor(88,88,88);
$pdf->Rect(7.8,73.8,194.5,6,'F');


$pdf->SetFont('Arial','b',6);
$pdf->SetDrawColor(188, 188, 188);
$pdf->SetFillColor(255,255,255);
$pdf->SetXY(7.8,79.8);
$pdf->MultiCell($wA,4,'TITULO DEL PROGRAMA',1,'L',1);
$pdf->SetXY(7.8 + $wA,79.8);
$pdf->SetFont('Arial','',6);
$pdf->Cell($wB,8,mysql_result($resObra,0,'nombre'),1,0,'C',1);
$pdf->SetFont('Arial','b',6);
$pdf->MultiCell($wA,4,'MONTO BORDEAUX',1,'L',1);
$pdf->SetXY(92.8,79.8);
$pdf->SetFont('Arial','',6);
$pdf->Cell($wC,8,'$'.number_format( mysql_result($resBruto,0,'totalcooperativas'),2,'.',''),1,0,'C',1);
$pdf->SetFont('Arial','b',6);
$pdf->Cell($wA,8,'PERIOD. LIQUID',1,0,'L',1);
$pdf->SetFont('Arial','',6);
$pdf->Cell($wB,8,'DESDE: '.$desde.' HASTA: '.$hasta,1,0,'C',1);

$pdf->SetFillColor(88,88,88);
$pdf->Rect(7.8,81.8,194.5,6,'F');



/*
$pdf->SetFont('Arial','',14);
$pdf->SetXY(42,3);
$pdf->Cell(32,5,'Razon Social: ',0,0,'L',false);
$pdf->SetXY(74,3);
$pdf->Cell(58,5,strtoupper($empresa),0,0,'L',false);

$pdf->SetFont('Arial','',11);

$pdf->SetXY(42,9);
$pdf->Cell(24,5,"CUIT: ",0,0,'L',false);
$pdf->SetXY(66,9);
$pdf->Cell(90,5,$cuit,0,0,'L',false);

$pdf->SetXY(42,14);
$pdf->Cell(24,5,"Dirección: ",0,0,'L',false);
$pdf->SetXY(66,14);
$pdf->Cell(90,5,$direccion,0,0,'L',false);

$pdf->SetXY(42,19);
$pdf->Cell(24,5,"Teléfono: ",0,0,'L',false);
$pdf->SetXY(66,19);
$pdf->Cell(90,5,$telefono,0,0,'L',false);

$pdf->SetXY(42,24);
$pdf->Cell(24,5,"Ciudad: ",0,0,'L',false);
$pdf->SetXY(66,24);
$pdf->Cell(90,5,$ciudad,0,0,'L',false);

$pdf->SetXY(42,29);
$pdf->Cell(24,5,"Cod.Postal: ",0,0,'L',false);
$pdf->SetXY(66,29);
$pdf->Cell(90,5,$codpostal,0,0,'L',false);

$pdf->SetXY(42,34);
$pdf->Cell(24,5,"Email: ",0,0,'L',false);
$pdf->SetXY(66,34);
$pdf->Cell(90,5,$email,0,0,'L',false);


$pdf->SetXY(158,4);
$pdf->Cell(50,5,'Fecha: '.mysql_result($resFactura,0,'fecha'),1,0,'L',false);

$pdf->SetXY(158,11);
$pdf->Cell(50,5,'NºFactura: '.mysql_result($resFactura,0,'numero'),1,0,'L',false);

$pdf->SetFont('Arial','',10);

$pdf->SetXY(2,36);

$pdf->ingresosFacturacion($headerFacturacion,$datos,$TotalFacturacion);


*/
$pdf->Ln();

$pdf->SetFont('Arial','',13);

$nombreTurno = mysql_result($resObra,0,1)." - ".$mes.".pdf";

$pdf->Output($nombreTurno,'D');

/*
require('fpdf.php');

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(40,10,'¡Hola, Mundo!');
$pdf->Output();
*/
?>

