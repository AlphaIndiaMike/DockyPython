<?php
 if (isset($_GET["delete_req"])&&$_GET["delete_req"]!=""){
    if (isset($_SESSION["S_ID"]))
    $razor="delete_req";
 }
 
 if (isset($_GET["quick_register"])&&$_GET["quick_register"]=="1")
 {
    $razor="quick_reg";
 }
    
 


?>