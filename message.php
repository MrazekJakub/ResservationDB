<?php
$msg = array(
    "mailMissing" => '<p class="warning">Nevyplněný email</p>',
    "passMissing" => '<p class="warning">Nevyplněné heslo</p>',
    "dberror" => '<p class="error">Problém s DB:</p>',
    "regerror" => '<p class="error">Problém s registrací - pravděpodobně učet již existuje.</p>',
    "regpassequals" => 'Hesla se neshodují',
);

$menu = array(
    "index"=>"Home",
    "resservation"=>"Rezervace",
    "booklist" => "Seznam Knih",
    "contact"=>"Kontakt"
);

$labels = array(
    "logout" => "Odhlásit se",
    
);
$logedmenu = array (
  "index" => "Home",
  "resservation" => "Rezervace",
  "booklist" => "Seznam Knih",
  "vyprodano" => "Vyprodané Kníhy",
  "contact"=>"Kontakt",
);
$adminmenu = array (
  "admin_users" => "Správa uživatelů",
  "admin" => "Správa knih",
  "admin_zanry" => "Správa žánrů",
  "admin_resservation" => "Správa Rezervací",
  "admin_objednavky" => "Objednávky",
  "admin_add_zanr" => "Přidání žánru",
  "admin_add_book" => "Přidání knihy",
);
?>
<style>
.warning {
  color: #ff0000;
  font-weight: bold;
  border: 1px solid #ff0000;
  padding: 5px;
  margin-bottom: 10px;
}

.error {
  color: #ff0000;
  font-weight: bold;
  background-color: #f0f0f0;
  border: 1px solid #ff0000;
  padding: 5px;
  margin-bottom: 10px;
}
</style>