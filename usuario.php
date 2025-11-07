<?php

class Usuario{
   private $conn;
   private $usuario_id;
   public  $nome;
   public  $endereco;
   protected  $email;
   public  $telefone;
   private $senhaHash;

   public function _construct($conn, $nome, $endereco, $telefone, $email, $senha){
    $this->conn = $conn;
    $this->nome = trim($nome);
    $this->endereco = $endereco;
    $this->telefone = $telefone;
    
    
      $email = strtolower(trim($email));
      if (!filter_var($email,FILTER_VALIDATE_EMAIL))
     {throw new Exception("Email inválido.");
     }
     $this->email =($email);
     $this->senhaHash = password_hash($senha,
     PASSWORD_DEFAULT);
   }

   public function getId(){
      return $this->usuario_id;
   }

   public function salvar(){
      $sql = "INSERT INTO usuarios (nome,
      endereco, telefone, email, senha) VALUES
      (?,?,?,?,?)";
      $stmt = $this->conn->prepare($sql);

      if($stmt->execute([$this->nome,
      $this->endereco, $this->telefone,
      $this->email,$this->senhaHash])){
      $this->usuario_id =$this->conn->LastInsertId();
      return $this->usuario_id;
      }else{
         throw new Exception("Erro em salvar o usuario.");
      }
   }
}

 

?>