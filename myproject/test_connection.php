<?php
include_once 'db_connection.php';

$database = new Database();
$db = $database->getConnections();

if($db) {
    echo "Connected to the database successfully!";
} else {
    echo "Failed to connect to the database.";
}
?>