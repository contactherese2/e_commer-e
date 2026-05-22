<?php
include("con_db.php");

/* SUPPRIMER */
if(isset($_GET['supprimer'])){
    $id = $_GET['supprimer'];
    $conn->query("DELETE FROM panier WHERE id_pa=$id");
}

/* MODIFIER QUANTITE */
if(isset($_POST['modifier'])){
    foreach($_POST['qte'] as $id => $qte){
        $conn->query("UPDATE panier SET quantite_pa=$qte WHERE id_pa=$id");
    }
}

/* VALIDER COMMANDE */
if(isset($_POST['valider'])){
    $adresse = $_POST['adresse'];

    $result = $conn->query("SELECT * FROM panier JOIN produits ON panier.id_p = produits.id_p");

    while($row = $result->fetchAll()){
        $nouveauStock = $row['stock_p'] - $row['quantite_pa'];
        $conn->query("UPDATE produits SET stock_p=$nouveauStock WHERE id_p=".$row['id_p']);
    }

    $conn->query("DELETE FROM panier");

    echo "<script>alert('Commande confirmée ! Livraison à : $adresse');</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Panier</title>
<style>
body{font-family:Arial;background:#f5f5f5}
.container{width:80%;margin:auto;background:white;padding:20px;border-radius:10px}
table{width:100%;border-collapse:collapse}
td,th{padding:10px;text-align:center;border-bottom:1px solid #ddd}
input{width:60px}
button{padding:8px 15px;margin:5px}
</style>
</head>
<body>

<div class="container">
<h2>🛒 Mon panier</h2>

<form method="POST">

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

$sql = "SELECT panier.id_pa, produits.nom_p, produits.prix_p, panier.quantite_pa 
        FROM panier 
        JOIN produits ON panier.id_p = produits.id_p";

$result = $conn->query($sql);

while($row = $result->fetchAll()):
    $total = $row['prix_p'] * $row['quantite_pa'];
    $totalGeneral += $total;
?>

<tr>
<td><?= $row['nom_p'] ?></td>
<td><?= $row['prix_p'] ?> FCFA</td>

<td>
<input type="number" name="qte[<?= $row['id_pa'] ?>]" value="<?= $row['quantite_pa'] ?>">
</td>

<td><?= $total ?> FCFA</td>

<td>
<a href="?supprimer=<?= $row['id_pa'] ?>">
<button type="button">Supprimer</button>
</a>
</td>
</tr>

<?php endwhile; ?>

</table>

<h3>Total : <?= $totalGeneral ?> FCFA</h3>

<button name="modifier">Mettre à jour</button>

<br><br>

<h3>Adresse de livraison</h3>
<input type="text" name="adresse" required style="width:100%;padding:10px">

<br><br>

<button name="valider">Valider la commande</button>

</form>
</div>

</body>
</html>