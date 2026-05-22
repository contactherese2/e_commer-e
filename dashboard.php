<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Dashboard Admin</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: Arial, sans-serif;
}

body {
    display: flex;
    background: #f4f4f4;
}

/* SIDEBAR */
.sidebar {
    width: 220px;
    height: 100vh;
    background: #2c3e50;
    color: white;
    padding: 20px;
}

.sidebar h2 {
    margin-bottom: 30px;
}

.sidebar a {
    display: block;
    color: white;
    margin: 15px 0;
    text-decoration: none;
}

.sidebar a:hover {
    color: #1abc9c;
}

/* CONTENU */
.main {
    flex: 1;
    padding: 20px;
}

/* BOUTON */
.add {
    background: #1abc9c;
    color: white;
    padding: 10px;
    border: none;
    cursor: pointer;
    margin-bottom: 15px;
    border-radius: 5px;
}

/* FORMULAIRE */
.form-container {
    display: none;
    background: white;
    padding: 20px;
    margin-bottom: 20px;
    border-radius: 10px;
}

.form-container input,
.form-container textarea {
    width: 100%;
    padding: 10px;
    margin: 10px 0;
    border: 1px solid #ccc;
    border-radius: 5px;
}

.form-container button {
    background: #1abc9c;
    color: white;
    padding: 10px;
    border: none;
    cursor: pointer;
}

/* TABLE */
table {
    width: 100%;
    border-collapse: collapse;
    background: white;
}

table th, table td {
    padding: 10px;
    border: 1px solid #ddd;
    text-align: center;
}

table th {
    background: #1abc9c;
    color: white;
}

/* ACTIONS */
.edit {
    background: #3498db;
    color: white;
}

.delete {
    background: red;
    color: white;
}
.p {
    background: #1abc9c;
    color: white;
    padding: 10px;
    border: none;
    cursor: pointer;
    margin-bottom: 15px;
    border-radius: 5px;
}
</style>

</head>
<body>

<!-- SIDEBAR -->
<div class="sidebar">
    <h2>Admin</h2>
    <a href="#">Dashboard</a>
    <a href="list_pr.php">Produits</a>
    <a href="#">Commandes</a>
</div>

<!-- CONTENU -->
<div class="main">

    <h1>Gestion des Produits</h1>

    <!-- BOUTON -->
    <button class="add" onclick="toggleForm()">+ Ajouter produit</button>

    <!-- FORMULAIRE -->
    <div class="form-container" id="formProduit">
        <h3>Ajouter un produit</h3>

        <form action="trai_pr.php" method="POST" enctype="multipart/form-data">
            <input type="text" name="nom" required>
            <textarea name="description" placeholder="Description"></textarea>
            <input name="price" type="number" placeholder="Prix" required>
            <input name="stock" type="number" placeholder="Stock" required>
            <input name="color" type="text" placeholder="Couleur">
            <input type="file" name="image">
            <?php
                require_once "con_db.php";
                $sql = "SELECT * FROM categories";
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                $categories= $stmt->fetchAll(PDO::FETCH_ASSOC);
            ?>
            <select name="cat">
                <option disabled selected>Choisir une spécialité</option>

                <?php foreach ($categories as $categorie): ?>
                    <option value="<?= $categorie['id_cat'] ?>">
                        <?= $categorie['nom_cat'] ?>
                    </option>
                <?php endforeach; ?>

            </select></br>
            <button type="submit">Enregistrer</button>
            <button type="submit">Modifier</button>
        </form>
    </div>

    <!-- TABLE PRODUITS -->
    

    <table>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Prix</th>
            <th>Stock</th>
            <th>Description</th>
            <th>Catégorie</th>
            <th>Actions</th>
        </tr>
         <?php
        require_once 'con_db.php';

        $sql = "SELECT * FROM produits,categories WHERE produits.id_cat=categories.id_cat";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $produits = $stmt->fetchAll(PDO::FETCH_ASSOC);
        

    ?>    <?php foreach ($produits as $produit): ?>
        <tr>
            <td><?php echo $produit['id_p']; ?></td>
            <td><?php echo $produit['nom_p']; ?></td>
            <td><?php echo $produit['prix_p']; ?> F CFA</td>
            <td><?php echo $produit['stock_p']; ?></td>
            <td><?php echo $produit['description_p']; ?></td>
            <td><?php echo $produit['nom_cat']; ?></td>
            <td>
                <p class="edit"><a href="trai_modif.php?id=<?= $produit['id_p'] ?>">Modifier</a></p>
                <p class="delete"><a href="trai_sup.php?id=<?= $produit['id_p'] ?>">Supprimer</a></p>
            </td>
        </tr>
    <?php endforeach; ?>

    </table>

</div>

<!-- SCRIPT -->
<script>
function toggleForm() {
    let form = document.getElementById("formProduit");
    form.style.display = (form.style.display === "block") ? "none" : "block";
}
</script>

</body>
</html>