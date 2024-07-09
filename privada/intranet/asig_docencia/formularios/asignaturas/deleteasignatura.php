<?php
require_once("../../../../core/bibliotecaint.inc.php");
include("../../../../core/conexion.inc.php"); //Conexión con la base de datos
arriba("", "asig_docencia", "es", "Asignaci&oacute;n de Docencia");
?>


<script>
var valor;

function Redireccion(value) {
// Obtenemos el valor de la opcion que se eligio
    valor = value;//document.form1.titulacion.value;
// Y enviamos el navegador a una URL compuesta por el mismo archivo PHP que estemos viendo y una variable con el valor recien obtenido
    location.href = "./deleteasignatura.php?codigotit=" + valor;
}
</script>

<?

function generar_desplegable_seltitulacion($resul_carreras)
{
    $link=Conectarse();
    $numero_elementos=mysql_num_rows($resul_carreras);
    $row=mysql_fetch_array($resul_carreras);
    
    if(isset($_GET['codigotit']))
    {
	$seltitulacion=$_GET['codigotit'];
	$sqlcarrerasel = "select * from carreras where codigo='$seltitulacion'";
	
	$resulcarrerasel = mysql_query($sqlcarrerasel, $link);
	$rowcarrerasel = mysql_fetch_array($resulcarrerasel);
	echo "<select name='seltitulacion' size='1' onchange='Redireccion(this.value);'>";	
	echo "<option value='$seltitulacion' selected='selected'>".$rowcarrerasel['nombre']."</option>";    
    }
    else
    {
	$seltitulacion=$_POST['seltitulacion'];
	if ($seltitulacion!='' && $seltitulacion!='nada') {
	    $sqlcarrerasel = "select * from carreras where codigo='$seltitulacion'";
	    
	    $resulcarrerasel = mysql_query($sqlcarrerasel, $link);
	    $rowcarrerasel = mysql_fetch_array($resulcarrerasel);
	    echo "<select name='seltitulacion' size='1' onchange='Redireccion(this.value);'>";	
	    echo "<option value='sel$titulacion' selected='selected'>".$rowcarrerasel['nombre']."</option>";    
	}
	else
	{
    ?>
 <select name="seltitulacion" size="1" onchange="Redireccion(this.value);">
      <option value="nada" selected="selected">Seleccione una titulaci&oacute;n</option> 
										  <?		    
										  }
    }
    for($i=0;$i<$numero_elementos;$i++)
    {
    ?><option value="<?echo $row['codigo']?>"><?echo $row['nombre']?></option>
	   <?
	   $row=mysql_fetch_array($resul_carreras);
    }	
	?>
	</select>
	      <?
}

function generar_desplegable_selasignatura($resul_asignatura)
{
    $link=Conectarse();
    $numero_elementos=mysql_num_rows($resul_asignatura);
    $row=mysql_fetch_array($resul_asignatura);
    
    
    if(!isset($_GET['codigotit']))
    {
	$seltitulacion=$_POST['seltitulacion'];
	if ($seltitulacion!='nada'&& $seltitulacion!='') {
	    $sqlcarrerasel = "select * from carreras where codigo='$seltitulacion'";
	    $resulcarrerasel = mysql_query($sqlcarrerasel, $link);
	    
	    $selasignatura=$_POST['selasignatura'];
	    $seltitulacion=$_POST['seltitulacion'];
	    if ($selasignatura!='' && $selasignatura!='nada') {  
		$sqlasignaturasel = "select * from asignaturas where codigo='$selasignatura' order by nombre";
		    $resulasignaturasel = mysql_query($sqlasignaturasel, $link);
		    $rowasignaturasel = mysql_fetch_array($resulasignaturasel);
		    
		    
		    echo "<select name='selasignatura' size='1'>";	
		    echo "<option value='$selasignatura' selected='selected'>".$rowasignaturasel['nombre']."</option>";    
	    }
	    else{
    ?>
 <select name="selasignatura" size="1">
      <option value="nada" selected="selected">Seleccione una asignatura</option>
      <?
      }
	}
    } 
    else{
    ?>
 <select name="selasignatura" size="1">
      <option value="nada" selected="selected">Seleccione una asignatura</option> 
      <?
      }
    
    for($i=0;$i<$numero_elementos;$i++)
    {
	$cod_asig=$row['codigo'];
	
	
	    ?><option value="<?echo $row['codigo']?>"><?echo $row['nombre']?></option>
		   <?
		   $row=mysql_fetch_array($resul_asignatura);
    }
	?>
	</select>
	      <?
	      }


$link = Conectarse();
$sqlcarreras = "select * from carreras order by nombre";
$resul_carreras = mysql_query($sqlcarreras, $link);

