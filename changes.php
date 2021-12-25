<?php

$db = new SQLite3(':memory:');

$db->exec("CREATE TABLE friends(id INTEGER PRIMARY KEY, name TEXT)");
$db->exec("INSERT INTO friends(name) VALUES ('Tom')");
$db->exec("INSERT INTO friends(name) VALUES ('Rebecca')");
$db->exec("INSERT INTO friends(name) VALUES ('Jim')");
$db->exec("INSERT INTO friends(name) VALUES ('Robert')");

$db->exec('DELETE FROM friends');

$changes = $db->changes();

echo "The DELETE statement removed $changes rows";