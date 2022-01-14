<?php

require __DIR__ . '/vendor/autoload.php';

ini_set('display_errors', 1);
error_reporting(E_ALL);

include("config.inc.php");

session_start();

// Database connection, commented cause of errors

if (isset($config) && is_array($config)) {
    try {
        $dbh = new PDO('mysql:host=' . $config['db_host'] . ';dbname=' . $config['db_name'] . ';charset=utf8mb4', $config['db_user'], $config['db_password']);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch (PDOException $e) {
        print "Nie mozna polaczyc sie z baza danych: " . $e->getMessage();
        exit();
    }
}
else {
    exit("Nie znaleziono konfiguracji bazy danych.");
}

if (isset($_GET['logout'])) {
    unset($_SESSION['uid']);
    unset($_SESSION['email']);
    header('Location: /');
}

if (isset($_SESSION['uid']) && isset($_SESSION['email'])) {
    $login_link = "/logout";
    $login_button = "Wyloguj się";
    $profile_link = "/profile";
    $profile_button = "Moje konto";
} else {
    $login_link = "/login";
    $login_button = "Zaloguj się";
    $profile_link = "/registration";
    $profile_button = "Zarejestruj się";
}

// Render index.html
echo $twig->render('index.html.twig', ['login_link'=>$login_link, 'login_button'=>$login_button, 'profile_link'=> $profile_link, 'profile_button'=>$profile_button]);

$pages_for_all = ['advertisements', 'xss'];
$pages_for_logged = ['profile', 'add-advertisement', 'edit-advertisement'];
$pages_for_unlogged = ['login', 'registration'];

if (isset($_GET['page']) && (in_array($_GET['page'], $pages_for_all) || (in_array($_GET['page'], $pages_for_logged) && isset($_SESSION['uid'])) || (in_array($_GET['page'], $pages_for_unlogged) && !isset($_SESSION['uid'])))){
    include($_GET['page'] . '.php');
}
elseif (isset($_GET['page']) && !isset($_SESSION['login']) && (in_array($_GET['page'], $pages_for_logged))) {
    include('login.php');
}
elseif (!isset($_GET['page'])) {
    include('advertisements.php');
}
else {
    header('Location: /');
}
?>
