<?php
require_once("header.php");
require_once("connectDB.php");
require_once("functions.php");
require_once("authorizeAdmin.php");
viewMenu($adminmenu,1,1,$_SESSION["loguser"]["jmeno"]);

// Získání informací o objednaných knihách s dostupností "Na objednání"
$query = "SELECT * FROM knihy WHERE dostupnost = 'Na objednání'";
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
    <h1>Objednané knihy</h1>
    <?php if(!empty($books)): ?>
        <table class="styled-table">
            <thead>
                <tr>
                    <th>Název knihy</th>
                    <th>Autor</th>
                    <th>Cena</th>
                    <th>Upravit</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($books as $book): ?>
                    <tr>
                        <td><?php echo $book['jmeno']; ?></td>
                        <td><?php echo $book['autor']; ?></td>
                        <td><?php echo $book['cena']; ?></td>
                        <td><a href="admin_bsub.php?id=<?php echo $book['id']; ?>"><img src="image/edit.jpg" width="20" alt="upravit"></a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Žádné knihy nebyly objednány.</p>
    <?php endif; ?>
</section>

<?php
require_once("disconnectDB.php");
require_once("footer.php");
?>
