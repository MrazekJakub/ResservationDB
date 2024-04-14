<?php
require_once("header.php");
require_once("connectDB.php");
require_once("functions.php");
require_once("authorizeAdmin.php");

viewMenu($adminmenu, 1, 1, $_SESSION["loguser"]["jmeno"]);

// Dotaz na získání všech rezervací
$query = "SELECT r.*, k.jmeno AS nazev_knihy, k.autor, k.dostupnost
          FROM rezervace r 
          INNER JOIN knihy k ON r.book_id = k.id";


try {
    $stmt = $db->query($query);
    $reservations = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Chyba při načítání rezervací: " . $e->getMessage();
}
?>

<head>
    <link rel="stylesheet" href="adminU.css">
</head>

<section class="main-section">
    <h1>Seznam rezervací knih</h1>
    <?php if (!empty($reservations)): ?>
        <table class="styled-table">
            <thead>
                <tr>
                    <th>Název knihy</th>
                    <th>Autor</th>
                    <th>Datum a čas rezervace</th>
                    <th>Akce</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($reservations as $reservation): ?>
                    <tr>
                        <td><?php echo $reservation['nazev_knihy']; ?></td>
                        <td><?php echo $reservation['autor']; ?></td>
                        <td><?php echo $reservation['datum_cas']; ?></td>
                        <td>
                            <a href="delete_reservation.php?id=<?php echo $reservation['id']; ?>" onclick="return confirm('Opravdu chcete smazat tuto rezervaci?')">Smazat</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Žádné rezervace nebyly provedeny.</p>
    <?php endif; ?>
</section>

<?php
require_once("disconnectDB.php");
require_once("footer.php");
?>
