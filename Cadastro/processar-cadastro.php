<?php
// Ativar exibição de erros para debug (remover em produção)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Verificar se é POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die("Erro: Este script só aceita requisições POST");
}

// Configurações do banco
$local = "localhost";
$admin = "root";
$senha = "";
$nome_bd = "login";

// Conexão com o BD
$conexao = mysqli_connect($local, $admin, $senha, $nome_bd);

// Verificar conexão
if (!$conexao) {
    die("Erro na conexão: " . mysqli_connect_error());
}

// Dados a serem cadastrados
$login_usuario = isset($_POST["usuario"]) ? trim($_POST["usuario"]) : '';
$login_senha = isset($_POST["senha"]) ? trim($_POST["senha"]) : '';

// Validar dados
if (empty($login_usuario) || empty($login_senha)) {
    die("Erro: Usuário ou senha não fornecidos");
}

// Verificar se usuário já existe
$sql_check = "SELECT Usuário FROM loginsist WHERE Usuário = ?";
$stmt_check = mysqli_prepare($conexao, $sql_check);
mysqli_stmt_bind_param($stmt_check, "s", $login_usuario);
mysqli_stmt_execute($stmt_check);
$resultado_check = mysqli_stmt_get_result($stmt_check);

if (mysqli_num_rows($resultado_check) > 0) {
    echo "Erro: Usuário já existe!";
    mysqli_stmt_close($stmt_check);
    mysqli_close($conexao);
    exit();
}

mysqli_stmt_close($stmt_check);

// CORREÇÃO: Usar os nomes corretos das colunas da sua tabela
$sql = "INSERT INTO loginsist (Usuário, Senha) VALUES (?, ?)";
$stmt = mysqli_prepare($conexao, $sql);

if (!$stmt) {
    die("Erro ao preparar consulta: " . mysqli_error($conexao));
}

// Criptografar a senha
$senha_criptografada = password_hash($login_senha, PASSWORD_DEFAULT);

// Vincular parâmetros
mysqli_stmt_bind_param($stmt, "ss", $login_usuario, $senha_criptografada);

// Executar consulta
if (mysqli_stmt_execute($stmt)) {
    echo "Usuário cadastrado com sucesso!";
    echo "<br>Usuário: " . htmlspecialchars($login_usuario);
} else {
    echo "Erro ao cadastrar usuário: " . mysqli_stmt_error($stmt);
}

// Fechar conexões
mysqli_stmt_close($stmt);
mysqli_close($conexao);
?>