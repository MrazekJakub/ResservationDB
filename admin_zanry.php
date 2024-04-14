<?php
require_once("authorizeAdmin.php");
require_once("header.php");
require_once("connectDB.php");
require_once("functions.php");

if(isset($_GET["id"]) && isset($_GET["confirm"]) && $_GET["confirm"] == "true"){
    $id = $_GET["id"];
    $query = "DELETE FROM zanry WHERE id=?";
    try{
        $q = $db->prepare($query);
        $request = $q->execute(array($id));
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
    <h1>Seznam žánrů</h1>
    <head>
    <link rel="stylesheet" href="adminU.css">
    </head>
    <table class="styled-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Název</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query = "SELECT * FROM zanry";
            try{
                $q = $db->prepare($query);
                $q->execute();
                while($item = $q->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>";
                    echo "<td>" . $item["id"] . "</td>";
                    echo "<td>" . $item["nazev"] . "</td>";
                    echo "<td><a href=admin_zanr_edit.php?id=".$item["id"]."><img src='image/edit.jpg' width='20' alt='edit'></a></td>"; // Přidat odkaz pro editaci žánru
                    echo "<td><a href='admin_zanry.php?id=".$item["id"]."&confirm=true' onclick=\"return confirm('Opravdu chcete smazat tento žánr?')\"><img src='image/delete.png' width='35' alt='smazat'></a></td>"; // Přidat odkaz pro smazání žánru
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
