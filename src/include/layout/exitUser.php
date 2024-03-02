<?php


if (isset($_COOKIE['email'])) {
    setcookie($emailCookie, $emailLog, time() - (86400 * 31) . '/');
    setcookie($passwordCookie, $passLog, time() - (86400 * 31) . '/');
    header("Location:../../login.php");
}

