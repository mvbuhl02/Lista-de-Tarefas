<?php

    require '../model/connection.php';
    require '../model/Tarefa.php';

    $tarefa = new Tarefa($pdo); // Cria uma nova instância da classe Tarefa, passando o objeto PDO

    // Verifica se foi passado um id via GET
    if(isset($_GET['id'])) {
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

        // Busca a tarefa pelo id
        $getTarefa = $tarefa->buscarTarefa($id);

        // Verifica se encontrou a tarefa pelo id
        if(empty($getTarefa)) {
            echo "Tarefa não encontrada.";
            exit;
        }
    } else {
        echo "Id da tarefa não informado.";
        exit;
    }

    // Verifica se foi enviado um formulário via POST
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
        $titulo = filter_input(INPUT_POST, 'titulo', FILTER_SANITIZE_STRING);
        $descricao = filter_input(INPUT_POST, 'descricao', FILTER_SANITIZE_STRING);
        $data_vencimento = filter_input(INPUT_POST, 'data_vencimento', FILTER_SANITIZE_STRING);
        $concluida = isset($_POST['concluida']) ? 1 : 0;

        // Chama o método editarTarefa da classe Tarefa
        $tarefa->editarTarefa($id, $titulo, $descricao, $data_vencimento, $concluida);

        // Redireciona o usuário para a página inicial
        header('Location: index.php');
        exit;
    }
?>

<link rel="stylesheet" href="../styles/bootstrap.min.css">
<script src="../styles/bootstrap.min.js"></script>

<form action="" method="post" class="container">
    <div class="form-group">
        <label for="titulo">Título:</label>
        <input type="text" class="form-control" id="titulo" name="titulo" value="<?php echo $getTarefa['titulo']; ?>" required>
    </div>

    <div class="form-group">
        <label for="descricao">Descrição:</label>
        <textarea class="form-control" id="descricao" name="descricao"><?php echo $getTarefa['descricao']; ?></textarea>
    </div>

    <div class="form-group">
        <label for="data_vencimento">Data de vencimento:</label>
        <input type="date" class="form-control" id="data_vencimento" name="data_vencimento" value="<?php echo $getTarefa['data_vencimento']; ?>" required>
    </div>

    <div class="form-group form-check">
        <input type="checkbox" class="form-check-input" id="concluida" name="concluida" value="1"<?php if ($getTarefa['concluida'] == 1) { echo ' checked'; } ?>>
        <label class="form-check-label" for="concluida">Concluída:</label>
    </div>

    <input type="hidden" name="id" value="<?php echo $getTarefa['id']; ?>">

    <button type="submit" class="btn btn-primary">Editar tarefa</button>
</form>

</form>