<?php
    include("header.php");
    include("connect.php");
?>
<div class="w-screen flex justify-center items-center mt-auto mb-auto text-white ">
    <form class="flex flex-col w-full items-center mt-auto" action="login.php" method="post">
        <h1 class="text-center text-2xl">Registrar-se</h1>
        <div class="flex flex-col mt-4">
            <label for="">Usuario</label>
            <input name="usuario" type="text" autocomplete="username" class="bg-slate-400 text-gray-900 h-8 w-60 rounded-sm pl-2"/>
        </div>
        <div class="flex flex-col mt-4">
            <label for="">Email</label>
            <input name="email" type="email" class="bg-slate-400 text-gray-900 h-8 w-60 rounded-sm pl-2"/>
        </div>
        <div class="flex flex-col mt-4">
            <label for="">Senha</label>
            <input name="password" type="password" class="bg-slate-400 text-gray-900 h-8 w-60 rounded-sm pl-2"/>
        </div>
        <div class="w-full text-center mt-4">
            <input class="w-24 bg-green-600 p-2 rounded-md cursor-pointer hover:bg-green-500" type="submit" value="Registrar"/>
        </div>
    <span class="self-center text-center mt-2">Ja possui uma conta?<br><a href="login.php" class="text-green-600">Login</a></span>

    </form>
    
</div>
<?php
    include("footer.php")
?>