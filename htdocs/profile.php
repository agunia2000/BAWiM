<?php

$stmt = $dbh->prepare("SELECT * FROM users WHERE uid = :uid");
$stmt->execute([':uid' => $_SESSION['uid']]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if($user) {
    $current_tab = "";

    //My advertisements:
    $stmt = $dbh->prepare("SELECT * FROM advertisements WHERE uid = :uid");
    $stmt->execute([':uid' => $_SESSION['uid']]);
    $my_advertisements = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $advertisement = array(
            'aid' => $row['aid'],
            'title' => $row['title'],
            'price' => $row['price'],
        );
        array_push($my_advertisements, $advertisement);
    }

    //Password changing:
    $message = "";
    if (isset($_POST['current_password']) && isset($_POST['changed_password']) && isset($_POST['changed_password_repeat'])) {

        $current_password = $_POST['current_password'];
        $changed_password = $_POST['changed_password'];
        $changed_password_repeat = $_POST['changed_password_repeat'];
        $current_tab = "account_info";

        if ($current_password == '' || $changed_password == '' || $changed_password_repeat == '') {
            $message = "Pola nie mogą być puste.";
        } else {
            if (password_verify($current_password, $user['password']) == false) {
                $message = "Aktualne hasło jest niepoprawne.";
            } elseif (strcmp($changed_password, $changed_password_repeat) !== 0) {
                $message = "Nowe hasła różnią się.";
            } elseif (strlen($changed_password) < 6) {
                $message = "Hasło musi mieć co najmniej 6 znaków.";
            } else {
                $changed_password = crypt($changed_password, '$1$salt$');
                $stmt = $dbh->prepare('UPDATE users SET password = :password WHERE uid = :uid');
                $stmt->execute([':password' => $changed_password, ':uid' => $user['uid']]);
                $message = "Hasło zostało zmienione.";
            }
        }
    }

    //Personal information changing:
    $name = $user['name'];
    $surname = $user['surname'];
    $postcode = $user['postcode'];
    $city = $user['city'];
    $email = $user['email'];
    $phone_number = $user['phone_number'];
    $message2 = "";

    if (isset($_POST['changed_name']) && isset($_POST['changed_surname']) && isset($_POST['changed_postcode']) && isset($_POST['changed_city']) && isset($_POST['changed_phone_number']) && isset($_POST['changed_email'])) {

        $changed_name = $_POST['changed_name'];
        $changed_surname = $_POST['changed_surname'];
        $changed_postcode = $_POST['changed_postcode'];
        $changed_city = $_POST['changed_city'];
        $changed_email = $_POST['changed_email'];
        $changed_phone_number = $_POST['changed_phone_number'];
        $current_tab = "private_info";

        if ($changed_name == '' || $changed_surname == '' || $changed_postcode == '' || $changed_city == '' || $changed_email == '' || $changed_phone_number == '') {
            $message2 = "Pola nie mogą być puste.";
        } else {
            if (!preg_match('/^([0-9]{2}-[0-9]{3})$/D', $changed_postcode)) {
                $message2 = "Podany kod pocztowy jest niepoprawny.";
            } else {
                if (strlen($changed_city) > 30) {
                    $message2 = "Miejscowość może mieć co najwyżej 30 znaków.";
                } else {
                    if (!preg_match('/^[a-zA-Z0-9\-\_\.]+\@[a-zA-Z0-9\-\_\.]+\.[a-zA-Z]{2,5}$/D', $changed_email)) {
                        $message2 = "Podany email jest niepoprawny.";
                    } else {
                        if (!preg_match('/^[0-9]{9}$/', $changed_phone_number)) {
                            $message2 = "Podany numer telefonu jest niepoprawny.";
                        } else {
                            try {
                                $stmt_2 = $dbh->prepare('UPDATE users SET name = :name, surname = :surname, postcode = :postcode, city = :city, phone_number = :phone_number, email = :email WHERE uid = :uid');
                                $stmt_2->execute([':name' => $changed_name, ':surname' => $changed_surname, ':postcode' => $changed_postcode, ':city' => $changed_city, ':phone_number' => $changed_phone_number, ':email' => $changed_email, ':uid' => $user['uid']]);
                                $message2 = "Dane zostały zmienione.";
                                $name = $changed_name;
                                $surname = $changed_surname;
                                $postcode = $changed_postcode;
                                $city = $changed_city;
                                $email = $changed_email;
                                $phone_number = $changed_phone_number;
                            } catch (PDOException $e) {
                                $message2 = "Podany email jest już zajęty.";
                            }
                        }
                    }
                }
            }
        }
    }

    // Deleting account:
    $message3 = "";

    if (isset($_POST['password_confirm'])) {
        $password_confirm = $_POST['password_confirm'];
        $current_tab = "delete_account";

        if ($password_confirm == "") {
            $message3 = "Musisz podać hasło.";
        } else {
            if (password_verify($password_confirm, $user['password'])) {
                $stmt = $dbh->prepare('DELETE FROM users WHERE uid = :uid');
                $stmt->execute([':uid' => $user['uid']]);
                header('Location: /logout');
            } else {
                $message3 = "Podane hasło jest błędne.";
            }
        }
    }


    echo $twig->render('profile.html.twig', [
        /*data to advertisements:*/
        'my_advertisements' => $my_advertisements,

        /*data to password changing*/
        'message_password' => $message,

        /*data to personal info changing */
        'name' => $name,
        'surname' => $surname,
        'postcode' => $postcode,
        'city' => $city,
        'phone_number' => $phone_number,
        'email' => $email,
        'message_user' => $message2,

        /*data to deleting an account*/
        'message_delete' => $message3,

        'current_tab' => $current_tab
    ]);

} else {
    header('Location: /logout');
}

