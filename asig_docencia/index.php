<?php
require_once("../../../core/bibliotecaint.inc.php");
include("../../../core/conexion.inc.php"); //Conexión con la base de datos
arriba("", "asig_docencia", "es", "Asignaci&oacute;n de Docencia");
session_start();

$user=$_SESSION['user'];
$nivel='asignacion_docencia';
//$puesto=get_puesto($link,$user);

//echo "<br>acceso   ".acceso_nivel($nivel,$user)."<br>";

?>

<script>
var valor2;

function GuardarCurso(value) {
    valor2=value;
    //location.href = "./index.php?valor2="+valor2;
    location.href = "./copiar.php?valor2="+valor2;
}

function GuardarCurso2(value) {
    valor2=value;
}
</script>



<?
if (isset($_GET['valor2']))
    $curso = $_GET['valor2'];   
else
    $curso=$_POST['curso'];


$mes_actual=date('m');
$anio_actual=date('Y');
if($mes_actual>='1' && $mes_actual<7) /* mocana: cambiado momentaneamente, el valor correcto seria 9, se cambia por indicacion directora */
{
    $curso_ant_ant_ant=($anio_actual-4)."/".($anio_actual-3);
    $curso_ant_ant=($anio_actual-3)."/".($anio_actual-2);
    $curso_ant=($anio_actual-2)."/".($anio_actual-1);
    $curso_actual=($anio_actual-1)."/".$anio_actual;
    $curso_post=($anio_actual)."/".($anio_actual+1);
}
else
{
    $curso_ant_ant_ant=($anio_actual-3)."/".($anio_actual-2);
    $curso_ant_ant=($anio_actual-2)."/".($anio_actual-1);
    $curso_ant=($anio_actual-1)."/".($anio_actual);
    $curso_actual=$anio_actual."/".($anio_actual+1);
    $curso_post=($anio_actual+1)."/".($anio_actual+2);
}


if (isset($_GET['valor2']))
    $curso = $_GET['valor2'];   
else
    $curso=$_POST['curso'];

if($curso==''|| $curso=='undefined')
$curso=$curso_actual;
//    $curso=$curso_actual; Cambiar en septiembre
?>
<br>
<br>
<br>


