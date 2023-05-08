<?php 

require '../model/connection.php';
require '../model/Tarefa.php';

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Cria uma nova instância da classe Tarefa
    $tarefa = new Tarefa($pdo);

    // Recupera os valores do formulário
    $titulo = $_POST['titulo'];
    $descricao = $_POST['descricao'];
    $data_vencimento = $_POST['data_vencimento'];
    $concluida = false; // Por padrão, a nova tarefa não está concluída

    // Chama o método adicionarTarefa() para inserir a nova tarefa no banco de dados
    $tarefa->adicionarTarefa($titulo, $descricao, $data_vencimento, $concluida);

    // Redireciona o usuário de volta para a lista de tarefas
    header('Location: listar_tarefas.php');
    exit;
}
?>

<html>
<head>
	<title>Formulário de Tarefas</title>
	<link rel="stylesheet" href="../styles/bootstrap.min.css">
	<script src="../styles/bootstrap.min.js"></script>
</head>
<body>
	<main class="container">
	<h1>Adicionar Tarefa</h1>
	<form action="" method="POST">
  		<div class="form-group">
    		<label for="titulo">Título:</label>
    		<input type="text" class="form-control" id="titulo" name="titulo" required>
  		</div>
  		<div class="form-group">
    		<label for="descricao">Descrição:</label>
    		<textarea class="form-control" id="descricao" name="descricao" rows="5" cols="33" required></textarea>
  		</div>
  		<div class="form-group">
    		<label for="data_vencimento">Data de Vencimento:</label>
    		<input type="date" class="form-control" id="data_vencimento" name="data_vencimento" min="<?php echo date('Y-m-d'); ?>" max="9999-12-31" required>
  		</div>
  		<button type="submit" class="btn btn-primary">Adicionar Tarefa</button>
	</form>
	</main>
</body>
</html>
