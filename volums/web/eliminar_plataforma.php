<?php
ob_start(); //activamos el almacenamiento del bufer de salida
include "dades_connexio_BD.php";
include "clase_plataforma.php";
//creamos una instancias de la clase plataforma y llamamos a la funcion eliminar.
$videojocs = new plataforma();
$videojocs->eliminar($servername, $username, $password, $_GET["id"]);
echo "Videojuego eliminado correctamente.";
header('Location: form_consulta_plataforma.php'); //redirigimos al form consulta_plataforma
exit; //terminamos la ejecución
ob_end_flush();
?>