<form name='form_nota' method='post' action='./formularios/insnota.php' enctype='multipart/form-data'>
<table width='80%' height='80' border='0' bordercolor='#FFFFCC' align='center'>
<tr> 
<td align='center'><font size="2" face="Arial" color="#0073B4"><b>Curso: </b></font>
<?
if($curso=='' || $curso=='undefined' )
{
?>
<select name="curso" size="1" onchange='GuardarCurso(this.value)'>
<option value='nada' selected='selected' >Seleccione un curso</option>
<option value="<?echo $curso_post?>"><?echo  $curso_post?></option>
<option value="<?echo $curso_actual?>"><?echo  $curso_actual?></option>
<option value="<?echo $curso_ant?>"><?echo  $curso_ant?></option>
<option value="<?echo $curso_ant_ant?>"><?echo  $curso_ant_ant?></option>
<option value="<?echo $curso_ant_ant_ant?>"><?echo  $curso_ant_ant_ant?></option>
<\select>
</td>
<?
}
else
{
    if($curso==$curso_ant)
    {?>
 <select name="curso" size="1" onchange='GuardarCurso(this.value)'>
      <option value="<?echo $curso_post?>"><?echo  $curso_post?></option>
      <option value="<?echo $curso_actual?>"><?echo  $curso_actual?></option>
      <option value="<?echo $curso_ant?>" selected='selected'><?echo  $curso_ant?></option>
      <option value="<?echo $curso_ant_ant?>"><?echo  $curso_ant_ant?></option>
      <option value="<?echo $curso_ant_ant_ant?>"><?echo  $curso_ant_ant_ant?></option>
      <\select>

	<script>
	     GuardarCurso2('<?echo $curso_ant?>');
	</script>
    <?
    }
    else if($curso==$curso_actual)
    {
    ?>
 <select name="curso" size="1" onchange='GuardarCurso(this.value)'>
      <option value="<?echo $curso_post?>"><?echo  $curso_post?></option>
      <option value="<?echo $curso_actual?>"  selected='selected'><?echo  $curso_actual?></option>
      <option value="<?echo $curso_ant?>"><?echo  $curso_ant?></option>
      <option value="<?echo $curso_ant_ant?>"><?echo  $curso_ant_ant?></option>
      <option value="<?echo $curso_ant_ant_ant?>"><?echo  $curso_ant_ant_ant?></option>
      <\select>
 
	<script>
	     GuardarCurso2('<?echo $curso_actual?>');
	</script>
    <?
    }
    else
    {
    ?>    
 <select name="curso" size="1" onchange='GuardarCurso(this.value)'>
      <option value="<?echo $curso_post?>" selected='selected'><?echo  $curso_post?></option>
      <option value="<?echo $curso_actual?>" ><?echo  $curso_actual?></option>
      <option value="<?echo $curso_ant?>"><?echo  $curso_ant?></option>
      <option value="<?echo $curso_ant_ant?>"><?echo  $curso_ant_ant?></option>
      <option value="<?echo $curso_ant_ant_ant?>"><?echo  $curso_ant_ant_ant?></option>
      <\select>
 
	<script>
	     GuardarCurso2('<?echo $curso_post?>');
	</script>
<?
    }
}
?>
</tr>
<tr>
<td  colspan='4'><p align="center"><font class='fuenteazul'><b>Notas sobre la Asignaci&oacute;n de Docencia:</b></font></td>
</tr>
<tr>
<?
//echo "<td align='center' colspan='4'>Asignaci&oacute;n en pruebas, cargas docentes no definitivas</td></tr>";
if(acceso_nivel($nivel,$user))
{
    if($curso=='' || $curso=='undefined')
    {
	echo "<td align='center' colspan='4'><textarea name='nota' rows='5' cols='50' disabled>Seleccione primero un curso</textarea></td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td align='center' colspan='4'><input type='submit' name='Submit' value='GUARDAR' disabled></td>";
	echo "</tr>";
    }
    else
    {
	$link = Conectarse();
	$sql_nota = "select * from asig_docencia_notas where curso='$curso'";    
	$resul_nota = mysql_query($sql_nota, $link);
	$row_nota = mysql_fetch_array($resul_nota);
	$texto=$row_nota['nota'];
	echo "<td align='center' colspan='4'><textarea name='nota' rows='5' cols='50' enabled style='background-color:#FFFFBB;'>".$texto."</textarea></td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td align='center' colspan='4'><input type='submit' name='Submit' value='GUARDAR' enabled></td>";
	echo "</tr>";
    }
}
else
{
    echo "<table width='45%' height='100' border='0' bordercolor='#FFFFCC' align='center'>";
    if($curso=='' || $curso=='undefined')
    {
	echo "<td align='center' colspan='4'><font class='fuentenegra'><b>Seleccione primero un curso</b></font></td>";
	echo "</tr>";
    }
    else
    {
	$link = Conectarse();
	$sql_nota = "select * from asig_docencia_notas where curso='$curso'";    
	$resul_nota = mysql_query($sql_nota, $link);
	$row_nota = mysql_fetch_array($resul_nota);
	$texto=$row_nota['nota'];
        if($texto=='')
	    echo "<td align='center' colspan='4' style='border-width:1px;border:solid; border-color:#FFFF99; background-color:#FFFFBB;'><font class='fuentenegra'><b>No existe nota para este curso.</b></font></td>";
	else
	    echo "<td align='center' colspan='4' style='border-width:1px;border:solid; border-color:#FFFF99; background-color:#FFFFBB;'><font class='fuentenegra'><b>".$texto."</b></font></td>";
	echo "</tr>";   
    }
    echo "</table>";
}
?>
</table>
</form>

<br><br>

