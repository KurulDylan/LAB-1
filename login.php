<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Vérification simple (idéalement, utiliser une base de données)
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Définit les identifiants
    if ($username === 'admin' && $password === 'password123') { // Identifiants corrects
        $_SESSION['logged_in'] = true;
        header("Location: admin-panel.php");
        exit;
    } else {
        $error = "Identifiants incorrects";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
</head>
<body>
    <h1>Connexion</h1>
    <form method="POST" action="login.php">
        <label for="username">Nom d'utilisateur :</label>
        <input type="text" id="username" name="username" required>
        <br>
        <label for="password">Mot de passe :</label>
        <input type="password" id="password" name="password" required>
        <br>
        <input type="submit" value="Se connecter">
    </form>
    <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
</body>
</html>
