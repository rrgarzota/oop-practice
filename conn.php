<?php
$host = '127.0.0.1'; // localhost
$username = 'root';
$password = '';
$dbName = 'test';

$db = new mysqli($host, $username, $password, $dbName);

if ($db->connect_errno) {
    echo "Failed to connect to MySQL: (" . $db->connect_errno . ") " . $db->connect_error;
    exit;
}
