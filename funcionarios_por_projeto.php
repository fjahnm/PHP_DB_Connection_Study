<?php
include("conexao.php");
include("header.php");

$sql = "
SELECT 
    P.Projnome,
    F.Pnome,
    F.Unome,
    T.Horas
FROM 
    TRABALHA_EM T
JOIN 
    FUNCIONARIO F ON F.Cpf = T.Fcpf
JOIN 
    PROJETO P ON P.Projnumero = T.Pnr
ORDER BY 
    P.Projnome, F.Pnome";

$result = $conn->query($sql);

$projeto_atual = null;
?>

<section class="relatorio">
    <h2>Funcionários por Projeto</h2>

    <?php
    while ($row = $result->fetch_assoc()) {
        if ($projeto_atual != $row['Projnome']) {
            if ($projeto_atual !== null) echo "</table>";
            $projeto_atual = $row['Projnome'];
            echo "<h3>{$projeto_atual}</h3>";
            echo "<table>
                    <tr>
                        <th>Funcionário</th>
                        <th>Horas Trabalhadas</th>
                    </tr>";
        }
        $nome = $row['Pnome'] . " " . $row['Unome'];
        $horas = $row['Horas'] ?? '—';
        echo "<tr>
                <td>$nome</td>
                <td>$horas</td>
              </tr>";
    }
    echo "</table>";
    ?>
</section>