<?php
$dbServer = "localhost";
$dbUser = "root";
$dbPassword = "";
$dbName = "tododb";


// Connnecting to datbase with mysqli (oo way)
// $db = new mysqli($dbServer, $dbUser, $dbPassword, $dbName);
// if (!$db) {
//     die("Can not connect to database");
// }

// Connecting to database with mysli (procedural way)
// $db = mysqli_connect($dbServer, $dbUser, $dbPassword, $dbName);
// if (!$db) {
//     die("Can not connect to database");
// }

// Connecting to databae with PDO
try {
    $db = new PDO("mysql:host={$dbServer};dbname={$dbName}", $dbUser, $dbPassword);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException) {
    die("Can not connect to database");
}
