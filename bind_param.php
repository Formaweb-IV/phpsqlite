<?php

$db = new SQLite3(':memory:');

$db->exec("CREATE TABLE friends(id INTEGER PRIMARY KEY, firstname TEXT, lastname TEXT)");

$stm = $db->prepare("INSERT INTO friends(firstname, lastname) VALUES (?, ?)");
$stm->bindParam(1, $firstName);
$stm->bindParam(2, $lastName);

$firstName = 'Peter';
$lastName = 'Novak';
$stm->execute();

$firstName = 'Lucy';
$lastName = 'Brown';
$stm->execute();

$res = $db->query('SELECT * FROM friends');

while ($row = $res->fetchArray()) {
    echo "{$row[0]} {$row[1]} {$row[2]}\n";
}