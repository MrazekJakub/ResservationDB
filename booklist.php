<?php
require_once("header.php");
require_once("connectDB.php");
require_once("functions.php");
require_once("authorize.php");

viewMenu($logedmenu, 0);

?>
<head>
<link rel="stylesheet" href="adminU.css">
</head>
<section class="main-section">
    <h1>Seznam knih</h1>
    <table class="styled-table">
        <thead>
            <tr>
                <th>Název</th>
                <th>Autor</th>
                <th>Žánr</th>
                <th>Cena</th>
                <th>Počet Stran</th>
                <th>Dostupnost</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query = "SELECT knihy.id, knihy.jmeno, knihy.autor, zanry.nazev AS zanr, knihy.cena, knihy.pocet_stran, knihy.dostupnost FROM knihy LEFT JOIN zanry ON knihy.zanr_id = zanry.id WHERE knihy.dostupnost != 'Vyprodáno'";
            try {
                $q = $db->prepare($query);
                $q->execute();
                while ($item = $q->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>";
                    echo "<td><a href=\"book.php?id={$item['id']}\">{$item['jmeno']}</a></td>";
                    echo "<td>{$item['autor']}</td>";
                    echo "<td>{$item['zanr']}</td>";
                    echo "<td>{$item['cena']}</td>";
                    echo "<td>{$item['pocet_stran']}</td>";
                    echo "<td>{$item['dostupnost']}</td>";
                    echo "</tr>";
                }
            } catch (PDOException $e) {
                echo "Chyba při získávání dat: " . $e->getMessage();
            }
            ?>
        </tbody>
    </table>
</section>

<?php
require_once("disconnectDB.php");
require_once("footer.php");
?>
