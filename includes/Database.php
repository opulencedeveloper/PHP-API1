<?php

define('HOST', 'localhost');
define('USER_NAME', 'root');
define('PASSWORD', '');
define('DB_NAME', 'meditate');

class DataBase {
    private $connection;

    public function __construct() {
        $this->open_db_connection();
    }

    public function open_db_connection() {
        $this->connection = mysqli_connect(HOST, USER_NAME, PASSWORD, DB_NAME);

        if(mysqli_connect_error()) {
            die('Connection Error: '.mysqli_connect_error());
        }
    }

    public function escape_value($value) {
        $value = $this->connection->real_escape_string($value);
        return $value;
    }

    public function query($sql) {
        $result = $this->connection->query($sql);

        if(!$result) {
            die('Query fails: '.$sql);
        }

        return $result;
    }

    // Getting list of all rows
    public function fetch_array($result)
    {
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $resultarray[] = $row;
            }
            return $resultarray;
        }
    }

    public function fetch_row($result) {
        if($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row;
        }
    }

}

$database = new Database();