if(isset($_GET['codigotit']))
{
    $seltitulacion=$_GET['codigotit'];
    $sqlasignatura = "select * from asignaturas where codigo_titulacion='$seltitulacion' order by nombre";
    $resul_asignatura = mysql_query($sqlasignatura, $link);
}
else
{
    $seltitulacion=$_POST['seltitulacion'];
    if ($titulacion!='nada') {
	$sqlasignatura = "select * from asignaturas where codigo_titulacion='$seltitulacion' order by nombre";
	$resul_asignatura = mysql_query($sqlasignatura, $link);    
    }
}
?>

<div align="center">
<p><font color="#0066CC" face="Arial"><strong>SELECCIONAR ASIGNATURA</strong></font></p>
<form name='form1' method='post' action='deleteasignatura.php' enctype='multipart/form-data' >
<table width="96%" height="80" border="0" bordercolor="#FFFFCC">
<tr> 
<td align='right'><font size="2" face="Arial" color="#0073B4"><b>Titulaci&oacute;n</b></font></td>
<td colspan='3'><input type="hidden" name="seltitulacion"><? generar_desplegable_seltitulacion($resul_carreras); ?></td>
</tr>
<tr>
<td align='right'><font size="2" face="Arial" color="#0073B4"><b>Asignatura</b></font></td>
<td colspan='3'><input type="hidden" name="selasignatura"><? generar_desplegable_selasignatura($resul_asignatura); ?></td>
</tr>
<tr>
<td colspan='4' align='center' colspan='2'><input type="submit" name="Submit" value="EDITAR"></td>
</tr>  
</table>
</form>
</div> 

<br>
<hr></hr>
<br>

<table width="100%" border="0">
  <tr> 


<?php

$codigo=($_POST['selasignatura']);


if($codigo!='' && $codigo!='' ){
    echo"<td width='45%' height='46'> <h3> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Borrar Asignatura</h1> \n";
    echo"<div align='center'><span class = generalbluebold><br><br>¿Está seguro de eliminar este registro?<br><br></span> \n";
    echo"<a href='./deleteasignatura2.php?codigo=$codigo'><span class = generalbluebold>Si</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> \n";
    echo"<a href='../../index.php'><span class = generalbluebold>No</span></a></div> \n";
    echo"</td> \n";
    echo"</tr> \n";
    echo"</table> \n";  
    echo"<br> \n";
    echo"<table width='95%' height='68' border='0' align='right'> \n";
    echo"<tr> \n";
    echo"<td valign='top'> \n";
    
    //Conexión con la base de datos;

    $link = Conectarse();

    //Ejecutar sentencia sql;
    
    //$sql = "SELECT * FROM asignaturas WHERE codigo like '$codigo2' ";
    
   $result = mysql_query("SELECT * FROM asignaturas WHERE codigo like '$codigo' ", $link);
   
   while ($row = mysql_fetch_array($result)){
       
       echo "<table border = '0'> \n";
       
       echo "<tr> \n";
       
       echo "<td><b>".$row["nombre"]."</b></td> \n";
       
       echo "</tr> \n";
       
       echo "</table> \n";
       
       echo "<br>\r";
       
       echo "<br>\r";
       
       
       echo "<table border = '1'> \n";
       
       echo "<tr> \n";
       
       echo "<td><b>Titulacion</b></td> \n";
       
       echo "<td>".$row["titulacion"]."</td> \n";
       
       echo "</tr> \n";
       
       echo "<tr> \n";
       
       echo "<td><b>Codigo Asignatura</b></td> \n";
       
       echo "<td>".$row["codigo"]."</td> \n";
       
       echo "</tr> \n";
       
       echo "<tr> \n";
       
       echo "<td><b>Creditos</b></td> \n";
       
       echo "<td>".$row["creditos"]."</td> \n";
       
       echo "</tr> \n";
       
       echo "<tr> \n";
       
       echo "<td><b>Cuatrimestre</b></td> \n";
       
       echo "<td>".$row["cuatrimestre"]."</td> \n";
       
       echo "</tr> \n";
       
       echo "<tr> \n";
       
       echo "<td><b>Caracter</b></td> \n";
       
       echo "<td>".$row["caracter"]."</td> \n";
       
       echo "</tr> \n";
       
       echo "<tr> \n";
       
       echo "<td><b>Año</b></td> \n";
       
       echo "<td>".$row["anio"]."</td> \n";
       
       echo "</tr> \n";
       
       
       echo "<table border = '0'> \n";
       
       echo "<tr> \n";
       
       echo "<td><b></b></td> \n";
       
       echo "</tr> \n";
       
       echo "<tr> \n";
       
       echo "<td><b></b></td> \n";
       
       echo "</tr> \n";
       echo "<tr> \n";
       
       echo "<td><b></b></td> \n";
       
       echo "</tr> \n";
       echo "<tr> \n";
       
       echo "<td><b></b></td> \n";
       
       echo "</tr> \n";
       
       echo "</table> \n";
       
       
       
   } 
   
   
   mysql_free_result($result);
   mysql_close ($link);   
}    
?>	  
</td>
</tr>
</table>


<?php

abajo();
?>