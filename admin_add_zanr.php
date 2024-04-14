<?php
require_once("authorizeAdmin.php");
require_once("header.php");
require_once("connectDB.php");
require_once("functions.php");

// Pokud byl odeslán formulář pro přidání nového žánru
if(isset($_POST["submit"])){
    $nazev = $_POST["nazev"];
    // Přidání nového žánru do tabulky
    $query = "INSERT INTO zanry (nazev) VALUES (?)";
    try{
        $q = $db->prepare($query);
        $q->execute([$nazev]);
        // Přesměrování zpět na stránku seznamu žánrů
        header('Location: admin_zanry.php');
        exit;
    }catch(PDOException $e){
        echo $msg["Error:"]. $e->getMessage();
    }
}

viewMenu($adminmenu,1,1,$_SESSION["loguser"]["jmeno"]);
?>

<section class="user-list">
    <h1>Přidat nový žánr</h1>
    <form method="POST" action="">
        <label for="nazev">Název žánru:</label>
        <input type="text" id="nazev" name="nazev" required>
        <input type="submit" name="submit" value="Přidat žánr">
    </form>
</section>

<?php
require_once("disconnectDB.php");
require_once("footer.php");
?>
