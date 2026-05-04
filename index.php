<?php

?>

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
    <title>Panier</title>
    <style>
        body { font-family: Arial; margin: 20px; }
        table { width: 70%; border-collapse: collapse; margin-top: 20px; align-items:center;position:relative}
        th, td { border: 1px solid #ccc; padding: 10px; text-align: center; }
        th { background: #f4f4f4; }
        .btn { padding: 5px 10px; cursor: pointer; }
        .add { background: green; color: white; }
        .del { background: red; color: white; }
        .update { background: green; color: white; }

        <style>
button {
    background: #007bff;
    color: white;
    border: none;
    padding: 12px 25px;
    font-size: 16px;
    font-weight: bold;
    border-radius: 8px;
    cursor: pointer;
    transition: 0.3s ease;
    box-shadow: 0 5px 15px rgba(0,0,0,0.15);
}

button:hover {
    background: #0056b3;
    transform: translateY(-2px);
}

button:active {
    transform: scale(0.97);
}

/* HERO */
.hero {
            text-align: center;
            padding: 80px 20px;
            background: linear-gradient(to right, #1abc9c, #16a085);
            color: white;
            height: 08vh;
            margin-left: 30px;
            margin-right: 30px;
            margin-top: 30px;
            border-radius: 10px;
        }

        .hero h2 {
            font-size: 40px;
            margin-bottom: 20px;
        }

        .hero p {
            font-size: 18px;
        }

        .big{
            margin:auto;
        }
        .a{
           
            text-align:center;
        }

        .center-box {
    display: flex;
    justify-content: center;
    align-items: center;
}

</style>
        
    </style>

    

                


</head>

<section class="hero">
        <h2>GEREZ VOS ACHATS COMME VOUS LE VOULEZ ICI !</h2>
        <p>Votre panier vous attend pour de nouvelles aventures</p>
    </section>


    

<body>


<!-- 🔥 FORMULAIRE AJOUT PRODUIT (simulation boutique) -->
<h3>Ajouter un produit</h3>
<form method="POST">
    ID: <input type="text" name="id" required>
    Nom: <input type="text" name="nom" required>
    Prix: <input type="number" name="prix" required>
    <button class="btn add" name="ajouter">Ajouter</button>
</form>


<h1 class="a">🛒 Mon Panier</h1>

<table class="big">
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
?><tr><td colspan='5'>Votre panier est vide,cliquez <a href="produits.php">ici</a> pour continuer vos achats</td></tr>";
<?php
}
?>

</table>

<h3 class="a">Total Général : <?= $totalGeneral ?> FCFA</h3>

<!-- ✔️ VALIDATION -->
<form  class="a" action="recu.php" method="post">
    <p>
<a href="reçu.php"><button type="submit" class="btn-valider">Finaliser ma commande</button></a>
    </p>

        
</form>

<?php
if (isset($message)) {
    echo "<div class='center-box'><h3 style='color:green;'>$message</h3></div>";
}
?>
<style>
a {
    color: #28a745;
    font-weight: bold;
    text-decoration: none;
}

a:hover {
    text-decoration: underline;
}

table {
    width: 60%;
    border-collapse: collapse;
}

th {
    background-color: #28a745;
    color: white;
    padding: 10px;
}

td {
    border: 1px solid #ddd;
    padding: 10px;
    text-align: center;
}

/* Couleur des lignes */
tr:nth-child(even) {
    background-color: #f2f2f2;
}

tr:nth-child(odd) {
    background-color: #ffffff;
}

/* Effet au survol */
tr:hover {
    background-color: #d1e7dd;
}
</style>




            

</body>
</html>