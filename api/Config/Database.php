<?php


class Database {
    private $username = 'root';
    private $password = 'root';
    private $hostname = '127.0.0.1';
    private $database = 'cms';

    public function getConnection() {

        $conn = new mysqli($this->hostname, $this->username, $this->password, $this->database);

        if ($conn -> connect_errno) {
            echo 'Failed to connected to database';
            exit();
        }
        return $conn;
    }
}

$database = new Database();

$conn = $database->getConnection();