<?php

require_once("connectDB.php");
require_once("functions.php");
session_start();

// Zpracování přihlášení
if(isset($_POST['login'])) {
  $mail = $_POST['mail']; 
  $password = $_POST['password'];

  // Dotaz na databázi pro ověření uživatele pomocí mailu
  $query = "SELECT * FROM uzivatele WHERE mail = :mail"; 
  $stmt = $db->prepare($query);
  $stmt->execute(array(':mail' => $mail)); 
  $user = $stmt->fetch();

  // Pokud uživatel existuje a heslo se shoduje
  if($user && verifyPass($password, $user['heslo'])) {
      // Úspěšné přihlášení
      $_SESSION['loguser']['user_id'] = $user['id'];
      $_SESSION['loguser']['role'] = $user['role']; // Uložení role do session
      $_SESSION['loguser']['jmeno'] = $user['jmeno']; // Uložení jména uživatele do session
      $_SESSION["loguser"]["time"] = time()+600; //aktualizace casu po aktivite
    

      // Přesměrování na odpovídající stránku
      if ($user['role'] == 1) {
        $_SESSION['loguser']['role'] = $user['role']; // Uložení role do session

          // Pokud je uživatel admin, přesměruj na admin.php
          header('Location: admin.php');
        
      } else {
          // Jinak přesměruj na index.php
          header('Location: index.php');
      }
      exit;
  } else {
      // Chyba přihlášení
      $errorMessage = 'Neplatný e-mail nebo heslo.';
  }
}

?>

<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Přihlášení</title>
    <link rel="stylesheet" href="styleLoginRegister.css">
</head>
<body>
    <div class="container">
        <h1>Přihlášení</h1>
        <?php if (isset($errorMessage)) { ?>
            <div class="error-message"><?php echo $errorMessage; ?></div>
        <?php } ?>
        <form method="post">
            <label for="mail">E-mail:</label> <input type="email" id="mail" name="mail" required> <label for="password">Heslo:</label>
            <input type="password" id="password" name="password" required>
            <button type="submit" name="login">Přihlásit se</button>
            <br><br>
            <a href="registrace.php">Nemám účet</a>
        </form>
    </div>
</body>
</html>
