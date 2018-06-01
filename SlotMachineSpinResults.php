<?php
require_once 'model/player.php';
/**
//Your code should validate the following request data: hash, coins won, coins bet, player ID
//
//.      Update the player data in MySQL if the data is valid
//.      Generate a JSON response with the following data:
//.      Player ID
//.      Name
//.      Credits
//.      Lifetime Spins
//.      Lifetime Average Return
 */

$method = $_SERVER['REQUEST_METHOD'];

$status = 200;
$input = [];
if('POST' == $method){
    $input = $_POST;
} elseif ('GET' == $method) {
    $input = $_GET;
} else {
    $status = 422;
}

if(200 == $status and is_numeric($input['CoinsBet']) and is_numeric($input['CoinsWon'])) {
    $input['CoinsBet'] = (int)$input['CoinsBet'];
    $input['CoinsWon'] = (int)$input['CoinsWon'];
} else {
    $status = 422;
}

if(200 != $status) {
    http_response_code($status);
    return;
}

$playerModel = new player();
$row = $playerModel->get($input['PlayerId']);
if(!$row) { // bad PlayerId
    http_response_code(422);
    return;
}

if($row['Password'] != $input['hash']) {
    http_response_code(422);
    return;
}
$update = [];
$update['LifetimeSpins'] = $row['LifetimeSpins'] + 1;
$update['LifetimeCoins'] = $row['LifetimeCoins'] + ($input['CoinsWon'] - $input['CoinsBet']);
$playerModel->update($input['PlayerId'], $update);

$json = [];
$json['Player ID'] = $input['PlayerId'];
$json['Name'] = $row['PlayerName'];
$json['Credits'] = $row['Credits'];
$json['Lifetime Spins'] = $update['LifetimeSpins'];
$json['Lifetime Average Return'] = $update['LifetimeCoins'] / $update['LifetimeSpins'];

header('Content-Type: application/json');
echo json_encode($json);