<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "consumirapicomphp";

if (!$conn->ping()) {
    $conn->close();
    $conn = new mysqli($servername, $username, $password, $dbname);
}

$sql = "SELECT * FROM filmes";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Tabela de Filmes</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@700&display=swap">
    <link rel="stylesheet" href="style.css">
</head>

<body class="read">
    <div class="tabela">
        <h1>Filmes</h1>
        <table class="table table-striped table-wrapper-scroll-y my-custom-scrollbar tab">
            <thead class="thead-dark">
                <tr class="cabecalho-tabela">
                    <th class="align-middle">ID</th>
                    <th class="align-middle">Título</th>
                    <th class="align-middle">Data de Lançamento</th>
                    <th class="align-middle">Sinopse</th>
                    <th class="align-middle">Rating</th>
                    <th class="align-middle">Adulto</th>
                    <th class="align-middle">Língua de Origem</th>
                    <th class="align-middle">Ação</th>
                </tr>
            </thead>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td class='align-middle'>" . $row['ID_FILME'] . "</td>";
                    echo "<td class='align-middle'>" . $row['TITULO'] . "</td>";
                    echo "<td class='align-middle'>" . $row['DT_LANCAMENTO'] . "</td>";
                    echo "<td class='align-middle'>" . $row['SINOPSE'] . "</td>";
                    echo "<td class='align-middle'>" . $row['RATING'] . "</td>";
                    echo "<td class='align-middle'>" . ($row['ADULTO'] ? 'Sim' : 'Não') . "</td>";
                    echo "<td class='align-middle'>" . $row['LINGUA_ORIGEM'] . "</td>";
                    echo "<td class='align-middle'>
                        <a href=\"update.php?id=" . $row['ID_FILME'] . "\"><i class='bi bi-pencil-square' style='font-size: 20px;'></i></span></a>
                        <a href=\"exclude.php?id=" . $row['ID_FILME'] . "\"><i class='bi bi-trash' style='font-size: 20px;'></i></span></a>
                        </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='8'>Nenhum filme encontrado na tabela.</td></tr>";
            }
            ?>
        </table>
    </div>
</body>

</html>