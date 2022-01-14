<?php

$stmt = $dbh->prepare("SELECT * FROM users WHERE uid = :uid");
$stmt->execute([':uid' => $_SESSION['uid']]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if($user){
    $message = '';
    if (isset($_POST['new_title']) && isset($_POST['new_category']) && isset($_POST['new_description']) && isset($_POST['new_status']) && isset($_POST['new_price']) && isset($_POST['new_postcode']) && isset($_POST['new_location']) && isset($_POST['new_phone_number'])) {
        $new_title = $_POST['new_title'];
        $new_category = $_POST['new_category'];
        $new_description = $_POST['new_description'];
        $new_status = $_POST['new_status'];
        $new_price = $_POST['new_price'];
        $new_postcode = $_POST['new_postcode'];
        $new_location = $_POST['new_location'];
        $new_phone_number = $_POST['new_phone_number'];

        if ($new_title == '' || $new_category == '' || $new_description == '' || $new_status == '' || $new_price == '' || $new_postcode == '' || $new_location == '' | $new_phone_number == '') {
            $message = "Pola nie mogą być puste.";
        } else {
            if (strlen($new_title) < 5) {
                $message = "Tytuł musi mieć co najmniej 5 znaków.";
            } else {
                if (strlen($new_title) > 25) {
                    $message = "Tytuł może mieć co najwyżej 25 znaków.";
                } else {
                    if (empty($_FILES["picture"]["name"])) {
                        $message = "Nie wybrano zdjęcia.";
                    } else {
                        if (!getimagesize($_FILES["picture"]["tmp_name"])) {
                            $message = "Przesyłane zdjęcie jest nieprawidłowe.";
                        } else {
                            if ($_FILES["picture"]["size"] > 5000000) {
                                $message = "Przesyłane zdjęcie jest za duże.";
                            } else {
                                if (strlen($new_description) < 20) {
                                    $message = "Opis musi mieć co najmniej 20 znaków.";
                                } else {
                                    if (strlen($new_description) > 9000) {
                                        $message = "Opis może mieć co najwyżej 9000 znaków.";
                                    } else {
                                        if (!(preg_match('/^[0-9]{0,7}[,][0-9]{2}$/', $new_price) || preg_match('/^[0-9]{0,7}$/', $new_price))) {
                                            $message = "Nieprawidłowa cena, format ceny: 1234567,50";
                                        } else {
                                            if (!preg_match('/^([0-9]{2}-[0-9]{3})$/D', $new_postcode)) {
                                                $message = "Podany kod pocztowy jest niepoprawny.";
                                            } else {
                                                if (strlen($new_location) > 30) {
                                                    $message = "Lokalizacja może mieć co najwyżej 30 znaków.";
                                                } else {
                                                    if (!preg_match('/^[0-9]{9}$/', $new_phone_number)) {
                                                        $message = "Podany numer telefonu jest niepoprawny.";
                                                    } else {
                                                        try {
                                                            $new_path = "uploads/" . generateRandomString() . "." . pathinfo($_FILES["picture"]["name"])['extension'];
                                                            move_uploaded_file($_FILES["picture"]["tmp_name"], $new_path);
                                                            $stmt = $dbh->prepare('INSERT INTO advertisements (aid, title, category, path, description, status, price, postcode, location, phone_number, uid, created) VALUES (null, :title, :category, :path, :description, :status, :price, :postcode, :location, :phone_number, :uid, NOW())');
                                                            $stmt->execute([':title' => $new_title, ':category' => $new_category, ':path' => "/" . $new_path, ':description' => $new_description, ':status' => $new_status, ':price' => $new_price, ':postcode' => $new_postcode, ':location' => $new_location, ':phone_number' => $new_phone_number, ':uid' => $_SESSION['uid']]);
                                                            header('Location: /profile');
                                                        } catch (PDOException $e) {
                                                            $message = "Nie udało się dodać ogłoszenia.";
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }
    echo $twig->render('add_advertisement.html.twig', ['message' => $message, 'postcode' => $user['postcode'], 'location' => $user['city'], 'phone_number' => $user['phone_number']]);
} else {
    header('Location: /logout');
}

function generateRandomString($length = 20) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

