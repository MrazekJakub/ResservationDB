<?php
require_once("header.php");
require_once("connectDB.php");
require_once("functions.php");
require_once("authorize.php");
viewMenu($logedmenu, 0);
// Získání informací o knihách s dostupností "Vyprodáno"
$query = "SELECT * FROM knihy WHERE dostupnost = 'Vyprodáno'";
try {
    $stmt = $db->query($query);
    $books = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Chyba při načítání informací o knihách: " . $e->getMessage();
}

?>

<head>
    <link rel="stylesheet" href="adminU.css">
</head>

<section class="main-section">
    <h1>Vyprodané knihy</h1>
    <?php if(!empty($books)): ?>
        <table class="styled-table">
            <thead>
                <tr>
                    <th>Název knihy</th>
                    <th>Autor</th>
                    <th>Cena</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($books as $book): ?>
                    <tr>
                        <td><?php echo $book['jmeno']; ?></td>
                        <td><?php echo $book['autor']; ?></td>
                        <td><?php echo $book['cena']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Žádné knihy nemají dostupnost "Vyprodáno".</p>
    <?php endif; ?>
</section>

<?php
require_once("disconnectDB.php");
require_once("footer.php");
?>
