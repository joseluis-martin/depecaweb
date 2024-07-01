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
$iniciales=($_POST['iniciales']);
$nivel=($_POST['nivel']);
$creditos_totales=($_POST['creditos_totales']);
$creditos_obligatorias=($_POST['obligatorias']);
$creditos_optativa=($_POST['creditos_optativas']);
$formacion_basica=($_POST['formacion_basica']);


//process form

$link = Conectarse();

$sql = "INSERT INTO carreras (codigo, nombre, iniciales, nivel, creditos_totales, creditos_obligatorias, creditos_optativas,formacion_basica)";

$sql .= "VALUES ('$codigo', '$nombre', '$iniciales', '$nivel', '$creditos_totales', '$creditos_obligatorias', '$creditos_optativa','$formacion_basica')";

$result = mysql_query($sql);




echo "<div align='center'>\n";
   echo " <h3>Carrera A&ntilde;adida</font></h3>\n";
   echo "<br><br> \n";
 echo " <span class='generalbluebold'>&lt;&lt;</span> <a href='./addcarreraprue.php' class='generalbluebold'>Volver</a> \n";
echo "</div>\n";


?>

</body>
</html>

<?php
abajo();
?>