<?php
session_start();
$error = '';

if (isset($_GET['erro'])) {
    // Independente do tipo de erro, sempre mostra a mesma mensagem genérica
    $error = 'Usuário e/ou senha inválidos.';
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-gradient-to-br from-black via-gray-900 to-blue-900 flex items-center justify-center">
    <div class="w-full max-w-md mx-auto">
        <div class="bg-gray-900/90 rounded-2xl shadow-2xl px-8 py-10 relative border-t-8 border-blue-800">
            <div class="absolute -top-10 left-1/2 -translate-x-1/2">
                <div class="bg-gradient-to-tr from-blue-900 to-black rounded-full p-2 shadow-lg">
                    <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 11c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v3h16v-3c0-2.66-5.33-4-8-4z"/>
                    </svg>
                </div>
            </div>
            <h1 class="text-2xl font-extrabold text-center text-blue-200 mt-8 mb-6 tracking-wide">Bem-vindo!</h1>
            <?php if ($error): ?>
                <div class="bg-red-50 border border-red-300 text-red-700 px-4 py-3 rounded mb-4 text-center animate-pulse">
                    <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>
            <form method="post" action="processar-login.php" class="flex flex-col gap-4">
                <label class="font-semibold text-gray-200" for="usuario">Usuário</label>
                <input
                    type="text"
                    name="usuario"
                    id="usuario"
                    placeholder="Digite o seu nome de usuário"
                    required
                    class="px-4 py-2 rounded-lg border border-gray-700 bg-gray-800 text-white focus:outline-none focus:ring-2 focus:ring-blue-800 transition"
                >
                <label class="font-semibold text-gray-200" for="senha">Senha</label>
                <input
                    type="password"
                    name="senha"
                    id="senha"
                    placeholder="Digite sua senha"
                    required
                    class="px-4 py-2 rounded-lg border border-gray-700 bg-gray-800 text-white focus:outline-none focus:ring-2 focus:ring-blue-800 transition"
                >
                <button
                    type="submit"
                    class="mt-4 bg-gradient-to-r from-blue-900 to-black text-white font-bold py-2 rounded-lg shadow hover:from-blue-800 hover:to-gray-900 transition"
                >
                    Acessar
                </button>
            </form>
        </div>
    </div>
</body>
</html>