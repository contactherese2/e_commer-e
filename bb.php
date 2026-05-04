<?php
session_start();

// Initialisation du panier si inexistant
if (!isset($_SESSION['panier'])) {
    $_SESSION['panier'] = [];
}

// ➕ AJOUT PRODUIT (simulation)
if (isset($_POST['ajouter'])) {
    $id = $_POST['id'];
    $nom = $_POST['nom'];
    $prix = $_POST['prix'];

    if (isset($_SESSION['panier'][$id])) {
        $_SESSION['panier'][$id]['quantite']++;
    } else {
        $_SESSION['panier'][$id] = [
            "nom" => $nom,
            "prix" => $prix,
            "quantite" => 1
        ];
    }
}

// ✏️ MODIFIER QUANTITÉ
if (isset($_POST['modifier'])) {
    $id = $_POST['id'];
    $quantite = $_POST['quantite'];

    if ($quantite > 0) {
        $_SESSION['panier'][$id]['quantite'] = $quantite;
    } else {
        unset($_SESSION['panier'][$id]);
    }
}

// ❌ SUPPRIMER PRODUIT
if (isset($_GET['supprimer'])) {
    $id = $_GET['supprimer'];
    unset($_SESSION['panier'][$id]);
}

// ✔️ VALIDER PANIER
if (isset($_POST['valider'])) {
    $total = 0;

    foreach ($_SESSION['panier'] as $p) {
        $total += $p['prix'] * $p['quantite'];
    }

    $_SESSION['panier'] = []; // vider panier

    $message = "Commande validée ! Total : " . $total . " FCFA";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Panier E-commerce</title>
    <style>
        body { font-family: Arial; margin: 20px; }
        table { width: 70%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 10px; text-align: center; }
        th { background: #f4f4f4; }
        .btn { padding: 5px 10px; cursor: pointer; }
        .add { background: green; color: white; }
        .del { background: red; color: white; }
        .update { background: blue; color: white; }
    </style>
</head>

<body>

<h2>🛒 Mon Panier E-commerce</h2>

<!-- 🔥 FORMULAIRE AJOUT PRODUIT (simulation boutique) -->
<h3>Ajouter un produit</h3>
<form method="POST">
    ID: <input type="text" name="id" required>
    Nom: <input type="text" name="nom" required>
    Prix: <input type="number" name="prix" required>
    <button class="btn add" name="ajouter">Ajouter</button>
</form>

<!-- 🧾 AFFICHAGE PANIER -->
<h3>Contenu du panier</h3>

<table>
    <tr>
        <th>Produit</th>
        <th>Prix</th>
        <th>Quantité</th>
        <th>Total</th>
        <th>Action</th>
    </tr>

<?php
$totalGeneral = 0;

if (!empty($_SESSION['panier'])) {
    foreach ($_SESSION['panier'] as $id => $p) {
        $total = $p['prix'] * $p['quantite'];
        $totalGeneral += $total;
?>

    <tr>
        <td><?= $p['nom'] ?></td>
        <td><?= $p['prix'] ?> FCFA</td>

        <!-- ✏️ Modifier quantité -->
        <td>
            <form method="POST">
                <input type="hidden" name="id" value="<?= $id ?>">
                <input type="number" name="quantite" value="<?= $p['quantite'] ?>" min="0">
                <button class="btn update" name="modifier">OK</button>
            </form>
        </td>

        <td><?= $total ?> FCFA</td>

        <!-- ❌ Supprimer -->
        <td>
            <a class="btn del" href="?supprimer=<?= $id ?>">X</a>
        </td>
    </tr>

<?php
    }
} else {
    echo "<tr><td colspan='5'>Panier vide</td></tr>";
}
?>

</table>

<h3>💰 Total Général : <?= $totalGeneral ?> FCFA</h3>

<!-- ✔️ VALIDATION -->
<form method="POST">
    <button class="btn add" name="valider">Valider le panier</button>
</form>

<?php
if (isset($message)) {
    echo "<h3 style='color:green;'>$message</h3>";
}
?>

</body>
</html>