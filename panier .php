<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Panier</title>
<style>
body{
    margin:0;
    font-family: Arial;
    background:#f5f5f5;
}

header{
    background:#222;
    color:white;
    padding:15px;
    text-align:center;
}

.container{
    width:80%;
    margin:30px auto;
    background:white;
    padding:20px;
    border-radius:10px;
}

table{
    width:100%;
    border-collapse:collapse;
}

th, td{
    padding:15px;
    text-align:center;
    border-bottom:1px solid #ddd;
}

input[type="number"]{
    width:60px;
    padding:5px;
}

.total{
    text-align:right;
    font-size:20px;
    margin-top:20px;
    font-weight:bold;
}

button{
    padding:8px 15px;
    border:none;
    border-radius:5px;
    cursor:pointer;
}

.btn-valider{
    background:#28a745;
    color:white;
    margin-top:15px;
}

.btn-supprimer{
    background:red;
    color:white;
}

#formAdresse{
    display:none;
    margin-top:20px;
    background:#eee;
    padding:15px;
    border-radius:10px;
}

footer{
    background:#222;
    color:white;
    text-align:center;
    padding:15px;
    margin-top:30px;
}
</style>
</head>
<body>

<header>
    <h2>🛒 Mon Panier</h2>
</header>

<div class="container">

    <table>
        <thead>
            <tr>
                <th>Produit</th>
                <th>Prix</th>
                <th>Quantité</th>
                <th>Total</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody id="panier">
            <tr>
                <td>Produit A</td>
                <td class="prix">500</td>
                <td>
                    <input type="number" value="1" min="1" onchange="calculer()">
                </td>
                <td class="totalProduit">500</td>
                <td>
                    <button class="btn-supprimer" onclick="supprimer(this)">Supprimer</button>
                </td>
            </tr>

            <tr>
                <td>Produit B</td>
                <td class="prix">300</td>
                <td>
                    <input type="number" value="1" min="1" onchange="calculer()">
                </td>
                <td class="totalProduit">300</td>
                <td>
                    <button class="btn-supprimer" onclick="supprimer(this)">Supprimer</button>
                </td>
            </tr>
        </tbody>
    </table>

    <div class="total">
        Total général : <span id="totalGeneral">800</span> FCFA
    </div>

    <button class="btn-valider" onclick="validerCommande()">Valider la commande</button>

    <div id="formAdresse">
        <h3>Entrer votre adresse</h3>
        <input type="text" id="adresse" placeholder="Votre adresse" style="width:100%; padding:10px;">
        <br><br>
        <button class="btn-valider" onclick="confirmer()">Confirmer</button>
    </div>

</div>

<footer>
    <p>© 2026 Mon Site - Tous droits réservés</p>
</footer>

<script>
function calculer(){
    let lignes = document.querySelectorAll("#panier tr");
    let totalGeneral = 0;

    lignes.forEach(ligne => {
        let prix = parseInt(ligne.querySelector(".prix").textContent);
        let qte = ligne.querySelector("input").value;
        let total = prix * qte;

        ligne.querySelector(".totalProduit").textContent = total;
        totalGeneral += total;
    });

    document.getElementById("totalGeneral").textContent = totalGeneral;
}

function supprimer(btn){
    if(confirm("Voulez-vous supprimer ce produit ?")){
        let ligne = btn.parentElement.parentElement;
        ligne.remove();
        calculer();
    }
}

function validerCommande(){
    document.getElementById("formAdresse").style.display = "block";
}

function confirmer(){
    let adresse = document.getElementById("adresse").value;

    if(adresse === ""){
        alert("Veuillez entrer votre adresse !");
    }else{
        alert("Commande confirmée ! Livraison à : " + adresse);
    }
}
</script>

</body>
</html>