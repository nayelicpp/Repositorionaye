<?php
function registrarDescarga() {
    $contador = file_get_contents('contador.txt');
    $contador = intval($contador) + 1;
    file_put_contents('contador.txt', $contador);
    
    // Registrar en log
    $log = date('Y-m-d H:i:s') . " - IP: " . $_SERVER['REMOTE_ADDR'] . "\n";
    file_put_contents('descargas.log', $log, FILE_APPEND);
    
    return $contador;
}

function obtenerEstadisticas() {
    $total = file_get_contents('contador.txt');
    $log = file('descargas.log', FILE_IGNORE_NEW_LINES);
    
    return [
        'total' => $total,
        'hoy' => count(array_filter($log, function($linea) {
            return strpos($linea, date('Y-m-d')) !== false;
        })),
        'log' => array_slice($log, -50) // Últimas 50 descargas
    ];
}
?>