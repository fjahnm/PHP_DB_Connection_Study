<?php
include "conexao.php";
include('header.php');

$relatorio = [];
$erro = "";
$cpf = "";

if ($_SERVER["REQUEST_METHOD"] === "POST" && !empty($_POST["cpf"])) {
    $cpf = $_POST["cpf"];

    try {
        $stmt = $conn->prepare("CALL sp_listar_projetos_funcionario(?)");
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
    <title>Relatório de Projetos por Funcionário</title>
</head>
<body>
    <h1>Relatório de Projetos por Funcionário</h1>

    <form method="post">
        <label for="cpf">CPF do Funcionário:</label>
        <input type="text" name="cpf" id="cpf" value="<?php echo htmlspecialchars($cpf); ?>" required>
        <input type="submit" value="Buscar">
    </form>

    <?php if ($erro): ?>
        <p style="color:red;"><?php echo $erro; ?></p>
    <?php endif; ?>

    <?php if (!empty($relatorio)): ?>
        <h2>Projetos:</h2>
        <table border="1">
            <tr>
                <th>Nome do Projeto</th>
                <th>Local do Projeto</th>
                <th>Número do Projeto</th>
                <th>Horas Trabalhadas</th>
            </tr>
            <?php foreach ($relatorio as $proj): ?>
                <tr>
                    <td><?php echo htmlspecialchars($proj['ProjNome']); ?></td>
                    <td><?php echo htmlspecialchars($proj['ProjLocal']); ?></td>
                    <td><?php echo htmlspecialchars($proj['ProjNumero']); ?></td>
                    <td><?php echo htmlspecialchars($proj['Horas']); ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php elseif ($_SERVER["REQUEST_METHOD"] === "POST"): ?>
        <p>Nenhum projeto encontrado para este funcionário.</p>
    <?php endif; ?>
</body>
</html>
