<?php
require_once("../../../core/bibliotecaint.inc.php");
include("../../../core/conexion.inc.php");
arriba("","comision","es","Comisiones Del Departamento");
$link= Conectarse();
$user=$_SESSION['user'];


 
if ($user=="director" || $user=="mocana" || $user=="revenga" || $user=="jlmartin" || $user=="secretario" )
{
echo "<td width='55%'><div align='right'><span class='generalbluebold'>Comisiones</span> \n";
echo "<a href='./subir_com.php'><span class='generalbluebold'> [A&ntilde;adir </span></a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; \n";
echo "<a href='./edit_com.php?comision=".$com."'><span class='generalbluebold'>Editar</span></a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; \n";
echo "<a href='./delete_com.php?comision=".$com."'><span class='generalbluebold'>Borrar] </span></a> </div></td> \n";
}

?>


<p><a name='departamento' style="text-decoration:none"><font color="#B9AFA5" size="4" face="Arial"><b>COMISIONES DEL CONSEJO DE DEPARTAMENTO</b></a></font></p>
    <ul>
    <li><font color="#B9AFA5" size="2" face="Arial"><a href='#comision1'><b>Comisi&oacute;n Permanente</b></a></font>
    <li><font color="#B9AFA5" size="2" face="Arial"><a href='#comision2'><b>Comisi&oacute;n Docente</b></a></font>
    <li><font color="#B9AFA5" size="2" face="Arial"><a href='#comision3'><b>Comisi&oacute;n de Anteproyectos</b></a></font>
    <li><font color="#B9AFA5" size="2" face="Arial"><a href='#comision4'><b>Comisi&oacute;n de Trabajo Fin de M&aacute;ster</b></a></font>
    <li><font color="#B9AFA5" size="2" face="Arial"><a href='#comision5'><b>Comisi&oacute;n Extensi&oacute;n Universitaria y Soporte Inform&aacute;tico</b></a></font>
    </ul>
<p><a name='departamento' style="text-decoration:none"><font color="#B9AFA5" size="4" face="Arial"><b>COMISIONES DEL PROGRAMA DE DOCTORADO</b></a></font></p>
    <ul>
    <li><font color="#B9AFA5" size="2" face="Arial"><a href='#comision6'><b>Comisi&oacute;n Acad&eacute;mica del Programa de Doctorado (CAPD)</b></a></font>
    <li><font color="#B9AFA5" size="2" face="Arial"><a href='#comision7'><b>Comisi&oacute;n de Calidad del Programa de Doctorado</b></a></font>
    </ul>
<p><a name='departamento' style="text-decoration:none"><font color="#B9AFA5" size="4" face="Arial"><b>COMISIONES DEL M&Aacute;STER UNIVERSITARIO EN INGENIER&Iacute;A ELECTR&Oacute;NICA (MUIE)</b></a></font></p>
    <ul>
    <li><font color="#B9AFA5" size="2" face="Arial"><a href='#comision8'><b>Comisi&oacute;n Acad&eacute;mica MUIE</b></a></font>
    <li><font color="#B9AFA5" size="2" face="Arial"><a href='#comision9'><b>Comisi&oacute;n de Calidad MUIE</b></a></font>
    <li><font color="#B9AFA5" size="2" face="Arial"><a href='#comision10'><b>Comisi&oacute;n Trabajo Fin de M&aacute;ster MUIE</b></a></font>
    </ul>

<p><a name='departamento' style="text-decoration:none"><font color="#B9AFA5" size="4" face="Arial"><b>CARGOS DEL PROFESORADO</b></a></font></p>
    <ul>
    <li><font color="#B9AFA5" size="2" face="Arial"><a href='#comision11'><b>Listado de cargos del profesorado</b></a></font>

    </ul>
<?php

$sql="SELECT * FROM comision WHERE orden>0 ORDER BY orden ASC";
$result=mysql_query($sql,$link);
$row=mysql_fetch_array($result);

