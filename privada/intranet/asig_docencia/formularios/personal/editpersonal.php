<?php
require_once("../../../../core/bibliotecaint.inc.php");
include("../../../../core/conexion.inc.php"); //Conexión con la base de datos
arriba("", "asig_docencia", "es", "Asignaci&oacute;n de Docencia");
?>

<html>
<head>
<title>Editar Personal</title>
<LINK  REL="stylesheet" TYPE="text/css" HREF="../../../public-en/Estilos.css">
</head>

<body>
<?

$id=($_GET['id']);

//Conexion con la base
$link=Conectarse();
//Ejecutamos la sentencia SQL
$result=mysql_query("SELECT * FROM personal where id=$id",$link);
$row=mysql_fetch_array($result);


$pue = $row["puesto"];
$car = $row["cargo"];

$sql1 = "SELECT * FROM personal_cargos WHERE cargo='$pue'";
  $result1 = mysql_query($sql1, $link);
  if ($row1 = mysql_fetch_array($result1)){
    $puesto=$row1['titulo'];
  }

$sql2 = "SELECT * FROM personal_cargos WHERE cargo='$car'";
  $result2 = mysql_query($sql2, $link);
  if ($row2 = mysql_fetch_array($result2)){
    $cargo=$row2['titulo'];
  }
  
$sit = $row["situacion_academica"];
 
   if ($sit == "ACTIVO"){
    $situacion_academica = "Activo/a";
   }else {
    $situacion_academica = "Inactivo/a";
   }
   
$sex = $row["sexo"];
 
   if ($sex == "V"){
    $sexo = "Var&oacute;n";
   }else {
    $sexo = "Mujer";
   } 
   
$baj = $row["baja"];
 
   if ($baj == "S"){
    $baja = "Si";
   }else {
    $baja = "No";
   } 

echo"<p align='center'><font color='#0066CC' face='Arial'><b>EDITAR PERSONAL</b></font></p> \n";   
echo"<form name='formpersonal' method='post' action='editpersonal2.php?id=$id' enctype='multipart/form-data'> \n";
   echo" <table width='90%' height='242' border='0'> \n";
   
   echo"<tr> \n";
        echo"<td width='13%' class='general'><font color='#0066CC'><b>Nombre</b></font></td>\n";
        echo"<td width='77%' class='general'> \n";
        echo"<textarea name='nombre' cols='50' rows='1'>".$row["nombre"]."</textarea>\n";
        echo"</td>\n";
   echo"</tr>\n";
   echo"<tr> \n";
        echo"<td width='13%' class='general'><font color='#0066CC'><b>Apellidos</b></font></td>\n";
        echo"<td width='77%' class='general'> \n";
        echo"<textarea name='apellidos' cols='50' rows='1'>".$row["apellidos"]."</textarea>\n";
        echo"</td>\n";
   echo"</tr>\n";
   echo"<tr> \n";
        echo"<td width='13%' class='general'><font color='#0066CC'><b>Iniciales</b></font></td>\n";
        echo"<td width='77%' class='general'> \n";
        echo"<textarea name='iniciales' cols='50' rows='1'>".$row["iniciales"]."</textarea>\n";
        echo"</td>\n";
   echo"</tr>\n";
   
   echo"<tr align='left' valign='middle'> \n"; 
   echo"<td><font size='2' face='Arial' color='#0066CC'><b>Puesto</b></font></td>\n"; 
   echo"<td><font size='1' face='Arial'>\n"; 
   echo"<select size='1' name='puesto'>\n"; 
   echo"<option selected value=".$row["puesto"].">$puesto</option> \n"; 
   $link= Conectarse();
   $sql = "select * from personal_cargos order by orden";
   $result = mysql_query($sql, $link);

   while ($value=mysql_fetch_array($result))
   {
     echo '<option value='.$value["cargo"].">".$value["titulo"]."</option>\n";
   }
   mysql_free_result($result);
   echo"</select>\n";
   echo"</font></td>\n";
   echo"</tr>\n";
   
   echo"<td><font size='2' face='Arial' color='#0066CC'><b>Cargo</b></font></td>\n"; 
   echo"<td><font size='1' face='Arial'>\n"; 
   echo"<select size='1' name='cargo'>\n"; 
   echo"<option selected value=".$row["cargo"].">$cargo</option> \n"; 
   $link= Conectarse();
   $sql = "select * from personal_cargos order by orden";
   $result = mysql_query($sql, $link);

   while ($value=mysql_fetch_array($result))
   {
     echo '<option value='.$value["cargo"].">".$value["titulo"]."</option>\n";
   }
   mysql_free_result($result);
   echo"</select>\n";
   echo"</font></td>\n";
   echo"</tr>\n";
   
       
   
   echo"<tr> \n";
        echo"<td width='13%' class='general'><font color='#0066CC'><b>Email</b></font></td>\n";
        echo"<td width='77%' class='general'> \n";
        echo"<textarea name='email' cols='50' rows='1'>".$row["email"]."</textarea>\n";
        echo"</td>\n";
   echo"</tr>\n";
   echo"<tr> \n";
        echo"<td width='13%' class='general'><font color='#0066CC'><b>Centro</b></font></td>\n";
        echo"<td width='77%' class='general'> \n";
        echo"<textarea name='centro' cols='50' rows='1'>".$row["centro"]."</textarea>\n";
        echo"</td>\n";
   echo"</tr>\n";
   echo"<tr> \n";
        echo"<td width='13%' class='general'><font color='#0066CC'><b>Departamento</b></font></td>\n";
        echo"<td width='77%' class='general'> \n";
        echo"<textarea name='departamento' cols='50' rows='1'>".$row["departamento"]."</textarea>\n";
        echo"</td>\n";
   echo"</tr>\n";
     echo"<tr align='left'>\n"; 
