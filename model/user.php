<?php
require_once 'MysqlBase.php';

class user extends MysqlBase
{
    public function add($data){
        $data['PlayerId'] = random_bytes(10); // could be a Vx UUID
        $data['SaltValue'] = random_bytes(10);
        $data['Password'] = hash('sha256', $data['SaltValue'].$data['Password']);
        $safe_values = $this->getSafeValues($data);
        $sql = 'Insert INTO player SET ' . $safe_values;
        $this->execQuery($sql);
        print_r($sql);
    }
}
