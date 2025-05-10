<?php
include("conexao.php");
include('header.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cpf = $_POST['cpf'];
    $pnome = $_POST['pnome'];
    $minicial = $_POST['minicial'];
    $unome = $_POST['unome'];
    $datanasc = $_POST['datanasc'];
    $endereco = $_POST['endereco'];
    $sexo = $_POST['sexo'];
    $salario = $_POST['salario'];
    $supervisor = $_POST['supervisor'];
    $dnr = $_POST['dnr'];

    $stmt = $conn->prepare("INSERT INTO FUNCIONARIO (Cpf, Pnome, Minicial, Unome, Datanasc, Endereco, Sexo, Salario, Cpf_supervisor, Dnr)
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssssssi", $cpf, $pnome, $minicial, $unome, $datanasc, $endereco, $sexo, $salario, $supervisor, $dnr);

    if ($stmt->execute()) {
        echo "Funcionário cadastrado com sucesso.";
    } else {
        echo "Erro: " . $stmt->error;
    }
    $stmt->close();
    $conn->close();
} else {
?>
<form method="POST">
    CPF: <input name="cpf"><br>
    Nome: <input name="pnome"><br>
    Inicial do Meio: <input name="minicial"><br>
    Sobrenome: <input name="unome"><br>
    Data de Nascimento: <input type="date" name="datanasc"><br>
    Endereço: <input name="endereco"><br>
    Sexo: <select name="sexo"><option>M</option><option>F</option></select><br>
    Salário: <input name="salario"><br>
    Supervisor (CPF): <input name="supervisor"><br>
    Departamento (Dnr): <input name="dnr"><br>
    <input type="submit" value="Cadastrar">
</form>
<?php } ?>
