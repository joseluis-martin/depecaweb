<?php
require_once("../../core/bibliotecaint.inc.php");
include("../../core/conexion.inc.php"); //Conexión con la base de datos
arriba("", "asig_docencia", "es", "Asignaci&oacute;n de Docencia");
?>



<html>

<body style="color:#0073B4" background="./Imagenes/fondo.jpg">


<table width="100%" border="0">
  <tr>
    <td width="45%" height="33"> 
      <h3>Pesonal Privada</h3></td>
    <td width="55%"><div align="right"><span class="generalbluebold">Personal</span>
	<a href="./formularios/personal/addpersonal.php"><span class="generalbluebold">[ Add </span></a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
	<a href="./formularios/personal/editpersonal.php><span class="generalbluebold">Edit</span></a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
	<a href="./formularios/personal/deletepersonal.php"><span class="generalbluebold">Delete ]</span></a> </div></td>
  </tr>
</table>

<?php



$link = Conectarse();


//Director 


$sql = "SELECT * FROM personal WHERE puesto LIKE 'Director' ORDER BY apellidos";

$result = mysql_query($sql, $link);

echo "<b><font size='2' face='Tahoma'>Director</font></b>\n";

echo "<br>\r";

if ($row = mysql_fetch_array($result)){

echo "<table border = '0'> \n";

echo "<tr> \n";

echo "<td align='center' bgcolor='#DCC891'><b><font color='#FFFFFF' size='2' face='Arial'>Nombre</font></b></td> \n";

echo "<td align='center' bgcolor='#DCC891'><b><font color='#FFFFFF' size='2' face='Arial'>Apellidos</font></b></td> \n";

echo "<td align='center' bgcolor='#DCC891'><b><font color='#FFFFFF' size='2' face='Arial'>Telefono</font></b></td> \n";

echo "<td align='center' bgcolor='#DCC891'><b><font color='#FFFFFF' size='2' face='Arial'>Email</font></b></td> \n";

echo "<td align='center 'bgcolor='#DCC891'><b><font color='#FFFFFF' size='2' face='Arial'>Datos</font></b></td> \n";

echo "</tr> \n";

do {

echo "<tr> \n";

echo "<td bgcolor='#B9AFA5'><b><font color='#FFFFFF' size='2' face='Arial'>".$row["nombre"]."</font></b></td> \n";

echo "<td bgcolor='#B9AFA5'><b><font color='#FFFFFF' size='2' face='Arial'>".$row["apellidos"]."</font></b></td>\n";

echo "<td bgcolor='#B9AFA5'><b><font color='#FFFFFF' size='2' face='Arial'>+34 91884".$row["telefono_universidad"]."</font></b></td>\n";

echo "<td bgcolor='#B9AFA5'><font color='#FFFFFF' size='2' face='Arial'><a href='mailto:".$row["email"]."'>".$row["email"]."</a></font></td> \n"; 

echo "<td bgcolor='#B9AFA5'><b><font color='#FFFFFF' size='2' face='Arial'><a href='mostrarDatos.php?apellidos=".$row["apellidos"]."&cargo=".$row["cargo"]."'>Ver Ficha</a></font></b></td> \n"; 


echo "</tr> \n";

} while ($row = mysql_fetch_array($result));

echo "</table> \n";

echo "<br>\r";

} else {

echo "¡ La base de datos está vacia !";

}



//Subdirector


$sql = "SELECT * FROM personal WHERE puesto LIKE 'Subdirector' ORDER BY apellidos";

$result = mysql_query($sql, $link);

echo "<b><font size='2' face='Tahoma'>Subirector</font></b>\n";

echo "<br>\r";


if ($row = mysql_fetch_array($result)){

echo "<table border = '0'> \n";

echo "<tr> \n";

echo "<td align='center' bgcolor='#DCC891'><b><font color='#FFFFFF' size='2' face='Arial'>Nombre</font></b></td> \n";

echo "<td align='center' bgcolor='#DCC891'><b><font color='#FFFFFF' size='2' face='Arial'>Apellidos</font></b></td> \n";

echo "<td align='center' bgcolor='#DCC891'><b><font color='#FFFFFF' size='2' face='Arial'>Telefono</font></b></td> \n";

echo "<td align='center' bgcolor='#DCC891'><b><font color='#FFFFFF' size='2' face='Arial'>Email</font></b></td> \n";

echo "<td align='center 'bgcolor='#DCC891'><b><font color='#FFFFFF' size='2' face='Arial'>Datos</font></b></td> \n";

echo "</tr> \n";

do {

echo "<tr> \n";

echo "<td bgcolor='#B9AFA5'><b><font color='#FFFFFF' size='2' face='Arial'>".$row["nombre"]."</font></b></td> \n";

echo "<td bgcolor='#B9AFA5'><b><font color='#FFFFFF' size='2' face='Arial'>".$row["apellidos"]."</font></b></td>\n";

echo "<td bgcolor='#B9AFA5'><b><font color='#FFFFFF' size='2' face='Arial'>+34 91884".$row["telefono_universidad"]."</font></b></td>\n";

echo "<td bgcolor='#B9AFA5'><font color='#FFFFFF' size='2' face='Arial'><a href='mailto:".$row["email"]."'>".$row["email"]."</a></font></td> \n"; 

echo "<td bgcolor='#B9AFA5'><b><font color='#FFFFFF' size='2' face='Arial'><a href='mostrarDatos.php?apellidos=".$row["apellidos"]."&cargo=".$row["cargo"]."'>Ver Ficha</a></font></b></td> \n"; 


echo "</tr> \n";


} while ($row = mysql_fetch_array($result));

echo "</table> \n";

echo "<br>\r";

} else {

echo "¡ La base de datos está vacia !";

}


