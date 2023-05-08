<?php
require 'model/connection.php';


$sql = $pdo->query('SELECT * FROM tarefas');
$dados = $sql->fetchAll();
?>
	<link rel="stylesheet" href="styles/bootstrap.min.css">
	<script src="styles/bootstrap.min.js"></script>

    <div class="container">
    <h1>Tarefas</h1>
    <a href="view/adicionar_tarefa.php" class="btn btn-primary">Adicionar nova tarefa</a>

    <div class="row">
        <?php foreach ($dados as $tarefa): ?>
        <div class="col-md-6 col-lg-4">
            <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title"><?= $tarefa['titulo'] ?></h5>
                <p class="card-text"><?= $tarefa['descricao'] ?></p>
                <p class="card-text"><small class="text-muted">Data de vencimento: <?= $tarefa['data_vencimento'] ?></small></p>
                <?php if ($tarefa['concluida']): ?>
                    <button type="button" class="btn btn-success" disabled>Concluída</button>
                <?php else: ?>
                    <button type="button" class="btn btn-primary">Marcar como concluída</button>
                <?php endif; ?>
                <a href="view/editar_tarefa.php?id=<?= $tarefa['id'] ?>" class="btn btn-warning">Editar</a>
                <a href="view/excluir_tarefa.php?id=<?= $tarefa['id'] ?>" class="btn btn-danger">Excluir</a>
            </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    </div>