// echo "<input type=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"1000\">";
 echo"<td class='general'><font size='2' face='Arial' color='#0066CC'><b>Foto</b></font></td>\n";
        echo"<td class='general'> \n";
          echo"<input name='userfile' type='file' size='36'>\n";
          echo"<span class='submited'>Dim: 70x75</span></td>\n";
   echo"</tr> \n";

  echo"<tr align='left' valign='top'> \n";
      echo"<td width='13%'align='right'><h3><font color='red'>*Nota: </font></h3></td>\n";
      echo"<td width='87%'><h3><font color='black'>Si a&ntilde;ade una nueva foto, la antigua ser&aacute; borrada permanentemente.</font></h3></td>\n";
   echo"</tr>\n";
  
   echo"<tr> \n";
        echo"<td width='13%' class='general'><font color='#0066CC'><b>Direcci&oacute;n</b></font></td>\n";
        echo"<td width='77%' class='general'> \n";
        echo"<textarea name='direccion' cols='50' rows='1'>".$row["direccion"]."</textarea>\n";
        echo"</td>\n";
   echo"</tr>\n";
   echo"<tr> \n";
        echo"<td width='13%' class='general'><font color='#0066CC'><b>Domicilio Particular</b></font></td>\n";
        echo"<td width='77%' class='general'> \n";
        echo"<textarea name='domicilio' cols='50' rows='1'>".$row["domicilio"]."</textarea>\n";
        echo"</td>\n";
   echo"</tr>\n";
   echo"<tr> \n";
        echo"<td width='13%' class='general'><font color='#0066CC'><b>Tel&eacute;fono Universidad</b></font></td>\n";
        echo"<td width='77%' class='general'> \n";
        echo"<textarea name='telefono_universidad' cols='50' rows='1'>".$row["telefono_universidad"]."</textarea>\n";
        echo"</td>\n";
   echo"</tr>\n";
   echo"<tr> \n";
        echo"<td width='13%' class='general'><font color='#0066CC'><b>Tel&eacute;fono Particular</b></font></td>\n";
        echo"<td width='77%' class='general'> \n";
        echo"<textarea name='telefono_particular' cols='50' rows='1'>".$row["telefono_particular"]."</textarea>\n";
        echo"</td>\n";
   echo"</tr>\n";
   echo"<tr> \n";
        echo"<td width='13%' class='general'><font color='#0066CC'><b>Fax</b></font></td>\n";
        echo"<td width='77%' class='general'> \n";
        echo"<textarea name='fax' cols='50' rows='1'>".$row["fax"]."</textarea>\n";
        echo"</td>\n";
   echo"</tr>\n";
   echo"<tr> \n";
        echo"<td width='13%' class='general'><font color='#0066CC'><b>Despacho</b></font></td>\n";
        echo"<td width='77%' class='general'> \n";
        echo"<textarea name='despacho' cols='50' rows='1'>".$row["despacho"]."</textarea>\n";
        echo"</td>\n";
   echo"</tr>\n";
  
   echo"<tr> \n";
        echo"<td width='13%' class='general'><font color='#0066CC'><b>Nrp</b></font></td>\n";
        echo"<td width='77%' class='general'> \n";
        echo"<textarea name='nrp' cols='50' rows='1'>".$row["nrp"]."</textarea>\n";
        echo"</td>\n";
   echo"</tr>\n";   
   echo"<tr> \n";
        echo"<td width='13%' class='general'><font color='#0066CC'><b>NIF</b></font></td>\n";
        echo"<td width='77%' class='general'> \n";
        echo"<textarea name='nif' cols='50' rows='1'>".$row["nif"]."</textarea>\n";
        echo"</td>\n";
   echo"</tr>\n";  
   echo"<tr> \n";
        echo"<td width='13%' class='general'><font color='#0066CC'><b>C&oacute;digo Plaza</b></font></td>\n";
        echo"<td width='77%' class='general'> \n";
        echo"<textarea name='codigo_plaza' cols='50' rows='1'>".$row["codigo_plaza"]."</textarea>\n";
        echo"</td>\n";
   echo"</tr>\n";
   echo"<tr> \n";
        echo"<td width='13%' class='general'><font color='#0066CC'><b>N&uacute;mero</b></font></td>\n";
        echo"<td width='77%' class='general'> \n";
        echo"<textarea name='numero' cols='50' rows='1'>".$row["numero"]."</textarea>\n";
        echo"</td>\n";
   echo"</tr>\n";

   echo"<tr> \n";
        echo"<td width='13%' class='general'><font color='#0066CC'><b>Dedicaci&oacute;n</b></font></td>\n";
        echo"<td width='77%' class='general'> \n";
        echo"<textarea name='dedicacion' cols='10' rows='1'>".$row["dedicacion"]."</textarea>\n";
        echo"</td>\n";
   echo"</tr>\n";	
  
   echo"<tr> \n";
        echo"<td width='13%' class='general'><font color='#0066CC'><b>Fecha de alta Cuerpo</b></font></td>\n";
        echo"<td width='77%' class='general'> \n";
        echo"<textarea name='falta_cuerpo' cols='50' rows='1'>".$row["falta_cuerpo"]."</textarea>\n";
        echo"</td>\n";
   echo"</tr>\n";
   echo"<tr> \n";
        echo"<td width='13%' class='general'><font color='#0066CC'><b>Fecha de alta Universidad</b></font></td>\n";
        echo"<td width='77%' class='general'> \n";
        echo"<textarea name='falta_univ' cols='50' rows='1'>".$row["falta_univ"]."</textarea>\n";
        echo"</td>\n";
   echo"</tr>\n"; 

   echo"<tr align='left' valign='middle'> \n";  
        echo"<td class='general'><font color='#0066CC'><b>Sexo</b></font></td> \n"; 
        echo"<td class='general'> \n";  
          echo"<select name='sexo' id='sexo'> \n"; 
            echo"<option selected value=".$row["sexo"].">$sexo</option> \n"; 
            echo"<option value='V'>Var&oacute;n</option> \n"; 
            echo"<option value='M'>Mujer</option> \n";    
          echo"</select> \n"; 
        echo"</td> \n"; 
   echo"</tr> \n"; 
   
   echo"<tr> \n";
        echo"<td width='13%' class='general'><font color='#0066CC'><b>Fecha de Nacimiento</b></font></td>\n";
        echo"<td width='77%' class='general'> \n";
        echo"<textarea name='fecha_nacimiento' cols='50' rows='1'>".$row["fecha_nacimiento"]."</textarea>\n";
        echo"</td>\n";
   echo"</tr>\n"; 
   	   
    echo"</table> \n";
    echo"<table width='96%' border='0'> \n";
      echo"<tr> \n";
        echo"<td align='left'> <div align='left'>\n";
		echo"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
		 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; \n";    
			echo" <input type='submit' name='Submit' value='ENVIAR'> \n";
          echo"</div></td> \n";
      echo"</tr> \n";
	 echo" <tr> \n";
   echo" <td> <div align='right'> \n";
      echo"<div align='right'><a href='../../index.php' class='generalbluebold'>&lt;&lt; 
        Volver</a> </div> \n";
  echo"</td> \n";
  echo"</tr> \n";
    echo"</table> \n";
echo" </form> \n";

?>

<?php
abajo();
?>