//Secretario


$sql = "SELECT * FROM personal WHERE puesto LIKE 'Secretario' ORDER BY apellidos";

$result = mysql_query($sql, $link);

echo "<b><font size='2' face='Tahoma'>Secretario</font></b>\n";

echo "<br>\r";

if ($row = mysql_fetch_array($result)){

echo "<table border = '0'> \n";

echo "<tr> \n";

echo "<td align='center' bgcolor='#DCC891'><b><font color='#FFFFFF' size='2' face='Arial'>Nombre</font></b></td> \n";

echo "<td align='center' bgcolor='#DCC891'><b><font color='#FFFFFF' size='2' face='Arial'>Apellidos</font></b></td> \n";

echo "<td align='center' bgcolor='#DCC891'><b><font color='#FFFFFF' size='2' face='Arial'>Telefono</font></b></td> \n";

echo "<td align='center' bgcolor='#DCC891'><b><font color='#FFFFFF' size='2' face='Arial'>Email</font></b></td> \n";

echo "<td align='center 'bgcolor='#DCC891'><b><font color='#FFFFFF' size='2' face='Arial'>Datos</font></b></td> \n";

echo "</tr> \n";

do {

echo "<tr> \n";
 
echo "<td bgcolor='#B9AFA5'><b><font color='#FFFFFF' size='2' face='Arial'>".$row["nombre"]."</font></b></td> \n";

echo "<td bgcolor='#B9AFA5'><b><font color='#FFFFFF' size='2' face='Arial'>".$row["apellidos"]."</font></b></td>\n";

echo "<td bgcolor='#B9AFA5'><b><font color='#FFFFFF' size='2' face='Arial'>+34 91884".$row["telefono_universidad"]."</font></b></td>\n";

echo "<td bgcolor='#B9AFA5'><font color='#FFFFFF' size='2' face='Arial'><a href='mailto:".$row["email"]."'>".$row["email"]."</a></font></td> \n"; 

echo "<td bgcolor='#B9AFA5'><b><font color='#FFFFFF' size='2' face='Arial'><a href='mostrarDatos.php?apellidos=".$row["apellidos"]."&cargo=".$row["cargo"]."'>Ver Ficha</a></font></b></td> \n"; 


echo "</tr> \n";

} while ($row = mysql_fetch_array($result));

echo "</table> \n";

echo "<br>\r";

} else {

echo "¡ La base de datos está vacia !";

}


//Catedráticos de Universidad CU


$sql = "SELECT * FROM personal WHERE cargo LIKE 'CEU' ORDER BY apellidos";

$result = mysql_query($sql, $link);

echo "<b><font size='2' face='Tahoma'>Catedr&aacute;ticos de Universidad</font></b>\n";

echo "<br>\r";


