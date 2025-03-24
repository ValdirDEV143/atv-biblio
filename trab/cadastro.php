<?php
include 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titulo = $_POST['titulo'];
    $autor = $_POST['autor'];
    $data_publicacao = $_POST['data_publicacao'];
    $data_aquisicao = $_POST['data_aquisicao'];
    $genero = $_POST['genero'];
    $sinopse = $_POST['sinopse'];

    $sql = "INSERT INTO livros (titulo, autor, data_publicacao, data_aquisicao, genero, sinopse)
            VALUES (?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $titulo, $autor, $data_publicacao, $data_aquisicao, $genero, $sinopse);

    if ($stmt->execute()) {
        echo "Livro cadastrado com sucesso!";
    } else {
        echo "Erro: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>