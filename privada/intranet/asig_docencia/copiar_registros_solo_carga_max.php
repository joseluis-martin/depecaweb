<?php
require_once("../../core/bibliotecaint.inc.php");
include("../../core/conexion.inc.php"); //Conexión con la base de datos
arriba("", "asig_docencia", "es", "Asignaci&oacute;n de Docencia");
session_start();

$user=$_SESSION['user'];

$curso=$_GET['curso'];
$anio1=substr($curso,0,4);
$curso_ant=($anio1-1)."/".$anio1;



$link = Conectarse();
$sql_cargas = "select * from cargas_max where curso='$curso_ant'";    
$resul_cargas = mysql_query($sql_cargas, $link);
while($row_cargas = mysql_fetch_array($resul_cargas))
{
    $nif=$row_cargas['nif'];
    $cargamax=$row_cargas['cargamax'];
    $cargamax_total=$row_cargas['cargamax_total'];
    $carga_rectorado=$row_cargas['carga_rectorado'];
    $situacion_academica=$row_cargas['situacion_academica'];
    $horas_bajo_umbral=$row_cargas['horas_bajo_umbral'];
    $horas_bajo_umbral_max=$row_cargas['horas_bajo_umbral_max'];
    $sqlinsert="INSERT INTO cargas_max (nif,cargamax,cargamax_total,carga_rectorado,curso,situacion_academica,horas_bajo_umbral,horas_bajo_umbral_max) VALUES ('$nif','$cargamax','$cargamax_total','$carga_rectorado','$curso','$situacion_academica','$horas_bajo_umbral','$horas_bajo_umbral_max')";
    $resul=mysql_query($sqlinsert,$link);
}



echo"<div align='center'><span class = generalbluebold><br><br>La copia se ha realizado con &eacute;xito<br><br></span></div> \n";
echo "<br><br><br>";

echo"<div align='right'><a href='./index.php?valor2=$curso' class='generalbluebold'><< Volver</a> </div>";


abajo();
?>
