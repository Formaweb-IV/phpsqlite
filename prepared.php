<?php

$db = new SQLite3('test.db');

$stm = $db->prepare('SELECT * FROM cars WHERE id = ?');
$stm->bindValue(1, 3, SQLITE3_INTEGER);

$res = $stm->execute();

$row = $res->fetchArray(SQLITE3_NUM);
echo "{$row[0]} {$row[1]} {$row[2]}";