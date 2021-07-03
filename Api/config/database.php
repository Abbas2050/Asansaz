<?php
class Database{
 
    // specify your own database credentials
    private $host = "bigserver.host.com.pk";
    private $db_name = "bahriamall_olx";
    private $username = "bahriamall_olx";
    private $password = "a^@EP4y*,(=ud";
    public $conn;
 
    // get the database connection
    public function getConnection(){
 
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