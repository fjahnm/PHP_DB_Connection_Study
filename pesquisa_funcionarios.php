<?php
include("conexao.php");
include('header.php');

$nome = $_POST['nome'] ?? '';
$dnr = $_POST['dnr'] ?? '';

$sql = "SELECT Cpf, Pnome, Unome, Salario, Dnr FROM FUNCIONARIO WHERE 1=1";
if ($nome) $sql .= " AND Pnome LIKE '%$nome%'";
if ($dnr) $sql .= " AND Dnr = $dnr";

$result = $conn->query($sql);
?>
<form method="POST">
    Nome: <input name="nome">
    Dnr: <input name="dnr">
    <input type="submit" value="Pesquisar" min="0">
</form>
<table border="1">
    <tr><th>CPF</th><th>Nome</th><th>Salário</th><th>Depto</th></tr>
    <?php while($row = $result->fetch_assoc()): ?>
    <tr>
        <td><?= $row["Cpf"] ?></td>
        <td><?= $row["Pnome"] . " " . $row["Unome"] ?></td>
        <td><?= $row["Salario"] ?></td>
        <td><?= $row["Dnr"] ?></td>
    </tr>
    <?php endwhile; ?>
</table>
