<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Inscription</title>
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

/* FORMULAIRE */
.container {
    width: 100%;
    max-width: 400px;
    background: white;
    margin: 50px auto;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    margin-bottom: 200px;
}

.container h2 {
    text-align: center;
    margin-bottom: 20px;
}

input {
    width: 100%;
    padding: 10px;
    margin: 10px 0;
    border: 1px solid #ccc;
    border-radius: 5px;
}

.btn {
    width: 100%;
    padding: 10px;
    background: #1abc9c;
    border: none;
    color: white;
    font-size: 16px;
    cursor: pointer;
    border-radius: 5px;
}

.btn:hover {
    background: #16a085;
}

.login-link {
    text-align: center;
    margin-top: 15px;
}

.login-link a {
    text-decoration: none;
    color: #1abc9c;
}

/* FOOTER */
 footer {
            background-color: #2c3e50;
            color: white;
            padding: 30px;
            margin-top: 40px;
            text-align: center;
        }

        footer h3 {
            margin-bottom: 10px;
        }
        footer p {
            font-size: 14px;
        }
</style>

</head>
<body>

<!-- HEADER -->
<header>
    <h2>MonShop</h2>
    <nav>
        <a href="index.html">Accueil</a>
        <a href="produit.php">Produits</a>
        <a href="connexion.php">Connexion</a>
    </nav>
</header>

<!-- FORMULAIRE INSCRIPTION -->
<div class="container">
    <h2>Inscription</h2>

    <form action="trai_in.php" method="post">
        <input name="nom" type="text" placeholder="Nom complet" required>
        <input name="email" type="email" placeholder="Email" required>
        <input name="password" type="password" placeholder="Mot de passe" required>

       <input type="submit" value="S'inscrire" class="btn">
    </form>

    <div class="login-link">
        <p>Déjà un compte ? <a href="connexion.php">Se connecter</a></p>
    </div>
</div>

<!-- FOOTER -->
<footer>
    <p>© 2026 MonShop - Tous droits réservés</p>
</footer>

</body>
</html>