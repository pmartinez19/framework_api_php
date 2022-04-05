<?php
    class Error_c{
        public function __construct($params){
            require_once 'vista/header.php';
            var_dump($params);
            require_once 'vista/error.php';
        }
    }
?>