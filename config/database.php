<?php

class Database{
    
    //this is i will put credentials to crinos database
    private $host = "localhost";
    private $db_name = "api_db";
    private $username = "root"; //TODO put my own username here
    private $password = ""; //TODO put password here

    public $conn;

    public function getConnection(){
        $this->conn = null;

        try{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        }catch(PDOException $exception){
            echo "Connection error: " .$exception->getMessage();
        }

        return $this->conn;
    }

}

?>