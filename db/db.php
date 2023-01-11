<?php
require "env.php";

class db {
    public $connection;
    public $query;
    public $sql;
    public function __construct() {
        // $this->connection = mysqli_connect(SERVER, USER, PASS, DBNAME);
    }
    public function select($table, $column) {
        $this->sql = " SELECT $column FROM `$table` ";
        return $this;
    }
    public function where($column, $compare, $value, $optional_and_or = '') {
        $this->sql .= " WHERE `$column` $compare '$value'  $optional_and_or ";
        //         echo $this->sql;
        //         die();
        return $this;
    }
    public function get_select_query() {
        $this->query = mysqli_query($this->connection, $this->sql);
        $data = [];
        while ($row = mysqli_fetch_assoc($this->query)) {
            $data[] = $row;
        }
        return $data;
    }
    public function get_row() {
        $this->query = mysqli_query($this->connection, $this->sql);
        return mysqli_fetch_assoc($this->query);
    }
    public function execute() { // for insert, update and delete
        // echo $this->sql;
        mysqli_query($this->connection, $this->sql);
        return mysqli_affected_rows($this->connection);
    }
    public function insert($table, $data) {
        $columns = "";
        $values = "";
        foreach ($data as $key => $val) {
            $columns .= " `$key`  ,";
            $values .= " '$val' ,";
        }
        $columns = rtrim($columns, ',');
        $values = rtrim($values, ',');
        $this->sql = "INSERT INTO `$table` ($columns) VALUES ($values) ";
        return $this;
    }
    public function update($table, $data) {
        $updateColumnAndValue = "";
        foreach ($data as $key => $value) {
            $updateColumnAndValue .= "`$key` = '$value',";
        }
        $updateColumnAndValue = rtrim($updateColumnAndValue, ",");
        $this->sql = "UPDATE `$table` SET $updateColumnAndValue";
        return $this;
    }
    public function delete($table) {
        $this->sql = "DELETE FROM `$table` ";
        return $this;
    }
}
