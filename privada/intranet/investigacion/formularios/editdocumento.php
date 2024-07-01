<?php
require_once("../../../../core/bibliotecaint.inc.php");
include("../../../../core/conexion.inc.php"); //Conexión con la base de datos
arriba("", "investigacion", "es", "Investigaci&oacute;n");


$id=($_GET['id']);

//Conexion con la base
$link=Conectarse();
//Ejecutamos la sentencia SQL
$result=mysql_query("SELECT * FROM documentos_investigacion where id=$id",$link);
$row=mysql_fetch_array($result);


echo"<p align='center><font color='#0066CC' face='Arial'><b>EDITAR DOCUMENTO</b></font></p> \n"; 
echo"<form  name='formdoc' method='post' enctype='multipart/form-data' action='./editdocumento2.php?id=$id'> \n";
   echo" <table width='88%' height='242' border='0'> \n";    

   echo"<tr> \n";
        echo"<td width='19%' class='general'><font size='2' face='Arial' color='#0066CC'><b> Nombre</b></font> </td>\n";
        echo"<td width='81%' class='general'> \n";
        echo"<textarea name='nombre' cols='70' rows='1'>".$row["nombre"]."</textarea>\n";
        echo"</td>\n";
   echo"</tr>\n";

   echo"<tr> \n";
        echo"<td width='19%' class='general'><font size='2' face='Arial' color='#0066CC'><b> Descripci&oacute;n</b></font> </td>\n";
        echo"<td width='81%' class='general'> \n";
        echo"<textarea name='descripcion' cols='70' rows='1'>".$row["descripcion"]."</textarea>\n";
        echo"</td>\n";
   echo"</tr>\n";
       
   echo"<td><font size='2' face='Arial' color='#0066CC'><b>Tipo</b></font></td>\n"; 
   echo"<td class='general'> \n";  
          echo"<select name='tipo' id='tipo'> \n"; 
            echo"<option selected value=".$row["tipo"].">".$row["tipo"]."</option> \n"; 
            echo "<option value='art83'>Articulo 83 </option>";
            echo "<option value='congresos'>Congresos</option>";
            echo "<option value='doctorado'>Doctorado</option>";
            echo "<option value='id'>I+D</option>";   
          echo"</select> \n"; 
        echo"</td> \n"; 
   echo"</tr> \n"; 

echo"<tr align='left' valign='middle'> \n"; 


 echo"</font></td>\n";
echo"</tr>\n";   
   
   echo"<tr align='left'> \n";
        echo"<td width='13%'><h3>Documento<font color='red'>*</font></h3></td>\n";
        echo"<td width='87%'><input name='userfile' type='file' size='70'></td>\n";
   echo"</tr>\n";
   
   echo"<tr align='left' valign='top'> \n";
        echo"<td width='13%'align='right'><h3><font color='red'>*Nota: </font></h3></td>\n";
        echo"<td width='87%'><h3><font color='black'>Si a&ntilde;ade un nuevo documento, el antiguo ser&aacute; borrado permanentemente.</font></h3></td>\n";
   echo"</tr>\n";

      	    
 echo"</table> \n";
    echo"<table width='88%' border='0'> \n";
    echo"<tr> \n";
    echo"<td align='left'> <div align='center'>\n";
	
	echo" <input type='submit' name='Submit' value='Modificar Documento'> \n";
    echo"</div></td> \n";
    echo"</tr> \n";
	echo" <tr> \n";
    echo" <td> <div align='right'> \n";

 echo" <div align='right'><a href='../index.php' class='generalbluebold'>&lt;&lt;  Volver</a> </div> \n";  

    echo"</td> \n";
    echo"</tr> \n";
echo"</table> \n";
echo" </form> \n";


?>

<?php
abajo();
?>