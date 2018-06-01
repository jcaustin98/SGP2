CREATE DATABASE IF NOT EXISTS spin;
CREATE USER 'spin'@'localhost' IDENTIFIED BY 'Problem2';
GRANT ALL PRIVILEGES ON spin.* TO 'spin'@'localhost';
FLUSH PRIVILEGES;
USE spin;

CREATE TABLE IF NOT EXISTS player (
	PlayerID varchar(11) not NULL,
	PlayerName varchar(255) not NULL,
	Credits int(11) not NULL,
	LifetimeSpins int(11) not NULL,
	SaltValue varchar(255) not NULL,
	Password varchar(255) not NULL,

	PRIMARY KEY  (PlayerID),
);