<?php
    require_once("./model/user_m.php");
    class User{    
        public function __construct($params, $body){
            $method = array_shift($params);
            #$api_key = array_shift($params);
            switch ($method){
                case "GET":
                    var_dump($params);
                    break;
                case "POST":
                    foreach ($_POST as $key => $value) {
                        $body[$key] = $value;
                    }
                    
                    $this->postUser($params, $body);

                    break;
                case "DELETE":
                    $this->deleteUser($params);
                    break;
                default:
                    #$this->notImplementedMethodUser($params, $body, $method);
                    echo "no funciona";
                    break;
            }
        }

        public static function guidv4($data = null) {
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
       

        public function postUser($params, $body){
            $model = new User_model();
            switch (strtolower($params[0])){
                
                case "login":
                    $pass = $body->pass;
                    $username = $body->username;
                                    
                case "register":
                    
                    $newId = $model->appendUser($body);
         

                    if ($newId != -1){
                        http_response_code(201);
                        $userP = $model->getUserById($newId);
                        #require_once("/../vista/login_v.php");
                        echo json_encode($userP).PHP_EOL;

                    }
                    else{
                        echo "bad request";
                    }
             
            }
 
            
        }

        

        public function deleteUser($params){
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

        public function notImplementedMethodUser($params, $method){
            header('Content-Type: application/json');
            echo json_encode(array("error"=> "Not implemented method!", "method" => $method, "params" => $params)).PHP_EOL;
        }

    }
?>