<?php
require_once("../core/biblioteca.inc.php");
include("../core/conexion.inc.php"); //Conexión con la base de datos
arribaseleccion("privada", "", "es", "Selecci&oacute;n");

$usuario = $_SESSION["usuario"];
$nivel = $_SESSION["nivel"];

session_start();

$user=$_SESSION['usario'];
//$user='cobreces';
$link=Conectarse();
$sql_puesto="Select * from personal where usuario='$user'";
$result_puesto = mysql_query($sql_puesto, $link);
if($row=mysql_fetch_array($result_puesto))
{
    $puesto=$row['puesto'];
    $nif=$row["nif"];
    $nombre=$row['nombre'];
    $apellidos=$row['apellidos'];
}

$link=Conectarse();

$anio2=date("Y");
$mes=date("m");
$dia=date("d");
$link=Conectarse();
if ($mes>2 && $mes<9)
{
    $cuat=2;
}
else
{
    $cuat=1;
}
if ($mes>=9)
{
    $anio3=$anio2."/".($anio2+1);
}
else
{
    $anio3=($anio2-1)."/".($anio2);
}
$sql_fecha="SELECT * FROM curso_academico WHERE curso='$anio3'";
$resul_fecha=mysql_query($sql_fecha,$link);
$row_fecha=mysql_fetch_array($resul_fecha);
$fecha_cambio=explode("-",$row_fecha['inicio']);

if ($mes>$fecha_cambio[1])
{
   $aniop=$anio2."/".($anio2+1);
}
else
{
    if($mes==$fecha_cambio[1])
    {
	if($dia>=$fecha_cambio[0])
	{
	    $aniop=$anio2."/".($anio2+1);
	}
	else
	{
	      $aniop=($anio2-1)."/".$anio2;
	}
    }
    else
    {
	$aniop=($anio2-1)."/".$anio2;
    }
}



//arriba("", "docencia", "es", "Curso ".$aniop."");

$sql_personal="SELECT * FROM personal WHERE usuario='$user'";
$resul_personal=mysql_query($sql_personal,$link);
$row_personal=mysql_fetch_array($resul_personal);
$nif=$row_personal['nif'];
//echo $nif;
$control='0';
$sql_profesorado="SELECT * FROM profesorado WHERE nif='$nif' AND coordinador='1'";
$resul_profesorado=mysql_query($sql_profesorado,$link);
while ($row_profesorado=mysql_fetch_array($resul_profesorado))
{
    $cod_asig=$row_profesorado['codigo_asignatura'];
//    echo "codigo asignatura ".$cod_asig;
    $sql_asig2="SELECT * FROM asignaturas WHERE codigo='$cod_asig'";
    $resul_asig2=mysql_query($sql_asig2,$link);
    $row_asig2=mysql_fetch_array($resul_asig2);
    if (($row_asig2['cuatrimestre']=='$cuat' || $row_asig2['cuatrimestre']=='0') && $row_asig2['estado']=='ordinario')
{

    $sql_profesorado2="SELECT * FROM profesorado WHERE nif!='$nif' AND codigo_asignatura='$cod_asig'";
    $resul_profesorado2=mysql_query($sql_profesorado2,$link);
    while ($row_profesorado2=mysql_fetch_array($resul_profesorado2))
    {
	$prof=$row_profesorado2['id'];
	$nombre=$row_profesorado2['nombre'];
	$apellido=$row_profesorado2['apellidos'];
//	echo "profesor ".$prof;
//	echo "prueba";
    $sql_profesoradohorario="SELECT * FROM profesorado_horario WHERE profesor='$prof' AND anio_academico='$aniop'";
    $resul_profesoradohorario=mysql_query($sql_profesoradohorario,$link);
    if ($row_profesoradohorario=mysql_fetch_array($resul_profesoradohorario))
    {
//	echo $row_profesoradohorario['horario'];
    }
    else
    {
//	echo "prueba";
	$sql_asig2="SELECT * FROM asignaturas WHERE codigo='$cod_asig'";
	$resul_asig2=mysql_query($sql_asig2,$link);
	$row_asig2=mysql_fetch_array($resul_asig2);
	if ($control=='0')
	{
	    $control='1';
	            echo"<table border = '0'>\n";
	echo "<tr> \n";
	echo "<td class='celdaazul'><b><font class='fuenteblanco'>Aviso: Los siguientes profesores no tienen asignado horario y debe asignarlo en la p&aacute;gina de la asignatura correspondiente</font>        </b></td> \n";
	}
        echo"<table border = '0'>\n";
	echo "<tr> \n";
	echo "<td class='celdaazul'><b><font class='fuenteblanco'>Asignatura: ".$row_asig2['nombre']."</font>        </b></td> \n";
        echo "<td bgcolor='#F8F3E4'><b><font class='fuenteazul'>Profesor sin horario asignado: ".$nombre." ".$apellido."</font></b></td> \n";
	echo"</table>";

    }
    }

}
}

echo "<br />";
echo "<br />";
echo "<br />";


echo "<table width='75%' border='3' align='center'>";
echo "<tr>";
echo "<td><table width='75%' border='0' align='center'>";
echo "<tr >"; 
echo "<td colspan='2' height='41'>"; 
echo "<p align='center'><font size='2' face='Arial' color='#CC6900'><b>ACCESO A LA INTRANET</b></font></p>";
echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<td><p align='middle'><a href='../../depeca/privada/intranet/inicio/index.php'><img src='../img/logointranet.gif' align='center'></a></p></td>";
echo "</tr>";
echo "<tr>"; 
echo "<td height='37'><p align='middle'><a href='../../depeca/privada/intranet/inicio/index.php'><font size='2' face='Arial' color='#0073B4' >Intranet</font></a></p></td>";
echo "</tr>";
echo "</table></td></tr></table>";

echo "<table>";
echo "<tr><td></td>";
echo "</tr>";
echo "</table>";


abajo();
?>
