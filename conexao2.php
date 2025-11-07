<?php

$host = 'localhost';
$dbname = 'joao';
$username = 'root';
$password = '';

//Cria conexão com banco de dados
$conexao = new mysqli($host, $username,
 $password, $dbname);


 //verifica se houve erro na conexao

 if($conexao->connect_error){
    die ("Erro ao conectar ap banco de dados:" 
    . $conexao->connect_error);
 }

?>