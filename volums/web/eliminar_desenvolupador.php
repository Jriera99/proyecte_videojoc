<?php
ob_start(); //activamos el almacenamiento del bufer de salida
//include de las classes necesarias
include "dades_connexio_BD.php";
include "clase_desenvolupador.php";
//creamos una instancias de la clase desenvolupador y llamamos a la funcion eliminar.
    $desenvolupadors = new desenvolupador();
    $desenvolupadors->eliminar($servername, $username, $password, $_GET["id"]);
    echo "Videojuego eliminado correctamente.";
    header('Location: form_desenvolupador.php'); //redirigimos al form desenvolupador
    exit; //terminamos la ejecución
    ob_end_flush();
?>