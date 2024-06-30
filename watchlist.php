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
    <title>Sooper Vegan | Watchlist</title>
</head>

<body class="body">
    <div class="col-12 fixed-top bg-light">
        <?php require "header.php"; ?>
    </div>

    <div class="container-fluid pt-5" style="background-color:#A8E890">
        <div class="col-12 pt-5 pt-lg-3">
            <div class="row pt-5 pt-lg-0">
                <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="home.php" class="text-success">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Watchlist</li>
                    </ol>
                </nav>
                <div class="col-12 fs-1 text-dark text-center"> <i class="bi bi-heart"></i>&nbsp;Watchlist</div>
                <div class="col-lg-7">
                    <div class="row">
                        <div class="input-group mb-3 offset-lg-4">
                            <input type="text" class="form-control border" style="border-color: gray;" placeholder="Search in Watchlist" aria-label="Recipient's username" aria-describedby="button-addon2">
                            <button class="btn border bg-light" style="border-color: gray;" type="button" id="button-addon2"><i class="bi bi-search fs-5"></i></button>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="row">
                        <div class=" col-12 col-lg-2">
                            <div class="row p-3">
                                <div class="col-12 btn btn-success mt-3" onclick="window.location = 'watchlist.php';">Watchlist</div>
                                <div class="col-12 btn btn-success mt-3" onclick="window.location ='cart.php';">Cart</div>
                                <div class="col-12 btn btn-success mt-3" onclick="window.location ='recent.php';">Recent</div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-10">
                            <div class="row">
                                <?php

                                require "connection.php";

                                $watch_rs = Database::search("SELECT * FROM `watchlist` WHERE `customer_mobile`='" . $user["mobile"] . "'");
                                $watch_num = $watch_rs->num_rows;
                                if ($watch_num == 0) {
                                ?>
                                    <div class="col-12 text-center p-3"><img src="resource/cartadd.png" style="height: 100px;" /></i></div>
                                    <div class="col-12 text-center fs-2 p-3">You have not added any product to the Watchlist yet.</div>
                                    <div class="col-12 p-3">
                                        <a href="home.php" class="btn btn-success col-4 offset-4 ">Start Shopping</a>
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
                                                                    <?php
                                                                    if ($product_data["quantity"] == 0) {
                                                                    ?>
                                                                        <button class="btn btn-success mt-3 col-12 col-lg-5" onclick="view('<?php echo ($watch_data['products_id']); ?>');" disabled>Buy Now</button>
                                                                    <?php
                                                                    } else {
                                                                    ?>
                                                                        <button class="btn btn-success mt-3 col-12 col-lg-5" onclick="view('<?php echo ($watch_data['products_id']); ?>');">Buy Now</button>
                                                                    <?php
                                                                    }
                                                                    ?>

                                                                    <button class="btn btn-warning mt-2 mt-lg-3 ms-lg-1 col-12 col-lg-6" onclick="removeWatch('<?php echo ($watch_data['products_id']) ?>');">Remove</button>

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