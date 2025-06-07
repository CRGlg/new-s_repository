<?php
// register.php
session_start();

require_once "config.php";
require_once "User.php";

$userModel = new User($pdo);

$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";

// Processar formulário
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Valida o nome de usuário: Deve conter apenas letras e números
    if(empty(trim($_POST["username"]))){
        $username_err = "Por favor, insira um nome de usuário.";
    } elseif(!preg_match('/^[a-zA-Z0-9]+$/', trim($_POST["username"]))){ // REGEX ALTERADO AQUI
        $username_err = "O nome de usuário pode conter apenas letras e números.";
    } else{
        if($userModel->findByUsername(trim($_POST["username"]))){
            $username_err = "Este nome de usuário já está em uso.";
        } else {
            $username = trim($_POST["username"]);
        }
    }

    // Valida a senha: Deve ter no mínimo 8 dígitos (letras e números)
    if(empty(trim($_POST["password"]))){
        $password_err = "Por favor, insira uma senha.";
    } elseif(strlen(trim($_POST["password"])) < 8){ // MÍNIMO DE DÍGITOS ALTERADO AQUI
        $password_err = "A senha deve ter no mínimo 8 caracteres.";
    } elseif(!preg_match('/[A-Za-z]/', trim($_POST["password"])) || !preg_match('/[0-9]/', trim($_POST["password"]))){ // VERIFICA LETRAS E NÚMEROS
        $password_err = "A senha deve conter letras e números.";
    } else{
        $password = trim($_POST["password"]);
    }

    // Valida a confirmação da senha
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Por favor, confirme a senha.";
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "As senhas não coincidem.";
        }
    }

    // Tentar registrar se não houver erros
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        if($userModel->register($username, $password)){
            header("location: login.php?registered=true");
            exit;
        } else {
            echo "Ops! Algo deu errado durante o registro. Por favor, tente novamente mais tarde.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - Seu Projeto</title>
    <link rel="stylesheet" href="seus-estilos.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .register-container {
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
    <div class="register-container">
        <h2>Criar Nova Conta</h2>
        <p>Preencha os campos abaixo para se cadastrar.</p>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label for="username">Nome de Usuário</label>
                <input type="text" id="username" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo htmlspecialchars($username); ?>">
                <small class="form-text text-muted">Apenas letras e números.</small>
                <span class="invalid-feedback"><?php echo $username_err; ?></span>
            </div>
            <div class="form-group">
                <label for="password">Senha</label>
                <input type="password" id="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo htmlspecialchars($password); ?>">
                <small class="form-text text-muted">Mínimo de 8 caracteres, deve conter letras e números.</small>
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirme a Senha</label>
                <input type="password" id="confirm_password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block">Registrar</button>
                <button type="reset" class="btn btn-secondary btn-block mt-2">Limpar</button>
            </div>
            <p class="text-center">Já tem uma conta? <a href="login.php">Faça login aqui</a>.</p>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>