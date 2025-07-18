<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit();
}

// Configurações do banco de dados
$host = 'localhost';
$dbname = 'login'; // Substitua pelo nome do seu banco
$username = 'root'; // Substitua pelo seu usuário
$password = ''; // Substitua pela sua senha

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro na conexão com o banco de dados: " . $e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titulo = trim($_POST['titulo']);
    $descricao = trim($_POST['descricao']);
    $data = $_POST['data'];
    $imagem = '';
    
    // Validação básica
    if (empty($titulo) || empty($descricao) || empty($data)) {
        header('Location: dashboard.php?erro=campos_obrigatorios');
        exit();
    }
    
    // Processar upload da imagem
    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] == 0) {
        $extensoes_permitidas = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        $nome_arquivo = $_FILES['imagem']['name'];
        $extensao = strtolower(pathinfo($nome_arquivo, PATHINFO_EXTENSION));
        
        if (in_array($extensao, $extensoes_permitidas)) {
            $tamanho_maximo = 5 * 1024 * 1024; // 5MB
            if ($_FILES['imagem']['size'] <= $tamanho_maximo) {
                $diretorio_upload = 'uploads/oportunidades/';
                
                // Criar diretório se não existir
                if (!is_dir($diretorio_upload)) {
                    mkdir($diretorio_upload, 0755, true);
                }
                
                // Gerar nome único para o arquivo
                $nome_unico = uniqid() . '_' . time() . '.' . $extensao;
                $caminho_completo = $diretorio_upload . $nome_unico;
                
                if (move_uploaded_file($_FILES['imagem']['tmp_name'], $caminho_completo)) {
                    $imagem = $nome_unico;
                } else {
                    header('Location: dashboard.php?erro=erro_upload');
                    exit();
                }
            } else {
                header('Location: dashboard.php?erro=arquivo_muito_grande');
                exit();
            }
        } else {
            header('Location: dashboard.php?erro=extensao_invalida');
            exit();
        }
    }
    
    try {
        // Inserir no banco de dados
        $sql = "INSERT INTO oportunidades (titulo, descricao, data, imagem, data_criacao) VALUES (?, ?, ?, ?, NOW())";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$titulo, $descricao, $data, $imagem]);
        
        // Redirecionar com sucesso
        header('Location: dashboard.php?sucesso=oportunidade_cadastrada');
        exit();
        
    } catch (PDOException $e) {
        // Se houve erro e foi feito upload da imagem, remover o arquivo
        if (!empty($imagem) && file_exists($caminho_completo)) {
            unlink($caminho_completo);
        }
        
        header('Location: dashboard.php?erro=erro_banco');
        exit();
    }
} else {
    header('Location: dashboard.php');
    exit();
}
?>