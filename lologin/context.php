<?php
// home.php (era sua home.html ou qualquer outra página protegida)
session_start();

// Verifica se o usuário não está logado, se não, redireciona para a página de login
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php"); // Redireciona para sua página de login
    exit;
}

// Opcional: Você pode acessar informações do usuário logado aqui, por exemplo:
$current_username = $_SESSION["username"];
// $current_user_id = $_SESSION["id"];

// O restante do seu código HTML/PHP da página vai aqui
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Inicial Protegida - Seu Projeto</title>
    <link rel="stylesheet" href="seus-estilos.css">
</head>
<body>
    <header>
        <h1>Bem-vindo ao Seu Projeto!</h1>
        <nav>
            <ul>
                <li>Olá, <?php echo htmlspecialchars($current_username); ?>!</li>
                <li><a href="logout.php">Sair</a></li>
                </ul>
        </nav>
    </header>

    <main>
        <p>Este é o conteúdo da sua página inicial protegida.</p>
        <p>Apenas usuários logados podem ver isso.</p>
        </main>

    <footer>
        <p>&copy; 2025 Seu Projeto</p>
    </footer>

    </body>
</html>