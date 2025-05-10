<?php

/**
 * Permite editar um projeto existente identificado pelo número do projeto.
 */

include("conexao.php");
include('header.php');

$projnumero = $_GET['projnumero'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $projnome = $_POST['projnome'];
    $projlocal = $_POST['projlocal'];
    $dnum = $_POST['dnum'];

    $stmt = $conn->prepare("UPDATE PROJETO SET Projnome=?, Projlocal=?, Dnum=? WHERE Projnumero=?");
    $stmt->bind_param("ssii", $projnome, $projlocal, $dnum, $projnumero);
    $stmt->execute();

    echo "Projeto atualizado!";
}

$stmt = $conn->prepare("SELECT Projnome, Projlocal, Dnum FROM PROJETO WHERE Projnumero=?");
$stmt->bind_param("i", $projnumero);
$stmt->execute();
$stmt->bind_result($projnome, $projlocal, $dnum);
$stmt->fetch();
?>

<!-- Formulário de edição de projeto -->
<form method="POST">
    Nome do Projeto: <input name="projnome" value="<?= $projnome ?>"><br>
    Local do Projeto: <input name="projlocal" value="<?= $projlocal ?>"><br>
    Nº Departamento: <input name="dnum" value="<?= $dnum ?>"><br>
    <input type="submit" value="Atualizar">
</form>