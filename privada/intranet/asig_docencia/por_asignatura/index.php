<?php
require_once("../../../core/bibliotecaint.inc.php");
include("../../../core/conexion.inc.php"); //Conexión con la base de datos
arriba("", "asig_docencia", "es", "Asignaci&oacute;n de Docencia");
session_start();

//$numero_semanas=32;
$user=$_SESSION['user'];


$nivel='asignacion_docencia';
?>

<script>
var valor;
var valor2;


function GuardarCurso(value) {
    valor2=value;
}

function Redireccion(value) {
// Obtenemos el valor de la opcion que se eligio
    valor = value;//document.form1.titulacion.value;
// Y enviamos el navegador a una URL compuesta por el mismo archivo PHP que estemos viendo y una variable con el valor recien obtenido
    location.href = "./index.php?valor=" + valor +"&valor2="+ valor2;
}
</script>

<?php
if (isset($_POST['valor2']))
{ 
   $numero_semanas=15; 
   $curso = $_POST['valor2'];   
}
else
{
   $numero_semanas=15; 
   $curso=$_GET['valor2'];
}

function calcular_carga_media($curso,$numero_semanas)
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
IN (SELECT codigo FROM asignaturas WHERE (codigo_titulacion = 'G35' OR codigo_titulacion = 'G37' OR
codigo_titulacion = 'G38' OR codigo_titulacion = 'G39' OR codigo_titulacion =
'G430' OR codigo_titulacion =
'G59' OR codigo_titulacion = 'G60' OR codigo_titulacion = 'G652'
 OR codigo_titulacion = 'M076'  OR codigo_titulacion = 'M125' OR codigo_titulacion = 'M141 'OR
codigo_titulacion = '00' OR codigo_titulacion = '01' OR 
codigo_titulacion = '02' OR codigo_titulacion = 'M888' OR codigo_titulacion = 'M180')
) AND curso = '$curso'";

$resul_horas = mysql_query($sql_horas, $link);
$suma_horas=0;
while ($row_horas = mysql_fetch_array($resul_horas))
{
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
$carga_media=round((($suma_horas/$suma_cargas)*100),2);
return $carga_media;
//return $suma_cargas;
//return $suma_horas;
}

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
    $ht1c=$row_carga_real['HT1C_totales'];
    $hl1c=$row_carga_real['HL1C_totales'];
    $ht2c=$row_carga_real['HT2C_totales'];
    $hl2c=$row_carga_real['HL2C_totales'];
    $hej1c=$row_carga_real['HEJ1C_totales'];
    $hej2c=$row_carga_real['HEJ2C_totales'];
    $ht1ec=$row_carga_real['HT1EC_totales'];
    $hl1ec=$row_carga_real['HL1EC_totales'];
    $ht2ec=$row_carga_real['HT2EC_totales'];
    $hl2ec=$row_carga_real['HL2EC_totales'];
    $hej1ec=$row_carga_real['HEJ1EC_totales'];
    $hej2ec=$row_carga_real['HEJ2EC_totales'];
    $suma=$suma+$ht1c+$hl1c+$ht2c+$hl2c+$hej1c+$hej2c+$ht1ec+$hl1ec+$ht2ec+$hl2ec+$hej1ec+$hej2ec;
       
}
$carga_real=round(((($suma/$cargamax))*100),2);
 return $carga_real;
}
function calcular_carga_media_estimada($nif,$curso,$asignatura,$titulacion,$numero_semanas)
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
 $suma_cargas=round($suma_cargas,2);
// $sql_horas= "SELECT DISTINCT cod_asig,curso,ht1c,ht2c,hl1c,hl2c,hej1c,hej2c FROM horas_asignatura WHERE curso='$curso'";
$sql_horas="SELECT DISTINCT cod_asig, ht1c_totales, hl1c_totales, ht2c_totales, hl2c_totales, hej1c_totales, hej2c_totales, ht1ec_totales, hl1ec_totales, ht2ec_totales, hl2ec_totales, hej1ec_totales, hej2ec_totales FROM horas_asignatura WHERE cod_asig IN (
SELECT codigo FROM asignaturas WHERE (codigo_titulacion = 'G37' OR codigo_titulacion =
'G430' OR codigo_titulacion =
'G59' OR codigo_titulacion = 'G60' OR codigo_titulacion = 'G652'
 OR codigo_titulacion = 'M076'  OR codigo_titulacion = 'M125' OR codigo_titulacion = 'M141 'OR
codigo_titulacion = '00' OR codigo_titulacion = '01' OR 
codigo_titulacion = '02' OR codigo_titulacion = 'M888' OR codigo_titulacion = 'M180' )
)
AND curso = '$curso'";

// $sql_horas= "SELECT DISTINCT cod_asig,* FROM horas_asignatura WHERE curso='$curso'";
// $sql_horas="SELECT * FROM horas_asignatura WHERE cod_asig IN SELECT DISTINCT cod_asig WHERE curso='$curso'";
//$sql_horas = "select distinct cod_asig * from horas_asignatura where curso='$curso'";
$resul_horas = mysql_query($sql_horas, $link);
$suma_horas=0;
while ($row_horas = mysql_fetch_array($resul_horas))
{
    $ht1c=$row_horas['ht1c_totales'];
    $hl1c=$row_horas['hl1c_totales'];
    $ht2c=$row_horas['ht2c_totales'];
    $hl2c=$row_horas['hl2c_totales'];
    $hej1c=$row_horas['hej1c_totales'];
    $hej2c=$row_horas['hej2c_totales'];
    $ht1ec=$row_horas['ht1ec_totales'];
    $hl1ec=$row_horas['hl1ec_totales'];
    $ht2ec=$row_horas['ht2ec_totales'];
    $hl2ec=$row_horas['hl2ec_totales'];
    $hej1ec=$row_horas['hej1ec_totales'];
    $hej2ec=$row_horas['hej2ec_totales'];
    $suma_horas=$suma_horas+$ht1c+$hl1c+$ht2c+$hl2c+$hej1c+$hej2c+$ht1ec+$hl1ec+$ht2ec+$hl2ec+$hej1ec+$hej2ec;       
}
$carga_media=round((($suma_horas/$suma_cargas))*100,2);
//return $suma_cargas;
//return $suma_horas;
return $carga_media;

/*$link=Conectarse();
$sql_cod_asig = "select * from personal where puesto!='PAS'";
$resul_cod_asig = mysql_query($sql_cod_asig, $link);
while ($row_cod_asig = mysql_fetch_array($resul_cod_asig))
 {
     $numprofes=$numprofes+1;
 }
 $suma=0;
 
$sql_carga_real = "select * from horas_docencia where curso='$curso'";
$resul_carga_real = mysql_query($sql_carga_real, $link);
while ($row_carga_estimada = mysql_fetch_array($resul_carga_real))
{
    
    //$row_carga_real = mysql_fetch_array($resul_carga_real);
    $ht1c=$row_carga_estimada['HT1C'];
    $hl1c=$row_carga_estimada['HL1C'];
    $ht2c=$row_carga_estimada['HT2C'];
    $hl2c=$row_carga_estimada['HL2C'];
    $suma=$suma+$ht1c+$hl1c+$ht2c+$hl2c;

}
return (round(($suma/$numprofes)*100,2));*/
    
}

function generar_desplegable_titulacion($resul_carreras)
{
        $link=Conectarse();
	$numero_elementos=mysql_num_rows($resul_carreras);
	$row=mysql_fetch_array($resul_carreras);

	if(isset($_GET['valor']))
	{
	    $titulacion=$_GET['valor'];
	    $sqlcarrerasel = "select * from carreras where codigo='$titulacion'";
		
	    $resulcarrerasel = mysql_query($sqlcarrerasel, $link);
	    $rowcarrerasel = mysql_fetch_array($resulcarrerasel);
	    echo "<select name='titulacion' size='1' onchange='Redireccion(this.value);'>";	
	    echo "<option value='$titulacion' selected='selected'>".$rowcarrerasel['nombre']."</option>";    
	}
	else
	{
	    $titulacion=$_POST['titulacion'];
	    if ($titulacion!='' && $titulacion!='nada') {
		$sqlcarrerasel = "select * from carreras where codigo='$titulacion'";
		
		$resulcarrerasel = mysql_query($sqlcarrerasel, $link);
		$rowcarrerasel = mysql_fetch_array($resulcarrerasel);
		echo "<select name='titulacion' size='1' onchange='Redireccion(this.value);'>";	
		echo "<option value='$titulacion' selected='selected'>".$rowcarrerasel['nombre']."</option>";    
	    }
	    else
	    {
              ?>
              <select name="titulacion" size="1" onchange="Redireccion(this.value);">
	      <option value="nada" >Seleccione una titulaci&oacute;n</option> 
   	      <?php		    
	    }
	}
	for($i=0;$i<$numero_elementos;$i++)
	{
	   ?><option value="<?php echo $row['codigo']?>"><?php echo $row['nombre']?></option>
	   <?php
	   $row=mysql_fetch_array($resul_carreras);
	}	
	?>
	</select>
	<?php
}

