<?php
// conexion.inc.new.php
function Conectarse()
{
    $config = require 'config.php';

    $db_host = $config['db_host'];
    $db_nombre = $config['db_nombre'];
    $db_user = $config['db_user'];
    $db_pass = $config['db_pass'];

    // Crear la conexión usando mysqli
    $link = new mysqli($db_host, $db_user, $db_pass, $db_nombre);

    // Comprobar la conexión
    if ($link->connect_error) {
        die("Conexión fallida: " . $link->connect_error);
    }

    // Devolver la conexión
    return $link;
}
