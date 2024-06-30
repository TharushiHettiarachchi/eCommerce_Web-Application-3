<?php
session_start();
$user = $_SESSION["u"];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />
    <link rel="icon" href="resource/icon.jpg" />
    <title>Sooper Vegan | Recent</title>
</head>

<body class="body">
    <div class="col-12 fixed-top bg-light">
        <?php require "header.php"; ?>
    </div>
    <?php require "header.php"; ?>
    <div class="container-fluid" style="background-color: #A8E890;">
        <div class="col-12">
            <div class="row">
                <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="home.php" class="text-success">Home</a></li>
                        <li class="breadcrumb-item"><a href="watchlist.php"  class="text-success">Watchlist</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Recent</li>
                    </ol>
                </nav>
                <div class="col-12 fs-1 text-dark text-center">Recent</div>
                <div class="col-7">
                    <div class="row">
                        <div class="input-group mb-3 offset-4">
                            <input type="text" class="form-control" placeholder="Search in Watchlist" aria-label="Recipient's username" aria-describedby="button-addon2">
                            <button class="btn btn-outline-secondary" type="button" id="button-addon2"><i class="bi bi-search fs-5"></i></button>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="row">
                        <div class="col-12 col-lg-2">
                            <div class="row p-3">
                                <div class="col-12 btn btn-success mt-3" onclick="window.location = 'watchlist.php';">Watchlist</div>
                                <div class="col-12 btn btn-success mt-3" onclick="window.location ='cart.php';">Cart</div>
                                <div class="col-12 btn btn-success mt-3" onclick="window.location ='recent.php';">Recent</div>
                            </div>
                        </div>
                        <div class="col-10">
                            <div class="row">
                                <?php
                                require "connection.php";

                                $watch_rs = Database::search("SELECT * FROM `recent` WHERE `customer_mobile`='" . $user["mobile"] . "'");
                                $watch_num = $watch_rs->num_rows;
                                if ($watch_num == 0) {
                                ?>
                                <div class="row d-flex align-items-center justify-content-center">
                                    <div class="col-12 text-center fw-bold fs-1 d-flex align-items-center justify-content-center" style="height:200px;">
                                        No Recent Items Yet.
                                    </div>
                                </div>
                                    <?php
                                } else {

                                    for ($x = 0; $x < $watch_num; $x++) {
                                        $watch_data = $watch_rs->fetch_assoc();
                                        $product_rs = Database::search("SELECT * FROM `products` WHERE `id` = '" . $watch_data["products_id"] . "'");
                                        $product_data = $product_rs->fetch_assoc();
                                    ?>

                                        <div class="col-8 offset-2 offset-lg-0 col-lg-6">
                                            <div class="card mb-3" style="max-width: 540px;">
                                                <div class="row g-0">
                                                    <div class="col-md-4">
                                                        <img src="<?php echo ($product_data["pic"]); ?>" class="img-fluid rounded-start h-100">
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="card-body">
                                                            <h5 class="card-title text-center"><?php echo ($product_data["product_name"]); ?>"</h5>
                                                            <p class="card-text text-center col-12"> Rs. <?php echo ($product_data["price"]); ?> .00</p>
                                                            <p class="card-text text-center col-12"> <?php echo ($product_data["quantity"]); ?> Items available</p>
                                                            <div class="col-12 d-grid">
                                                                <div class="row pe-3 ps-3">
                                                                    <button class="btn btn-success mt-3 col-12 col-lg-5">Buy Now</button>
                                                                    <button class="btn btn-warning mt-2 mt-lg-3 ms-lg-1 col-12 col-lg-6" onclick="removeWatch2(<?php echo ($watch_data['products_id']) ?>);">Remove</button>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                <?php

                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>



    <?php require "footer.php"; ?>





    <script src="script.js"></script>
    <script src="bootstrap.js"></script>
    <script src="bootstrap.bundle.js"></script>
</body>

</html>