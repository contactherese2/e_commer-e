<?php
session_start();

if (!isset($_SESSION['id_user'])) {
    header("Location: connexion.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: panier.php");
    exit;
}

$id_user = (int) $_SESSION['id_user'];
$adresse = trim($_POST['adresse_cmd'] ?? '');

if ($adresse === '') {
    header("Location: panier.php?error=adresse");
    exit;
}

$conn = new mysqli("localhost", "root", "", "commerce");
if ($conn->connect_error) {
    die("Erreur de connexion : " . $conn->connect_error);
}
$conn->set_charset("utf8mb4");
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$stmt = $conn->prepare("SELECT panier.id_p, panier.quantite_pa, produits.prix_p, produits.nom_p FROM panier JOIN produits ON panier.id_p = produits.id_p WHERE panier.id_u = ?");
$stmt->bind_param("i", $id_user);
$stmt->execute();
$result_panier = $stmt->get_result();

if (!$result_panier || $result_panier->num_rows === 0) {
    die("Votre panier est vide.");
}

$total = 0;
$details = [];
while ($row = $result_panier->fetch_assoc()) {
    $row['subtotal'] = $row['prix_p'] * $row['quantite_pa'];
    $total += $row['subtotal'];
    $details[] = $row;
}
$stmt->close();

$stmt_cmd = $conn->prepare("INSERT INTO commande(id_u, total_cmd, statut_cmd, adresse_cmd) VALUES (?, ?, 'attente', ?)");
$stmt_cmd->bind_param("ids", $id_user, $total, $adresse);
$stmt_cmd->execute();
$id_commande = $stmt_cmd->insert_id;
$stmt_cmd->close();

$stmt_detail = $conn->prepare("INSERT INTO detail_commande(id_cmd, id_p, quantite_det, prix_unit) VALUES (?, ?, ?, ?)");
foreach ($details as $item) {
    $stmt_detail->bind_param("iiid", $id_commande, $item['id_p'], $item['quantite_pa'], $item['prix_p']);
    $stmt_detail->execute();
}
$stmt_detail->close();

$conn->query("DELETE FROM panier WHERE id_u = '$id_user'");

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Commande confirmée</title>
    <style>
        :root {
            color-scheme: dark;
            --bg: #090b14;
            --surface: rgba(15, 23, 42, 0.95);
            --surface-strong: #111827;
            --accent: #8b5cf6;
            --text: #f8fafc;
            --text-muted: #94a3b8;
            --border: rgba(148, 163, 184, 0.14);
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: 'Inter', system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background: radial-gradient(circle at top right, #5b21b6 0%, transparent 35%),
                        linear-gradient(180deg, #030712 0%, #090b14 100%);
            color: var(--text);
        }

        .page {
            display: grid;
            justify-items: center;
            padding: 36px 16px 48px;
        }

        .card {
            width: min(100%, 920px);
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 32px;
            overflow: hidden;
            box-shadow: 0 32px 90px rgba(0, 0, 0, 0.35);
        }

        .hero {
            padding: 40px 44px;
            background: linear-gradient(180deg, rgba(99, 102, 241, 0.16), transparent 82%);
        }

        .hero h1 {
            margin: 0;
            font-size: clamp(2rem, 2.75vw, 3rem);
            letter-spacing: -0.04em;
        }

        .hero p {
            margin: 18px 0 0;
            color: var(--text-muted);
            max-width: 680px;
            line-height: 1.7;
        }

        .badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1rem;
            margin-top: 24px;
            border-radius: 9999px;
            background: rgba(139, 92, 246, 0.12);
            color: #e9d5ff;
            font-size: 0.95rem;
            font-weight: 600;
        }

        .content {
            padding: 32px 44px 40px;
            display: grid;
            gap: 28px;
        }

        .summary-grid {
            display: grid;
            gap: 16px;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
        }

        .summary-card {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.06);
            border-radius: 22px;
            padding: 22px;
        }

        .summary-card strong {
            display: block;
            font-size: 1rem;
            color: var(--text-muted);
            margin-bottom: 0.9rem;
        }

        .summary-card span {
            font-size: 1.55rem;
            font-weight: 700;
            letter-spacing: -0.03em;
        }

        .details {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 520px;
        }

        thead tr {
            border-bottom: 1px solid rgba(148, 163, 184, 0.14);
        }

        th,
        td {
            padding: 16px 12px;
            text-align: left;
        }

        th {
            font-size: 0.95rem;
            font-weight: 600;
            color: var(--text-muted);
        }

        td {
            border-bottom: 1px solid rgba(148, 163, 184, 0.08);
        }

        td:nth-child(2),
        td:nth-child(3),
        td:nth-child(4) {
            text-align: right;
        }

        .total-row td {
            border-top: 1px solid rgba(148, 163, 184, 0.18);
            font-weight: 700;
        }

        .button-row {
            display: flex;
            flex-wrap: wrap;
            gap: 14px;
            justify-content: flex-end;
            padding: 0 44px 36px;
        }

        .button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            min-width: 180px;
            padding: 16px 24px;
            border-radius: 999px;
            text-decoration: none;
            font-weight: 700;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .button:hover {
            transform: translateY(-1px);
            box-shadow: 0 18px 45px rgba(139, 92, 246, 0.18);
        }

        .button--primary {
            color: white;
            background: linear-gradient(135deg, #7c3aed, #6366f1);
        }

        .button--secondary {
            color: var(--text);
            background: rgba(255, 255, 255, 0.06);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        @media (max-width: 640px) {
            .hero,
            .content,
            .button-row {
                padding-left: 22px;
                padding-right: 22px;
            }

            .button-row {
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    <main class="page">
        <section class="card">
            <div class="hero">
                <span class="badge">Commande confirmée</span>
                <h1>Merci pour votre commande</h1>
                <p>Votre commande a été enregistrée avec succès. Retrouvez ci-dessous le récapitulatif de votre achat et l’adresse de livraison associée.</p>
            </div>

            <div class="content">
                <div class="summary-grid">
                    <div class="summary-card">
                        <strong>Numéro de commande</strong>
                        <span>#<?php echo htmlspecialchars($id_commande); ?></span>
                    </div>
                    <div class="summary-card">
                        <strong>Montant total</strong>
                        <span><?php echo number_format($total, 2, ',', ' '); ?> €</span>
                    </div>
                    <div class="summary-card">
                        <strong>Adresse de livraison</strong>
                        <span><?php echo nl2br(htmlspecialchars($adresse)); ?></span>
                    </div>
                    <div class="summary-card">
                        <strong>Date</strong>
                        <span><?php echo date('d/m/Y H:i'); ?></span>
                    </div>
                </div>

                <div class="details">
                    <table>
                        <thead>
                            <tr>
                                <th>Produit</th>
                                <th>Quantité</th>
                                <th>Prix unitaire</th>
                                <th>Sous-total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($details as $item): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($item['nom_p']); ?></td>
                                    <td><?php echo (int) $item['quantite_pa']; ?></td>
                                    <td><?php echo number_format($item['prix_p'], 2, ',', ' '); ?> €</td>
                                    <td><?php echo number_format($item['subtotal'], 2, ',', ' '); ?> €</td>
                                </tr>
                            <?php endforeach; ?>
                            <tr class="total-row">
                                <td colspan="3">Total</td>
                                <td><?php echo number_format($total, 2, ',', ' '); ?> €</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="button-row">
                <a class="button button--primary" href="acceuil.php">Retour à l'accueil</a>
                
            </div>
        </section>
    </main>
</body>
</html>