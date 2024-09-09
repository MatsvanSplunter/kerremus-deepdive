<?php

function CONNECT_PDO($sql, $host, $name, $user, $password, $params = [], $fetchMode = PDO::FETCH_ASSOC)
{
    try {
        $pdo = new PDO("mysql:host=$host;dbname=$name", $user, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);
        $query = $stmt->fetchAll($fetchMode);
        return $query;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}