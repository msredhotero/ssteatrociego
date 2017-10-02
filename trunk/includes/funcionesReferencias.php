<?php

/**
 * @Usuarios clase en donde se accede a la base de datos
 * @ABM consultas sobre las tablas de usuarios y usarios-clientes
 */

date_default_timezone_set('America/Buenos_Aires');

class ServiciosReferencias {

function GUID()
{
    if (function_exists('com_create_guid') === true)
    {
        return trim(com_create_guid(), '{}');
    }

    return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
}


///**********  PARA SUBIR ARCHIVOS  ***********************//////////////////////////
	function borrarDirecctorio($dir) {
		array_map('unlink', glob($dir."/*.*"));	
	
	}
	
	function borrarArchivo($id,$archivo) {
		$sql	=	"delete from images where idfoto =".$id;
		
		$res =  unlink("./../archivos/".$archivo);
		if ($res)
		{
			$this->query($sql,0);	
		}
		return $res;
	}
	
	
	function existeArchivo($id,$nombre,$type) {
		$sql		=	"select * from images where refproyecto =".$id." and imagen = '".$nombre."' and type = '".$type."'";
		$resultado  =   $this->query($sql,0);
			   
			   if(mysql_num_rows($resultado)>0){
	
				   return mysql_result($resultado,0,0);
	
			   }
	
			   return 0;	
	}
	
	function sanear_string($string)
{
 
    $string = trim($string);
 
    $string = str_replace(
        array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
        array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
        $string
    );
 
    $string = str_replace(
        array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
        array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
        $string
    );
 
    $string = str_replace(
        array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
        array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
        $string
    );
 
    $string = str_replace(
        array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
        array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
        $string
    );
 
    $string = str_replace(
        array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
        array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
        $string
    );
 
    $string = str_replace(
        array('ñ', 'Ñ', 'ç', 'Ç'),
        array('n', 'N', 'c', 'C',),
        $string
    );
 
 
 
    return $string;
}

function crearDirectorioPrincipal($dir) {
	if (!file_exists($dir)) {
		mkdir($dir, 0777);
	}
}

	function subirArchivo($file,$carpeta,$id) {
		
		
		
		$dir_destino = '../archivos/'.$carpeta.'/'.$id.'/';
		$imagen_subida = $dir_destino . $this->sanear_string(str_replace(' ','',basename($_FILES[$file]['name'])));
		
		$noentrar = '../imagenes/index.php';
		$nuevo_noentrar = '../archivos/'.$carpeta.'/'.$id.'/'.'index.php';
		
		if (!file_exists($dir_destino)) {
			mkdir($dir_destino, 0777);
		}
		
		 
		if(!is_writable($dir_destino)){
			
			echo "no tiene permisos";
			
		}	else	{
			if ($_FILES[$file]['tmp_name'] != '') {
				if(is_uploaded_file($_FILES[$file]['tmp_name'])){
					//la carpeta de libros solo los piso
					if ($carpeta == 'galeria') {
						$this->eliminarFotoPorObjeto($id);
					}
					/*echo "Archivo ". $_FILES['foto']['name'] ." subido con éxtio.\n";
					echo "Mostrar contenido\n";
					echo $imagen_subida;*/
					if (move_uploaded_file($_FILES[$file]['tmp_name'], $imagen_subida)) {
						
						$archivo = $this->sanear_string($_FILES[$file]["name"]);
						$tipoarchivo = $_FILES[$file]["type"];
						
						if ($carpeta == 'galeria') {
							if ($this->existeArchivo($id,$archivo,$tipoarchivo) == 0) {
								$sql	=	"insert into images(idfoto,refproyecto,imagen,type) values ('',".$id.",'".str_replace(' ','',$archivo)."','".$tipoarchivo."')";
								$this->query($sql,1);
							}
						} else {
							$sql = "update dblibros set ruta = '".$dir_destino.$archivo."'";
							$this->query($sql,0);	
						}
						echo "";
						
						copy($noentrar, $nuevo_noentrar);
		
					} else {
						echo "Posible ataque de carga de archivos!\n";
					}
				}else{
					echo "Posible ataque del archivo subido: ";
					echo "nombre del archivo '". $_FILES[$file]['tmp_name'] . "'.";
				}
			}
		}	
	}


	
	function TraerFotosRelacion($id) {
		$sql    =   "select 'galeria',s.idproducto,f.imagen,f.idfoto,f.type
							from dbproductos s
							
							inner
							join images f
							on	s.idproducto = f.refproyecto

							where s.idproducto = ".$id;
		$result =   $this->query($sql, 0);
		return $result;
	}
	
	
	function eliminarFoto($id)
	{
		
		$sql		=	"select concat('galeria','/',s.idproducto,'/',f.imagen) as archivo
							from dbproductos s
							
							inner
							join images f
							on	s.idproducto = f.refproyecto

							where f.idfoto =".$id;
		$resImg		=	$this->query($sql,0);
		
		if (mysql_num_rows($resImg)>0) {
			$res 		=	$this->borrarArchivo($id,mysql_result($resImg,0,0));
		} else {
			$res = true;
		}
		if ($res == false) {
			return 'Error al eliminar datos';
		} else {
			return '';
		}
	}
	