if ($row = mysql_fetch_array($result)){

echo "<table border = '0'> \n";

echo "<tr> \n";

echo "<td align='center' bgcolor='#DCC891'><b><font color='#FFFFFF' size='2' face='Arial'>Nombre</font></b></td> \n";

echo "<td align='center' bgcolor='#DCC891'><b><font color='#FFFFFF' size='2' face='Arial'>Apellidos</font></b></td> \n";

echo "<td align='center' bgcolor='#DCC891'><b><font color='#FFFFFF' size='2' face='Arial'>Telefono</font></b></td> \n";

echo "<td align='center' bgcolor='#DCC891'><b><font color='#FFFFFF' size='2' face='Arial'>Email</font></b></td> \n";

echo "<td align='center 'bgcolor='#DCC891'><b><font color='#FFFFFF' size='2' face='Arial'>Datos</font></b></td> \n";

echo "</tr> \n";

do {


echo "<tr> \n";
 
echo "<td bgcolor='#B9AFA5'><b><font color='#FFFFFF' size='2' face='Arial'>".$row["nombre"]."</font></b></td> \n";

echo "<td bgcolor='#B9AFA5'><b><font color='#FFFFFF' size='2' face='Arial'>".$row["apellidos"]."</font></b></td>\n";

echo "<td bgcolor='#B9AFA5'><b><font color='#FFFFFF' size='2' face='Arial'>+34 91884".$row["telefono_universidad"]."</font></b></td>\n";

echo "<td bgcolor='#B9AFA5'><font color='#FFFFFF' size='2' face='Arial'><a href='mailto:".$row["email"]."'>".$row["email"]."</a></font></td> \n"; 

echo "<td bgcolor='#B9AFA5'><b><font color='#FFFFFF' size='2' face='Arial'><a href='mostrarDatos.php?apellidos=".$row["apellidos"]."&cargo=".$row["cargo"]."'>Ver Ficha</a></font></b></td> \n"; 

echo "</tr> \n";

echo "<tr> \n";
 
echo "<td><b><font color='#FFFFFF' size='2' face='Arial'>  </font></b></td> \n";

echo "<td><b><font color='#FFFFFF' size='2' face='Arial'>  </font></b></td>\n";

echo "<td><b><font color='#FFFFFF' size='2' face='Arial'>  </font></b></td>\n";

echo "<td><b><font color='#FFFFFF' size='2' face='Arial'>  </a></font></b></td> \n"; 

echo "<td><b><font color='#FFFFFF' size='2' face='Arial'>  </a></font></b></td> \n"; 

echo "</tr> \n";

} while ($row = mysql_fetch_array($result));

echo "</table> \n";

echo "<br>\r";

} else {

echo "¡ La base de datos está vacia !";

}



//Catedráticos de Escuela Universitaria CEU


$sql = "SELECT * FROM personal WHERE cargo LIKE 'CU' ORDER BY apellidos";

$result = mysql_query($sql, $link);

echo "<b><font size='2' face='Tahoma'>Catedr&aacute;ticos de Escuela Universitaria</font></b>\n";

echo "<br>\r";

if ($row = mysql_fetch_array($result)){
echo "<table border = '0'> \n";

echo "<tr> \n";

echo "<td align='center' bgcolor='#DCC891'><b><font color='#FFFFFF' size='2' face='Arial'>Nombre</font></b></td> \n";

echo "<td align='center' bgcolor='#DCC891'><b><font color='#FFFFFF' size='2' face='Arial'>Apellidos</font></b></td> \n";

echo "<td align='center' bgcolor='#DCC891'><b><font color='#FFFFFF' size='2' face='Arial'>Telefono</font></b></td> \n";

echo "<td align='center' bgcolor='#DCC891'><b><font color='#FFFFFF' size='2' face='Arial'>Email</font></b></td> \n";

echo "<td align='center 'bgcolor='#DCC891'><b><font color='#FFFFFF' size='2' face='Arial'>Datos</font></b></td> \n";

echo "</tr> \n";

do {


echo "<tr> \n";
 
echo "<td bgcolor='#B9AFA5'><b><font color='#FFFFFF' size='2' face='Arial'>".$row["nombre"]."</font></b></td> \n";

echo "<td bgcolor='#B9AFA5'><b><font color='#FFFFFF' size='2' face='Arial'>".$row["apellidos"]."</font></b></td>\n";

echo "<td bgcolor='#B9AFA5'><b><font color='#FFFFFF' size='2' face='Arial'>+34 91884".$row["telefono_universidad"]."</font></b></td>\n";

echo "<td bgcolor='#B9AFA5'><font color='#FFFFFF' size='2' face='Arial'><a href='mailto:".$row["email"]."'>".$row["email"]."</a></font></td> \n"; 

echo "<td bgcolor='#B9AFA5'><b><font color='#FFFFFF' size='2' face='Arial'><a href='mostrarDatos.php?apellidos=".$row["apellidos"]."&cargo=".$row["cargo"]."'>Ver Ficha</a></font></b></td> \n"; 

echo "</tr> \n";

echo "<tr> \n";
 
echo "<td><b><font color='#FFFFFF' size='2' face='Arial'>  </font></b></td> \n";

echo "<td><b><font color='#FFFFFF' size='2' face='Arial'>  </font></b></td>\n";

echo "<td><b><font color='#FFFFFF' size='2' face='Arial'>  </font></b></td>\n";

echo "<td><b><font color='#FFFFFF' size='2' face='Arial'>  </a></font></b></td> \n"; 

echo "<td><b><font color='#FFFFFF' size='2' face='Arial'>  </a></font></b></td> \n"; 

echo "</tr> \n";


} while ($row = mysql_fetch_array($result));

echo "</table> \n";

echo "<br>\r";

} else {

echo "¡ La base de datos está vacia !";

}


//Titulares de Universidad TU

$sql = "SELECT * FROM personal WHERE cargo LIKE 'TU' ORDER BY apellidos";

$result = mysql_query($sql, $link);

echo "<b><font size='2' face='Tahoma'>Titulares de Universidad</font></b>\n";

