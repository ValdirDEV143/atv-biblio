<?php
include 'conexao.php';

$genero = isset($_GET['genero']) ? $_GET['genero'] : '';
$data = isset($_GET['data']) ? $_GET['data'] : '';

$sql = "SELECT * FROM livros WHERE 1=1";

if (!empty($genero)) {
    $sql .= " AND genero LIKE ?";
}
if (!empty($data)) {
    $sql .= " AND data_publicacao = ?";
}

$stmt = $conn->prepare($sql);

if (!empty($genero) && !empty($data)) {
    $stmt->bind_param("ss", $genero, $data);
} elseif (!empty($genero)) {
    $stmt->bind_param("s", $genero);
} elseif (!empty($data)) {
    $stmt->bind_param("s", $data);
}

$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    echo "<div>";
    echo "<h2>" . $row['titulo'] . "</h2>";
    echo "<p><strong>Autor:</strong> " . $row['autor'] . "</p>";
    echo "<p><strong>Data de Publicação:</strong> " . $row['data_publicacao'] . "</p>";
    echo "<p><strong>Gênero:</strong> " . $row['genero'] . "</p>";
    echo "<p><strong>Sinopse:</strong> " . $row['sinopse'] . "</p>";
    echo "</div>";
}

$stmt->close();
$conn->close();
?>