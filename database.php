<?php

class database{

        private $server = "localhost";
        private $user = "root";
        private $password = "";
        private $db_name = "user";
        public $pdo;
        //public $qwe = "nadeem";
    public function __construct(){
        if(!isset($this->pdo)){
            try {
            $this->pdo = new PDO("mysql:host=".$this->server.";dbname=".$this->db_name,$this->user,$this->password);
            //echo $this->qwe;
            } catch (PDOException $e) {
                die("connection error".$e->getMessage());
            }
        }
    }
}

?>