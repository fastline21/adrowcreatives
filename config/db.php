<?php
    $parseData = parse_ini_file('.env');
    define("DB_SERVER", $parseData['DB_SERVER']);
    define("DB_USERNAME", $parseData['DB_USERNAME']);
    define("DB_PASSWORD", $parseData['DB_PASSWORD']);
    define("DB_DATABASE", $parseData['DB_DATABASE']);
?>