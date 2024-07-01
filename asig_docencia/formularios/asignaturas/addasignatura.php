<?php
require_once("../../../../core/bibliotecaint.inc.php");
include("../../../../core/conexion.inc.php"); //Conexión con la base de datos
arriba("", "asig_docencia", "es", "Asignaci&oacute;n de Docencia");


$codigo2=($_GET['codigo']);
$origen=($_GET['origen']);
$abreviatura=($_POST['abreviatura']);
$nombre=($_POST['nombre']);
$nombre_en=($_POST['nombre_en']);
$codigo=($_POST['codigo']);
$titulacion=($_POST['titulacion']);
$semestre=($_POST['semestre']);
$nivel=($_POST['nivel']);
$anio=($_POST['anio']);
$creditos=($_POST['creditos']);
$cuatrimestre=($_POST['cuatrimestre']);
$caracter=($_POST['caracter']);
$es_clon=($_POST['es_clon']);
$clon_padre=($_POST['clon_padre']);

/////////////////////Función que genera un desplegable en html a partir de un $result//////////////////////
///////////////La tabla que se representa tiene que tener un campo nombre//////////////////////////////////



function generar_desplegable_titulacion($resultado,$desplegable,$titulacion)
{
	//list($campo_pert,$elemento)=split("-",$nombre);
	$numero_elementos=mysql_num_rows($resultado);
	$row=mysql_fetch_array($resultado);
	?>
  
	<select name="<?echo $desplegable?>" size="1">
	<?
	     if ($titulacion!="" && $titulacion!=".")
	     {
		 echo "prueba";
		 echo '<option selected value="'.$titulacion.'">'.$titulacion.'</option>';
	     }
	     else
	     {
	     
		 echo '<option selected value=".">Seleccione</option>';
	     }

	for($i=0;$i<$numero_elementos;$i++)
	{
	?><option value="<?echo $row['nombre']?>"><?echo $row['nombre']; ?></option>
	<?
	$row=mysql_fetch_array($resultado);
	}	
	?>
	</select>
	<?
}

function generar_desplegable_clon($resultado,$desplegable,$clon_padre)
{
	//list($campo_pert,$elemento)=split("-",$nombre);
	$numero_elementos=mysql_num_rows($resultado);
	$row=mysql_fetch_array($resultado);
	?>
	
	<select name="<?echo $desplegable?>" size="1">
<?
	     if ($clon_padre!="" && $clon_padre!=".")
	     {
		 echo '<option selected value="'.$clon_padre.'">'.$clon_padre.'</option>';
	     }
	     else
	     {
		 echo '<option selected value=".">Seleccione</option>';
	     }



	for($i=0;$i<$numero_elementos;$i++)
	{
	?><option value="<?echo $row['codigo']?>"><?echo $row['titulacion']."&nbsp;--&nbsp;".$row['nombre']; ?></option>
	<?
	$row=mysql_fetch_array($resultado);
	}	
	?>
	</select>
	<?
}


$link = Conectarse();

$sql = "select * from carreras order by codigo";

$resultado = mysql_query($sql, $link);



?>

<div align="center">
  <p><font color="#0066CC" face="Arial"><strong>INTRODUCIR NUEVA ASIGNATURA </strong></font></p>
  <form name="form1" method="post" action="insasignatura.php">
    <table width="96%" height="198" border="0" bordercolor="#FFFFCC">
      <tr align='left'> 
        <td width="13%"><font size="2" face="Arial" color="#0066CC"><b>Abreviatura</b></font></td>
<?
if ($abreviatura!='')
{
    echo '<td width="87%"><font size="1" face="Arial"> <input name="abreviatura" type="text" size="75" id="abreviatura" value="'.$abreviatura.'">';
}
else
{
    echo '<td width="87%"><font size="1" face="Arial"> <input name="abreviatura" type="text" size="75" id="abreviatura">';

}
?>
          </font></td>
      </tr>
	  <tr align='left'> 
        <td width="13%"><font size="2" face="Arial" color="#0066CC"><b>C&oacute;digo</b></font></td>