do
    {
        echo "\n";
        echo"<table>";
        echo"<tr>";
        echo "<td class=''><font class='fuenteverde' >";echo"<font size='5' >";echo"<strong>";echo "<a name='comision".$row["orden"]."'>";echo $row["nombre"];echo"</a></strong></font></font></font></tr></td></table>";
        echo "<table width='100%'> <tr><td><font class='fuenteroja'><font size='3'>Responsables</td></tr>";
        echo "<font size='4'>";
        $usuarios = explode(";",$row["usuarios"]);
        $cuenta=count($usuarios);
        $autorizado=false;
        for ($i=0;$i<($cuenta-1);$i++)
            {
                $aux=$usuarios[$i];
                $sql9="SELECT * FROM personal WHERE usuario='$aux'";
                $result9=mysql_query($sql9,$link);
                $row9=mysql_fetch_array($result9);
                if ($aux=='secretario')
                    {
                        echo "<tr><td class='celdagris'><font class='fuentenegra'>Secretario Departamento</tr></tr>";}else
                    {
                        echo "<tr><td class='celdagris'><font class='fuentenegra'>".$row9['nombre']." ".$row9['apellidos']."</tr></tr>";
                    }	
                if ($user==$aux)
                    {
                        $autorizado=true;
                    }
            }
        if ($user=='secretario') $autorizado=true;
        echo "</font>";
        echo "</td>";
        echo "</tr>";
        echo "</table>";
        echo " \n";
        echo "\n";
        if($row['id']){
            $com=$row['id']; 
            echo '<table><tr><td align="center"><font size="3" face="Arial" color="#CC6900">Actas</font></tr></td></table>';
            if (($autorizado==true)||($user=="mocana")||($user=="revenga")|| $user=="jlmartin")
                {
                    echo "<table class='tabla'> \n";
                    echo "<tr> \n";
                    echo "<td width='55%'><div align='right'><span class='generalbluebold'>Actas</span> \n";
                    echo "<a href='./subir_doc.php?comision=".$com."'><span class='generalbluebold'>[ A&ntilde;adir </span></a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; \n";
                    echo "<a href='./edit_doc.php?comision=".$com."'><span class='generalbluebold'>Editar</span></a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; \n";
                    echo "<a href='./delete_doc.php?comision=".$com."'><span class='generalbluebold'>Borrar ]</span></a> </div></td> \n";
                }
            $sql1 = "SELECT * FROM acta_comision WHERE comision='$com'ORDER  BY fecha DESC";
            $result1 = mysql_query($sql1, $link);
            echo "<table  width='100%' border='0' align='center'><tr><td class='encabezado'><b><font color='#FFFFFF' size='4' face='Arial'>Descripci&oacute;n</td><td class='encabezado'><font color='#FFFFFF' size='4' face='Arial'><b>Comisi&oacute;n</font></b></td><td class='encabezado'><font color='#FFFFFF' size='4' face='Arial'><b>Fecha</font></b></td></tr>";
            while ($row1 = mysql_fetch_array($result1))
                {
                    echo "<tr>";
                    echo "<td class='celdagris'><font class='fuentenegra'><a href=".$row1['enlace'].">".$row1['nombre']."</font></a>";
                    echo "</td>";
                    echo "<td class='celdagris'><font class='fuentenegra'>".$row1['descripcion']."</font>";
                    echo "</td>";
                    echo "<td class='celdagris'><font class='fuentenegra'>".$row1['fecha']."</font></a>";
                    echo "</td>";
                    echo "</tr>";
                    echo " \n";
                    echo "\n";
                }
            echo "</table>";
        }else
            {
                echo "<div align='center'> \n";
                echo "<h2>No existen Comisiones</h2> \n";
                echo "</div> \n";
            }
    }while ($row=mysql_fetch_array($result));

abajo();
?>