	function eliminarLibro($id)
	{
		
		$sql		=	"update dblibros set ruta = '' where idlibro =".$id;
		$res		=	$this->query($sql,0);
		
		if ($res == false) {
			return 'Error al eliminar datos';
		} else {
			return '';
		}
	}
	
	
	function eliminarFotoPorObjeto($id)
	{
		
		$sql		=	"select concat('galeria','/',s.idproducto,'/',f.imagen) as archivo,f.idfoto
							from dbproductos s
							
							inner
							join images f
							on	s.idproducto = f.refproyecto

							where s.idproducto =".$id;
		$resImg		=	$this->query($sql,0);
		
		if (mysql_num_rows($resImg)>0) {
			$res 		=	$this->borrarArchivo(mysql_result($resImg,0,1),mysql_result($resImg,0,0));
		} else {
			$res = true;
		}
		if ($res == false) {
			return 'Error al eliminar datos';
		} else {
			return '';
		}
	}

/* fin archivos */



function zerofill($valor, $longitud){
 $res = str_pad($valor, $longitud, '0', STR_PAD_LEFT);
 return $res;
}

function existeDevuelveId($sql) {

	$res = $this->query($sql,0);
	
	if (mysql_num_rows($res)>0) {
		return mysql_result($res,0,0);	
	}
	return 0;
}

/* PARA Album */

function insertarAlbum($banda,$album,$genero) {
$sql = "insert into tbalbum(idalbum,banda,album,genero)
values ('','".utf8_decode($banda)."','".utf8_decode($album)."','".utf8_decode($genero)."')";
$res = $this->query($sql,1);
return $res;
}


function modificarAlbum($id,$banda,$album,$genero) {
$sql = "update tbalbum
set
banda = '".utf8_decode($banda)."',album = '".utf8_decode($album)."',genero = '".utf8_decode($genero)."'
where idalbum =".$id;
$res = $this->query($sql,0);
return $res;
}


function eliminarAlbum($id) {
$sql = "delete from tbalbum where idalbum =".$id;
$res = $this->query($sql,0);
return $res;
}


function traerAlbum() {
$sql = "select
a.idalbum,
a.banda,
a.album,
a.genero
from tbalbum a
order by 1";
$res = $this->query($sql,0);
return $res;
}


function traerAlbumPorId($id) {
$sql = "select idalbum,banda,album,genero from tbalbum where idalbum =".$id;
$res = $this->query($sql,0);
return $res;
}

/* Fin */
/* /* Fin de la Tabla: tbalbum*/

/* PARA Albumobras */

function insertarAlbumobras($refobras,$refalbum) {
$sql = "insert into dbalbumobras(idalbumobra,refobras,refalbum)
values ('',".$refobras.",".$refalbum.")";
$res = $this->query($sql,1);
return $res;
}


function modificarAlbumobras($id,$refobras,$refalbum) {
$sql = "update dbalbumobras
set
refobras = ".$refobras.",refalbum = ".$refalbum."
where idalbumobra =".$id;
$res = $this->query($sql,0);
return $res;
}


function eliminarAlbumobras($id) {
$sql = "delete from dbalbumobras where idalbumobra =".$id;
$res = $this->query($sql,0);
return $res;
}

function eliminarAlbumobrasPorObra($idObra) {
$sql = "delete from dbalbumobras where refobras =".$idObra;
$res = $this->query($sql,0);
return $res;
}


function traerAlbumobras() {
$sql = "select
a.idalbumobra,
a.refobras,
a.refalbum
from dbalbumobras a
inner join dbobras obr ON obr.idobra = a.refobras
inner join tbsalas sa ON sa.idsala = obr.refsalas
inner join tbalbum alb ON alb.idalbum = a.refalbum
order by 1";
$res = $this->query($sql,0);
return $res;
}

function traerAlbumobrasPorObra($idObra) {
$sql = "select
a.idalbumobra,
a.refobras,
a.refalbum,
alb.banda,
alb.album
from dbalbumobras a
inner join dbobras obr ON obr.idobra = a.refobras
inner join tbsalas sa ON sa.idsala = obr.refsalas
inner join tbalbum alb ON alb.idalbum = a.refalbum
where obr.idobra = ".$idObra."
order by 1";
$res = $this->query($sql,0);
return $res;
}


function traerAlbumobrasPorId($id) {
$sql = "select idalbumobra,refobras,refalbum from dbalbumobras where idalbumobra =".$id;
$res = $this->query($sql,0);
return $res;
}

/* Fin */
/* /* Fin de la Tabla: dbalbumobras*/



/* PARA Clientes */

function insertarClientes($nombrecompleto,$cuil,$dni,$direccion,$telefono,$email,$observaciones) { 
$sql = "insert into dbclientes(idcliente,nombrecompleto,cuil,dni,direccion,telefono,email,observaciones) 
values ('','".utf8_decode($nombrecompleto)."','".utf8_decode($cuil)."','".utf8_decode($dni)."','".utf8_decode($direccion)."','".utf8_decode($telefono)."','".utf8_decode($email)."','".utf8_decode($observaciones)."')"; 
$res = $this->query($sql,1); 
return $res; 
} 


function modificarClientes($id,$nombrecompleto,$cuil,$dni,$direccion,$telefono,$email,$observaciones) { 
$sql = "update dbclientes 
set 
nombrecompleto = '".utf8_decode($nombrecompleto)."',cuil = '".utf8_decode($cuil)."',dni = '".utf8_decode($dni)."',direccion = '".utf8_decode($direccion)."',telefono = '".utf8_decode($telefono)."',email = '".utf8_decode($email)."',observaciones = '".utf8_decode($observaciones)."' 
where idcliente =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function eliminarClientes($id) { 
$sql = "delete from dbclientes where idcliente =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerClientes() { 
$sql = "select 
c.idcliente,
c.nombrecompleto,
c.cuil,
c.dni,
c.direccion,
c.telefono,
c.email,
c.observaciones
from dbclientes c 
order by 1"; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerClientesPorId($id) { 
$sql = "select idcliente,nombrecompleto,cuil,dni,direccion,telefono,email,observaciones from dbclientes where idcliente =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 

/* Fin */
/* /* Fin de la Tabla: dbclientes*/


/* PARA Cooperativas */

function insertarCooperativas($descripcion,$numero,$puntos,$puntosproduccion,$puntossinproduccion,$fechacreacion,$usuacrea,$fechamodi,$usuamodi,$activo) { 
$sql = "insert into dbcooperativas(idcooperativa,descripcion,numero,puntos,puntosproduccion,puntossinproduccion,fechacreacion,usuacrea,fechamodi,usuamodi,activo) 
values ('','".utf8_decode($descripcion)."','".utf8_decode($numero)."',".$puntos.",".$puntosproduccion.",".$puntossinproduccion.",'".utf8_decode($fechacreacion)."','".utf8_decode($usuacrea)."','".utf8_decode($fechamodi)."','".utf8_decode($usuamodi)."',".$activo.")"; 
$res = $this->query($sql,1); 
return $res; 
} 


function modificarCooperativas($id,$descripcion,$numero,$puntos,$puntosproduccion,$puntossinproduccion,$fechacreacion,$usuacrea,$fechamodi,$usuamodi,$activo) { 
$sql = "update dbcooperativas 
set 
descripcion = '".utf8_decode($descripcion)."', numero = '".utf8_decode($numero)."'puntos = ".$puntos.",puntosproduccion = ".$puntosproduccion.",puntossinproduccion = ".$puntossinproduccion.",fechacreacion = '".utf8_decode($fechacreacion)."',usuacrea = '".utf8_decode($usuacrea)."',fechamodi = '".utf8_decode($fechamodi)."',usuamodi = '".utf8_decode($usuamodi)."',activo = ".$activo." 
where idcooperativa =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function eliminarCooperativas($id) { 
//$sql = "delete from dbcooperativas where idcooperativa =".$id; 
$sql = "update dbcooperativas set activo = 0 where idcooperativa =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 

function eliminarCooperativasDefinitivo($id) { 
$sql = "delete from dbcooperativas where idcooperativa =".$id; 

$res = $this->query($sql,0); 
return $res; 
} 


function traerCooperativas() { 
$sql = "select 
c.idcooperativa,
c.descripcion,
c.puntos,
c.puntosproduccion,
c.puntossinproduccion,
(case when c.activo = 1 then 'Si' else 'No' end) as activo,
c.fechacreacion,
c.usuacrea,
c.fechamodi,
c.usuamodi,
c.numero
from dbcooperativas c 
order by c.descripcion"; 
$res = $this->query($sql,0); 
return $res; 
} 

function traerCooperativasActivas() { 
$sql = "select 
c.idcooperativa,
c.descripcion,
c.puntos,
c.puntosproduccion,
c.puntossinproduccion,
(case when c.activo = 1 then 'Si' else 'No' end) as activo,
c.fechacreacion,
c.usuacrea,
c.fechamodi,
c.usuamodi,
c.numero
from dbcooperativas c 
where c.activo = 1
order by c.descripcion"; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerCooperativasPorId($id) { 
$sql = "select idcooperativa,descripcion,numero,puntos,puntosproduccion,puntossinproduccion,fechacreacion,usuacrea,fechamodi,usuamodi,(case when activo = 1 then 'Si' else 'No' end) as activo from dbcooperativas where idcooperativa =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 

/* Fin */
/* /* Fin de la Tabla: dbcooperativas*/


/* PARA Datosbancos */

function insertarDatosbancos($refpersonal,$cbu,$nrocuenta,$tipoproducto,$formaoperar,$fechacrea,$usuacrea,$fechamodi,$usuamodi) { 
$sql = "insert into dbdatosbancos(iddatobanco,refpersonal,cbu,nrocuenta,tipoproducto,formaoperar,fechacrea,usuacrea,fechamodi,usuamodi) 
values ('',".$refpersonal.",'".utf8_decode($cbu)."','".utf8_decode($nrocuenta)."','".utf8_decode($tipoproducto)."','".utf8_decode($formaoperar)."','".utf8_decode($fechacrea)."','".utf8_decode($usuacrea)."','".utf8_decode($fechamodi)."','".utf8_decode($usuamodi)."')"; 
$res = $this->query($sql,1); 
return $res; 
} 


function modificarDatosbancos($id,$refpersonal,$cbu,$nrocuenta,$tipoproducto,$formaoperar,$fechacrea,$usuacrea,$fechamodi,$usuamodi) { 
$sql = "update dbdatosbancos 
set 
refpersonal = ".$refpersonal.",cbu = '".utf8_decode($cbu)."',nrocuenta = '".utf8_decode($nrocuenta)."',tipoproducto = '".utf8_decode($tipoproducto)."',formaoperar = '".utf8_decode($formaoperar)."',fechacrea = '".utf8_decode($fechacrea)."',usuacrea = '".utf8_decode($usuacrea)."',fechamodi = '".utf8_decode($fechamodi)."',usuamodi = '".utf8_decode($usuamodi)."' 
where iddatobanco =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function eliminarDatosbancos($id) { 
$sql = "delete from dbdatosbancos where iddatobanco =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerDatosbancos() { 
$sql = "select 
d.iddatobanco,
d.refpersonal,
d.cbu,
d.nrocuenta,
d.tipoproducto,
d.formaoperar,
d.fechacrea,
d.usuacrea,
d.fechamodi,
d.usuamodi
from dbdatosbancos d 
inner join dbpersonal per ON per.idpersonal = d.refpersonal 
inner join tbtipodocumento ti ON ti.idtipodocumento = per.reftipodocumento 
inner join tbestadocivil es ON es.idestadocivil = per.refestadocivil 
order by 1"; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerDatosbancosPorId($id) { 
$sql = "select iddatobanco,refpersonal,cbu,nrocuenta,tipoproducto,formaoperar,fechacrea,usuacrea,fechamodi,usuamodi from dbdatosbancos where iddatobanco =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 

function traerDatosbancosPorPersona($idPersona) { 
$sql = "select iddatobanco,refpersonal,cbu,nrocuenta,tipoproducto,formaoperar,fechacrea,usuacrea,fechamodi,usuamodi from dbdatosbancos where refpersonal =".$idPersona; 
$res = $this->query($sql,0); 
return $res; 
} 

/* Fin */
/* /* Fin de la Tabla: dbdatosbancos*/


/* PARA Domicilios */

function insertarDomicilios($refpersonal,$calle,$nro,$piso,$departamento,$codigopostal,$localidad,$provincia,$telefonoparticular,$telefonocelular) { 
$sql = "insert into dbdomicilios(iddomicilio,refpersonal,calle,nro,piso,departamento,codigopostal,localidad,provincia,telefonoparticular,telefonocelular) 
values ('',".$refpersonal.",'".utf8_decode($calle)."','".utf8_decode($nro)."',".($piso == '' ? 'NULL' : $piso).",'".utf8_decode($departamento)."','".utf8_decode($codigopostal)."','".utf8_decode($localidad)."','".utf8_decode($provincia)."','".utf8_decode($telefonoparticular)."','".utf8_decode($telefonocelular)."')"; 
$res = $this->query($sql,1); 
return $res; 
} 


function modificarDomicilios($id,$refpersonal,$calle,$nro,$piso,$departamento,$codigopostal,$localidad,$provincia,$telefonoparticular,$telefonocelular) { 
$sql = "update dbdomicilios 
set 
refpersonal = ".$refpersonal.",calle = '".utf8_decode($calle)."',nro = '".utf8_decode($nro)."',piso = ".($piso == '' ? 'NULL' : $piso).",departamento = '".utf8_decode($departamento)."',codigopostal = '".utf8_decode($codigopostal)."',localidad = '".utf8_decode($localidad)."',provincia = '".utf8_decode($provincia)."',telefonoparticular = '".utf8_decode($telefonoparticular)."',telefonocelular = '".utf8_decode($telefonocelular)."' 
where iddomicilio =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function eliminarDomicilios($id) { 
$sql = "delete from dbdomicilios where iddomicilio =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerDomicilios() { 
$sql = "select 
d.iddomicilio,
d.refpersonal,
d.calle,
d.nro,
d.piso,
d.departamento,
d.codigopostal,
d.localidad,
d.provincia,
d.telefonoparticular,
d.telefonocelular
from dbdomicilios d 
inner join dbpersonal per ON per.idpersonal = d.refpersonal 
inner join tbtipodocumento ti ON ti.idtipodocumento = per.reftipodocumento 
inner join tbestadocivil es ON es.idestadocivil = per.refestadocivil 
order by 1"; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerDomiciliosPorId($id) { 
$sql = "select iddomicilio,refpersonal,calle,nro,piso,departamento,codigopostal,localidad,provincia,telefonoparticular,telefonocelular from dbdomicilios where iddomicilio =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 

function traerDomiciliosPorPersona($idPersona) { 
$sql = "select iddomicilio,refpersonal,calle,nro,piso,departamento,codigopostal,localidad,provincia,telefonoparticular,telefonocelular from dbdomicilios where refpersonal =".$idPersona; 
$res = $this->query($sql,0); 
return $res; 
} 

/* Fin */
/* /* Fin de la Tabla: dbdomicilios*/



/* PARA Funciones */

function insertarFunciones($refobras,$refcooperativas,$horario,$refdias) { 
$sql = "insert into dbfunciones(idfuncion,refobras,refcooperativas,horario,refdias) 
values ('',".$refobras.",".$refcooperativas.",'".$horario."',".$refdias.")"; 
$res = $this->query($sql,1); 
return $res; 
} 


function modificarFunciones($id,$refobras,$refcooperativas,$horario,$refdias) { 
$sql = "update dbfunciones 
set 
refobras = ".$refobras.",refcooperativas = ".$refcooperativas.",horario = '".$horario."',refdias = ".$refdias." 
where idfuncion =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function eliminarFunciones($id) { 
$sql = "delete from dbfunciones where idfuncion =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerFunciones() { 
$sql = "select 
f.idfuncion,
obr.nombre as obra,
sa.descripcion as sala,
coo.descripcion as cooperativa,
f.horario,
dia.dia,
f.refobras,
f.refcooperativas,
f.refdias
from dbfunciones f 
inner join dbobras obr ON obr.idobra = f.refobras 
inner join tbsalas sa ON sa.idsala = obr.refsalas 
inner join dbcooperativas coo ON coo.idcooperativa = f.refcooperativas 
inner join tbdias dia ON dia.iddia = f.refdias 
order by 1"; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerFuncionesPorFuncion($id) { 
$sql = "select 
f.idfuncion,
obr.nombre as obra,
sa.descripcion as sala,
coo.descripcion as cooperativa,
f.horario,
dia.dia,
f.refobras,
f.refcooperativas,
f.refdias
from dbfunciones f 
inner join dbobras obr ON obr.idobra = f.refobras 
inner join tbsalas sa ON sa.idsala = obr.refsalas 
inner join dbcooperativas coo ON coo.idcooperativa = f.refcooperativas 
inner join tbdias dia ON dia.iddia = f.refdias 
where idfuncion =".$id." 
order by 1"; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerFuncionesPorId($id) { 
$sql = "select idfuncion,refobras,refcooperativas,horario,refdias from dbfunciones where idfuncion =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 

/* Fin */
/* /* Fin de la Tabla: dbfunciones*/


/* PARA Gastosobras */

function insertarGastosobras($reffunciones,$descripcion,$monto,$fecha,$fechacreacion,$usuacrea) { 
$sql = "insert into dbgastosobras(idgastoobra,reffunciones,descripcion,monto,fecha,fechacreacion,usuacrea) 
values ('',".$reffunciones.",'".utf8_decode($descripcion)."',".$monto.",'".($fecha)."','".($fechacreacion)."','".utf8_decode($usuacrea)."')"; 
$res = $this->query($sql,1); 
return $res; 
} 


function modificarGastosobras($id,$reffunciones,$descripcion,$monto,$fecha,$fechacreacion,$usuacrea) { 
$sql = "update dbgastosobras 
set 
reffunciones = ".$reffunciones.",descripcion = '".utf8_decode($descripcion)."',monto = ".$monto.",fecha = '".($fecha)."',fechacreacion = '".utf8_decode($fechacreacion)."',usuacrea = '".utf8_decode($usuacrea)."' 
where idgastoobra =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function eliminarGastosobras($id) { 
$sql = "delete from dbgastosobras where idgastoobra =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerGastosobras() { 
$sql = "select 
g.idgastoobra,
obr.nombre as obra,
fu.horario,
di.dia,
g.descripcion,
g.monto,
g.fecha,
g.fechacreacion,
g.usuacrea,
g.reffunciones
from dbgastosobras g 
inner join dbfunciones fu ON fu.idfuncion = g.reffunciones
inner join dbobras obr ON obr.idobra = fu.refobras 
inner join dbcooperativas coo ON coo.idcooperativa = fu.refcooperativas
inner join tbdias di ON di.iddia = fu.refdias
inner join tbsalas sa ON sa.idsala = obr.refsalas 
order by 1"; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerGastosobrasPorId($id) { 
$sql = "select idgastoobra,reffunciones,descripcion,monto,fecha,fechacreacion,usuacrea from dbgastosobras where idgastoobra =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 

function traerGastosobrasPorObra($idObra) { 
$sql = "SELECT 
			g.idgastoobra,
			fu.horario,
			di.dia,
			g.descripcion,
			g.monto,
			g.fecha,
			g.reffunciones,
			g.fechacreacion,
			g.usuacrea
		FROM
			dbgastosobras g
				INNER JOIN
			dbfunciones fu ON fu.idfuncion = g.reffunciones
				INNER JOIN
			dbobras obr ON obr.idobra = fu.refobras
				INNER JOIN
			dbcooperativas coo ON coo.idcooperativa = fu.refcooperativas
				INNER JOIN
			tbdias di ON di.iddia = fu.refdias
		WHERE
			fu.refobras =".$idObra; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerGastosobrasPorFuncion($idFuncion) { 
$sql = "SELECT 
			g.idgastoobra,
			g.descripcion,
			g.monto,
			g.fecha,
			fu.horario,
			di.dia,
			g.reffunciones,
			g.fechacreacion,
			g.usuacrea
		FROM
			dbgastosobras g
				INNER JOIN
			dbfunciones fu ON fu.idfuncion = g.reffunciones
				INNER JOIN
			dbobras obr ON obr.idobra = fu.refobras
				INNER JOIN
			dbcooperativas coo ON coo.idcooperativa = fu.refcooperativas
				INNER JOIN
			tbdias di ON di.iddia = fu.refdias
		WHERE
			fu.idfuncion =".$idFuncion; 
$res = $this->query($sql,0); 
return $res; 
} 

/* Fin */
/* /* Fin de la Tabla: dbgastosobras*/


/* PARA Obras */

function insertarObras($nombre,$refsalas,$valorentrada,$cantpulicidad,$valorpulicidad,$valorticket,$costotranscciontarjetaiva,$porcentajeargentores,$porcentajereparto,$porcentajeretencion,$fechacreacion,$usuacrea,$fechamodi,$usuamodi,$activo) { 
$sql = "insert into dbobras(idobra,nombre,refsalas,valorentrada,cantpulicidad,valorpulicidad,valorticket,costotranscciontarjetaiva,porcentajeargentores,porcentajereparto,porcentajeretencion,fechacreacion,usuacrea,fechamodi,usuamodi,activo) 
values ('','".utf8_decode($nombre)."',".$refsalas.",".$valorentrada.",".$cantpulicidad.",".$valorpulicidad.",".$valorticket.",".$costotranscciontarjetaiva.",".$porcentajeargentores.",".$porcentajereparto.",".$porcentajeretencion.",'".utf8_decode($fechacreacion)."','".utf8_decode($usuacrea)."','".utf8_decode($fechamodi)."','".utf8_decode($usuamodi)."',".$activo.")"; 
$res = $this->query($sql,1); 
return $res; 
} 


function modificarObras($id,$nombre,$refsalas,$valorentrada,$cantpulicidad,$valorpulicidad,$valorticket,$costotranscciontarjetaiva,$porcentajeargentores,$porcentajereparto,$porcentajeretencion,$fechacreacion,$usuacrea,$fechamodi,$usuamodi,$activo) { 
$sql = "update dbobras 
set 
nombre = '".utf8_decode($nombre)."',refsalas = ".$refsalas.",valorentrada = ".$valorentrada.",cantpulicidad = ".$cantpulicidad.",valorpulicidad = ".$valorpulicidad.",valorticket = ".$valorticket.",costotranscciontarjetaiva = ".$costotranscciontarjetaiva.",porcentajeargentores = ".$porcentajeargentores.",porcentajereparto = ".$porcentajereparto.",porcentajeretencion = ".$porcentajeretencion.",fechacreacion = '".utf8_decode($fechacreacion)."',usuacrea = '".utf8_decode($usuacrea)."',fechamodi = '".utf8_decode($fechamodi)."',usuamodi = '".utf8_decode($usuamodi)."',activo = ".$activo." 
where idobra =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function eliminarObras($id) { 
$sql = "update dbobras set activo = 0 where idobra =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 

function eliminarObrasDefinitivo($id) { 
$sql = "delete from dbobras where idobra =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerObras() { 
$sql = "select 
o.idobra,
o.nombre,
o.refsalas,
o.valorentrada,
o.cantpulicidad,
o.valorpulicidad,
o.valorticket,
o.costotranscciontarjetaiva,
o.porcentajeargentores,
o.porcentajereparto,
o.porcentajeretencion,
(case when o.activo = 1 then 'Si' else 'No' end) as activo,
o.fechacreacion,
o.usuacrea,
o.fechamodi,
o.usuamodi

from dbobras o 
inner join tbsalas sal ON sal.idsala = o.refsalas 
order by o.nombre"; 
$res = $this->query($sql,0); 
return $res; 
} 

function traerObrasActivo() { 
$sql = "select 
o.idobra,
o.nombre,
o.refsalas,
o.valorentrada,
o.cantpulicidad,
o.valorpulicidad,
o.valorticket,
o.costotranscciontarjetaiva,
o.porcentajeargentores,
o.porcentajereparto,
o.porcentajeretencion,
(case when o.activo = 1 then 'Si' else 'No' end) as activo,
o.fechacreacion,
o.usuacrea,
o.fechamodi,
o.usuamodi
from dbobras o 
inner join tbsalas sal ON sal.idsala = o.refsalas 
where o.activo = 1
order by o.nombre"; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerObrasPorId($id) { 
$sql = "select idobra,nombre,refsalas,valorentrada,cantpulicidad,valorpulicidad,valorticket,costotranscciontarjetaiva,porcentajeargentores,porcentajereparto,porcentajeretencion,fechacreacion,usuacrea,fechamodi,usuamodi,(case when activo = 1 then 'Si' else 'No' end) as activo from dbobras where idobra =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 

function traerValorEntrada($idObra) {
	$sql = "select valorentrada from dbobras where idobra =".$idObra; 
	$res = $this->existeDevuelveId($sql); 
	return $res; 
}

function traerValorEntradaPorFuncion($idFuncion) {
	$sql = "select
				o.valorentrada
			from		dbfunciones f
			inner
			join		dbobras o
			ON			o.idobra = f.refobras
			
			where		f.idfuncion = ".$idFuncion; 
	$res = $this->existeDevuelveId($sql); 
	return $res; 
}

/* Fin */
/* /* Fin de la Tabla: dbobras*/


/* PARA Obrascooperativas */

function insertarObrascooperativas($refobras,$refcooperativas) { 
$sql = "insert into dbobrascooperativas(idobracooperativa,refobras,refcooperativas) 
values ('',".$refobras.",".$refcooperativas.")"; 
$res = $this->query($sql,1); 
return $res; 
} 


function modificarObrascooperativas($id,$refobras,$refcooperativas) { 
$sql = "update dbobrascooperativas 
set 
refobras = ".$refobras.",refcooperativas = ".$refcooperativas." 
where idobracooperativa =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function eliminarObrascooperativas($id) { 
$sql = "delete from dbobrascooperativas where idobracooperativa =".$id; 
$res = $this->query($sql,0); 
return $res; 
}

function eliminarObrascooperativasPorCooperativa($idCooperativa) { 
$sql = "delete from dbobrascooperativas where refcooperativas =".$idCooperativa; 
$res = $this->query($sql,0); 
return $res; 
} 

function eliminarObrascooperativasPorObra($idObra) { 
$sql = "delete from dbobrascooperativas where refobras =".$idObra; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerObrascooperativas() { 
$sql = "select 
o.idobracooperativa,
o.refobras,
o.refcooperativas
from dbobrascooperativas o 
inner join dbobras obr ON obr.idobra = o.refobras 
inner join tbsalas sa ON sa.idsala = obr.refsalas 
inner join dbcooperativas coo ON coo.idcooperativa = o.refcooperativas 
order by 1"; 
$res = $this->query($sql,0); 
return $res; 
} 

function traerObrascooperativasPorCooperativa($idCooperativa) { 
$sql = "select 
o.idobracooperativa,
o.refobras,
o.refcooperativas,
obr.nombre as obra,
coo.descripcion as cooperativa,
sa.descripcion as sala,
coo.numero
from dbobrascooperativas o 
inner join dbobras obr ON obr.idobra = o.refobras 
inner join tbsalas sa ON sa.idsala = obr.refsalas 
inner join dbcooperativas coo ON coo.idcooperativa = o.refcooperativas 
where coo.idcooperativa = ".$idCooperativa."
order by 1"; 
$res = $this->query($sql,0); 
return $res; 
} 

function traerObrascooperativasPorObra($idObra) { 
$sql = "select 
o.idobracooperativa,
o.refobras,
o.refcooperativas,
coo.puntos,
coo.numero,
obr.nombre
from dbobrascooperativas o 
inner join dbobras obr ON obr.idobra = o.refobras 
inner join tbsalas sa ON sa.idsala = obr.refsalas 
inner join dbcooperativas coo ON coo.idcooperativa = o.refcooperativas 
where o.refobras = ".$idObra."
order by 1"; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerObrascooperativasPorId($id) { 
$sql = "select idobracooperativa,refobras,refcooperativas from dbobrascooperativas where idobracooperativa =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 

/* Fin */
/* /* Fin de la Tabla: dbobrascooperativas*/


/* PARA Personal */

function insertarPersonal($reftipodocumento,$nrodocumento,$apellido,$nombre,$fechanacimiento,$cuil,$sexo,$refestadocivil,$paisorigen,$fechacrea,$usuacrea,$fechamodi,$usuamodi) { 
$sql = "insert into dbpersonal(idpersonal,reftipodocumento,nrodocumento,apellido,nombre,fechanacimiento,cuil,sexo,refestadocivil,paisorigen,fechacrea,usuacrea,fechamodi,usuamodi) 
values ('',".$reftipodocumento.",".$nrodocumento.",'".utf8_decode($apellido)."','".utf8_decode($nombre)."','".utf8_decode($fechanacimiento)."',".$cuil.",'".utf8_decode($sexo)."',".$refestadocivil.",'".utf8_decode($paisorigen)."','".utf8_decode($fechacrea)."','".utf8_decode($usuacrea)."','".utf8_decode($fechamodi)."','".utf8_decode($usuamodi)."')"; 
$res = $this->query($sql,1); 
return $res; 
} 


function modificarPersonal($id,$reftipodocumento,$nrodocumento,$apellido,$nombre,$fechanacimiento,$cuil,$sexo,$refestadocivil,$paisorigen,$fechacrea,$usuacrea,$fechamodi,$usuamodi) { 
$sql = "update dbpersonal 
set 
reftipodocumento = ".$reftipodocumento.",nrodocumento = ".$nrodocumento.",apellido = '".utf8_decode($apellido)."',nombre = '".utf8_decode($nombre)."',fechanacimiento = '".utf8_decode($fechanacimiento)."',cuil = ".$cuil.",sexo = '".utf8_decode($sexo)."',refestadocivil = ".$refestadocivil.",paisorigen = '".utf8_decode($paisorigen)."',fechacrea = '".utf8_decode($fechacrea)."',usuacrea = '".utf8_decode($usuacrea)."',fechamodi = '".utf8_decode($fechamodi)."',usuamodi = '".utf8_decode($usuamodi)."' 
where idpersonal =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function eliminarPersonal($id) { 
$sql = "delete from dbpersonal where idpersonal =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerPersonal() { 
$sql = "select 
p.idpersonal,
tip.tipodocumento,
p.nrodocumento,
p.apellido,
p.nombre,
p.fechanacimiento,
p.cuil,
p.sexo,
est.estadocivil,
p.paisorigen,
p.fechacrea,
p.usuacrea,
p.fechamodi,
p.reftipodocumento,
p.refestadocivil,
p.usuamodi
from dbpersonal p 
inner join tbtipodocumento tip ON tip.idtipodocumento = p.reftipodocumento 
inner join tbestadocivil est ON est.idestadocivil = p.refestadocivil 
order by 1"; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerPersonalPorId($id) { 
$sql = "select idpersonal,reftipodocumento,nrodocumento,apellido,nombre,fechanacimiento,cuil,sexo,refestadocivil,paisorigen,fechacrea,usuacrea,fechamodi,usuamodi from dbpersonal where idpersonal =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 

/* Fin */
/* /* Fin de la Tabla: dbpersonal*/

/* PARA Personalcooperativas */

function insertarPersonalcooperativas($refpersonal,$refcooperativas) { 
$sql = "insert into dbpersonalcooperativas(idpersonalcooperativa,refpersonal,refcooperativas) 
values ('',".$refpersonal.",".$refcooperativas.")"; 
$res = $this->query($sql,1); 
return $res; 
} 


function modificarPersonalcooperativas($id,$refpersonal,$refcooperativas) { 
$sql = "update dbpersonalcooperativas 
set 
refpersonal = ".$refpersonal.",refcooperativas = ".$refcooperativas." 
where idpersonalcooperativa =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function eliminarPersonalcooperativas($id) { 
$sql = "delete from dbpersonalcooperativas where idpersonalcooperativa =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function eliminarPersonalcooperativasPorCooperativa($idCooperativa) { 
$sql = "delete from dbpersonalcooperativas where refcooperativas =".$idCooperativa; 
$res = $this->query($sql,0); 
return $res; 
}


function traerPersonalcooperativas() { 
$sql = "select 
p.idpersonalcooperativa,
p.refpersonal,
p.refcooperativas
from dbpersonalcooperativas p 
inner join dbpersonal per ON per.idpersonal = p.refpersonal 
inner join tbtipodocumento ti ON ti.idtipodocumento = per.reftipodocumento 
inner join tbestadocivil es ON es.idestadocivil = per.refestadocivil 
inner join dbcooperativas coo ON coo.idcooperativa = p.refcooperativas 
order by 1"; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerPersonalcooperativasPorPersonal($idPersonal) { 
	$sql = "select 
	p.idpersonalcooperativa,
	per.nrodocumento,
	per.apellido,
	per.nombre,
	coo.descripcion as cooperativa,
	(case when coo.activo = 1 then 'Si' else 'No' end) as activo,
	p.refpersonal,
	p.refcooperativas
	from dbpersonalcooperativas p 
	inner join dbpersonal per ON per.idpersonal = p.refpersonal 
	inner join tbtipodocumento ti ON ti.idtipodocumento = per.reftipodocumento 
	inner join tbestadocivil es ON es.idestadocivil = per.refestadocivil 
	inner join dbcooperativas coo ON coo.idcooperativa = p.refcooperativas 
	where p.refpersonal = ".$idPersonal."
	order by coo.descripcion"; 
	
	$res = $this->query($sql,0); 
	return $res; 
} 


function traerPersonalcooperativasPorPersonalCooperativaActiva($idPersonal) { 
	$sql = "select 
	p.idpersonalcooperativa,
	per.nrodocumento,
	per.apellido,
	per.nombre,
	coo.descripcion as cooperativa,
	(case when coo.activo = 1 then 'Si' else 'No' end) as activo,
	p.refpersonal,
	p.refcooperativas
	from dbpersonalcooperativas p 
	inner join dbpersonal per ON per.idpersonal = p.refpersonal 
	inner join tbtipodocumento ti ON ti.idtipodocumento = per.reftipodocumento 
	inner join tbestadocivil es ON es.idestadocivil = per.refestadocivil 
	inner join dbcooperativas coo ON coo.idcooperativa = p.refcooperativas 
	where p.refpersonal = ".$idPersonal." and coo.activo = 1
	order by coo.descripcion"; 
	
	$res = $this->query($sql,0); 
	return $res; 
} 


function traerPersonalcooperativasPorPersonalCooperativaInactiva($idPersonal) { 
	$sql = "select 
	p.idpersonalcooperativa,
	per.nrodocumento,
	per.apellido,
	per.nombre,
	coo.descripcion as cooperativa,
	(case when coo.activo = 1 then 'Si' else 'No' end) as activo,
	p.refpersonal,
	p.refcooperativas
	from dbpersonalcooperativas p 
	inner join dbpersonal per ON per.idpersonal = p.refpersonal 
	inner join tbtipodocumento ti ON ti.idtipodocumento = per.reftipodocumento 
	inner join tbestadocivil es ON es.idestadocivil = per.refestadocivil 
	inner join dbcooperativas coo ON coo.idcooperativa = p.refcooperativas 
	where p.refpersonal = ".$idPersonal." and coo.activo = 0
	order by coo.descripcion"; 
	
	$res = $this->query($sql,0); 
	return $res; 
}


function traerPersonalcooperativasPorCooperativa($idCooperativa) { 
	$sql = "select 
	p.idpersonalcooperativa,
	per.nrodocumento,
	per.apellido,
	per.nombre,
	coo.descripcion as cooperativa,
	(case when coo.activo = 1 then 'Si' else 'No' end) as activo,
	p.refpersonal,
	p.refcooperativas
	from dbpersonalcooperativas p 
	inner join dbpersonal per ON per.idpersonal = p.refpersonal 
	inner join tbtipodocumento ti ON ti.idtipodocumento = per.reftipodocumento 
	inner join tbestadocivil es ON es.idestadocivil = per.refestadocivil 
	inner join dbcooperativas coo ON coo.idcooperativa = p.refcooperativas 
	where coo.idcooperativa = ".$idCooperativa."
	order by per.apellido,	per.nombre"; 
	
	$res = $this->query($sql,0); 
	return $res; 
} 


function traerPersonalcooperativasPorObra($idObra) { 
	$sql = "SELECT 
    per.nrodocumento,
    per.apellido,
    per.nombre,
    pc.puntos,
	coo.puntos as puntoscooperativa,
    coo.descripcion AS cooperativa,
    (CASE
        WHEN coo.activo = 1 THEN 'Si'
        ELSE 'No'
    END) AS activo,
    p.refpersonal,
    p.refcooperativas
FROM
    dbpersonalcooperativas p
        INNER JOIN
    dbpersonal per ON per.idpersonal = p.refpersonal
        INNER JOIN
    tbtipodocumento ti ON ti.idtipodocumento = per.reftipodocumento
        INNER JOIN
    tbestadocivil es ON es.idestadocivil = per.refestadocivil
        INNER JOIN
    dbcooperativas coo ON coo.idcooperativa = p.refcooperativas
        INNER JOIN
    dbobrascooperativas oc ON oc.refcooperativas = coo.idcooperativa
        INNER JOIN
    dbpersonalcargos pc ON pc.refpersonal = per.idpersonal
        INNER JOIN
    dbfunciones ff ON ff.refcooperativas = p.refcooperativas
        AND ff.refobras = oc.refobras
WHERE
    oc.refobras = 1
GROUP BY coo.puntos, per.nrodocumento , per.apellido , per.nombre , pc.puntos , coo.descripcion , coo.activo , p.refpersonal , p.refcooperativas
ORDER BY per.apellido , per.nombre"; 
	
	$res = $this->query($sql,0); 
	return $res; 
} 


function traerPersonalcooperativasPorId($id) { 
$sql = "select idpersonalcooperativa,refpersonal,refcooperativas from dbpersonalcooperativas where idpersonalcooperativa =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 

/* Fin */
/* /* Fin de la Tabla: dbpersonalcooperativas*/


/*			PARA EL PLANTEL DE LAS COOPERATIVAS   			*/
function traerPlantelPorFuncion($idFuncion) {
	$sql = "select
				p.idpersonal, p.nrodocumento, p.apellido, p.nombre, COALESCE( pc.puntos,0) as puntos
			from		dbfunciones f
			inner
			join		dbobras o
			ON			o.idobra = f.refobras
			inner
			join		dbobrascooperativas co
			on			co.refobras = o.idobra
			inner
			join		dbpersonalcooperativas pco
			on			pco.refcooperativas = co.refcooperativas
			inner
			join		dbpersonal p
			on			p.idpersonal = pco.refpersonal
			left
			join		dbpersonalcargos pc
			on			pc.reffunciones = f.idfuncion and pc.refpersonal = p.idpersonal and (fechabaja is null or fechabaja > now())
			where		f.idfuncion = ".$idFuncion." 
			order by p.apellido, p.nombre";	
	$res = $this->query($sql,0); 
	return $res;
}

function traerPlantelConCargosPorFuncion($idFuncion) {
	$sql = "select
				p.idpersonal, p.nrodocumento, p.apellido, p.nombre, pc.puntos
			from		dbfunciones f
			inner
			join		dbobras o
			ON			o.idobra = f.refobras
			inner
			join		dbpersonalcargos pc
			on			pc.reffunciones = f.idfuncion
			inner
			join		dbpersonal p
			on			pc.refpersonal = p.idpersonal and (fechabaja is null or fechabaja > now())
			where		f.idfuncion = ".$idFuncion." 
			order by p.apellido, p.nombre";	
	$res = $this->query($sql,0); 
	return $res;
}

/*			FIN  											*/

/* PARA Personalcargos */
function existeCargo($refpersonal,$reffunciones) {
	$sql = "select idpersonalcargo from dbpersonalcargos where refpersonal=".$refpersonal." and reffunciones=".$reffunciones." and (fechabaja is null or fechabaja > now())";
	$res = $this->query($sql,0); 
	
	if (mysql_num_rows($res)>0) {
		return 1;	
	}
	
	return 0;
}


function traerSaldoPuntosObras($idObra) {
	$sql = "select (coo.puntos - sum(pc.puntos)) as saldo
				from dbpersonalcargos pc 
				inner join dbfunciones ff on ff.idfuncion = pc.reffunciones 
				inner join dbobras o ON o.idobra = ff.refobras 
				inner join dbpersonal p ON p.idpersonal = pc.refpersonal and (pc.fechabaja is null or pc.fechabaja > now())
				inner join dbobrascooperativas oc ON oc.refobras = o.idobra
				inner join dbcooperativas coo ON coo.idcooperativa = oc.refcooperativas
				where o.idobra = ".$idObra."
				group by coo.puntos";	
	
	$res = $this->query($sql,0); 
				
	if (mysql_num_rows($res)>0) {
		return mysql_result($res,0,0);	
	}
	
	$cooperativa = $this->traerObrascooperativasPorObra($idObra);
	
	return mysql_result($cooperativa,0,'puntos');
}

function insertarPersonalcargos($refpersonal,$reftiposcargos,$reffunciones,$fechaalta,$fechabaja,$fechabajatentativa,$puntos,$monto,$fechacrea,$usuacrea,$fechamodi,$usuamodi) { 
$sql = "insert into dbpersonalcargos(idpersonalcargo,refpersonal,reftiposcargos,reffunciones,fechaalta,fechabaja,fechabajatentativa,puntos,monto,fechacrea,usuacrea,fechamodi,usuamodi) 
values ('',".$refpersonal.",".$reftiposcargos.",".$reffunciones.",".($fechaalta == '' ? NULL : "'".$fechaalta."'").",".($fechabaja == '' ? 'NULL' : "'".$fechabaja."'").",".($fechabajatentativa == '' ? 'NULL' : "'".$fechabajatentativa."'").",".$puntos.",".$monto.",'".utf8_decode($fechacrea)."','".utf8_decode($usuacrea)."','".utf8_decode($fechamodi)."','".utf8_decode($usuamodi)."')"; 
$res = $this->query($sql,1); 
return $res; 
} 


function modificarPersonalcargos($id,$refpersonal,$reftiposcargos,$reffunciones,$fechaalta,$fechabaja,$fechabajatentativa,$puntos,$monto,$fechacrea,$usuacrea,$fechamodi,$usuamodi) { 
$sql = "update dbpersonalcargos 
set 
refpersonal = ".$refpersonal.",reftiposcargos = ".$reftiposcargos.",reffunciones = ".$reffunciones.",fechaalta = '".($fechaalta == '' ? NULL : $fechaalta)."',fechabaja = ".($fechabaja == '' ? 'NULL' : "'".$fechabaja."'").",fechabajatentativa = ".($fechabajatentativa == '' ? 'NULL' : "'".$fechabajatentativa."'").",puntos = ".$puntos.",monto = ".$monto.",fechacrea = '".utf8_decode($fechacrea)."',usuacrea = '".utf8_decode($usuacrea)."',fechamodi = '".utf8_decode($fechamodi)."',usuamodi = '".utf8_decode($usuamodi)."' 
where idpersonalcargo =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function eliminarPersonalcargos($id) { 
$sql = "update dbpersonalcargos set fechabaja = '".date('Y-m-d')."' where idpersonalcargo =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerPersonalcargos() { 
$sql = "select 
p.idpersonalcargo,
p.refpersonal,
p.reftiposcargos,
p.reffunciones,
p.fechaalta,
p.fechabaja,
p.fechabajatentativa,
p.puntos,
p.monto,
p.fechacrea,
p.usuacrea,
p.fechamodi,
p.usuamodi
from dbpersonalcargos p 
inner join dbpersonal per ON per.idpersonal = p.refpersonal 
inner join tbtipodocumento ti ON ti.idtipodocumento = per.reftipodocumento 
inner join tbestadocivil es ON es.idestadocivil = per.refestadocivil 
inner join tbtiposcargos tip ON tip.idtipocargo = p.reftiposcargos 
order by 1"; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerPersonalcargosPorPersonaTodos($idPersona) { 
$sql = "select 
p.idpersonalcargo,
tip.cargo,
coo.descripcion,
p.fechaalta,
p.fechabaja,
p.fechabajatentativa,
p.puntos,
p.monto,
o.nombre as obra,
fu.horario,
di.dia,
per.apellido,
per.nombre,
per.nrodocumento,
p.fechacrea,
p.usuacrea,
p.fechamodi,
p.usuamodi,
p.refpersonal,
p.reftiposcargos,
p.reffunciones
from dbpersonalcargos p 
inner join dbpersonal per ON per.idpersonal = p.refpersonal 
inner join tbtipodocumento ti ON ti.idtipodocumento = per.reftipodocumento 
inner join tbestadocivil es ON es.idestadocivil = per.refestadocivil 
inner join tbtiposcargos tip ON tip.idtipocargo = p.reftiposcargos 
inner join dbfunciones fu ON fu.idfuncion = p.reffunciones
inner join dbcooperativas coo ON coo.idcooperativa = fu.refcooperativas
inner join dbobras o ON o.idobra = fu.refobras
inner join tbdias di ON di.iddia = fu.refdias
where per.idpersonal = ".$idPersona."
order by 1"; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerPersonalcargosPorPersonaActivos($idPersona) { 
$sql = "select 
p.idpersonalcargo,
per.apellido,
per.nombre,
per.nrodocumento,
tip.cargo,
coo.descripcion,
o.nombre as obra,
di.dia,
fu.horario,
p.fechaalta,
p.fechabaja,
p.fechabajatentativa,
p.puntos,
p.monto,
p.fechacrea,
p.usuacrea,
p.fechamodi,
p.usuamodi,
p.refpersonal,
p.reftiposcargos,
p.reffunciones
from dbpersonalcargos p 
inner join dbpersonal per ON per.idpersonal = p.refpersonal 
inner join tbtipodocumento ti ON ti.idtipodocumento = per.reftipodocumento 
inner join tbestadocivil es ON es.idestadocivil = per.refestadocivil 
inner join tbtiposcargos tip ON tip.idtipocargo = p.reftiposcargos 
inner join dbfunciones fu ON fu.idfuncion = p.reffunciones
inner join dbcooperativas coo ON coo.idcooperativa = fu.refcooperativas
inner join dbobras o ON o.idobra = fu.refobras
inner join tbdias di ON di.iddia = fu.refdias
where per.idpersonal = ".$idPersona." and (fechabaja is null or fechabaja > now() or fechabaja = '0000-00-00')
order by 1"; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerPersonalcargosPorId($id) { 
$sql = "select idpersonalcargo,refpersonal,reftiposcargos,reffunciones,fechaalta,fechabaja,fechabajatentativa,puntos,monto,fechacrea,usuacrea,fechamodi,usuamodi from dbpersonalcargos where idpersonalcargo =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 

function traerPersonalcargosPorPersona($idPersona) { 
$sql = "select idpersonalcargo,refpersonal,reftiposcargos,reffunciones,fechaalta,fechabaja,fechabajatentativa,puntos,monto,fechacrea,usuacrea,fechamodi,usuamodi from dbpersonalcargos where refpersonal =".$idPersona; 
$res = $this->query($sql,0); 
return $res; 
} 

/* Fin */
/* /* Fin de la Tabla: dbpersonalcargos*/



/* PARA Categorias */

function insertarCategorias($descripcion,$refobras,$refcuponeras,$porcentaje,$monto,$pocentajeretenido) { 
$sql = "insert into dbcategorias(idcategoria,descripcion,refobras,refcuponeras,porcentaje,monto,pocentajeretenido) 
values ('','".utf8_decode($descripcion)."',".$refobras.",".$refcuponeras.",".$porcentaje.",".$monto.",".$pocentajeretenido.")"; 
$res = $this->query($sql,1); 
return $res; 
}

function insertarCategoriasMasivo($descripcion,$refobras,$refcuponeras,$porcentaje,$monto,$pocentajeretenido) { 
$sql = "insert into dbcategorias(idcategoria,descripcion,refobras,refcuponeras,porcentaje,monto,pocentajeretenido)
		select
		'',
		'".utf8_decode($descripcion)."',
		o.idobra,
		".$refcuponeras.",
		".$porcentaje.",
		".$monto.",
		".$pocentajeretenido."
		from		dbobras o"; 
$res = $this->query($sql,1); 
return $res; 
} 


function modificarCategorias($id,$descripcion,$refobras,$refcuponeras,$porcentaje,$monto,$pocentajeretenido) { 
$sql = "update dbcategorias 
set 
descripcion = '".utf8_decode($descripcion)."',refobras = ".$refobras.",refcuponeras = ".$refcuponeras.",porcentaje = ".$porcentaje.",monto = ".$monto.",pocentajeretenido = ".$pocentajeretenido." 
where idcategoria =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function eliminarCategorias($id) { 
$sql = "delete from dbcategorias where idcategoria =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerCategorias() { 
$sql = "select 
c.idcategoria,
c.descripcion,
obr.nombre as obra,
cup.nombre as cuponera,
c.porcentaje,
c.monto,
c.pocentajeretenido,
c.refobras,
c.refcuponeras
from dbcategorias c 
inner join dbobras obr ON obr.idobra = c.refobras 
inner join tbsalas sa ON sa.idsala = obr.refsalas 
inner join tbcuponeras cup ON cup.idcuponera = c.refcuponeras 
order by 1"; 
$res = $this->query($sql,0); 
return $res; 
} 

function traerCategoriasPorObra($idObra) { 
$sql = "select 
c.idcategoria,
c.descripcion,
obr.nombre as obra,
cup.nombre as cuponera,
c.porcentaje,
c.monto,
c.pocentajeretenido,
c.refobras,
c.refcuponeras
from dbcategorias c 
inner join dbobras obr ON obr.idobra = c.refobras 
inner join tbsalas sa ON sa.idsala = obr.refsalas 
inner join tbcuponeras cup ON cup.idcuponera = c.refcuponeras 
where	obr.idobra = ".$idObra."
order by 1"; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerCategoriasPorId($id) { 
$sql = "select idcategoria,descripcion,refobras,refcuponeras,porcentaje,monto,pocentajeretenido from dbcategorias where idcategoria =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerDescuentoPorcentualCategorias($idCategorias) { 
	$sql = "select porcentaje from dbcategorias where idcategoria =".$idCategorias; 
	$res = $this->existeDevuelveId($sql); 
	return $res; 
} 

function traerDescuentoMontoCategorias($idCategorias) { 
	$sql = "select monto from dbcategorias where idcategoria =".$idCategorias; 
	$res = $this->existeDevuelveId($sql); 
	return $res; 
}

function traerCategoriasPorFuncion($idFuncion) {
	$sql = "select
				c.idcategoria,c.descripcion, c.porcentaje, c.monto, c.pocentajeretenido
			from		dbfunciones f
			inner
			join		dbobras o
			ON			o.idobra = f.refobras
			inner
			join		dbcategorias c
			on			o.idobra = c.refobras
			where		f.idfuncion =".$idFuncion; 
	$res = $this->query($sql,0); 
	return $res;
}
/* Fin */
/* /* Fin de la Tabla: dbcategorias*/


/* PARA Promosobras */

function insertarPromosobras($descripcion,$refobras,$vigenciadesde,$vigenciahasta,$porcentaje,$monto) { 
$sql = "insert into dbpromosobras(idpromoobra,descripcion,refobras,vigenciadesde,vigenciahasta,porcentaje,monto) 
values ('','".utf8_decode($descripcion)."',".$refobras.",".($vigenciadesde == '' ? 'NULL' : "'".$vigenciadesde."'").",".($vigenciahasta == '' ? 'NULL' : "'".$vigenciahasta."'").",".($porcentaje == '' ? 0 : $porcentaje).",".($monto == '' ? 0 : $monto).")"; 
$res = $this->query($sql,1); 
return $res; 
} 


function modificarPromosobras($id,$descripcion,$refobras,$vigenciadesde,$vigenciahasta,$porcentaje,$monto) { 
$sql = "update dbpromosobras 
set 
descripcion = '".utf8_decode($descripcion)."',refobras = ".$refobras.",vigenciadesde = ".($vigenciadesde == '' ? 'NULL' : "'".$vigenciadesde."'").",vigenciahasta = ".($vigenciahasta == '' ? 'NULL' : "'".$vigenciahasta."'").",porcentaje = ".$porcentaje.",monto = ".$monto." 
where idpromoobra =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function eliminarPromosobras($id) { 
$sql = "delete from dbpromosobras where idpromoobra =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerPromosobras() { 
$sql = "select 
p.idpromoobra,
p.descripcion,
p.refobras,
p.vigenciadesde,
p.vigenciahasta,
p.porcentaje,
p.monto
from dbpromosobras p 
inner join dbobras obr ON obr.idobra = p.refobras 
inner join tbsalas sa ON sa.idsala = obr.refsalas 
order by 1"; 
$res = $this->query($sql,0); 
return $res; 
} 

function traerPromosobrasActivosPorObra($idObra) { 
$sql = "select 
p.idpromoobra,
p.descripcion,
p.refobras,
p.vigenciadesde,
p.vigenciahasta,
p.porcentaje,
p.monto
from dbpromosobras p 
inner join dbobras obr ON obr.idobra = p.refobras 
inner join tbsalas sa ON sa.idsala = obr.refsalas 
where	obr.idobra = ".$idObra." and (p.vigenciadesde <= now() and p.vigenciahasta >= now() or (p.vigenciahasta = '0000-00-00' or p.vigenciahasta is null))
order by 1"; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerPromosobrasPorId($id) { 
$sql = "select idpromoobra,descripcion,refobras,vigenciadesde,vigenciahasta,porcentaje,monto from dbpromosobras where idpromoobra =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerDescuentoPorcentualPromociones($idPromo) { 
	$sql = "select porcentaje from dbpromosobras where idpromoobra =".$idPromo; 
	$res = $this->existeDevuelveId($sql); 
	return $res; 
} 

function traerDescuentoMontoPromociones($idPromo) { 
	$sql = "select monto from dbpromosobras where idpromoobra =".$idPromo; 
	$res = $this->existeDevuelveId($sql); 
	return $res; 
}


function traerPromosObrasPorFuncion($idFuncion) {
	$sql = "select
			p.idpromoobra,p.descripcion, p.porcentaje, p.monto
			from		dbfunciones f
			inner
			join		dbobras o
			ON			o.idobra = f.refobras
			inner
			join		dbpromosobras p
			on			o.idobra = p.refobras and (p.vigenciadesde <= now() and p.vigenciahasta >= now() or (p.vigenciahasta = '0000-00-00' or p.vigenciahasta is null))
			where		f.idfuncion =".$idFuncion; 
	$res = $this->query($sql,0); 
	return $res;

}
/* Fin */
/* /* Fin de la Tabla: dbpromosobras*/


/* PARA Ventas */

function generarNroVenta() {
	$sql = "select max(idventa) as id from dbventas";	
	$res = $this->query($sql,0);
	
	if (mysql_num_rows($res)>0) {
		$nro = 'CC'.str_pad(mysql_result($res,0,0)+1, 8, "0", STR_PAD_LEFT);
	} else {
		$nro = 'TC00000001';
	}
	
	return $nro;
}

function insertarVentas($numero,$reftipopago,$fecha,$total,$cancelado,$usuario,$reffunciones,$refalbum,$valorentrada,$observacion,$fechacreacion,$usuacrea,$fechamodi,$usuamodi,$cantidad,$totalefectivo,$totaltarjeta) {
$sql = "insert into dbventas(idventa,numero,reftipopago,fecha,total,cancelado,usuario,reffunciones,refalbum,valorentrada,observacion,fechacreacion,usuacrea,fechamodi,usuamodi,cantidad,totalefectivo,totaltarjeta)
values ('','".utf8_decode($numero)."',1,'".utf8_decode($fecha)."',".$total.",".$cancelado.",'".utf8_decode($usuario)."',".$reffunciones.",".($refalbum == '' ? 0 : $refalbum).",".($valorentrada == '' ? 0 : $valorentrada).",'".utf8_decode($observacion)."','".($fechacreacion)."','".utf8_decode($usuacrea)."','".($fechamodi)."','".utf8_decode($usuamodi)."',".($cantidad == '' ? 1 : $cantidad).",".($totalefectivo == '' ? 0 : $totalefectivo).",".($totaltarjeta == '' ? 0 : $totaltarjeta).")";
$res = $this->query($sql,1);
return $res;
}


function modificarVentas($id,$numero,$reftipopago,$fecha,$total,$cancelado,$usuario,$reffunciones,$refalbum,$valorentrada,$observacion,$fechacreacion,$usuacrea,$fechamodi,$usuamodi,$cantidad,$totalefectivo,$totaltarjeta) {
$sql = "update dbventas
set
numero = '".utf8_decode($numero)."',reftipopago = ".$reftipopago.",fecha = '".utf8_decode($fecha)."',total = ".$total.",cancelado = ".$cancelado.",usuario = '".utf8_decode($usuario)."',reffunciones = ".$reffunciones.",refalbum = ".($refalbum == '' ? 0 : $refalbum).",valorentrada = ".($valorentrada == '' ? 0 : $valorentrada).",observacion = '".utf8_decode($observacion)."',fechacreacion = '".utf8_decode($fechacreacion)."',usuacrea = '".utf8_decode($usuacrea)."',fechamodi = '".utf8_decode($fechamodi)."',usuamodi = '".utf8_decode($usuamodi)."',cantidad = ".($cantidad == '' ? 1 : $cantidad).",totalefectivo = ".($totalefectivo == '' ? 0 : $totalefectivo).",totaltarjeta = ".($totaltarjeta == '' ? 0 : $totaltarjeta)."
where idventa =".$id;
$res = $this->query($sql,0);
return $res;
} 


function eliminarVentas($id) {
$sql = "delete from dbventas where idventa =".$id;
$res = $this->query($sql,0);
return $res;
}


function traerVentas() {
$sql = "select
v.idventa,
v.numero,
v.fecha,
v.total,
v.cancelado,
v.usuario,
v.reftipopago,
v.reffunciones,
v.refalbum
from dbventas v
left join tbtipopago tip ON tip.idtipopago = v.reftipopago
order by 1";
$res = $this->query($sql,0);
return $res;
}

function traerVentasPorDia($fecha) {
	$sql = "select
v.idventa,
v.numero,
o.nombre as obra,
di.dia,
fu.horario,
v.fecha,
v.cantidad,
v.valorentrada,
v.total,
v.totalefectivo,
v.totaltarjeta,
(case when v.cancelado = 1 then 'Si' else 'No' end) as cancelado,
a.banda as banda,
a.album as album,
v.reftipopago,
v.reffunciones,
v.refalbum,
o.idobra,
v.usuario
from dbventas v
left join tbtipopago tip ON tip.idtipopago = v.reftipopago
inner join dbfunciones fu on fu.idfuncion = v.reffunciones
inner join tbdias di on di.iddia = fu.refdias
inner join dbobras o ON o.idobra = fu.refobras
left join dbalbumobras ao ON ao.refobras = o.idobra
left join tbalbum a ON a.idalbum = v.refalbum
where	v.fecha = '".$fecha."'
order by 1 desc";
$res = $this->query($sql,0);
return $res;
}


function traerVentasPorDiaFuncionActivos($fecha, $reffuncion) {
	$sql = "select
v.idventa,
v.numero,
o.nombre as obra,
di.dia,
fu.horario,
v.fecha,
v.cantidad,
v.valorentrada,
v.total,
v.totalefectivo,
v.totaltarjeta,
(case when v.cancelado = 1 then 'Si' else 'No' end) as cancelado,
a.banda as banda,
a.album as album,
v.reftipopago,
v.reffunciones,
v.refalbum,
o.idobra,
v.usuario,
sa.capacidad,
o.cantpulicidad,
o.valorpulicidad,
o.valorticket,
o.costotranscciontarjetaiva,
o.porcentajeargentores,
round((o.valorticket * v.cantidad),2) as costopapelentrada,
round((o.costotranscciontarjetaiva / 100 * v.totaltarjeta),2) as gastotarjeta,
round((o.porcentajeargentores / 100 * v.total),2) as argentores,
o.porcentajereparto,
o.porcentajeretencion,
v.observacion
from dbventas v
left join tbtipopago tip ON tip.idtipopago = v.reftipopago
inner join dbfunciones fu on fu.idfuncion = v.reffunciones
inner join tbdias di on di.iddia = fu.refdias
inner join dbobras o ON o.idobra = fu.refobras
inner join tbsalas sa ON sa.idsala = o.refsalas
left join dbalbumobras ao ON ao.refobras = o.idobra
left join tbalbum a ON a.idalbum = v.refalbum
where	v.fecha = '".$fecha."' and fu.idfuncion = ".$reffuncion." and v.cancelado = 0
order by 1 desc";
$res = $this->query($sql,0);
return $res;
}

function traerVentasPorDiaActivos($fecha) {
	$sql = "select
v.idventa,
v.numero,
o.nombre as obra,
di.dia,
fu.horario,
v.fecha,
v.cantidad,
v.valorentrada,
v.total,
v.totalefectivo,
v.totaltarjeta,
(case when v.cancelado = 1 then 'Si' else 'No' end) as cancelado,
a.banda as banda,
a.album as album,
v.reftipopago,
v.reffunciones,
v.refalbum,
o.idobra,
v.usuario,
sa.capacidad,
o.cantpulicidad,
o.valorpulicidad,
o.valorticket,
o.costotranscciontarjetaiva,
o.porcentajeargentores,
round((o.valorticket * v.valorentrada),2) as costopapelentrada,
round((o.costotranscciontarjetaiva / 100 * v.totaltarjeta),2) as gastotarjeta,
round((o.porcentajeargentores / 100 * v.total),2) as argentores,
o.porcentajereparto,
o.porcentajeretencion,
v.observacion
from dbventas v
left join tbtipopago tip ON tip.idtipopago = v.reftipopago
inner join dbfunciones fu on fu.idfuncion = v.reffunciones
inner join tbdias di on di.iddia = fu.refdias
inner join dbobras o ON o.idobra = fu.refobras
inner join tbsalas sa ON sa.idsala = o.refsalas
left join dbalbumobras ao ON ao.refobras = o.idobra
left join tbalbum a ON a.idalbum = v.refalbum
where	v.fecha = '".$fecha."' and v.cancelado = 0
order by 1 desc";
$res = $this->query($sql,0);
return $res;
}


function traerVentasPorMesObraActivos($mes) {
	$sql = "select
v.idventa,
v.numero,
o.nombre as obra,
di.dia,
fu.horario,
v.fecha,
v.cantidad,
v.valorentrada,
v.total,
v.totalefectivo,
v.totaltarjeta,
(case when v.cancelado = 1 then 'Si' else 'No' end) as cancelado,
a.banda as banda,
a.album as album,
v.reftipopago,
v.reffunciones,
v.refalbum,
o.idobra,
v.usuario,
sa.capacidad,
o.cantpulicidad,
o.valorpulicidad,
o.valorticket,
o.costotranscciontarjetaiva,
o.porcentajeargentores,
round((o.valorticket * v.valorentrada),2) as costopapelentrada,
round((o.costotranscciontarjetaiva / 100 * v.totaltarjeta),2) as gastotarjeta,
round((o.porcentajeargentores / 100 * v.total),2) as argentores,
o.porcentajereparto,
o.porcentajeretencion,
v.observacion
from dbventas v
left join tbtipopago tip ON tip.idtipopago = v.reftipopago
inner join dbfunciones fu on fu.idfuncion = v.reffunciones
inner join tbdias di on di.iddia = fu.refdias
inner join dbobras o ON o.idobra = fu.refobras
inner join tbsalas sa ON sa.idsala = o.refsalas
left join dbalbumobras ao ON ao.refobras = o.idobra
left join tbalbum a ON a.idalbum = v.refalbum
where	v.fecha = '".$fecha."' and v.cancelado = 0
order by 1 desc";
$res = $this->query($sql,0);
return $res;
}


function traerVentasPorDiaActivosDetalle($idVenta) {
	$sql = "select
v.idventa,
v.numero,
o.nombre as obra,
di.dia,
fu.horario,
v.fecha,
v.cantidad,
v.valorentrada,
v.total,
v.totalefectivo,
v.totaltarjeta,
(case when v.cancelado = 1 then 'Si' else 'No' end) as cancelado,
a.banda as banda,
a.album as album,
v.reftipopago,
v.reffunciones,
v.refalbum,
o.idobra,
v.usuario
from dbventas v
left join tbtipopago tip ON tip.idtipopago = v.reftipopago
inner join dbfunciones fu on fu.idfuncion = v.reffunciones
inner join tbdias di on di.iddia = fu.refdias
inner join dbobras o ON o.idobra = fu.refobras
left join dbalbumobras ao ON ao.refobras = o.idobra
left join tbalbum a ON a.idalbum = v.refalbum
where	v.fecha = '".$fecha."' and v.cancelado = 1
order by 1 desc";
$res = $this->query($sql,0);
return $res;
}

function traerPuntosTotalesPorVenta($idVenta) {
	$sql = "select sum(p.puntos) from dbpersonalventa p where p.refventas =".$idVenta;
	
	$res = $this->query($sql,0);
	return $res;	
}

function traerGastosPorFuncion($fecha, $idFuncion) {
	$sql = "SELECT coalesce( sum(monto),0) as gasto
			FROM dbventas v 
			inner
			join	dbfunciones fu
			ON		fu.idfuncion = v.reffunciones
			inner
			join	dbgastosobras g
			on		g.reffunciones = fu.idfuncion
			where month(v.fecha) = month('".$fecha."') and year(v.fecha) = year('".$fecha."') and v.cancelado = 0 and fu.idfuncion = ".$idFuncion;
			
	$res = $this->query($sql,0);
	return $res;	
}


function traerVentasPorObrasFecha($fecha, $idObra) {
	$sql = "SELECT v.idventa ,fu.idfuncion , date_format(v.fecha,'%Y-%m-%d') as fecha
			FROM dbventas v 
			inner
			join	dbfunciones fu
			ON		fu.idfuncion = v.reffunciones
			where month(v.fecha) = month('".$fecha."') and year(v.fecha) = year('".$fecha."') and v.cancelado = 0 and fu.refobras = ".$idObra;	
			
	$res = $this->query($sql,0);
	return $res;
}

function traerTotalCooperativaPorObra($idObra, $desde, $hasta) {
	$sql = "select
			  sum(ROUND(r.porcentajereparto/100 * r.subtotal - ( r.porcentajeretencion / 100 * (r.porcentajereparto/100 * r.subtotal)), 2)) totalcooperativas
			from (
			SELECT 
				v.idventa,
				fu.idfuncion,
				ROUND(v.total - o.valorpulicidad - o.valorticket * v.cantidad - (o.costotranscciontarjetaiva / 100) * v.totaltarjeta - (o.porcentajeargentores / 100) * v.total,
						2) AS subtotal,
				o.porcentajereparto,
				o.porcentajeretencion
			FROM
				dbventas v
					INNER JOIN
				dbfunciones fu ON fu.idfuncion = v.reffunciones
					INNER JOIN
				dbobras o ON o.idobra = fu.refobras
			WHERE
				MONTH(v.fecha) = 8
					AND YEAR(v.fecha) = 2017
					AND v.cancelado = 0
					AND fu.refobras = 1
					) r";	
	$res = $this->query($sql,0); 
	return $res; 
}

function traerVentasPorId($id) { 
$sql = "select idventa,numero,reftipopago,fecha,total,(case when cancelado=1 then 'Si' else 'No' end) as cancelado,usuario,reffunciones,refalbum,valorentrada,observacion,fechacreacion,usuacrea,fechamodi,usuamodi,cantidad,totalefectivo, totaltarjeta from dbventas where idventa =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


/* Fin */
/* /* Fin de la Tabla: dbventas*/


/* PARA Ventadetalle */

function insertarVentadetalle($refventas,$total,$refcategorias,$refpromosobras,$monto,$porcentaje,$cantidad) {
$sql = "insert into dbventadetalle(idventadetalle,refventas,total,refcategorias,refpromosobras,monto,porcentaje,cantidad)
values ('',".$refventas.",".$total.",".$refcategorias.",".$refpromosobras.",".$monto.",".$porcentaje.",".$cantidad.")";
$res = $this->query($sql,1);
return $res;
}


function modificarVentadetalle($id,$refventas,$total,$refcategorias,$refpromosobras,$monto,$porcentaje,$cantidad) {
$sql = "update dbventadetalle
set
refventas = ".$refventas.",total = ".$total.",refcategorias = ".$refcategorias.",refpromosobras = ".$refpromosobras.",monto = ".$monto.",porcentaje = ".$porcentaje.",cantidad = ".$cantidad."
where idventadetalle =".$id;
$res = $this->query($sql,0);
return $res;
}


function eliminarVentadetalle($id) {
$sql = "delete from dbventadetalle where idventadetalle =".$id;
$res = $this->query($sql,0);
return $res;
}


function traerVentadetalle() {
$sql = "select
v.idventadetalle,
v.refventas,
v.total,
v.refcategorias,
v.refpromosobras,
v.monto,
v.porcentaje,
v.cantidad
from dbventadetalle v
inner join dbventas ven ON ven.idventa = v.refventas
inner join tbtipopago ti ON ti.idtipopago = ven.reftipopago
inner join dbfunciones fu ON fu.idfuncion = ven.reffunciones
order by 1";
$res = $this->query($sql,0);
return $res;
}


function traerVentadetallePorVentaCategoria($idVenta) {
$sql = "select
v.idventadetalle,
v.refventas,
v.total,
cat.descripcion,
v.refcategorias,
v.refpromosobras,
v.monto,
v.porcentaje,
v.cantidad
from dbventadetalle v
inner join dbventas ven ON ven.idventa = v.refventas
inner join tbtipopago ti ON ti.idtipopago = ven.reftipopago
inner join dbfunciones fu ON fu.idfuncion = ven.reffunciones
inner join dbcategorias cat ON cat.idcategoria = v.refcategorias
where ven.idventa = ".$idVenta."
order by 1";
$res = $this->query($sql,0);
return $res;
}


function traerVentadetallePorVentaPromociones($idVenta) {
$sql = "select
v.idventadetalle,
v.refventas,
v.total,
cat.descripcion,
v.refcategorias,
v.refpromosobras,
v.monto,
v.porcentaje,
v.cantidad
from dbventadetalle v
inner join dbventas ven ON ven.idventa = v.refventas
inner join tbtipopago ti ON ti.idtipopago = ven.reftipopago
inner join dbfunciones fu ON fu.idfuncion = ven.reffunciones
inner join dbpromosobras cat ON cat.idpromoobra = v.refpromosobras
where ven.idventa = ".$idVenta."
order by 1";
$res = $this->query($sql,0);
return $res;
}


function traerVentadetallePorId($id) {
$sql = "select idventadetalle,refventas,total,refcategorias,refpromosobras,monto,porcentaje,cantidad from dbventadetalle where idventadetalle =".$id;
$res = $this->query($sql,0);
return $res;
}

/* Fin */
/* /* Fin de la Tabla: dbventadetalle*/



/* PARA Personalventa */

function insertarPersonalventa($refpersonal,$refventas,$puntos) {
$sql = "insert into dbpersonalventa(idpersonalventa,refpersonal,refventas,puntos)
values ('',".$refpersonal.",".$refventas.",".$puntos.")";
$res = $this->query($sql,1);
return $res;
}


function modificarPersonalventa($id,$refpersonal,$refventas,$puntos) {
$sql = "update dbpersonalventa
set
refpersonal = ".$refpersonal.",refventas = ".$refventas.",puntos = ".$puntos."
where idpersonalventa =".$id;
$res = $this->query($sql,0);
return $res;
}


function eliminarPersonalventa($id) {
$sql = "delete from dbpersonalventa where idpersonalventa =".$id;
$res = $this->query($sql,0);
return $res;
}


function traerPersonalventa() {
$sql = "select
p.idpersonalventa,
p.refpersonal,
p.refventas,
p.puntos
from dbpersonalventa p
inner join dbpersonal per ON per.idpersonal = p.refpersonal
inner join tbtipodocumento ti ON ti.idtipodocumento = per.reftipodocumento
inner join tbestadocivil es ON es.idestadocivil = per.refestadocivil
inner join dbventas ven ON ven.idventa = p.refventas
inner join tbtipopago ti ON ti.idtipopago = ven.reftipopago
inner join dbfunciones fu ON fu.idfuncion = ven.reffunciones
order by 1";
$res = $this->query($sql,0);
return $res;
}


function traerPersonalventaPorId($id) {
$sql = "select idpersonalventa,refpersonal,refventas,puntos from dbpersonalventa where idpersonalventa =".$id;
$res = $this->query($sql,0);
return $res;
}

/* Fin */
/* /* Fin de la Tabla: dbpersonalventa*/


/* PARA Cuponeras */

function insertarCuponeras($nombre,$direccion,$telefono,$cuit,$email,$activo) { 
$sql = "insert into tbcuponeras(idcuponera,nombre,direccion,telefono,cuit,email,activo) 
values ('','".utf8_decode($nombre)."','".utf8_decode($direccion)."','".utf8_decode($telefono)."','".utf8_decode($cuit)."','".utf8_decode($email)."',".$activo.")"; 
$res = $this->query($sql,1); 
return $res; 
} 


function modificarCuponeras($id,$nombre,$direccion,$telefono,$cuit,$email,$activo) { 
$sql = "update tbcuponeras 
set 
nombre = '".utf8_decode($nombre)."',direccion = '".utf8_decode($direccion)."',telefono = '".utf8_decode($telefono)."',cuit = '".utf8_decode($cuit)."',email = '".utf8_decode($email)."',activo = ".$activo." 
where idcuponera =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function eliminarCuponeras($id) { 
$sql = "delete from tbcuponeras where idcuponera =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerCuponeras() { 
$sql = "select 
c.idcuponera,
c.nombre,
c.direccion,
c.telefono,
c.cuit,
c.email,
(case when c.activo = 1 then 'Si' else 'No' end) as activo
from tbcuponeras c 
order by 1"; 
$res = $this->query($sql,0); 
return $res; 
} 

function traerCuponerasActivas() { 
$sql = "select 
c.idcuponera,
c.nombre,
c.direccion,
c.telefono,
c.cuit,
c.email,
(case when c.activo = 1 then 'Si' else 'No' end) as activo
from tbcuponeras c 
where c.activo = 1
order by 1"; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerCuponerasPorId($id) { 
$sql = "select idcuponera,nombre,direccion,telefono,cuit,email,(case when activo = 1 then 'Si' else 'No' end) as activo from tbcuponeras where idcuponera =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 

/* Fin */
/* /* Fin de la Tabla: tbcuponeras*/


/* PARA Proveedores */

function insertarProveedores($nombre,$cuit,$dni,$direccion,$telefono,$celular,$email,$observacionces) { 
$sql = "insert into dbproveedores(idproveedor,nombre,cuit,dni,direccion,telefono,celular,email,observacionces) 
values ('','".utf8_decode($nombre)."','".utf8_decode($cuit)."','".utf8_decode($dni)."','".utf8_decode($direccion)."','".utf8_decode($telefono)."','".utf8_decode($celular)."','".utf8_decode($email)."','".utf8_decode($observacionces)."')"; 
$res = $this->query($sql,1); 
return $res; 
} 


function modificarProveedores($id,$nombre,$cuit,$dni,$direccion,$telefono,$celular,$email,$observacionces) { 
$sql = "update dbproveedores 
set 
nombre = '".utf8_decode($nombre)."',cuit = '".utf8_decode($cuit)."',dni = '".utf8_decode($dni)."',direccion = '".utf8_decode($direccion)."',telefono = '".utf8_decode($telefono)."',celular = '".utf8_decode($celular)."',email = '".utf8_decode($email)."',observacionces = '".utf8_decode($observacionces)."' 
where idproveedor =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function eliminarProveedores($id) { 
$sql = "delete from dbproveedores where idproveedor =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerProveedores() { 
$sql = "select 
p.idproveedor,
p.nombre,
p.cuit,
p.dni,
p.direccion,
p.telefono,
p.celular,
p.email,
p.observacionces
from dbproveedores p 
order by 1"; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerProveedoresPorId($id) { 
$sql = "select idproveedor,nombre,cuit,dni,direccion,telefono,celular,email,observacionces from dbproveedores where idproveedor =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 

/* Fin */
/* /* Fin de la Tabla: dbproveedores*/




/* PARA Images */

function insertarImages($refproyecto,$refuser,$imagen,$type,$principal) { 
$sql = "insert into images(idfoto,refproyecto,refuser,imagen,type,principal) 
values ('',".$refproyecto.",".$refuser.",'".utf8_decode($imagen)."','".utf8_decode($type)."',".$principal.")"; 
$res = $this->query($sql,1); 
return $res; 
} 


function modificarImages($id,$refproyecto,$refuser,$imagen,$type,$principal) { 
$sql = "update images 
set 
refproyecto = ".$refproyecto.",refuser = ".$refuser.",imagen = '".utf8_decode($imagen)."',type = '".utf8_decode($type)."',principal = ".$principal." 
where idfoto =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function eliminarImages($id) { 
$sql = "delete from images where idfoto =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerImages() { 
$sql = "select 
i.idfoto,
i.refproyecto,
i.refuser,
i.imagen,
i.type,
i.principal
from images i 
order by 1"; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerImagesPorId($id) { 
$sql = "select idfoto,refproyecto,refuser,imagen,type,principal from images where idfoto =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 

/* Fin */
/* /* Fin de la Tabla: images*/




/* PARA Estadocivil */

function insertarEstadocivil($estadocivil,$activo) { 
$sql = "insert into tbestadocivil(idestadocivil,estadocivil,activo) 
values ('','".utf8_decode($estadocivil)."',".$activo.")"; 
$res = $this->query($sql,1); 
return $res; 
} 


function modificarEstadocivil($id,$estadocivil,$activo) { 
$sql = "update tbestadocivil 
set 
estadocivil = '".utf8_decode($estadocivil)."',activo = ".$activo." 
where idestadocivil =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function eliminarEstadocivil($id) { 
$sql = "update tbestadocivil set activo = 0 where idestadocivil =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 

function eliminarEstadocivilDefinitivo($id) { 
$sql = "delete from tbestadocivil where idestadocivil =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerEstadocivil() { 
$sql = "select 
e.idestadocivil,
e.estadocivil,
(case when e.activo = 1 then 'Si' else 'No' end) as activo
from tbestadocivil e 
order by 1"; 
$res = $this->query($sql,0); 
return $res; 
} 

function traerEstadocivilActivo() { 
$sql = "select 
e.idestadocivil,
e.estadocivil,
(case when e.activo = 1 then 'Si' else 'No' end) as activo
from tbestadocivil e 
where e.activo = 1
order by 1"; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerEstadocivilPorId($id) { 
$sql = "select idestadocivil,estadocivil,(case when activo = 1 then 'Si' else 'No' end) as activo from tbestadocivil where idestadocivil =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 

/* Fin */
/* /* Fin de la Tabla: tbestadocivil*/




/* PARA Salas */

function insertarSalas($descripcion,$capacidad,$activa) { 
$sql = "insert into tbsalas(idsala,descripcion,capacidad,activa) 
values ('','".utf8_decode($descripcion)."',".$capacidad.",".$activa.")"; 
$res = $this->query($sql,1); 
return $res; 
} 


function modificarSalas($id,$descripcion,$capacidad,$activa) { 
$sql = "update tbsalas 
set 
descripcion = '".utf8_decode($descripcion)."',capacidad = ".$capacidad.",activa = ".$activa." 
where idsala =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function eliminarSalas($id) { 
$sql = "delete from tbsalas where idsala =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerSalas() { 
$sql = "select 
s.idsala,
s.descripcion,
s.capacidad,
s.activa
from tbsalas s 
order by 1"; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerSalasPorId($id) { 
$sql = "select idsala,descripcion,capacidad,activa from tbsalas where idsala =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 

/* Fin */
/* /* Fin de la Tabla: tbsalas*/


/* PARA Dias */

function insertarDias($dia) { 
$sql = "insert into tbdias(iddia,dia) 
values ('','".utf8_decode($dia)."')"; 
$res = $this->query($sql,1); 
return $res; 
} 


function modificarDias($id,$dia) { 
$sql = "update tbdias 
set 
dia = '".utf8_decode($dia)."' 
where iddia =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function eliminarDias($id) { 
$sql = "delete from tbdias where iddia =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerDias() { 
$sql = "select 
d.iddia,
d.dia
from tbdias d 
order by 1"; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerDiasPorId($id) { 
$sql = "select iddia,dia from tbdias where iddia =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 

/* Fin */
/* /* Fin de la Tabla: tbdias*/

/* PARA Tipoconceptos */

function insertarTipoconceptos($tipoconcepto,$activo) { 
$sql = "insert into tbtipoconceptos(idtipoconcepto,tipoconcepto,activo) 
values ('','".utf8_decode($tipoconcepto)."',".$activo.")"; 
$res = $this->query($sql,1); 
return $res; 
} 


function modificarTipoconceptos($id,$tipoconcepto,$activo) { 
$sql = "update tbtipoconceptos 
set 
tipoconcepto = '".utf8_decode($tipoconcepto)."',activo = ".$activo." 
where idtipoconcepto =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function eliminarTipoconceptos($id) { 
$sql = "update tbtipoconceptos activo = 0 where idtipoconcepto =".$id; 
$res = $this->query($sql,0); 
return $res; 
}

function eliminarTipoconceptosDefinitivo($id) { 
$sql = "delete from tbtipoconceptos where idtipoconcepto =".$id; 
$res = $this->query($sql,0); 
return $res; 
}  


function traerTipoconceptos() { 
$sql = "select 
t.idtipoconcepto,
t.tipoconcepto,
(case when t.activo = 1 then 'Si' else 'No' end) as activo
from tbtipoconceptos t 
order by 1"; 
$res = $this->query($sql,0); 
return $res; 
} 

function traerTipoconceptosActivo() { 
$sql = "select 
t.idtipoconcepto,
t.tipoconcepto,
(case when t.activo = 1 then 'Si' else 'No' end) as activo
from tbtipoconceptos t 
where t.activo = 1
order by 1"; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerTipoconceptosPorId($id) { 
$sql = "select idtipoconcepto,tipoconcepto,(case when activo = 1 then 'Si' else 'No' end) as activo from tbtipoconceptos where idtipoconcepto =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 

/* Fin */
/* /* Fin de la Tabla: tbtipoconceptos*/


/* PARA Tipodocumento */

function insertarTipodocumento($tipodocumento,$activo) { 
$sql = "insert into tbtipodocumento(idtipodocumento,tipodocumento,activo) 
values ('','".utf8_decode($tipodocumento)."',".$activo.")"; 
$res = $this->query($sql,1); 
return $res; 
} 


function modificarTipodocumento($id,$tipodocumento,$activo) { 
$sql = "update tbtipodocumento 
set 
tipodocumento = '".utf8_decode($tipodocumento)."',activo = ".$activo." 
where idtipodocumento =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function eliminarTipodocumento($id) { 
$sql = "delete from tbtipodocumento where idtipodocumento =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerTipodocumento() { 
$sql = "select 
t.idtipodocumento,
t.tipodocumento,
t.activo
from tbtipodocumento t 
order by 1"; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerTipodocumentoPorId($id) { 
$sql = "select idtipodocumento,tipodocumento,activo from tbtipodocumento where idtipodocumento =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 

/* Fin */
/* /* Fin de la Tabla: tbtipodocumento*/




/* PARA Tiposcargos */

function insertarTiposcargos($cargo,$activo) { 
$sql = "insert into tbtiposcargos(idtipocargo,cargo,activo) 
values ('','".utf8_decode($cargo)."',".$activo.")"; 
$res = $this->query($sql,1); 
return $res; 
} 


function modificarTiposcargos($id,$cargo,$activo) { 
$sql = "update tbtiposcargos 
set 
cargo = '".utf8_decode($cargo)."',activo = ".$activo." 
where idtipocargo =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function eliminarTiposcargos($id) { 
$sql = "update tbtiposcargos activo = 0 where idtipocargo =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 

function eliminarTiposcargosDefinitivo($id) { 
$sql = "delete from tbtiposcargos where idtipocargo =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerTiposcargos() { 
$sql = "select 
t.idtipocargo,
t.cargo,
(case when t.activo = 1 then 'Si' else 'No' end) as activo
from tbtiposcargos t 
order by 1"; 
$res = $this->query($sql,0); 
return $res; 
} 

function traerTiposcargosActivo() { 
$sql = "select 
t.idtipocargo,
t.cargo,
(case when t.activo = 1 then 'Si' else 'No' end) as activo
from tbtiposcargos t 
where t.activo = 1
order by 1"; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerTiposcargosPorId($id) { 
$sql = "select idtipocargo,cargo,(case when activo = 1 then 'Si' else 'No' end) as activo from tbtiposcargos where idtipocargo =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 

/* Fin */
/* /* Fin de la Tabla: tbtiposcargos*/






/* PARA Usuarios */

function insertarUsuarios($usuario,$password,$refroles,$email,$nombrecompleto) { 
$sql = "insert into dbusuarios(idusuario,usuario,password,refroles,email,nombrecompleto) 
values ('','".utf8_decode($usuario)."','".utf8_decode($password)."',".$refroles.",'".utf8_decode($email)."','".utf8_decode($nombrecompleto)."')"; 
$res = $this->query($sql,1); 
return $res; 
} 


function modificarUsuarios($id,$usuario,$password,$refroles,$email,$nombrecompleto) { 
$sql = "update dbusuarios 
set 
usuario = '".utf8_decode($usuario)."',password = '".utf8_decode($password)."',refroles = ".$refroles.",email = '".utf8_decode($email)."',nombrecompleto = '".utf8_decode($nombrecompleto)."' 
where idusuario =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function eliminarUsuarios($id) { 
$sql = "delete from dbusuarios where idusuario =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerUsuarios() { 
$sql = "select 
u.idusuario,
u.usuario,
u.password,
u.refroles,
u.email,
u.nombrecompleto
from dbusuarios u 
inner join tbroles rol ON rol.idrol = u.refroles 
order by 1"; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerUsuariosPorId($id) { 
$sql = "select idusuario,usuario,password,refroles,email,nombrecompleto from dbusuarios where idusuario =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 

/* Fin */
/* /* Fin de la Tabla: dbusuarios*/





/* PARA Estados */

function insertarEstados($estado,$icono) { 
$sql = "insert into tbestados(idestado,estado,icono) 
values ('','".utf8_decode($estado)."','".utf8_decode($icono)."')"; 
$res = $this->query($sql,1); 
return $res; 
} 


function modificarEstados($id,$estado,$icono) { 
$sql = "update tbestados 
set 
estado = '".utf8_decode($estado)."',icono = '".utf8_decode($icono)."' 
where idestado =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function eliminarEstados($id) { 
$sql = "delete from tbestados where idestado =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerEstados() { 
$sql = "select 
e.idestado,
e.estado,
e.icono
from tbestados e 
order by 1"; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerEstadosPorId($id) { 
$sql = "select idestado,estado,icono from tbestados where idestado =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 

/* Fin */
/* /* Fin de la Tabla: tbestados*/



/* PARA Tipopago */

function insertarTipopago($descripcion) { 
$sql = "insert into tbtipopago(idtipopago,descripcion) 
values ('','".utf8_decode($descripcion)."')"; 
$res = $this->query($sql,1); 
return $res; 
} 


function modificarTipopago($id,$descripcion) { 
$sql = "update tbtipopago 
set 
descripcion = '".utf8_decode($descripcion)."' 
where idtipopago =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function eliminarTipopago($id) { 
$sql = "delete from tbtipopago where idtipopago =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerTipopago() { 
$sql = "select 
t.idtipopago,
t.descripcion
from tbtipopago t 
order by 1"; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerTipopagoPorId($id) { 
$sql = "select idtipopago,descripcion from tbtipopago where idtipopago =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 

/* Fin */



/* /* Fin de la Tabla: tbtipopago*/

function estadosFingidos() {
$sql = "SELECT 'Activo' as estado
union all
select 'Inactivo' as estado";
	$res = $this->query($sql,0); 
return $res; 
}


/* PARA Predio_menu */

function insertarPredio_menu($url,$icono,$nombre,$Orden,$hover,$permiso) {
$sql = "insert into predio_menu(idmenu,url,icono,nombre,Orden,hover,permiso)
values ('','".utf8_decode($url)."','".utf8_decode($icono)."','".utf8_decode($nombre)."',".$Orden.",'".utf8_decode($hover)."','".utf8_decode($permiso)."')";
$res = $this->query($sql,1);
return $res;
}


function modificarPredio_menu($id,$url,$icono,$nombre,$Orden,$hover,$permiso) {
$sql = "update predio_menu
set
url = '".utf8_decode($url)."',icono = '".utf8_decode($icono)."',nombre = '".utf8_decode($nombre)."',Orden = ".$Orden.",hover = '".utf8_decode($hover)."',permiso = '".utf8_decode($permiso)."'
where idmenu =".$id;
$res = $this->query($sql,0);
return $res;
}


function eliminarPredio_menu($id) {
$sql = "delete from predio_menu where idmenu =".$id;
$res = $this->query($sql,0);
return $res;
}


function traerPredio_menu() {
$sql = "select
p.idmenu,
p.url,
p.icono,
p.nombre,
p.Orden,
p.hover,
p.permiso
from predio_menu p
order by 1";
$res = $this->query($sql,0);
return $res;
}


function traerPredio_menuPorId($id) {
$sql = "select idmenu,url,icono,nombre,Orden,hover,permiso from predio_menu where idmenu =".$id;
$res = $this->query($sql,0);
return $res;
}

/* Fin */
/* /* Fin de la Tabla: predio_menu*/



/* PARA Roles */

function insertarRoles($descripcion,$activo) {
$sql = "insert into tbroles(idrol,descripcion,activo)
values ('','".utf8_decode($descripcion)."',".$activo.")";
$res = $this->query($sql,1);
return $res;
}


function modificarRoles($id,$descripcion,$activo) {
$sql = "update tbroles
set
descripcion = '".utf8_decode($descripcion)."',activo = ".$activo."
where idrol =".$id;
$res = $this->query($sql,0);
return $res;
}


function eliminarRoles($id) {
$sql = "delete from tbroles where idrol =".$id;
$res = $this->query($sql,0);
return $res;
}


function traerRoles() {
$sql = "select
r.idrol,
r.descripcion,
r.activo
from tbroles r
order by 1";
$res = $this->query($sql,0);
return $res;
}


function traerRolesPorId($id) {
$sql = "select idrol,descripcion,activo from tbroles where idrol =".$id;
$res = $this->query($sql,0);
return $res;
}

/* Fin */
/* /* Fin de la Tabla: tbroles*/




function graficosProductosConsumo($anio) {


	$sql = "select
			
				p.refcategorias, c.descripcion, coalesce(count(c.idcategoria),0)
		
					from dbventas v
					inner join tbtipopago tip ON tip.idtipopago = v.reftipopago
					inner join dbclientes cli ON cli.idcliente = v.refclientes
					inner join dbdetalleventas dv ON v.idventa = dv.refventas
					inner join dbproductos p ON p.idproducto = dv.refproductos
					inner join tbcategorias c ON c.idcategoria = p.refcategorias
					where	year(v.fecha) = ".$anio." and c.esegreso = 0 and v.cancelado = 0
			group by p.refcategorias, c.descripcion
			";
			
	$sqlT = "select
			
				coalesce(count(p.idproducto),0)

			from dbventas v
			inner join tbtipopago tip ON tip.idtipopago = v.reftipopago
			inner join dbclientes cli ON cli.idcliente = v.refclientes
			inner join dbdetalleventas dv ON v.idventa = dv.refventas
			inner join dbproductos p ON p.idproducto = dv.refproductos
			inner join tbcategorias c ON c.idcategoria = p.refcategorias
			where	year(v.fecha) = ".$anio." and c.esegreso = 0 and v.cancelado = 0";
			
	$sqlT2 = "select
					count(*)
				from dbproductos p
				where p.activo = 1
			";

	
	$resT = mysql_result($this->query($sqlT,0),0,0);
	$resR = $this->query($sql,0);
	
	$cad	= "Morris.Donut({
              element: 'graph2',
              data: [";
	$cadValue = '';
	if ($resT > 0) {
		while ($row = mysql_fetch_array($resR)) {
			$cadValue .= "{value: ".((100 * $row[2])	/ $resT).", label: '".$row[1]."'},";
		}
	}
	

	$cad .= substr($cadValue,0,strlen($cadValue)-1);
    $cad .=          "],
              formatter: function (x) { return x + '%'}
            }).on('click', function(i, row){
              console.log(i, row);
            });";
			
	return $cad;
}


/* PARA Audit */

function insertarAudit($tabla,$idtabla,$campo,$previousvalue,$newvalue,$dateupdate,$user,$action) { 
$sql = "insert into audit(idaudit,tabla,idtabla,campo,previousvalue,newvalue,dateupdate,user,action) 
values ('','".utf8_decode($tabla)."',".$idtabla.",'".$campo."','".utf8_decode($previousvalue)."','".utf8_decode($newvalue)."','".utf8_decode($dateupdate)."','".utf8_decode($user)."','".utf8_decode($action)."')"; 
$res = $this->query($sql,1); 
return $res; 
} 


function modificarAudit($id,$tabla,$idtabla,$idmodificado,$previousvalue,$newvalue,$dateupdate,$user,$action) { 
$sql = "update audit 
set 
tabla = '".utf8_decode($tabla)."',idtabla = ".$idtabla.",idmodificado = ".$idmodificado.",previousvalue = '".utf8_decode($previousvalue)."',newvalue = '".utf8_decode($newvalue)."',dateupdate = '".utf8_decode($dateupdate)."',user = '".utf8_decode($user)."',action = '".utf8_decode($action)."' 
where idaudit =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function eliminarAudit($id) { 
$sql = "delete from audit where idaudit =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerAudit() { 
$sql = "select idaudit,tabla,idtabla,idmodificado,previousvalue,newvalue,dateupdate,user,action from audit order by 1"; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerAuditPorId($id) { 
$sql = "select idaudit,tabla,idtabla,idmodificado,previousvalue,newvalue,dateupdate,user,action from audit where idaudit =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 

/* Fin */

/* PARA Cajadiaria */

function insertarCajadiaria($fecha,$inicio,$fin) {
$sql = "insert into tbcajadiaria(idcajadiaria,fecha,inicio,fin)
values ('','".utf8_decode($fecha)."',".$inicio.",".($fin == '' ? 0 : $fin).")";
$res = $this->query($sql,1);
return $res;
}


function modificarCajadiaria($id,$fecha,$inicio,$fin) {
$sql = "update tbcajadiaria
set
fecha = '".utf8_decode($fecha)."',inicio = ".$inicio.",fin = ".($fin == '' ? 0 : $fin)."
where idcajadiaria =".$id;
$res = $this->query($sql,0);
return $id;
}


function eliminarCajadiaria($id) {
$sql = "delete from tbcajadiaria where idcajadiaria =".$id;
$res = $this->query($sql,0);
return $res;
}


function traerCajadiaria() {
$sql = "select
c.idcajadiaria,
c.fecha,
c.inicio,
c.fin
from tbcajadiaria c
order by 1";
$res = $this->query($sql,0);
return $res;
}

function traerCajadiariaPorFecha($fecha) {
$sql = "select
c.idcajadiaria,
c.fecha,
c.inicio,
c.fin
from tbcajadiaria c 
where c.fecha = '".$fecha."'
";
$res = $this->query($sql,0);
return $res;
}


function traerCajadiariaPorId($id) {
$sql = "select idcajadiaria,fecha,inicio,fin from tbcajadiaria where idcajadiaria =".$id;
$res = $this->query($sql,0);
return $res;
}

/* Fin */
/* /* Fin de la Tabla: tbcajadiaria*/



function query($sql,$accion) {
		
		
		
		require_once 'appconfig.php';

		$appconfig	= new appconfig();
		$datos		= $appconfig->conexion();	
		$hostname	= $datos['hostname'];
		$database	= $datos['database'];
		$username	= $datos['username'];
		$password	= $datos['password'];
		
		$conex = mysql_connect($hostname,$username,$password) or die ("no se puede conectar".mysql_error());
		
		mysql_select_db($database);
		
		        $error = 0;
		mysql_query("BEGIN");
		$result=mysql_query($sql,$conex);
		if ($accion && $result) {
			$result = mysql_insert_id();
		}
		if(!$result){
			$error=1;
		}
		if($error==1){
			mysql_query("ROLLBACK");
			return false;
		}
		 else{
			mysql_query("COMMIT");
			return $result;
		}
		
	}

}

?>