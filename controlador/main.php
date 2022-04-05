<?php
    class Main{
        public function __construct($params, $body){
            $method = array_shift($params);
            switch ($method){
                case "GET":
                    $this->getMain($params);
                    break;
                case "PUT":
                    
                    $this->putMain($params, $body);
                    break;
                case "POST":
                    
                    $this->postMain($params, $body);
                    break;
                case "DELETE":
                    
                    $this->deleteMain($params, $body);
                    break;
                default:
                    
                    $this->notImplementedMethodMain($params, $body, $method);
                    break;
            }
        }

        private function getMain($params){
            require_once 'vista/header.php';
            require_once 'vista/main.php';
        }

        private function putMain($params, $body){
            header('Content-Type: application/json');
            echo json_encode(array("error"=> "Not implemented method!", "method" => "PUT", "params" => $params, "body" => $body));
        }

        private function postMain($params, $body){
            header('Content-Type: application/json');
            echo json_encode(array("error"=> "Not implemented method!", "method" => "POST", "params" => $params, "body" => $body));
        }
        
        private function deleteMain($params, $body){
            header('Content-Type: application/json');
            echo json_encode(array("error"=> "Not implemented method!", "method" => "DELETE", "params" => $params, "body" => $body));
        }

        private function notImplementedMethodMain($params, $method){
            header('Content-Type: application/json');
            echo json_encode(array("error"=> "Not implemented method!", "method" => $method, "params" => $params));
        }
    }
?>