<?php
require_once 'DBConfig.php';

class MysqlBase
{

    public function __construct(){
        $this->selected_db = $this->getDatabase(
            DBConfig::DatabaseHost,
            DBConfig::DatabaseUser,
            DBConfig::DatabasePassword,
            DBConfig::Database);

    }

    public function getDatabase($server, $userName, $password, $dbName) {
        $dbcx = @mysqli_connect($server, $userName, $password);
        if(!$dbcx) {
            echo("<p> connect failed</p>");
        }
        $db_selected = mysqli_select_db($dbcx, $dbName);
        if (!$db_selected) {
            die ("Can\'t use db : " . mysqli_error($dbcx));
        }
        $this->db_connection = $dbcx;
        return $db_selected;
    }

    public function getSafeValues($values) {
        $sql = '';
        $sep = '';
        foreach ($values as $name => $val) {
            $sql .= $sep . $name . "='" .  mysqli_real_escape_string($this->db_connection, $val) . "'";
            $sep  = ', ';
        }
        return $sql;
    }

    public function execQuery($sql){
        $status = mysqli_query($this->db_connection,$sql);
        if (!$status) {
            return mysqli_error($this->db_connection); // this should get logged
        }
        return $status;
    }

    public function getRow($results) {
        $row = mysqli_fetch_array($results, MYSQLI_ASSOC);
        if( !$row){
            return $row;
        }
        foreach (array_keys($row) as $key) {
            $row[$key] = stripslashes($row[$key]);
        }
        mysqli_free_result($results);
        return $row;
    }
}
