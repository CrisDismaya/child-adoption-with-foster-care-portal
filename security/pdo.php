<?php
define("HOST_NAME", "localhost");
define("USERNAME", "root");
define("PASSWORD", "");

try {
    $db = new PDO("mysql:host=". HOST_NAME .";dbname=db_postercare", USERNAME, PASSWORD);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>