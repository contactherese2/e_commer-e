<?php

session_start();

$conn = new mysqli("localhost", "root", "", "commerce");

if($conn->connect_error){
    die("Erreur connexion");
}


/*
========================================
UTILISATEUR CONNECTÉ
========================================
*/

$id_u = $_SESSION['id_user'] ?? 1;


/*
========================================
AJOUTER AU PANIER
========================================
*/

if(isset($_GET['ajouter'])){

    $id_p = $_GET['ajouter'];

    $check = "
    SELECT *
    FROM panier
    WHERE id_u='$id_u'
    AND id_p='$id_p'
    ";

    $result = $conn->query($check);

    if($result->num_rows > 0){

        $data = $result->fetch_assoc();

        $qte = $data['quantite_pa'] + 1;

        $update = "
        UPDATE panier
        SET quantite_pa='$qte'
        WHERE id_pa='".$data['id_pa']."'
        ";

        $conn->query($update);

    }else{

        $insert = "
        INSERT INTO panier
        (quantite_pa,id_u,id_p)

        VALUES
        (1,'$id_u','$id_p')
        ";

        $conn->query($insert);
    }

    header("Location: panier.php");
}



/*
========================================
MODIFIER QUANTITÉ
========================================
*/

if(isset($_POST['modifier'])){

    $id_pa = $_POST['id_pa'];

    $quantite = $_POST['quantite'];

    if($quantite <= 0){

        $delete = "
        DELETE FROM panier
        WHERE id_pa='$id_pa'
        ";

        $conn->query($delete);

    }else{

        $update = "
        UPDATE panier
        SET quantite_pa='$quantite'
        WHERE id_pa='$id_pa'
        ";

        $conn->query($update);
    }

    header("Location: panier.php");
}



/*
========================================
SUPPRIMER PRODUIT
========================================
*/

if(isset($_GET['supprimer'])){

    $id_pa = $_GET['supprimer'];

    $delete = "
    DELETE FROM panier
    WHERE id_pa='$id_pa'
    ";

    $conn->query($delete);

    header("Location: panier.php");
}



/*
========================================
VALIDER COMMANDE
========================================
*/

$message = "";

if(isset($_POST['valider'])){

    $verif = "
    SELECT *
    FROM panier
    WHERE id_u='$id_u'
    ";

    $test = $conn->query($verif);

    if($test->num_rows > 0){

        $message = "✅ Commande validée avec succès";

        $vider = "
        DELETE FROM panier
        WHERE id_u='$id_u'
        ";

        $conn->query($vider);

    }else{

        $message = "❌ Votre panier est vide";
    }
}

?>


<!DOCTYPE html>
<html lang="fr">

<head>

<meta charset="UTF-8">

<title>Panier Ecommerce</title>

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{

    font-family:Arial;
    background:#f4f4f4;
    padding:30px;
}

h1{

    text-align:center;
    margin-bottom:40px;
    color:#333;
}

.container{

    width:95%;
    margin:auto;
}


/*
=====================================
PRODUITS
=====================================
*/

.produits{

    display:grid;

    grid-template-columns:
    repeat(auto-fit,minmax(250px,1fr));

    gap:20px;

    margin-bottom:50px;
}

.card{

    background:white;

    padding:20px;

    border-radius:10px;

    box-shadow:0 0 10px rgba(0,0,0,0.1);

    text-align:center;
}

.card h3{

    margin-bottom:10px;
}

.card p{

    margin-bottom:15px;
}

.btn{

    padding:10px 15px;

    border:none;

    border-radius:5px;

    cursor:pointer;

    color:white;

    text-decoration:none;

    font-size:14px;
}

.btn-ajouter{

    background:#007bff;
}

.btn-ajouter:hover{

    background:#0056b3;
}


/*
=====================================
TABLEAU PANIER
=====================================
*/

.table-panier{

    width:100%;

    border-collapse:collapse;

    background:white;

    box-shadow:0 0 10px rgba(5, 121, 46, 0.1);
}

