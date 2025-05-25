<?php
$pdo = new PDO("mysql:host=localhost;dbname=rattrapages", "root", "");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['type']) && $_POST['type'] === 'nouvelle_commande') {
    $commande = $pdo->prepare("INSERT INTO commandes (nom, prenom, adresse, prix, statut) VALUES (?, ?, ?, ?, ?)");
    $commande->execute([$_POST['nom'],$_POST['prenom'],$_POST['adresse'],rand(5, 25),"En cours"
    ]);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['type']) && $_POST['type'] === 'update_statut') {
    $commande = $pdo->prepare("UPDATE commandes SET statut = ? WHERE id = ?");
    $commande->execute([$_POST['statut'], $_POST['id']]);
}

$commandes = $pdo->query("SELECT * FROM commandes ORDER BY date_creation DESC")->fetchAll();

function getCouleurStatut($statut) {
    return match($statut) {
        'Commande prise en compte' => '#d9edf7',
        'En cours' => '#fcf8e3',
        'Réalisée' => '#dff0d8',
        'Annulée' => '#f2dede',
        default => '#ffffff',
    };
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion des commandes</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="commande">
    <h2>Passer une commande</h2>
    <form method="POST">
        <input type="hidden" name="type" value="nouvelle_commande">
        <input type="text" name="nom" placeholder="Nom" required>
        <input type="text" name="prenom" placeholder="Prénom" required>
        <textarea name="adresse" placeholder="Adresse" required></textarea>
        <button type="submit">Envoyer</button>
    </form>
</div>
<section>
    <h2>Liste des commandes</h2>
    <table>
        <tr>
            <th>Nom</th><th>Adresse</th><th>Prix</th><th>Statut</th><th>Action</th>
        </tr>
        <?php foreach ($commandes as $cmd): ?>
            <tr style="background-color: <?= getCouleurStatut($cmd['statut']) ?>;">
                <td><?= $cmd['nom'] . ' ' . htmlspecialchars($cmd['prenom']) ?></td>
                <td><?= $cmd['adresse'] ?></td>
                <td><?= number_format($cmd['prix'], 2) ?> €</td>
                <td><?= $cmd['statut'] ?></td>
                <td>
                    <form method="POST">
                        <input type="hidden" name="type" value="update_statut">
                        <input type="hidden" name="id" value="<?= $cmd['id'] ?>">
                        <select name="statut">
                            <option value="En cours">En cours</option>
                            <option value="Réalisée">Réalisée</option>
                            <option value="Annulée">Annulée</option>
                        </select>
                        <button type="submit">Mettre à jour</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</section>
</body>
</html>
