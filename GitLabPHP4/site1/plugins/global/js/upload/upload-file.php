<?php
session_start();

$uploaddir = '../../../../uploads/'; 
$file = $uploaddir . basename($_FILES['uploadfile']['name']); 
$file_ = "uploads/" . basename($_FILES['uploadfile']['name']); 
 
if (move_uploaded_file($_FILES['uploadfile']['tmp_name'], $file)) { 
  $_SESSION["cv_link"]=$file_;
  echo "success"; 
} 
else {
    if (isset($_SESSION["cv_link"])&&$_SESSION["cv_link"]!=""){ 
        unlink($_SESSION["cv_link"]);
        unset($_SESSION["cv_link"]);
    }
    echo "error";
}
?>