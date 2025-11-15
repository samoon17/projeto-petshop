<?php 
include 'conexao.php';
session_start();
    if(!isset ($_SESSION['usuario_id'])){
        $_SESSION['mensagem'] ="Faça o Login";
        header('Location: pagina.php');

        exit();
    }
echo "Você está logado";
?>