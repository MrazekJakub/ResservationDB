<?php
require_once("header.php");
require_once("connectDB.php");
require_once("functions.php");
require_once("authorize.php");

// Získání ID knihy z URL
if(isset($_GET["book_id"])) {
    $book_id = $_GET["book_id"];
    
    // Dotaz na databázi pro získání informací o knize
    $query = "SELECT * FROM knihy WHERE id = ?";
    try {
        $stmt = $db->prepare($query);
        $stmt->execute([$book_id]);
        $book = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Chyba při načítání informací o knize: " . $e->getMessage();
    }
}

// Funkce pro uložení rezervace do databáze
function saveReservation($db, $book_id, $nazev_knihy, $selected_date_time) {
    // Připravený dotaz pro vložení rezervace do tabulky
    $query = "INSERT INTO rezervace (book_id, nazev_knihy, datum_cas) VALUES (?, ?, ?)";
    
    try {
        // Příprava a provedení dotazu
        $stmt = $db->prepare($query);
        $stmt->execute([$book_id, $nazev_knihy, $selected_date_time]);
    } catch (PDOException $e) {
        echo "Chyba při ukládání rezervace: " . $e->getMessage();
    }
}

// Pokud byl odeslán formulář
if(isset($_POST["submit"])) {
    // Získání vybraného data a času z formuláře
    $selected_date_time = $_POST["date_time"];
    
    // Uložení rezervace do databáze
    saveReservation($db, $book_id, $book['jmeno'], $selected_date_time);
    
    // Přesměrování zpět na index.php
    header("Location: index.php");
    exit;
}

viewMenu($logedmenu, 0);
?>

<head>
    <link rel="stylesheet" href="style.css">
</head>

<section class="main-section">
    <h1>Rezervace knihy: <?php echo $book['jmeno']; ?></h1>
    <div class="book-details">
        <p><strong>Název knihy:</strong> <?php echo $book['jmeno']; ?></p>
        <p><strong>Autor:</strong> <?php echo $book['autor']; ?></p>
        <p><strong>Cena:</strong> <?php echo $book['cena']; ?></p>
        <!-- Zde můžete zobrazit další informace o knize -->
    </div>
    
    <h2>Vyberte datum a čas rezervace:</h2>
    <form method="post" action="">
        <input type="datetime-local" id="date_time" name="date_time" required>
        <input type="submit" name="submit" value="Rezervovat">
    </form>
</section>

<?php
require_once("disconnectDB.php");
require_once("footer.php");
?>
