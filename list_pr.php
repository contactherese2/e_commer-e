<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Produits</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: Arial, sans-serif;
}

body {
    background: #f4f4f4;
}

/* HEADER */
header {
    background: #2c3e50;
    color: white;
    padding: 15px 40px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

nav a {
    color: white;
    margin-left: 20px;
    text-decoration: none;
    font-weight: bold;
}

nav a:hover {
    color: #1abc9c;
}

/* TITRE */
h1 {
    text-align: center;
    margin: 30px 0;
}

/* GRID PRODUITS */
/* CARD */
.card {
    background: white;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 8px 20px rgba(0,0,0,0.1);
    transition: 0.3s;
}

.card:hover {
    transform: translateY(-8px);
}

.card img {
    width: 100%;
    height: 150px;
    object-fit: cover;
}

.card-content {
    padding: 12px;
}


.prix {
    font-weight: bold;
    margin: 10px 0;
}

.stock {
    color: green;
}

.rupture {
    color: red;
}

/* BOUTON */
button {
    margin-top: 10px;
    padding: 10px 15px;
    border: none;
    background: #1abc9c;
    color: white;
    cursor: pointer;
    border-radius: 5px;
}

button:hover {
    background: #16a085;
}

/* FOOTER */
footer {
    background: #2c3e50;
    color: white;
    text-align: center;
    padding: 15px 20px;
    margin-top: 30px;
    font-size: 14px;
    min-height: 60px;
}
</style>

</head>
<body>

<!-- HEADER -->
<header>
    <h2>TheraShop</h2>
    <nav>
        <a href="acceuil.php">Accueil</a>
        <a href="panier.php">Panier</a>
        <a href="connexion.html">Connexion</a>
        <a href="inscription.html">Inscription</a>
    </nav>
</header>

<h1>Nos Produits 🛒</h1>

<!-- LISTE PRODUITS -->
  <?php
        require_once 'con_db.php';

        $sql = "SELECT * FROM produits";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $produit = $stmt->fetchAll(PDO::FETCH_ASSOC);
        

    ?>  
      
<div class="card">
<?php foreach ($produit as $produits): ?>
    <div class="card-content">
        <img src="image/<?=  $produits['image']?>">
        <h3><?=  $produits['nom_p']  ?></h3>
        <p><?=  $produits['description_p']  ?></p>
        <p class="prix"><?=  $produits['prix_p']  ?></p>
        <p class="stock"><?=  $produits['stock_p']  ?></p>
        <a href="trai_panier2.php?id=<?=  $produits['id_p']  ?>" class="a">Ajouter au panier</a>
    </div>
    <?php endforeach; ?>
</div>
 

<!-- FOOTER -->
<footer>
    <p>© 2026 MonShop - Tous droits réservés</p>
</footer>

</body>
</html>