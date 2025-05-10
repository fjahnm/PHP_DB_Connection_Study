<?php

/**
 * Formulário para cadastrar um novo projeto.
 */

include("conexao.php");
include('header.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $projnumero = $_POST['projnumero'];
    $projnome = $_POST['projnome'];
    $projlocal = $_POST['projlocal'];
    $dnum = $_POST['dnum'];

    $stmt = $conn->prepare("INSERT INTO PROJETO (Projnome, Projnumero, Projlocal, Dnum) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sssi", $projnome, $projnumero, $projlocal, $dnum);
    $stmt->execute();

    echo "Projeto cadastrado com sucesso!";
}
?>

<!-- Formulário HTML para cadastro de projeto -->
<form method="POST">
    Número do Projeto: <input name="projnumero"><br>
    Nome do Projeto: <input name="projnome"><br>
    Local do Projeto: <input name="projlocal"><br>
    Nº Departamento: <input name="dnum"><br>
    <input type="submit" value="Cadastrar">
</form>
