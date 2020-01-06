<?php

include('config.php');
class Database{
    // specify your own database credentials
    private $host = DB_HOST;
    private $db_name = DB_NAME;
    private $user_name = DB_USER;
    private $password = DB_PASS;
    public $conn;

    // get the database connection
    public function getConnection(){

        $this->conn = null;

        try{
            $this->conn = new mysqli($this->host, $this->user_name, $this->password,$this->db_name);
        }catch(mysqli_sql_exception $exception){
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->conn;
    }
}
?>
