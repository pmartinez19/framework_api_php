<?php
    require_once("./model/Locations_m.php");
    class Locations{    
        public function __construct($params, $body){
            $method = array_shift($params);
            switch ($method){
                case "GET":
                    $this->getLocation($params);
                    break;
                case "POST":
                    $this->postLocation($params, $body);
                    break;
                case "DELETE":
                    $this->deleteLocation($params);
                    break;
                default:
                    $this->notImplementedMethodLocation($params, $body, $method);
                    break;
            }
        }

        private function getLocation($params){
            $model = new Locations_model();
            if (count($params) == 0){
                $Locations = $model->getPelis();
            }else{
                switch (strtolower($params[0])){
                    case "id":
                        $Locations = $model->getLocationById($params[1]);
                        break;
                    case "anyo":
                        $Locations = $model->getLocationByLoc($params[1]);
                        break;
                    case "puntuacion":
                        $baix = 0;
                        $alt = 10;
                        if (count($params)>2){
                            $baix = $params[1];
                            $alt = $params[2];
                        }else{
                            $alt = $params[1];
                        }
                        $Locations = $model->getLocationByPassword($baix, $alt);
                        break;
                    default:
                        echo "bad request";
                }
            }
            require_once("./vista/Locations_v.php");
        }

        private function postLocation($params, $body){
            $model = new Locations_model();
            $newId = $model->appendLocation($body);
            $Locations = $model->getLocationById($newId);
            http_response_code(201);
            require_once("./vista/Locations_v.php");
        }



        private function deleteLocation($params){
            $model = new Locations_model();
            if (count($params) == 0){
                echo "bad request";
            }else{
                switch (strtolower($params[0])){
                    case "id":
                        $Locations = $model->deleteLocationById($params[1]);
                        break;
                    default:
                        echo "bad request";
                }
            }
            http_response_code(204);
        }

        private function notImplementedMethodLocation($params, $method){
            header('Content-Type: application/json');
            echo json_encode(array("error"=> "Not implemented method!", "method" => $method, "params" => $params)).PHP_EOL;
        }
    }
?>