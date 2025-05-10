<?php

 /**
 * excluir_departamento.php
 * 
 * Remove um departamento com base no Dnumero passado via GET.
*/

include("conexao.php");
$dnumero = $_GET['dnumero'];
$stmt = $conn->prepare("DELETE FROM DEPARTAMENTO WHERE Dnumero=?");
$stmt->bind_param("i", $dnumero);
$stmt->execute();

echo "Departamento Excluído!!";