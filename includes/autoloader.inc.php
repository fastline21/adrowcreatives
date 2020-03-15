<?php
    require './vendor/autoload.php';
    spl_autoload_register("myClassAutoLoader");

    function myClassAutoLoader($className) {
        $className = strtolower($className);
        $path = "classes/";
        $extension = ".class.php";
        $fullPath = $path . $className . $extension;

        if (!file_exists($fullPath)) {
            return false;
        }

        include_once($fullPath);
    }
?>