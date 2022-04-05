<?php
    require_once("app.php");
    $arguments_usuari = json_decode($argv[1]);
    $x_api_key = "";
    if (isset($arguments_usuari->x_api_key)){
        $x_api_key = $arguments_usuari->x_api_key;
    }
    $app = new App($arguments_usuari->params, $arguments_usuari->body, $arguments_usuari->method, $x_api_key);
?>