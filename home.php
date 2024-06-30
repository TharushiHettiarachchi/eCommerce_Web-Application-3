<?php
session_start();
require "connection.php";
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
    <title>Sooper Vegan | Home</title>
</head>

<body class="body2 p-0 m-0">
    <div class="col-12 fixed-top bg-light">
        <?php require "header.php"; ?>
    </div>
    <div class="container-fluid p-0 m-0 pt-5">
        <div class="col-12 background1 p-0 m-0 pt-5 pt-lg-3" id="div" style="height: 90vh;">
            <div class="row">
                <div class="col-12 col-lg-6 p-lg-3 offset-lg-3 pt-5 pt-lg-3">
                    <div class="input-group mb-3 p-3 pt-5 p-lg-0">
                        <input type="text" id="bsearch" class="form-control" aria-label="Recipient's username" aria-describedby="button-addon2">
                        <button class="btn btn-outline-primary text-primary bg-light opacity-75 border-primary" type="button" id="button-addon2" onclick="searchb();">Search</button>
                    </div>
                </div>
                <div class="col-2 col-lg-1 offset-4 offset-lg-0 text-lg-start fw-bolder p-lg-3 mt-lg-2 text-danger text-lg-success text-center see" onclick="window.location = 'advancedSearch.php'">Advanced</div>
                <?php
                $delivery_rs = Database::search("SELECT * FROM `invoice` WHERE `status` = '2' AND `customer_mobile` = '" . $_SESSION["u"]["mobile"] . "'");
                $delivery_num = $delivery_rs->num_rows;
                for ($f = 0; $f < $delivery_num; $f++) {
                    $delivery_data = $delivery_rs->fetch_assoc();
                    $invoice_rs = Database::search("SELECT * FROM `products` WHERE `id` = '" . $delivery_data["products_id"] . "'");
                    $invoice_data = $invoice_rs->fetch_assoc();

                    if (isset($delivery_data["products_id"])) {
                ?>
                        <div class="col-12 mt-1">
                            <div class="row ps-3">
                                <div class="card col-6">
                                    <div class="card-header">
                                        Delivery Confirmation
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title">Order Id : <?php echo ($delivery_data["order_id"]);  ?></h5>
                                        <p class="card-text">Please click the "Recieved the Product" button soon after you recieve the product.</p>
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-2">
                                                    <img src="<?php echo ($invoice_data["pic"]);  ?>" style="height:100px ;" />
                                                </div>
                                                <div class="col-10">
                                                    <span class="fs-5"><?php echo ($invoice_data["product_name"]);  ?></span><br>
                                                    <div class="col-12">
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <span class=""><?php echo ($delivery_data["qty"]);  ?> Items</span><br>
                                                                <span class="">Rs. <?php echo ($delivery_data["total"]);  ?> .00</span>
                                                            </div>
                                                            <div class="col-6"><button href="#" class="btn btn-primary ms-5" onclick="delivered('<?php echo ($delivery_data['order_id']);  ?>');">Recieved the Product</button></div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php

                    } else {
                    ?>
                        <div class="col-12 mt-1">
                            <div class="row ps-3">
                                <div class="card col-6">
                                    <div class="card-header">
                                        Delivery Confirmation
                                    </div>
                                    <div class="card-body">
                                        <div class="col-12">
                                            <div class="row">

                                                <div class="card-title fs-3 col-6">Order Id : <?php echo ($delivery_data["order_id"]);  ?></div>
                                                <div class="col-6"><button href="#" class="btn btn-primary ms-5" onclick="delivered('<?php echo ($delivery_data['order_id']);  ?>');">Recieved the Product</button></div>
                                            </div>
                                        </div>
                                        <p class="card-text">Please click the "Recieved the Product" button soon after you recieve the product.</p>


                                        <?php
                                        $new_rs = Database::search("SELECT * FROM `order` WHERE `order_id` = '" . $delivery_data["order_id"] . "'");
                                        $new_num = $new_rs->num_rows;
                                        for ($j = 0; $j < $new_num; $j++) {
                                            $new_data = $new_rs->fetch_assoc();

                                            $product_rs = Database::search("SELECT * FROM `products` WHERE `id` = '" . $new_data["products_id"] . "'");
                                            $product_data = $product_rs->fetch_assoc();
                                            $product_rs1 = Database::search("SELECT * FROM `product_types` WHERE `id` = '" . $product_data["product_types_id"] . "'");
                                            $product_data1 = $product_rs1->fetch_assoc();

                                        ?>


                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="col-2">
                                                        <img src="<?php echo ($product_data["pic"]);  ?>" style="height:80px ;" />
                                                    </div>
                                                    <div class="col-10">
                                                        <span class="fs-5"><?php echo ($product_data["product_name"]);  ?></span><br>
                                                        <div class="col-12">
                                                            <div class="row">
                                                                <div class="col-6">
                                                                    <span class=""><?php echo ($delivery_data["qty"]);  ?> Items</span><br>
                                                                    <span class="">Rs. <?php echo ($delivery_data["total"]);  ?> .00</span>
                                                                </div>

                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>

                                        <?php


                                        }
                                        ?>

                                    </div>
                                </div>
                            </div>
                        </div>

                    <?php
                    }

                    ?>



                <?php
                }

                ?>
                <div class="col-12">
                    <div class="row align-items-center" id="box"></div>
                </div>
            </div>
        </div>

        <div class="col-12 pt-3 p-3">
            <div class="row border-primary border-2">
                <?php
                $category_rs = Database::search("SELECT * FROM `product_types`");
                $category_num = $category_rs->num_rows;
                for ($x = 0; $x < $category_num; $x++) {
                    $category_data = $category_rs->fetch_assoc();
                ?>
                    <div class="col-12">
                        <span class="fs-2 text-dark fw-bold"><?php echo ($category_data["product_type"])  ?></span>&nbsp;&nbsp;
                        <span class="fs-6 text-dark see" id="seemore<?php echo ($category_data["id"]);  ?>" onclick="seeMore(<?php echo ($category_data['id']);  ?>);">See More &RightArrow;</span>
                        <span class="fs-6 text-dark d-none see" onclick="seeMore(<?php echo ($category_data['id']);  ?>);" id="showless<?php echo ($category_data["id"]);  ?>">Show Less &UpArrow;</span>
                    </div>
                    <div class="col-12 mt-3">
                        <div class="row pb-3">
                            <?php
                            $product_rs = Database::search("SELECT * FROM `products` WHERE `product_types_id`='" . $category_data["id"] . "' LIMIT 5 ");
                            $product_num = $product_rs->num_rows;
                            for ($y = 0; $y < $product_num; $y++) {
                                $product_data = $product_rs->fetch_assoc();
                            ?>

                                <div class="col-6 offset-1 offset-md-3 offset-lg-0 col-lg-2 mt-3 me-5">
                                    <div class="card" style="height:525px; width:18rem;">
                                        <img onclick="view(<?php echo ($product_data['id'])  ?>);" src="<?php echo ($product_data["pic"])  ?>" class="card-img-top" style="height:190px ;">
                                        <div class="card-body">
                                            <div style="height:75px ;" class="card-title text-center fs-6 text-success fw-bold"><?php echo ($product_data["product_name"])  ?></div>
                                            <p class="card-text text-center col-12"> Rs. <?php echo ($product_data["price"]); ?>.00</p>
                                            <p class="card-text text-center col-12"><?php echo ($product_data["quantity"]); ?> Items available</p>
                                            <?php
                                            if ($product_data["quantity"] == 0) {
                                            ?>

                                                <div class="col-12 d-grid">
                                                    <div class="row pe-3 ps-3 pt-0">
                                                        <button class="btn btn-primary mt-3 col-12 col-lg-5" onclick="view(<?php echo ($product_data['id'])  ?>);" disabled>Buy Now</button>
                                                        <?php

                                                        $cart_rs = Database::search("SELECT * FROM `cart` WHERE `products_id`='" . $product_data["id"] . "' AND `customer_mobile` = '" . $user["mobile"] . "'");
                                                        $cart_num = $cart_rs->num_rows;
                                                        if ($cart_num == 1) {
                                                        ?>
                                                            <button class="btn btn-secondary mt-2 mt-lg-3 ms-lg-1 col-12 col-lg-6" id="s<?php echo ($product_data["id"])  ?>" onclick="cart(<?php echo ($product_data['id'])  ?>);" disabled>Added to Cart</button>
                                                        <?php
                                                        } else {
                                                        ?>

                                                            <button class="btn btn-primary mt-2 mt-lg-3 ms-lg-1 col-12 col-lg-6" id="s<?php echo ($product_data["id"])  ?>" onclick="cart(<?php echo ($product_data['id'])  ?>);">Add to Cart</button>

                                                        <?php
                                                        }
                                                        ?>
                                                        <?php

                                                        $watch_rs = Database::search("SELECT * FROM `watchlist` WHERE `customer_mobile` = '" . $user["mobile"] . "' AND `products_id` = '" . $product_data["id"] . "'");
                                                        $watch_num = $watch_rs->num_rows;
                                                        if ($watch_num == 1) {
                                                        ?>
                                                            <button class="btn btn-danger mt-2 mt-lg-3 col-12" id="w<?php echo ($product_data["id"])  ?>" onclick="watchlist(<?php echo ($product_data['id'])  ?>);" disabled>Added to Watchlist</button>
                                                        <?php
                                                        } else {
                                                        ?>

                                                            <button class="btn btn-warning mt-2 col-12" id="w<?php echo ($product_data["id"])  ?>" onclick="watchlist(<?php echo ($product_data['id'])  ?>);">Add to Watchlist</button>

                                                        <?php
                                                        }
                                                        ?>


                                                    </div>
                                                </div>



                                            <?php
                                            } else {
                                            ?>

                                                <div class="col-12 d-grid">
                                                    <div class="row pe-3 ps-3 pt-0">
                                                        <button class="btn btn-primary mt-3 col-12 col-lg-5" onclick="view(<?php echo ($product_data['id'])  ?>);">Buy Now</button>
                                                        <?php

                                                        $cart_rs = Database::search("SELECT * FROM `cart` WHERE `products_id`='" . $product_data["id"] . "' AND `customer_mobile` = '" . $user["mobile"] . "'");
                                                        $cart_num = $cart_rs->num_rows;
                                                        if ($cart_num == 1) {
                                                        ?>
                                                            <button class="btn btn-secondary mt-2 mt-lg-3 ms-lg-1 col-12 col-lg-6" id="s<?php echo ($product_data["id"])  ?>" onclick="cart(<?php echo ($product_data['id'])  ?>);" disabled>Added to Cart</button>
                                                        <?php
                                                        } else {
                                                        ?>

                                                            <button class="btn btn-primary mt-2 mt-lg-3 ms-lg-1 col-12 col-lg-6" id="s<?php echo ($product_data["id"])  ?>" onclick="cart(<?php echo ($product_data['id'])  ?>);">Add to Cart</button>

                                                        <?php
                                                        }
                                                        ?>
                                                        <?php

                                                        $watch_rs = Database::search("SELECT * FROM `watchlist` WHERE `products_id`='" . $product_data["id"] . "' AND `customer_mobile` = '" . $user["mobile"] . "'");
                                                        $watch_num = $watch_rs->num_rows;
                                                        if ($watch_num == 1) {
                                                        ?>
                                                            <button class="btn btn-danger mt-2 mt-lg-3 ms-lg-1 col-11" id="w<?php echo ($product_data["id"])  ?>" onclick="watchlist(<?php echo ($product_data['id'])  ?>);" disabled>Added to Watchlist</button>
                                                        <?php
                                                        } else {
                                                        ?>

                                                            <button class="btn btn-warning mt-2 col-lg-11" id="w<?php echo ($product_data["id"])  ?>" onclick="watchlist(<?php echo ($product_data['id'])  ?>);">Add to Watchlist</button>

                                                        <?php
                                                        }
                                                        ?>


                                                    </div>
                                                </div>





                                            <?php
                                            }

                                            ?>




                                        </div>
                                    </div>
                                </div>
                            <?php
                            }
                            $row = 5;
                            $product1_rs = Database::search("SELECT * FROM `products` WHERE `product_types_id` = '" . $category_data["id"] . "' LIMIT 20 OFFSET " . $row . "");
                            $product1_num = $product1_rs->num_rows;
                            ?>
                            <div class="col-12 d-none" id="<?php echo ($category_data["id"]);  ?>">
                                <div class="row">

                                    <?php
                                    for ($z = 0; $z < $product1_num; $z++) {
                                        $product1_data = $product1_rs->fetch_assoc();
                                    ?>
                                        <div class="col-12 offset-2 offset-lg-0 col-lg-2 mt-3 me-5">
                                            <div class="card" style="width: 18rem; height:500px;">
                                                <img src="<?php echo ($product1_data["pic"])  ?>" class="card-img-top" style="height:190px ;">
                                                <div class="card-body">
                                                    <div style="height: 75px;" class="card-title text-center fs-6 text-success fw-bold"><?php echo ($product1_data["product_name"])  ?></div>
                                                    <p class="card-text text-center col-12"> Rs.<?php echo ($product1_data["price"]) ?>.00</p>
                                                    <p class="card-text text-center col-12"> <?php echo ($product1_data["quantity"]) ?> Items available</p>
                                                    <?php

                                                    if ($product1_data["quantity"] == 0) {
                                                    ?>
                                                        <div class="col-12 d-grid">
                                                            <div class="row pe-3 ps-3 sticky-bottom">
                                                                <button class="btn btn-primary mt-3 col-12 col-lg-5" onclick="view(<?php echo ($product1_data['id'])  ?>);" disabled>Buy Now</button>
                                                                <?php
                                                                $cart1_rs = Database::search("SELECT * FROM `cart` WHERE `products_id`='" . $product1_data["id"] . "'");
                                                                $cart1_num = $cart1_rs->num_rows;
                                                                if ($cart1_num == 1) {
                                                                ?>
                                                                    <button class="btn btn-secondary mt-2 mt-lg-3 ms-lg-1 col-12 col-lg-6" id="s<?php echo ($product1_data["id"])  ?>" onclick="cart(<?php echo ($product1_data['id'])  ?>);" disabled>Added to Cart</button>
                                                                <?php
                                                                } else {
                                                                ?>

                                                                    <button class="btn btn-primary mt-2 mt-lg-3 ms-lg-1 col-12 col-lg-6" id="s<?php echo ($product1_data["id"])  ?>" onclick="cart(<?php echo ($product1_data['id'])  ?>);">Add to Cart</button>

                                                                <?php
                                                                }
                                                                ?>

                                                                <?php

                                                                $watch1_rs = Database::search("SELECT * FROM `watchlist` WHERE `products_id`='" . $product1_data["id"] . "'");
                                                                $watch1_num = $watch1_rs->num_rows;
                                                                if ($watch1_num == 1) {
                                                                ?>
                                                                    <button class="btn btn-danger mt-2 mt-lg-3 ms-lg-1 col-12" id="w<?php echo ($product1_data["id"])  ?>" onclick="watchlist(<?php echo ($product1_data['id'])  ?>);" disabled>Added to Watchlist</button>
                                                                <?php
                                                                } else {
                                                                ?>

                                                                    <button class="btn btn-warning mt-2 col-lg-11" id="w<?php echo ($product1_data["id"])  ?>" onclick="watchlist(<?php echo ($product1_data['id'])  ?>);">Add to Watchlist</button>

                                                                <?php
                                                                }
                                                                ?>
                                                            </div>
                                                        </div>



                                                    <?php
                                                    } else {
                                                    ?>

                                                        <div class="col-12 d-grid">
                                                            <div class="row pe-3 ps-3 sticky-bottom">
                                                                <button class="btn btn-primary mt-3 col-12 col-lg-5" onclick="view(<?php echo ($product1_data['id'])  ?>);">Buy Now</button>
                                                                <?php
                                                                $cart1_rs = Database::search("SELECT * FROM `cart` WHERE `products_id`='" . $product1_data["id"] . "'");
                                                                $cart1_num = $cart1_rs->num_rows;
                                                                if ($cart1_num == 1) {
                                                                ?>
                                                                    <button class="btn btn-secondary mt-2 mt-lg-3 ms-lg-1 col-12 col-lg-6" id="s<?php echo ($product1_data["id"])  ?>" onclick="cart(<?php echo ($product1_data['id'])  ?>);" disabled>Added to Cart</button>
                                                                <?php
                                                                } else {
                                                                ?>

                                                                    <button class="btn btn-primary mt-2 mt-lg-3 ms-lg-1 col-12 col-lg-6" id="s<?php echo ($product1_data["id"])  ?>" onclick="cart(<?php echo ($product1_data['id'])  ?>);">Add to Cart</button>

                                                                <?php
                                                                }
                                                                ?>

                                                                <?php

                                                                $watch1_rs = Database::search("SELECT * FROM `watchlist` WHERE `products_id`='" . $product1_data["id"] . "'");
                                                                $watch1_num = $watch1_rs->num_rows;
                                                                if ($watch1_num == 1) {
                                                                ?>
                                                                    <button class="btn btn-danger mt-2 mt-lg-3 ms-lg-1 col-12" id="w<?php echo ($product1_data["id"])  ?>" onclick="watchlist(<?php echo ($product1_data['id'])  ?>);" disabled>Added to Watchlist</button>
                                                                <?php
                                                                } else {
                                                                ?>

                                                                    <button class="btn btn-warning mt-2 col-lg-11" id="w<?php echo ($product1_data["id"])  ?>" onclick="watchlist(<?php echo ($product1_data['id'])  ?>);">Add to Watchlist</button>

                                                                <?php
                                                                }
                                                                ?>
                                                            </div>
                                                        </div>




                                                    <?php
                                                    }


                                                    ?>




                                                </div>
                                            </div>
                                        </div>

                                    <?php
                                    }
                                    ?>


                                </div>
                            </div>

                        </div>


                    </div>




                <?php



                }

                ?>





            </div>
        </div>
    </div>



    <?php require "footer.php"; ?>





    <script src="script.js"></script>
    <script src="bootstrap.js"></script>
    <script src="bootstrap.bundle.js"></script>
</body>

</html>