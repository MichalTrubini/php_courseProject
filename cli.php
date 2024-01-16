<?php

include __DIR__ . '/src/Framework/Database.php';

use Framework\Database;

$db = new Database('mysql', [
    'host' => 'mariadb105.r2.websupport.sk',
    'port' => 3315,
    'dbname' => 'jn8a7w07',
], 'jn8a7w07', 'Kv9?OrP]cF');

echo 'Connected to the database successfully!';

try {

    $db->connection->beginTransaction();

    $db->connection->query("INSERT INTO `products` (`name`) VALUES ('berry')");

    $search = 'berry';

    $query = "SELECT * FROM `products` WHERE name=:name";

    $stmt = $db->connection->prepare($query);

    $stmt->bindValue('name', $search, PDO::PARAM_STR);

    $stmt->execute();

    var_dump($stmt->fetchAll());

    $db->connection->commit();
} catch (PDOException $e) {
    if ($db->connection->inTransaction()) {
        $db->connection->rollBack();
    }
    echo "Transaction failed";
}
