<?php
if (!isset($_POST['pass']))
{
    $error = false;
    include("loginForm.php");
}
else
{
    include("class/login.class.php");

    $login = new login;

    $login->check($_POST['pass']);
}
?>