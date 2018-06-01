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
        print_r($sql);
    }
}
