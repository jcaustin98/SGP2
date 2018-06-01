<?php
require_once 'model/user.php';

$data = [];
$data['PlayerName'] = 'jeff';
$data['Credits'] = 10000;
$data['LifetimeSpins'] = 0
$data['Password'] = 'cujo';
$userModel = new user();
$userModel.add($data);