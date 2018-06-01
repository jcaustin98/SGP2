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
echo $method
$status = 200;
$input = [];
if('POST' == $method){
    $input = $_POST;
} elseif ('Get' == $method) {
    $input = $_GET;
} else {
    $status = 422;
}
print_r($input);
if(200 == $status and is_int($input['CoinsBet']) and is_int($input['CoinsWon'])) {
    $input['CoinsBet'] = (int)$input['CoinsBet'];
    $input['CoinsWon'] = (int)$input['CoinsWon'];
} else {
    $status = 422;
}

if(200 != $status) {
    http_response_code($status);
    return;
}
print_r($input);

