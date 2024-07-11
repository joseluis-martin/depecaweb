<?php
require_once("../../../../core/bibliotecaint.inc.php");
include("../../../../core/conexion.inc.php"); //Conexi�n con la base de datos
arriba("", "asig_docencia", "es", "Asignaci&oacute;n de Docencia");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Nuevo Personal</title>
    <style>
      form div {
          display: flex;
          align-items: center;
          margin-bottom: 10px; /* Ajusta este valor para mayor o menor separación entre líneas */
      }

      form div label {
          width: 200px; /* Ajusta este valor según tus necesidades */
          margin-right: 10px; /* Espacio entre el label y el campo de entrada */
          text-align: right; /* Alinea el texto del label a la derecha */
      }

      form div input[type="text"],
      form div input[type="email"],
      form div input[type="file"],
      form div select {
          flex-grow: 1;
      }

      input[type="submit"] {
          width: auto; /* Ajusta automáticamente al contenido */
          padding: 0 10px; /* Espacio adicional alrededor del texto */
          margin-left: 210px; /* Alinea con el resto del formulario */
      }

      .checkbox-container {
          display: flex;
          align-items: center;
          margin-left: 210px; /* Alinea con el resto del formulario */
      }

      .checkbox-container label {
          margin-right: 5px; /* Espacio entre el label y el checkbox */
          width: auto; /* Asegura que el label no tenga un ancho fijo */
      }

      .checkbox-container input[type="checkbox"] {
          margin: 0; /* Elimina el margen por defecto del checkbox */
      }
</style>
    <script>
        function mostrarCamposAdicionales() {
            var puesto = document.getElementById("puesto").value;
            var camposAdicionales = document.getElementById("campos_adicionales");
            var checkbox = document.getElementById("mostrar_campos_adicionales");
            console.log(puesto);
            if (puesto == "CU" || puesto == "CEU" || puesto == "TU" || puesto == "TUI" || puesto == "TEU" || puesto == "TEUI"
            || puesto == "COL" || puesto == "AY" || puesto == "AS" || puesto == "CD" || puesto == "CND" || puesto == "PES") {
                checkbox.checked = true;
                camposAdicionales.style.display = "block";
            } else {
                camposAdicionales.style.display = checkbox.checked ? "block" : "none";
            }
            console.log(camposAdicionales.style.display);
        }

        function toggleCamposAdicionales() {
            var checkbox = document.getElementById("mostrar_campos_adicionales");
            var camposAdicionales = document.getElementById("campos_adicionales");
            console.log(checkbox.checked);
            camposAdicionales.style.display = checkbox.checked ? "block" : "none";
            console.log(camposAdicionales.style.display);
        }

        window.onload = function() {
            mostrarCamposAdicionales();
        };
    </script>
</head>

<body>

<p><font color="#0073B4" face="Arial"><strong>INTRODUCIR DATOS</strong></font></p>
  <form  name="formpersonal" method="post" action="inspersonal.php" enctype="multipart/form-data">
    <div>
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" size="40" required>
    </div>
    <div>
        <label for="apellidos">Apellidos:</label>
        <input type="text" id="apellidos" name="apellidos" size="70" required>
    </div>
    <div>
        <label for="iniciales">Iniciales Profesor:</label>
        <input type="text" id="iniciales" size="20" name="iniciales">
        <small>Ej. A.ALONSO</small>
    </div>
    <div>
        <label for="email">E_mail:</label>
        <input type="text" id="email" size="50" name="email">
    </div>
    <div>
        <label for="nif">NIF:</label>
        <input type="text" id="nif" name="nif" size="10" required>
    </div>
    <div>
        <label for="telefono_universidad">Tel&eacute;fono Universidad:</label>
        <input type="text" id="telefono_universidad" name="telefono_universidad" size="15">
    </div>
    <div>
        <label for="despacho">Despacho:</label>
        <input type="text" id="despacho" name="despacho" size="10">
    </div>
    <div> 
      <label for="puesto">Puesto:</label>
        <select id="puesto" name="puesto"  size="auto" onchange="mostrarCamposAdicionales()" required>
          <?
            $link= Conectarse();
            $sql = "select * from personal_cargos order by orden DESC";
            $result = mysql_query($sql, $link);

            while ($value=mysql_fetch_array($result))
            {
                echo '<option value='.$value["cargo"].">".$value["titulo"]."</option>\n";
            }
            mysql_free_result($result);
            mysql_close($link);
          ?>
         </select>
    </div>
    <div class="checkbox-container">
      <label for="mostrar_campos_adicionales">Imparte docencia:</label>
      <input type="checkbox" id="mostrar_campos_adicionales" name="mostrar_campos_adicionales" onchange="toggleCamposAdicionales()">
    </div>

    <div id="campos_adicionales">
        <div>
            <label for="cargamax">Carga m&aacute;xima Dpto.:</label>
            <input type="text" id="cargamax" name="cargamax" size="10">
        </div>
        <div>
            <label for="cargamax_rect">Carga m&aacute;xima Rectorado:</label>
            <input type="text" id="cargamax_rect" name="cargamax_rect"size="10">
        </div>
        <div>
            <label for="situacion_academica">Situaci&oacute;n acad&eacute;mica:</label>
            <select id="situacion_academica" name="situacion_academica" size="auto">
                <option value="activo">Activo</option>
                <option value="sabatico">Sab&aacute;tico</option>
                <option value="excedencia">Excedencia</option>
            </select>
        </div>
        <div>
          <label for="unidad_docente">Unidad docente:</label>
          <select id="unidad_docente" name="unidad_docente" size="auto">
            <?
                $link= Conectarse();
                $sqlUD = "select * from unidades_docentes order by id";
                $resultadoUD = mysql_query($sqlUD, $link);

                while ($value=mysql_fetch_array($resultadoUD))
                {
                    echo '<option value='.$value["id"].'>'.$value["nombre"].'</option>';
                }
                mysql_free_result($resultadoUD);
                mysql_close($link);
              ?> 
          </select>
        </div>
      </div>
    <div>
      <label for="cargo">Cargo:</label>
      <select id="cargo" name="cargo" size="auto">
           <?
            $link= Conectarse();
            $sql = "select * from personal_cargos order by orden DESC";
            $result = mysql_query($sql, $link);

            while ($value=mysql_fetch_array($result))
            {
                echo '<option value='.$value["cargo"].">".$value["titulo"]."</option>\n";
            }
            mysql_free_result($result);
            mysql_close($link);
          ?>
       </select>
    </div>
    <div>
      <label for="userfile">Foto:</label>
      <input name="userfile" type="file" size="36">
      <span class="submited">Dim: 79x89</span></td>
    </div>
      <div>
        <input type="submit" name="enviar" value="Enviar">
      </div>
    </form>
    <div align="right">
        <a href="../../index.php" class="generalbluebold">&lt;&lt; Volver</a>
    </div>
</div>

<?php
abajo();
?>

</body>