function generar_desplegable_asignatura($resul_asignatura,$curso)
{
        $link=Conectarse();
	$numero_elementos=mysql_num_rows($resul_asignatura);
	$row=mysql_fetch_array($resul_asignatura);

	if(!isset($_GET['valor']))
	{
	    $titulacion=$_POST['titulacion'];
	    if ($titulacion!='nada'&& $titulacion!='') {
		$sqlcarrerasel = "select * from carreras where codigo='$titulacion'";
		$resulcarrerasel = mysql_query($sqlcarrerasel, $link);

		$asignatura=$_POST['asignatura'];
		$titulacion=$_POST['titulacion'];
		if ($asignatura!='' && $asignatura!='nada') {  
		    $sqlasignaturasel = "select * from asignaturas where codigo='$asignatura' order by nombre";
		    $resulasignaturasel = mysql_query($sqlasignaturasel, $link);
		    $rowasignaturasel = mysql_fetch_array($resulasignaturasel);

		    $sql_horas_asig = "select * from horas_asignatura where cod_asig='$asignatura' and curso='$curso'";
		    $resul_horas_asig = mysql_query($sql_horas_asig, $link);
		    $row_horas_asig = mysql_fetch_array($resul_horas_asig);
		    $ht1c=$row_horas_asig['ht1c_totales'];
		    $hl1c=$row_horas_asig['hl1c_totales'];
		    $ht2c=$row_horas_asig['ht2c_totales'];
		    $hl2c=$row_horas_asig['hl2c_totales'];
                    $hej1c=$row_horas_asig['hej1c_totales'];
		    $hej2c=$row_horas_asig['hej2c_totales'];
		    $ht1ec=$row_horas_asig['ht1ec_totales'];
		    $hl1ec=$row_horas_asig['hl1ec_totales'];
		    $ht2ec=$row_horas_asig['ht2ec_totales'];
		    $hl2ec=$row_horas_asig['hl2ec_totales'];
                    $hej1ec=$row_horas_asig['hej1ec_totales'];
		    $hej2ec=$row_horas_asig['hej2ec_totales'];

		    $sumaht1c=0;
		    $sumahl1c=0;
		    $sumaht2c=0;
		    $sumahl2c=0;
		    $sumahej1c=0;
		    $sumahej2c=0; 
		    $sql_horas = "select * from horas_docencia where cod_asig='$asignatura' and curso='$curso'";    
		    $resul_horas = mysql_query($sql_horas, $link);
		    while ($row_horas = mysql_fetch_array($resul_horas))
		    {
			$sumaht1c=$sumaht1c+$row_horas['HT1C_totales']+$row_horas['HT1EC_totales'];
			$sumahl1c=$sumahl1c+$row_horas['HL1C_totales']+$row_horas['HL1EC_totales'];
			$sumaht2c=$sumaht2c+$row_horas['HT2C_totales']+$row_horas['HT2EC_totales'];
			$sumahl2c=$sumahl2c+$row_horas['HL2C_totales']+$row_horas['HL2EC_totales'];
			$sumahej1c=$sumahej1c+$row_horas['HEJ1C_totales']+$row_horas['HEJ1EC_totales'];
			$sumahej2c=$sumahej2c+$row_horas['HEJ2C_totales']+$row_horas['HEJ2EC_totales'];
		    }
		    
		    $lt1c=round(((($ht1ec+$ht1c-$sumaht1c))*100))/100;
 		    $ll1c=round(((($hl1ec+$hl1c-$sumahl1c))*100))/100;
		    $lt2c=round(((($ht2ec+$ht2c-$sumaht2c))*100))/100;
		    $ll2c=round(((($hl2ec+$hl2c-$sumahl2c))*100))/100;
		    $lej1c=round(((($hej1ec+$hej1c-$sumahej1c))*100))/100;
		    $lej2c=round(((($hej2ec+$hej2c-$sumahej2c))*100))/100;

		    echo "<select name='asignatura' size='1'>";	
		    echo "<option value='$asignatura' selected='selected'>".$rowasignaturasel['nombre']." Codigo: ".$rowasignaturasel['codigo']." (T1C:".$lt1c." L1C:".$ll1c." T2C:".$lt2c." L2C:".$ll2c." EJ1C: ".$lej1c." EJ2C: ".$lej2c.")</option>";    
		}
		else{
                     ?>
	             <select name="asignatura" size="1">
	             <option value="nada" selected="selected">Seleccione una asignatura</option>
		      <?php
		}
	    }
	} 
	else{
	     ?>
	     <select name="asignatura" size="1">
	     <option value="nada" selected="selected">Seleccione una asignatura</option> 
	     <?php
         }
	
	for($i=0;$i<$numero_elementos;$i++)
	{
	    $cod_asig=$row['codigo'];

	    $sql_horas_asig = "select * from horas_asignatura where cod_asig='$cod_asig' and curso='$curso'";
	    $resul_horas_asig = mysql_query($sql_horas_asig, $link);
	    $row_horas_asig = mysql_fetch_array($resul_horas_asig);
	    $ht1c=$row_horas_asig['ht1c_totales'];
	    $hl1c=$row_horas_asig['hl1c_totales'];
	    $ht2c=$row_horas_asig['ht2c_totales'];
	    $hl2c=$row_horas_asig['hl2c_totales'];
	    $hej1c=$row_horas_asig['hej1c_totales'];
	    $hej2c=$row_horas_asig['hej2c_totales'];

            $sumaht1c=0;
	    $sumahl1c=0;
	    $sumaht2c=0;
	    $sumahl2c=0;
	    $sumahej1c=0;
	    $sumahej2c=0;
	    $sql_horas = "select * from horas_docencia where cod_asig='$cod_asig' and curso='$curso'";    
	    $resul_horas = mysql_query($sql_horas, $link);
	    while ($row_horas = mysql_fetch_array($resul_horas))
	    {
		$sumaht1c=$sumaht1c+$row_horas['HT1C_totales'];
		$sumahl1c=$sumahl1c+$row_horas['HL1C_totales'];
		$sumaht2c=$sumaht2c+$row_horas['HT2C_totales'];
		$sumahl2c=$sumahl2c+$row_horas['HL2C_totales'];
		$sumahej1c=$sumahej1c+$row_horas['HEJ1C_totales'];
		$sumahej2c=$sumahej2c+$row_horas['HEJ2C_totales'];
	    }
	   
	    $lt1c=round(((($ht1c-$sumaht1c))*100))/100;
	    $ll1c=round(((($hl1c-$sumahl1c))*100))/100;
	    $lt2c=round(((($ht2c-$sumaht2c))*100))/100;
	    $ll2c=round(((($hl2c-$sumahl2c))*100))/100;
	    $lej1c=round(((($hej1c-$sumahej1c))*100))/100;
	    $lej2c=round(((($hej2c-$sumahej2c))*100))/100;
	    
	?><option value="<?php echo $row['codigo']?>"><?php echo $row['nombre']." Codigo:".$row['codigo']." (T1C:".$lt1c." L1C:".$ll1c." T2C:".$lt2c." L2C:".$ll2c."EJ1C: ".$lej1c." EJ2C: ".$lej2c.")"?></option>
	<?php
	$row=mysql_fetch_array($resul_asignatura);
	}
	?>
	</select>
	<?php
}


function generar_desplegable_prof($resul_profesores,$nombre,$curso)
{
	
	$numero_elementos=mysql_num_rows($resul_profesores);
	?>

	<select name="<?php echo $nombre?>" size="1">
	
	<?php
	 
	$link=Conectarse();
	$sql_profesores= "select * from personal where cargo!='PAS'order by apellidos";	    
	$resul_profesores = mysql_query($sql_profesores, $link);


	echo "<option value='nada' selected='selected'>Seleccione un nombre</option>";
	for($i=0;$i<$numero_elementos;$i++)
	{
	    
	    $row_profesores=mysql_fetch_array($resul_profesores); 
        $nif=$row_profesores['nif'];
	    $sql_carga="select * from cargas_max where nif='$nif' and curso='$curso'";
	    $resul_carga=mysql_query($sql_carga,$link);
	    $row_carga=mysql_fetch_array($resul_carga);
        $cargareal=calcular_carga_real($nif,$row_carga['cargamax_total'],$curso);
	    $situacion_academica=$row_carga['situacion_academica'];
        if ($situacion_academica=='ACTIVO'){
            ?><option value="<?php echo $nif?>"><?php echo  $row_profesores['apellidos'].", ". $row_profesores['nombre']." (C:".$cargareal.")"?></option>
            <?php
        }
	}	
	?>
	</select>
	<?php
}


function generar_desplegable_responsable($resul_profesores,$cod_asig)
{
	
//	$numero_elementos=mysql_num_rows($resul_profesores);
	?>

	<select name="responsable" size="1">
	
	<?php
	 
	$link=Conectarse();
//	$sql_profesores="select * from personal order by apellidos";

	$sql_profesores= "select * from personal where cargo!='PAS' order by apellidos";	    
	$resul_profesores = mysql_query($sql_profesores, $link);
	$numero_elementos=mysql_num_rows($resul_profesores);
	$sql_responsable="select * from profesorado where codigo_asignatura='$cod_asig' and coordinador='1'";
	$resul_responsable=mysql_query($sql_responsable, $link);
	if ($row_responsable=mysql_fetch_array($resul_responsable))
        { 
	    $nif_resp=$row_responsable['nif'];

	    $sql_resp= "select * from personal where nif='$nif_resp'";
	    $resul_resp = mysql_query($sql_resp, $link);
	    $row_resp=mysql_fetch_array($resul_resp); 
	    ?><option value='<?php echo $nif_resp?>' selected='selected'><?php echo  $row_resp['apellidos'].", ". $row_resp['nombre']?></option><?php
	}
	else
	{
            ?><option value='nada' selected='selected'>Seleccione un responsable</option><?php
	}
	
	for($i=0;$i<$numero_elementos;$i++)
	{
	    $row_profesores=mysql_fetch_array($resul_profesores); 
        $nif=$row_profesores['nif'];
        $sql_carga="select * from cargas_max where nif='$nif'";
	    $resul_carga=mysql_query($sql_carga,$link);
	    $row_carga=mysql_fetch_array($resul_carga);
	    $situacion_academica=$row_carga['situacion_academica'];
        if ($situacion_academica=='ACTIVO'){
            ?><option value="<?php echo $nif?>"><?php echo  $row_profesores['apellidos'].", ". $row_profesores['nombre']?></option>
            <?php
        }
	}	
	?>
	</select>
	<?php
}


$link = Conectarse();
$sqlcarreras = "select * from carreras order by nombre";
$resul_carreras = mysql_query($sqlcarreras, $link);

if(isset($_GET['valor']))
{
    $titulacion=$_GET['valor'];
    $sqlasignatura = "select * from asignaturas where codigo_titulacion='$titulacion' order by nombre";
    $resul_asignatura = mysql_query($sqlasignatura, $link);
}
else
{
    $titulacion=$_POST['titulacion'];
    if ($titulacion!='nada') {
	$sqlasignatura = "select * from asignaturas where codigo_titulacion='$titulacion' order by nombre";
	$resul_asignatura = mysql_query($sqlasignatura, $link);    
    }
 }
?>

<div align="center">



<p><font color="#0066CC" face="Arial"><strong>SELECCIONAR ASIGNATURA CURSO : <?php echo $curso?></strong></font></p>
<form name='form1' method='POST' action='index.php' enctype='multipart/form-data' >
<table width="96%" height="80" border="0" bordercolor="#FFFFCC">
<script>
GuardarCurso('<?php echo $curso?>');
</script>
<tr> 
<td align='right'><font size="2" face="Arial" color="#0073B4"><b>Titulaci&oacute;n</b></font></td>
<td colspan='3'><input type="hidden" name="titulacion"><?php generar_desplegable_titulacion($resul_carreras); ?></td>
</tr>
<tr>
<td align='right'><font size="2" face="Arial" color="#0073B4"><b>Asignatura</b></font></td>
<td colspan='3'><input type="hidden" name="asignatura"><?php generar_desplegable_asignatura($resul_asignatura,$curso); ?></td>
</tr>
<?php echo '<input type="hidden" name="valor2" value="'.$curso.'">';?>
<tr>
<?php if(acceso_nivel($nivel,$user))
   echo "<td colspan='4' align='center' colspan='2'><input type='submit' name='Submit' value='EDITAR'></td>";
else
   echo "<td colspan='4' align='center' colspan='2'><input type='submit' name='Submit' value='VER'></td>";
?>
</tr>  
</table>
</form>
</div> 


<br>
<hr></hr>
<br>

<div align="center">
<p><font color="#0066CC" face="Arial"><strong>ASIGNACI&Oacute;N DE PROFESORES POR ASIGNATURA CURSO : <?php echo $curso?></strong></font></p>
</div>

<?php
$asignatura=$_POST['asignatura'];
$titulacion=$_POST['titulacion'];