.table-panier th{

    background:#19B419;

    color:white;

    padding:15px;
}

.table-panier td{

    padding:15px;

    text-align:center;

    border-bottom:1px solid #ddd;
}

.table-panier tr:hover{

    background:#f1f1f1;
}


/*
=====================================
BOUTONS
=====================================
*/

.btn-modifier{

    background:orange;
}

.btn-modifier:hover{

    background:darkorange;
}

.btn-supprimer{

    background:red;
}

.btn-supprimer:hover{

    background:darkred;
}

.btn-valider{

    background:green;

    margin-top:20px;

    padding:15px 30px;

    font-size:18px;

}

.btn-valider:hover{

    background:darkgreen;
}


/*
=====================================
TOTAL
=====================================
*/

.total{

    margin-top:20px;

    background:#4B814B;

    color:white;

    padding:20px;

    text-align:right;

    font-size:22px;

    border-radius:5px;
}


/*
=====================================
MESSAGE
=====================================
*/

.message{

    background:green;

    color:white;

    padding:15px;

    margin-bottom:20px;

    border-radius:5px;

    text-align:center;

    font-size:18px;
}

input[type=number]{

    width:70px;

    padding:5px;

    text-align:center;
}

</style>

</head>

<body>

<div class="container">

<h1>🛒 Mon Panier</h1>
<?php

if($message != ""){

    echo "<div class='message'>$message</div>";
}

?>

</div>



<br>

<table class="table-panier">

<tr>

    <th>Produit</th>

    <th>Prix</th>

    <th>Quantité</th>

    <th>Sous-total</th>

    <th>Modifier</th>


</tr>


<?php

$total = 0;

$sql = "

SELECT

    panier.id_pa,
    panier.quantite_pa,

    produits.nom_p,
    produits.prix_p

FROM panier

INNER JOIN produits
ON panier.id_p = produits.id_p

WHERE panier.id_u='$id_u'

";

$result = $conn->query($sql);


if($result->num_rows == 0){

    echo "

    <tr>

        <td colspan='6'>
            <tr><td colspan='6'><p>Votre panier est vide veillez choisir vos achats </p></tr></td>
        </td>

    </tr>

    ";
}


while($row = $result->fetch_assoc()){

$sous_total =
$row['prix_p']
*
$row['quantite_pa'];

$total += $sous_total;

?>

<tr>

    <td>

        <?php echo $row['nom_p']; ?>

    </td>

    <td>

        <?php echo $row['prix_p']; ?> €

    </td>

    <!-- MODIFIER -->

    <td>

        <form method="POST">

            <input
            type="hidden"
            name="id_pa"
            value="<?php echo $row['id_pa']; ?>">


            <input
            type="number"
            name="quantite"
            value="<?php echo $row['quantite_pa']; ?>">


            <button
            class="btn btn-modifier"
            type="submit"
            name="modifier">

               Ok

            </button>

        </form>

    </td>


    <td>

        <?php echo $sous_total; ?> CF CFA

    </td>


   

    <!-- SUPPRIMER -->

    <td>

        <a
        class="btn btn-supprimer"
        href="?supprimer=<?php echo $row['id_pa']; ?>">

            Supprimer

        </a>

    </td>

</tr>

<?php
}
?>

</table>


<!-- TOTAL -->

<div class="total">

    TOTAL :
    <?php echo $total; ?> F CFA

</div>


<!-- VALIDER -->

<form method="POST" action="Commande_Resume.php">

    <h3>Adresse de livraison</h3>
    <input type="text" name="adresse_cmd" required style="width:100%;padding:10px" placeholder="Adresse de livraison">
    <input type="hidden" name="total_cmd" value="<?php echo $total; ?>">

    <button
    class="btn btn-valider"
    type="submit"
    name="valider">

        ✅ Valider la commande

    </button>

<br><br><br>

 <a class="btn btn-valider" href="list_pr.php">

        Continuer les achats

</a>
</form>

</div>

</body>
</html>