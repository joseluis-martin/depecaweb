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




<div align="center">
  <p><font color="#0073B4" face="Arial"><strong>INTRODUCIR DATOS</strong></font></p>
  <form method="post" action="inscarrera.php">
    <table width="96%" height="198" border="0" bordercolor="#FFFFCC">
      <tr align='left'> 
        <td width="40%"><font size="2" face="Arial" color="#0073B4"><b>C&oacute;digo</b></font></td>
        <td width="56%"><font size="1" face="Arial"> <input name="codigo" type="text" size="50">
          </font></td>
      </tr>
      
      <tr align='left'> 
        <td width="40%"><font size="2" face="Arial" color="#0073B4"><b>Nombre</b></font></td>
        <td width="56%"><font size="1" face="Arial"> <input name="nombre" type="text" size="50">
          </font></td>
      </tr>

      <tr align='left'> 
        <td width="40%"><font size="2" face="Arial" color="#0073B4"><b>Nombre Inglés</b></font></td>
        <td width="56%"><font size="1" face="Arial"> <input name="nombre_en" type="text" size="50">
          </font></td>
      </tr>
       <tr align='left'> 
        <td width="40%"><font size="2" face="Arial" color="#0073B4"><b>Iniciales</b></font></td>
        <td width="56%"><font size="1" face="Arial"> <input name="iniciales" type="text" size="50">
          </font></td>
      </tr>
      
      <tr align="left" valign="middle"> 
        <td width="40%"><font size="2" face="Arial" color="#0073B4"><b>Nivel</b></font></td>
        <td width="56%"><font size="1" face="Arial">
          <select size="1" name="nivel">
            <option selected value="1">1er Ciclo</option>
            <option value="2">2º Ciclo</option>
            <option value="12">1er y 2º Ciclo</option>
	    <option value="LE">Libre Elecci&oacute;n</option>
	    <option value="propios">Estudios Propios</option>
	    <option value="doctorado">Estudios de Doctorado</option>
	    <option value="postgrado">Estudios Oficiales de Postgrado</option>
	    <option value="grado">Estudios de Grado</option>
          </select>
          </font></td>
      </tr>
            
      <tr align='left'> 
        <td width="40%"><font size="2" face="Arial" color="#0073B4"><b>Cr&eacute;ditos  Totales</b></font></td>
        <td width="56%"><font size="1" face="Arial"> <input name="creditos_totales" type="text" size="50">
          </font></td>
      </tr>  
      
      <tr align='left'> 
        <td width="40%"><font size="2" face="Arial" color="#0073B4"><b>Cr&eacute;ditos  Troncales</b></font></td>
        <td width="56%"><font size="1" face="Arial"> 
          <input name="creditos_troncales" type="text" size="50">
          </font></td>
      </tr>
      <tr align='left'> 
        <td width="40%"><font size="2" face="Arial" color="#0073B4"><b>Cr&eacute;ditos Obligatorias</b></font></td>
         <td width="56%"><font size="1" face="Arial">
        	<input name="creditos_obligatorias" type="text" size="50">
          </font></td>
      </tr>
      <tr align='left'> 
        <td width="40%"><font size="2" face="Arial" color="#0073B4"><b>Cr&eacute;ditos Optativas</b></font></td>
        <td width="56%"><font size="1" face="Arial"> 
          <input name="creditos_optativas" type="text" size="50">
          </font></td>
      <tr align='left'> 
        <td width="40%"><font size="2" face="Arial" color="#0073B4"><b>Cr&eacute;ditos Libre Elecci&oacute;n</b></font></td>
        <td width="56%"><font size="1" face="Arial"> 
          <input name="creditos_libre" type="text" size="50">
          </font></td>
      </tr>
    </table>
    <table width="100%" border="0">
      <tr>
        <td height="42" align="center">
				<input type="submit" name="enviar" value="Enviar Datos">
        </td>
      </tr>
    </table>
    
  </form>
  <p align="left">&nbsp;</p>
</div>


<?php



echo"<table width='95%' border='0' align='center'> \n"; 
echo" <tr> \n";
    echo"<td> <div align='right'> \n";
    echo"<div align='right'><a href='../../index.php' class='generalbluebold'>&lt;&lt;  Volver</a> </div> \n";
  echo"</td> \n";
  echo"</tr> \n";
  echo"</table> \n";
?>

</body>
</html>

<?php
abajo();
?>