if(($titulacion=='nada') && ($asignatura=='nada' || $asignatura==""))
    {
	$sql_titul="select * from carreras order by nombre";
	$resul_titul=mysql_query($sql_titul,$link);
	while ($row_titul=mysql_fetch_array($resul_titul))
	{
	        $codigo_titulacion=$row_titul['codigo'];
		$sql_sinasig="select * from asignaturas where codigo_titulacion='$codigo_titulacion'";
		$result_sinasig=mysql_query($sql_sinasig,$link);
	?><table width="100%" border="0" bordercolor="#FFFFCC" align='center'>
       <tr><td class='celdagris'><font><strong> Titulacion &nbsp;</strong><?php echo $row_titul['nombre']?></font></td>
       <td class='celdagris'><font><strong> Codigo &nbsp;</strong><?php echo $row_titul['codigo']?></font></td></table><?php
       
		

		while($row_sinasig=mysql_fetch_array($result_sinasig))
		{
		     echo "<br \><br \><br \><br \><br \><br \>";
		     //echo "<table>";
		    $cod_asignatura=$row_sinasig['codigo'];
		    //echo "<div align='center'>";
		    ?>
<tr><td colspan='7'>
    <table width="90%" border="0" bordercolor="#FFFFCC" align='center'>
       <tr><td><font><strong> Abreviatura &nbsp;</strong><?php echo $row_sinasig['abreviatura']?></font></td>
       <td><font><strong> 1Nombre &nbsp;</strong><?php echo $row_sinasig['nombre']?></font></td>
       <td><font><strong> C&oacute;digo &nbsp;</strong><?php echo $row_sinasig['codigo']?></font></td><?php if($row_sinasig['cuatrimestre']==0)
		    {
			$cuat='A';
		    }
		    else
		    {
			$cuat=$row_sinasig['cuatrimestre'];
		    }?>	
		    
       <td><font><strong> Cuatrimestre &nbsp;</strong><?php echo $cuat?></font></td</tr> <?php $sql_responsable="select * from profesorado where codigo_asignatura='$cod_asignatura' and coordinador='1'";
		    $resul_responsable=mysql_query($sql_responsable, $link);
		    if ($row_responsable=mysql_fetch_array($resul_responsable))
		    { 
			$nif_resp=$row_responsable['nif'];
			$sql_resp= "select * from personal where nif='$nif_resp'";
			$resul_resp = mysql_query($sql_resp, $link);
			$row_resp=mysql_fetch_array($resul_resp);?>
			<tr><td><font><strong> Responsable &nbsp;</strong></font><?php echo $row_resp['apellidos']. ",". $row_resp['nombre']?></td>
		   <?php }
		    else{?>
 <tr><td><font><strong> Responsable &nbsp;</strong></font><?php echo ""?></td></tr><?php }?>    
    
    </table><?php
	
						   /*echo "<font><strong><tr><td>Abreviatura: </strong>".$row_sinasig['abreviatura']."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong></td><td>Nombre Asignatura: </strong>".$row_sinasig['nombre']."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><strong>C&oacute;digo:</strong> ".$row_sinasig['codigo']."</tr></font>";             
		    //echo "</div>";
		    //echo "<p></p>";
		    if($row_sinasig['cuatrimestre']==0)
		    {
			$cuat='A';
		    }
		    else
		    {
			$cuat=$row_sinasig['cuatrimestre'];
		    }
		    //echo "<div align='center'>";
		    echo "<tr><td><font><strong>Cuatrimestre: </strong>".$cuat."</font></td></tr>";
		    //echo "</div>";
		    //echo "<p></p>";
		    $sql_responsable="select * from profesorado where codigo_asignatura='$cod_asignatura' and coordinador='1'";
		    $resul_responsable=mysql_query($sql_responsable, $link);
		    if ($row_responsable=mysql_fetch_array($resul_responsable))
		    { 
			$nif_resp=$row_responsable['nif'];
			$sql_resp= "select * from personal where nif='$nif_resp'";
			$resul_resp = mysql_query($sql_resp, $link);
			$row_resp=mysql_fetch_array($resul_resp); 
			echo "<tr><td><font><strong> Responsable: </strong>".$row_resp['apellidos'].", ". $row_resp['nombre']."</font></td></tr></table>";
		    }*/
		   
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
		    
		    
                    echo $curso;
		    $sql_horas_asig = "select * from horas_asignatura where cod_asig='$cod_asignatura' and curso='$curso'";
		    $resul_horas_asig = mysql_query($sql_horas_asig, $link);
		    if($row_horas_asig = mysql_fetch_array($resul_horas_asig))
		    {
			$ht1c=$row_horas_asig['ht1c_totales'];
			$hl1c=$row_horas_asig['hl1c_totales'];
			$ht2c=$row_horas_asig['ht2c_totales'];
			$hl2c=$row_horas_asig['hl2c_totales'];
			$hej1c=$row_horas_asig['hej1c_totales'];
			$hej2c=$row_horas_asig['hej2c_totales'];
			$ht1ec=$row_horas_asig['ht1ec_totales'];
			$hl1ec=$row_horas_asig['hl1ec_totales'];
			$ht2ec=$row_horas_asig['ht2ec_totales'];
			$hl2ec=$row_horas_asig['hl2ec_totales'];
			$hej1ec=$row_horas_asig['hej1ec_totales'];
			$hej2ec=$row_horas_asig['hej2ec_totales'];
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
		    $sql_horas = "select * from horas_docencia where cod_asig='$cod_asignatura' and curso='$curso'";    
		    $resul_horas = mysql_query($sql_horas, $link);
		    while ($row_horas = mysql_fetch_array($resul_horas))
		    {
			$sumaht1c= ($sumaht1c+$row_horas['HT1C_totales']);
			$sumahl1c=($sumahl1c+$row_horas['HL1C_totales']);
			$sumaht2c=($sumaht2c+$row_horas['HT2C_totales']);
			$sumahl2c=($sumahl2c+$row_horas['HL2C_totales']);
			$sumahl2c=($sumahej1c+$row_horas['HEJ1C_totales']);
			$sumahl2c=($sumahej2c+$row_horas['HEJ2C_totales']);
			$sumaht1ec= ($sumaht1ec+$row_horas['HT1EC_totales']);
			$sumahl1ec=($sumahl1ec+$row_horas['HL1EC_totales']);
			$sumaht2ec=($sumaht2ec+$row_horas['HT2EC_totales']);
			$sumahl2ec=($sumahl2ec+$row_horas['HL2EC_totales']);
			$sumahl2ec=($sumahej1ec+$row_horas['HEJ1EC_totales']);
			$sumahl2ec=($sumahej2ec+$row_horas['HEJ2EC_totales']);

			
		    }

		    $lt1c=round(((($ht1c)-$sumaht1c))*100)/100;
		    $ll1c=round(((($hl1c)-$sumahl1c))*100)/100;
	            $lt2c=round(((($ht2c)-$sumaht2c))*100)/100;
		    $ll2c=round(((($hl2c)-$sumahl2c))*100)/100;
		    $lej1c=round(((($hej1c)-$sumahej1c))*100)/100;
		    $lej2c=round(((($hej2c)-$sumahej2c))*100)/100;
		    $lt1ec=round(((($ht1ec)-$sumaht1ec))*100)/100;
		    $ll1ec=round(((($hl1ec)-$sumahl1ec))*100)/100;
	            $lt2ec=round(((($ht2ec)-$sumaht2ec))*100)/100;
		    $ll2ec=round(((($hl2ec)-$sumahl2ec))*100)/100;
		    $lej1ec=round(((($hej1ec)-$sumahej1ec))*100)/100;
		    $lej2ec=round(((($hej2ec)-$sumahej2ec))*100)/100;
?>


    <table width="75%" border="0" bordercolor="#FFFFCC" align='center'>
       <tr><td><font><strong> ESP &nbsp;</strong></font></td>
       <td><font><strong> HT1C &nbsp;</strong><?php echo $ht1c?></font></td>
       <td><font><strong> HL1C &nbsp;</strong><?php echo $hl1c?></font></td>
       <td><font><strong> HEJ1C &nbsp;</strong><?php echo $hej1c?></font></td>
       <td><font><strong> HT2C &nbsp;</strong><?php echo $ht2c?></font></td>
       <td><font><strong> HL2C &nbsp;</strong><?php echo $hl2c?></font></td>
       <td><font><strong> HEJ2C &nbsp;</strong><?php echo $hej2c?></font></td></tr>
    <tr><td></td><td><font><strong> LT1C &nbsp;</strong></font><?php echo $lt1c?></td>
    <td><font><strong> LL1C &nbsp;</strong></font><?php echo $ll1c?></td>
    <td><font><strong> LEJ1C &nbsp;</strong></font><?php echo $lej1c?></td>
    <td><font><strong> LT2C &nbsp;</strong></font><?php echo $lt2c?></td>
    <td><font><strong> LL2C &nbsp;</strong></font><?php echo $ll2c?></td>
    <td><font><strong> LEJ2C &nbsp;</strong></font><?php echo $lej2c?></td></tr>

       </tr><tr><td><font><strong> ENG &nbsp;</strong></font></td>
       <td><font><strong> HT1C &nbsp;</strong><?php echo $ht1ec?></font></td>
       <td><font><strong> HL1C &nbsp;</strong><?php echo $hl1ec?></font></td>
       <td><font><strong> HEJ1C &nbsp;</strong><?php echo $hej1ec?></font></td>
       <td><font><strong> HT2C &nbsp;</strong><?php echo $ht2ec?></font></td>
       <td><font><strong> HL2C &nbsp;</strong><?php echo $hl2ec?></font></td>
       <td><font><strong> HEJ2C &nbsp;</strong><?php echo $hej2ec?></font></td></tr>
    <tr><td></td><td><font><strong> LT1C &nbsp;</strong></font><?php echo $lt1ec?></td>
    <td><font><strong> LL1C &nbsp;</strong></font><?php echo $ll1ec?></td>
    <td><font><strong> LEJ1C &nbsp;</strong></font><?php echo $lej1ec?></td>
    <td><font><strong> LT2C &nbsp;</strong></font><?php echo $lt2ec?></td>
    <td><font><strong> LL2C &nbsp;</strong></font><?php echo $ll2ec?></td>
    <td><font><strong> LEJ2C &nbsp;</strong></font><?php echo $lej2ec?></td></tr>



</tr>
        
    </table>
					
     					
    <tr>
    <td colspan='7'>&nbsp;</td>															     
    </tr>

    <tr>
    <td colspan='7' align='center'>
	 <table width="75%" border="0" bordercolor="#FFFFCC" align='center'>
	 <?php
echo "<tr><td align='center'><font size='2' face='Arial' color='#0073B4'><b> Profesores</b></font></td><td></td>";
		    echo "<td align='center' ><font size='2' face='Arial' color='#0073B4'>";echo"<a title='Horas totales de teoria primer cuatrimestre'href='#'><b>HT1C</b></a></font></td>";
		    echo "<td align='center' ><font size='2' face='Arial' color='#0073B4'>";echo"<a title='Horas totales de laboratorio primer cuatrimestre'href='#'><b>HL1C</b></a></font></td>";
		    echo "<td align='center' ><font size='2' face='Arial' color='#0073B4'>";echo"<a title='Horas totales de ejercicios primer cuatrimestre'href='#'><b>HEJ1C</b></a></font></td>";
		    echo "<td align='center' ><font size='2' face='Arial' color='#0073B4'>";echo"<a title='Horas totales de teoria segundo cuatrimestre'href='#'><b>HT2C</b></a></font></td>";
		   echo "<td align='center' ><font size='2' face='Arial'
    color='#0073B4'>";echo"<a title='Horas totales de laboratorio segundo
    cuatrimestre'href='#'><b>HL2C</b></a></font></td>";
                   echo "<td align='center' ><font size='2' face='Arial' color='#0073B4'>";echo"<a title='Horas totales de ejercicios segundo cuatrimestre'href='#'><b>HEJ2C</b></a></font></td>";

		    $sql_profesores_asig = "select * from profesorado where codigo_asignatura='$cod_asignatura'";	    
		    $resul_profesores_asig = mysql_query($sql_profesores_asig, $link);
		    $i=1;
		    /*if(!$resul_profesores_asig)
		    {
			echo "<tr align='center'><td  width='70%' class='celdagris'><font class='fuenteblanco'><strong>No hay profesores</strong></font></td>";
		    }*/	
		    while($row_profesores_asig = mysql_fetch_array($resul_profesores_asig))
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
			
			

			$apellidos=$row_profesores_asig['apellidos'];
			$nombre=$row_profesores_asig['nombre'];
			$id=$row_profesores_asig['id'];  
			$nif=$row_profesores_asig['nif'];

			$sql_horas_prof = "select * from horas_docencia where nif='$nif' and cod_asig='$cod_asignatura' and curso='$curso'order by id desc";	    
			$resul_horas_prof = mysql_query($sql_horas_prof, $link);
			if($row_horas_prof = mysql_fetch_array($resul_horas_prof))
			{
			    $ht1c=round($row_horas_prof['HT1C_totales'],2);
			    $hl1c=round($row_horas_prof['HL1C_totales'],2);
			    $ht2c=round($row_horas_prof['HT2C_totales'],2);
			    $hl2c=round($row_horas_prof['HL2C_totales'],2);
			    $hej1c=round($row_horas_prof['HEJ1C'],2);
			    $hej2c=round($row_horas_prof['HEJ2C'],2);
			    $ht1ec=round($row_horas_prof['HT1EC'],2);
			    $hl1ec=round($row_horas_prof['HL1EC'],2);
			    $ht2ec=round($row_horas_prof['HT2EC'],2);
			    $hl2ec=round($row_horas_prof['HL2EC'],2);
			    $hej1ec=round($row_horas_prof['HEJ1EC'],2);
			    $hej2ec=round($row_horas_prof['HEJ2EC'],2);
			}
			$sql_prof = "select * from cargas_max where nif='$nif' and curso='$curso'";
			$resul_prof = mysql_query($sql_prof, $link);
			if ($row_prof = mysql_fetch_array($resul_prof))
			{
			    $cargareal=calcular_carga_real($nif,$row_prof['cargamax_total'],$curso);
			}
			else
			{
			    $cargareal='NULL';
			}
			echo "<tr align='center'><td  width='70%' class='celdagris'><font class='fuenteblanco'><strong>".$apellidos.", ".$nombre." ". "</strong></font></td>";
		
			if(acceso_nivel($nivel,$user))
			{
			    echo "<input type='hidden' name='nif_profesor".$i."' value='".$nif."'>";
			    echo "<td align='center'><font size='2' face='Arial' color='#0073B4'><b>ESP</b></font></td>";
			    echo "<td><input type='text' maxlength='5' size='4' value='".$ht1c."' name='ht1c".$i."'></td>";
			    echo "<td><input type='text' maxlength='5' size='4' value='".$hl1c."' name='hl1c".$i."'></td>";
			    echo "<td><input type='text' maxlength='5' size='4' value='".$hej1c."' name='hej1c".$i."'></td>";
			    echo "<td><input type='text' maxlength='5' size='4' value='".$ht2c."' name='ht2c".$i."'></td>";
			    echo "<td><input type='text' maxlength='5' size='4' value='".$hl2c."' name='hl2c".$i."'></td>";
			    echo "<td><input type='text' maxlength='5' size='4' value='".$hej2c."' name='hej2c".$i."'></td>";
			    echo "</tr><tr>";
		    echo "<tr><td class='celdagris'><font class='fuenteblanco'><strong>(C:".$cargareal.")</td>";
			    echo "<td align='center'><font size='2' face='Arial' color='#0073B4'><b>ENG</b></font></td>";
			    echo "<td><input type='text' maxlength='5' size='4' value='".$ht1ec."' name='ht1ec".$i."'></td>";
			    echo "<td><input type='text' maxlength='5' size='4' value='".$hl1ec."' name='hl1ec".$i."'></td>";
			    echo "<td><input type='text' maxlength='5' size='4' value='".$hej1ec."' name='hej1ec".$i."'></td>";
			    echo "<td><input type='text' maxlength='5' size='4' value='".$ht2ec."' name='ht2ec".$i."'></td>";
			    echo "<td><input type='text' maxlength='5' size='4' value='".$hl2ec."' name='hl2ec".$i."'></td>";
			    echo "<td><input type='text' maxlength='5' size='4' value='".$hej2ec."' name='hej2ec".$i."'></td>";
			    //echo"<td align='right'><a  href='./deleteprofesor.php?id=".$id."&asig=".$cod_asignatura."&curso=".$curso."' class='generalbluebold'>Borrar</a></td></tr>";
			}
			else
			{
			   
			    echo "<td align='center'><font size='2' face='Arial' color='#0073B4'><b>ESP</b></font></td>";
			    echo "<td><font>".$ht1c."</font></td>";
			    echo "<td><font>".$hl1c."</font></td>";
			    echo "<td><font>".$ht2c."</font></td>";
			    echo "<td><font>".$hl2c."</font></td>";
			    echo "<td><font>".$hej1c."</font></td>";
			    echo "<td><font>".$hej2c."</font></td>";
			    echo "</tr><tr>";
			     echo "<td class='celdagris' width='70%'></td>";
			    echo "<td align='center'><font size='2' face='Arial' color='#0073B4'><b>ENG</b></font></td>";
			    echo "<td align='center'><font>".$ht1ec."</font></td>";
			    echo "<td align='center'><font>".$hl1ec."</font></td>";
			    echo "<td align='center'><font>".$ht2ec."</font></td>";
			    echo "<td align='center'><font>".$hl2ec."</font></td>";
			    echo "<td align='center'><font>".$hej1ec."</font></td>";
			    echo "<td align='center'><font>".$hej2ec."</font></td>";
			    
		
			}
		
			$i++;
		    }
		    echo"</table>";
		}
		//echo "</br \><br \>";
		echo"</td></tr>";
		
  	        
    }
    }


