<?php
require_once("../../../../core/bibliotecaint.inc.php");
include("../../../../core/conexion.inc.php"); //Conexión con la base de datos
arriba("", "asig_docencia", "es", "Asignaci&oacute;n de Docencia");
?>

<div align="center">

<p><font color="#0073B4" face="Arial"><strong>INTRODUCIR DATOS</strong></font></p>
  <form  name="formpersonal" method="post" action="inspersonal.php" enctype="multipart/form-data">
    <table width="96%" height="198" border="0" bordercolor="#FFFFCC">
      <tr align="left"> 
        <td width="13%"><font size="2" face="Arial" color="#0073B4"><b>Nombre</b></font></td>
        <td width="86%"><font size="1" face="Arial"> <input name="nombre" type="text" size="65"> </font></td>
      </tr>
      
      <tr align="left"> 
        <td width="13%"><font size="2" face="Arial" color="#0073B4"><b>Apellidos</b></font></td>
        <td width="86%"><font size="1" face="Arial"> <input name="apellidos" type="text" size="65"></font></td>
      </tr>
       <tr align="left"> 
        <td width="13%"><font size="2" face="Arial" color="#0073B4"><b>Iniciales Profesor</b></font></td>
        <td width="86%"><font size="1" face="Arial"> <input name="iniciales" type="text" size="50">Ej. A.ALONSO </font></td>
      </tr>
      
       <tr align="left" valign="middle"> 
        <td><font size="2" face="Arial" color="#0066CC"><b>Puesto</b></font></td>
        <td><font size="1" face="Arial">
          <select size="1" name="puesto">
        <?
        $link= Conectarse();
        $sql = "select * from personal_cargos order by orden DESC";
        $result = mysql_query($sql, $link);

       while ($value=mysql_fetch_array($result))
       {
	 echo '<option value='.$value["cargo"].">".$value["titulo"]."</option>\n";
       }
       mysql_free_result($result);
       ?>
       </select>
       </font></td>
       </tr>

       <tr align="left" valign="middle"> 
       <td><font size="2" face="Arial" color="#0066CC"><b>Cargo</b></font></td>
       <td><font size="1" face="Arial">
       <select size="1" name="cargo">
       <?
       $link= Conectarse();
       $sql = "select * from personal_cargos order by orden DESC";
       $result = mysql_query($sql, $link);

       while ($value=mysql_fetch_array($result))
       {
	 echo '<option value='.$value["cargo"].">".$value["titulo"]."</option>\n";
       }
       mysql_free_result($result);
       ?>
       </select>
       </font></td>
       </tr>
     
      
      <tr align="left"> 
        <td><font size="2" face="Arial" color="#0073B4"><b>E_mail</b></font></td>
        <td><font size="1" face="Arial"> 
          <input name="email" type="text" size="65">
          </font></td>
      </tr>
      <tr align="left"> 
        <td><font size="2" face="Arial" color="#0073B4"><b>Centro</b></font></td>
         <td><font size="1" face="Arial">
        	<input name="centro" type="text" size="65">
          </font></td>
      </tr>
      <tr align="left"> 
        <td><font size="2" face="Arial" color="#0073B4"><b>Departamento</b></font></td>
        <td><font size="1" face="Arial"> 
          <input name="departamento" type="text" size="65">
          </font></td>
      </tr>
      
      <tr align="left"> 
        <td class="general"><font size="2" face="Arial" color="#0073B4"><b>Foto</b></font></td>
        <td class="general"> 
          <input name="userfile" type="file" size="36">
          <span class="submited">Dim: 79x89</span></td>
      </tr>
      
 <!--     <tr align="left"> 
        <td><font size="2" face="Arial" color="#0073B4"><b>foto</b></font></td>
        <td><font size="1" face="Arial"> 
          <input name="foto" type="text" size="65">
          </font></td>
      </tr>
      
