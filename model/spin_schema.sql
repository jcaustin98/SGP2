CREATE DATABASE IF NOT EXISTS spin;
CREATE USER 'webapp'@'localhost' IDENTIFIED BY 'Problem2';
GRANT ALL PRIVILEGES ON spin.* TO 'webapp'@'localhost';
FLUSH PRIVILEGES;
USE spin;

CREATE TABLE IF NOT EXISTS player (
	PlayerID varchar(255) not NULL,
	PlayerName varchar(255) not NULL,
	Credits int(11) not NULL,
	LifetimeSpins int(11) not NULL,
	LifetimeCoins int(11) not NULL,
	SaltValue varchar(255) not NULL,
	Password varchar(255) not NULL,

	PRIMARY KEY  (PlayerID)
);