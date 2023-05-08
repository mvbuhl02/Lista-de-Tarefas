<?php

require 'connection.php';

class Tarefa {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

  public function listarTarefas() {
    $sql = $this->pdo->query('SELECT * FROM tarefas');
    return $sql->fetchAll();
  }

  public function adicionarTarefa($titulo, $descricao, $data_vencimento, $concluida) {
    // Prepara a consulta SQL com placeholders
    $sql = "INSERT INTO tarefas (titulo, descricao, data_vencimento, concluida) VALUES (:titulo, :descricao, :data_vencimento, :concluida)";

    // Prepara a declaração PDO
    $stmt = $this->pdo->prepare($sql);

    // Substitui os placeholders pelos valores das variáveis
    $stmt->bindValue(':titulo', $titulo, PDO::PARAM_STR);
    $stmt->bindValue(':descricao', $descricao, PDO::PARAM_STR);
    $stmt->bindValue(':data_vencimento', $data_vencimento, PDO::PARAM_STR);
    $stmt->bindValue(':concluida', $concluida, PDO::PARAM_BOOL);

    // Executa a consulta SQL
    $stmt->execute();
    header('Location: index.php');
    exit;
  }

  public function editarTarefa($id, $titulo, $descricao, $data_vencimento, $concluida) {
    // Prepara a consulta SQL com placeholders
    $sql = "UPDATE tarefas SET titulo = :titulo, descricao = :descricao, data_vencimento = :data_vencimento, concluida = :concluida WHERE id = :id";

    // Prepara a declaração PDO
    $stmt = $this->pdo->prepare($sql);

    // Substitui os placeholders pelos valores das variáveis
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->bindValue(':titulo', $titulo, PDO::PARAM_STR);
    $stmt->bindValue(':descricao', $descricao, PDO::PARAM_STR);
    $stmt->bindValue(':data_vencimento', $data_vencimento, PDO::PARAM_STR);
    $stmt->bindValue(':concluida', $concluida, PDO::PARAM_BOOL);

    // Executa a consulta SQL
    $stmt->execute();
  }

  public function buscarTarefa($id) {
    // Prepara a consulta SQL com placeholders
    $sql = "SELECT * FROM tarefas WHERE id = :id";

    // Prepara a declaração PDO
    $stmt = $this->pdo->prepare($sql);

    // Substitui o placeholder pelo valor da variável
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);

    // Executa a consulta SQL
    $stmt->execute();

    // Retorna o resultado da consulta
    return $stmt->fetch();
  }


  public function excluirTarefa($id) {
    // Prepara a consulta SQL
    $sql = "DELETE FROM tarefas WHERE id = :id";

    // Prepara a declaração PD
    $stmt = $this->pdo->prepare($sql);

    // Substitui o placeholder pelo valor da variável
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);

    // Executa a consulta SQL
    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
  }

  public function tata() {
    echo ('Hello');
  }
}

?>
