<?php

require('vendor/autoload.php');

$db = dibi::connect([
    'driver' => 'sqlite',
    'database' => 'test.db',
]);

$rows = $db->query('SELECT * FROM cars');

foreach ($rows as $row) {
    
    $id = $row->id;
    $name = $row->name;
    $price = $row->price;

    echo "$id $name $price \n";
}