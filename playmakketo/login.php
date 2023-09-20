<?php
    include("header.php");
    require_once("connect.php");
    session_start();
    //var_dump($_POST);
    if(isset($_POST['user']) && isset($_POST['email']) && isset($_POST['password'])){
        $user = $_POST['user'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $sql = "SELECT cod_usuario, nome_usuario, email_usuario, senha FROM usuario WHERE email_usuario = :email";
    
        try {
            $conexao = new PDO("mysql:host=".$host.";dbname=".$database,$username,$password);
            if($stmt = $conexao->prepare($sql)){
                
                $stmt->bindParam(':email', $email, PDO::PARAM_STR);
                $stmt->execute();
                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                if($row){
                    $id = $row["cod_usuario"];
                    $user = $row["nome_usuario"];
                    $email = $row["email_usuario"];
                    $hashedPassword = $row["senha"]; 

                    if (password_verify($password, $hashedPassword)) {
                        session_start();
                        $_SESSION["loggedin"] = true;
                        $_SESSION["id"] = $id;
                        $_SESSION["email"] = $email;
        
                        echo "Seja bem vindo administrador!<br>";
                    } else {
                        echo "<br>Senha incorreta!";
                    }
                } else {
                    echo "<br>Email não encontrado!";
                }
                
                unset($stmt);
            }
        } catch (PDOException $e) {
            echo "Erro na conexão com o banco de dados: ".$e->getMessage();
        } finally {
            unset($conexao);
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