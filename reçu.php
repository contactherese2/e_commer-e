<?php
session_start();
$panier = $_SESSION['panier'];
$total = 0;

session_start();
$panier = $_SESSION['panier'];



?>
<!DOCTYPE html>
<html>
<head>
  <title>Reçu de commande</title>
  <style>
    body { font-family: Arial, sans-serif; }
    .recu { border: 1px solid #ccc; padding: 20px; width: 400px; margin: auto; }
    h2 { text-align: center; }
    table { width: 100%; border-collapse: collapse; }
    td, th { border: 1px solid #ddd; padding: 8px; }
    .total { font-weight: bold; text-align: right; }
  </style>
</head>
<body>
  <div class="recu">
    <h2>Reçu de commande</h2>
    <table>
      <tr><th>Produit</th><th>Prix</th><th>Quantité</th><th>Total</th></tr>
      <?php foreach($panier as $item): ?>
        <tr>
          <td><?= $item['nom'] ?></td>
          <td><?= $item['prix'] ?> FCFA</td>
          <td><?= $item['quantite'] ?></td>
          <td><?= $item['prix'] * $item['quantite'] ?> FCFA</td>
        </tr>
        <?php $total += $item['prix'] * $item['quantite']; ?>
      <?php endforeach; ?>
      <tr>
        <td colspan="3" class="total">Total</td>
        <td><?= $total ?> FCFA</td>
      </tr>
    </table>
  </div>
</body>
</html>