echo "<br>\r";


if ($row = mysql_fetch_array($result)){

echo "<table border = '0'> \n";

echo "<tr> \n";

echo "<td align='center' bgcolor='#DCC891'><b><font color='#FFFFFF' size='2' face='Arial'>Nombre</font></b></td> \n";

echo "<td align='center' bgcolor='#DCC891'><b><font color='#FFFFFF' size='2' face='Arial'>Apellidos</font></b></td> \n";

echo "<td align='center' bgcolor='#DCC891'><b><font color='#FFFFFF' size='2' face='Arial'>Telefono</font></b></td> \n";

echo "<td align='center' bgcolor='#DCC891'><b><font color='#FFFFFF' size='2' face='Arial'>Email</font></b></td> \n";

echo "<td align='center 'bgcolor='#DCC891'><b><font color='#FFFFFF' size='2' face='Arial'>Datos</font></b></td> \n";

echo "</tr> \n";

do {


echo "<tr> \n";
 
echo "<td bgcolor='#B9AFA5'><b><font color='#FFFFFF' size='2' face='Arial'>".$row["nombre"]."</font></b></td> \n";

echo "<td bgcolor='#B9AFA5'><b><font color='#FFFFFF' size='2' face='Arial'>".$row["apellidos"]."</font></b></td>\n";

echo "<td bgcolor='#B9AFA5'><b><font color='#FFFFFF' size='2' face='Arial'>+34 91884".$row["telefono_universidad"]."</font></b></td>\n";

echo "<td bgcolor='#B9AFA5'><font color='#FFFFFF' size='2' face='Arial'><a href='mailto:".$row["email"]."'>".$row["email"]."</a></font></td> \n"; 

echo "<td bgcolor='#B9AFA5'><b><font color='#FFFFFF' size='2' face='Arial'><a href='mostrarDatos.php?apellidos=".$row["apellidos"]."&cargo=".$row["cargo"]."'>Ver Ficha</a></font></b></td> \n"; 

echo "</tr> \n";

echo "<tr> \n";
 
echo "<td><b><font color='#FFFFFF' size='2' face='Arial'>  </font></b></td> \n";

echo "<td><b><font color='#FFFFFF' size='2' face='Arial'>  </font></b></td>\n";

echo "<td><b><font color='#FFFFFF' size='2' face='Arial'>  </font></b></td>\n";

echo "<td><b><font color='#FFFFFF' size='2' face='Arial'>  </a></font></b></td> \n"; 

echo "<td><b><font color='#FFFFFF' size='2' face='Arial'>  </a></font></b></td> \n"; 

echo "</tr> \n";


} while ($row = mysql_fetch_array($result));

echo "</table> \n";

echo "<br>\r";

} else {

echo "¡ La base de datos está vacia !";

}


//Titularies de Universidad Interinos TUI

$sql = "SELECT * FROM personal WHERE cargo LIKE 'TUI' ORDER BY apellidos";

$result = mysql_query($sql, $link);

echo "<b><font size='2' face='Tahoma'>Titulares de Universidad Interinos</font></b>\n";

echo "<br>\r";

if ($row = mysql_fetch_array($result)){

echo "<table border = '0'> \n";

echo "<tr> \n";

echo "<td align='center' bgcolor='#DCC891'><b><font color='#FFFFFF' size='2' face='Arial'>Nombre</font></b></td> \n";

echo "<td align='center' bgcolor='#DCC891'><b><font color='#FFFFFF' size='2' face='Arial'>Apellidos</font></b></td> \n";

echo "<td align='center' bgcolor='#DCC891'><b><font color='#FFFFFF' size='2' face='Arial'>Telefono</font></b></td> \n";

echo "<td align='center' bgcolor='#DCC891'><b><font color='#FFFFFF' size='2' face='Arial'>Email</font></b></td> \n";

echo "<td align='center 'bgcolor='#DCC891'><b><font color='#FFFFFF' size='2' face='Arial'>Datos</font></b></td> \n";

echo "</tr> \n";

do {


echo "<tr> \n";
 
echo "<td bgcolor='#B9AFA5'><b><font color='#FFFFFF' size='2' face='Arial'>".$row["nombre"]."</font></b></td> \n";

echo "<td bgcolor='#B9AFA5'><b><font color='#FFFFFF' size='2' face='Arial'>".$row["apellidos"]."</font></b></td>\n";

echo "<td bgcolor='#B9AFA5'><b><font color='#FFFFFF' size='2' face='Arial'>+34 91884".$row["telefono_universidad"]."</font></b></td>\n";

echo "<td bgcolor='#B9AFA5'><font color='#FFFFFF' size='2' face='Arial'><a href='mailto:".$row["email"]."'>".$row["email"]."</a></font></td> \n"; 

echo "<td bgcolor='#B9AFA5'><b><font color='#FFFFFF' size='2' face='Arial'><a href='mostrarDatos.php?apellidos=".$row["apellidos"]."&cargo=".$row["cargo"]."'>Ver Ficha</a></font></b></td> \n"; 

echo "</tr> \n";

echo "<tr> \n";
 
echo "<td><b><font color='#FFFFFF' size='2' face='Arial'>  </font></b></td> \n";

echo "<td><b><font color='#FFFFFF' size='2' face='Arial'>  </font></b></td>\n";

echo "<td><b><font color='#FFFFFF' size='2' face='Arial'>  </font></b></td>\n";

echo "<td><b><font color='#FFFFFF' size='2' face='Arial'>  </a></font></b></td> \n"; 

echo "<td><b><font color='#FFFFFF' size='2' face='Arial'>  </a></font></b></td> \n"; 

echo "</tr> \n";

} while ($row = mysql_fetch_array($result));

echo "</table> \n";

echo "<br>\r";

} else {

echo "¡ La base de datos está vacia !";

}

