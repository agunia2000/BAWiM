<?php

echo $twig->render('advertisements_header.html.twig');


// Remove advertisement
if (isset($_GET['remove']) && intval($_GET['remove']) > 0) {
    $aid = intval($_GET['remove']);
    $stmt = $dbh->prepare("DELETE FROM advertisements WHERE aid = :aid AND uid = :uid");
    $stmt->execute([':aid' => $aid, ':uid' => $_SESSION['uid']]);
    header('Location: /profile');
}

// Advertisement details
else if (isset($_GET['show']) && intval($_GET['show']) > 0) {
    $aid = intval($_GET['show']);
    $stmt = $dbh->prepare("SELECT a.*, name FROM advertisements a JOIN users USING(uid) WHERE aid = :aid");
    $stmt->execute([':aid' => $aid]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($row) {
        $title = $row['title'];
        $category = $row['category'];
        $path = $row['path'];
        $description = $row['description'];
        $status = $row['status'];
        $price = $row['price'];
        $postcode = $row['postcode'];
        $location = $row['location'];
        $phone_number = $row['phone_number'];
        $username = $row['name'];

        echo $twig->render('advertisement_details.html.twig', [
            'aid' => $aid,
            'title' => $title,
            'category' => $category,
            'path' => $path,
            'description' => $description,
            'status' => $status,
            'price' => $price,
            'postcode' => $postcode,
            'location' => $location,
            'phone_number' => $phone_number,
            'username' => $username,
        ]);
    }
}

// Search for given advertisement
else if(isset($_POST['searching_submit'])){
    echo $twig->render('advertisements_return.html.twig', []);

    $searched_title = "%" . $_POST['title'] . "%";
    $searched_location = "%" . $_POST['location'] . "%";
    $searched_category = "%" . $_POST['category'] . "%";
    $stmt = $dbh->prepare("SELECT * FROM advertisements WHERE title LIKE :title AND category LIKE :category AND (location LIKE :location OR postcode LIKE :location) ORDER BY created DESC");
    $stmt -> execute([':title' => $searched_title, ':location' => $searched_location, ':category' => $searched_category]);

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $aid = $row['aid'];
        $title = $row['title'];
        $path = $row['path'];
        $price = $row['price'];
        $postcode = $row['postcode'];
        $location = $row['location'];
        $date = new DateTime($row['created']);
        $monthNamesPL = array("stycznia", "lutego", "marca", "kwietnia", "maja", "czerwca", "lipca", "sierpnia", "września", "października", "listopada", "grudnia");
        $monthName = $monthNamesPL[intval($date->format('m'))-1];
        $created = intval($date->format('d')) . ' ' . $monthName . ' ' . $date->format('Y');

        echo $twig->render('advertisements.html.twig', [
            'aid' => $aid,
            'title' => $title,
            'path' => $path,
            'price' => $price,
            'postcode' => $postcode,
            'location' => $location,
            'created' => $created
        ]);
    }
}

// Showing all the advertisement when id is not given
else {
    echo $twig->render('advertisement_searching.html.twig', []);

    $stmt = $dbh->prepare("SELECT * FROM advertisements ORDER BY created DESC");
    $stmt->execute();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $aid = $row['aid'];
        $title = $row['title'];
        $path = $row['path'];
        $price = $row['price'];
        $postcode = $row['postcode'];
        $location = $row['location'];
        $date = new DateTime($row['created']);
        $monthNamesPL = array("stycznia", "lutego", "marca", "kwietnia", "maja", "czerwca", "lipca", "sierpnia", "września", "października", "listopada", "grudnia");
        $monthName = $monthNamesPL[intval($date->format('m'))-1];
        $created = intval($date->format('d')) . ' ' . $monthName . ' ' . $date->format('Y');

        echo $twig->render('advertisements.html.twig', [
            'aid' => $aid,
            'title' => $title,
            'path' => $path,
            'price' => $price,
            'postcode' => $postcode,
            'location' => $location,
            'created' => $created
        ]);
    }
}
