<?php
require_once("header.php");
require_once("connectDB.php");
require_once("functions.php");
require_once("authorize.php");
viewMenu($logedmenu, 0);
?>
<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontakt</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        h1 {
            text-align: center;
        }
        .contact-info {
            margin-top: 20px;
        }
        .contact-info p {
            margin: 10px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Kontakt</h1>
        <div class="contact-info">
            <p><strong>Email:</strong> example@example.com</p>
            <p><strong>Telefon:</strong> +1234567890</p>
            <p><strong>Adresa:</strong> Příkladová 123, Město, Země</p>
        </div>
    </div>
    <?php require_once("footer.php"); ?>
</body>
</html>

<?php
require_once("disconnectDB.php");
require_once("footer.php");
?>