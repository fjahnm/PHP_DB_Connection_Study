<?php
/**
 * Permite pesquisar projetos pelo nome ou número.
 * Exibe os projetos encontrados em uma tabela.
 */

include("conexao.php");
include("header.php");

// Captura dos dados do formulário ou define como vazio
$projnome = $_POST['projnome'] ?? '';
$projnumero = $_POST['projnumero'] ?? '';

// Monta consulta SQL com filtros dinâmicos
$sql = "SELECT Projnumero, Projnome, Projlocal, Dnum FROM PROJETO WHERE 1=1";

if ($projnome) {
    $sql .= " AND Projnome LIKE '%$projnome%'";
}

if (isset($_POST['projnumero']) && is_numeric($_POST['projnumero']) && $_POST['projnumero'] >= 0) {
    $sql .= " AND Projnumero = " . intval($projnumero);
}

$result = $conn->query($sql);
?>

<!-- Formulário de pesquisa de projetos -->
<form method="POST">
    <div class="form-group">
        <label for="projnome">Nome do Projeto:</label>
        <input type="text" name="projnome" id="projnome">
    </div>

    <div class="form-group">
        <label for="projnumero">Número do Projeto:</label>
        <input type="number" name="projnumero" id="projnumero" min="0">
    </div>

    <input type="submit" value="Pesquisar">
</form>

<!-- Resultados da pesquisa -->
<table border="1">
    <tr>
        <th>Número</th>
        <th>Nome</th>
        <th>Local</th>
        <th>Departamento</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row["Projnumero"] ?></td>
            <td><?= $row["Projnome"] ?></td>
            <td><?= $row["Projlocal"] ?></td>
            <td><?= $row["Dnum"] ?></td>
        </tr>
    <?php endwhile; ?>
</table>