-->
      <tr align="left"> 
        <td><font size="2" face="Arial" color="#0073B4"><b>Direcci&oacute;n</b></font></td>
        <td><font size="1" face="Arial"> 
          <input name="direccion" type="text" size="65">
          </font></td>
      </tr>
      <tr align="left"> 
        <td><font size="2" face="Arial" color="#0073B4"><b>Domicilio Particular</b></font></td>
        <td><font size="1" face="Arial"> 
          <input name="domicilio" type="text" size="65">
          </font></td>
      </tr>
      <tr align="left"> 
        <td><font size="2" face="Arial" color="#0073B4"><b>Tel&eacute;fono Universidad</b></font></td>
        <td><font size="1" face="Arial"> 
          <input name="telefono_universidad" type="text" size="65">
          </font></td>
      </tr>
       <tr align="left"> 
        <td><font size="2" face="Arial" color="#0073B4"><b>Tel&eacute;fono Particular</b></font></td>
        <td><font size="1" face="Arial"> 
          <input name="telefono_particular" type="text" size="65">
          </font></td>
      </tr>
       <tr align="left"> 
        <td><font size="2" face="Arial" color="#0073B4"><b>Fax</b></font></td>
        <td><font size="1" face="Arial"> 
          <input name="fax" type="text" size="65">
          </font></td>
      </tr>
       <tr align="left"> 
        <td><font size="2" face="Arial" color="#0073B4"><b>Despacho</b></font></td>
        <td><font size="1" face="Arial"> 
          <input name="despacho" type="text" size="65">
          </font></td>
      </tr>
      <tr align="left"> 
        <td><font size="2" face="Arial" color="#0073B4"><b>NRP</b></font></td>
        <td><font size="1" face="Arial"> 
          <input name="nrp" type="text" size="65">
          </font></td>
      </tr>
      <tr align="left"> 
        <td><font size="2" face="Arial" color="#0073B4"><b>NIF</b></font></td>
        <td><font size="1" face="Arial"> 
          <input name="nif" type="text" size="65">
          </font></td>
      </tr>
      <tr align="left"> 
        <td><font size="2" face="Arial" color="#0073B4"><b>C&oacute;digo Plaza</b></font></td>
        <td><font size="1" face="Arial"> 
          <input name="codigo_plaza" type="text" size="65">
          </font></td>
      </tr>
      <tr align="left"> 
        <td><font size="2" face="Arial" color="#0073B4"><b>N&uacute;mero</b></font></td>
        <td><font size="1" face="Arial"> 
          <input name="numero" type="text" size="65">
          </font></td>
      </tr>
      <tr align="left"> 
        <td><font size="2" face="Arial" color="#0073B4"><b>Fecha de alta Cuerpo</b></font></td>
        <td><font size="1" face="Arial"> 
          <input name="falta_cuerpo" type="text" size="65">
          </font></td>
      </tr>
      <tr align="left"> 
        <td><font size="2" face="Arial" color="#0073B4"><b>Fecha de alta Universidad</b></font></td>
        <td><font size="1" face="Arial"> 
          <input name="falta_univ" type="text" size="65">
          </font></td>
      </tr>
      
      <tr align="left" valign="middle"> 
        <td><font size="2" face="Arial" color="#0073B4"><b>Sexo</b></font></td>
        <td><font size="1" face="Arial"> 
          <select size="1" name="sexo">
            <option selected value="V">Var&oacute;n</option>
				<option value="M">Mujer</option>
			 </select>
          </font></td>
      </tr>
       
      <tr align="left"> 
        <td><font size="2" face="Arial" color="#0073B4"><b>Fecha de Nacimiento</b></font></td>
        <td><font size="1" face="Arial"> 
          <input name="fecha_nacimiento" type="text" size="65">
          </font></td>
      </tr>
    </table>
    <table width="100%" border="0">
      <tr>
        <td height="42" align="center">
				<input type="submit" name="enviar" value="Enviar">
        </td>
      </tr>
    </table>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
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


<?php
abajo();
?>
