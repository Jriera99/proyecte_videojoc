<!-- Primera función -->
<?php
function carregarInformacio() {
    $fitxer = 'games.json';
    $contingut = file_get_contents($fitxer);
    $informacio = json_decode($contingut, true);

    return $informacio;
}
function mostrarVideojocs($videojocs) {
    echo '<html>
            <head>
                <title>Información de Videojuegos</title>
            </head>
            <body>';

    if (!empty($videojocs)) {
        echo '<table>
                <tr>
                    <th>Nom</th>
                    <th>Desenvolupador</th>
                    <th>Any de Llançament</th>
                </tr>';

        foreach ($videojocs as $videojoc) {
            echo '<tr>
                    <td>' . $videojoc['Nom'] . '</td>
                    <td>' . $videojoc['Desenvolupador'] . '</td>
                    <td>' . $videojoc['Llançament'] . '</td>
                </tr>';
        }

        echo '</table>';
    } else {
        echo '<p>No hay información de videojuegos disponible.</p>';
    }

    echo '</body>
    </html>';
}
?>
<!-- Segunda función, asignar un número a cada juego -->

<?php

function asignarNumeroAVideojuegos($videojocs) {
    // Cargar el contenido del archivo JSON
    $fitxer = 'games.json';
    $contingut = file_get_contents($fitxer);
    $videojocsExistents = json_decode($contingut, true);

    // Verificar si ya hay videojuegos con ID asignado
    $maxID = 0;
    foreach ($videojocsExistents as $videojoc) {
        if (isset($videojoc['ID'])) {
            $maxID = max($maxID, $videojoc['ID']);
        }
    }

    // Asignar ID a los videojuegos que no lo tienen
    foreach ($videojocs as &$videojoc) {
        if (!isset($videojoc['ID'])) {
            $maxID++;
            $videojoc['ID'] = $maxID;
        }
    }

    // Sobrescribir el archivo original con la información actualizada
    file_put_contents($fitxer, json_encode($videojocs, JSON_PRETTY_PRINT));

    return $videojocs;
}
?>

<!-- TERCERA FUNCIÓN, ELIMINAR VIDEOJUEGO -->
<?php
function eliminarJuegosPorFecha($archivoOriginal, $archivoResultado) {
    // Leer el contenido del archivo original
    $contenidoOriginal = file_get_contents($archivoOriginal);

    // Decodificar el JSON a un array asociativo
    $videojocs = json_decode($contenidoOriginal, true);

    // Filtrar los juegos por la fecha
    $videojocsFiltrados = array_filter($videojocs, function($juego) {
        $fechaLanzamiento = $juego['Llançament'];

        // Verificar si la fecha está fuera del rango deseado (2020-01-01 a 2020-12-31)
        return !(strtotime($fechaLanzamiento) >= strtotime('2020-01-01') && strtotime($fechaLanzamiento) <= strtotime('2020-12-31'));
    });

    // Crear un nuevo archivo JSON con la información actualizada
    file_put_contents($archivoResultado, json_encode($videojocsFiltrados, JSON_PRETTY_PRINT));

    return $videojocsFiltrados;
}

function carregarInformaciono2020() {
    $fitxer2 = 'JSON_Resultat_Eliminar.json';
    $contingut2 = file_get_contents($fitxer2);
    $informacio2 = json_decode($contingut2, true);

    return $informacio2;
}
?>
<!-- CUARTA FUNCIÓN -->
<?php

function cargarinfo() {
    $fitxer = 'games.json';
    $contingut = file_get_contents($fitxer);
    $informacio = json_decode($contingut, true);

    return $informacio;
}

function agregarFechaExpiracion($juegos) {
    foreach ($juegos as &$juego) {
        $fechaLanzamiento = new DateTime($juego['Llançament']);
        $fechaExpiracion = $fechaLanzamiento->modify('+5 years')->format('Y-m-d');
        $juego['FechaExpiracion'] = $fechaExpiracion;
    }

    return $juegos;
}

?>
<!-- QUINTA FUNCIÓN -->
<?php
function jocsRepetits($jsonString) {
    $videojocs = json_decode($jsonString, true);
    $ids = array();

    foreach ($videojocs as $videojoc) {
        if (isset($videojoc['ID'])) {
            $ids[] = $videojoc['ID'];
        }
    }

    return count($ids) !== count(array_unique($ids)) ? 1 : 0;
}
?>
<!-- SEXTA FUNCIÓN -->
<!-- SEXTA FUNCIÓN -->
<?php
function carregarInformacioFuncion6() {
    $archivoFuncion6 = 'games.json';
    $contenidoFuncion6 = file_get_contents($archivoFuncion6);
    $informacionFuncion6 = json_decode($contenidoFuncion6, true);
    return $informacionFuncion6;
}