//Titulares de Escuela Universitaria TEU

$sql = "SELECT * FROM personal WHERE cargo LIKE 'TEU' ORDER BY apellidos";

$result = mysql_query($sql, $link);

echo "<b><font size='2' face='Tahoma'>Titulares de Escuela Universitaria</font></b>\n";

echo "<br>\r";

if ($row = mysql_fetch_array($result)){

echo "<table border = '0'> \n";

echo "<tr> \n";

echo "<td align='center' bgcolor='#DCC891'><b><font color='#FFFFFF' size='2' face='Arial'>Nombre</font></b></td> \n";

echo "<td align='center' bgcolor='#DCC891'><b><font color='#FFFFFF' size='2' face='Arial'>Apellidos</font></b></td> \n";

echo "<td align='center' bgcolor='#DCC891'><b><font color='#FFFFFF' size='2' face='Arial'>Telefono</font></b></td> \n";

echo "<td align='center' bgcolor='#DCC891'><b><font color='#FFFFFF' size='2' face='Arial'>Email</font></b></td> \n";

echo "<td align='center 'bgcolor='#DCC891'><b><font color='#FFFFFF' size='2' face='Arial'>Datos</font></b></td> \n";

echo "</tr> \n";

do {


echo "<tr> \n";
 
echo "<td bgcolor='#B9AFA5'><b><font color='#FFFFFF' size='2' face='Arial'>".$row["nombre"]."</font></b></td> \n";

echo "<td bgcolor='#B9AFA5'><b><font color='#FFFFFF' size='2' face='Arial'>".$row["apellidos"]."</font></b></td>\n";

echo "<td bgcolor='#B9AFA5'><b><font color='#FFFFFF' size='2' face='Arial'>+34 91884".$row["telefono_universidad"]."</font></b></td>\n";

echo "<td bgcolor='#B9AFA5'><font color='#FFFFFF' size='2' face='Arial'><a href='mailto:".$row["email"]."'>".$row["email"]."</a></font></td> \n"; 

echo "<td bgcolor='#B9AFA5'><b><font color='#FFFFFF' size='2' face='Arial'><a href='mostrarDatos.php?apellidos=".$row["apellidos"]."&cargo=".$row["cargo"]."'>Ver Ficha</a></font></b></td> \n"; 

echo "</tr> \n";

echo "<tr> \n";
 
echo "<td><b><font color='#FFFFFF' size='2' face='Arial'>  </font></b></td> \n";

echo "<td><b><font color='#FFFFFF' size='2' face='Arial'>  </font></b></td>\n";

echo "<td><b><font color='#FFFFFF' size='2' face='Arial'>  </font></b></td>\n";

echo "<td><b><font color='#FFFFFF' size='2' face='Arial'>  </a></font></b></td> \n"; 

echo "<td><b><font color='#FFFFFF' size='2' face='Arial'>  </a></font></b></td> \n"; 

echo "</tr> \n";

} while ($row = mysql_fetch_array($result));

echo "</table> \n";

echo "<br>\r";

} else {

echo "¡ La base de datos está vacia !";

}


//Titulares de Escuela Universitaria Intertinos TEUI

$sql = "SELECT * FROM personal WHERE cargo LIKE 'TEUI' ORDER BY apellidos";

$result = mysql_query($sql, $link);

echo "<b><font size='2' face='Tahoma'>Titulares de Escuela Universitaria Interinos</font></b>\n";

echo "<br>\r";

