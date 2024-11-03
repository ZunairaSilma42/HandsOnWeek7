<?php
class Database {
    private $host = "localhost";
    private $db_name = "mydatabase";
    private $username = "root";
    private $password = "";
    public $conn;

    public function getConnections() {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";port=3308;dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        } catch(PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }
        return $this->conn;
    }
}
?>
