<?php
// Configurações do banco de dados
define('DB_HOST', '172.20.0.10');
define('DB_USER', 'appuser');
define('DB_PASS', 'apppass');
define('DB_NAME', 'appdb');

$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if ($conn->connect_error) {
    die('Erro de conexão: ' . $conn->connect_error);
}

// Define charset
$conn->set_charset('utf8mb4');