if ($row = mysql_fetch_array($result)){

echo "<table border = '0'> \n";

echo "<tr> \n";

echo "<td align='center' bgcolor='#DCC891'><b><font color='#FFFFFF' size='2' face='Arial'>Nombre</font></b></td> \n";

echo "<td align='center' bgcolor='#DCC891'><b><font color='#FFFFFF' size='2' face='Arial'>Apellidos</font></b></td> \n";

echo "<td align='center' bgcolor='#DCC891'><b><font color='#FFFFFF' size='2' face='Arial'>Telefono</font></b></td> \n";

echo "<td align='center' bgcolor='#DCC891'><b><font color='#FFFFFF' size='2' face='Arial'>Email</font></b></td> \n";

echo "<td align='center 'bgcolor='#DCC891'><b><font color='#FFFFFF' size='2' face='Arial'>Datos</font></b></td> \n";

echo "</tr> \n";

do {


echo "<tr> \n";
 
echo "<td bgcolor='#B9AFA5'><b><font color='#FFFFFF' size='2' face='Arial'>".$row["nombre"]."</font></b></td> \n";

echo "<td bgcolor='#B9AFA5'><b><font color='#FFFFFF' size='2' face='Arial'>".$row["apellidos"]."</font></b></td>\n";

echo "<td bgcolor='#B9AFA5'><b><font color='#FFFFFF' size='2' face='Arial'>+34 91884".$row["telefono_universidad"]."</font></b></td>\n";

echo "<td bgcolor='#B9AFA5'><font color='#FFFFFF' size='2' face='Arial'><a href='mailto:".$row["email"]."'>".$row["email"]."</a></font></td> \n"; 

echo "<td bgcolor='#B9AFA5'><b><font color='#FFFFFF' size='2' face='Arial'><a href='mostrarDatos.php?apellidos=".$row["apellidos"]."&cargo=".$row["cargo"]."'>Ver Ficha</a></font></b></td> \n"; 

echo "</tr> \n";

echo "<tr> \n";
 
echo "<td><b><font color='#FFFFFF' size='2' face='Arial'>  </font></b></td> \n";

echo "<td><b><font color='#FFFFFF' size='2' face='Arial'>  </font></b></td>\n";

echo "<td><b><font color='#FFFFFF' size='2' face='Arial'>  </font></b></td>\n";

echo "<td><b><font color='#FFFFFF' size='2' face='Arial'>  </a></font></b></td> \n"; 

echo "<td><b><font color='#FFFFFF' size='2' face='Arial'>  </a></font></b></td> \n"; 

echo "</tr> \n";


} while ($row = mysql_fetch_array($result));

echo "</table> \n";

echo "<br>\r";

} else {

echo "¡ La base de datos está vacia !";

}


//Profesores Colaboradores COL

$sql = "SELECT * FROM personal WHERE cargo LIKE 'COL' ORDER BY apellidos";

$result = mysql_query($sql, $link);

echo "<b><font size='2' face='Tahoma'>Profesores Colaboradores</font></b>\n";

echo "<br>\r";

if ($row = mysql_fetch_array($result)){

echo "<table border = '0'> \n";

echo "<tr> \n";

echo "<td align='center' bgcolor='#DCC891'><b><font color='#FFFFFF' size='2' face='Arial'>Nombre</font></b></td> \n";

echo "<td align='center' bgcolor='#DCC891'><b><font color='#FFFFFF' size='2' face='Arial'>Apellidos</font></b></td> \n";

echo "<td align='center' bgcolor='#DCC891'><b><font color='#FFFFFF' size='2' face='Arial'>Telefono</font></b></td> \n";

echo "<td align='center' bgcolor='#DCC891'><b><font color='#FFFFFF' size='2' face='Arial'>Email</font></b></td> \n";

echo "<td align='center 'bgcolor='#DCC891'><b><font color='#FFFFFF' size='2' face='Arial'>Datos</font></b></td> \n";

echo "</tr> \n";

do {


echo "<tr> \n";
 
echo "<td bgcolor='#B9AFA5'><b><font color='#FFFFFF' size='2' face='Arial'>".$row["nombre"]."</font></b></td> \n";

echo "<td bgcolor='#B9AFA5'><b><font color='#FFFFFF' size='2' face='Arial'>".$row["apellidos"]."</font></b></td>\n";

echo "<td bgcolor='#B9AFA5'><b><font color='#FFFFFF' size='2' face='Arial'>+34 91884".$row["telefono_universidad"]."</font></b></td>\n";

echo "<td bgcolor='#B9AFA5'><font color='#FFFFFF' size='2' face='Arial'><a href='mailto:".$row["email"]."'>".$row["email"]."</a></font></td> \n"; 

echo "<td bgcolor='#B9AFA5'><b><font color='#FFFFFF' size='2' face='Arial'><a href='mostrarDatos.php?apellidos=".$row["apellidos"]."&cargo=".$row["cargo"]."'>Ver Ficha</a></font></b></td> \n"; 

echo "</tr> \n";

echo "<tr> \n";
 
echo "<td><b><font color='#FFFFFF' size='2' face='Arial'>  </font></b></td> \n";

echo "<td><b><font color='#FFFFFF' size='2' face='Arial'>  </font></b></td>\n";

echo "<td><b><font color='#FFFFFF' size='2' face='Arial'>  </font></b></td>\n";

echo "<td><b><font color='#FFFFFF' size='2' face='Arial'>  </a></font></b></td> \n"; 

echo "<td><b><font color='#FFFFFF' size='2' face='Arial'>  </a></font></b></td> \n"; 

echo "</tr> \n";

} while ($row = mysql_fetch_array($result));

echo "</table> \n";

echo "<br>\r";

} else {

echo "¡ La base de datos está vacia !";

}


