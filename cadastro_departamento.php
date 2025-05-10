<?php

/**
 * Formulário para cadastrar um novo departamento no banco de dados.
 */

include("conexao.php");
include('header.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") { 
    $dnumero = $_POST['dnumero'];
    $dnome = $_POST['dnome'];
    $cpf_gerente = $_POST['cpf_gerente'];
    $data_inicio_gerente = $_POST['data_inicio'];

    $stmt = $conn->prepare("INSERT  INTO DEPARTAMENTO (Dnome, Dnumero, Cpf_gerente, Data_inicio_gerente) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("siss", $dnome, $dnumero, $cpf_gerente, $data_inicio);
    $stmt->execute();

    echo "Departamento cadastrado com sucesso!";
}

?>

<form method="POST">
    Número do Departamento: <input name="dnumero"><br>
    Nome do Departamento: <input name="dnome"><br>
    CPF do Gerente: <input name="cpf_gerente"><br>
    Início da Gerência: <input type="date" name="data_inicio"><br>
    <input type="submit" value ="Cadastrar">
</form>