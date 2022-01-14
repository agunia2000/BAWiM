<?php

$stmt = $dbh->prepare("SELECT a.*, name FROM advertisements a JOIN users USING(uid) WHERE a.postcode = '00-000'");
$stmt->execute();
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

?>
<head>
    <link rel="stylesheet" href="/stylesheets/advs_style.css">
</head>

<div class="container mt-1">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <img class="big_img" src="<?php echo $path ?>" alt="">
                </div>
                <div class="col-md-4">
                    <br>
                    <p class="adv-data" style="font-size: 24px; font-weight: bold; font-family: Helvetica;"><?php echo $title ?></p>
                    <p class="adv-data" style="font-size: 28px; font-weight: bold;"><?php echo $price ?> PLN</p>
                    <p class="adv-data" style="font-size: 15px;">Kategoria: <?php echo $category ?></p>
                    <p class="adv-data" style="font-size: 15px;">Stan: <?php echo $status ?></p>
                </div>
                <div class="col-md-4">
                    <br> <br>
                    <p class="adv-info"> Użytkownik: <b style="font-size: 22px;"><?php echo $username ?></b></p>
                    <p class="adv-info"> Telefon: <b style="font-size: 22px;"><?php echo $phone_number ?></b></p>
                    <p class="adv-info"> Lokalizacja: <b style="font-size: 22px;"><?php echo $postcode . ', ' . $location ?></b></p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container mt-1">
    <div class="card">
        <div class="card-body">
            <p class="adv-data" style="font-size: 25px; font-weight: bold; ">Opis</p>
            <p class="adv-info" style="color: white; font-size: 20px;"><?php echo $description ?></p>
        </div>
        <br>
    </div>
</div>

<?php
}
?>