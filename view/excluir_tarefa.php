<?php 
    require '../model/connection.php';
    require '../model/Tarefa.php';

if (!empty($_GET['id'])) {
    $id = $_GET['id'];

    $tarefa = new Tarefa($pdo);

    if ($tarefa->excluirTarefa($id)) {
        // Redireciona o usuário para a página inicial
        header("Location: ../index.php");
        exit;
    } else {
        // Exibe uma mensagem de erro
        echo "Não foi possível excluir a tarefa.";
    }
} else {
    // Exibe uma mensagem de erro
    echo "Não foi possível excluir a tarefa. ID inválido.";
}
