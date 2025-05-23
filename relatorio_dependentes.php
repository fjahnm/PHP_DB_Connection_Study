<?php
include "conexao.php";
include('header.php');

$relatorio = [];
$erro = "";
$cpf = "";

if ($_SERVER["REQUEST_METHOD"] === "POST" && !empty($_POST["cpf"])) {
    $cpf = $_POST["cpf"];

    try {
        $stmt = $conn->prepare("CALL sp_listar_dependentes(?)");
        $stmt->bind_param("s", $cpf);
        $stmt->execute();

        $resultado = $stmt->get_result();
        while ($row = $resultado->fetch_assoc()) {
            $relatorio[] = $row;
        }
        $stmt->close();
    } catch (Exception $e) {
        $erro = "Erro ao executar a procedure: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Relatório de Dependentes</title>
</head>
<body>
    <h1>Relatório de Dependentes</h1>

    <form method="post">
        <label for="cpf">CPF do Funcionário:</label>
        <input type="text" name="cpf" id="cpf" value="<?php echo htmlspecialchars($cpf); ?>" required>
        <input type="submit" value="Buscar">
    </form>

    <?php if ($erro): ?>
        <p style="color:red;"><?php echo $erro; ?></p>
    <?php endif; ?>

    <?php if (!empty($relatorio)): ?>
        <h2>Dependentes:</h2>
        <table border="1">
            <tr>
                <th>Nome</th>
                <th>Sexo</th>
                <th>Data de Nascimento</th>
                <th>Parentesco</th>
            </tr>
            <?php foreach ($relatorio as $dep): ?>
                <tr>
                    <td><?php echo htmlspecialchars($dep['Nome_dependente']); ?></td>
                    <td><?php echo htmlspecialchars($dep['Sexo']); ?></td>
                    <td><?php echo htmlspecialchars($dep['DataNasc']); ?></td>
                    <td><?php echo htmlspecialchars($dep['Parentesco']); ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php elseif ($_SERVER["REQUEST_METHOD"] === "POST"): ?>
        <p>Nenhum dependente encontrado.</p>
    <?php endif; ?>
</body>
</html>
