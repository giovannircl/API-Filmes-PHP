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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtém os valores do formulário
    $id_filme = $_POST['id_filme'];
    $titulo = $conn->real_escape_string($_POST['titulo']);
    $dt_lancamento = $_POST['dt_lancamento'];
    $sinopse = $conn->real_escape_string($_POST['sinopse']);
    $rating = $_POST['rating'];
    $adulto = isset($_POST['adulto']) ? 1 : 0;
    $lingua_origem = $conn->real_escape_string($_POST['lingua_origem']);

    // Executa a operação de UPDATE no banco de dados
    $sql = "UPDATE filmes SET TITULO = '$titulo', DT_LANCAMENTO = '$dt_lancamento', SINOPSE = '$sinopse', RATING = '$rating', ADULTO = $adulto, LINGUA_ORIGEM = '$lingua_origem' WHERE ID_FILME = $id_filme";

    if ($conn->query($sql) === TRUE) {
        include 'read.php';
    } else {
        echo "Erro ao atualizar filme: " . $conn->error;
    }
}

// Fecha a conexão
$conn->close();