function comprobarRepetitsFuncion6($juegosFuncion6) {
    $repetidosFuncion6 = [];
    $contadorFuncion6 = array_count_values(array_column($juegosFuncion6, 'Nom'));

    foreach ($contadorFuncion6 as $nombreFuncion6 => $cantidadFuncion6) {
        if ($cantidadFuncion6 > 1) {
            $repetidosFuncion6[$nombreFuncion6] = $cantidadFuncion6;
        }
    }

    return $repetidosFuncion6;
}

function guardarRepetidosEnJSONFuncion6($repetidosFuncion6) {
    $jsonResultFuncion6 = json_encode($repetidosFuncion6, JSON_PRETTY_PRINT);
    file_put_contents('JSON_Resultat_repetits.json', $jsonResultFuncion6);
}


function mostrarRepetits($juegosRepetidosFuncion6) {
    echo '<h2>Videojuegos Repetidos:</h2>';
    echo '<table border="1" style="width: 100%">';
    echo '<thead>';
    echo '<tr>';
    echo '<th>Título</th>';
    echo '<th>Veces</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';
    foreach ($juegosRepetidosFuncion6 as $juego => $cantidad) {
        echo '<tr>';
        echo '<td>' . $juego . '</td>';
        echo '<td>' . $cantidad . '</td>';
        echo '</tr>'; 
    }
    echo '</tbody>';
    echo '</table>';
  }
  

?>

<!-- SEPTIMA FUNCIÓN -->
<?php
function eliminarRepetits($juegos) {
    $juegossinrepetir = array_map("unserialize", array_unique(array_map("serialize", $juegos)));

    return $juegossinrepetir;
}

function guardarSinRepetirEnJSON($juegossinrepetir) {
    $jsonResult = json_encode($juegossinrepetir, JSON_PRETTY_PRINT);
    file_put_contents('JSON_Resultat_eliminar_repetits.json', $jsonResult);
}

?>
<!-- OCTAVA FUNCIÓN -->
<?php
function ordenarPorFecha($fecha) {
    usort($fecha, function($fecha1, $fecha2) {
        return strtotime($fecha1['Llançament']) - strtotime($fecha2['Llançament']);
    });
    return $fecha;
}
?>
<!-- NOVENA FUNCIÓN -->
<?php

function cargarInfoJuegos() {
    $archivo = 'games.json';
    $contenido = file_get_contents($archivo);
    $informacion = json_decode($contenido, true);

    return $informacion;
}

function ordenarJuegosAlfabeticamente($juegos) {
    usort($juegos, function ($a, $b) {
        return strcmp($a['Nom'], $b['Nom']);
    });

    return $juegos;
}
?>
<!-- DECIMA FUNCIÓN -->
<?php

function contarVideojuegosPorAnio($videojocs) {
    $conteoPorAnio = array();

    foreach ($videojocs as $videojoc) {
        $anio = $videojoc['Llançament'];

        // Extraer el año de la fecha y contar
        $anio = date('Y', strtotime($anio));

        if (array_key_exists($anio, $conteoPorAnio)) {
            $conteoPorAnio[$anio]++;
        } else {
            $conteoPorAnio[$anio] = 1;
        }
    }

    return $conteoPorAnio;
}

?>
<!-- mostrar menú -->
<?php
function mostrarMenu() {
    echo '<html lang="ca">';
    echo '<link rel="stylesheet" href="css/index.css">';
    echo '<header>';
    echo '<h1 style="font-family: "Courier New", monospace;">';
    echo '<a href="index.php">PROJECTE VIDEOJOCS PHP</a>';
    echo '</h1>';
    echo '<img src="img/php.png" alt="imgphp" width="80" height="80">';
    echo '</header>';
    echo '<nav>';
    echo '<input type="checkbox" id="menu-toggle">';
    echo '<label for="menu-toggle">☰ Menú</label>';
    echo '<ul>';
    echo '<li><a href="funcion1.php">TOTS ELS NOSTRES JOCS</a></li>';
    echo '<li><a href="funcion2.php">ID\'S DELS JOCS</a></li>';
    echo '<li><a href="funcion3.php">Eliminar Videojocs</a></li>';
    echo '<li><a href="funcion4.php">Afegir Data Expiració</a></li>';
    echo '<li><a href="funcion5.php">Comprovar Repetits</a></li>';
    echo '<li><a href="funcion6.php">Comprovar Repetits Ampliada</a></li>';
    echo '<li><a href="funcion7.php">Eliminar Repetits</a></li>';
    echo '<li><a href="funcion8.php">Videojoc més Modern i més Antic</a></li>';
    echo '<li><a href="funcion9.php">Ordenació Alfabètica de Videojocs</a></li>';
    echo '<li><a href="funcion10.php">Comptar videojocs de cada any</a></li>';
    echo '<li><a style="color: #ffcc00;" href="form_videojoc.php">Formularis 2n AV</a></li>';
    echo '</ul>';
    echo '</nav>';
    }
?>


