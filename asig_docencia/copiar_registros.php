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
//Modificado por jlmartin para copiar las cargas calculadas según rectorado y las descargas bajo umbral
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

$sql_horas_doc = "select * from horas_docencia where curso='$curso_ant'";    
$resul_horas_doc = mysql_query($sql_horas_doc, $link);
while($row_horas_doc = mysql_fetch_array($resul_horas_doc))
{
    $nif=$row_horas_doc['nif'];
    $cod_asig=$row_horas_doc['cod_asig'];
    $ht1c=$row_horas_doc['HT1C'];$ht1c_totales=$row_horas_doc['HT1C_totales'];
    $hl1c=$row_horas_doc['HL1C'];$hl1c_totales=$row_horas_doc['HL1C_totales'];
    $ht2c=$row_horas_doc['HT2C'];$ht2c_totales=$row_horas_doc['HT2C_totales'];
    $hl2c=$row_horas_doc['HL2C'];$hl2c_totales=$row_horas_doc['HL2C_totales'];
    $hej1c=$row_horas_doc['HEJ1C'];$hej1c_totales=$row_horas_doc['HEJ1C_totales'];
    $hej2c=$row_horas_doc['HEJ2C'];$hej2c_totales=$row_horas_doc['HEJ2C_totales'];

    $ht1ec=$row_horas_doc['HT1EC'];$ht1ec_totales=$row_horas_doc['HT1EC_totales'];
    $hl1ec=$row_horas_doc['HL1EC'];$hl1ec_totales=$row_horas_doc['HL1EC_totales'];
    $ht2ec=$row_horas_doc['HT2EC'];$ht2ec_totales=$row_horas_doc['HT2EC_totales'];
    $hl2ec=$row_horas_doc['HL2EC'];$hl2ec_totales=$row_horas_doc['HL2EC_totales'];
    $hej1ec=$row_horas_doc['HEJ1EC'];$hej1ec_totales=$row_horas_doc['HEJ1EC_totales'];
    $hej2ec=$row_horas_doc['HEJ2EC'];$hej2ec_totales=$row_horas_doc['HEJ2EC_totales'];
    $cod_dpto=$row_horas_doc['cod_dpto'];
    $sqlinsert="INSERT INTO horas_docencia (nif,cod_asig,curso,HT1C,HT1C_totales,HL1C,HL1C_totales,HT2C,HT2C_totales,HL2C,HL2C_totales,HEJ1C,HEJ1C_totales,HEJ2C,HEJ2C_totales,HT1EC,HT1EC_totales,HL1EC,HL1EC_totales,HT2EC,HT2EC_totales,HL2EC,HL2EC_totales,HEJ1EC,HEJ1EC_totales,HEJ2EC,HEJ2EC_totales,cod_dpto) VALUES ('$nif','$cod_asig','$curso','$ht1c','$ht1c_totales','$hl1c','$hl1c_totales','$ht2c','$ht2c_totales','$hl2c','$hl2c_totales','$hej1c','$hej1c_totales','$hej2c','$hej2c_totales','$ht1ec','$ht1ec_totales','$hl1ec','$hl1ec_totales','$ht2ec','$ht2ec_totales','$hl2ec','$hl2ec_totales','$hej1ec','$hej1ec_totales','$hej2ec','$hej2ec_totales','$cod_dpto')";
    $resul=mysql_query($sqlinsert,$link);
 
}


$sql_horas_asig = "select * from horas_asignatura where curso='$curso_ant'";    
$resul_horas_asig = mysql_query($sql_horas_asig, $link);
while($row_horas_asig = mysql_fetch_array($resul_horas_asig))
{
//mocana: anadidos campos horas totales
    $cod_asig=$row_horas_asig['cod_asig'];
    $ht1c=$row_horas_asig['ht1c'];$ht1c_totales=$row_horas_asig['ht1c_totales'];
    $hl1c=$row_horas_asig['hl1c'];$hl1c_totales=$row_horas_asig['hl1c_totales'];
    $ht2c=$row_horas_asig['ht2c'];$ht2c_totales=$row_horas_asig['ht2c_totales'];
    $hl2c=$row_horas_asig['hl2c'];$hl2c_totales=$row_horas_asig['hl2c_totales'];
    $hej1c=$row_horas_asig['hej1c'];$hej1c_totales=$row_horas_asig['hej1c_totales'];
    $hej2c=$row_horas_asig['hej2c'];$hej2c_totales=$row_horas_asig['hej2c_totales'];

//mocana: anadidos campos horas ingles y cod_dpto
    $ht1ec=$row_horas_asig['ht1ec'];$ht1ec_totales=$row_horas_asig['ht1ec_totales'];
    $hl1ec=$row_horas_asig['hl1ec'];$hl1ec_totales=$row_horas_asig['hl1ec_totales'];
    $ht2ec=$row_horas_asig['ht2ec'];$ht2ec_totales=$row_horas_asig['ht2ec_totales'];
    $hl2ec=$row_horas_asig['hl2ec'];$hl2ec_totales=$row_horas_asig['hl2ec_totales'];
    $hej1ec=$row_horas_asig['hej1ec'];$hej1ec_totales=$row_horas_asig['hej1ec_totales'];
    $hej2ec=$row_horas_asig['hej2ec'];$hej2ec_totales=$row_horas_asig['hej2ec_totales'];
    $cod_dpto=$row_horas_asig['cod_dpto'];



    $sqlinsert="INSERT INTO horas_asignatura (cod_asig,curso,ht1c,ht1c_totales,hl1c,hl1c_totales,ht2c,ht2c_totales,hl2c,hl2c_totales,hej1c,hej1c_totales,hej2c,hej2c_totales,ht1ec,ht1ec_totales,hl1ec,hl1ec_totales,ht2ec,ht2ec_totales,hl2ec,hl2ec_totales,hej1ec,hej1ec_totales,hej2ec,hej2ec_totales,cod_dpto) VALUES ('$cod_asig','$curso','$ht1c','$ht1c_totales','$hl1c','$hl1c_totales','$ht2c','$ht2c_totales','$hl2c','$hl2c_totales','$hej1c','$hej1c_totales','$hej2c','$hej2c_totales','$ht1ec','$ht1ec_totales','$hl1ec','$hl1ec_totales','$ht2ec','$ht2ec_totales','$hl2ec','$hl2ec_totales','$hej1ec','$hej1ec_totales','$hej2ec','$hej2ec_totales','$cod_dpto')";
    $resul=mysql_query($sqlinsert,$link);

}



echo"<div align='center'><span class = generalbluebold><br><br>La copia se ha realizado con &eacute;xito<br><br></span></div> \n";
echo "<br><br><br>";

echo"<div align='right'><a href='./index.php?valor2=$curso' class='generalbluebold'><< Volver</a> </div>";


abajo();
?>
