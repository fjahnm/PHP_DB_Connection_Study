<?php
include("conexao.php");
include('header.php');

$result = $conn->query("SELECT * FROM PROJETO");

echo "<table border='1'>
<tr><th>Número</th><th>Nome</th><th>Local</th><th>Departamento</th><th>Ações</th></tr>";
while ($row = $result->fetch_assoc()) {
    echo "<tr>
        <td>{$row['Projnumero']}</td>
        <td>{$row['Projnome']}</td>
        <td>{$row['Projlocal']}</td>
        <td>{$row['Dnum']}</td>
        <td>
            <a href='editar_projeto.php?projnumero={$row['Projnumero']}'>Editar</a> |
            <a href='excluir_projeto.php?projnumero={$row['Projnumero']}' onclick='return confirm(\"Deseja excluir? Não há volta!!!\")'>Excluir</a>
        </td>
    </tr>";
}
echo "</table>";