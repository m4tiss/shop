<?php

$servername = "localhost";
$username = "root";
$password = "praktyka";
$database = "shop";

$conn = new mysqli($servername, $username, $password, $database);
$conn->set_charset("utf8mb4");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}