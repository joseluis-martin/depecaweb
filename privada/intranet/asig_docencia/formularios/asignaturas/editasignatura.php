<?php
require_once("../../../../core/bibliotecaint.inc.php");
include("../../../../core/conexion.inc.php"); //Conexi�n con la base de datos
arriba("", "asig_docencia", "es", "Asignaci&oacute;n de Docencia");
?>
<script>
var valor;

function Redireccion(value) {
// Obtenemos el valor de la opcion que se eligio
    valor = value;//document.form1.titulacion.value;
// Y enviamos el navegador a una URL compuesta por el mismo archivo PHP que estemos viendo y una variable con el valor recien obtenido
    location.href = "./editasignatura.php?codigotit=" + valor;
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


function generar_desplegable_titulacion($resultado,$titulacion,$contador)
{

        $link=Conectarse();
	$numero_elementos=mysql_num_rows($resultado);
	$row=mysql_fetch_array($resultado);
	 
        $sqltit = "select * from carreras where codigo='$titulacion'";

        $resultadotit = mysql_query($sqltit, $link);
	$rowtit=mysql_fetch_array($resultadotit);
	$nombre=$rowtit['nombre'];
	echo "<input type='hidden' name='titulacionor".$contador,"' value='".$rowtit['nombre']."'>";
	echo "<select name='titulacion".$contador."' size='1'>";
	echo "<option selected value='$nombre'>".$rowtit['nombre']."</option>"; 
	
	for($i=0;$i<$numero_elementos;$i++)
	{
	?><option value="<?echo $row['nombre']?>"><?echo $row['nombre'] ?></option>
	<?
	$row=mysql_fetch_array($resultado);
	}	
	?>
	</select>
	<?
}

function generar_desplegable_unidad_docente($resultadoUD,$desplegable,$unidad_docente)
{
	//list($campo_pert,$elemento)=split("-",$nombre);
	$numero_elementos=mysql_num_rows($resultadoUD);
	$row=mysql_fetch_array($resultadoUD);
	?>
  
	<select name="<?echo $desplegable?>" size="1">
	<?
	     if ($unidad_docente!="" && $unidad_docente!=".")
	     {
            $link = Conectarse();
            $sqlUDsel = "select * from unidades_docentes where id='$unidad_docente'"; 
            $resultadoUDsel = mysql_query($sqlUDsel, $link);
            $rowUDsel=mysql_fetch_array($resultadoUDsel);          
            echo '<option selected value="'.$rowUDsel["id"].'">'.$rowUDsel["nombre"].'</option>';
	     }
	     else
	     {
		    echo '<option selected value=".">Seleccione</option>';
	     }

	for($i=0;$i<$numero_elementos;$i++)
	{
	?><option value="<?echo $row['id']?>"><?echo $row['nombre']; ?></option>
	<?
	$row=mysql_fetch_array($resultadoUD);
	}	
	?>
	</select>
	<?
}

$link = Conectarse();
$sqlcarreras = "select * from carreras order by nombre";
$resul_carreras = mysql_query($sqlcarreras, $link);
$sqlUD = "select * from unidades_docentes order by id";
$resultadoUD = mysql_query($sqlUD, $link);

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
<form name='form1' method='post' action='editasignatura.php' enctype='multipart/form-data' >
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


<?

$codigo=($_POST['selasignatura']);

if($codigo!='' && $codigo!='' ){
    //Conexion con la base

    $link=Conectarse();

   //Ejecutamos la sentencia SQL

    $result=mysql_query("SELECT * FROM asignaturas where codigo='$codigo'",$link);

    $row=mysql_fetch_array($result);
    


    //consulta de titulacion

    $sql = "select * from carreras order by codigo";

    $resultado = mysql_query($sql, $link);

    //Valores
    
    $estado=$row["estado"];
    if ($estado == "ordinario") {
	$estado = "Ordinario";
   }
    else if($estado=="no_ofertada"){
       $estado = "No ofertada";
   }
    else if($estado=="extinta"){
	$estado="extinta";
    }
    else if($estado=="1_anio"){
	$estado="Queda 1 a&ntilde;o de ex&aacute;menes";
    }	
    else $estado="Quedan 2 a&ntilde:os de ex&aacute;menes"; 	
    
    $niv = $row["nivel"];
 
   if ($niv == 1) {
	$nivel = "1er Ciclo";
   }
   else{
       $nivel = "2o ciclo";
   }
   
   $cuatr = $row["cuatrimestre"];

   if ($cuatr == 1) {
       $cuatrimestre = "1er Cuatrimestre";
   }
   elseif ($cuatr == 2){
       $cuatrimestre = "2do Cuatrimestre";
   }else{
       $cuatrimestre = "Anual";
   }
   
  //FIn Valores
   echo"<p align='center'><font color='#0066CC' face='Arial'><b>EDITAR ASIGNATURA</b></font></p> \n";
   
   echo"<form name='formasignatura' method='post' action='editasignatura2.php?codigo=".$codigo."'> \n";
   echo" <table width='100%' height='242' border='0'> \n";
   
   echo"<tr> \n";
        echo"<td width='19%' class='general'><font size='2' face='Arial' color='#0066CC'><b> Abreviatura</b></font> </td>\n";
        echo"<td width='81%' class='general'> \n";
        echo"<textarea name='abreviatura' cols='57' rows='1'>".$row["abreviatura"]."</textarea>\n";
        echo"</td>\n";
   echo"</tr>\n";
   
   echo"<tr> \n";
        echo"<td width='19%' class='general'><font size='2' face='Arial' color='#0066CC'><b> C&oacute;digo Asignatura</b></font> </td>\n";
        echo"<td width='81%' class='general'> \n";
        echo"<textarea readonly name='codigo' cols='57' rows='1'>".$row["codigo"]."</textarea>\n";
        echo"</td>\n";
   echo"</tr>\n";
   
   echo"<tr> \n";
        echo"<td width='19%' class='general'><font size='2' face='Arial' color='#0066CC'><b> Nombre</b></font> </td>\n";
        echo"<td width='81%' class='general'> \n";
        echo"<textarea name='nombre' cols='57' rows='1'>".$row["nombre"]."</textarea>\n";
        echo"</td>\n";
   echo"</tr>\n";

   echo"<tr> \n";
        echo"<td width='19%' class='general'><font size='2' face='Arial' color='#0066CC'><b> Nombre Ingl&eacute;s</b></font> </td>\n";
        echo"<td width='81%' class='general'> \n";
        echo"<textarea name='nombre_en' cols='57' rows='1'>".$row["nombre_en"]."</textarea>\n";
        echo"</td>\n";
   echo"</tr>\n";


   $contador=0;
  do {
      $contador=$contador+1;
      echo "<tr align='left'>";
        
    echo 	'<td width="13%"><span class=general><h3>Titulacion</h3></span></td>'; 
 echo '<td width="87%">';
    $sql = "select * from carreras order by codigo";

    $resultado = mysql_query($sql, $link);

    echo '<span class=general><input type="hidden" name="titulacion" id="titulacion">';
 generar_desplegable_titulacion($resultado,$row['codigo_titulacion'],$contador);       
   echo 	"</span> </td>";
	      
     
    echo "</tr>";

	            }   while ( $row=mysql_fetch_array($result));
    echo '<input type="hidden" name="contador" id="contador" value='.$contador.'>';

   $result=mysql_query("SELECT * FROM asignaturas where codigo='$codigo'",$link);

    $row=mysql_fetch_array($result);
   
    ?>
    
      <tr align='left'> 
        
        <td width="19%"><span class=general><h3>Unidad Docente</h3></span></td> 
            <td width="81%">
                
        <span class=general><input type="hidden" name="unidad_docente" id='unidad_docente'><? generar_desplegable_unidad_docente($resultadoUD,'unidad_docente',$row["unidad_docente"]); ?>
        </span> </td>
             
          </tr>
   
   <?php
    echo"<tr> \n";
        echo"<td width='19%' class='general'><font size='2' face='Arial' color='#0066CC'><b> Semestre</b></font> </td>\n";
        echo"<td width='81%' class='general'> \n";
        echo"<textarea name='semestre' cols='57' rows='1'>".$row["semestre"]."</textarea>\n";
        echo"</td>\n";
   echo"</tr>\n";
   
  echo"<tr align='left' valign='middle'> \n";  
        echo"<td class='general'><font size='2' face='Arial' color='#0066CC'><b> Car&aacute;cter</b></font> </td> \n"; 
        echo"<td class='general'> \n";  
          echo"<select name='caracter' id='caracter'> \n"; 
            echo"<option selected value=".$row["caracter"].">".$row["caracter"]."</option> \n"; 
            echo"<option value='OBLIGATORIA'>Obligatoria</option> \n"; 
	    echo"<option value='BASICA'>B&aacute;sica</option> \n";
            echo"<option value='TRONCAL'>Troncal</option> \n"; 
            echo"<option value='OPTATIVA'>Optativa</option> \n"; 
            echo"<option value='LIBRE'>Libre Elecci&oacute;n</option> \n";
             echo"<option value='TRANSVERSAL'>Transversal</option> \n"; 
            echo"<option value='FUNDAMENTAL'>Fundamental</option> \n"; 
            echo"<option value='METODOLOGICO'>Metodol&oacute;gico</option> \n"; 
            echo"<option value='AFIN'>Af&iacute;n</option> \n"; 
            echo"<option value='TIT'>Trabajo de Investicaci&oacute;n Tutelado</option> \n";
          echo"</select> \n"; 
        echo"</td> \n";
 echo"<tr align='left' valign='middle'> \n";  
        echo"<td class='general'><font size='2' face='Arial' color='#0066CC'><b> Estado</b></font> </td> \n"; 
        echo"<td class='general'> \n";  
          echo"<select name='estado' id='estado'> \n"; 
            echo"<option selected value=".$row["estado"].">".$estado."</option> \n"; 
            echo"<option value='ordinario'>Ordinario</option> \n"; 
            echo"<option value='no_ofertada'>No ofertada</option> \n"; 
            echo"<option value='extinta'>Extinta</option> \n"; 
            echo"<option value='1_anio'>Queda 1 a&ntilde;o de ex&aacute;menes</option> \n"; 
            echo"<option value='2_anio'>Quedan 2 a&ntilde;os de ex&aacute;menes</option> \n"; 
	    echo"<option value='especial'>Especial</option>\n";
            
          echo"</select> \n"; 
        echo"</td> \n";  
   echo"</tr> \n"; 
      
   echo"<tr> \n";
        echo"<td width='19%' class='general'><font size='2' face='Arial' color='#0066CC'><b> Cr&eacute;ditos</b></font> </td>\n";
        echo"<td width='81%' class='general'> \n";
        echo"<textarea name='creditos' cols='57' rows='1'>".$row["creditos"]."</textarea>\n";
        echo"</td>\n";
   echo"</tr>\n";
   
   echo"<tr align='left' valign='middle'> \n";  
        echo"<td class='general'><font size='2' face='Arial' color='#0066CC'><b> Nivel</b></font> </td> \n"; 
        echo"<td class='general'> \n";  
          echo"<select name='nivel' id='nivel'> \n"; 
            echo"<option selected value=".$row["nivel"].">$nivel</option> \n"; 
            echo"<option value='1'>1er Ciclo</option> \n"; 
            echo"<option value='2'>2o Ciclo</option> \n"; 
            echo"<option value='12'>1er y 2� ciclo</option> \n";
            echo"<option value='doctorado'>Doctorado</option> \n";
            echo"<option value='propios'>Estudios Propios</option> \n";
	    echo"<option value='postgrado'>Postgrado</option> \n";
          echo"</select> \n"; 
        echo"</td> \n"; 
   echo"</tr> \n"; 
   
   
   echo"<tr> \n";
        echo"<td width='19%' class='general'><font size='2' face='Arial' color='#0066CC'><b> A&ntilde;o</b></font> </td>\n";
        echo"<td width='81%' class='general'> \n";
        echo"<textarea name='anio' cols='57' rows='1'>".$row["anio"]."</textarea>\n";
        echo"</td>\n";
   echo"</tr>\n";
   
   echo"<tr align='left' valign='middle'> \n";  
        echo"<td class='general'><font size='2' face='Arial' color='#0066CC'><b> Cuatrimestre</b></font> </td> \n"; 
        echo"<td class='general'> \n";  
          echo"<select name='cuatrimestre' id='cuatrimestre'> \n"; 
            echo"<option selected value=".$row["cuatrimestre"].">$cuatrimestre</option> \n"; 
            echo"<option value='1'>1er Cuatrimestre</option> \n"; 
            echo"<option value='2'>2o Cuatrimestre</option> \n";
            echo" <option value='0'>Anual</option> \n";
          echo"</select> \n"; 
        echo"</td> \n"; 
   echo"</tr> \n"; 
        
echo"</table> \n";

echo"<table width='100%' border='0'> \n";
   echo"<tr> \n";
   echo"<td align='left'> <div align='center'>\n";
   echo"&nbsp; \n";    
   echo" <input type='submit' name='Submit' value='Enviar'> \n";
   echo"</div></td> \n";
   echo"</tr> \n";
   echo" <tr> \n";
   echo" <td> <div align='right'> \n";
 echo"<div align='right'><a href='javascript:history.back()'><span class='generalbluebold'><< 
            Volver</span></a></div> \n";
// echo"<div align='right'><a href='../../informacion.php?codigo=$codigo' class='generalbluebold'>&lt;&lt;  Volver</a> </div> \n";
   echo"</td> \n";
   echo"</tr> \n";
echo"</table> \n";

echo" </form> \n";
mysql_free_result($result);
mysql_close ($link);

}
?>

<?php
abajo();
?>