if(($titulacion!='nada' && $titulacion!="") && ($asignatura=='nada' || $asignatura==""))
    {

	        $codigo_titulacion=$titulacion;
		$sql_sinasig="select * from asignaturas where codigo_titulacion='$codigo_titulacion'";
		$result_sinasig=mysql_query($sql_sinasig,$link);
		
		while($row_sinasig=mysql_fetch_array($result_sinasig))
		{
		     echo "<br \><br \><br \><br \><br \><br \>";
		     //echo "<table>";
		    $cod_asignatura=$row_sinasig['codigo'];
		    //echo "<div align='center'>";
		    ?>
<tr><td colspan='7'>
    <table width="90%" border="0" bordercolor="#FFFFCC" align='center'>
       <tr><td><font><strong> Abreviatura &nbsp;</strong><?php echo $row_sinasig['abreviatura']?></font></td>
       <td><font><strong> Nombre &nbsp;</strong><?php echo $row_sinasig['nombre']?></font></td>
       <td><font><strong> C&oacute;digo &nbsp;</strong><?php echo $row_sinasig['codigo']?></font></td><?php if($row_sinasig['cuatrimestre']==0)
		    {
			$cuat='A';
		    }
		    else
		    {
			$cuat=$row_sinasig['cuatrimestre'];
		    }?>	
		    
       <td><font><strong> Cuatrimestre &nbsp;</strong><?php echo $cuat?></font></td</tr> <?php $sql_responsable="select * from profesorado where codigo_asignatura='$cod_asignatura' and coordinador='1'";
		    $resul_responsable=mysql_query($sql_responsable, $link);
		    if ($row_responsable=mysql_fetch_array($resul_responsable))
		    { 
			$nif_resp=$row_responsable['nif'];
			$sql_resp= "select * from personal where nif='$nif_resp'";
			$resul_resp = mysql_query($sql_resp, $link);
			$row_resp=mysql_fetch_array($resul_resp);?>
			<tr><td><font><strong> Responsable &nbsp;</strong></font><?php echo $row_resp['apellidos']. ",". $row_resp['nombre']?></td>
		   <?php }
		    else{?>
 <tr><td><font><strong> Responsable &nbsp;</strong></font><?php echo ""?></td><?php }?>    
    
    </table><?php
	
						   /*echo "<font><strong><tr><td>Abreviatura: </strong>".$row_sinasig['abreviatura']."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong></td><td>Nombre Asignatura: </strong>".$row_sinasig['nombre']."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><strong>C&oacute;digo:</strong> ".$row_sinasig['codigo']."</tr></font>";             
		    //echo "</div>";
		    //echo "<p></p>";
		    if($row_sinasig['cuatrimestre']==0)
		    {
			$cuat='A';
		    }
		    else
		    {
			$cuat=$row_sinasig['cuatrimestre'];
		    }
		    //echo "<div align='center'>";
		    echo "<tr><td><font><strong>Cuatrimestre: </strong>".$cuat."</font></td></tr>";
		    //echo "</div>";
		    //echo "<p></p>";
		    $sql_responsable="select * from profesorado where codigo_asignatura='$cod_asignatura' and coordinador='1'";
		    $resul_responsable=mysql_query($sql_responsable, $link);
		    if ($row_responsable=mysql_fetch_array($resul_responsable))
		    { 
			$nif_resp=$row_responsable['nif'];
			$sql_resp= "select * from personal where nif='$nif_resp'";
			$resul_resp = mysql_query($sql_resp, $link);
			$row_resp=mysql_fetch_array($resul_resp); 
			echo "<tr><td><font><strong> Responsable: </strong>".$row_resp['apellidos'].", ". $row_resp['nombre']."</font></td></tr></table>";
		    }*/
		   
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
		    
		    

		    $sql_horas_asig = "select * from horas_asignatura where cod_asig='$cod_asignatura' and curso='$curso'";
		    $resul_horas_asig = mysql_query($sql_horas_asig, $link);
		    if($row_horas_asig = mysql_fetch_array($resul_horas_asig))
		    {
			$ht1c=round($row_horas_asig['ht1c_totales'],2);
			$hl1c=round($row_horas_asig['hl1c_totales'],2);
			$ht2c=round($row_horas_asig['ht2c_totales'],2);
			$hl2c=round($row_horas_asig['hl2c_totales'],2);
			$hej1c=round($row_horas_asig['hej1c_totales'],2);
			$hej2c=round($row_horas_asig['hej2c_totales'],2);
			$ht1ec=round($row_horas_asig['ht1ec_totales'],2);
			$hl1ec=round($row_horas_asig['hl1ec_totales'],2);
			$ht2ec=round($row_horas_asig['ht2ec_totales'],2);
			$hl2ec=round($row_horas_asig['hl2ec_totales'],2);
			$hej1ec=round($row_horas_asig['hej1ec_totales'],2);
			$hej2ec=round($row_horas_asig['hej2ec_totales'],2);
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
		    $sql_horas = "select * from horas_docencia where cod_asig='$cod_asignatura' and curso='$curso'";    
		    $resul_horas = mysql_query($sql_horas, $link);
		    while ($row_horas = mysql_fetch_array($resul_horas))
		    {
			$sumaht1c=round((($sumaht1c+$row_horas['HT1C_totales'])),2);
			$sumahl1c=round((($sumahl1c+$row_horas['HL1C_totales'])),2);
			$sumaht2c=round((($sumaht2c+$row_horas['HT2C_totales'])),2);
			$sumahl2c=round((($sumahl2c+$row_horas['HL2C_totales'])),2);
			$sumahej1c=round((($sumahej1c+$row_horas['HEJ1C_totales'])),2);
			$sumahej2c=round((($sumahej2c+$row_horas['HEJ2C_totales'])),2);
			$sumaht1ec=round((( $sumaht1ec+$row_horas['HT1EC_totales'])),2);
			$sumahl1ec=round((($sumahl1ec+$row_horas['HL1EC_totales'])),2);
			$sumaht2ec=round((($sumaht2ec+$row_horas['HT2EC_totales'])),2);
			$sumahl2ec=round((($sumahl2ec+$row_horas['HL2EC_totales'])),2);
			$sumahej1ec=round((($sumahej1ec+$row_horas['HEJ1EC_totales'])),2);
			$sumahej2ec=round((($sumahej2ec+$row_horas['HEJ2EC_totales'])),2);
		    }

		    $lt1c=round(($ht1c-$sumaht1c)*100)/100;
		    $ll1c=round(($hl1c-$sumahl1c)*100)/100;				
		    $lt2c=round(($ht2c-$sumaht2c)*100)/100;
		    $ll2c=round(($hl2c-$sumahl2c)*100)/100;
		    $lej1c=round(($hej1c-$sumahej1c)*100)/100;
		    $lej2c=round(($hej2c-$sumahej2c)*100)/100;
		    $lt1ec=round(($ht1ec-$sumaht1ec)*100)/100;
		    $ll1ec=round(($hl1ec-$sumahl1ec)*100)/100;				
		    $lt2ec=round(($ht2ec-$sumaht2ec)*100)/100;
		    $ll2ec=round(($hl2ec-$sumahl2ec)*100)/100;
		    $lej1ec=round(($hej1ec-$sumahej1ec)*100)/100;
		    $lej2ec=round(($hej2ec-$sumahej2ec)*100)/100;
?>

    <tr><td colspan='7'>
    <table width="75%" border="0" bordercolor="#FFFFCC" align='center'>
       <tr><td><font><strong> ESP &nbsp;</strong></font></td>
       <td><font><strong> HT1C &nbsp;</strong><?php echo $ht1c?></font></td>
       <td><font><strong> HL1C &nbsp;</strong><?php echo $hl1c?></font></td>
       <td><font><strong> HEJ1C &nbsp;</strong><?php echo $hej1c?></font></td>
       <td><font><strong> HT2C &nbsp;</strong><?php echo $ht2c?></font></td>
       <td><font><strong> HL2C &nbsp;</strong><?php echo $hl2c?></font></td>
       <td><font><strong> HEJ2C &nbsp;</strong><?php echo $hej2c?></font></td>
    <tr><td></td><td><font><strong> LT1C &nbsp;</strong></font><?php echo $lt1c?></td>
    <td><font><strong> LL1C &nbsp;</strong></font><?php echo $ll1c?></td>
    <td><font><strong> LEJ1C &nbsp;</strong></font><?php echo $lej1c?></td>
    <td><font><strong> LT2C &nbsp;</strong></font><?php echo $lt2c?></td>
    <td><font><strong> LL2C &nbsp;</strong></font><?php echo $ll2c?></td>
    <td><font><strong> LEJ2C &nbsp;</strong></font><?php echo $lej2c?></td></tr>

<tr><td><font><strong> ENG &nbsp;</strong></font></td>
       <td><font><strong> HT1C &nbsp;</strong><?php echo $ht1ec?></font></td>
       <td><font><strong> HL1C &nbsp;</strong><?php echo $hl1ec?></font></td>
       <td><font><strong> HEJ1C &nbsp;</strong><?php echo $hej1ec?></font></td>
       <td><font><strong> HT2C &nbsp;</strong><?php echo $ht2ec?></font></td>
       <td><font><strong> HL2C &nbsp;</strong><?php echo $hl2ec?></font></td>
       <td><font><strong> HEJ2C &nbsp;</strong><?php echo $hej2ec?></font></td>
    <tr><td></td><td><font><strong> LT1C &nbsp;</strong></font><?php echo $lt1ec?></td>
    <td><font><strong> LL1C &nbsp;</strong></font><?php echo $ll1ec?></td>
    <td><font><strong> LEJ1C &nbsp;</strong></font><?php echo $lej1ec?></td>
    <td><font><strong> LT2C &nbsp;</strong></font><?php echo $lt2ec?></td>
    <td><font><strong> LL2C &nbsp;</strong></font><?php echo $ll2ec?></td>
    <td><font><strong> LEJ2C &nbsp;</strong></font><?php echo $lej2ec?></td></tr>

</tr>
        
    </table>
					
     					
    <tr>
    <td colspan='7'>&nbsp;</td>															     
    </tr>

    <tr>
    <td colspan='7' align='center'>
	 <table width="75%" border="0" bordercolor="#FFFFCC" align='center'>
	 <?php
		    echo "<tr><td align='center'><font size='2' face='Arial' color='#0073B4'><b> Profesores</b></font></td>";
		    echo "<td align='center'><font size='2' face='Arial' color='#0073B4'><b></b></font></td>";
		   
		    echo "<td align='center' ><font size='2' face='Arial' color='#0073B4'>";echo"<a title='Horas totales de teoria primer cuatrimestre'href='#'><b>HT1C</b></a></font></td>";
		    echo "<td align='center' ><font size='2' face='Arial' color='#0073B4'>";echo"<a title='Horas totales de laboratorio primer cuatrimestre'href='#'><b>HL1C</b></a></font></td>";
		    echo "<td align='center' ><font size='2' face='Arial' color='#0073B4'>";echo"<a title='Horas totales de ejercicios primer cuatrimestre'href='#'><b>HEJ1C</b></a></font></td>";
		    echo "<td align='center' ><font size='2' face='Arial' color='#0073B4'>";echo"<a title='Horas totales de teoria segundo cuatrimestre'href='#'><b>HT2C</b></a></font></td>";
		   echo "<td align='center' ><font size='2' face='Arial' color='#0073B4'>";echo"<a title='Horas totales de laboratorio segundo cuatrimestre'href='#'><b>HL2C</b></a></font></td>";
		   echo "<td align='center' ><font size='2' face='Arial' color='#0073B4'>";echo"<a title='Horas totales de ejercicios segundo cuatrimestre'href='#'><b>HEJ2C</b></a></font></td>";

		    
		    $sql_profesores_asig = "select * from profesorado where codigo_asignatura='$cod_asignatura'";	    
		    $resul_profesores_asig = mysql_query($sql_profesores_asig, $link);
		    $i=1;
		    /*if(!$resul_profesores_asig)
		    {
			echo "<tr align='center'><td  width='70%' class='celdagris'><font class='fuenteblanco'><strong>No hay profesores</strong></font></td>";
		    }*/	
		    while($row_profesores_asig = mysql_fetch_array($resul_profesores_asig))
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

			$apellidos=$row_profesores_asig['apellidos'];
			$nombre=$row_profesores_asig['nombre'];
			$id=$row_profesores_asig['id'];  
			$nif=$row_profesores_asig['nif'];

			$sql_horas_prof = "select * from horas_docencia where nif='$nif' and cod_asig='$cod_asignatura' and curso='$curso'order by id desc";	    
			$resul_horas_prof = mysql_query($sql_horas_prof, $link);
			if($row_horas_prof = mysql_fetch_array($resul_horas_prof))
			{
			    $ht1c=round($row_horas_prof['HT1C_totales'],2);
			    $hl1c=round($row_horas_prof['HL1C_totales'],2);
			    $ht2c=round($row_horas_prof['HT2C_totales'],2);
			    $hl2c=round($row_horas_prof['HL2C_totales'],2);
			    $hej1c=round($row_horas_prof['HEJ1C_totales'],2);
			    $hej2c=round($row_horas_prof['HEJ2C_totales'],2);
			    $ht1ec=round($row_horas_prof['HT1EC_totales'],2);
			    $hl1ec=round($row_horas_prof['HL1EC_totales'],2);
			    $ht2ec=round($row_horas_prof['HT2EC_totales'],2);
			    $hl2ec=round($row_horas_prof['HL2EC_totales'],2);
			    $hej1ec=round($row_horas_prof['HEJ1EC_totales'],2);
			    $hej2ec=round($row_horas_prof['HEJ2EC_totales'],2);
			}
			$sql_prof = "select * from cargas_max where nif='$nif' and curso='$curso'";
			$resul_prof = mysql_query($sql_prof, $link);
			if ($row_prof = mysql_fetch_array($resul_prof))
			{
			    $cargareal=calcular_carga_real($nif,$row_prof['cargamax_total'],$curso);
			}
			else
			{
			    $cargareal='NULL';
			}
			echo "<tr align='center'><td  width='70%' class='celdagris'><font class='fuenteblanco'><strong>".$apellidos.", ".$nombre." ".  "</strong></font></td>";
		
			if(acceso_nivel($nivel,$user))
			{
			    echo "<input type='hidden' name='nif_profesor".$i."' value='".$nif."'>";
			    echo "<td align='center'><font size='2' face='Arial' color='#0073B4'><b>ESP</b></font></td>";
			    echo "<td><input type='text' maxlength='5' size='4' value='".$ht1c."' name='ht1c".$i."'></td>";
			    echo "<td><input type='text' maxlength='5' size='4' value='".$hl1c."' name='hl1c".$i."'></td>";
			    echo "<td><input type='text' maxlength='5' size='4' value='".$hej1c."' name='hej1c".$i."'></td>";
			    echo "<td><input type='text' maxlength='5' size='4' value='".$ht2c."' name='ht2c".$i."'></td>";
			    echo "<td><input type='text' maxlength='5' size='4' value='".$hl2c."' name='hl2c".$i."'></td>";
			    echo "<td><input type='text' maxlength='5' size='4' value='".$hej2c."' name='hej2c".$i."'></td>";
			    echo "</tr><tr>";		    echo "<tr><td class='celdagris'><font class='fuenteblanco'><strong>(C:".$cargareal.")</td>";
                            echo "<td align='center'><font size='2' face='Arial' color='#0073B4'><b>ENG</b></font></td>";
			    echo "<td><input type='text' maxlength='5' size='4' value='".$ht1ec."' name='ht1ec".$i."'></td>";
			    echo "<td><input type='text' maxlength='5' size='4' value='".$hl1ec."' name='hl1ec".$i."'></td>";
			    echo "<td><input type='text' maxlength='5' size='4' value='".$hej1ec."' name='hej1ec".$i."'></td>";
			    echo "<td><input type='text' maxlength='5' size='4' value='".$ht2ec."' name='ht2ec".$i."'></td>";
			    echo "<td><input type='text' maxlength='5' size='4' value='".$hl2ec."' name='hl2ec".$i."'></td>";
			    echo "<td><input type='text' maxlength='5' size='4' value='".$hej2ec."' name='hej2ec".$i."'></td>";
			    if ($user=='eduardo.molinos' || $user=='jorge.pozuelo')
			    {
			    echo"<td align='right'><a  href='./deleteprofesor.php?id=".$id."&asig=".$cod_asignatura."&curso=".$curso."' class='generalbluebold'>Borrar</a></td></tr>";
			    }			

}
			else
			{
			    echo "<td align='center'><font size='2' face='Arial' color='#0073B4'><b>ESP</b></font></td>";
			    echo "<td><font>".$ht1c."</font></td>";
			    echo "<td><font>".$hl1c."</font></td>";
			    echo "<td><font>".$hej1c."</font></td>";
			    echo "<td><font>".$ht2c."</font></td>";
			    echo "<td><font>".$hl2c."</font></td>";
			    echo "<td><font>".$hej2c."</font></td>";
			    echo "</tr><tr><td class='celdagris width='70%'></td><td align='center'><font size='2' face='Arial' color='#0073B4'><b>ENG</b></font></td>";
			    echo "<td align='center'><font>".$ht1ec."</font></td>";
			    echo "<td align='center'><font>".$hl1ec."</font></td>";
			    echo "<td align='center'><font>".$hej1ec."</font></td>";
			    echo "<td align='center'><font>".$ht2ec."</font></td>";
			    echo "<td align='center'><font>".$hl2ec."</font></td>";
			    echo "<td align='center'><font>".$hej2ec."</font></td>";
			    
			    
		
			}
		
			$i++;
		    }
		    echo"</table>";
		}
		//echo "</br \><br \>";
		echo"</td></tr>";
		
  	        
    }   
 
