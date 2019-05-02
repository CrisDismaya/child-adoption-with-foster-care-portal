<?php
define("HOST_NAME", "localhost");
define("USERNAME", "u270883250_adopt");
define("PASSWORD", "b0YoBhJwjioE");

try {
    $db = new PDO("mysql:host=". HOST_NAME .";dbname=u270883250_adopt", USERNAME, PASSWORD);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>