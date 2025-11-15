<?php
session_start();
include 'conexao2.php';

class UserAuthenticator {
    private $conexao;

    public function __construct($conexao) {
        $this->conexao = $conexao;
    }

    public function authenticate($username,$password) {
        $stmt = $this->conexao->prepare("SELECT
        usuario_id, senha FROM usuarios WHERE nome = ?");
        if (!$stmt) {
            die("Erro no prepare (authenticate): ".
            $this->conexao->error);
        }
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0){
            $user = $result->fetch_assoc();
            //
            if (password_verify($password, $user["senha"])) {
                return $user["usuario_id"];
            }
        }

        return false;
    }
    public function userExists($username){
        $stmt = $this->conexao->prepare("SELECT
        usuario_id FROM usuarios WHERE nome = ?");
        if(!$stmt){
            die("Erro no prepare (userExists):"
            . $this->conexao->error);
        }

        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result && $result->num_rows > 0;
    }
}

//Processa o login se o formulario for enviado
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = $_POST["nome"] ?? '';
    $senha = $_POST["senha"] ?? '';

    $authenticator = new UserAuthenticator($conexao);

    if($authenticator->userExists($nome)) {
        $userId = $authenticator->authenticate($nome, $senha);

        if ($userId){
            $_SESSION['id_usuario'] = $userId;
            $_SESSION['nome'] = $nome;
            header("Location: verifica_cliente.php");
        } else{
            echo " Senha Incorreta. <a href'index.html'>Tente novamente></a>.";
        }
    } else {
        echo "<img src='img/img.png' alt='Você não está cadastrado, favor registre-se'>";
    }
}else{
    echo "Servidor não envio via POST";
    var_dump($_SERVER["REQUEST_METHOD"]);
}

?>