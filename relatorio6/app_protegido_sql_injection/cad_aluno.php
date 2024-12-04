<?php
// Recuperando dados do formulário
$nome = $_POST['nome'];
$telefone = $_POST['telefone'];

// Variáveis para a conexão ao BD
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bdr6";

// Criando a conexão com o BD
$strcon = new mysqli($servername, $username, $password, $dbname);

// Verificando conexão
if ($strcon->connect_error) {
    die("Erro ao conectar ao banco de dados: " . $strcon->connect_error);
}

// Criando o prepared statement
$statement = $strcon->prepare("INSERT INTO aluno (nome, telefone) VALUES (?, ?)");
if (!$statement) {
    die("Erro ao preparar o statement: " . $strcon->error);
}

// Vinculando parâmetros
$statement->bind_param("ss", $nome, $telefone);

// Executando o statement
if ($statement->execute()) {
    echo "Aluno cadastrado com sucesso!";
} else {
    echo "Erro ao cadastrar aluno: " . $statement->error;
}

// Fechando o statement e a conexão
$statement->close();
$strcon->close();
?>

