<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "consumirapicomphp";

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id_filme = $_GET['id'];

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Falha na conexão: " . $conn->connect_error);
    }

    $sql = "DELETE FROM filmes WHERE ID_FILME = $id_filme";

    if ($conn->query($sql) === TRUE) {
        $response = array("status" => "success");
    } else {
        $response = array("status" => "error", "message" => "Erro ao excluir filme: " . $conn->error);
    }
    include 'read.php';

    // $conn->close();
} else {
    $response = array("status" => "error", "message" => "ID do filme não especificado ou inválido.");
}
    // echo json_encode($response);
