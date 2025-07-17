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

// Leitura dos dados do formulário
$login_usuario = isset($_POST["usuario"]) ? trim($_POST["usuario"]) : '';
$login_senha = isset($_POST["senha"]) ? trim($_POST["senha"]) : '';

// Validar dados
if (empty($login_usuario) || empty($login_senha)) {
    die("Erro: Usuário ou senha não fornecidos");
}

// CORREÇÃO: Usar os nomes corretos das colunas da sua tabela
$sql = "SELECT Usuário, Senha FROM loginsist WHERE Usuário = ?";
$stmt = mysqli_prepare($conexao, $sql);

if (!$stmt) {
    die("Erro ao preparar consulta: " . mysqli_error($conexao));
}

// Vincular parâmetros
mysqli_stmt_bind_param($stmt, "s", $login_usuario);

// Executar consulta
if (!mysqli_stmt_execute($stmt)) {
    die("Erro ao executar consulta: " . mysqli_stmt_error($stmt));
}

// Obter resultado
$resultado = mysqli_stmt_get_result($stmt);

if (!$resultado) {
    die("Erro ao obter resultado: " . mysqli_stmt_error($stmt));
}

// Verificar se encontrou usuário
if (mysqli_num_rows($resultado) === 0) {
    echo "Usuário não cadastrado";
} else {
    $linha = mysqli_fetch_assoc($resultado);
    $usuario_encontrado = $linha['Usuário'];  // Nome correto da coluna
    $senha_encontrada = $linha['Senha'];      // Nome correto da coluna
    
    // Verificar senha
    if (password_verify($login_senha, $senha_encontrada)) {
        echo "Login efetuado com sucesso!";
        echo "<br>Bem-vindo, " . htmlspecialchars($usuario_encontrado) . "!";
        
        // Aqui você pode iniciar uma sessão e redirecionar
        // session_start();
        // $_SESSION['usuario'] = $usuario_encontrado;
        // header("Location: dashboard.php");
        // exit();
    } else {
        echo "Usuário não cadastrado ou senha incorreta";
    }
}

// Fechar conexões
mysqli_stmt_close($stmt);
mysqli_close($conexao);
?>