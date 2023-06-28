<?php

    namespace App;
    
    // class connect{
    //     function __construct(){
    //         echo "Hola Mundo cruel";
    //     }
    // }


    // class connect{
    //     private $conn;
    //     public function __construct() {
    //         try {
    //             $this->conn = new \PDO($_ENV["DSN"].":host=".$_ENV["HOST"].";dbname=".$_ENV["DBNAME"].";user=".$_ENV["USERNAME"].";password=".$_ENV["PASSWORD"]); 
    //             $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //         } catch (PDOException $e) {
    //             die("Error de conexión: " . $e->getMessage());
    //         }
    //     }

    //     public function getConnection() {
    //         return $this->conn;
    //     }
    // }
    class Connect {
        private $conn;
    
        public function __construct() {
            try {
                $this->conn = new \PDO($_ENV["DSN"] . ":host=" . $_ENV["HOST"] . ";port=" . $_ENV["PORT"] . ";dbname=" . $_ENV["DBNAME"], $_ENV["USERNAME"], $_ENV["PASSWORD"]);
                $this->conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            } catch (\PDOException $e) {
                die("Error de conexión: " . $e->getMessage());
            }
        }
    
        public function getConnection() {
            return $this->conn;
        }
    }

?>