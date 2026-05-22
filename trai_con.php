<?php
include("con_db.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Vérification des identifiants
    $stmt = $conn->prepare("SELECT * FROM users WHERE email_u = :email AND password_u = :password AND role_u = :client OR role_u = :admin");
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':client', 'client');
    $stmt->bindParam(':admin', 'admin');
    $stmt->execute();

    

    if ($stmt->rowCount() > 0) {
        session_start();
        $_SESSION["id_user"] = $stmt->fetch(PDO::FETCH_ASSOC)["id_u"];
        // Redirection vers l'espace patient (à connecter plus tard)
        header("Location: acceuil.php");
    } else if ($stmtAdmin->rowCount() > 0) {
        header("Location: dashboard.php");
    } else {

        // Connexion échouée
      header("Location: connexion.php?error=1");
    }
}


?>