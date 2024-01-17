<?php

include __DIR__ . '/src/Framework/Database.php';

use Framework\Database;

$db = new Database('mysql', [
    'host' => 'mariadb105.r2.websupport.sk',
    'port' => 3315,
    'dbname' => 'jn8a7w07',
], 'jn8a7w07', 'Kv9?OrP]cF');

echo 'Connected to the database successfully!';

$sqlFile = file_get_contents("./database.sql");

$db->query($sqlFile);
