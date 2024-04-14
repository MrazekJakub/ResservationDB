<?php
require_once("authorizeAdmin.php");
require_once("header.php");
require_once("connectDB.php");
require_once("functions.php");

// Získání informací o knize na základě ID
if(isset($_GET["id"])){
    $book_id = $_GET["id"];
    $query = "SELECT knihy.*, zanry.nazev AS zanr, bookinfo.info FROM knihy LEFT JOIN zanry ON knihy.zanr_id = zanry.id LEFT JOIN bookinfo ON knihy.id = bookinfo.book_id WHERE knihy.id = ?";
    
    try {
        $q = $db->prepare($query);
        $q->execute([$book_id]);
        $book = $q->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Chyba při načítání informací o knize: " . $e->getMessage();
    }
}

// Získání seznamu žánrů z databáze
$query_genres = "SELECT * FROM zanry";
$genres = [];
try {
    $q_genres = $db->prepare($query_genres);
    $q_genres->execute();
    while ($row = $q_genres->fetch(PDO::FETCH_ASSOC)) {
        $genres[] = $row;
    }
} catch (PDOException $e) {
    echo "Chyba při načítání žánrů: " . $e->getMessage();
}

// Upravení informací o knize
if(isset($_POST["submit"])) {
    // Aktualizace informací pouze pro vyplněná pole
    $update_values = [];
    $update_query = "UPDATE knihy SET";
    
    if (!empty($_POST["title"])) {
        $update_query .= " jmeno=?,";
        $update_values[] = $_POST["title"];
    }
    if (!empty($_POST["author"])) {
        $update_query .= " autor=?,";
        $update_values[] = $_POST["author"];
    }
    if (!empty($_POST["genre"])) {
        $update_query .= " zanr_id=?,";
        $update_values[] = $_POST["genre"];
    }
    if (!empty($_POST["price"])) {
        $update_query .= " cena=?,";
        $update_values[] = $_POST["price"];
    }
    if (!empty($_POST["pages"])) {
        $update_query .= " pocet_stran=?,";
        $update_values[] = $_POST["pages"];
    }
    if (!empty($_POST["availability"])) {
        $update_query .= " dostupnost=?,";
        $update_values[] = $_POST["availability"];
    }
    
    // Oříznutí posledního čárky z dotazu
    $update_query = rtrim($update_query, ",");
    
    // Přidání podmínky pro id knihy
    $update_query .= " WHERE id=?";
    $update_values[] = $book_id;
    
    try {
        $update_q = $db->prepare($update_query);
        $update_q->execute($update_values);
        
        // Získání informace z formuláře
        $info = $_POST["info"];
        
        // Aktualizace informace v tabulce bookinfo
        $info_update_query = "INSERT INTO bookinfo (book_id, info) VALUES (?, ?) ON DUPLICATE KEY UPDATE info=?";
        $info_update_q = $db->prepare($info_update_query);
        $info_update_q->execute([$book_id, $info, $info]);
        
        // Přesměrování na seznam knih po úspěšné aktualizaci
        header('Location: admin.php');
        exit;
    } catch (PDOException $e) {
        echo "Chyba při aktualizaci informací: " . $e->getMessage();
    }
}

viewMenu($adminmenu,1,1,$_SESSION["loguser"]["jmeno"]);
?>

<head>
<link rel="stylesheet" href="adminU.css">
</head>

<body>
    <section>
        <h1>Upravit knihu</h1>
        <form method="post" action="">
            <label for="title">Název:</label><br>
            <input type="text" id="title" name="title" value="<?php echo $book['jmeno']; ?>"><br>
            
            <label for="author">Autor:</label><br>
            <input type="text" id="author" name="author" value="<?php echo $book['autor']; ?>"><br>
            
            <!-- Výběrový seznam pro žánr -->
            <label for="genre">Žánr:</label><br>
            <select id="genre" name="genre">
                <?php foreach ($genres as $genre): ?>
                    <option value="<?php echo $genre['id']; ?>" <?php if ($genre['id'] == $book['zanr_id']) echo 'selected'; ?>><?php echo $genre['nazev']; ?></option>
                <?php endforeach; ?>
            </select><br>
            
            <label for="price">Cena:</label><br>
            <input type="text" id="price" name="price" value="<?php echo $book['cena']; ?>"><br>
            
            <label for="pages">Počet stran:</label><br>
            <input type="text" id="pages" name="pages" value="<?php echo $book['pocet_stran']; ?>"><br>
            
            <!-- Výběrový seznam pro dostupnost -->
            <label for="availability">Dostupnost:</label><br>
            <select id="availability" name="availability">
                <option value="Dostupná" <?php if ($book['dostupnost'] == 'Dostupná') echo 'selected'; ?>>Dostupná</option>
                <option value="Vyprodáno" <?php if ($book['dostupnost'] == 'Vyprodáno') echo 'selected'; ?>>Vyprodáno</option>
                <option value="Na objednání" <?php if ($book['dostupnost'] == 'Na objednání') echo 'selected'; ?>>Na objednání</option>
            </select><br>
            
            <label for="info">Informace:</label><br>
            <textarea id="info" name="info"><?php echo $book['info']; ?></textarea><br>
            
            <input type="submit" name="submit" value="Uložit změny">
        </form>
    </section>
</body>

<?php
require_once("disconnectDB.php");
require_once("footer.php");
?>
