<?php
class Database {
    private $conn;

    public function __construct($host, $username, $password, $database) {
        $this->conn = new mysqli($host, $username, $password, $database);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function query($sql) {
        $result = $this->conn->query($sql);

        if (!$result) {
            die("Query failed: " . $this->conn->error);
        }

        return $result;
    }

    public function escape_string($value) {
        return $this->conn->real_escape_string($value);
    }

    public function insert_id() {
        return $this->conn->insert_id;
    }

    public function affected_rows() {
        return $this->conn->affected_rows;
    }

    public function close() {
        $this->conn->close();
    }

    public function start_transaction() {
        return $this->conn->autocommit(false);
    }

    public function commit() {
        return $this->conn->commit();
    }

    public function rollback() {
        return $this->conn->rollback();
    }
}