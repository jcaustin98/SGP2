<?php
require_once 'MysqlBase.php';

class player extends MysqlBase
{
    public function add($data){
        $data['PlayerId'] = bin2hex(random_bytes(10)); // could be a Vx UUID
        $data['SaltValue'] = bin2hex(random_bytes(10));
        $data['Password'] = hash('sha256', $data['SaltValue'].$data['Password']);
        $safe_values = $this->getSafeValues($data);
        $sql = 'Insert INTO player SET ' . $safe_values;
        $this->execQuery($sql);
    }

    public function get($PlayerID){
        $sql = 'Select PlayerName, LifetimeSpins, LifetimeCoins, Password, Credits ';
        $sql .= ' FROM player';
        $sql .= ' WHERE PlayerID =\'' . $PlayerID . '\'';

        $results = $this->execQuery($sql);
        if($results){
            return $this->getRow($results);
        } else {
            return $results;
        }
    }

    public function update($PlayerID, $data) {
        $safe_values = $this->getSafeValues($data);
        $sql = 'Update player SET ' . $safe_values;
        $sql .= ' WHERE PlayerID =\'' . $PlayerID . '\'';
echo "\n" . $sql;
        return $this->execQuery($sql);
    }
}
