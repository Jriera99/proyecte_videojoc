<?php
ob_start(); //activamos el almacenamiento del bufer de salida
include "dades_connexio_BD.php";
include "clase_videojoc.php";
//algunos videojugos no se pueden eliminar por la forenign key
//creamos una instancias de la clase videojoc y llamamos a la funcion eliminar.
    $videojocs = new videojoc();
    $videojocs->eliminar($servername, $username, $password, $_GET["id"]);
    echo "Videojuego eliminado correctamente.";
    header('Location: consulta_videojoc.php'); //redirigimos al form consulta_videojoc
    exit;
    ob_end_flush();
    ?>