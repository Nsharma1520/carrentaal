<?php
$servername = "localhost";
$username = "root";
$password = "Root@1234";
$database = "id22116309_carrentalsystem";

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}