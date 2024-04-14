<?php
require_once("header.php");
require_once("connectDB.php");
require_once("functions.php");
require_once("authorizeAdmin.php");

viewMenu($adminmenu,1,1,$_SESSION["loguser"]["jmeno"]);

if (isset($_GET["id"])) {
    $book_id = $_GET["id"];
    $query = "SELECT knihy.*, zanry.nazev AS zanr, bookinfo.info FROM knihy LEFT JOIN zanry ON knihy.zanr_id = zanry.id LEFT JOIN bookinfo ON knihy.id = bookinfo.book_id WHERE knihy.id = ?";
} elseif (isset($_GET["title"])) {
    $book_title = $_GET["title"];
    $query = "SELECT knihy.*, zanry.nazev AS zanr, bookinfo.info FROM knihy LEFT JOIN zanry ON knihy.zanr_id = zanry.id LEFT JOIN bookinfo ON knihy.id = bookinfo.book_id WHERE knihy.jmeno = ?";
} else {
    echo "Nebylo specifikováno ID ani název knihy.";
    exit;
}

try {
    $q = $db->prepare($query);
    $q->execute(isset($book_id) ? [$book_id] : [$book_title]);
    $book = $q->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Chyba při načítání informací o knize: " . $e->getMessage();
}

?>

<section class="book-details">
    <h1>Detaily knihy</h1>
    <ul>
        <li><strong>Název:</strong> <?php echo $book["jmeno"]; ?></li>
        <li><strong>Autor:</strong> <?php echo $book["autor"]; ?></li>
        <li><strong>Žánr:</strong> <?php echo $book["zanr"]; ?></li>
        <li><strong>Cena:</strong> <?php echo $book["cena"]; ?> Kč</li>
        <li><strong>Počet stran:</strong> <?php echo $book["pocet_stran"]; ?></li>
        <li><strong>Dostupnost:</strong> <?php echo $book["dostupnost"]; ?></li>
        <li><strong>Informace:</strong> <?php echo $book["info"]; ?></li>
    </ul>
</section>

<?php
require_once("disconnectDB.php");
require_once("footer.php");
?>
