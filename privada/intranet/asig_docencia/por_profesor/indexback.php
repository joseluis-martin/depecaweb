<?php
require_once("../../../core/bibliotecaint.inc.php");
include("../../../core/conexion.inc.php"); //Conexión con la base de datos
arriba("", "asig_docencia", "es", "Asignaci&oacute;n de Docencia");
session_start();

$user=$_SESSION['user'];

$nivel="asignacion_docencia";

if (isset($_GET['valor2']))
{
    $curso_recibido = $_GET['valor2'];   
    $anio1=substr($curso_recibido,0,4);
    $curso_recibido_ant=($anio1-1)."/".$anio1;
    $curso_recibido_2ant=($anio1-2)."/".($anio1-1);
}
else
{
    $curso_recibido=$_POST['curso'];
    $anio1=substr($curso_recibido,0,4);
    $curso_recibido_ant=($anio1-1)."/".$anio1;
    $curso_recibido_2ant=($anio1-2)."/".($anio1-1);
}

function calcular_carga_media($curso)
{
$link=Conectarse();
$sql_cargas = "select * from cargas_max where curso='$curso'";	    
$resul_cargas = mysql_query($sql_cargas, $link);
$suma_cargas=0;
while ($row_cargas = mysql_fetch_array($resul_cargas))
{
    $ni=$row_cargas["nif"];
    $sql_aux="SELECT * FROM cargas_max where nif='$ni' and curso='$curso'";
    $resul_aux=mysql_query($sql_aux,$link);
    $row_aux=mysql_fetch_array($resul_aux);
     if ($row_aux["situacion_academica"]=="ACTIVO")
    {
    $suma_cargas=$suma_cargas+$row_cargas['cargamax_total'];
    }
}
	
$sql_horas="SELECT
cod_asig,curso,HT1C_totales,HL1C_totales,HT2C_totales,HL2C_totales,
HEJ1C_totales, HEJ2C_totales,HT1EC_totales,HL1EC_totales,HT2EC_totales,
HL2EC_totales,HEJ1EC_totales,HEJ2EC_totales FROM horas_docencia WHERE cod_asig
IN (SELECT codigo FROM asignaturas WHERE (semestre<5 AND codigo_titulacion = 'G37') OR (semestre>4 AND (codigo_titulacion = 'G35' OR codigo_titulacion = 'G37' OR
codigo_titulacion = 'G38' OR codigo_titulacion = 'G39')) OR codigo_titulacion =
'G430' OR codigo_titulacion =
'G59' OR codigo_titulacion = 'G60' OR codigo_titulacion = 'G652'
 OR codigo_titulacion = 'M076'  OR codigo_titulacion = 'M125' OR codigo_titulacion = 'M141 'OR
codigo_titulacion = '00' OR codigo_titulacion = '01' OR 
codigo_titulacion = '02' OR codigo_titulacion = 'M888' OR codigo_titulacion = 'M180' OR codigo_titulacion = 'G591' OR codigo_titulacion = 'G781') AND curso = '$curso'";	



$resul_horas = mysql_query($sql_horas, $link);
$suma_horas=0;
while ($row_horas = mysql_fetch_array($resul_horas))
{
    /*$ht1c=$row_horas['HT1C'];
    $hl1c=$row_horas['HL1C'];
    $ht2c=$row_horas['HT2C'];
    $hl2c=$row_horas['HL2C'];
    $hej1c=$row_horas['HEJ1C'];
    $hej2c=$row_horas['HEJ2C'];
    $ht1ec=$row_horas['HT1EC'];
    $hl1ec=$row_horas['HL1EC'];
    $ht2ec=$row_horas['HT2EC'];
    $hl2ec=$row_horas['HL2EC'];
    $hej1ec=$row_horas['HEJ1EC'];
    $hej2ec=$row_horas['HEJ2EC'];*/
    
    $ht1c=$row_horas['HT1C_totales'];
    $hl1c=$row_horas['HL1C_totales'];
    $ht2c=$row_horas['HT2C_totales'];
    $hl2c=$row_horas['HL2C_totales'];
    $hej1c=$row_horas['HEJ1C_totales'];
    $hej2c=$row_horas['HEJ2C_totales'];
    $ht1ec=$row_horas['HT1EC_totales'];
    $hl1ec=$row_horas['HL1EC_totales'];
    $ht2ec=$row_horas['HT2EC_totales'];
    $hl2ec=$row_horas['HL2EC_totales'];
    $hej1ec=$row_horas['HEJ1EC_totales'];
    $hej2ec=$row_horas['HEJ2EC_totales'];
    $suma_horas=$suma_horas+$ht1c+$hl1c+$ht2c+$hl2c+$hej1c+$hej2c+$ht1ec+$hl1ec+$ht2ec+$hl2ec+$hej1ec+$hej2ec;       
}
$carga_media=round(($suma_horas/$suma_cargas)*100,2);
return $carga_media;
}

/* Añadido por jlmartin para calcular la carga media del Dpto. según Rectorado 03/10/2018 */

function calcular_carga_media_rect($curso)
{
$link=Conectarse();
$sql_cargas = "select * from cargas_max where curso='$curso'";	    
$resul_cargas = mysql_query($sql_cargas, $link);
$suma_cargas=0;
while ($row_cargas = mysql_fetch_array($resul_cargas))
{
    $ni=$row_cargas["nif"];
    $sql_aux="SELECT * FROM cargas_max where nif='$ni' and curso='$curso'";
    $resul_aux=mysql_query($sql_aux,$link);
    $row_aux=mysql_fetch_array($resul_aux);
     if ($row_aux["situacion_academica"]=="ACTIVO")
    {
    $suma_cargas=$suma_cargas+$row_cargas['carga_rectorado'];
    }
}
	
$sql_horas="SELECT
cod_asig,curso,HT1C_totales,HL1C_totales,HT2C_totales,HL2C_totales,
HEJ1C_totales, HEJ2C_totales,HT1EC_totales,HL1EC_totales,HT2EC_totales,
HL2EC_totales,HEJ1EC_totales,HEJ2EC_totales FROM horas_docencia WHERE cod_asig
IN (SELECT codigo FROM asignaturas WHERE (semestre<5 AND codigo_titulacion = 'G37') OR (semestre>4 AND (codigo_titulacion = 'G35' OR codigo_titulacion = 'G37' OR
codigo_titulacion = 'G38' OR codigo_titulacion = 'G39')) OR codigo_titulacion =
'G430' OR codigo_titulacion =
'G59' OR codigo_titulacion = 'G60' OR codigo_titulacion = 'G652'
 OR codigo_titulacion = 'M076'  OR codigo_titulacion = 'M125' OR codigo_titulacion = 'M141 'OR
codigo_titulacion = '00' OR codigo_titulacion = '01' OR 
codigo_titulacion = '02' OR codigo_titulacion = 'M888' OR codigo_titulacion = 'M180' OR codigo_titulacion = 'G591' OR codigo_titulacion = 'M781') AND curso = '$curso'";	

$resul_horas = mysql_query($sql_horas, $link);
$suma_horas=0;
while ($row_horas = mysql_fetch_array($resul_horas))
{
    /*$ht1c=$row_horas['HT1C'];
    $hl1c=$row_horas['HL1C'];
    $ht2c=$row_horas['HT2C'];
    $hl2c=$row_horas['HL2C'];
    $hej1c=$row_horas['HEJ1C'];
    $hej2c=$row_horas['HEJ2C'];
    $ht1ec=$row_horas['HT1EC'];
    $hl1ec=$row_horas['HL1EC'];
    $ht2ec=$row_horas['HT2EC'];
    $hl2ec=$row_horas['HL2EC'];
    $hej1ec=$row_horas['HEJ1EC'];
    $hej2ec=$row_horas['HEJ2EC'];*/
	
	$cod_asig=$row_horas['cod_asig'];
	if (($cod_asig>19)||($cod_asig==13)){
    
		$ht1c=$row_horas['HT1C_totales'];
		$hl1c=$row_horas['HL1C_totales'];
		$ht2c=$row_horas['HT2C_totales'];
		$hl2c=$row_horas['HL2C_totales'];
		$hej1c=$row_horas['HEJ1C_totales'];
		$hej2c=$row_horas['HEJ2C_totales'];
		$ht1ec=$row_horas['HT1EC_totales'];
		$hl1ec=$row_horas['HL1EC_totales'];
		$ht2ec=$row_horas['HT2EC_totales'];
		$hl2ec=$row_horas['HL2EC_totales'];
		$hej1ec=$row_horas['HEJ1EC_totales'];
		$hej2ec=$row_horas['HEJ2EC_totales'];
		$suma_horas=$suma_horas+$ht1c+$hl1c+$ht2c+$hl2c+$hej1c+$hej2c+$ht1ec+$hl1ec+$ht2ec+$hl2ec+$hej1ec+$hej2ec;   
	}
}
$carga_media_rect=round(($suma_horas/$suma_cargas)*100,2);
return $carga_media_rect;
}

/* Fin del añadido por jlmartin para calcular la carga media del Dpto. según Rectorado 03/10/2018 */


