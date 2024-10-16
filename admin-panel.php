<?php
// Démarrer une session pour garder l'utilisateur connecté
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    // Rediriger vers la page de connexion
    header("Location: login.php");
    exit;
}

// Inclure le fichier des utilisateurs
include 'users.php';

// Supprimer un utilisateur si demandé
if (isset($_GET['delete'])) {
    $userToDelete = $_GET['delete'];

    if (isset($users[$userToDelete])) {  // Si l'utilisateur existe
        unset($users[$userToDelete]);
        file_put_contents('users.php', '<?php $users = ' . var_export($users, true) . ';');
        echo "<p>L'utilisateur $userToDelete a été supprimé.</p>";
    } else {
        echo "<p>L'utilisateur $userToDelete n'existe pas.</p>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panneau d'administration</title>
</head>
<body>
    <h1>Panneau d'administration protégé</h1>
    <p>Liste des utilisateurs :</p>
    <ul>
        <?php foreach ($users as $username => $email): ?>
            <li>
                <?php echo $username . ' (' . $email . ')'; ?>
                <a href="?delete=<?php echo $username; ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?');">Supprimer</a>
            </li>
        <?php endforeach; ?>
    </ul>
    <p><a href="logout.php">Se déconnecter</a></p>
</body>
</html>