<?
	if ($codigo!='')
{
    echo '<td width="87%"><font size="1" face="Arial"> <input name="codigo" id="codigo" type="text" size="75" value="'.$codigo.'">';
}
else
{
    echo '<td width="87%"><font size="1" face="Arial"> <input name="codigo" id="codigo" type="text" size="75">';
}

?>

          </font></td>
      </tr>
      
      <tr align='left'> 
        <td width="13%"><font size="2" face="Arial" color="#0066CC"><b>Nombre</b></font></td>
	 <?
	  if ($nombre!='')
{
    echo '<td width="87%"><font size="1" face="Arial"> <input name="nombre" id="nombre" type="text" size="75" value="'.$nombre.'">';
}
else
{
    echo '<td width="87%"><font size="1" face="Arial"> <input name="nombre" id="nombre" type="text" size="75">';
}
?>
       
          </font></td>
      </tr>
      

      <tr align='left'> 
        <td width="13%"><font size="2" face="Arial" color="#0066CC"><b>Nombre Inglés</b></font></td>
	 <?
	  if ($nombre_en!='')
{
    echo '<td width="87%"><font size="1" face="Arial"> <input name="nombre_en" id="nombre" type="text" size="75" value="'.$nombre_en.'">';
}
else
{
    echo '<td width="87%"><font size="1" face="Arial"> <input name="nombre_en" id="nombre" type="text" size="75">';
}
?>
       
          </font></td>
      </tr>

       
     
      <tr align='left'> 
        
	<td width="13%"><span class=general><h3>Titulaci&oacute;n</h3></span></td> 
        <td width="87%">
	<span class=general><input type="hidden" name="titulacion" id='titulacion'><? generar_desplegable_titulacion($resultado,"titulacion",$titulacion); ?>
	</span> </td>
         
      </tr>
      
      <tr align='left'> 
        <td width="13%"><font size="2" face="Arial" color="#0066CC"><b>Semestre</b></font></td>
<?
	if ($semestre!='')
{
    echo '<td width="87%"><font size="1" face="Arial"> <input name="semestre" id="semestre" type="text" size="75" value="'.$semestre.'">';
}
else
{
    echo '<td width="87%"><font size="1" face="Arial"> <input name="semestre" id="semestre" type="text" size="75">';
}
?>
  
          </font></td>
      </tr>
      
      <tr align="left" valign="middle"> 
        <td><font size="2" face="Arial" color="#0066CC"><b>Nivel</b></font></td>
        <td><font size="1" face="Arial">
          <select size="1" name="nivel" id='nivel'>
<?
	  if ($nivel!="")
{
    echo '<option selected value="'.$nivel.'">'.$nivel.'</option>';
    echo '<option value="1">1er ciclo</option>';
}
else
{
    echo '<option selected value="1">1er ciclo</option>';
}
?>
            <option value="2">2º ciclo</option>
	    <option value="12">1er y 2º ciclo</option>
            <option value="doctorado">Doctorado</option>
            <option value="propios">Estudios Propios</option>
	    <option value="postgrado">Postgrado</option>
	    <option value="grado">Estudios de Grado</option>
          </select>
          </font></td>
      </tr>
        
      <tr align='left'> 
        <td><font size="2" face="Arial" color="#0066CC"><b>A&ntilde;o</b></font></td>
        <td><font size="1" face="Arial"> 
<?
	if ($anio!="")
{
    echo '<input name="anio" id="anio" type="text" size="75" value="'.$anio.'">';
}
else
{
    echo '<input name="anio" id="anio" type="text" size="75">';
}
?>
          </font></td>
      </tr>
     
      <tr align='left'> 
        <td><font size="2" face="Arial" color="#0066CC"><b>Cr&eacute;ditos</b></font></td>
        <td><font size="1" face="Arial"> 
<?
	if ($creditos!="")
{
    echo '<input name="creditos" id="creditos" type="text" size="75" value="'.$creditos.'">';
}
else
{
    echo '<input name="creditos" id="creditos" type="text" size="75">';
}
?>
  
          </font></td>
      </tr>
      
      <tr align="left" valign="middle"> 
        <td><font size="2" face="Arial" color="#0066CC"><b>Cuatrimestre</b></font></td>
        <td><font size="1" face="Arial"> 
          <select size="1" id='cuatrimestre' name="cuatrimestre">