if(($asignatura!='' && $asignatura!='nada') && ($titulacion!='' && $asignatura!='nada')){
   
    $link = Conectarse();
   if ($asignatura!='') {
	$sql_asig_sel = "select * from asignaturas where codigo='$asignatura' order by nombre";
	$resul_asig_sel = mysql_query($sql_asig_sel, $link);
	$row_asig_sel = mysql_fetch_array($resul_asig_sel);
	echo "<div align='center'>";
	echo "<font><strong>Abreviatura: </strong>\n".$row_asig_sel['abreviatura']."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Nombre Asignatura: </strong>".$row_asig_sel['nombre']."<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <strong>C&oacute;digo:</strong> ".$row_asig_sel['codigo']."</font>";

$sql_clon="SELECT * FROM clones WHERE (codigo = {$row_asig_sel['codigo']} or  codigo_clon = {$row_asig_sel['codigo']} ) AND clon_prof=1 order by codigo";
//echo $sql_clon;
$sql_clon_res=mysql_query($sql_clon,$link);
while($sql_clon_lin=mysql_fetch_array($sql_clon_res))
	{echo "<br>Simult&aacute;nea:".$sql_clon_lin['codigo']."<br>\n";
         $principal=$sql_clon_lin['codigo_clon'];
	}
if ($principal) echo "<strong>CUIDADO!!! EDITAR ESTA que es la Principal:</strong>".$principal."<br>\n";

	echo "</div>";
	echo "<p></p>";


        
if($row_asig_sel['cuatrimestre']==0){
	    $cuat='A';}
	else{
	    $cuat=$row_asig_sel['cuatrimestre'];
	echo "<div align='center'>";
	echo "<font><strong>Cuatrimestre: </strong>".$cuat."</font>";
	echo "</div>";
	echo "<p></p>";}
   }

    
    if ($titulacion!='' && $titulacion!='nada') {
	$sql_titul_sel = "select * from carreras where codigo='$titulacion'";    
	$resul_titul_sel = mysql_query($sql_titul_sel, $link);
	$row_titul_sel = mysql_fetch_array($resul_titul_sel);
	echo "<div align='center'>";
	echo "<font><strong>Nombre Titulaci&oacute;n: </strong>".$row_titul_sel['nombre']."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <strong>C&oacute;digo:</strong> ".$row_titul_sel['codigo']."</font>";
	echo "</div>";
	echo "<p></p>";
	    }
   
     
	        	


 echo "<form name='form1' method='post' action='insdocencia.php' enctype='multipart/form-data' >";
?>
     <table width="95%" height="80" border="0" bordercolor="#FFFFCC" align='center'>
   <?php
    $sql_profesores = "select * from personal where cargo!='PAS' and cargo!='CD' order by apellidos";	    
    $resul_profesores = mysql_query($sql_profesores, $link);
    ?>
    <tr>
    <?php if(acceso_nivel($nivel,$user))
    {?>
	<td colspan='7' align='center'><font><strong> Responsable:</strong></font><input type='hidden' name='responsable'><?php generar_desplegable_responsable($resul_profesores,$asignatura); ?></td>
       <?php }
     else
    {
    $sql_responsable="select * from profesorado where codigo_asignatura='$asignatura' and coordinador='1'";
	$resul_responsable=mysql_query($sql_responsable, $link);
	if ($row_responsable=mysql_fetch_array($resul_responsable))
           { 
	    $nif_resp=$row_responsable['nif'];

	    $sql_resp= "select * from personal where nif='$nif_resp'";
	    $resul_resp = mysql_query($sql_resp, $link);
	    $row_resp=mysql_fetch_array($resul_resp); 
               echo "<td colspan='7' align='center'><font><strong> Responsable: </strong>".$row_resp['apellidos'].", ". $row_resp['nombre']."</font></td>";
	}
        
       }
?>
       </tr>
    <tr>
    <td colspan='7'>&nbsp;</td>															     
    </tr>
<?php
       if(acceso_nivel($nivel,$user))
    {
       $carga_media=calcular_carga_media($curso,$numero_semanas);
    echo "<tr>";
	echo "<td colspan='7' align='center' width='6%'><font><strong>Carga media asignada: </strong></font>".$carga_media."% </td></tr>";

	// mocana: elimino carga media estimada
	//$carga_media_estimada=calcular_carga_media_estimada($nif,$curso,$asignatura,$titulacion,$numero_semanas);
	//      echo "<tr>";
	//     echo "<td colspan='7' align='center' width='6%'><font><strong>Carga del departamento: </strong></font>".$carga_media_estimada."</td>";


       }
?>
       </tr>
    <tr>
    <td colspan='7'>&nbsp;</td>															     
    </tr>
<?php

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

    $sql_horas_asig = "select * from horas_asignatura where cod_asig='$asignatura' and curso='$curso'";
    //$borrar=calcular_carga_media_estimada($nif,$curso);
    //echo $borrar;
    $resul_horas_asig = mysql_query($sql_horas_asig, $link);
    if($row_horas_asig = mysql_fetch_array($resul_horas_asig))
    {
	$ht1c=round($row_horas_asig['ht1c_totales'],2);
	$hl1c=round($row_horas_asig['hl1c_totales'],2);
	$ht2c=round($row_horas_asig['ht2c_totales'],2);
	$hl2c=round($row_horas_asig['hl2c_totales'],2);
	$hej1c=round($row_horas_asig['hej1c_totales'],2);
	$hej2c=round($row_horas_asig['hej2c_totales'],2);
	$ht1ec=round($row_horas_asig['ht1ec_totales'],2);
	$hl1ec=round($row_horas_asig['hl1ec_totales'],2);
	$ht2ec=round($row_horas_asig['ht2ec_totales'],2);
	$hl2ec=round($row_horas_asig['hl2ec_totales'],2);
	$hej1ec=round($row_horas_asig['hej1ec_totales'],2);
	$hej2ec=round($row_horas_asig['hej2ec_totales'],2);
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
    $sql_horas = "select * from horas_docencia where cod_asig='$asignatura' and curso='$curso'";    
    $resul_horas = mysql_query($sql_horas, $link);
    while ($row_horas = mysql_fetch_array($resul_horas))
    {
        $sumaht1c= $sumaht1c+$row_horas['HT1C_totales'];
        $sumahl1c=$sumahl1c+$row_horas['HL1C_totales'];
        $sumaht2c=$sumaht2c+$row_horas['HT2C_totales'];
        $sumahl2c=$sumahl2c+$row_horas['HL2C_totales'];
	$sumahej1c=$sumahej1c+$row_horas['HEJ1C_totales'];
        $sumahej2c=$sumahej2c+$row_horas['HEJ2C_totales'];
        $sumaht1ec= $sumaht1ec+$row_horas['HT1EC_totales'];
        $sumahl1ec=$sumahl1ec+$row_horas['HL1EC_totales'];
        $sumaht2ec=$sumaht2ec+$row_horas['HT2EC_totales'];
        $sumahl2ec=$sumahl2ec+$row_horas['HL2EC_totales'];
	$sumahej1ec=$sumahej1ec+$row_horas['HEJ1EC_totales'];
        $sumahej2ec=$sumahej2ec+$row_horas['HEJ2EC_totales'];
    }
    
    $lt1c=round((($ht1c-$sumaht1c))*100)/100;
    $ll1c=round((($hl1c-$sumahl1c))*100)/100;				
    $lt2c=round((($ht2c-$sumaht2c))*100)/100;
    $ll2c=round((($hl2c-$sumahl2c))*100)/100;
    $lej1c=round((($hej1c-$sumahej1c))*100)/100;
    $lej2c=round((($hej2c-$sumahej2c))*100)/100;
    $lt1ec=round((($ht1ec-$sumaht1ec))*100)/100;
    $ll1ec=round((($hl1ec-$sumahl1ec))*100)/100;				
    $lt2ec=round((($ht2ec-$sumaht2ec))*100)/100;
    $ll2ec=round((($hl2ec-$sumahl2ec))*100)/100;
    $lej1ec=round((($hej1ec-$sumahej1ec))*100)/100;
    $lej2ec=round((($hej2ec-$sumahej2ec))*100)/100;
    ?>

    <tr><td colspan='7'>
    <table width="75%" border="0" bordercolor="#FFFFCC" align='center'>
						    <?php if(acceso_nivel($nivel,$user)){?>
						    <tr><td><font><strong> ESP &nbsp;</strong></font></td>
<td><font><strong> HT1C &nbsp;</strong></font><input type='text' maxlength='5' size='4' value='<?php echo $ht1c?>' name='ht1casig'></td>
       <td><font><strong> HL1C &nbsp;</strong></font><input type='text' maxlength='5' size='4' value='<?php echo $hl1c?>' name='hl1casig'></td>
<td><font><strong> HEJ1C &nbsp;</strong></font><input type='text' maxlength='5' size='4' value='<?php echo $hej1c?>' name='hej1casig'></td>
       <td><font><strong> HT2C &nbsp;</strong></font><input type='text' maxlength='5' size='4' value='<?php echo $ht2c?>' name='ht2casig'></td>
       <td><font><strong> HL2C &nbsp;</strong></font><input type='text' maxlength='5' size='4' value='<?php echo $hl2c?>' name='hl2casig'></td>
       <td><font><strong> HEJ2C &nbsp;</strong></font><input type='text' maxlength='5' size='4' value='<?php echo $hej2c?>' name='hej2casig'></td>
    <tr><td></td><td><font><strong> LT1C &nbsp;</strong></font><?php echo $lt1c?></td>
    <td><font><strong> LL1C &nbsp;</strong></font><?php echo $ll1c?></td>
    <td><font><strong> LEJ1C &nbsp;</strong></font><?php echo $lej1c?></td>
    <td><font><strong> LT2C &nbsp;</strong></font><?php echo $lt2c?></td>
    <td><font><strong> LL2C &nbsp;</strong></font><?php echo $ll2c?></td>
    <td><font><strong> LEJ2C &nbsp;</strong></font><?php echo $lej2c?></td></tr>
						    <tr><td><font><strong> ENG &nbsp;</strong></font></td>
<td><input type='text' maxlength='5' size='4' value='<?php echo $ht1ec?>' name='ht1casige'></td>
       <td><input type='text' maxlength='5' size='4' value='<?php echo $hl1ec?>' name='hl1casige'></td>
<td><input type='text' maxlength='5' size='4' value='<?php echo $hej1ec?>' name='hej1casige'></td>
       <td><input type='text' maxlength='5' size='4' value='<?php echo $ht2ec?>' name='ht2casige'></td>
       <td><input type='text' maxlength='5' size='4' value='<?php echo $hl2ec?>' name='hl2casige'></td>
       <td><input type='text' maxlength='5' size='4' value='<?php echo $hej2ec?>' name='hej2casige'></td>
    <tr><td></td><td><font><strong> LT1C &nbsp;</strong></font><?php echo $lt1ec?></td>
    <td><font><strong> LL1C &nbsp;</strong></font><?php echo $ll1ec?></td>
    <td><font><strong> LEJ1C &nbsp;</strong></font><?php echo $lej1ec?></td>
    <td><font><strong> LT2C &nbsp;</strong></font><?php echo $lt2ec?></td>
    <td><font><strong> LL2C &nbsp;</strong></font><?php echo $ll2ec?></td>
    <td><font><strong> LEJ2C &nbsp;</strong></font><?php echo $lej2ec?></td></tr>


</tr>
    <?php }
    else{?>
       <tr>
 <tr><td><font><strong> ESP &nbsp;</strong></font></td>
<td><font><strong> HT1C &nbsp;</strong><?php echo $ht1c?></font></td>
       <td><font><strong> HL1C &nbsp;</strong><?php echo $hl1c?></font></td>
       <td><font><strong> HEJ1C &nbsp;</strong><?php echo $hej1c?></font></td>
       <td><font><strong> HT2C &nbsp;</strong><?php echo $ht2c?></font></td>
       <td><font><strong> HL2C &nbsp;</strong><?php echo $hl2c?></font></td>
       <td><font><strong> HEJ2C &nbsp;</strong><?php echo $hej2c?></font></td>
    <tr><td></td><td><font><strong> LT1C &nbsp;</strong></font><?php echo $lt1c?></td>
    <td><font><strong> LL1C &nbsp;</strong></font><?php echo $ll1c?></td>
    <td><font><strong> LEJ1C &nbsp;</strong></font><?php echo $lej1c?></td>
    <td><font><strong> LT2C &nbsp;</strong></font><?php echo $lt2c?></td>
    <td><font><strong> LL2C &nbsp;</strong></font><?php echo $ll2c?></td>
    <td><font><strong> LEJ2C &nbsp;</strong></font><?php echo $lej2c?></td></tr>

 <tr><td><font><strong> ENG &nbsp;</strong></font></td>
<td><font><strong> HT1C &nbsp;</strong><?php echo $ht1ec?></font></td>
       <td><font><strong> HL1C &nbsp;</strong><?php echo $hl1ec?></font></td>
       <td><font><strong> HEJ1C &nbsp;</strong><?php echo $hej1ec?></font></td>
       <td><font><strong> HT2C &nbsp;</strong><?php echo $ht2ec?></font></td>
       <td><font><strong> HL2C &nbsp;</strong><?php echo $hl2ec?></font></td>
       <td><font><strong> HEJ2C &nbsp;</strong><?php echo $hej2ec?></font></td>
    <tr><td></td><td><font><strong> LT1C &nbsp;</strong></font><?php echo $lt1ec?></td>
    <td><font><strong> LL1C &nbsp;</strong></font><?php echo $ll1ec?></td>
    <td><font><strong> LEJ1C &nbsp;</strong></font><?php echo $lej1ec?></td>
    <td><font><strong> LT2C &nbsp;</strong></font><?php echo $lt2ec?></td>
    <td><font><strong> LL2C &nbsp;</strong></font><?php echo $ll2ec?></td>
    <td><font><strong> LEJ2C &nbsp;</strong></font><?php echo $lej2ec?></td></tr>

</tr>
    <?php }?>
    

    </table>
    </td></tr>

    <tr>
    <td colspan='7'>&nbsp;</td>															     
    </tr>

    <tr>
    <td colspan='7' align='center'>
	 <table width="75%" border="0" bordercolor="#FFFFCC" align='center'>
						    <?php 
						     echo "<tr><td align='center'><font size='2' face='Arial' color='#0073B4'><b> Profesores</b></font></td>";
 	  echo "<td align='center'><font size='2' face='Arial' color='#0073B4'><b></b></font></td>";
 	 
		    echo "<td align='center' ><font size='2' face='Arial' color='#0073B4'>";echo"<a title='Horas totales de teoria primer cuatrimestre'href='#'><b>HT1C</b></a></font></td>";
		    echo "<td align='center' ><font size='2' face='Arial' color='#0073B4'>";echo"<a title='Horas totales de laboratorio primer cuatrimestre'href='#'><b>HL1C</b></a></font></td>";
		    echo "<td align='center' ><font size='2' face='Arial' color='#0073B4'>";echo"<a title='Horas totales de ejercicios primer cuatrimestre'href='#'><b>HEJ1C</b></a></font></td>";
		    echo "<td align='center' ><font size='2' face='Arial' color='#0073B4'>";echo"<a title='Horas totales de teoria segundo cuatrimestre'href='#'><b>HT2C</b></a></font></td>";
		   echo "<td align='center' ><font size='2' face='Arial' color='#0073B4'>";echo"<a title='Horas totales de laboratorio segundo cuatrimestre'href='#'><b>HL2C</b></a></font></td>";
                    echo "<td align='center' ><font size='2' face='Arial' color='#0073B4'>";echo"<a title='Horas totales de ejercicios segundo cuatrimestre'href='#'><b>HEJ2C</b></a></font></td>";


          echo "</tr>";
 	  $sql_profesores_asig = "select * from profesorado where codigo_asignatura='$asignatura'";	    
	  $resul_profesores_asig = mysql_query($sql_profesores_asig, $link);
	   $i=1;
	  while($row_profesores_asig = mysql_fetch_array($resul_profesores_asig))
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

	       $apellidos=$row_profesores_asig['apellidos'];
		$nombre=$row_profesores_asig['nombre'];
		$id=$row_profesores_asig['id'];  
		$nif=$row_profesores_asig['nif'];

		$sql_horas_prof = "select * from horas_docencia where nif='$nif' and cod_asig='$asignatura' and curso='$curso'order by id desc";	    
		$resul_horas_prof = mysql_query($sql_horas_prof, $link);
		if($row_horas_prof = mysql_fetch_array($resul_horas_prof)){
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
        $sql_prof = "select * from cargas_max where nif='$nif' and curso='$curso'";
		$resul_prof = mysql_query($sql_prof, $link);
		if ($row_prof = mysql_fetch_array($resul_prof))
                {
                $cargareal=calcular_carga_real($nif,$row_prof['cargamax_total'],$curso);
                $situacion_academica=$row_prof['situacion_academica'];
                }
		else
		    $cargareal='NULL';
          
          if ($situacion_academica=='ACTIVO'){ 
              echo "<tr align='center'><td  width='70%' class='celdagris'><font class='fuenteblanco'><strong>".$apellidos.", ".$nombre."  </strong></font></td>";
              if(acceso_nivel($nivel,$user))
                {
                echo "<input type='hidden' name='nif_profesor".$i."' value='".$nif."'>";
                echo "<td align='center'><font size='2' face='Arial' color='#0073B4'><b>ESP</b></font></td>";
                echo "<td><input type='text' maxlength='5' size='4' value='".$ht1c."' name='ht1c".$i."'></td>";
                echo "<td><input type='text' maxlength='5' size='4' value='".$hl1c."' name='hl1c".$i."'></td>";
                echo "<td><input type='text' maxlength='5' size='4' value='".$hej1c."' name='hej1c".$i."'></td>";
                echo "<td><input type='text' maxlength='5' size='4' value='".$ht2c."' name='ht2c".$i."'></td>";
                echo "<td><input type='text' maxlength='5' size='4' value='".$hl2c."' name='hl2c".$i."'></td>";

                echo "<td><input type='text' maxlength='5' size='4' value='".$hej2c."' name='hej2c".$i."'></td></tr>";
                echo "<tr><td class='celdagris'><font class='fuenteblanco'><strong>(C:".$cargareal.")</td>";
                echo "<td align='center'><font size='2' face='Arial' color='#0073B4'><b>ENG</b></font></td>";
                echo "<td><input type='text' maxlength='5' size='4' value='".$ht1ec."' name='ht1ec".$i."'></td>";
                echo "<td><input type='text' maxlength='5' size='4' value='".$hl1ec."' name='hl1ec".$i."'></td>";
                echo "<td><input type='text' maxlength='5' size='4' value='".$hej1ec."' name='hej1ec".$i."'></td>";
                echo "<td><input type='text' maxlength='5' size='4' value='".$ht2ec."' name='ht2ec".$i."'></td>";
                echo "<td><input type='text' maxlength='5' size='4' value='".$hl2ec."' name='hl2ec".$i."'></td>";

                echo "<td><input type='text' maxlength='5' size='4' value='".$hej2ec."' name='hej2ec".$i."'></td>";
                if ($user=='eduardo.molinos' || $user=='jorge.pozuelo')
                    {
                    echo"<td align='right'><a  href='./deleteprofesor.php?id=".$id."&asig=".$asignatura."&curso=".$curso."' class='generalbluebold'>Borrar</a></td></tr>";
                    } 
              }
              else
              {
                echo "<td><font> ESP </font></td>";
                echo "<td><font>".$ht1c."</font></td>";
                echo "<td><font>".$hl1c."</font></td>";
                echo "<td><font>".$hej1c."</font></td>";
                echo "<td><font>".$ht2c."</font></td>";
                echo "<td><font>".$hl2c."</font></td>";
                echo "<td><font>".$hej2c."</font></td>";
                echo "</tr><tr><td class='celdagris'></td><td><font> ENG </font></td>";
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
	  echo "<input type='hidden' name='indice' value='".$i."'>";
	  ?>
	  </table>
    </td>
    </tr>

    <tr>
    <td colspan='7'>&nbsp;</td>															     
    </tr>
    <?php if(acceso_nivel($nivel,$user)){?>
    <tr> 

    <td align='center'><font size="2" face="Arial" color="#0073B4"><b>A&ntilde;adir Profesores</b></font></td>
										   <td align='center'><font size='2' face='Arial' color='#0073B4'><b></b></font></td>
	  <td align='center' title="Horas totales teoria primer cuatrimestre"><font size='2' face='Arial' color='#0073B4'><b>HT1C</b></font></td>
    <td align='center' title="Horas totales laboratorio primer cuatrimestre"><font size='2' face='Arial' color='#0073B4'><b>HL1C</b></font></td>
    <td align='center' title="Horas totales ejercicios primer cuatrimestre"><font size='2' face='Arial' color='#0073B4'><b>HEJ1C</b></font></td>									     
<td align='center' title="Horas totales teoria segundo cuatrimestre"><font size='2' face='Arial' color='#0073B4'><b>HT2C</b></font></td>
    <td align='center' title="Horas totales laboratorio segundo cuatrimestre"><font size='2' face='Arial' color='#0073B4'><b>HL2C</b></font></td>
    <td align='left' title="Horas totales ejercicios segundo cuatrimestre"><font size='2' face='Arial' color='#0073B4'><b>HEJ2C</b></font></td>
										   
				</tr>
	
    <?php
    $sql_profesores = "select * from personal where cargo!='PAS' order by apellidos";	    
    $resul_profesores = mysql_query($sql_profesores, $link);
    ?>
    <tr>
															  
    <td align='center'><input type="hidden" name="profesor1"><?php generar_desplegable_prof($resul_profesores,'profesor1',$curso); ?></td>
	  <td align='center'><font size='2' face='Arial' color='#0073B4'><b>ESP</b></font></td>
    <td><input type='text' maxlength='5' size='4' value='0' name='ht1cprof1'></td>
    <td><input type='text' maxlength='5' size='4' value='0' name='hl1cprof1'></td>
    <td><input type='text' maxlength='5' size='4' value='0' name='hej1cprof1'></td>
										    <td><input type='text' maxlength='5' size='4' value='0' name='ht2cprof1'></td>
    <td><input type='text' maxlength='5' size='4' value='0' name='hl2cprof1'></td>
										    <td><input type='text' maxlength='5' size='4' value='0' name='hej2cprof1'></td>
	  </tr><tr><td align='center'><font size='2' face='Arial' color='#0073B4'><b></b></font></td>
	  <td align='center'><font size='2' face='Arial' color='#0073B4'><b>ENG</b></font></td>
    <td><input type='text' maxlength='5' size='4' value='0' name='ht1cprofe1'></td>
    <td><input type='text' maxlength='5' size='4' value='0' name='hl1cprofe1'></td>
    <td><input type='text' maxlength='5' size='4' value='0' name='hej1cprofe1'></td>
										    <td><input type='text' maxlength='5' size='4' value='0' name='ht2cprofe1'></td>
    <td><input type='text' maxlength='5' size='4' value='0' name='hl2cprofe1'></td>
										    <td><input type='text' maxlength='5' size='4' value='0' name='hej2cprofe1'></td>
    

    </tr>

    <?php
    $sql_profesores = "select * from personal where cargo!='PAS' and cargo!='CD' order by apellidos";	    
    $resul_profesores = mysql_query($sql_profesores, $link);
    ?>
    <tr>

    <td align='center'><input type="hidden" name="profesor2"><?php generar_desplegable_prof($resul_profesores,'profesor2',$curso); ?></td>
	  <td align='center'><font size='2' face='Arial' color='#0073B4'><b>ESP</b></font></td>
    <td><input type='text' maxlength='5' size='4' value='0' name='ht1cprof2'></td>
    <td><input type='text' maxlength='5' size='4' value='0' name='hl1cprof2'></td>
    <td><input type='text' maxlength='5' size='4' value='0' name='hej1cprof2'></td>
										    <td><input type='text' maxlength='5' size='4' value='0' name='ht2cprof2'></td>
    <td><input type='text' maxlength='5' size='4' value='0' name='hl2cprof2'></td>
    
    <td><input type='text' maxlength='5' size='4' value='0' name='hej2cprof2'></td>
	  </tr><tr><td align='center'><font size='2' face='Arial' color='#0073B4'><b></b></font></td>
	  <td align='center'><font size='2' face='Arial' color='#0073B4'><b>ENG</b></font></td>
    <td><input type='text' maxlength='5' size='4' value='0' name='ht1cprofe2'></td>
    <td><input type='text' maxlength='5' size='4' value='0' name='hl1cprofe2'></td>
    <td><input type='text' maxlength='5' size='4' value='0' name='hej1cprofe2'></td>
										    <td><input type='text' maxlength='5' size='4' value='0' name='ht2cprofe2'></td>
    <td><input type='text' maxlength='5' size='4' value='0' name='hl2cprofe2'></td>
    
    <td><input type='text' maxlength='5' size='4' value='0' name='hej2cprofe2'></td>

    </tr>

     <?php
    $sql_profesores = "select * from personal where cargo!='PAS' and cargo!='CD' order by apellidos";	    
    $resul_profesores = mysql_query($sql_profesores, $link);
    ?>
    <tr>
															  
    <td align='center'><input type="hidden" name="profesor3"><?php generar_desplegable_prof($resul_profesores,'profesor3',$curso); ?></td>
	  <td align='center'><font size='2' face='Arial' color='#0073B4'><b>ESP</b></font></td>
    <td><input type='text' maxlength='5' size='4' value='0' name='ht1cprof3'></td>
    <td><input type='text' maxlength='5' size='4' value='0' name='hl1cprof3'></td>
    <td><input type='text' maxlength='5' size='4' value='0' name='hej1cprof3'></td>
										    <td><input type='text' maxlength='5' size='4' value='0' name='ht2cprof3'></td>
    <td><input type='text' maxlength='5' size='4' value='0' name='hl2cprof3'></td>
    
    <td><input type='text' maxlength='5' size='4' value='0' name='hej2cprof3'></td>
	  </tr><tr><td align='center'><font size='2' face='Arial' color='#0073B4'><b></b></font></td>
	  <td align='center'><font size='2' face='Arial' color='#0073B4'><b>ENG</b></font></td>
    <td><input type='text' maxlength='5' size='4' value='0' name='ht1cprofe3'></td>
    <td><input type='text' maxlength='5' size='4' value='0' name='hl1cprofe3'></td>
    <td><input type='text' maxlength='5' size='4' value='0' name='hej1cprofe3'></td>
										    <td><input type='text' maxlength='5' size='4' value='0' name='ht2cprofe3'></td>
    <td><input type='text' maxlength='5' size='4' value='0' name='hl2cprofe3'></td>
    
    <td><input type='text' maxlength='5' size='4' value='0' name='hej2cprofe3'></td>

    </tr>

     <?php
    $sql_profesores = "select * from personal where cargo!='PAS' and cargo!='CD' order by apellidos";	    
    $resul_profesores = mysql_query($sql_profesores, $link);
    ?>
    <tr>
															  
    <td align='center'><input type="hidden" name="profesor4"><?php generar_desplegable_prof($resul_profesores,'profesor4',$curso); ?></td>
	  <td align='center'><font size='2' face='Arial' color='#0073B4'><b>ESP</b></font></td>
    <td><input type='text' maxlength='5' size='4' value='0' name='ht1cprof4'></td>
    <td><input type='text' maxlength='5' size='4' value='0' name='hl1cprof4'></td>
    <td><input type='text' maxlength='5' size='4' value='0' name='hej1cprof4'></td>
										    <td><input type='text' maxlength='5' size='4' value='0' name='ht2cprof4'></td>
    <td><input type='text' maxlength='5' size='4' value='0' name='hl2cprof4'></td>
    
    <td><input type='text' maxlength='5' size='4' value='0' name='hej2cprof4'></td>
	  </tr><tr><td align='center'><font size='2' face='Arial' color='#0073B4'><b></b></font></td>
	  <td align='center'><font size='2' face='Arial' color='#0073B4'><b>ENG</b></font></td>
    <td><input type='text' maxlength='5' size='4' value='0' name='ht1cprofe4'></td>
    <td><input type='text' maxlength='5' size='4' value='0' name='hl1cprofe4'></td>
    <td><input type='text' maxlength='5' size='4' value='0' name='hej1cprofe4'></td>
										    <td><input type='text' maxlength='5' size='4' value='0' name='ht2cprofe4'></td>
    <td><input type='text' maxlength='5' size='4' value='0' name='hl2cprofe4'></td>
    
    <td><input type='text' maxlength='5' size='4' value='0' name='hej2cprofe4'></td>

    </tr>  

       
    <tr>
    <td colspan='7'>&nbsp;</td>															     
    </tr>															     
    <?php $asignatura=$_POST['asignatura'];?>
    <input type="hidden" name="asignatura" value="<?php echo $asignatura?>">
    <input type="hidden" name="curso" value="<?php echo $curso?>">
            
    <tr>																	  
    <td  colspan='7' align='center'><input type="submit" name="Submit" value="GUARDAR"></td>
    </tr>              	   
    <?php }?>
    <tr>
    <td colspan='7'>&nbsp;</td>															     
    </tr>
  
    <tr>
    <td colspan='7'>&nbsp;</td>															     
    </tr>
    
    </table>


<?php }

//echo '<div align="right"><a href="generarinforme2.php?id='.$row_prof['id'].'&anio='.$curso.'&cod_asig='.$asignatura.'&titulacion='.$_GET['valor'].'" class="generalbluebold"> << Generar</a> </div>';
echo '<div align="right"><a href="generarinforme3.php?id='.$row_prof['id'].'&anio='.$curso.'&cod_asig='.$asignatura.'&titulacion='.$_GET['valor'].'" class="generalbluebold"> << Generar Secretaria por horas</a> </div>';
//echo '<div align="right"><a href="generarinforme4.php?id='.$row_prof['id'].'&anio='.$curso.'&cod_asig='.$asignatura.'&titulacion='.$_GET['valor'].'" class="generalbluebold"> << Generar Secretaria por creditos</a> </div>';
?>
<div align="right"><a href="../index.php?valor2=<?php echo $curso?>" class="generalbluebold"><< Volver</a> </div>

				
<?php
abajo();
?>
