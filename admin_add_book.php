<?php
require_once("authorizeAdmin.php");
require_once("header.php");
require_once("connectDB.php");
require_once("functions.php");

// Pokud byl odeslán formulář
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Získání dat z formuláře
    $jmeno = $_POST["jmeno"]; // Změna proměnné $nazev na $jmeno
    $autor = $_POST["autor"];
    $zanr_id = $_POST["zanr"];
    $cena = $_POST["cena"];
    $pocet_stran = $_POST["pocet_stran"];
    $dostupnost = $_POST["dostupnost"];

    // Přidání knihy do databáze
    $query = "INSERT INTO knihy (jmeno, autor, zanr_id, cena, pocet_stran, dostupnost) VALUES (?, ?, ?, ?, ?, ?)";
    try{
        $q = $db->prepare($query);
        $q->execute([$jmeno, $autor, $zanr_id, $cena, $pocet_stran, $dostupnost]); // Změna $nazev na $jmeno
        // Přesměrování zpět na stránku seznamu knih
        header('Location: admin.php');
        exit;
    }catch(PDOException $e){
        echo $msg["Error:"]. $e->getMessage();
    }
}
viewMenu($adminmenu,1,1,$_SESSION["loguser"]["jmeno"]);
// Získání seznamu žánrů z databáze
$query = "SELECT * FROM zanry";
$zanry = [];
try{
    $q = $db->prepare($query);
    $q->execute();
    while($row = $q->fetch(PDO::FETCH_ASSOC)) {
        $zanry[] = $row;
    }
}catch(PDOException $e){
    echo $msg["dberror"]. $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Přidat knihu</title>
    <link rel="stylesheet" href="bookadd.css">
</head>
<body>

<h1>Přidat knihu</h1>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label for="nazev">Název:</label><br>
    <input type="text" id="jmeno" name="jmeno" required><br>
    
    <label for="autor">Autor:</label><br>
    <input type="text" id="autor" name="autor" required><br>
    
    <label for="zanr">Žánr:</label><br>
    <select id="zanr" name="zanr" required>
        <?php foreach($zanry as $zanr): ?>
            <option value="<?php echo $zanr['id']; ?>"><?php echo $zanr['nazev']; ?></option>
        <?php endforeach; ?>
    </select><br>
    
    <label for="cena">Cena:</label><br>
    <input type="number" id="cena" name="cena" step="0.01" required><br>
    
    <label for="pocet_stran">Počet stran:</label><br>
    <input type="number" id="pocet_stran" name="pocet_stran" required><br>
    
    <label for="dostupnost">Dostupnost:</label><br>
    <select id="dostupnost" name="dostupnost" required>
        <option value="Dostupná">Dostupná</option>
        <option value="Vyprodáno">Vyprodáno</option>
        <option value="Na objednání">Na objednání</option>
    </select><br><br>
    
    <input type="submit" value="Přidat knihu">
</form>

</body>
</html>

<?php
require_once("disconnectDB.php");
require_once("footer.php");
?>
