<?php
/ config.php
define('DB_HOST', 'localhost');
define('DB_USER', 'seu_usuario_do_banco'); // Mude para seu usuário real
define('DB_PASS', 'sua_senha_do_banco'); // Mude para sua senha real
define('DB_NAME', 'nome_do_seu_banco');   // Mude para o nome do seu banco de dados

try {
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
} catch (PDOException $e) {
    die("ERRO: Não foi possível conectar. " . $e->getMessage());
}



// User.php
class User {
    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function findByUsername($username) {
        $stmt = $this->pdo->prepare("SELECT id, username, password FROM usuarios WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function register($username, $password) {
        if ($this->findByUsername($username)) {
            return false;
        }
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->pdo->prepare("INSERT INTO usuarios (username, password) VALUES (:username, :password)");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $hashed_password);
        return $stmt->execute();
    }

    public function login($username, $password) {
        $user = $this->findByUsername($username);
        if ($user && password_verify($password, $user->password)) {
            return $user;
        }
        return false;
    }

    public function getAllUsers() {
        $stmt = $this->pdo->query("SELECT id, username FROM usuarios");
        return $stmt->fetchAll();
    }
}
?>