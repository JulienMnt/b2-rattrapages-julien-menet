<?php
$pdo = new PDO("mysql:host=localhost;dbname=rattrapages", "root", "");
$commande = $pdo->prepare("UPDATE commandes SET statut = ? WHERE id = ?");
$commande->execute([$_POST['statut'], $_POST['id']]);
header("Location: commandes.php");
