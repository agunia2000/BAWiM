<?php

if (isset($_GET['edit'])) {
    $message = '';
    $aid = intval($_GET['edit']);
    if (isset($_POST['edit_title']) && isset($_POST['edit_description']) && isset($_POST['edit_status']) && isset($_POST['edit_price']) && isset($_POST['edit_postcode']) && isset($_POST['edit_location']) && isset($_POST['edit_phone_number'])) {
        $edit_title = $_POST['edit_title'];
        $edit_description = $_POST['edit_description'];
        $edit_status = $_POST['edit_status'];
        $edit_price = $_POST['edit_price'];
        $edit_postcode = $_POST['edit_postcode'];
        $edit_location = $_POST['edit_location'];
        $edit_phone_number = $_POST['edit_phone_number'];

        if ($edit_title == '' || $edit_description == '' || $edit_status == '' || $edit_price == '' || $edit_postcode == '' || $edit_location == '' | $edit_phone_number == '') {
            $message = "Pola nie mogą być puste.";
        } else {
            if (strlen($edit_title) < 5) {
                $message = "Tytuł musi mieć co najmniej 5 znaków.";
            } else {
                if (strlen($edit_title) > 25) {
                    $message = "Tytuł może mieć co najwyżej 25 znaków.";
                } else {
                    if (!empty($_FILES["edit_picture"]["name"]) && !getimagesize($_FILES["edit_picture"]["tmp_name"])) {
                        $message = "Przesyłane zdjęcie jest nieprawidłowe.";
                    } else {
                        if (!empty($_FILES["edit_picture"]["name"]) && $_FILES["edit_picture"]["size"] > 5000000) {
                            $message = "Przesyłane zdjęcie jest za duże.";
                        } else {
                            if (strlen($edit_description) < 20) {
                                $message = "Opis musi mieć co najmniej 20 znaków.";
                            } else {
                                if (strlen($edit_description) > 9000) {
                                    $message = "Opis może mieć co najwyżej 9000 znaków.";
                                } else {
                                    if (!(preg_match('/^[0-9]{0,7}[,][0-9]{2}$/', $edit_price) || preg_match('/^[0-9]{0,7}$/', $edit_price))) {
                                        $message = "Nieprawidłowa cena, format ceny: 1234567,50";
                                    } else {
                                        if (!preg_match('/^([0-9]{2}-[0-9]{3})$/D', $edit_postcode)) {
                                            $message = "Podany kod pocztowy jest niepoprawny.";
                                        } else {
                                            if (strlen($edit_location) > 30) {
                                                $message = "Lokalizacja może mieć co najwyżej 30 znaków.";
                                            } else {
                                                if (!preg_match('/^[0-9]{9}$/', $edit_phone_number)) {
                                                    $message = "Podany numer telefonu jest niepoprawny.";
                                                } else {
                                                    try {
                                                        if (empty($_FILES["edit_picture"]["name"])) {
                                                            $stmt = $dbh->prepare('UPDATE advertisements SET title = :title, description = :description, status = :status, price = :price, postcode = :postcode, location = :location, phone_number = :phone_number WHERE aid = :aid AND uid = :uid');
                                                            $stmt->execute([':title' => $edit_title, ':description' => $edit_description, ':status' => $edit_status, ':price' => $edit_price, ':postcode' => $edit_postcode, ':location' => $edit_location, ':phone_number' => $edit_phone_number, ':aid' => $aid, ':uid' => $_SESSION['uid']]);
                                                        } else {
                                                            $edit_path = "uploads/" . generateRandomString() . "." . strtolower(pathinfo($_FILES["edit_picture"]["name"])['extension']);
                                                            move_uploaded_file($_FILES["edit_picture"]["tmp_name"], $edit_path);
                                                            $stmt = $dbh->prepare('UPDATE advertisements SET title = :title, path = :path, description = :description, status = :status, price = :price, postcode = :postcode, location = :location, phone_number = :phone_number WHERE aid = :aid AND uid = :uid');
                                                            $stmt->execute([':title' => $edit_title, ':path' => "/" . $edit_path, ':description' => $edit_description, ':status' => $edit_status, ':price' => $edit_price, ':postcode' => $edit_postcode, ':location' => $edit_location, ':phone_number' => $edit_phone_number, ':aid' => $aid, ':uid' => $_SESSION['uid']]);
                                                        }
                                                        header('Location: /profile');
                                                    } catch (PDOException $e) {
                                                        $message = "Nie udało się edytować ogłoszenia.";
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
    $stmt = $dbh->prepare("SELECT * FROM advertisements WHERE aid = :aid AND uid = :uid");
    $stmt->execute([':aid' => $aid, ':uid' => $_SESSION['uid']]);
    $advertisement = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($advertisement) {
        echo $twig->render('edit_advertisement.html.twig', ['message' => $message, 'aid' => $aid, 'title' => $advertisement['title'], 'category' => $advertisement['category'], 'path' => $advertisement['path'], 'description' => $advertisement['description'], 'status' => $advertisement['status'], 'price' => $advertisement['price'], 'postcode' => $advertisement['postcode'], 'location' => $advertisement['location'], 'phone_number' => $advertisement['phone_number']]);
    } else header('Location: /profile');
} else header('Location: /profile');

function generateRandomString($length = 20) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

