<?php

$host = "ec2-3-231-215-130.compute-1.amazonaws.com";
$database = "bd_av4i_lucassydor";
$username = "av_lucassydor";
$password = "lucassydor";

   try {
       $conexao = new PDO("mysql:host=".$host.";dbname=".$database, $username, $password);
       $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       $conexao->exec("set names utf8");
    //    echo "Sucesso de conexão com a base";


   } catch (PDOException $erro) {
       echo "<p class=\"bg-danger\">Erro na conexão:" . $erro->getMessage() . "</p>";
   }  

?>