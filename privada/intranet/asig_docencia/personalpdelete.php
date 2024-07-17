<?php
require_once("../../core/bibliotecaint.inc.php");
include("../../core/conexion.inc.php"); //Conexión con la base de datos
arriba("", "asig_docencia", "es", "Asignaci&oacute;n de Docencia");


?>

<img class="left" src="../../img/personal.jpg" alt=" " />
<?

if(isset($_GET["selec"])) { 


$selec=($_GET['selec']);
//Conexion con la base

$link = Conectarse();

//Ejecutamos la sentencia SQL

$resultdelete=mysql_query("Delete From personal Where id=$selec",$link);

mysql_close ($link); 

}
//mostrar

 echo "<div align='center'><b><font size='3' face='Tahoma'>Clic sobre el nombre a BORRAR</font></b></div>\n";

$prefijo="+34 91885";
$link = Conectarse();


$sql2="select * from personal_cargos order by orden";
$result2 = mysql_query($sql2, $link);

while($row2 = mysql_fetch_array($result2))
 {
   $cargo=$row2["cargo"];
   $titulo=$row2["titulo"];
   $sql1 = "SELECT * FROM personal WHERE puesto='$cargo' order by apellidos";
   $result1 = mysql_query($sql1, $link);
   if ($row1 = mysql_fetch_array($result1)){
     echo "<b><font size='2' face='Tahoma'>".$titulo."</font></b>\n";
     echo "<table class='tabla'> \n";
     echo "<tr> \n";
     echo "<td  width='20%' class='encabezado'><b><font class='fuenteblanco'>Nombre</font></b></td> \n";
     echo "<td  width='20%' class='encabezado'><b><font class='fuenteblanco'>Apellidos</font></b></td> \n";
     echo "<td  width='20%' class='encabezado'><b><font class='fuenteblanco'>Tel&eacute;fono</font></b></td> \n";
     echo "<td  width='30%' class='encabezado'><b><font class='fuenteblanco'>Email</font></b></td> \n";
     echo "</tr> \n";
     do {
       echo "<tr> \n";
       $nombre=strtolower($row1["nombre"]);
       $nombre2=ucwords($nombre);
       $apellidos=strtolower($row1["apellidos"]);
       $apellidos2=ucwords($apellidos);
       $email=strtolower($row1["email"]);
       echo "<td class='encabezado'><b><font class='fuenteblanco'><a href='./formularios/personal/deletepersonal.php?id=".$row1["id"]."'>$nombre2</a></font></b></td> \n";
       echo "<td class='encabezado'><b><font class='fuenteazul'>$apellidos2</font></b></td>\n";
       echo "<td class='encabezado'><b><font class='fuenteazul'>".$prefijo.$row1["telefono_universidad"]."</font></b></td>\n";
       echo "<td class='encabezado'><font class='fuenteazul'><a href='mailto:".$row1["email"]."'>$email</a></font></td> \n"; 
       echo "</tr> \n";
     } while ($row1 = mysql_fetch_array($result1));

     echo "</table> \n";
     echo "<br>\n";
   }
 } 


abajo();
?>