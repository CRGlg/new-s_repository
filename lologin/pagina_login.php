<?php
// login.php
session_start();

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: home.php");
    exit;
}

require_once "config.php";
require_once "User.php";

$userModel = new User($pdo);

$username = $password = $captcha_input = "";
$username_err = $password_err = $login_err = $captcha_err = "";

$num1 = rand(1, 10);
$num2 = rand(1, 10);
$_SESSION["captcha_result"] = $num1 + $num2;

if($_SERVER["REQUEST_METHOD"] == "POST"){

    if(empty(trim($_POST["username"]))){
        $username_err = "Por favor, insira o nome de usuário.";
    } else{
        $username = trim($_POST["username"]);
    }

    if(empty(trim($_POST["password"]))){
        $password_err = "Por favor, insira sua senha.";
    } else{
        $password = trim($_POST["password"]);
    }

    if(empty(trim($_POST["captcha_input"]))){
        $captcha_err = "Por favor, resolva o captcha.";
    } else {
        $captcha_input = trim($_POST["captcha_input"]);
        if($captcha_input != $_SESSION["captcha_result"]){
            $captcha_err = "Resposta do captcha incorreta.";
        }
    }

    if(empty($username_err) && empty($password_err) && empty($captcha_err)){
        $loggedUser = $userModel->login($username, $password);

        if($loggedUser){
            $_SESSION["loggedin"] = true;
            $_SESSION["id"] = $loggedUser->id;
            $_SESSION["username"] = $loggedUser->username;
            header("location: home.php");
            exit;
        } else {
            $login_err = "Nome de usuário ou senha inválidos.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Seu Projeto</title>
    <link rel="stylesheet" href="seus-estilos.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .login-container {
            width: 360px;
            padding: 20px;
            margin: 50px auto;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .invalid-feedback {
            display: block;
            color: #dc3545;
            font-size: 0.875em;
            margin-top: 0.25rem;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Acessar sua Conta</h2>
        <p>Por favor, preencha suas credenciais.</p>

        <?php
        if(!empty($login_err)){
            echo '<div class="alert alert-danger">' . $login_err . '</div>';
        }
        if(isset($_GET['registered']) && $_GET['registered'] == 'true'){
            echo '<div class="alert alert-success">Conta criada com sucesso! Faça login.</div>';
        }
        ?>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label for="username">Nome de Usuário</label>
                <input type="text" id="username" name="username" class="form-control <?php echo (!empty(<span class="math-inline">username\_err\)\) ? 'is\-invalid' \: ''; ?\>" value\="<?php echo htmlspecialchars\(</span>username); ?>">
                <span class="invalid-feedback"><?php echo $username_err; ?></span>
            </div>
            <div class="form-group">
                <label for="password">Senha</label>
                <input type="password" id="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <label>Eu não sou um robô: Qual é o resultado de <?php echo $num1 . " + " . $num2; ?>?</label>
                <input type="text" name="captcha_input" class="form-control <?php echo (!empty($captcha_err)) ? 'is-invalid' : ''; ?>" value="<?php echo htmlspecialchars($captcha_input); ?>">
                <span class="invalid-feedback"><?php echo $captcha_err; ?></span>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block">Entrar</button>
            </div>
            <p class="text-center">Não tem uma conta? <a href="register.php">Cadastre-se agora</a>.</p> </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>