<?php
include("con_db.php");
include 'PHPMailer/PHPMailerAutoload.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST["nom"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $client ="client";

    // Insertion des données dans la base de données
    $stmt = $conn->prepare("INSERT INTO user ( email_u, password_u, role ,nom_u) VALUES ( :email, :password, :client,:nom)");
    $stmt->bindParam(':nom', $nom);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':client', $client);

    if ($stmt->execute()) {
      session_start();
      $_SESSION["id_user"] = $conn->lastInsertId();
        // Redirection vers la page de connexion (à connecter plus tard)
         header("Location: acceuil.php");
        





//$mail->SMTPDebug = 3;                               // Enable verbose debug output

$mail = new PHPMailer;
$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'contact.therese@gmail.com';                 // SMTP username
$mail->Password = ' jecv rwvw mpgr zvvl';                           // SMTP password
$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 465;                                    // TCP port to connect to

$mail->setFrom('contact.therese@gmail.com', 'TheraShop');
$mail->addAddress($email, $nom);     // Add a recipient


    // Optional name
$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'Bienvenue sur notre site!';
$mail->Body    = '
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <body>
        <h1>Bienvenue sur notre site!</h1>
        <p>Nous sommes ravis de vous compter parmi nos utilisateurs.</p>
        <p>Merci de vous être inscrit avec l\'adresse email : ' . htmlspecialchars($email) . '</p>
        <p>Nous espérons que vous apprécierez votre expérience sur notre site.</p>
    </body>
    </html>
';
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
     header("Location: acceuil.php");
}
       
    } else {
        echo "Erreur lors de l'inscription.";
    
}
exit;

}

?>