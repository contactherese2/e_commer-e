<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Connexion</title>
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
    width: 750px;
    max-width: 400px;
    background: white;
    margin: 60px auto;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    margin-bottom: 250px;
    height: 300px;

}

.container h2 {
    text-align: center;
}

input {
    width: 100%;
    padding: 10px;
    margin: 10px 0;
    border: 1px solid #ccc;
    border-radius: 5px;
}

button {
    width: 100%;
    padding: 10px;
    background: #1abc9c;
    border: none;
    color: white;
    font-size: 16px;
    cursor: pointer;
    border-radius: 5px;
}

button:hover {
    background: #16a085;
}

.register-link {
    text-align: center;
    margin-top: 15px;
}

.register-link a {
    text-decoration: none;
    color: #1abc9c;
}

/* FOOTER */
footer {
    background: #2c3e50;
    color: white;
    text-align: center;
    padding: 20px;
    margin-top: 30px;
}
</style>

</head>
<body>

<!-- HEADER -->
<header>
    <h2>MonShop</h2>
    <nav>
        <a href="acceuil.php">Accueil</a>
        <a href="list_pr.php">Produits</a>
        <a href="connexion.php">Connexion</a>
        <a href="inscription.php">Inscription</a>
    </nav>
</header>

<!-- FORMULAIRE CONNEXION -->
<div class="container">
    <h2>Connexion</h2>

    <form action="trai_con.php"method="POST">
        <?php
        if (isset($_GET["error"])) {    
            echo "<p style='color:red; text-align:center;'>Email ou mot de passe incorrect.</p>";
        }
        ?>
        <input name="email"type="email" placeholder="Email" required>
        <input name="password" type="password" placeholder="Mot de passe" required>

        <button type="submit">Se connecter</button>
    </form>

    <div class="register-link">
        <p>Pas de compte ? <a href="inscription.php">S'inscrire</a></p>
    </div>
</div>

<!-- FOOTER -->
<footer>
    <p>© 2026 MonShop - Tous droits réservés</p>
</footer>

</body>
</html>