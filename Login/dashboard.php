<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit();
}
date_default_timezone_set('America/Sao_Paulo');
$hora = (int) date('H');
if ($hora < 12) {
    $saudacao = 'Bom dia';
} elseif ($hora < 18) {
    $saudacao = 'Boa tarde';
} else {
    $saudacao = 'Boa noite';
}
$nome = htmlspecialchars($_SESSION['usuario'], ENT_QUOTES, 'UTF-8');
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-black via-gray-900 to-blue-900 min-h-screen">
<div>
    <!-- Saudação no topo esquerdo -->
    <header class="w-full p-6">
        <div class="max-w-7xl mx-auto">
            <h1 class="text-xl font-bold text-blue-200"><?= "$saudacao, $nome!"; ?></h1>
        </div>
    </header>

    <!-- Conteúdo central -->
    <main class="max-w-7xl mx-auto px-4">
        <div class="flex flex-col md:flex-row gap-8 justify-center">
            <!-- Card Oportunidade -->
            <div class="bg-gray-900/90 shadow-2xl rounded-2xl p-8 flex-1 border border-blue-800/30">
                <h2 class="text-xl font-semibold mb-6 text-blue-300 border-b border-blue-800/30 pb-3">Cadastro de Oportunidade</h2>
                <form method="post" action="processar-oportunidade.php" enctype="multipart/form-data" class="space-y-6">
                    <label class="block">
                        <span class="text-gray-200 font-medium">Imagem:</span>
                        <input type="file" name="imagem" accept="image/*" class="mt-2 block w-full border border-gray-700 rounded-lg px-4 py-2 bg-gray-800 text-white focus:outline-none focus:ring-2 focus:ring-blue-800 transition">
                    </label>
                    <label class="block">
                        <span class="text-gray-200 font-medium">Título:</span>
                        <input type="text" name="titulo" required class="mt-2 block w-full border border-gray-700 rounded-lg px-4 py-2 bg-gray-800 text-white focus:outline-none focus:ring-2 focus:ring-blue-800 transition">
                    </label>
                    <label class="block">
                        <span class="text-gray-200 font-medium">Descrição:</span>
                        <textarea name="descricao" rows="4" required class="mt-2 block w-full border border-gray-700 rounded-lg px-4 py-2 bg-gray-800 text-white focus:outline-none focus:ring-2 focus:ring-blue-800 transition resize-none"></textarea>
                    </label>
                    <label class="block">
                        <span class="text-gray-200 font-medium">Data:</span>
                        <input type="date" name="data" required class="mt-2 block w-full border border-gray-700 rounded-lg px-4 py-2 bg-gray-800 text-white focus:outline-none focus:ring-2 focus:ring-blue-800 transition">
                    </label>
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="destaque" value="1" class="form-checkbox rounded text-blue-600 bg-gray-800 border-gray-700 focus:ring-blue-800">
                        <span class="ml-3 text-gray-200">Destaque</span>
                    </label>
                    <button type="submit" class="w-full bg-gradient-to-r from-blue-900 to-blue-800 text-white font-bold px-6 py-3 rounded-lg shadow-lg hover:from-blue-800 hover:to-blue-700 transition-all duration-300 transform hover:scale-105">Salvar Oportunidade</button>
                </form>
            </div>
            <!-- Card Evento -->
            <div class="bg-gray-900/90 shadow-2xl rounded-2xl p-8 flex-1 border border-blue-800/30">
                <h2 class="text-xl font-semibold mb-6 text-blue-300 border-b border-blue-800/30 pb-3">Cadastro de Evento</h2>
                <form method="post" action="processar-evento.php" enctype="multipart/form-data" class="space-y-6">
                    <label class="block">
                        <span class="text-gray-200 font-medium">Imagem:</span>
                        <input type="file" name="imagem" accept="image/*" class="mt-2 block w-full border border-gray-700 rounded-lg px-4 py-2 bg-gray-800 text-white focus:outline-none focus:ring-2 focus:ring-blue-800 transition">
                    </label>
                    <label class="block">
                        <span class="text-gray-200 font-medium">Título:</span>
                        <input type="text" name="titulo" required class="mt-2 block w-full border border-gray-700 rounded-lg px-4 py-2 bg-gray-800 text-white focus:outline-none focus:ring-2 focus:ring-blue-800 transition">
                    </label>
                    <label class="block">
                        <span class="text-gray-200 font-medium">Descrição:</span>
                        <textarea name="descricao" rows="4" required class="mt-2 block w-full border border-gray-700 rounded-lg px-4 py-2 bg-gray-800 text-white focus:outline-none focus:ring-2 focus:ring-blue-800 transition resize-none"></textarea>
                    </label>
                    <label class="block">
                        <span class="text-gray-200 font-medium">Data:</span>
                        <input type="date" name="data" required class="mt-2 block w-full border border-gray-700 rounded-lg px-4 py-2 bg-gray-800 text-white focus:outline-none focus:ring-2 focus:ring-blue-800 transition">
                    </label>
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="destaque" value="1" class="form-checkbox rounded text-blue-600 bg-gray-800 border-gray-700 focus:ring-blue-800">
                        <span class="ml-3 text-gray-200">Destaque</span>
                    </label>
                    <button type="submit" class="w-full bg-gradient-to-r from-blue-900 to-blue-800 text-white font-bold px-6 py-3 rounded-lg shadow-lg hover:from-blue-800 hover:to-blue-700 transition-all duration-300 transform hover:scale-105">Salvar Evento</button>
                </form>
            </div>
        </div>
    </main>
</div>
</body>
</html>