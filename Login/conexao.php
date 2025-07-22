<?php
    // Exemplo de conexão com uma base de dados, usando
    // a extensão mysqli (MySQL Improved)

    $local = "localhost"; // Local (físico/máquina) onde está o banco de dados
    $admin = "root"; // login do adminstrador do banco de dados
    $senha = ""; // Senha do administrador do banco de dados
    $nome_bd = "login"; // Nome do banco de dados

    // Função para a conexão com o BD
    $conexao = mysqli_connect($local, $admin, $senha, $nome_bd);

    if($conexao) { // verifica se a conexão foi estabelecida
        echo "Conexão Estabelecida (: <br>";
    } else {
        echo "Conexão falhou ):";
    }

    // Monta a operação que será feita.
    //$sql = "SELECT * FROM alunos"; // Pegar todos os registros da tabela alunos
    //$resposta = mysqli_query($conexao, $sql); // Função para executar a operação
    //if($resposta) { // verifica se a operação foi realizada
        // Código para exibir os dados da tabela alunos
        // Também existe a função mysqli_fetch_row
     //   while($linha = mysqli_fetch_assoc($resposta)){
     //       echo $linha["nome"]."<br>";
    //    }
    //} else {
     //   echo "Não foi possivel realizar a operação no banco de dados.";
    //}
?>