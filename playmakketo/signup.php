<?php
include("header.php");
include("connect.php");
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome_usuario = htmlspecialchars($_POST['usuario']);
    $email_usuario = htmlspecialchars($_POST['email']);
    $senha = htmlspecialchars($_POST['password']);
    $adm = isset($_POST['adm']) ? 1 : 0;

    $inputIsValid = !empty($nome_usuario) && !empty($email_usuario) && !empty($senha);

    if ($inputIsValid) {
        $sql = "INSERT INTO usuario (nome_usuario, email_usuario, senha, adm) VALUES (:nome_usuario, :email_usuario, :senha, :adm)";
        $stmt = $conexao->prepare($sql);

        try {
            $stmt->bindParam(':nome_usuario', $nome_usuario);
            $stmt->bindParam(':email_usuario', $email_usuario);
            $stmt->bindParam(':senha', $senha);
            $stmt->bindParam(':adm', $adm, PDO::PARAM_INT);
            $stmt->execute();
            echo "User registration successful!";
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            var_dump($sql, $stmt);
        }
    } else {
        echo "Please fill out all fields.";
    }
}
?>
<div class="w-screen flex justify-center items-center mt-auto mb-auto text-white">
    <form class="flex flex-col w-full items-center mt-auto" action="signup.php" method="post">
        <h1 class="text-center text-2xl">Registrar-se</h1>
        <div class="flex flex-col mt-4">
            <label for="usuario">Usuario</label>
            <input name="usuario" id="usuario" type="text" autocomplete="username" class="bg-slate-400 text-gray-900 h-8 w-60 rounded-sm pl-2" required />
        </div>
        <div class="flex flex-col mt-4">
            <label for="email">Email</label>
            <input name="email" id="email" type="email" class="bg-slate-400 text-gray-900 h-8 w-60 rounded-sm pl-2" required />
        </div>
        <div class="flex flex-col mt-4">
            <label for="password">Senha</label>
            <input name="password" id="password" type="password" class="bg-slate-400 text-gray-900 h-8 w-60 rounded-sm pl-2" required />
        </div>
        <div class="w-full text-center mt-4">
            <input class="w-24 bg-green-600 p-2 rounded-md cursor-pointer hover:bg-green-500" type="submit" nome="register" value="Registrar" />
        </div>
        <span class="self-center text-center mt-2">Ja possui uma conta?<br><a href="login.php" class="text-green-600">Login</a></span>
    </form>
</div>
<?php
include("footer.php")
?>
