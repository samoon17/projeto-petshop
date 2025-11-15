<?php 
session_start();

    if(!isset ($_SESSION['usuario_id'])){
        $_SESSION['mensagem'] ="Faça o Login primeiro";
        header("Location: index.html");

        exit();
    }
$nome = $_SESSION['nome'];
$id = $_SESSION['id_usuario'];
?>