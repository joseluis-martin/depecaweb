<?php
require_once("../../../../core/bibliotecaint.inc.php");
include("../../../../core/conexion.inc.php"); //Conexión con la base de datos
arriba("", "doctorado", "es", "Doctorado");

?>

<div align="center">
<p><font color="#0066CC" face="Arial"><strong>INTRODUCIR DOCUMENTO</strong></font></p>

<?  
echo"  <form name='form1' method='post' action='insdocumento.php' enctype='multipart/form-data' > \n";
?>  
  
  
<table width="96%" height="198" border="0" bordercolor="#FFFFCC">
      
      <tr align='left'> 
        <td width="13%"><font size="2" face="Arial" color="#0066CC"><b>Nombre</b></font></td>
        <td width="87%"><font size="1" face="Arial"> <input name="nombre" type="text" size="70">
          </font></td>
      </tr>
      <tr align='left'> 
        <td width="13%"><font size="2" face="Arial" color="#0066CC"><b>Descripci&oacute;n</b></font></td>
        <td width="87%"><font size="1" face="Arial"> <input name="descripcion" type="text" size="70">
          </font></td>
      </tr>
            
<!--    <tr align="left" valign="middle"> 
        <td><font size="2" face="Arial" color="#0066CC"><b>Tipo</b></font></td>
        <td><font size="1" face="Arial">
          <select size="1" name="tipo">
	   <option value='departamento'>F. Departamento</option>
	   <option value='universidad'>F. Universidad</option>
	  </select>
          </font></td>
      </tr>
   -->
      
      <tr align='left'> 
        <td width="13%"><font size="2" face="Arial" color="#0066CC"><b>Documento</b></font></td>
        <td width="87%"><font size="1" face="Arial"> <input name="userfile" type="file" size="70">
        
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




echo "<table width='95%' border='0' align='center'> \n"; 
echo "<tr> \n";
   echo "<td> <div align='right'> \n";
echo "<div align='right'><a href='javascript:history.back()' class='generalbluebold'>&lt;&lt;  Volver</a> </div> \n";
 echo "</td> \n";
echo "</tr> \n";
echo "</table>\n";


abajo();
?>