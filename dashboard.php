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
<body class="bg-gray-100 min-h-screen">
    <div class="max-w-2xl mx-auto mt-10 bg-white shadow-lg rounded-lg p-8">
        <h1 class="text-2xl font-bold mb-4"><?= "$saudacao, $nome!"; ?></h1>
        <hr class="my-6">

        <h2 class="text-xl font-semibold mb-2">Cadastro de Oportunidade</h2>
        <form method="post" action="processar-oportunidade.php" enctype="multipart/form-data" class="space-y-4 mb-8">
            <label class="block">
                <span class="text-gray-700">Imagem:</span><br>
                <input type="file" name="imagem" accept="image/*" class="mt-1 block w-full border rounded px-3 py-2">
            </label>

            <label class="block">
                <span class="text-gray-700">Título:</span><br>
                <input type="text" name="titulo" required class="mt-1 block w-full border rounded px-3 py-2">
            </label>

            <label class="block">
                <span class="text-gray-700">Descrição:</span><br>
                <textarea name="descricao" rows="4" required class="mt-1 block w-full border rounded px-3 py-2"></textarea>
            </label>

            <label class="block">
                <span class="text-gray-700">Data:</span><br>
                <input type="date" name="data" required class="mt-1 block w-full border rounded px-3 py-2">
            </label>

            <label class="inline-flex items-center">
                <input type="checkbox" name="destaque" value="1" class="form-checkbox">
                <span class="ml-2 text-gray-700">Destaque</span>
            </label>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Salvar Oportunidade</button>
        </form>

        <hr class="my-6">

        <h2 class="text-xl font-semibold mb-2">Cadastro de Evento</h2>
        <form method="post" action="processar-evento.php" enctype="multipart/form-data" class="space-y-4">
            <label class="block">
                <span class="text-gray-700">Imagem:</span><br>
                <input type="file" name="imagem" accept="image/*" class="mt-1 block w-full border rounded px-3 py-2">
            </label>

            <label class="block">
                <span class="text-gray-700">Título:</span><br>
                <input type="text" name="titulo" required class="mt-1 block w-full border rounded px-3 py-2">
            </label>

            <label class="block">
                <span class="text-gray-700">Descrição:</span><br>
                <textarea name="descricao" rows="4" required class="mt-1 block w-full border rounded px-3 py-2"></textarea>
            </label>

            <label class="block">
                <span class="text-gray-700">Data:</span><br>
                <input type="date" name="data" required class="mt-1 block w-full border rounded px-3 py-2">
            </label>

            <label class="inline-flex items-center">
                <input type="checkbox" name="destaque" value="1" class="form-checkbox">
                <span class="ml-2 text-gray-700">Destaque</span>
            </label>

            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Salvar Evento</button>
        </form>
    </div>
</body>
</html>