function calcular_carga_real($nif,$cargamax,$curso)
{
$link=Conectarse();
//Calculamos carga real


$sql_cod_asig = "select * from profesorado where nif='$nif'";	    
$resul_cod_asig = mysql_query($sql_cod_asig, $link);
$suma=0;
while ($row_cod_asig = mysql_fetch_array($resul_cod_asig))
{
    $cod_asig=$row_cod_asig['codigo_asignatura'];
    $sql_carga_real = "select * from horas_docencia where nif='$nif' and curso='$curso' and cod_asig='$cod_asig'";
    $resul_carga_real = mysql_query($sql_carga_real, $link);
    $row_carga_real = mysql_fetch_array($resul_carga_real);
    /*$ht1c=$row_carga_real['HT1C'];
    $hl1c=$row_carga_real['HL1C'];
    $hej1c=$row_carga_real['HEJ1C'];
    $hej2c=$row_carga_real['HEJ2C'];
    $hl2c=$row_carga_real['HL2C'];
    $ht2c=$row_carga_real['HT2C'];
    $ht1ec=$row_carga_real['HT1EC'];
    $hl1ec=$row_carga_real['HL1EC'];
    $hej1ec=$row_carga_real['HEJ1EC'];
    $hej2ec=$row_carga_real['HEJ2EC'];
    $hl2ec=$row_carga_real['HL2EC'];
    $ht2ec=$row_carga_real['HT2EC'];*/
    
    $ht1c=$row_carga_real['HT1C_totales'];
    $hl1c=$row_carga_real['HL1C_totales'];
    $hej1c=$row_carga_real['HEJ1C_totales'];
    $hej2c=$row_carga_real['HEJ2C_totales'];
    $hl2c=$row_carga_real['HL2C_totales'];
    $ht2c=$row_carga_real['HT2C_totales'];
    $ht1ec=$row_carga_real['HT1EC_totales'];
    $hl1ec=$row_carga_real['HL1EC_totales'];
    $hej1ec=$row_carga_real['HEJ1EC_totales'];
    $hej2ec=$row_carga_real['HEJ2EC_totales'];
    $hl2ec=$row_carga_real['HL2EC_totales'];
    $ht2ec=$row_carga_real['HT2EC_totales'];
    
    $suma=$suma+$ht1c+$hl1c+$ht2c+$hl2c+$hej1c+$hej2c+$ht1ec+$hl1ec+$ht2ec+$hl2ec+$hej1ec+$hej2ec;
       
}
$carga_real=round(($suma/$cargamax)*100,2);

 return $carga_real;
}


/* Añadido por jlmartin para calcular la carga según Rectorado 02/10/2018 */

function calcular_carga_rect($nif,$cargarectorado,$curso)
{
$link=Conectarse();
//Calculamos carga según los datos del rectorado


$sql_cod_asig = "select * from profesorado where nif='$nif'";	    
$resul_cod_asig = mysql_query($sql_cod_asig, $link);
$suma=0;
while ($row_cod_asig = mysql_fetch_array($resul_cod_asig))
{
    $cod_asig=$row_cod_asig['codigo_asignatura'];
	if (($cod_asig>19)||($cod_asig==13)){
		$sql_carga_rect = "select * from horas_docencia where nif='$nif' and curso='$curso' and cod_asig='$cod_asig'";
		$resul_carga_rect = mysql_query($sql_carga_rect, $link);
		$row_carga_rect = mysql_fetch_array($resul_carga_rect);
		/*$ht1c=$row_carga_real['HT1C'];
		$hl1c=$row_carga_real['HL1C'];
		$hej1c=$row_carga_real['HEJ1C'];
		$hej2c=$row_carga_real['HEJ2C'];
		$hl2c=$row_carga_real['HL2C'];
		$ht2c=$row_carga_real['HT2C'];
		$ht1ec=$row_carga_real['HT1EC'];
		$hl1ec=$row_carga_real['HL1EC'];
		$hej1ec=$row_carga_real['HEJ1EC'];
		$hej2ec=$row_carga_real['HEJ2EC'];
		$hl2ec=$row_carga_real['HL2EC'];
		$ht2ec=$row_carga_real['HT2EC'];*/

		$ht1c=$row_carga_rect['HT1C_totales'];
		$hl1c=$row_carga_rect['HL1C_totales'];
		$hej1c=$row_carga_rect['HEJ1C_totales'];
		$hej2c=$row_carga_rect['HEJ2C_totales'];
		$hl2c=$row_carga_rect['HL2C_totales'];
		$ht2c=$row_carga_rect['HT2C_totales'];
		$ht1ec=$row_carga_rect['HT1EC_totales'];
		$hl1ec=$row_carga_rect['HL1EC_totales'];
		$hej1ec=$row_carga_rect['HEJ1EC_totales'];
		$hej2ec=$row_carga_rect['HEJ2EC_totales'];
		$hl2ec=$row_carga_rect['HL2EC_totales'];
		$ht2ec=$row_carga_rect['HT2EC_totales'];

		$suma=$suma+$ht1c+$hl1c+$ht2c+$hl2c+$hej1c+$hej2c+$ht1ec+$hl1ec+$ht2ec+$hl2ec+$hej1ec+$hej2ec;
	}
       
}
$carga_rect=round(($suma/$cargarectorado)*100,2);

 return $carga_rect;
}

/* Fin del añadido por jlmartin para calcular la carga según Rectorado 02/10/2018 */


function generar_desplegable_cargo($resul_cargo,$cargo_defecto)
{
    $numero_elementos=mysql_num_rows($resul_cargo);

    echo "<select name='cargo' size='1'>";
    echo "<option value='$cargo_defecto' selected='selected'>".$cargo_defecto."</option>";
   
    for($i=0;$i<$numero_elementos;$i++)
    {
	 $row= mysql_fetch_array($resul_cargo);
         ?><option value="<?echo $row['cargo']?>"><?echo  $row['cargo']?></option>
	 <?	   
     }	
     echo "</select>";
}



function generar_desplegable_prof($resul_profesores,$curso,$curso_ant,$nivel,$user)
{
	$numero_elementos=mysql_num_rows($resul_profesores);

	$nif_prof=$_POST['profesor'];
	   
	if ($nif_prof!='' && $nif_prof!='nada') {
	    $link=Conectarse();
	    $sql_prof = "select * from personal where nif='$nif_prof'";
	    $resul_prof = mysql_query($sql_prof, $link);
	    $row_prof = mysql_fetch_array($resul_prof);
	    $sql_carga_max = "select * from cargas_max where nif='$nif_prof'and curso='$curso'";
	    $resul_carga_max = mysql_query($sql_carga_max, $link);
	    if($row_carga_max = mysql_fetch_array($resul_carga_max))            
		$carga_max=$row_carga_max['cargamax_total'];
            else
	    {
		$sql_carga_max = "select * from cargas_max where nif='$nif_prof'and curso='$curso'";
		$resul_carga_max = mysql_query($sql_carga_max, $link);
		if($row_carga_max = mysql_fetch_array($resul_carga_max))            
		    {$carga_max=$row_carga_max['cargamax_total'];
			 

/* Añadido jmartin para gestionar la horas bajo umbral NO HACE FALTA AQUÍ 2/10/2018*/  
			 
		    $horasbajoumbral=$row_carga_max['horas_bajo_umbral'];
			$horasbajoumbralmax=$row_carga_max['horas_bajo_umbral_max'];}
		else
		    $carga_max='NULL';
	    }
	    $cargareal=calcular_carga_real($nif_prof,$carga_max,$curso);
	    ?>
	    <select name="profesor" size="1">
	    <option value='<?echo $nif?>' selected='selected' ><?echo  $row_prof['apellidos'].", ".$row_prof['nombre']." (C: ".$cargareal.")"?></option>	
	    <?
	       
	}	
	else 
	{
	    echo "<select name='profesor' size='1'>";
	    echo "<option value='nada' selected='selected' >Seleccione un nombre</option>";
	}
	    
	$link=Conectarse();
	$sql_profesores= "select * from personal where cargo!='PAS' order by apellidos";	    
	$resul_profesores = mysql_query($sql_profesores, $link);
	
	for($i=0;$i<$numero_elementos;$i++)
	{
        $row_profesores=mysql_fetch_array($resul_profesores); 

        $carga_max=$row_profesores['carga_maxima'];
        $nif=$row_profesores['nif'];

        $sql_carga_max = "select * from cargas_max where nif='$nif'and curso='$curso' order by id desc";	    
        $resul_carga_max = mysql_query($sql_carga_max, $link);
        if ($row_carga_max = mysql_fetch_array($resul_carga_max))
            $cargamax=$row_carga_max['cargamax_total'];
        else
            $cargamax='0';
        $situacion_academica=$row_carga_max['situacion_academica'];

        $cargareal=calcular_carga_real($nif,$cargamax,$curso);

        if (acceso_nivel($nivel,$user)){
            ?><option value="<?echo $nif?>"><?echo  $row_profesores['apellidos'].", ". $row_profesores['nombre']." (C: ".$cargareal.")"?></option>
            <?
        }
        else{
            if ($situacion_academica=='ACTIVO'){            
                ?><option value="<?echo $nif?>"><?echo  $row_profesores['apellidos'].", ". $row_profesores['nombre']." (C: ".$cargareal.")"?></option>
                <?
            }
        }   
	}	
	?>
	</select>
	<?
}

