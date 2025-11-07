<?php

try{
    $conn = new PDO("mysql:host=localhost;dbname=pet", "root", "");
    $conn->setAttribute(PDO:: ATTR_ERRMODE, PDO:: ERRMODE_EXCEPTION);
} catch (PDOexpetion $e){
    echo "Erro de conexão:" . $e->getMessage();
    die();
}
?>