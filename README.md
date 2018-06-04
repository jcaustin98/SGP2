# SGP2
## Problem 2: Implement a basic spin results end point

The repository can be cloned into the server document root directory.
 
You can add players by editing and running the addPlayer.php in the root directory, 
in production this would be removed.

The database schema is in spin_schema.sql in the model directory.

In production, the DBConfig.php would be removed and the variables moved to the 
environment.  

### Description

Slot Machine Spin Results is our server end point that updates all player data and features when a spin is completed on the client. We do hundreds of millions of these requests per day, and we would like to see you make a very basic MySQL driven version.

This can be just a normal PHP file that gets called, or you can implement more modern routing if you would like

## Implementation
For this problem I set up VM instance on Google Cloud Platform with a LAMP stack.

I used Postman for development and testing of the service using both GET and POST.
End point: http://35.225.71.110/SGP2/SlotMachineSpinResults.php

Sample parameters:
```
CoinsBet=10
PlayerId=03751181b4a5bf3f036a
CoinsWon=10
hash=8cbddab946a61ad9d1ba9ce4cba2666cc7970d41e2e2ca2d23ab133c21201704
```

Sample output (output.json):
```
{
    "Player ID": "03751181b4a5bf3f036a",
    "Name": "jeff",
    "Credits": "10000",
    "Lifetime Spins": 5,
    "Lifetime Average Return": 36
}
```

I did add a database field 'LifetimeCoins' for use in the "Lifetime Average Return" 
calculation. I did not want to include any purchased coins in the
calculation. I am sure this could be removed and some other less frequently called service 
would take care it.