<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mon E-commerce</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background-color: #f4f4f4;
        }

        /* HEADER */
        header {
            background-color: #2c3e50;
            color: white;
            padding: 15px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        header h1 {
            font-size: 24px;
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

        /* HERO */
        .hero {
            text-align: center;
            padding: 80px 20px;
            background: linear-gradient(to right, #1abc9c, #16a085);
            color: white;
            height: 50vh;
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

        /* PRODUITS */
        .produits {
            padding: 40px;
            background-color: #16a085;
            padding: 20px;
            margin-left: 30px;
            margin-right: 30px;
            border-radius: 10px;
            margin-top: 30px;
        }

        .produits h2 {
            text-align: center;
            margin-bottom: 30px;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }

        .card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            text-align: center;
        }

        .card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .card h3 {
            margin: 10px 0;
        }

        .card p {
            color: #555;
        }

         /* FOOTER */
.footer {
    background: #1f2d3d;
    color: white;
    padding: 20px 5px 10px;
    width: 100%;
    flex-direction: column;
    height: auto;
    
    bottom: 0;
}

.footer-container {
    display: flex;
    justify-content: space-around;
    gap: 20px;
    flex-wrap: wrap;
}

.footer-section {
    max-width: 250px;
    margin: 10px;
}

.footer h3 {
    margin-bottom: 15px;
    color: #28A745;
}

.footer p, .footer a {
    font-size: 14px;
    color: #ccc;
    text-decoration: none;
    display: block;
    margin-bottom: 8px;
}

.footer a:hover {
    color: white;
}

.footer-bottom {
    text-align: center;
    margin-top: 20px;
    border-top: 1px solid #444;
    padding-top: 10px;
    font-size: 13px;
}

/* RESPONSIVE */
@media (max-width: 768px) {
    .footer-container {
        flex-direction: column;
        align-items: center;
    }
}
.containers{
    background-color: #16a085;
    padding: 30px 20px;
    margin-left: 30px;
    margin-right: 30px;
    margin-top: 30px;
    height: 40vh;
    margin-bottom: 30px;
    border-radius: 10px;
}
.containers p{
    color: white;
    font-size: 16px;
    padding: 20px;
    text-align: center;
}
.titre{
    color: white;
    font-size: 16px;
    padding: 20px;
   display: flex;
    justify-content: center;
    align-items: center;
    
}

    </style>
</head>
<body>

    <!-- HEADER -->
    <header>
        <h1>TheraShop</h1>
        <nav>
            <a href="#">Accueil</a>
            <a href="list_pr.php">Produits</a>
            <a href="connexion.php">Connexion</a>
            <a href="inscription.php">Inscription</a>
        </nav>
    </header>

    <!-- SECTION BIENVENUE -->
    <section class="hero">
        <h2>Bienvenue sur TheraShop 🛒</h2>
        <p>Découvrez les meilleurs produits au meilleur prix</p>
    </section>
    <!-- PRODUITS -->
    <section class="produits">
        <h2>Produits disponibles</h2>

        <div class="grid">

            <div class="card">
                <img src="https://via.placeholder.com/300" alt="Produit 1">
                <h3>Produit 1</h3>
                <p>Prix : 10€</p>
            </div>

            <div class="card">
                <img src="https://via.placeholder.com/300" alt="Produit 2">
                <h3>Produit 2</h3>
                <p>Prix : 20€</p>
            </div>

            <div class="card">
                <img src="https://via.placeholder.com/300" alt="Produit 3">
                <h3>Produit 3</h3>
                <p>Prix : 30€</p>
            </div>

        </div>
    </section>
    <!--A propos-->
    <section>
     <div class="containers">
        <div class="titre">
             <h3>À propos</h3>
        </div>
           
            <p>
                TheraShop est une plateforme e-commerce conçue pour offrir une 
                expérience d'achat simple, rapide et sécurisée. Nous mettons 
                à votre disposition une large gamme de produits de qualité 
                adaptés à vos besoins quotidiens.
           
                Notre mission est de faciliter vos achats en ligne tout en 
                garantissant satisfaction et confiance.
      
                Nous proposons la vente de produits variés avec un système 
                de commande simple et efficace. Vous pouvez parcourir les 
                articles, ajouter vos choix au panier et finaliser votre 
                commande en quelques clics.
           
                Nous assurons également un suivi des commandes et une 
                assistance client en cas de besoin.
            </p>
          
        </div>
    </section>
    

    <!-- FOOTER -->
   <form>
    <div class="footer">
    <div class="container">

        <div class="footer-section">
            <h3>Contact</h3>
            <p>Email : contact@monshop.com</p>
            <p>Téléphone : +228 90 00 00 00</p>
            <p>Adresse : Lomé, Togo</p>
        </div>

    </div>

    <div class="footer-bottom">
        <p>© 2026 TheraShop - Tous droits réservés</p>
    </div>
</div>
   </form>
</body>
</html>