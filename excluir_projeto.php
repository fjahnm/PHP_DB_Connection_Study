<?php

/**
 * Exclui um projeto com base no número informado via GET.
 */

include("conexao.php");

$projnumero = $_GET['projnumero'];

$stmt = $conn->prepare("DELETE FROM PROJETO WHERE Projnumero=?");
$stmt->bind_param("i", $projnumero);
$stmt->execute();

echo "Projeto excluído!";