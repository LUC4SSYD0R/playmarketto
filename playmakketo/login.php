<?php
include("header.php");
require_once("connect.php");
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email_usuario = htmlspecialchars($_POST['email']);
    $senha = htmlspecialchars($_POST['password']);

    // Verifique se o email e a senha não estão vazios
    if (!empty($email_usuario) && !empty($senha)) {
        $sql = "SELECT cod_usuario, nome_usuario, email_usuario, senha, adm FROM usuario WHERE email_usuario = :email";

        try {
            $conexao = new PDO("mysql:host=".$host.";dbname=".$database, $username, $password);
            if ($stmt = $conexao->prepare($sql)) {
                $stmt->bindParam(':email', $email_usuario, PDO::PARAM_STR);
                $stmt->execute();
                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                var_dump($email_usuario, $senha, $row); // Adicionado var_dump para depuração

                if ($row) {
                    $id = $row["cod_usuario"];
                    $user = $row["nome_usuario"];
                    $dbPassword = $row["senha"];
                    $isAdmin = $row["adm"];

                    // Verifique se a senha inserida corresponde à senha no banco de dados
                    if ($senha === $dbPassword) {
                        $_SESSION["loggedin"] = true;
                        $_SESSION["id"] = $id;
                        $_SESSION["email"] = $email_usuario;

                        if ($isAdmin == 1) {
                            echo "Login feito com sucesso como administrador!<br>";
                        } else {
                            echo "Login feito com sucesso!<br>";
                        }
                    } else {
                        echo "<br>Senha incorreta!";
                    }
                } else {
                    echo "<br>Email não encontrado!";
                }
                unset($stmt);
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    } else {
        echo "Por favor, preencha todos os campos.";
    }
}
?>

<div class="w-screen flex justify-center items-center mt-auto mb-auto text-white ">
    <form class="flex flex-col w-full items-center mt-auto" action="login.php" method="post">
        <h1 class="text-center text-2xl">Faça seu login</h1>
        <!-- <div class="flex flex-col mt-4">
            <label for="">Usuario</label>
            <input name="usuario" type="text" autocomplete="username" class="bg-slate-400 text-gray-900 h-8 w-60 rounded-sm pl-2"/>
        </div> -->
        <div class="flex flex-col mt-4">
            <label for="">Email</label>
            <input name="email" type="email" class="bg-slate-400 text-gray-900 h-8 w-60 rounded-sm pl-2"/>
        </div>
        <div class="flex flex-col mt-4">
            <label for="">Senha</label>
            <input name="password" type="password" class="bg-slate-400 text-gray-900 h-8 w-60 rounded-sm pl-2"/>
        </div>
        <div class="w-full text-center mt-4">
            <input class="w-24 bg-green-600 p-2 rounded-md cursor-pointer hover:bg-green-500" type="submit" value="Login"/>
        </div>
    <span class="self-center text-center mt-2">Não tem uma conta?<br><a href="signup.php" class="text-green-600">Registre-se</a></span>

    </form>
    
</div>
<?php
    include("footer.php")
?>