function generar_desplegable_asig($resul_asig,$asig,$curso)
{
	
	$numero_elementos=mysql_num_rows($resul_asig);
	?>

	<select name="<?echo $asig?>" size="1">
	
	<?
	 
	$link=Conectarse();
//        $sql_asig = "select * from asignaturas order by codigo_titulacion";	    
        $sql_asig = "select * from asignaturas order by abreviatura";	    
	$resul_asig = mysql_query($sql_asig, $link);

	
	echo "<option value='nada' selected='selected'>Seleccione una asignatura</option>";
	for($i=0;$i<$numero_elementos;$i++)
	{
	    $row_asig=mysql_fetch_array($resul_asig); 
	    $abreviatura=$row_asig['abreviatura'];
	    $cod_asig=$row_asig['codigo'];
	    $nombre_asig=$row['nombre'];

	    $sql_horas_asig = "select * from horas_asignatura where cod_asig='$cod_asig' and curso='$curso'";
	    $resul_horas_asig = mysql_query($sql_horas_asig, $link);
	    $row_horas_asig = mysql_fetch_array($resul_horas_asig);
	    $ht1c=$row_horas_asig['ht1c_totales'];
	    $hl1c=$row_horas_asig['hl1c_totales'];
	    $ht2c=$row_horas_asig['ht2c_totales'];
	    $hl2c=$row_horas_asig['hl2c_totales'];
	    $hej1c=$row_horas_asig['hej1c_totales'];  //corregido bug, cambiado con el 2c
	    $hej2c=$row_horas_asig['hej2c_totales'];  //corregido bug, cambiado con el 1c
	    $ht1ec=$row_horas_asig['ht1ec_totales'];
	    $hl1ec=$row_horas_asig['hl1ec_totales'];
	    $ht2ec=$row_horas_asig['ht2ec_totales'];
	    $hl2ec=$row_horas_asig['hl2ec_totales'];
	    $hej1ec=$row_horas_asig['hej1ec_totales']; //corregido bug, cambiado con el 2ec
	    $hej2ec=$row_horas_asig['hej2ec_totales']; //corregido bug, cambiado con el 1ec

            $sumaht1c=0;
	    $sumahl1c=0;
	    $sumaht2c=0;
	    $sumahl2c=0;
	    $sumahej1c=0;
	    $sumahej2c=0;
            $sumaht1ec=0;
	    $sumahl1ec=0;
	    $sumaht2ec=0;
	    $sumahl2ec=0;
	    $sumahej1ec=0;
	    $sumahej2ec=0;
	    $sql_horas = "select * from horas_docencia where cod_asig='$cod_asig' and curso='$curso'";    
	    $resul_horas = mysql_query($sql_horas, $link);
	    while ($row_horas = mysql_fetch_array($resul_horas))
	    {
		$sumaht1c=$sumaht1c+$row_horas['HT1C_totales'];
		$sumahl1c=$sumahl1c+$row_horas['HL1C_totales'];
		$sumaht2c=$sumaht2c+$row_horas['HT2C_totales'];
		$sumahl2c=$sumahl2c+$row_horas['HL2C_totales'];
		$sumahej1c=$sumaht2c+$row_horas['HEJ1C_totales'];
		$sumahej2c=$sumahl2c+$row_horas['HEJ2C_totales'];
		$sumaht1ec=$sumaht1ec+$row_horas['HT1EC_totales'];
		$sumahl1ec=$sumahl1ec+$row_horas['HL1EC_totales'];
		$sumaht2ec=$sumaht2ec+$row_horas['HT2EC_totales'];
		$sumahl2ec=$sumahl2ec+$row_horas['HL2EC_totales'];
		$sumahej1ec=$sumaht2ec+$row_horas['HEJ1EC_totales'];
		$sumahej2ec=$sumahl2ec+$row_horas['HEJ2EC_totales'];
	    }
	   

	    $lt1c=round(($ht1c+$ht1ec-$sumaht1c-$sumaht1ec)*100)/100;
	    $ll1c=round(($hl1c+$hl1ec-$sumahl1c-$sumahl1ec)*100)/100;				
	    $lt2c=round(($ht2c+$ht2ec-$sumaht2c-$sumaht2ec)*100)/100;
	    $ll2c=round(($hl2c+$hl2ec-$sumahl2c-$sumahl2ec)*100)/100;
	    $lej1c=round(($hej1c+$hej1ec-$sumahej1c-$sumahej1ec)*100)/100;
	    $lej2c=round(($hej2c+$hej2ec-$sumahej2c-$sumahej2ec)*100)/100;
	   
	    $cod_titulacion=$row_asig['codigo_titulacion'];
	    $sql_titulacion = "select * from carreras where codigo='$cod_titulacion'";	    
	    $resul_titulacion = mysql_query($sql_titulacion, $link);
	    $row_titulacion = mysql_fetch_array($resul_titulacion);
	    $iniciales_tit=$row_titulacion['iniciales'];
	    ?><option value="<?echo $cod_asig?>"><?echo  $abreviatura."/". $iniciales_tit." (T1C:".$lt1c." L1C:".$ll1c." T2C:".$lt2c." L2C:".$ll2c." EJ1C:".$lej1c." EJ2C:".$lej2c.")"?></option>
        <?	   
	}	
	?>
	</select>
	<?
}



$link=Conectarse();
//$sql_profesores= "select * from personal where cargo!='PAS' and cargo!='CD' order by apellidos";	    
$sql_profesores= "select * from personal WHERE cargo !='PAS' order by apellidos";	    
$resul_profesores = mysql_query($sql_profesores, $link);

?>

<div align="center">
<p><font color="#0066CC" face="Arial"><strong>SELECCIONAR PROFESOR <? echo "curso: "; echo $curso_recibido; ?></strong></font></p>
<form name='form1' method='post' action='index.php' enctype='multipart/form-data' >
<table width="96%" height="80" border="0" bordercolor="#FFFFCC">
<tr> 
<td colspan="4" align="center"><input type="hidden" name="profesor"><font size="2" face="Arial" color="#0073B4"><b>Profesor: &nbsp;</b></font><? generar_desplegable_prof($resul_profesores,$curso_recibido,$curso_recibido_ant,$nivel,$user); ?></td>
</tr>
<input type="hidden" name="curso" value='<?echo $curso_recibido?>'>
<tr>
<?if (acceso_nivel($nivel,$user))
   echo "<td align='center' colspan='2'><input type='submit' name='Submit' value='EDITAR'></td>";
else
   echo "<td align='center' colspan='2'><input type='submit' name='Submit' value='VER'></td>";
?>
</tr>
</table>
</form></div> 

<br><hr></hr><br>

<div align="center">
<p><font color="#0066CC" face="Arial"><strong>REPARTO CARGA DOCENTE <?echo "curso: "; echo $curso_recibido?></strong></font></p></div>

<?

$nif_prof=$_POST['profesor'];
//echo $nif_prof;

