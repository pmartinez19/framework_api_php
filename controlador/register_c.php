<?php
    class register_c{
        public function __construct($params, $body){
            require_once 'vista/header.php';
            require_once 'vista/register_v.php';
            echo var_dump($params);
            echo var_dump($body);
        }

    }
?>