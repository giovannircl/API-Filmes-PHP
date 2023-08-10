<!DOCTYPE html>
<html>

<head>
    <title>Edição de Filme</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@700&display=swap">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "consumirapicomphp";

    // Cria uma instância da conexão ao banco de dados
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verifica se ocorreu um erro na conexão
    if ($conn->connect_error) {
        die("Falha na conexão: " . $conn->connect_error);
    }

    // Verifica se foi recebido um ID válido através da URL
    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $id_filme = $_GET['id'];

        // Busca o registro do filme no banco de dados
        $sql = "SELECT * FROM filmes WHERE ID_FILME = $id_filme";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $filme = $result->fetch_assoc();
    ?>
    <form method="post" action="processa_update.php">
        <h1 class = "titulo-edicao">Edição de Filme</h1>
        <div class = "update">
                <input type="hidden" name="id_filme" value="<?php echo $filme['ID_FILME']; ?>">
            <div class="mb-3">
                <label for="titulo" class="form-label">Título</label>
                <input type="text" class="form-control" id="titulo" name="titulo" value="<?php echo $filme['TITULO']; ?>">
            </div>
            <div class="mb-3">
                <label for="dt_lancamento" class="form-label">Data de Lançamento</label>
                <input type="date" class="form-control" id="dt_lancamento" name="dt_lancamento" value="<?php echo $filme['DT_LANCAMENTO']; ?>">
            </div>
            <div class="mb-3">
                <label for="sinopse" class="form-label">Sinopse</label>
                <textarea class="form-control" id="sinopse" name="sinopse"><?php echo $filme['SINOPSE']; ?></textarea>
            </div>
            <div class="mb-3">
                <label for="rating" class="form-label">Rating</label>
                <input type="number" class="form-control" id="rating" name="rating" value="<?php echo $filme['RATING']; ?>">
            </div>
            <div class="mb-3 form-check">
                <label class="form-check-label form-label" for="adulto">Adulto</label>
                <input type="checkbox" class="form-check-input" id="adulto" name="adulto" <?php echo $filme['ADULTO'] ? 'checked' : ''; ?>>
            </div>
            <div class="mb-3">
                <label for="lingua_origem" class="form-label">Língua de Origem</label>
                <input type="text" class="form-control" id="lingua_origem" name="lingua_origem" value="<?php echo $filme['LINGUA_ORIGEM']; ?>">
            </div>
            <button type="submit" class="btn btn-primary">Salvar</button>
        </div>
    </form>
    <?php
        } else {
            echo "Filme não encontrado.";
        }
    } else {
        echo "ID do filme não especificado ou inválido.";
    }

    // Fecha a conexão
    $conn->close();
    ?>
</body>

</html>