DROP DATABASE IF EXISTS kerremus_deepdive;

CREATE DATABASE kerremus_deepdive;

USE kerremus_deepdive;

CREATE TABLE `user`(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(32) NOT NULL,
    color TEXT,
    backgrountcolor TEXT,
    celcolor TEXT,
    password VARCHAR(320) NOT NULL
);

CREATE TABLE patternsaves(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    pattern TEXT NOT NULL,
    gamesize INT NOT NULL,
    userid INT NOT NULL
);

CREATE TABLE gamesaves(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    bord TEXT NOT NULL,
    gamesize ENUM('small', 'medium', 'large') NOT NULL,
    userid INT NOT NULL
);

INSERT INTO user(
    `username`,
    `password`
)
VALUES
(
    "test",
    '$2y$10$g8kw546cjobBKWkXK8bZGOBsxA6AXzgu1cuJG5fg6NCAewQvyTlde'
);