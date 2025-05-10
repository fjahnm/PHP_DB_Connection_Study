<?php
/**
 * Permite pesquisar departamentos pelo nome ou número.
 * Exibe os departamentos encontrados em uma tabela.
 */

include("conexao.php");
include("header.php");

// Recebe os dados do formulário, ou define vazios
$dnome = $_POST['dnome'] ?? '';
$dnumero = $_POST['dnumero'] ?? '';

// Monta a consulta SQL com filtros dinâmicos
$sql = "SELECT Dnumero, Dnome, Cpf_gerente, Data_inicio_gerente FROM DEPARTAMENTO WHERE 1=1";

if ($dnome) {
    $sql .= " AND Dnome LIKE '%$dnome%'";
}
if ($dnumero) {
    $sql .= " AND Dnumero = $dnumero";
}

$result = $conn->query($sql);
?>

<!-- Formulário de pesquisa -->
<form method="POST">
    <div class="form-group">
        <label for="dnome">Nome do Departamento:</label>
        <input type="text" name="dnome" id="dnome">
    </div>

    <div class="form-group">
        <label for="dnumero">Número do Departamento:</label>
        <input type="number" name="dnumero" id="dnumero" min="0">
    </div>

    <input type="submit" value="Pesquisar">
</form>

<!-- Tabela com resultados -->
<table border="1">
    <tr>
        <th>Número</th>
        <th>Nome</th>
        <th>CPF do Gerente</th>
        <th>Início da Gerência</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row["Dnumero"] ?></td>
            <td><?= $row["Dnome"] ?></td>
            <td><?= $row["Cpf_gerente"] ?></td>
            <td><?= $row["Data_inicio_gerente"] ?></td>
        </tr>
    <?php endwhile; ?>
</table>
