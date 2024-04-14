<?php
require_once("authorizeAdmin.php");
require_once("header.php");
require_once("connectDB.php");
require_once("functions.php");

if(isset($_GET["id"]) && isset($_GET["jmeno"])){
    $id = $_GET["id"];
    $query = "DELETE FROM knihy WHERE id=?";
    try{
        $q = $db->prepare($query);
        $request = $q->execute(array($id));
    }catch(PDOException $e){
        echo $msg["Error:"]. $e->getMessage();
    }
}

viewMenu($adminmenu,1,1,$_SESSION["loguser"]["jmeno"]);
?>
<head>
<link rel="stylesheet" href="adminU.css">
</head>
<body>
    <section>
        <h1>Seznam knih</h1>
        <?php
        $query = "SELECT knihy.id, knihy.jmeno, knihy.autor, zanry.nazev AS zanr, knihy.cena, knihy.pocet_stran, knihy.dostupnost FROM knihy LEFT JOIN zanry ON knihy.zanr_id = zanry.id";
        try{
            $q = $db->prepare($query);
            $q->execute();
            echo '<table class="styled-table">';
            echo "<thead>";
            echo "<tr>";
            echo "<th>Název</th><th>Autor</th><th>Žánr</th><th>Cena</th><th>Počet Stran</th><th>Dostupnost</th><th></th><th></th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
            while($item = $q->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td data-dostupnost='" . $item["dostupnost"] . "'>";
                echo '<a href="admin_book.php?id='.$item["id"].'">';
                echo $item["jmeno"];
                echo "</a>";
                echo "</td>";
                echo "<td>";
                echo $item["autor"];
                echo "</td>";
                echo "<td>";
                echo $item["zanr"];
                echo "</td>";
                echo "<td>";
                echo $item["cena"];
                echo "</td>";
                echo "<td>";
                echo $item["pocet_stran"];
                echo "</td>";
                echo "<td>";
                echo $item["dostupnost"];
                echo "</td>";
                echo "<td>";
                echo '<a href="admin_bsub.php?id='.$item["id"].'"><img src="image/edit.jpg" width="20"></a>';
                echo "</td>";
                echo "<td><a href='admin.php?id=".$item["id"]."&confirm=true' onclick=\"return confirm('Opravdu chcete smazat tuto knihu?')\"><img src='image/delete.png' width='35' alt='smazat'></a></td>";
                echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";
        }catch(PDOException $e){
            echo $msg["dberror"]. $e->getMessage();
        }
        ?>
    </section>
</body>

<?php
require_once("disconnectDB.php");
require_once("footer.php");
?>
