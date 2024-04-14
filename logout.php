<?php
 require "functions.php";
 session_start();
 session_destroy();
 go("index.php");