<?
	  if ($cuatrimestre!="")
{
    echo '<option selected value="'.$cuatrimestre.'"><b>'.$cuatrimestre.'</b></option>';	
    echo '<option value="1"><b>1er Cuatrimestre</b></option>';	
}
else
{
    echo '<option selected value="1"><b>1er Cuatrimestre</b></option>';
		}
?>
            <option value="2">2º Cuatrimestre</option>
            <option value="0">Anual</option>
          </select>
          </font></td>
      </tr>
      
      
      <tr align="left" valign="middle"> 
        <td><font size="2" face="Arial" color="#0066CC"><b>Car&aacute;cter</b></font></td>
        <td><font size="1" face="Arial"> 
	<select size="1" name="caracter">
<?
	if ($caracter!="")
{
    echo '<option selected value="'.$caracter.'">'.$caracter.'</option>';
    echo '<option selected value="OBLIGATORIA">Obligatoria</option>';
}
else
{
    echo '<option selected value="OBLIGATORIA">Obligatoria</option>';
	     }
?>
	<option value="TRONCAL">Troncal</option>
	<option value="BÁSICA">B&aacute;sica</option>
	<option value="OPTATIVA">Optativa</option>
	<option value="LIBRE">Libre Elecci&oacute;n</option>
        <option value="COMPLEMENTO">Complemento Formativo</option>
	<option value="TRANSVERSAL">Transversal</option>
	<option value="FUNDAMENTAL">Fundamental</option>
	<option value="METODOLOGICO">Metodol&oacute;gico</option>
	<option value="AFIN">Af&iacute;n</option>
	<option value="TIT">Trabajo de Investicaci&oacute;n Tutelado</option>
          </select>
          </font></td>
      </tr>
      <tr align="left" valign="middle">	
      <td><font size="2" face="Arial" color="#0066CC"><b>Estado</b></font></td> 
            <td><font size="1" face="Arial">
	     <select size="1" id='estado' name="estado">
<?
	if ($estado!="")
{
    echo '<option selected value="'.$estado.'"><b>'.$estado.'</b></option>';
    echo '<option value="ordinario"><b>Ordinario</b></option>';
  
}
else
{
    echo '<option selected value="ordinario"><b>Ordinario</b></option>';
}
?>
            <option value="no_ofertada">No ofertada</option>
            <option value="extinta">Extinta</option>
	    <option value="1_anio">Queda 1 a&ntilde;o de ex&aacute;menes</option>
            <option value="2_anio">Quedan 2 a&ntilde;os de ex&aacute;menes </option>
	    <option value="especial">Especial</option>
          </select>
          </font></td>
      </tr> 

      <tr align="left" valign="middle"> 
        <td><font size="2" face="Arial" color="#0066CC"><b>Es clon</b></font></td>
        <td><font size="1" face="Arial"> 
	<select size="1" name="es_clon">
	<?
	    if ($es_clon!="")
{
    echo '<option selected value="'.$es_clon.'">'.$es_clon.'</option>';
    echo '<option value="No">No</option>';
}
else
{
    echo '<option selected value="No">No</option>';
}
?>
	<option value="Si">Si</option>
          </select>
          </font></td>
      </tr>

      <? $sql2 = "select * from asignaturas order by codigo_titulacion";

      $resultado2 = mysql_query($sql2, $link); ?>
      
       <tr align='left'> 
        
	<td width="13%"><span class=general><h3>Clon de</h3></span></td> 
        <td width="87%">
	<span class=general><input type="hidden" name="clon_padre" id='clon_padre'><? generar_desplegable_clon($resultado2,"clon_padre",$clon_padre); ?>       
	</span> </td>
	
         
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

<table width='95%' border='0' align='center'>  
<tr> 
   <td> <div align='right'> 

<?
  
  echo"<div align='right'><a href='../../index.php' class='generalbluebold'>&lt;&lt; Volver</a> </div> \n";


?>

 </td> 
</tr> 
</table>



<?php
abajo();
?>