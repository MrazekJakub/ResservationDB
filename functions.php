<?php

function go($destination = "index.php")
{
  header("Location: " . $destination);
  exit();
}

function verifyPass($password, $hashed_password) {
  // Porovnání hašovaného hesla uloženého v databázi s heslem zadaným uživatelem
  return password_verify($password, $hashed_password);
}

function hashPass($password) {
  // Hašování hesla
  return password_hash($password, PASSWORD_DEFAULT);
}

function viewMenu($menuItem, $active, $login = 0, $name = "nobody")
{
  echo '<div class="topnav">';
  $i = 0;
  foreach ($menuItem as $key => $value) {
    if ($i == $active) echo '<a class="active" href="' . $key . '.php">' . $value . '</a>';
    else echo '<a href="' . $key . '.php">' . $value . '</a>';
    $i++;
  }
  echo '<div class="login-container">';
  
  if($login == 0) { // Přihlášený uživatel
    if(isset($_SESSION["loguser"]["jmeno"])) {
        echo '<a href="profil.php">'.$_SESSION["loguser"]["jmeno"].'</a>'; 
    } else {
        echo '<a href="#">'.$name.'</a>';  // Uživatel není přihlášený
    }
    echo '<button class="logout" onclick="window.location.href=\'logout.php\';">';
    echo 'Odhlásit';
    echo '</button>';
    
  } else if ($login == 1) { // Pokud je uživatel s rolí admin Přihlášený uživatel
      echo '<a href="admin_profil.php">'.$_SESSION["loguser"]["jmeno"].'</a>';  // Zobrazení jména přihlášeného uživatele
      echo '<button class="logout" onclick="window.location.href=\'logout.php\';">';
      echo 'Odhlásit';
      echo '</button>';
    } else {
    echo '<a class="register" href="registrace.php">Registrovat</a>';
    echo '<button class="login" onclick="window.location.href=\'login.php\';">';
    echo 'Přihlásit';
    echo '</button>';
  }
  echo '</div>'; // Konec login-container
  echo '</div>'; // Konec topnav
}
