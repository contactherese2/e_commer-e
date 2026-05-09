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
    width: 300px;
}

.card:hover {
    transform: translateY(-8px);
}

.card img {
    width: 100%;
    height: 150px;
    object-fit: cover;
    border-top-left-radius: 8px;
    border-top-right-radius: 8px;
}

.card-content {
    padding: 12px;
}
.container {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    justify-content: center;
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
.filters {
    display: flex;
    flex-wrap: wrap;
    justify-content: center; /* centre les boutons */
    gap: 10px; /* espace entre les boutons */
    margin: 20px 0;
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
    margin-top: 200px;
    font-size: 14px;
    min-height: 60px;

}
.btn{
    text-align: center;
}
</style>

</head>
<body>

<!-- HEADER -->
<header>
    <h2>TheraShop</h2>
    <nav>
        <a href="acceuil.php">Accueil</a>
        <a href="panier2.php">Panier</a>
        <a href="connexion.php">Connexion</a>
        <a href="inscription.php">Inscription</a>
    </nav>
</header>

<h1>Nos Produits 🛒</h1>

<!-- LISTE PRODUITS -->
  <!-- FILTRES -->
 <div class="filters">
    <button type="button" class="filter-btn active" onclick="filterProducts('all', this)">tous</button>
     <?php
   include("con_db.php");
    try {
        $stmt = $conn->prepare("SELECT * FROM categories");
        $stmt->execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $category = htmlspecialchars($row['nom_cat'], ENT_QUOTES, 'UTF-8');
            echo '<button type="button" class="filter-btn" onclick="filterProducts(\'' . $category . '\', this)">' . $category . '</button>';
        }
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
    ?>
</div>

<PRODUITS -->
 <div class="container">
 <?php
    require_once ("con_db.php");
     $sql = "SELECT * FROM produits,categories WHERE produits.id_cat = categories.id_cat ";
     $stmt = $conn->prepare($sql);
     $stmt->execute();
    
        while ($produit = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo '<div class="card" data-category="' . htmlspecialchars($produit['nom_p'], ENT_QUOTES, 'UTF-8') . '">';
            echo '<img src="image/' . htmlspecialchars($produit['image'], ENT_QUOTES, 'UTF-8') . '">';
            echo '<div class="card-content">';
            echo '<h4>' . htmlspecialchars($produit['nom_p'], ENT_QUOTES, 'UTF-8') . '</h4>';
    
            echo '<div class="price">' . htmlspecialchars($produit['prix_p'], ENT_QUOTES, 'UTF-8') . '</div>';
            echo '<div class="stock ' . ($produit['stock_p'] > 0 ? 'ok' : 'out') . '">Stock : ' . htmlspecialchars($produit['stock_p'], ENT_QUOTES, 'UTF-8') . '</div>';
            echo '<p>' . htmlspecialchars($produit['description_p'], ENT_QUOTES, 'UTF-8') . '</p>';?>
        
            <a href="./panier.php?ajouter=<?=$produit['id_p']?>" class="btn">Ajouter au panier</a>
            <?php
            echo '</div>';
            echo '</div>';
        }
        
    ?>
 </div>

<!-- FOOTER -->
<footer>
    <p>© 2026 MonShop - Tous droits réservés</p>
</footer>

</body>
</html>