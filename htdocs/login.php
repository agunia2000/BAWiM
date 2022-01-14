<?php

$message = '';

if (isset($_POST['login']) && isset($_POST['password'])) {
    if ($_POST['login'] == '' || $_POST['password'] == '') {
        $message = "Pola nie mogą być puste.";
    } else {
        $login = $_POST['login'];
        $password = crypt($_POST['password'], '$1$salt$');
        $sql = $dbh->query("SELECT * FROM users WHERE email = '$login' AND password = '$password'");
        $user = $sql->fetch(PDO::FETCH_ASSOC);
        if ($user) {
            $_SESSION['uid'] = $user['uid'];
            $_SESSION['email'] = $user['email'];
            header('Location: /');
        } else $message = "Niepoprawne dane.";
    }
}

echo $twig->render('login.html.twig', ['message'=>$message]);

