<?php
require_once("header.php");
require_once("connectDB.php");
require_once("message.php");
require_once("functions.php");
require_once("authorize.php");

$user_name = $_SESSION["loguser"]["jmeno"];

$query = "SELECT jmeno, prijmeni, mail, datum_nar, role FROM uzivatele WHERE jmeno = ?";
try {
    $q = $db->prepare($query);
    $q->execute([$user_name]);
    $user = $q->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo $msg["dberror"] . $e->getMessage();
}
viewMenu($logedmenu, 0); 

// Zkontrolujte, zda je uživatel přihlášen a není administrátor
if(isset($_SESSION["loguser"]) && $_SESSION["loguser"]["role"] != 1) {

?>

<section class="user-profile">
    <h1>Váš profil</h1>
    <ul>
        <li><strong>Jméno:</strong> <?php echo $user["jmeno"]; ?></li>
        <li><strong>Příjmení:</strong> <?php echo $user["prijmeni"]; ?></li>
        <li><strong>Email:</strong> <?php echo $user["mail"]; ?></li>
        <li><strong>Datum narození:</strong> <?php echo $user["datum_nar"]; ?></li>
        <li><strong>Role:</strong> <?php echo $user["role"] == 1 ? "Admin" : "Uživatel"; ?></li>
    </ul>
</section>

<?php
} else {
    // Pokud uživatel není přihlášen nebo je administrátorem, měl by být přesměrován na jinou stránku
    header('Location: index.php');
    exit;
}

require_once("disconnectDB.php");
require_once("footer.php");
?>
