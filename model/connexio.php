<?php
    class Connexio {
        public static function connectar(){
            try {
                ini_set('display_errors', 1);
                $db = new PDO("mysql:host=localhost;dbname=realQuest", "pedro", "pedro");
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $db->exec("SET CHARACTER SET UTF8");
            }
            catch(Exception $e){
                die("Connection database error:" . $e->getMessage());
            }
            return $db;
        }
    }
?>