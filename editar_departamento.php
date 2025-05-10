<?php

/**
 * Permite editar um departamento existente, identificado por Dnumero.
 */

include("conexao.php");
include('header.php');

$dnumero = $_GET['dnumero'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $dnome = $_POST['dnome'];
    $cpf_gerente = $_POST['cpf_gerente'];
    $data_inicio = $_POST['data_inicio'];

    $stmt = $conn->prepare("UPDATE DEPARTAMENTO SET Dnome=?, Cpf_gerente=?, Data_inicio_gerente=? WHERE Dnumero=?");
    $stmt->bind_param("sssi", $dnome, $cpf_gerente, $data_inicio, $dnumero);
    $stmt->execute();

    echo "Departamento atualizado!";
}

$stmt = $conn->prepare("SELECT Dnome, Cpf_gerente, Data_inicio_gerente FROM DEPARTAMENTO WHERE Dnumero=?");
$stmt->bind_param("i", $dnumero);
$stmt->execute();
$stmt->bind_result($dnome, $cpf_gerente, $data_inicio);
$stmt->fetch();
?>

<form method="POST">
    Nome: <input name="dnome" value="<?= $dnome ?>"><br>
    CPF do Gerente: <input name="cpf_gerente" value="<?= $cpf_gerente ?>"><br>
    Início da Gerência: <input type="date" name="data_inicio" value="<?= $data_inicio ?>"><br>
    <input type="submit" value="Atualizar">
</form>