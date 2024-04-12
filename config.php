<?php
$host = 'onnjomlc4vqc55fw.chr7pe7iynqr.eu-west-1.rds.amazonaws.com';
$username = 'cux5nmdarh8rqgpx';
$password = 'zjd0gozcfoirbp2a';
$database = 'laonzmp2o0pw3k5c';
$port = 3306;

$conn = new mysqli($host, $username, $password, $database, $port);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
