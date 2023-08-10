<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "consumirapicomphp";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

require_once('vendor/autoload.php');
$client = new \GuzzleHttp\Client();

$response = $client->request('GET', 'https://api.themoviedb.org/3/discover/movie?include_adult=true', [
    'headers' => [
        'Authorization' => 'Bearer', // aqui é o local de colocar o token para consumir a API TMDB
        'accept' => 'application/json',
    ],
]);

$res = json_decode($response->getBody(), true);

if (is_array($res)) { // Confere se deu tudo certo com a decodificação do json
    foreach ($res['results'] as $movie) { // Itera sob cada um dos objetos dentro do json
        $id = $movie['id'];
        $titulo = $conn->real_escape_string($movie['title']);
        $sinopse = $conn->real_escape_string($movie['overview']);
        $dtLancamento = $movie['release_date'];
        $adulto = $movie['adult'];
        $rating = $movie['vote_average'];
        $linguaOrigem = $conn->real_escape_string($movie['original_language']);

        $sql = "INSERT IGNORE INTO filmes (ID_FILME, TITULO, DT_LANCAMENTO, SINOPSE, RATING, ADULTO, LINGUA_ORIGEM) 
                                VALUES ('$id', '$titulo', '$dtLancamento', '$sinopse', '$rating', '$adulto', '$linguaOrigem')";

        if (!$conn->query($sql) === TRUE) {
            echo "Erro ao inserir filme: " . $conn->error . "<br>";
        }
    }
    include 'read.php';
} else {
    echo 'Erro ao decodificar o JSON.';
}
if ($conn->ping()) {
    $conn->close();
}
