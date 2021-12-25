<?php

require_once "vendor/autoload.php";

use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\FetchMode;

$attrs = ['driver' => 'pdo_sqlite', 'path' => 'test.db'];

$conn = DriverManager::getConnection($attrs);

$queryBuilder = $conn->createQueryBuilder();
$queryBuilder->select('*')->from('cars');

$stm = $queryBuilder->execute();
$rows = $stm->fetchAll(FetchMode::NUMERIC);

foreach ($rows as $row) {

    echo "{$row[0]} {$row[1]} {$row[2]}\n";
}