//Profesores Ayudantes AY

$sql = "SELECT * FROM personal WHERE cargo LIKE 'AY' ORDER BY apellidos";

$result = mysql_query($sql, $link);

echo "<b><font size='2' face='Tahoma'>Profesores Ayudantes</font></b>\n";

echo "<br>\r";

if ($row = mysql_fetch_array($result)){

echo "<table border = '0'> \n";

echo "<tr> \n";

echo "<td align='center' bgcolor='#DCC891'><b><font color='#FFFFFF' size='2' face='Arial'>Nombre</font></b></td> \n";

echo "<td align='center' bgcolor='#DCC891'><b><font color='#FFFFFF' size='2' face='Arial'>Apellidos</font></b></td> \n";

echo "<td align='center' bgcolor='#DCC891'><b><font color='#FFFFFF' size='2' face='Arial'>Telefono</font></b></td> \n";

echo "<td align='center' bgcolor='#DCC891'><b><font color='#FFFFFF' size='2' face='Arial'>Email</font></b></td> \n";

echo "<td align='center 'bgcolor='#DCC891'><b><font color='#FFFFFF' size='2' face='Arial'>Datos</font></b></td> \n";

echo "</tr> \n";

do {


echo "<tr> \n";
 
echo "<td bgcolor='#B9AFA5'><b><font color='#FFFFFF' size='2' face='Arial'>".$row["nombre"]."</font></b></td> \n";

echo "<td bgcolor='#B9AFA5'><b><font color='#FFFFFF' size='2' face='Arial'>".$row["apellidos"]."</font></b></td>\n";

echo "<td bgcolor='#B9AFA5'><b><font color='#FFFFFF' size='2' face='Arial'>+34 91884".$row["telefono_universidad"]."</font></b></td>\n";

echo "<td bgcolor='#B9AFA5'><font color='#FFFFFF' size='2' face='Arial'><a href='mailto:".$row["email"]."'>".$row["email"]."</a></font></td> \n"; 

echo "<td bgcolor='#B9AFA5'><b><font color='#FFFFFF' size='2' face='Arial'><a href='mostrarDatos.php?apellidos=".$row["apellidos"]."&cargo=".$row["cargo"]."'>Ver Ficha</a></font></b></td> \n"; 

echo "</tr> \n";

echo "<tr> \n";
 
echo "<td><b><font color='#FFFFFF' size='2' face='Arial'>  </font></b></td> \n";

echo "<td><b><font color='#FFFFFF' size='2' face='Arial'>  </font></b></td>\n";

echo "<td><b><font color='#FFFFFF' size='2' face='Arial'>  </font></b></td>\n";

echo "<td><b><font color='#FFFFFF' size='2' face='Arial'>  </a></font></b></td> \n"; 

echo "<td><b><font color='#FFFFFF' size='2' face='Arial'>  </a></font></b></td> \n"; 

echo "</tr> \n";

} while ($row = mysql_fetch_array($result));

echo "</table> \n";

echo "<br>\r";

} else {

echo "¡ La base de datos está vacia !";

}


//Asociados AS


$sql = "SELECT * FROM personal WHERE cargo LIKE 'AS' ORDER BY apellidos";

$result = mysql_query($sql, $link);

echo "<b><font size='2' face='Tahoma'>Profesores Asociados</font></b>\n";

echo "<br>\r";

