<?php
require_once 'model/player.php';

$data = [];
$data['PlayerName'] = 'jeff';
$data['Credits'] = 10000;
$data['LifetimeSpins'] = 0;
$data['Password'] = 'cujo';
$userModel = new player();
$userModel->add($data);
