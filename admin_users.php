<?php
require_once("authorizeAdmin.php");
require_once("header.php");
require_once("connectDB.php");
require_once("functions.php");
?>

<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seznam uživatelů</title>
    <link rel="stylesheet" href="adminU.css"> <!-- Přidejte cestu k vašemu CSS souboru -->
</head>
<body>

<?php
if(isset($_GET["id"]) && isset($_GET["confirm"]) && $_GET["confirm"] == "true"){
    $id = $_GET["id"];
    $query = "DELETE FROM uzivatele WHERE id=?";
    try{
        $q = $db->prepare($query);
        $request = $q->execute(array($id));
        // Přesměrování zpět na stránku seznamu uživatelů
        header('Location: admin_users.php');
        exit;
    }catch(PDOException $e){
        echo $msg["Error:"]. $e->getMessage();
    }
}
?>

<?php
viewMenu($adminmenu,1,1,$_SESSION["loguser"]["jmeno"]);
?>

<section class="user-list">
    <h1>Seznam uživatelů</h1>
    <table class="styled-table">
        <thead>
            <tr>
                <th>Jméno</th>
                <th>Příjmení</th>
                <th>E-mail</th>
                <th>Datum narození</th>
                <th>Věk</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query = "SELECT * FROM uzivatele";
            try{
                $q = $db->prepare($query);
                $q->execute();
                $today = new DateTime('today');
                while($item = $q->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>";
                    echo "<td>" . $item["jmeno"] . "</td>";
                    echo "<td>" . $item["prijmeni"] . "</td>";
                    echo "<td>" . $item["mail"] . "</td>";
                    echo "<td>" . $item["datum_nar"] . "</td>";
                    echo "<td>" . (new DateTime($item["datum_nar"]))->diff($today)->y . "</td>";
                    echo "<td><a href='admin_users.php?id=".$item["id"]."&confirm=true' onclick=\"return confirm('Opravdu chcete smazat tohoto uživatele?')\"><img src='image/delete.png' width='35' alt='smazat'></a></td>";
                    echo "</tr>";
                }
            }catch(PDOException $e){
                echo $msg["dberror"]. $e->getMessage();
            }
            ?>
        </tbody>
    </table>
</section>

<?php
require_once("disconnectDB.php");
require_once("footer.php");
?>
</body>
</html>
