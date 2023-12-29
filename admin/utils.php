<?php
function isAdminLoggedIn()
{
    return isset($_SESSION['username_admin']);
}
function redirectToLoginPage()
{
    header("Location: index.php");
    exit();
}
function redirectToLoginAdminPage()
{
    header("Location: ../index.php");
    exit();
}
