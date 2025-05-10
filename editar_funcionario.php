<?php
include("conexao.php");
include('header.php');

$cpf = $_GET['cpf'];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $pnome = $_POST['pnome'];
    $minicial = $_POST['minicial'];
    $unome = $_POST['unome'];
    $salario = $_POST['salario'];
    $dnr = $_POST['dnr'];

    $stmt = $conn->prepare("UPDATE FUNCIONARIO SET Pnome=?, Minicial=?, Unome=?, Salario=?, Dnr=? WHERE Cpf=?");
    $stmt->bind_param("sssdis", $pnome, $minicial, $unome, $salario, $dnr, $cpf);
    $stmt->execute();
    header("Location: lista_funcionarios.php");
} else {
    $stmt = $conn->prepare("SELECT Pnome, Minicial, Unome, Salario, Dnr FROM FUNCIONARIO WHERE Cpf=?");
    $stmt->bind_param("s", $cpf);
    $stmt->execute();
    $stmt->bind_result($pnome, $minicial, $unome, $salario, $dnr);
    $stmt->fetch();
}
?>
<form method="POST">
    Nome: <input name="pnome" value="<?= $pnome ?>"><br>
    Inicial: <input name="minicial" value="<?= $minicial ?>"><br>
    Sobrenome: <input name="unome" value="<?= $unome ?>"><br>
    Salário: <input name="salario" value="<?= $salario ?>"><br>
    Dnr: <input name="dnr" value="<?= $dnr ?>"><br>
    <input type="submit" value="Atualizar">
</form>
