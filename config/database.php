<?php
class Database{
    private $host = "localhost";
    private $db_name = "dev";
    private $username = "dev";
    private $password = "dev";
    public $conn;

    public function singleton_db_connection(){
        $this->conn = null;
        try{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }
  
        return $this->conn;
    }
}
?>