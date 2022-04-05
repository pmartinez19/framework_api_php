<?php
    Class User_model {
        private $db;
        private $user;
        public function __construct(){
            require_once("./model/connexio.php");
            $this->db=Connexio::connectar();
            $this->user=array();
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

        public function appendUser($user_){
            $new_id = -1;
            if ($user_){
                $consulta = "SELECT ID FROM USER ORDER BY ID DESC LIMIT 1;";
                $result = $this->db->query($consulta);
                $last_id = $result->fetch(PDO::FETCH_ASSOC)["ID"];
                $new_id = $last_id + 1;
                $consulta = "INSERT INTO USER (id, username, email, password,api_key) VALUES(:id, :username,:email, :password, api_key);";
                $dades = [
                    'id'=>$new_id,
                    'username'=>$user_->username,
                    'email'=>$user_->email,
                    'password' =>$user_->pass,
                    'api_key'=>$user_->api_key
                ];
                $res_insert = $this->db->prepare($consulta)->execute($dades);
            }
            return $new_id;
        }

        public function deleteUserById($id){
            $consulta = "DELETE FROM USER WHERE ID=?;";
                
            $res_delete = $this->db->prepare($consulta)->execute(array($id));
        }
    }
?>