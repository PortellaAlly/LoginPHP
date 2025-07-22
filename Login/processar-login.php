<?php
// processar-login.php

// Ativar exibição de erros para debug (remova em produção)
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();  // Para usar $_SESSION, se desejar

// Só aceita requisições POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: login.php?erro=desconhecido");
    exit();
}

// Configurações do banco de dados
$host     = "localhost";
$user     = "root";
$password = "";
$dbname   = "login";

// Conecta ao MySQL
$conexao = mysqli_connect($host, $user, $password, $dbname);
if (!$conexao) {
    die("Erro na conexão: " . mysqli_connect_error());
}

// Lê e sanitiza os dados do formulário
$login_usuario = trim($_POST['usuario'] ?? '');
$login_senha   = trim($_POST['senha']   ?? '');

// Valida campos não vazios
if ($login_usuario === '' || $login_senha === '') {
    header("Location: login.php?erro=campos");
    exit();
}

// Prepara consulta usando prepared statements
$sql  = "SELECT Usuário, Senha FROM loginsist WHERE Usuário = ?";
$stmt = mysqli_prepare($conexao, $sql);
if (! $stmt) {
    die("Erro ao preparar consulta: " . mysqli_error($conexao));
}

mysqli_stmt_bind_param($stmt, "s", $login_usuario);
mysqli_stmt_execute($stmt);
$resultado = mysqli_stmt_get_result($stmt);

// Verifica se encontrou usuário
if (! $resultado || mysqli_num_rows($resultado) === 0) {
    header("Location: login.php?erro=usuario");
    exit();
}

$linha       = mysqli_fetch_assoc($resultado);
$senha_hash  = $linha['Senha'];

// Verifica a senha
if (! password_verify($login_senha, $senha_hash)) {
    header("Location: login.php?erro=senha");
    exit();
}

// Login bem‑sucedido: grava na sessão e redireciona
$_SESSION['usuario'] = $linha['Usuário'];
header("Location: dashboard.php");
exit();

// Fechamento (não é estritamente necessário após exit)
mysqli_stmt_close(statement: $stmt);
mysqli_close($conexao);
// Fim do script
?>