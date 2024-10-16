<?php
session_start();
session_destroy(); // Détruit la session actuelle
header("Location: login.php"); // Redirige vers la page de connexion
exit;
?>
