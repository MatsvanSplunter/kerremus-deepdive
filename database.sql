DROP DATABASE IF EXISTS kerremus_deepdive;

CREATE DATABASE kerremus_deepdive;

USE kerremus_deepdive;

CREATE TABLE user(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(32) NOT NULL,
    password VARCHAR(320) NOT NULL
);

CREATE TABLE gamesaves(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    bort TEXT NOT NULL,
    userid INT NOT NULL
);