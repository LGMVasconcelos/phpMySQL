<?php

include_once("conexao.php");

//Pegando os dados do formulário
$nome = $_POST['nome'];
$email = $_POST['email'];
$nota1 = $_POST['nota1'];
$nota2 = $_POST['nota2'];
$nota3 = $_POST['nota3'];
$materia = $_POST['materia'];
$aluno_id = $_POST['aluno_id'];
$nota = ($nota1 + $nota2 + $nota3)/3;

// comando para mandar para o banco
$sql = "insert into alunos (nome, email) values ('$nome', '$email')";
$sql2 = "insert into notas (aluno_id, materia, nota) values ('$aluno_id', '$materia', $nota)";

if (mysqli_query($conn, $sql) && mysqli_query($conn, $sql2)){
    echo "<script type='text/javascript'>alert('Aluno cadastrado com sucesso!');</script>";
    header("Location: lista.php");
}
else  {
    echo "Erro ao cadastrar";
    echo "<a href='index.html'>Voltar</a>";
}