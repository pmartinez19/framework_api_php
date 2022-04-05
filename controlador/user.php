<?php
    require_once("./model/User_m.php");
    class User{    
        public function __construct($params, $body){
            $method = array_shift($params);
            $api_key = array_shift($params);
            $uuid = $this->guidv4();
            switch ($method){
                case "GET":
                    $this->getUser($params);
                    break;
                case "POST":
                    $this->postUser($params, $body);
                    break;
                case "DELETE":
                    $this->deleteUser($params);
                    break;
                default:
                    $this->notImplementedMethodUser($params, $body, $method);
                    break;
            }
        }

        public function guidv4($data = null) {
            // Generate 16 bytes (128 bits) of random data or use the data passed into the function.
            $data = $data ?? random_bytes(16);
            assert(strlen($data) == 16);
        
            // Set version to 0100
            $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
            // Set bits 6-7 to 10
            $data[8] = chr(ord($data[8]) & 0x3f | 0x80);
        
            // Output the 36 character UUID.
            return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
        }
        /**
         * 
         * @param type $params
         * @param type $body
         */
        /*
        private function getUser($params){
            $model = new User_model();
            $user = $model->getUserById($params[0]);
                    default:
                        echo "bad request";
                }
            }
            #require_once("./vista/User_v.php");
        }
        */

        private function postUser($params, $body){
            $model = new User_model();
            switch (strtolower($params[0])){
                case "login":
                    $pass = $body->password;
                    $username = $body->username;
                    

                
                case "register":
                    $newId = $model->appendUser($body);

                    if ($newId != -1){
                        http_response_code(201);
                        $user = $model->getUserById($newId);
                        require_once("./vista/login_v.php");
                    }
                    else{
                        echo "bad request";
                    }
            }
            
        }



        private function deleteUser($params){
            $model = new User_model();
            if (count($params) == 0){
                echo "bad request";
            }else{
                switch (strtolower($params[0])){
                    case "id":
                        $User = $model->deleteUserById($params[1]);
                        break;
                    default:
                        echo "bad request";
                }
            }
            http_response_code(204);
        }

        private function notImplementedMethodUser($params, $method){
            header('Content-Type: application/json');
            echo json_encode(array("error"=> "Not implemented method!", "method" => $method, "params" => $params)).PHP_EOL;
        }
    }
?>