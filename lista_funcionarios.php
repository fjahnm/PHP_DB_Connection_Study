<?php
include("conexao.php");
include('header.php');

$sql = "SELECT Cpf, Pnome, Unome, Salario, Dnr FROM FUNCIONARIO";
$result = $conn->query($sql);
?>
<table border="1">
    <tr><th>CPF</th><th>Nome</th><th>Salário</th><th>Depto</th><th>Ações</th></tr>
    <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row["Cpf"] ?></td>
            <td><?= $row["Pnome"] . " " . $row["Unome"] ?></td>
            <td>R$ <?= $row["Salario"] ?></td>
            <td><?= $row["Dnr"] ?></td>
            <td>
                <a href="editar_funcionario.php?cpf=<?= $row['Cpf'] ?>">Editar</a> |
                <a href="excluir_funcionario.php?cpf=<?= $row['Cpf'] ?>" onclick="return confirm('Deseja excluir? Não há volta!!!')">Excluir</a>
            </td>
        </tr>
    <?php endwhile; ?>
</table>