if($nif_prof!='' && $nif_prof!='nada'){
    $link = Conectarse();
    if ($nif_prof!='') {

	$sql_prof = "select * from personal where nif='$nif_prof' order by nombre";
	$resul_prof = mysql_query($sql_prof, $link);
	$row_prof = mysql_fetch_array($resul_prof);
	$iniciales=$row_prof['iniciales'];
	if (($user==$row_prof[usuario])||(acceso_nivel($nivel,$user))){
//echo $user;
//echo $row_prof[usuario];

	    echo"<form name='form1' method='post' action='insdocencia.php' enctype='multipart/form-data' > \n";
	    echo "<table width='100%' height='80' border='0' bordercolor='#FFFFCC' align='center'>";
	    echo "<tr><td width='10%'></td>";
            echo "<input type='hidden' name='id' value='".$row_prof['id']."'>";
	    echo "<td align='left' width='6%'><font><strong>Apellidos:</strong></font></td><td align='left' width='14%'>".$row_prof['apellidos']."</td>";
	    echo "<td align='left' width='6%'><font><strong>Nombre:</strong></font></td><td align='left' width='14%'>".$row_prof['nombre']."</td>";
	    echo "<td align='left' width='6%'><font><strong>Iniciales:</strong></font></td><td align='left' width='14%'>".$row_prof['iniciales']."</td>";
	    $sql_carga_max = "select * from cargas_max where nif='$nif_prof' and curso='$curso_recibido'";	    
	    $resul_carga_max = mysql_query($sql_carga_max, $link);
	    if ($row_carga_max = mysql_fetch_array($resul_carga_max))
	    echo "<td align='left 'width='6%'><font><strong>Situaci&oacute;n Academica:</strong></font></td>";
	    
	    if (acceso_nivel($nivel,$user))
	    {
	    echo"<td align='left' width='14%'>";
	    echo"<select size='1' name='situacion_academica'>\n";
            echo "<option value='".$row_carga_max["situacion_academica"]."' selected>".$row_carga_max["situacion_academica"]."</option>\n";
            echo"<option value='ACTIVO'>ACTIVO</option>";
	    echo"<option value='SABATICO'>SABATICO</option>";
	    echo"<option value='BAJA'>BAJA</option>";
	    echo"<option value='EXCEDENCIA'>EXCEDENCIA</option></select></td></tr>";
	    }else
		{
		echo"<td align='left' width='14%'>".$row_carga_max["situacion_academica"]."</td></tr>";
		}

	    echo "<tr><td width='10%'></td>";
	    echo "<td align='left' width='6%'><font><strong>Domicilio:</strong></font></td><td align='left' width='14%'>".$row_prof['domicilio']."</td>";
	    echo "<td align='left' width='6%'><font><strong>Tlf:</strong></font></td><td align='left' width='14%'>".$row_prof['telefono_particular']."</td>";
	    $sql_cargo = "select * from personal_cargos order by cargo";
	    $resul_cargo = mysql_query($sql_cargo, $link);

	   echo" <td align='left' width='6%'><font><strong>Cargo:</strong></font></td><td align='left' width='14%'>".$row_prof['cargo']."</td>";	    


	    echo "<td align='left'width='6%'><font><strong>Departamento:</strong></font></td><td align='left' width='14%'>".$row_prof['departamento']."</td>";

	    echo "<tr><td width='6%'></td>";
	    echo "<td align='left' width='6%'><font><strong>NIF:</strong></font></td><td align='left' width='14%'>".$row_prof['nif']."</td>";
	    echo "<td align='left' width='6%'><font><strong>Tlf Univ:</strong></font></td><td align='left' width='14%'>".$row_prof['telefono_universidad']."</td>";
	    echo "<td align='left' width='6%'><font><strong>Despacho:</strong></font></td><td align='left' width='14%'>".$row_prof['despacho']."</td>";
	    echo "<td align='left'width='6%'><font><strong>Email:</strong></font></td><td align='left' width='14%'>".$row_prof['email']."</td>";

		
/* Modificación jlmartin para gestionar la carga del rectorado 2/10/2018*/
		
		echo "<tr><td width='10%'></td>";		
		$cargarectorado=$row_carga_max['carga_rectorado'];	
		if (acceso_nivel($nivel,$user))
			{
				echo "<td align='left' width='6%'><font><strong>Carga Rectorado:</strong></font></td><td align='left' width='14%'><textarea name='cargarectorado' cols='4' rows='1'>".$cargarectorado."</textarea></td>";

			}
			else{
				echo "<td align='left' width='6%'><font><strong>Carga Rectorado:</strong></font></td><td align='left' width='14%'>".$cargarectorado."</td>";
			}
				
		/*echo "<td align='left'
	    width='6%'><font><strong>Cod. Plaza:</strong></font></td><td
	    align='left' width='14%'>".$row_prof['codigo_plaza']."</td>";*/
		
/* Fin de la modificación jlmartin para gestionar la carga del rectorado 2/10/2018*/		

	    $sql_carga_max = "select * from cargas_max where nif='$nif_prof' and curso='$curso_recibido'";	    
	    $resul_carga_max = mysql_query($sql_carga_max, $link);
	    if ($row_carga_max = mysql_fetch_array($resul_carga_max))
	       {
		$cargamax=$row_carga_max['cargamax_total'];
			
/* Añadido jlmartin para gestionar la horas bajo umbral 2/10/2018*/	
			
        $horasbajoumbral=$row_carga_max['horas_bajo_umbral'];
		$horasbajoumbralmax=$row_carga_max['horas_bajo_umbral_max'];
		
/* Fin del añadido jlmartin para gestionar la horas bajo umbral 2/10/2018*/				
			
		//$cargamax_total=round($cargamax*15,2);
		}   
            else
		{
		$sql_carga_max = "select * from cargas_max where nif='$nif_prof' and curso='$curso_recibido_ant'";	    
		$resul_carga_max = mysql_query($sql_carga_max, $link);
		if ($row_carga_max = mysql_fetch_array($resul_carga_max)){
		    $cargamax=$row_carga_max['cargamax_total'];
		    //$cargamax_total=round($cargamax*15,2);//carga maxima total anual
		}else
			{
			$cargamax='NULL';
			}
		}
	    


	    if (acceso_nivel($nivel,$user))
	    {
			echo "<td align='left' width='6%'><font><strong>Carga M&aacute;x.:</strong></font></td>";echo"<td align='left' width='14%'><textarea name='cargamax' cols='4' rows='1'>".$cargamax."</textarea></td>";
	    }
	    else
	    {
			echo "<td align='left' width='6%'><font><strong>Carga M&aacute;x.:</strong></font></td>";echo"<td align='left' width='14%'>".$cargamax."</td>";
	    }

/* Modificación jlmartin para gestionar la horas bajo umbral 2/10/2018*/
		
		if (acceso_nivel($nivel,$user))
	    {
	    	echo "<td align='left' width='6%'><font><strong>H.Bajo Umbral:</strong></font></td><td align='left' width='14%'><textarea name='horasbajoumbral' cols='4' rows='1'>".$horasbajoumbral."</textarea></td>";
			
		}
		else{
 			echo "<td align='left' width='6%'><font><strong>H.Bajo Umbral:</strong></font></td><td align='left' width='14%'>".$horasbajoumbral."</td>";
		}
		
		
		if (acceso_nivel($nivel,$user))
	    {
	    	echo "<td align='left' width='6%'><font><strong>H.Bajo Umbral Max:</strong></font></td><td align='left' width='14%'><textarea name='horasbajoumbralmax' cols='4' rows='1'>".$horasbajoumbralmax."</textarea></td>";
			
		}
		else{
 			echo "<td align='left' width='6%'><font><strong>H.Bajo Umbral Max:</strong></font></td><td align='left' width='14%'>".$horasbajoumbralmax."</td>";
		}
		
/*	    echo "<td align='left'width='6%'><font><strong>F. Alta Universidad:</strong></font></td><td align='left' width='14%'>".$row_prof['falta_univ']."</td>"; */
		
/* Fin modificación jlmartin para gestionar la horas bajo umbral 2/10/2018*/

		
/* Añadido de jlmartin para calcular el % de carga según Rectorado 02/10/2018*/
		
		/*
	    $carga_media=calcular_carga_media($curso_recibido);
            
	    echo "<tr><td width='10%'></td>";
	    echo "<td align='left' width='6%'><font><strong>Carga media Dpto.:</strong></font></td><td align='left' width='14%'>".$carga_media."%</td>";
		*/

		
		$cargarect=calcular_carga_rect($nif_prof,$cargarectorado,$curso_recibido);
		echo "<tr><td width='10%'></td>";
	    echo "<td align='left' width='6%'><font><strong>Carga Rectorado:</strong></font></td><td align='left' width='14%'>".$cargarect."%</td>";
		
/* Fin del ñadido de jlmartin para calcular el % de carga según Rectorado 02/10/2018*/		

	    $cargareal=calcular_carga_real($nif_prof,$cargamax,$curso_recibido);
	    echo "<td align='left' width='6%'><font><strong>Carga Actual:</strong></font></td><td align='left' width='14%'>".$cargareal."%</td>";

	    $sql_carga_max2 = "select * from cargas_max where nif='$nif_prof' and curso='$curso_recibido_ant'";	    
	    $resul_carga_max2 = mysql_query($sql_carga_max2, $link);
	    if ($row_carga_max2 = mysql_fetch_array($resul_carga_max2))
		    $cargamax2=$row_carga_max2['cargamax_total'];

	    $cargaant=calcular_carga_real($nif_prof,$cargamax2,$curso_recibido_ant);
            $cargaant_total=round($cargaant,2);//carga total anual curso anterior
	    /*if($cargaant==0){
		$sql_profesores= "select * from personal where nif='$nif_prof'";	    
		$resul_profesores = mysql_query($sql_profesores, $link);
		$row_profesores=mysql_fetch_array($resul_profesores); 
		$cargaant=$row_profesores['carga_real'];
	    }*/
	    echo "<td align='left' width='6%'><font><strong>Carga 1 Curso Antes:</strong></font></td><td align='left' width='14%'>".$cargaant."%</td>";

		$sql_carga_max3 = "select * from cargas_max where nif='$nif_prof' and curso='$curso_recibido_2ant'";	    
		$resul_carga_max3 = mysql_query($sql_carga_max3, $link);
		if ($row_carga_max3 = mysql_fetch_array($resul_carga_max3))
		    $cargamax3=$row_carga_max3['cargamax_total'];
	    $carga2ant=calcular_carga_real($nif_prof,$cargamax3,$curso_recibido_2ant);
            $carga2ant_total=round($carga2ant,2);//carga total anual 2 cursos anteriores
	    /*if($carga2ant==0){
		$sql_profesores= "select * from personal where nif='$nif_prof'";	    
		$resul_profesores = mysql_query($sql_profesores, $link);
		$row_profesores=mysql_fetch_array($resul_profesores); 
		$carga2ant=$row_profesores['carga_anterior'];
	    }*/
	    echo "<td align='left'width='6%'><font><strong>Carga 2 Cursos Antes:</strong></font></td><td align='left' width='14%'>".$carga2ant."%</td><td width='10%'></td></tr>";
	    
		
		echo "<tr><td width='10%'></td>";
	   	echo "<td align='left' width='6%'></td><td align='left' width='14%'></td>";
		
		$carga_media=calcular_carga_media($curso_recibido);
		echo "<td align='left' width='6%'><font><strong>Carga media Dpto.:</strong></font></td><td align='left' width='14%'>".$carga_media."%</td>";

	   	$carga_media_rect=calcular_carga_media_rect($curso_recibido);
		echo "<td align='left' width='6%'><font><strong>Carga media Rect.:</strong></font></td><td align='left' width='14%'>".$carga_media_rect."%</td>";	    

	    echo "<td align='left' width='6%'></td><td align='left' width='14%'></td></tr>";
		
		echo "</table>";

	}
	if (acceso_nivel($nivel,$user)){
    if ($row_carga_max['situacion_academica']!='ACTIVO')
    {
	echo '<p align="center"><font color="red" face="Arial"><strong>AVISO: ESTE PROFESOR NO EST&Aacute; EN ACTIVO ESTE CURSO ACAD&Eacute;MICO, NO SE LE DEBE ASIGNAR DOCENCIA</strong></font></p></div>';
    }
	}
    }

 
?>
    <table width="95%" height="80" border="0" bordercolor="#FFFFCC" align='center'>
    
    <tr>
    <td colspan='7'>&nbsp;</td>															     
    </tr>

    <tr>
    <td colspan='7' align='center'>
	 <table width="75%" border="0" bordercolor="#FFFFCC" align='center'>
	 <? 
 	  echo "<tr><td align='center'><font size='2' face='Arial' color='#0073B4'><b> Abreviatura</b></font></td>";
 	  echo "<td align='center'><font size='2' face='Arial' color='#0073B4'><b>Iniciales</b></font></td><td></td>";
 	  echo "<td align='center' ><font size='2' face='Arial' color='#0073B4'>";echo"<a title='Horas totales de teoria primer cuatrimestre'href='#'><b>HT1C</b></a></font></td>";
 	  echo "<td align='center' ><font size='2' face='Arial' color='#0073B4'>";echo"<a title='Horas totales de laboratorio primer cuatrimestre'href='#'><b>HL1C</b></a></font></td>";
	  echo "<td align='center' ><font size='2' face='Arial' color='#0073B4'>";echo"<a title='Horas totales de ejercicios primer cuatrimestre'href='#'><b>HEJ1C</b></a></font></td>";
 	  echo "<td align='center' ><font size='2' face='Arial' color='#0073B4'>";echo"<a title='Horas totales de teoria segundo cuatrimestre'href='#'><b>HT2C</b></a></font></td>";
 	 echo "<td align='center' ><font size='2' face='Arial' color='#0073B4'>";echo"<a title='Horas totales de laboratorio segundo cuatrimestre'href='#'><b>HL2C</b></a></font></td>";
	 echo "<td align='center' ><font size='2' face='Arial' color='#0073B4'>";echo"<a title='Horas totales de ejercicios segundo cuatrimestre'href='#'><b>HEJ2C</b></a></font></td>";
	  

 	  $sql_cod_asig = "select * from profesorado JOIN asignaturas on profesorado.codigo_asignatura=asignaturas.codigo JOIN carreras ON asignaturas.codigo_titulacion=carreras.codigo WHERE nif='$nif_prof' ORDER BY carreras.nombre,asignaturas.nombre";	    


	  $resul_cod_asig = mysql_query($sql_cod_asig, $link);
	  $b=1;
	  //////////// PRUEBA DE LA I ////////////////
	  $i=0;
	  while($row_cod_asig = mysql_fetch_array($resul_cod_asig))
	  {
	      $nomostrar='0';
	      $cod_asig=$row_cod_asig['codigo_asignatura'];
	      $cod_asiganterior[$b]=$cod_asig;
	    
	      $b=$b+1;
	        $ht1c='0';
		$hl1c='0';
		$ht2c='0';
		$hl2c='0';
		$hej1c='0';
		$hej2c='0';
	        $ht1ec='0';
		$hl1ec='0';
		$ht2ec='0';
		$hl2ec='0';
		$hej1ec='0';
		$hej2ec='0';

		$ht1c_asig='0';
		$hl1c_asig='0';
		$ht2c_asig='0';
		$hl2c_asig='0';
		$hej1c_asig='0';
		$hej2c_asig='0';
		$ht1ec_asig='0';
		$hl1ec_asig='0';
		$ht2ec_asig='0';
		$hl2ec_asig='0';
		$hej1ec_asig='0';
		$hej2ec_asig='0';

/*		if ($b==1)
		{
		    $cod_asiganterior=$cod_asig;
		    $b=0;
		}*/
		$w=$b-1;
		for ($ww=1;$ww<$w;$ww++)
		{
		    if ($cod_asig==$cod_asiganterior[$ww])
		    {
			$nomostrar='1';
		    }
		}
		//	if ($cod_asiganterior!=$cod_asig)
		if ($nomostrar=='0')
		{
     
		$sql_asig = "select * from asignaturas where codigo='$cod_asig'";	    
		$resul_asig = mysql_query($sql_asig, $link);
		$row_asig = mysql_fetch_array($resul_asig);
	        $abreviatura=$row_asig['abreviatura'];
		$nombre_asig=$row_asig['nombre'];
		$cod_titulacion=$row_asig['codigo_titulacion'];
		$sql_titulacion = "select * from carreras where codigo='$cod_titulacion'";	    
		$resul_titulacion = mysql_query($sql_titulacion, $link);
		$row_titulacion = mysql_fetch_array($resul_titulacion);
		$iniciales_tit=$row_titulacion['iniciales'];
 

		$sql_profesorado = "select * from profesorado where codigo_asignatura='$cod_asig' AND nif='$nif_prof'";	    
		$resul_profesorado = mysql_query($sql_profesorado, $link);
		$row_profesorado = mysql_fetch_array($resul_profesorado);
		$id_profesorado=$row_profesorado['id'];

	       	$sql_horas_asig = "select * from horas_asignatura where cod_asig='$cod_asig' and curso='$curso_recibido'";	    
		$resul_horas_asig = mysql_query($sql_horas_asig, $link);
		if($row_horas_asig = mysql_fetch_array($resul_horas_asig)){
		    $ht1c_asig=$row_horas_asig['ht1c_totales'];
		    $hl1c_asig=$row_horas_asig['hl1c_totales'];
		    $ht2c_asig=$row_horas_asig['ht2c_totales'];
		    $hl2c_asig=$row_horas_asig['hl2c_totales'];
		    $hej1c_asig=$row_horas_asig['hej1c_totales'];
		    $hej2c_asig=$row_horas_asig['hej2c_totales'];
		    $ht1ec_asig=$row_horas_asig['ht1ec_totales'];
		    $hl1ec_asig=$row_horas_asig['hl1ec_totales'];
		    $ht2ec_asig=$row_horas_asig['ht2ec_totales'];
		    $hl2ec_asig=$row_horas_asig['hl2ec_totales'];
		    $hej1ec_asig=$row_horas_asig['hej1ec_totales'];
		    $hej2ec_asig=$row_horas_asig['hej2ec_totales']; //corregido bug, antes se tomaba hej2c_totales de la BBDD
		}

		$sql_horas_prof = "select * from horas_docencia where nif='$nif_prof' and cod_asig='$cod_asig' and curso='$curso_recibido'";	    
		$resul_horas_prof = mysql_query($sql_horas_prof, $link);
		if($row_horas_prof = mysql_fetch_array($resul_horas_prof)){
		    /*  
		    $ht1c=$row_horas_prof['HT1C'];
		    $hl1c=$row_horas_prof['HL1C'];
		    $ht2c=$row_horas_prof['HT2C'];
		    $hl2c=$row_horas_prof['HL2C'];
		    $hej1c=$row_horas_prof['HEJ1C'];
		    $hej2c=$row_horas_prof['HEJ2C'];
		    $ht1ec=$row_horas_prof['HT1EC'];
		    $hl1ec=$row_horas_prof['HL1EC'];
		    $ht2ec=$row_horas_prof['HT2EC'];
		    $hl2ec=$row_horas_prof['HL2EC'];
		    $hej1ec=$row_horas_prof['HEJ1EC'];
		    $hej2ec=$row_horas_prof['HEJ2EC'];
		    */
                    $ht1c=$row_horas_prof['HT1C_totales'];
		    $hl1c=$row_horas_prof['HL1C_totales'];
		    $ht2c=$row_horas_prof['HT2C_totales'];
		    $hl2c=$row_horas_prof['HL2C_totales'];
		    $hej1c=$row_horas_prof['HEJ1C_totales'];
		    $hej2c=$row_horas_prof['HEJ2C_totales'];
		    $ht1ec=$row_horas_prof['HT1EC_totales'];
		    $hl1ec=$row_horas_prof['HL1EC_totales'];
		    $ht2ec=$row_horas_prof['HT2EC_totales'];
		    $hl2ec=$row_horas_prof['HL2EC_totales'];
		    $hej1ec=$row_horas_prof['HEJ1EC_totales'];
		    $hej2ec=$row_horas_prof['HEJ2EC_totales'];
		     
                    

		}

		$sumaht1c=0;
		$sumahl1c=0;
		$sumaht2c=0;
		$sumahl2c=0;
		$sumahej1c=0;
		$sumahej2c=0;
		$sumaht1ec=0;
		$sumahl1ec=0;
		$sumaht2ec=0;
		$sumahl2ec=0;
		$sumahej1ec=0;
		$sumahej2ec=0;

		$sql_horas = "select * from horas_docencia where cod_asig='$cod_asig' and curso='$curso_recibido'";    
		$resul_horas = mysql_query($sql_horas, $link);
		while ($row_horas = mysql_fetch_array($resul_horas))
		{
		    /*$sumaht1c=$sumaht1c+$row_horas['HT1C'];
		    $sumahl1c=$sumahl1c+$row_horas['HL1C'];
		    $sumaht2c=$sumaht2c+$row_horas['HT2C'];
		    $sumahl2c=$sumahl2c+$row_horas['HL2C'];
		    $sumahej12c=$sumahej1c+$row_horas['HEJ1C'];
		    $sumahej2c=$sumahej2c+$row_horas['HEJ2C'];
		    $sumaht1ec=$sumaht1ec+$row_horas['HT1EC'];
		    $sumahl1ec=$sumahl1ec+$row_horas['HL1EC'];
		    $sumaht2ec=$sumaht2ec+$row_horas['HT2EC'];
		    $sumahl2ec=$sumahl2ec+$row_horas['HL2EC'];
		    $sumahej12ec=$sumahej1ec+$row_horas['HEJ1EC'];
		    $sumahej2ec=$sumahej2ec+$row_horas['HEJ2EC'];
		    */
                      $sumaht1c=$sumaht1c+$row_horas['HT1C_totales'];
		    $sumahl1c=$sumahl1c+$row_horas['HL1C_totales'];
		    $sumaht2c=$sumaht2c+$row_horas['HT2C_totales'];
		    $sumahl2c=$sumahl2c+$row_horas['HL2C_totales'];
		    $sumahej1c=$sumahej1c+$row_horas['HEJ1C_totales'];
		    $sumahej2c=$sumahej2c+$row_horas['HEJ2C_totales'];
		    $sumaht1ec=$sumaht1ec+$row_horas['HT1EC_totales'];
		    $sumahl1ec=$sumahl1ec+$row_horas['HL1EC_totales'];
		    $sumaht2ec=$sumaht2ec+$row_horas['HT2EC_totales'];
		    $sumahl2ec=$sumahl2ec+$row_horas['HL2EC_totales'];
		    $sumahej1ec=$sumahej1ec+$row_horas['HEJ1EC_totales'];
		    $sumahej2ec=$sumahej2ec+$row_horas['HEJ2EC_totales'];
		    
		    
                    
		}
	   
		$lt1c=round(($ht1c_asig+$ht1ec_asig-$sumaht1c-$sumaht1ec)*100)/100;
		$ll1c=round(($hl1c_asig+$hl1ec_asig-$sumahl1c-$sumahl1ec)*100)/100;				
		$lt2c=round(($ht2c_asig+$ht2ec_asig-$sumaht2c-$sumaht2ec)*100)/100;
		$ll2c=round(($hl2c_asig+$hl2ec_asig-$sumahl2c-$sumahl2ec)*100)/100;
		$lej1c=round(($hej1c_asig+$hej1ec_asig-$sumahej1c-$sumahej1ec)*100)/100;
		$lej2c=round(($hej2c_asig+$hej2ec_asig-$sumahej2c-$sumahej2ec)*100)/100;
		
		if ($ht1c!='0' || $ht2c!='0' || $hl1c!='0' || $hl2c!='0' || $hej1c!='0' || $hej2c!='0' || $ht1ec!='0' || $ht2ec!='0' || $hl1ec!='0' || $hl2ec!='0' || $hej1ec!='0' || $hej2ec!='0' )
		{
		echo "<tr align='center'><td  width='70%' class='celdagris'><font class='fuenteblanco'><strong>".$cod_asig."-".$nombre_asig."/".$iniciales_tit."</strong></font></td>";
                if (acceso_nivel($nivel,$user))
                {
		    echo "<input type='hidden' name='cod_asig".$i."' value='".$cod_asig."'>";
		    echo "<td width='70%' class='celdagris'><font class='fuenteblanco'>".$iniciales."<b></b></font></td>";
    		     	  echo "<td align='center'><font size='2' face='Arial' color='#0073B4'><b>ESP</b></font></td>";
		    echo "<td><input type='text' maxlength='5' size='4' value='".$ht1c."' name='ht1c".$i."'></td>";
		    echo "<td><input type='text' maxlength='5' size='4' value='".$hl1c."' name='hl1c".$i."'></td>";
		    echo "<td><input type='text' maxlength='5' size='4' value='".$hej1c."' name='hej1c".$i."'></td>";
		    echo "<td><input type='text' maxlength='5' size='4' value='".$ht2c."' name='ht2c".$i."'></td>";
		    echo "<td><input type='text' maxlength='5' size='4' value='".$hl2c."' name='hl2c".$i."'></td>";
		    
		    echo "<td><input type='text' maxlength='5' size='4' value='".$hej2c."' name='hej2c".$i."'></td></tr><tr>";
		    echo "<td width='70%' class='celdagris'><font class='fuenteblanco'><b> (T1C:".$lt1c." L1C:".$ll1c." T2C:".$lt2c." L2C:".$ll2c." EJ1C:".$lej1c." EJ2C:".$lej2c.")</b></font></td>";
		    echo "<td width='70%' class='celdagris'><font class='fuenteblanco'><b></b></font></td>";

		    echo "<td align='center'><font size='2' face='Arial' color='#0073B4'><b>ENG</b></font></td>";
		    echo "<td><input type='text' maxlength='5' size='4' value='".$ht1ec."' name='ht1ec".$i."'></td>";
		    echo "<td><input type='text' maxlength='5' size='4' value='".$hl1ec."' name='hl1ec".$i."'></td>";
		    echo "<td><input type='text' maxlength='5' size='4' value='".$hej1ec."' name='hej1ec".$i."'></td>";
		    echo "<td><input type='text' maxlength='5' size='4' value='".$ht2ec."' name='ht2ec".$i."'></td>";
		    echo "<td><input type='text' maxlength='5' size='4' value='".$hl2ec."' name='hl2ec".$i."'></td>";
		    
		    echo "<td><input type='text' maxlength='5' size='4' value='".$hej2ec."' name='hej2ec".$i."'></td>";

		    
		    echo"<td align='right'><a  href='./deleteprofesor.php?id=".$id_profesorado."&asig=".$cod_asig."&curso=".$curso_recibido."' class='generalbluebold'>Borrar</a></td></tr>";
		}
		else
		{
		    echo "<td width='70%' class='celdagris'><font class='fuenteblanco'>".$iniciales."<b></b></font></td>";
 		     	  echo "<td align='center'><font size='2' face='Arial' color='#0073B4'><b>ESP</b></font></td>";
		    echo "<td><font>".$ht1c."</font></td>";
		    echo "<td><font>".$hl1c."</font></td>";
		    echo "<td><font>".$hej1c."</font></td>";
		    echo "<td><font>".$ht2c."</font></td>";
		    echo "<td><font>".$hl2c."</font></td>";
		    echo "<td><font>".$hej2c."</font></td>";
		    echo "</tr><tr><td width='70%' class='celdagris'><font class='fuenteblanco'><b></b></font></td><td width='70%' class='celdagris'></td>";
    		     	  echo "<td align='center'><font size='2' face='Arial' color='#0073B4'><b>ENG</b></font></td>";
		    echo "<td align='center'><font>".$ht1ec."</font></td>";
		    echo "<td align='center'><font>".$hl1ec."</font></td>";
		    echo "<td align='center'><font>".$hej1ec."</font></td>";
		    echo "<td align='center'><font>".$ht2ec."</font></td>";
		    echo "<td align='center'><font>".$hl2ec."</font></td>";
		    echo "<td align='center'><font>".$hej2ec."</font></td>";
		}
			}
		$i++;
		}
	  }
	  echo "<input type='hidden' name='indice' value='".$i."'>";
	  ?>
	  </table>
    </td>
    </tr>

    <tr>
    <td colspan='7'>&nbsp;</td>															     
    </tr>
       
    <?if (acceso_nivel($nivel,$user)){?>
    <tr> 
    <td align='center'><font size="2" face="Arial" color="#0073B4"><b>A&ntilde;adir Asignaturas</b></font></td>
    <td align='center'><font size="2" face="Arial" color="#0073B4"></td>
    <td align='center'><font size='2' face='Arial' color='#0073B4'><b>HT1C</b></font></td>
    <td align='center'><font size='2' face='Arial' color='#0073B4'><b>HL1C</b></font></td>
    <td align='center'><font size='2' face='Arial' color='#0073B4'><b>HEJ1C</b></font></td>
										   <td align='center'><font size='2' face='Arial' color='#0073B4'><b>HT2C</b></font></td>
    <td align='center'><font size='2' face='Arial' color='#0073B4'><b>HL2C</b></font></td>
										    <td align='center'><font size='2' face='Arial' color='#0073B4'><b>HEJ2C</b></font></td>

    </tr>
	
    <?
    $sql_asig = "select * from asignaturas order by codigo_titulacion";	    
    $resul_asig = mysql_query($sql_asig, $link);
    ?>
    <tr>
    <td align='center'><input type="hidden" name="asig1"><? generar_desplegable_asig($resul_asig,'asig1',$curso_recibido); ?></td>
    <td align='center'><font size='2' face='Arial' color='#0073B4'><b>ESP</b></font></td>
    <td><input type='text' maxlength='5' size='4' value='0' name='ht1cprof1'></td>
    <td><input type='text' maxlength='5' size='4' value='0' name='hl1cprof1'></td>
    <td><input type='text' maxlength='5' size='4' value='0' name='ht2cprof1'></td>
    <td><input type='text' maxlength='5' size='4' value='0' name='hl2cprof1'></td>
										    <td><input type='text' maxlength='5' size='4' value='0' name='hej1cprof1'></td>
    <td><input type='text' maxlength='5' size='4' value='0' name='hej2cprof1'></td>
    </tr><tr><td></td><td align='center'><font size='2' face='Arial' color='#0073B4'><b>ENG</b></font></td>
    <td><input type='text' maxlength='5' size='4' value='0' name='ht1cprofe1'></td>
    <td><input type='text' maxlength='5' size='4' value='0' name='hl1cprofe1'></td>
    <td><input type='text' maxlength='5' size='4' value='0' name='ht2cprofe1'></td>
    <td><input type='text' maxlength='5' size='4' value='0' name='hl2cprofe1'></td>
										    <td><input type='text' maxlength='5' size='4' value='0' name='hej1cprofe1'></td>
    <td><input type='text' maxlength='5' size='4' value='0' name='hej2cprofe1'></td>		
				   

    </tr>

    <?
    $sql_asig = "select * from asignaturas order by codigo_titulacion";	    
    $resul_asig = mysql_query($sql_asig, $link);			       
    ?>
    <tr>

    <td align='center'><input type="hidden" name="asig2"><? generar_desplegable_asig($resul_asig,'asig2',$curso_recibido); ?></td>
    <td align='center'><font size='2' face='Arial' color='#0073B4'><b>ESP</b></font></td>
    <td><input type='text' maxlength='5' size='4' value='0' name='ht1cprof2'></td>
    <td><input type='text' maxlength='5' size='4' value='0' name='hl1cprof2'></td>
    <td><input type='text' maxlength='5' size='4' value='0' name='ht2cprof2'></td>
    <td><input type='text' maxlength='5' size='4' value='0' name='hl2cprof2'></td>
										    <td><input type='text' maxlength='5' size='4' value='0' name='hej1cprof2'></td>
    <td><input type='text' maxlength='5' size='4' value='0' name='hej2cprof2'></td>						   
    </tr><tr><td></td><td align='center'><font size='2' face='Arial' color='#0073B4'><b>ENG</b></font></td>
    <td><input type='text' maxlength='5' size='4' value='0' name='ht1cprofe2'></td>
    <td><input type='text' maxlength='5' size='4' value='0' name='hl1cprofe2'></td>
    <td><input type='text' maxlength='5' size='4' value='0' name='ht2cprofe2'></td>
    <td><input type='text' maxlength='5' size='4' value='0' name='hl2cprofe2'></td>
										    <td><input type='text' maxlength='5' size='4' value='0' name='hej1cprofe2'></td>
    <td><input type='text' maxlength='5' size='4' value='0' name='hej2cprofe2'></td>						   


    </tr>

     <?
    $sql_asig = "select * from asignaturas order by codigo_titulacion";	    
    $resul_asig = mysql_query($sql_asig, $link);
    ?>
    <tr>

    <td align='center'><input type="hidden" name="asig3"><? generar_desplegable_asig($resul_asig,'asig3',$curso_recibido); ?></td>
    <td align='center'><font size='2' face='Arial' color='#0073B4'><b>ESP</b></font></td>
    <td><input type='text' maxlength='5' size='4' value='0' name='ht1cprof3'></td>
    <td><input type='text' maxlength='5' size='4' value='0' name='hl1cprof3'></td>
    <td><input type='text' maxlength='5' size='4' value='0' name='ht2cprof3'></td>
    <td><input type='text' maxlength='5' size='4' value='0' name='hl2cprof3'></td>
    <td><input type='text' maxlength='5' size='4' value='0' name='hej1cprof3'></td>
    <td><input type='text' maxlength='5' size='4' value='0' name='hej2cprof3'></td>
    </tr><tr><td></td><td align='center'><font size='2' face='Arial' color='#0073B4'><b>ENG</b></font></td>	
    <td><input type='text' maxlength='5' size='4' value='0' name='ht1cprofe3'></td>
    <td><input type='text' maxlength='5' size='4' value='0' name='hl1cprofe3'></td>
    <td><input type='text' maxlength='5' size='4' value='0' name='ht2cprofe3'></td>
    <td><input type='text' maxlength='5' size='4' value='0' name='hl2cprofe3'></td>
    <td><input type='text' maxlength='5' size='4' value='0' name='hej1cprofe3'></td>
    <td><input type='text' maxlength='5' size='4' value='0' name='hej2cprofe3'></td>																   

    </tr>

     <?
    $sql_asig = "select * from asignaturas order by codigo_titulacion";	    
    $resul_asig = mysql_query($sql_asig, $link);
    ?>
    <tr>
														  
    <td align='center'><input type="hidden" name="asig4"><? generar_desplegable_asig($resul_asig,'asig4',$curso_recibido); ?></td>
    <td align='center'><font size='2' face='Arial' color='#0073B4'><b>ESP</b></font></td>
    <td><input type='text' maxlength='5' size='4' value='0' name='ht1cprof4'></td>
    <td><input type='text' maxlength='5' size='4' value='0' name='hl1cprof4'></td>
    <td><input type='text' maxlength='5' size='4' value='0' name='ht2cprof4'></td>
    <td><input type='text' maxlength='5' size='4' value='0' name='hl2cprof4'></td>
    <td><input type='text' maxlength='5' size='4' value='0' name='hej1cprof4'></td>
    <td><input type='text' maxlength='5' size='4' value='0' name='hej2cprof4'></td>
    </tr><tr><td></td><td align='center'><font size='2' face='Arial' color='#0073B4'><b>ENG</b></font></td>
    <td><input type='text' maxlength='5' size='4' value='0' name='ht1cprofe4'></td>
    <td><input type='text' maxlength='5' size='4' value='0' name='hl1cprofe4'></td>
    <td><input type='text' maxlength='5' size='4' value='0' name='ht2cprofe4'></td>
    <td><input type='text' maxlength='5' size='4' value='0' name='hl2cprofe4'></td>
    <td><input type='text' maxlength='5' size='4' value='0' name='hej1cprofe4'></td>
    <td><input type='text' maxlength='5' size='4' value='0' name='hej2cprofe4'></td>																   
    </tr>

    <tr>
    <td colspan='7'>&nbsp;</td>															     
    </tr>															     
    <input type='hidden' name='nif' value='<? echo $nif_prof?>'>        
    <input type='hidden' name='curso' value='<? echo $curso_recibido?>'>        
    <tr>																	  
    <td  colspan='7' align='center'><input type="submit" name="Submit" value="GUARDAR"></td>
    </tr>              	   
    <?}?>
    <tr>
    <td colspan='7'>&nbsp;</td>															     
    </tr>
  
    <tr>
    <td colspan='7'>&nbsp;</td>															     
    </tr>
    
    </table>


<?}
else{
    if( $nif_prof!='')
    {
    echo"<table>";
 	  echo "<tr><td align='center'><font size='2' face='Arial' color='#0073B4'><b> Abreviatura</b></font></td>";
 	  echo "<td align='center'><font size='2' face='Arial' color='#0073B4'><b>ASIGNATURA</b></font></td><td></td>";
 	  echo "<td align='center'><font size='2' face='Arial' color='#0073B4'><b>HT1C</b></font></td>";
 	  echo "<td align='center'><font size='2' face='Arial' color='#0073B4'><b>HL1C</b></font></td>";
 	  echo "<td align='center'><font size='2' face='Arial' color='#0073B4'><b>HT2C</b></font></td>";
 	  echo "<td align='center'><font size='2' face='Arial' color='#0073B4'><b>HL2C</b></font></td>";
          echo "<td align='center'><font size='2' face='Arial' color='#0073B4'><b>HEJ1C</b></font></td>";
	  echo "<td align='center'><font size='2' face='Arial' color='#0073B4'><b>HEJ2C</b></font></td></tr>";

  $sql1 = "SELECT * FROM personal ORDER BY apellidos";
  $result1 = mysql_query($sql1, $link);
  while ($row1=mysql_fetch_array($result1))
  {
      $nif_profesor=$row1['nif'];
      $iniciales=$row1['iniciales'];
      $sql_cod_asig = "select * from profesorado JOIN asignaturas on profesorado.codigo_asignatura=asignaturas.codigo JOIN carreras ON asignaturas.codigo_titulacion=carreras.codigo WHERE nif='$nif_profesor' ORDER BY carreras.nombre,asignaturas.nombre";
      $result_cod_asig=mysql_query($sql_cod_asig,$link);
  while ($row_cod_asig=mysql_fetch_array($result_cod_asig))
  {
      	        $ht1c='0';
		$hl1c='0';
		$ht2c='0';
		$hl2c='0';
		$hej1c='0';
		$hej2c='0';
      	        $ht1ec='0';
		$hl1ec='0';
		$ht2ec='0';
		$hl2ec='0';
		$hej1ec='0';
		$hej2ec='0';
		$ht1c_asig='0';
		$hl1c_asig='0';
		$ht2c_asig='0';
		$hl2c_asig='0';
		$hej1c_asig='0';
		$hej2c_asig='0';
		$ht1ec_asig='0';
		$hl1ec_asig='0';
		$ht2ec_asig='0';
		$hl2ec_asig='0';
		$hej1ec_asig='0';
		$hej2ec_asig='0';
	        $cod_asig=$row_cod_asig['codigo_asignatura'];
		$sql_asig = "select * from asignaturas where codigo='$cod_asig'";
		$resul_asig = mysql_query($sql_asig, $link);
		$row_asig = mysql_fetch_array($resul_asig);
	        $nombre_asig=$row_asig['nombre'];
		$cod_titulacion=$row_asig['codigo_titulacion'];
		$sql_titulacion = "select * from carreras where codigo='$cod_titulacion'";	    
		$resul_titulacion = mysql_query($sql_titulacion, $link);
		$row_titulacion = mysql_fetch_array($resul_titulacion);
		$iniciales_tit=$row_titulacion['iniciales'];

		$sql_profesorado = "select * from profesorado where codigo_asignatura='$cod_asig' AND nif='$nif_prof'";	    
		$resul_profesorado = mysql_query($sql_profesorado, $link);
		$row_profesorado = mysql_fetch_array($resul_profesorado);
		$id_profesorado=$row_profesorado['id'];
		$sql_horas_asig = "select * from horas_asignatura where cod_asig='$cod_asig' and curso='$curso_recibido'";	    
		$resul_horas_asig = mysql_query($sql_horas_asig, $link);
		if($row_horas_asig = mysql_fetch_array($resul_horas_asig)){
		    $ht1c_asig=$row_horas_asig['ht1c_totales'];
		    $hl1c_asig=$row_horas_asig['hl1c_totales'];
		    $ht2c_asig=$row_horas_asig['ht2c_totales'];
		    $hl2c_asig=$row_horas_asig['hl2c_totales'];
		    $hej1c_asig=$row_horas_asig['hej1c_totales'];
		    $hej2c_asig=$row_horas_asig['hej2c_totales'];
		    $ht1ec_asig=$row_horas_asig['ht1ec_totales'];
		    $hl1ec_asig=$row_horas_asig['hl1ec_totales'];
		    $ht2ec_asig=$row_horas_asig['ht2ec_totales'];
		    $hl2ec_asig=$row_horas_asig['hl2ec_totales'];
		    $hej1ec_asig=$row_horas_asig['hej1ec_totales'];
		    $hej2ec_asig=$row_horas_asig['hej2ec_totales'];
		}

		$sql_horas_prof = "select * from horas_docencia where nif='$nif_profesor' and cod_asig='$cod_asig' and curso='$curso_recibido'";	    
		$resul_horas_prof = mysql_query($sql_horas_prof, $link);
		if($row_horas_prof = mysql_fetch_array($resul_horas_prof)){
		    /*$ht1c=$row_horas_prof['HT1C'];
		    $hl1c=$row_horas_prof['HL1C'];
		    $ht2c=$row_horas_prof['HT2C'];
		    $hl2c=$row_horas_prof['HL2C'];
		    $ht2c=$row_horas_prof['HEJ1C'];
		    $hl2c=$row_horas_prof['HEJ2C'];
		    $ht1ec=$row_horas_prof['HT1EC'];
		    $hl1ec=$row_horas_prof['HL1EC'];
		    $ht2ec=$row_horas_prof['HT2EC'];
		    $hl2ec=$row_horas_prof['HL2EC'];
		    $ht2ec=$row_horas_prof['HEJ1EC'];
		    $hl2ec=$row_horas_prof['HEJ2EC'];*/
                    
                    $ht1c=$row_horas_prof['HT1C_totales'];
		    $hl1c=$row_horas_prof['HL1C_totales'];
		    $ht2c=$row_horas_prof['HT2C_totales'];
		    $hl2c=$row_horas_prof['HL2C_totales'];
		    $hej1c=$row_horas_prof['HEJ1C_totales'];
		    $hej2c=$row_horas_prof['HEJ2C_totales'];
		    $ht1ec=$row_horas_prof['HT1EC_totales'];
		    $hl1ec=$row_horas_prof['HL1EC_totales'];
		    $ht2ec=$row_horas_prof['HT2EC_totales'];
		    $hl2ec=$row_horas_prof['HL2EC_totales'];
		    $hej1ec=$row_horas_prof['HEJ1EC_totales'];
		    $hej2ec=$row_horas_prof['HEJ2EC_totales'];
		    
		}
		$sumaht1c=0;
		$sumahl1c=0;
		$sumaht2c=0;
		$sumahl2c=0;
		$sumahej1c=0;
		$sumahej2c=0;
		$sumaht1ec=0;
		$sumahl1ec=0;
		$sumaht2ec=0;
		$sumahl2ec=0;
		$sumahej1ec=0;
		$sumahej2ec=0;
		$sql_horas = "select * from horas_docencia where cod_asig='$cod_asig' and curso='$curso_recibido'";    
		$resul_horas = mysql_query($sql_horas, $link);
		while ($row_horas = mysql_fetch_array($resul_horas))
		{
		    /* 
		    $sumaht1c=$sumaht1c+$row_horas['HT1C'];
		    $sumahl1c=$sumahl1c+$row_horas['HL1C'];
		    $sumaht2c=$sumaht2c+$row_horas['HT2C'];
		    $sumahl2c=$sumahl2c+$row_horas['HL2C'];
		    $sumahej1c=$sumahej2c+$row_horas['HEJ1C'];
		    $sumahej2c=$sumahej1c+$row_horas['HEJ2C'];
		    $sumaht1ec=$sumaht1ec+$row_horas['HT1EC'];
		    $sumahl1ec=$sumahl1ec+$row_horas['HL1EC'];
		    $sumaht2ec=$sumaht2ec+$row_horas['HT2EC'];
		    $sumahl2ec=$sumahl2ec+$row_horas['HL2EC'];
		    $sumahej1ec=$sumahej2ec+$row_horas['HEJ1EC'];
		    $sumahej2ec=$sumahej1ec+$row_horas['HEJ2EC'];
                    */
                    $sumaht1c=$sumaht1c+$row_horas['HT1C_totales'];
		    $sumahl1c=$sumahl1c+$row_horas['HL1C_totales'];
		    $sumaht2c=$sumaht2c+$row_horas['HT2C_totales'];
		    $sumahl2c=$sumahl2c+$row_horas['HL2C_totales'];
		    $sumahej1c=$sumahej2c+$row_horas['HEJ1C_totales'];
		    $sumahej2c=$sumahej1c+$row_horas['HEJ2C_totales'];
		    $sumaht1ec=$sumaht1ec+$row_horas['HT1EC_totales'];
		    $sumahl1ec=$sumahl1ec+$row_horas['HL1EC_totales'];
		    $sumaht2ec=$sumaht2ec+$row_horas['HT2EC_totales'];
		    $sumahl2ec=$sumahl2ec+$row_horas['HL2EC_totales'];
		    $sumahej1ec=$sumahej1ec+$row_horas['HEJ1EC_totales'];
		    $sumahej2ec=$sumahej2ec+$row_horas['HEJ2EC_totales']; 
		    
		}
	   
		$lt1c=round(($ht1c_asig+$ht1ec_asig-$sumaht1c-$sumaht1ec)*100)/100;
		$ll1c=round(($hl1c_asig+$hl1ec_asig-$sumahl1c-$sumahl1ec)*100)/100;				
		$lt2c=round(($ht2c_asig+$ht2ec_asig-$sumaht2c-$sumaht2ec)*100)/100;
		$ll2c=round(($hl2c_asig+$hl2ec_asig-$sumahl2c-$sumahl2ec)*100)/100;
		$lej1c=round(($hej1c_asig+$hej1ec_asig-$sumahej1c-$sumahej1ec)*100)/100;
		$lej2c=round(($hej2c_asig+$hej2ec_asig-$sumahej2c-$sumahej2ec)*100)/100;
  
echo "<tr align='center'><td  width='20%' class='celdagris'><font class='fuenteblanco'><strong>".$iniciales."</td>"."<td width='70%' class='celdagris'>"."<font class='fuenteblanco'>"."<strong>".$nombre_asig."/".$iniciales_tit."</td></strong></font><td><font size='2' face='Arial' color='#0073B4'>ESP</font></td><td>".$ht1c."</td><td>".$hl1c."</td><td>".$ht2c."</td><td>".$hl2c."</td><td>".$hej1c."</td><td>".$hej2c."</td></tr><td class='celdagris'></td><td class='celdagris'><font class='fuenteblanco'> (T1C:".$lt1c." L1C:".$ll1c." T2C:".$lt2c." L2C:".$ll2c." EJ1C:".$lej1c." EJ2C:".$lej2c.")</td><td><font size='2' face='Arial' color='#0073B4'>ENG</font></td><td align='center'>".$ht1ec."</td><td align='center'>".$hl1ec."</td><td align='center'>".$ht2ec."</td><td align='center'>".$hl2ec."</td><td align='center'>".$hej1ec."</td><td align='center'>".$hej2ec."</td></tr>";
  }
  }
  
}
    else
    {
	$profesor='nada';
    }

}
echo "</table>";

?>

<div align="right"><a href="generarcsv.php?id=<?=$row_prof['id']?>&anio=<?=$curso_recibido?>" class="generalbluebold"><< Generar CSV</a> </div>
<div align="right"><a href="../index.php?valor2=<?echo $curso_recibido?>" class="generalbluebold"><< Volver</a> </div>


<?php
abajo();
?>
