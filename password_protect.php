<?php
  if(!isset($_POST['pass']))
    {
      include("loginForm.php");  
}
  else{
    include("class/login.php");
    
    $login = new login;
    
    $login->check($_POST['pass']);
  }
?>