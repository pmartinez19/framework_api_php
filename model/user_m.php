<?php
    class User_model {
        private $db;
        private $user;
        public function __construct(){
            require_once("./model/connexio.php");
            $this->db=Connexio::connectar();
            $this->user=array();
        }

        public function getUserById($id){
            $sql = "SELECT id, username, email, useractive, api_key FROM USER WHERE id=:id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $this->user = $stmt->fetch(PDO::FETCH_ASSOC);
            return $this->user;
        }

        public function getUserByApiKey($api_key){
            $consulta = "SELECT * FROM USER WHERE api_key=".$api_key;
            $result = $this->db->query($consulta);
            $fila=$result->fetch(PDO::FETCH_ASSOC);
            return $fila;
        }
        
        public function getUserByEmail($email){
            $consulta = "SELECT * FROM USER WHERE email='".$email."'";
            $result = $this->db->query($consulta);
            $fila=$result->fetch(PDO::FETCH_ASSOC);
            return $fila;
        }

        public function getUserByUsername($username){
            $consulta = "SELECT * FROM USER WHERE username='".$username."'";
            $result = $this->db->query($consulta);
            $fila=$result->fetch(PDO::FETCH_ASSOC);
            return $fila;
        }

        public function getApiKey($username,$password){
            $consulta = "SELECT api_key FROM USER WHERE username='".$username."' AND password='".$password."'";
            $result = $this->db->query($consulta);
            $fila=$result->fetch(PDO::FETCH_ASSOC);
            return $fila;
        }

        /*
        public function appendUser($user_){
            $new_id = -1;
            if ( true){
                $hash_pass = password_hash($user_["pass"], PASSWORD_DEFAULT);
                $api_key = $this-> uuid;
                $consulta = "SELECT id FROM USER ORDER BY id DESC LIMIT 1;";
                $result = $this->db->query($consulta);
                $last_id = $result->fetch(PDO::FETCH_ASSOC)["id"];
                $last_id = 1;
                $new_id = $last_id + 1;
                $consulta = 'INSERT INTO USER (id, username, email, password, useractive, loginattempts, api_key) values (:id, :username,:email, :password, :useractive, :loginattemps, :api_key");';
                #$consulta = "INSERT INTO USER (id, username, email, password,api_key) VALUES(:id, :username,:email, :password, api_key);";
                $dades = [
                    'id'=>$new_id,
                    'username'=>$user_["username"],
                    'email'=>$user_["email"],
                    'password' =>$hash_pass,
                    'useractive'=>1,
                    'loginattemps'=>0,
                    'api_key'=>$api_key
                ];
                $this->db->prepare($consulta)->execute($dades);
            }
            
            return $new_id;
        }
        */
        public function appendUser($user_){
            $new_id = -1;
            if ($user_["username"] != null && $user_["email"] != null && $user_["pass"] != null){
                $hash_pass = password_hash($user_["pass"], PASSWORD_DEFAULT);
                $api_key = user::guidv4();
                $consulta = "SELECT id FROM USER ORDER BY id DESC LIMIT 1;";
                $result = $this->db->query($consulta);
                $last_id = $result->fetch(PDO::FETCH_ASSOC)["id"];
              
                $new_id = $last_id + 1;
                $consulta = 'INSERT INTO USER (id, username, email, password, useractive, loginattempts, api_key) values (:id, :username,:email, :password, :useractive, :loginattemps, :api_key)';
                

                $dades = [
                    'id'=>$new_id,
                    'username'=>$user_["username"],
                    'email'=>$user_["email"],
                    'password' =>$hash_pass,
                    'useractive'=>1,
                    'loginattemps'=>0,
                    'api_key'=>$api_key
                ];
                
                $this->db->prepare($consulta)->execute($dades);
             
                /*
                foreach ($dades as $key => $value) {
                    $preparata->bindValue(':'.$key, $value);
                }
                $preparata->execute();
                
                $preparata -> bindParam(':id', $dades['id']);
                $preparata -> bindParam(':username', $dades['username']);
                $preparata -> bindParam(':email', $dades['email']);
                $preparata -> bindParam(':password', $dades['password']);
                $preparata -> bindParam(':useractive', $dades['useractive']);
                $preparata -> bindParam(':loginattemps', $dades['loginattemps']);
                $preparata -> bindParam(':api_key', $dades['api_key']);
                
                #$what = $this->db->prepare($consulta,$dades)->execute();
                #what->execute($dades);
                $preparata->execute(); 
                #que mierda te puto pasa!!!!!!
                */
               
            }
            
            return $new_id;
        }


        public function deleteUserById($id){
            $consulta = "DELETE FROM USER WHERE ID=?;";
                
            $this->db->prepare($consulta)->execute(array($id));
        }
    }
?>