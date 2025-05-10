<?php
include("conexao.php");
$cpf = $_GET['cpf'];
$stmt = $conn->prepare("DELETE FROM FUNCIONARIO WHERE Cpf=?");
$stmt->bind_param("s", $cpf);
$stmt->execute();
header("Location: lista_funcionarios.php");
