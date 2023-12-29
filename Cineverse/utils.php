<?php
function isUserLoggedIn()
{
    return isset($_SESSION['username']);
}
function redirectToLoginPage()
{
    header("Location: index.php");
    exit();
}
