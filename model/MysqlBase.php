<?php
require_once 'DBConfig.php';

class MysqlBase
{
    public function __construct(){
        $config = new DBConfig();
        $this->selected_db = $this->getDatabase(
            DBConfig::DatabaseHost,
            $config::DatabaseUser,
            $config::DatabasePassword,
            $config::Database);

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
        return $db_selected;
    }

    public function getSafeValues($values) {
        $sql = '';
        $sep = '';
        foreach ($values as $name => $val) {
            $sql .= $sep . $name . "='" .  mysqli_real_escape_string($val) . "'";
            $sep  = ', ';
        }
        return $sql;
    }
}
