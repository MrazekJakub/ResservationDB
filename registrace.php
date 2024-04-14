<?php
require_once("connectDB.php");
require_once("functions.php");
session_start();

// Zpracování registrace
if(isset($_POST["register"])) {
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $email = $_POST["email"];
    $birth = $_POST["birth"];
    $pass = $_POST["pass"];
    $pass2 = $_POST["pass2"];

    // Kontrola, zda hesla jsou stejná
    if($pass == $pass2) {
        // Hašování hesla
        $hashed_password = hashPass($pass);

        // Vložení uživatele do databáze
        $query = "INSERT INTO uzivatele (jmeno, prijmeni, mail, heslo, datum_nar) VALUES (:fname, :lname, :email, :pass, :birth)";
        $stmt = $db->prepare($query);
        $stmt->execute(array(':fname' => $fname, ':lname' => $lname, ':email' => $email, ':pass' => $hashed_password, ':birth' => $birth));

        // Přesměrování na přihlašovací stránku
        header('Location: login.php');
        exit;
    } else {
        $errorMessage = "Hesla se neshodují.";
    }
}
?>

<!DOCTYPE html>
<html lang="cs">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registrace</title>
  <link rel="stylesheet" href="styleLoginRegister.css">
</head>
<body>
  <div class="container">
    <h1>Registrace</h1>
    <?php if(isset($errorMessage)) { ?>
      <div class="error-message"><?php echo $errorMessage; ?></div>
    <?php } ?>
    <form method="post">
      <label for="fname">Křestní jméno:</label>
      <input type="text" id="fname" name="fname" required>
      <label for="lname">Příjmení:</label>
      <input type="text" id="lname" name="lname" required>
      <label for="email">E-mail:</label>
      <input type="email" id="email" name="email" required>
      <label for="birth">Datum narození:</label>
      <input type="date" id="birth" name="birth" required>
      <label for="pass">Heslo:</label>
      <input type="password" id="pass" name="pass" required>
      <label for="pass2">Heslo znovu:</label>
      <input type="password" id="pass2" name="pass2" required>
      <button type="submit" name="register">Registrovat</button>
      <br><br>
      <a href="login.php">Mám již účet</a>
   </form>
  </div>
</body>
</html>
