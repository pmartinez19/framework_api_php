<?php
    Class Locations_model {
        private $db;
        private $locations;
        public function __construct(){
            require_once("./model/connexio.php");
            $this->db=Connexio::connectar();
            $this->locations=array();
        }

        public function getlocations(){
            $consulta = "SELECT * FROM PELICULA";
            $result = $this->db->query($consulta);
            while ($fila=$result->fetch(PDO::FETCH_ASSOC)){
                $this->locations[]=$fila;
            }
            return $this->locations;
        }

        public function getPeliById($id){
            $consulta = "SELECT * FROM PELICULA WHERE ID =". $id .";";
            $result = $this->db->query($consulta);
            while ($fila=$result->fetch(PDO::FETCH_ASSOC)){
                return $fila;
            }
            return null;
        }

        public function getlocationsByAnyo($anyo){
            $consulta = "SELECT * FROM PELICULA WHERE ANYO =". $anyo .";";
            $result = $this->db->query($consulta);
            while ($fila=$result->fetch(PDO::FETCH_ASSOC)){
                $this->locations[]=$fila;
            }
            return $this->locations;
        }

        public function getlocationsByPuntuacion($baix, $alt){
            $consulta = "SELECT * FROM PELICULA WHERE PUNTUACION >=". $baix ." AND PUNTUACION <=". $alt .";";
            $result = $this->db->query($consulta);
            while ($fila=$result->fetch(PDO::FETCH_ASSOC)){
                $this->locations[]=$fila;
            }
            return $this->locations;
        }

        public function appendPelicula($pelicula){
            $new_id = -1;
            if ($pelicula){
                $consulta = "SELECT ID FROM PELICULA ORDER BY ID DESC LIMIT 1;";
                $result = $this->db->query($consulta);
                $last_id = $result->fetch(PDO::FETCH_ASSOC)["ID"];
                $new_id = $last_id + 1;
                $consulta = "INSERT INTO PELICULA (ID, TITULO, ANYO, PUNTUACION, VOTOS) VALUES(:id, :titulo, :anyo, :puntuacion, :votos);";
                $dades = [
                    'id'=>$new_id,
                    'titulo'=>$pelicula->titulo,
                    'anyo'=>$pelicula->anyo,
                    'puntuacion'=>$pelicula->puntuacion,
                    'votos'=>$pelicula->votos
                ];
                $res_insert = $this->db->prepare($consulta)->execute($dades);
            }
            return $new_id;
        }

        public function deletePeliById($id){
            $consulta = "DELETE FROM PELICULA WHERE ID=?;";
                
            $res_delete = $this->db->prepare($consulta)->execute(array($id));
        }
    }
?>