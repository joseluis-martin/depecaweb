<?php
require_once("../../../../core/bibliotecaint.inc.php");
include("../../../../core/conexion.inc.php"); //Conexión con la base de datos
arriba("", "asig_docencia", "es", "Asignaci&oacute;n de Docencia");
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Docencia Privada</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>


<BODY 
    BACKGROUND= "./Imagenes/fondo.jpg"
    BGCOLOR="#FFFFFF"
    TEXT="#B9AFA5"
    LINK="#0073B4"
    VLINK="#0073B4"
    ALINK="#0073B4"
>

<?php

$codigo=($_POST['codigo']);
$nombre=($_POST['nombre']);
$nombre_en=($_POST['nombre_en']);
$iniciales=($_POST['iniciales']);
$nivel=($_POST['nivel']);
$creditos_totales=($_POST['creditos_totales']);
$creditos_troncales=($_POST['creditos_troncales']);
$creditos_obligatorias=($_POST['creditos_obligatorias']);
$creditos_optativas=($_POST['creditos_optativas']);
$creditos_libre=($_POST['creditos_libre']);



//process form

$link = Conectarse();

$sql = "INSERT INTO carreras (codigo, nombre,nombre_en, iniciales, nivel, creditos_totales, creditos_troncales, creditos_obligatorias, creditos_optativas, creditos_libre)";

$sql .= "VALUES ('$codigo', '$nombre', '$nombre_en', '$iniciales', '$nivel', '$creditos_totales', '$creditos_troncales', '$creditos_obligatorias', '$creditos_optativas', '$creditos_libre')";

$result = mysql_query($sql);

echo($sql);


echo "<div align='center'>\n";
   echo " <h3>Carrera A&ntilde;adida</font></h3>\n";
   echo "<br><br> \n";
 echo " <span class='generalbluebold'>&lt;&lt;</span> <a href='../../index.php' class='generalbluebold'>Volver</a> \n";
echo "</div>\n";


?>

</body>
</html>

<?php
abajo();
?>