if ($row = mysql_fetch_array($result)){

echo "<table border = '0'> \n";

echo "<tr> \n";

echo "<td align='center' bgcolor='#DCC891'><b><font color='#FFFFFF' size='2' face='Arial'>Nombre</font></b></td> \n";

echo "<td align='center' bgcolor='#DCC891'><b><font color='#FFFFFF' size='2' face='Arial'>Apellidos</font></b></td> \n";

echo "<td align='center' bgcolor='#DCC891'><b><font color='#FFFFFF' size='2' face='Arial'>Telefono</font></b></td> \n";

echo "<td align='center' bgcolor='#DCC891'><b><font color='#FFFFFF' size='2' face='Arial'>Email</font></b></td> \n";

echo "<td align='center 'bgcolor='#DCC891'><b><font color='#FFFFFF' size='2' face='Arial'>Datos</font></b></td> \n";

echo "</tr> \n";

do {


echo "<tr> \n";
 
echo "<td bgcolor='#B9AFA5'><b><font color='#FFFFFF' size='2' face='Arial'>".$row["nombre"]."</font></b></td> \n";

echo "<td bgcolor='#B9AFA5'><b><font color='#FFFFFF' size='2' face='Arial'>".$row["apellidos"]."</font></b></td>\n";

echo "<td bgcolor='#B9AFA5'><b><font color='#FFFFFF' size='2' face='Arial'>+34 91884".$row["telefono_universidad"]."</font></b></td>\n";

echo "<td bgcolor='#B9AFA5'><font color='#FFFFFF' size='2' face='Arial'><a href='mailto:".$row["email"]."'>".$row["email"]."</a></font></td> \n"; 

echo "<td bgcolor='#B9AFA5'><b><font color='#FFFFFF' size='2' face='Arial'><a href='mostrarDatos.php?apellidos=".$row["apellidos"]."&cargo=".$row["cargo"]."'>Ver Ficha</a></font></b></td> \n"; 

echo "</tr> \n";

echo "<tr> \n";
 
echo "<td><b><font color='#FFFFFF' size='2' face='Arial'>  </font></b></td> \n";

echo "<td><b><font color='#FFFFFF' size='2' face='Arial'>  </font></b></td>\n";

echo "<td><b><font color='#FFFFFF' size='2' face='Arial'>  </font></b></td>\n";

echo "<td><b><font color='#FFFFFF' size='2' face='Arial'>  </a></font></b></td> \n"; 

echo "<td><b><font color='#FFFFFF' size='2' face='Arial'>  </a></font></b></td> \n"; 

echo "</tr> \n";

} while ($row = mysql_fetch_array($result));

echo "</table> \n";

echo "<br>\r";

} else {

echo "¡ La base de datos está vacia !";

}

//Personal de Administración y Servicios


$sql = "SELECT * FROM personal WHERE cargo LIKE 'PAS' ORDER BY apellidos";

$result = mysql_query($sql, $link);

echo "<b><font size='2' face='Tahoma'>Personal de Administraci&oacute;n y Servicios</font></b>\n";

echo "<br>\r";

if ($row = mysql_fetch_array($result)){

echo "<table border = '0'> \n";

echo "<tr> \n";

echo "<td align='center' bgcolor='#DCC891'><b><font color='#FFFFFF' size='2' face='Arial'>Nombre</font></b></td> \n";

echo "<td align='center' bgcolor='#DCC891'><b><font color='#FFFFFF' size='2' face='Arial'>Apellidos</font></b></td> \n";

echo "<td align='center' bgcolor='#DCC891'><b><font color='#FFFFFF' size='2' face='Arial'>Telefono</font></b></td> \n";

echo "<td align='center' bgcolor='#DCC891'><b><font color='#FFFFFF' size='2' face='Arial'>Email</font></b></td> \n";

echo "<td align='center 'bgcolor='#DCC891'><b><font color='#FFFFFF' size='2' face='Arial'>Datos</font></b></td> \n";

echo "</tr> \n";

do {


echo "<tr> \n";
 
echo "<td bgcolor='#B9AFA5'><b><font color='#FFFFFF' size='2' face='Arial'>".$row["nombre"]."</font></b></td> \n";

echo "<td bgcolor='#B9AFA5'><b><font color='#FFFFFF' size='2' face='Arial'>".$row["apellidos"]."</font></b></td>\n";

echo "<td bgcolor='#B9AFA5'><b><font color='#FFFFFF' size='2' face='Arial'>+34 91884".$row["telefono_universidad"]."</font></b></td>\n";

echo "<td bgcolor='#B9AFA5'><font color='#FFFFFF' size='2' face='Arial'><a href='mailto:".$row["email"]."'>".$row["email"]."</a></font></td> \n"; 

echo "<td bgcolor='#B9AFA5'><b><font color='#FFFFFF' size='2' face='Arial'><a href='mostrarDatos.php?apellidos=".$row["apellidos"]."&cargo=".$row["cargo"]."'>Ver Ficha</a></font></b></td> \n"; 

echo "</tr> \n";

echo "<tr> \n";
 
echo "<td><b><font color='#FFFFFF' size='2' face='Arial'>  </font></b></td> \n";

echo "<td><b><font color='#FFFFFF' size='2' face='Arial'>  </font></b></td>\n";

echo "<td><b><font color='#FFFFFF' size='2' face='Arial'>  </font></b></td>\n";

echo "<td><b><font color='#FFFFFF' size='2' face='Arial'>  </a></font></b></td> \n"; 

echo "<td><b><font color='#FFFFFF' size='2' face='Arial'>  </a></font></b></td> \n"; 

echo "</tr> \n";

} while ($row = mysql_fetch_array($result));

echo "</table> \n";

echo "<br>\r";

} else {

echo "¡La base de datos esta vacia!";

}





?>

</body>

</html>

<?php
abajo();
?>