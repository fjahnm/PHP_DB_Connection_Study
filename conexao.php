<?php

/**
 * Estabelece conexão com o banco de dados 'empresa'.
*/

$servername = "localhost";
$username = "root";
$password = ""; // padrão do XAMPP
$database = "empresa"; // crie esse banco no DBeaver

$conn = new mysqli($servername, $username, $password, $database);

// Verifica conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}
?>
