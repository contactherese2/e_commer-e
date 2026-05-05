<?php
include("con_db.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST["nom"];
    $description = $_POST["description"];
    $price = $_POST["price"];
    $stock = $_POST["stock"];
    $image = $_FILES["image"]["name"];
    $chemin = "image/"; 
    $target = $chemin . $image;
    $categorie = $_POST["cat"];

    $stmt = $conn->prepare("INSERT INTO produits (nom_p, description_p, prix_p, stock_p, image, id_cat) VALUES (:nom, :description, :price, :stock, :image, :id_cat)");
    $stmt->bindParam(':nom', $nom); 
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':price', $price);
    $stmt->bindParam(':stock', $stock);
    $stmt->bindParam(':image', $image);
    $stmt->bindParam(':id_cat', $categorie);
    $stmt->execute();
    
     if(move_uploaded_file($_FILES["image"]["tmp_name"], $target)) {
        header("Location: dashboard.php");
     }

}
   

    ?>
