<?php
include("connect.php");
var_dump($_POST);


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome_usuario = htmlspecialchars($_POST['usuario']);
    $email_usuario = htmlspecialchars($_POST['email']);
    $senha = htmlspecialchars($_POST['password']);

    $inputIsValid = !empty($nome_usuario) && !empty($email_usuario) && !empty($senha);

    if ($inputIsValid) {
        $sql = "INSERT INTO usuario (nome_usuario, email_usuario, senha) VALUES (:nome_usuario, :email_usuario, :senha)";
        $stmt = $conexao->prepare($sql);

        // Hash the password before storing it in the database (recommended)
        $hashed_password = password_hash($senha, PASSWORD_DEFAULT);

        try {
            $stmt->bindParam(':nome_usuario', $nome_usuario);
            $stmt->bindParam(':email_usuario', $email_usuario);
            $stmt->bindParam(':senha', $hashed_password);
            $stmt->execute();
            echo "User registration successful!";
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    } else {
        echo "Please fill out all fields.";
    }
}
