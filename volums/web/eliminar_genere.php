<?php
ob_start(); //activamos el almacenamiento del bufer de salida
//include de las classes necesarias
include "dades_connexio_BD.php";
include "clase_genere.php";
//creamos una instancias de la clase genere y llamamos a la funcion eliminar.
$videojocs = new genere();
$videojocs->eliminar($servername, $username, $password, $_GET["id"]);
header('Location: form_consulta_genere.php'); //redirigimos al form consulta_genere
exit; //terminamos la ejecución
ob_end_flush();
?>

