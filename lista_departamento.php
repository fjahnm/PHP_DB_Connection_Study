<?php
include("conexao.php");
include('header.php');

$result = $conn->query("SELECT * FROM DEPARTAMENTO");

echo "<table border='1'>
<tr><th>Número</th><th>Nome</th><th>CPF Gerente</th><th>Início</th><th>Ações</th></tr>";
while ($row = $result->fetch_assoc()) {
    echo "<tr>
        <td>{$row['Dnumero']}</td>
        <td>{$row['Dnome']}</td>
        <td>{$row['Cpf_gerente']}</td>
        <td>{$row['Data_inicio_gerente']}</td>
        <td>
            <a href='editar_departamento.php?dnumero={$row['Dnumero']}'>Editar</a> |
            <a href='excluir_departamento.php?dnumero={$row['Dnumero']}' onclick='return confirm(\"Deseja excluir? Não há volta!!!\")'>Excluir</a>
        </td>
    </tr>";
}
echo "</table>";