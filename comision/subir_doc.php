<?php
require_once("../../core/bibliotecaint.inc.php");
include("../../core/conexion.inc.php");
$comision=$_GET['comision'];
$link=conectarse();
$sql="SELECT * FROM comision WHERE id=$comision";
$result=mysql_query($sql,$link);
$row=mysql_fetch_array($result);
arriba("","comision","es","Comisi&oacute;n De Departamento: ".$row['nombre']."");
$link= Conectarse();
$user=$_SESSION['user'];





echo "<b><font class='fuenteazul'>A&Ntilde;ADIR ACTA </font></b> \n";
echo "<form name='formpersonal' method='post' enctype='multipart/form-data' action='./insacta.php?comision=$comision&error=false'>";



   echo" <table width='88%' height='242' border='0'> \n"; 
   echo"<tr> \n";
        echo"<td width='19%' class='general'><font size='2' face='Arial' color='#0066CC'><b> Nombre</b></font> </td>\n";
        echo"<td width='81%' class='general'> \n";
        echo"<textarea name='nombre' cols='57' rows='1'></textarea>\n";
        echo"</td>\n";
   echo"</tr>\n";

   echo"<tr> \n";
        echo"<td width='19%' class='general'><font size='2' face='Arial' color='#0066CC'><b> Descripci&oacute;n</b></font> </td>\n";
        echo"<td width='81%' class='general'> \n";
        echo"<textarea name='descripcion' cols='57' rows='1'></textarea>\n";
        echo"</td>\n";
   echo"</tr>\n";

echo"<td width='19%' class='general'><font size='2' face='Arial' color='#0066CC'><b> Fecha</b></font> </td>\n";
        echo"<td width='81%' class='general'> \n";
        echo"<textarea name='fecha' cols='57' rows='1'>aaaa-mm-dd</textarea>\n";
        echo"</td>\n";
   echo"</tr>\n";

   
   echo"<tr align='left'> \n";
        echo"<td width='13%'><h3>Documento</h3></td>\n";
        echo"<td width='87%'><input name='userfile' type='file' size='50'></td>\n";
   echo"</tr>\n";


      	    
 echo"</table> \n";
    echo"<table width='88%' border='0'> \n";
    echo"<tr> \n";
    echo"<td align='left'> <div align='center'>\n";
	
	echo" <input type='submit' name='Submit' value='A&ntilde;adir Acta'> \n";
    echo"</div></td> \n";
    echo"</tr> \n";
	echo" <tr> \n";
    echo" <td> <div align='right'> \n";

 echo" <div align='right'><a href='./index.php' class='generalbluebold'>&lt;&lt;  Volver</a> </div> \n";  

    echo"</td> \n";
    echo"</tr> \n";
echo"</table> \n";


echo" </form> \n";

abajo();
?>