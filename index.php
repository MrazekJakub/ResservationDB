<?php
require_once("header.php");
require_once("connectDB.php");
require_once("functions.php");
require_once("authorize.php");

// Získání knih z databáze s dostupností různou od "Vyprodáno" a různou od "Na objednání"
$query = "SELECT * FROM knihy WHERE dostupnost != 'Vyprodáno' AND dostupnost != 'Na objednání'";
try {
    $stmt = $db->query($query);
    $books = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Chyba při načítání knih: " . $e->getMessage();
}

viewMenu($logedmenu, 0);
?>
<head>
    <link rel="stylesheet" href="styleindex.css">
    <style>
        .order-btn {
            background-color: #ff7f0f; /* Oranžová barva */
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            border-radius: 5px;
        }

        .order-btn:hover {
            background-color: #ff6600; /* Stmelenější oranžová barva při najetí myši */
        }
    </style>
</head>
<section class="main-section">
    <h1>Vítejte v našem rezervačním systému s knihami!</h1>
    <p>Vítejte na hlavní stránce našeho rezervačního systému s knihami. Zde můžete procházet naši nabídku knih a provádět rezervace.</p>
    <div class="book-offer">
        <h2>Naše nabídka knih:</h2>
        <?php foreach ($books as $book): ?>
            <div class="book">
                <h3><?php echo $book['jmeno']; ?></h3>
                <p><strong>Autor:</strong> <?php echo $book['autor']; ?></p>
                <p><strong>Dostupnost:</strong> <?php echo $book['dostupnost']; ?></p>
                <p><strong>Cena:</strong> <?php echo $book['cena']; ?></p><br>
                <a class="reserve-btn" href="ress.php?book_id=<?php echo $book['id']; ?>">Rezervovat</a>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<?php
require_once("disconnectDB.php");
require_once("footer.php");
?>