<?
if($curso!='' && $curso!='undefined')
{?>
    <?if(acceso_nivel($nivel,$user)){?>
         <table width="100%" height='100%' border='0' align="center" valign='middle'>
	    <tr>
	    <td><p align="center"><a style="text-decoration:none" href="./por_asignatura/index.php?valor2=<?echo $curso?>"><font size="2" face="Arial" color="#CC6900"><b>Asignaci&oacute;n docencia por asignatura</b></font></a></td> </tr>											  <tr>
             <td><p align="center"><a style="text-decoration:none" href="./por_profesor/index.php?valor2=<?echo $curso?>"><font size="2" face="Arial" color="#CC6900"><b>Asignaci&oacute;n docencia por profesor</b></font></a></td> </tr>
            <tr>
             <td><p align="center"><a style="text-decoration:none" href="./libres.php?valor2=<?echo $curso?>"><font size="2" face="Arial" color="#CC6900"><b>Ver asignaturas libres</b></font></a></td> </tr>
             <tr> <td><p align="center"><a style="text-decoration:none" href="./responsable.php?valor2=<?echo $curso?>"><font size="2" face="Arial" color="#CC6900"><b>Ver responsables</b></font></a></td> </tr>
																							     <tr> <td><p align="center"><a style="text-decoration:none" href="./horarionoasignado.php?valor2=<?echo $curso?>"><font size="2" face="Arial" color="#CC6900"><b>Ver horarios no asignados por coordinadores</b></font></a></td> </tr>

   <?}
    else{?>
        <table width="100%" height='100%' border='0' align="center" valign='middle'>
	    <tr>
	    <td><p align="center"><a style="text-decoration:none" href="./por_asignatura/index.php?valor2=<?echo $curso?>"><font size="2" face="Arial" color="#CC6900"><b>Consultar docencia por asignatura</b></font></a></td> </tr>											  <tr>
             <td><p align="center"><a style="text-decoration:none" href="./por_profesor/index.php?valor2=<?echo $curso?>"><font size="2" face="Arial" color="#CC6900"><b>Consultar docencia por profesor</b></font></a></td> </tr>
	      <tr>
             <td><p align="center"><a style="text-decoration:none" href="./libres.php?valor2=<?echo $curso?>"><font size="2" face="Arial" color="#CC6900"><b>Ver asignaturas libres</b></font></a></td> </tr>
             <tr> <td><p align="center"><a style="text-decoration:none" href="./responsable.php?valor2=<?echo $curso?>"><font size="2" face="Arial" color="#CC6900"><b>Ver responsables</b></font></a></td> </tr>
																							     <tr> <td><p align="center"><a style="text-decoration:none" href="./horarionoasignado.php?valor2=<?echo $curso?>"><font size="2" face="Arial" color="#CC6900"><b>Ver horarios no asignados por coordinadores</b></font></a></td> </tr>
   <?}?>   
																			   <?}?>																			     
<?if(acceso_nivel($nivel,$user)){?>
      <tr><td><hr></td></tr>
 <tr>
      <td width="55%"><p align="center"><font size="2" face="Arial" color="#CC6900"><b>Titulaciones</b></font>
      <a style="text-decoration:none" href="./formularios/carreras/addcarrerael.php"><font size="2" face="Arial" color="#CC6900"><b>[ A&ntilde;adir </b></font></a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
																    <a style="text-decoration:none" href="./formularios/carreras/docenciapeditable.php"><font size="2" face="Arial" color="#CC6900"><b> Editar </b></font></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
																    <a style="text-decoration:none" href="./formularios/carreras/docenciapdelete.php"><font size="2" face="Arial" color="#CC6900"><b> Borrar ]</b></font></a></p></td>
      </tr>
      <tr>
      <td width="55%"><p align="center"><font size="2" face="Arial" color="#CC6900"><b>Asignaturas</b></font>
      <a style="text-decoration:none" href="./formularios/asignaturas/addasignatura.php"><font size="2" face="Arial" color="#CC6900"><b>[ A&ntilde;adir </b></font></a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
																	  <a style="text-decoration:none" href="./formularios/asignaturas/editasignatura.php"><font size="2" face="Arial" color="#CC6900"><b> Editar </b></font></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
																	  <a style="text-decoration:none" href="./formularios/asignaturas/deleteasignatura.php"><font size="2" face="Arial" color="#CC6900"><b> Borrar ]</b></font></a></p></td>
      </tr>
       <tr>
      <td width="55%"><p align="center"><font size="2" face="Arial" color="#CC6900"><b>Personal</b></font>
      <a style="text-decoration:none" href="./formularios/personal/addpersonal.php"><font size="2" face="Arial" color="#CC6900"><b>[ A&ntilde;adir </b></font></a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
      <a style="text-decoration:none" href="./personalpeditable.php"><font size="2" face="Arial" color="#CC6900"><b> Editar </b></font></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
      <a style="text-decoration:none" href="./personalpdelete.php"><font size="2" face="Arial" color="#CC6900"><b> Borrar ]</b></font></a></p></td>
      </tr>
	   
      <?}?>
																																							     </table>																		   <br><br>






<?php
abajo();
?>
