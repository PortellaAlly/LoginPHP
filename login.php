<?php
// Inicia sessão (se for usar $_SESSION) ou lê o parâmetro GET
session_start();
$error = '';

// Opção A: ler de query string
if (isset($_GET['erro'])) {
    // você pode mapear códigos de erro para mensagens mais amigáveis
    switch ($_GET['erro']) {
        case 'campos':
            $error = 'Por favor preencha usuário e senha.';
            break;
        case 'usuario':
            $error = 'Usuário não encontrado.';
            break;
        case 'senha':
            $error = 'Senha inválida.';
            break;
        default:
            $error = 'Erro desconhecido. Tente novamente.';
    }
}

// Opção B: ler de sessão (descomente se quiser usar SESSION em vez de GET)
// if (isset($_SESSION['error_msg'])) {
//     $error = $_SESSION['error_msg'];
//     unset($_SESSION['error_msg']);
// }

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            background: #f0f4f8;
            font-family: 'Segoe UI', Arial, sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
        }
        h1 {
            color: #333;
            margin-bottom: 24px;
        }
        form {
            background: #fff;
            padding: 32px 24px;
            border-radius: 10px;
            box-shadow: 0 4px 24px rgba(0,0,0,0.08);
            display: flex;
            flex-direction: column;
            min-width: 320px;
        }
        label {
            margin-bottom: 6px;
            color: #555;
            font-weight: 500;
        }
        input[type="text"],
        input[type="password"] {
            padding: 10px;
            margin-bottom: 18px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 1rem;
            transition: border 0.2s;
        }
        input[type="text"]:focus,
        input[type="password"]:focus {
            border-color: #0078d7;
            outline: none;
        }
        input[type="submit"] {
            background: #0078d7;
            color: #fff;
            border: none;
            border-radius: 6px;
            padding: 12px;
            font-size: 1rem;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.2s;
        }
        input[type="submit"]:hover {
            background: #005fa3;
        }
        /* Estilo para mensagem de erro */
        .error-box {
            background: #fee;
            border: 1px solid #f99;
            color: #900;
            padding: 12px;
            border-radius: 6px;
            margin-bottom: 16px;
            width: 320px;
            text-align: center;
        }
    </style>
</head>
<body>
    <h1>Acessar o Sistema</h1>

    <?php if ($error): ?>
        <div class="error-box"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="post" action="processar-login.php">
        <label>Usuário:</label>
        <input type="text" name="usuario" placeholder="Digite o seu nome de usuário" required>
        <label>Senha:</label>
        <input type="password" name="senha" placeholder="Digite sua senha" required>
        <input type="submit" value="Acessar">
    </form>
</body>
</html>
