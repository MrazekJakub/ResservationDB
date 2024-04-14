<?php
require_once("authorizeAdmin.php");
require_once("header.php");
require_once("connectDB.php");
require_once("functions.php");

$user_name = $_SESSION["loguser"]["jmeno"];

$query = "SELECT jmeno, prijmeni, mail, datum_nar, role FROM uzivatele WHERE jmeno = ?";
try {
    $q = $db->prepare($query);
    $q->execute([$user_name]);
    $user = $q->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo $msg["dberror"] . $e->getMessage();
}

?>
<?php
viewMenu($adminmenu, 1, 1, $_SESSION["loguser"]["jmeno"]);
?>
<section class="user-profile">
    <h1>Profil administrátora</h1>
    <ul>
        <li><strong>Jméno:</strong> <?php echo $user["jmeno"]; ?></li>
        <li><strong>Příjmení:</strong> <?php echo $user["prijmeni"]; ?></li>
        <li><strong>Email:</strong> <?php echo $user["mail"]; ?></li>
        <li><strong>Datum narození:</strong> <?php echo $user["datum_nar"]; ?></li>
        <li><strong>Role:</strong> <?php echo $user["role"] == 1 ? "Admin" : "Uživatel"; ?></li>
    </ul>
</section>

<?php
require_once("disconnectDB.php");
require_once("footer.php");
?>
