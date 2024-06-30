<?php
require "connection.php";
session_start();
$id = $_SESSION["p"];

if (isset($_GET["qty"])) {
    $qtyValue  = $_GET["qty"];
} else {
    $qtyValue = 1;
}
$product_rs = Database::search("SELECT * FROM `products` WHERE `id` = '" . $id . "'");
$product_data = $product_rs->fetch_assoc();
$category_rs = Database::search("SELECT * FROM `product_types`WHERE `id` = '" . $product_data["product_types_id"] . "'");
$category_data = $category_rs->fetch_assoc();
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
    <title>Sooper Vegan | <?php echo ($product_data["product_name"]);  ?> </title>
</head>

<body class="body2 p-0 m-0">
    <div class="col-12 fixed-top bg-light">
        <?php require "header.php"; ?>
    </div>
    <?php require "header.php"; ?>
    <div class="container-fluid p-0 m-0 ">
        <div class="row p-3">
            <?php


            ?>
            <div class="col-12">
                <div class="row">
                    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="home.php" class="text-success fw-bold">Home</a></li>
                            <li class="breadcrumb-item active text-secondary" aria-current="page"><?php echo ($product_data["product_name"]);  ?></li>
                        </ol>
                    </nav>

                </div>
            </div>

            <div class="col-12" id="p1">
                <div class="row">
                    <div class="col-12 col-lg-6">
                        <img id="image" src="<?php echo ($product_data["pic"]);  ?>" class="col-12" style="width:80%;" />
                    </div>
                    <div class="col-lg-6 col-12">
                        <div class="row">
                            <p class="text-center fw-bold fs-2 col-12" id="title"><?php echo ($product_data["product_name"]);  ?></p>
                            <div class="col-lg-3 col-4 text-end fw-bold mt-5">Product Type :</div>
                            <div class="col-lg-9 col-8 text-start mt-5" id="brand"><?php echo ($category_data["product_type"]);  ?></div>
                            <div class="col-lg-3 col-4 text-end fw-bold mt-4">Price :</div>
                            <div class="col-lg-9 col-8 text-start text-success fs-2 mt-3" id="price">Rs. <?php echo ($product_data["price"]);  ?>.00</div>
                            <div class="col-lg-3 col-4 text-end fw-bold mt-2">Quantity :</div>
                            <div class="col-lg-9 col-8 text-start text-danger fs-4 mt-1" id="quantity"><?php echo ($product_data["quantity"]);  ?> Products Available</div>
                            <div class="col-lg-3 col-4 text-end fw-bold mt-4">Description :</div>
                            <div class="col-lg-9 col-8 text-start mt-4" id="description"><?php echo ($product_data["description"]);  ?></div>
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-lg-3 col-4 text-end fw-bold mt-4">Quantity :</div>
                                    <div class="col-lg-9 col-8">
                                        <input type="number" min="0" id="qty" class="form-control mt-4" value="<?php echo ($qtyValue); ?>" onchange="qtycon(<?php echo ($product_data['quantity']); ?>);" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 pt-3">
                                <div class="row mt-3">
                                    <div class="col-1 offset-3">
                                        <img src="resource/pay_img/american_express_img.png" class="col-12" />
                                    </div>
                                    <div class="col-1">
                                        <img src="resource/pay_img/mastercard_img.png" class="col-12" />
                                    </div>
                                    <div class="col-1">
                                        <img src="resource/pay_img/paypal_img.png" class="col-12" />
                                    </div>
                                    <div class="col-1">
                                        <img src="resource/pay_img/visa_img.png" class="col-12" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 offset-2 pt-3">
                                <button class="col-9 btn btn-success" onclick="payNow(<?php echo ($product_data['id']); ?>)" type="submit" id="payhere-payment">Buy Now</button>
                                <!-- <button class="col-9 btn btn-success" type="submit" onclick="payModalDisplay('<?php echo ($product_data['price']); ?>');">Buy Now</button> -->
                            </div>

                            <!-- pay modal -->
                            <div class="modal" tabindex="-1" id="payModal">
                                <div class="modal-dialog modal-dialog-centered pb-5 rounded-5" style="max-width: 350px; font-family:Arial;">
                                    <div class="modal-content">
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-12 rounded-top" style="height: 130px; background-color:#2446D7;">
                                                    <div class="row pt-2 pb-4 ps-3">
                                                        <div class="col-12 d-flex justify-content-end">
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="col-3 bg-light d-flex align-items-center justify-content-center rounded-circle" style="height: 80px;">
                                                            <img src="resource/paylogo.jpg" height="20px" />
                                                        </div>
                                                        <div class="col-9">
                                                            <div class="row text-light">
                                                                <div class="col-12 fs-5">E-Outlet</div>
                                                                <div class="col-12" style="font-size: 10px;"><?php echo ($product_data["product_name"]);  ?></div>
                                                                <div class="col-12 fw-bold fs-3" id="setPrice"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 bg-light rounded-bottom">
                                                    <div class="row p-4">
                                                        <div class="col-12 text-secondary py-3">SELECT A PAYMENT METHOD</div>
                                                        <div class="col-12 py-1">Credit/Debit Card</div>
                                                        <div class="col-12 pb-4">
                                                            <div class="row">
                                                                <div class="col-2 rounded-1 d-flex align-items-center justify-content-center ms-2" style="background-color: #E5E5E5;" onclick="payModalDisplay2();"><img src="resource/pay_img/visa.png" style="height: 50px;" /></div>
                                                                <div class="col-2 d-flex align-items-center justify-content-center ms-2" style="background-color: #E5E5E5;"><img src="resource/pay_img/mastercard_img.png" style="height: 50px;" /></div>
                                                                <div class="col-2 rounded-1 d-flex align-items-center justify-content-center ms-2" style="background-color: #E5E5E5;"><img src="resource/pay_img/american_express_img.png" style="height: 50px;" /></div>
                                                                <div class="col-2 rounded-1 d-flex align-items-center justify-content-center ms-2" style="background-color: #E5E5E5;"><img src="resource/pay_img/discover.png" style="height: 50px;" /></div>
                                                                <div class="col-2 rounded-1 d-flex align-items-center justify-content-center ms-2" style="background-color: #E5E5E5;"><img src="resource/pay_img/diner_club.png" style="height: 50px;" /></div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 py-1">Mobile Wallet</div>
                                                        <div class="col-12 pb-4">
                                                            <div class="row">
                                                                <div class="col-2 rounded-1 d-flex align-items-center justify-content-center ms-2" style="background-color: #E5E5E5;"><img src="resource/pay_img/genie.png" style="height: 50px;" /></div>
                                                                <div class="col-2 rounded-1 d-flex align-items-center justify-content-center ms-2" style="background-color: #E5E5E5;"><img src="resource/pay_img/ecash.png" style="height: 50px;" /></div>
                                                                <div class="col-2 rounded-1 d-flex align-items-center justify-content-center ms-2" style="background-color: #E5E5E5;"><img src="resource/pay_img/mcash.JPG" style="height: 20px;" /></div>
                                                                <div class="col-2 rounded-1 d-flex align-items-center justify-content-center ms-2" style="background-color: #E5E5E5;"><img src="resource/pay_img/frimi.png" style="height: 40px;" /></div>
                                                            </div>
                                                        </div>

                                                        <div class="col-12 py-1">Internet Banking</div>
                                                        <div class="col-12">
                                                            <div class="row">
                                                                <div class="col-2 rounded-1 d-flex align-items-center justify-content-center ms-2" style="background-color: #E5E5E5;"><img src="resource/pay_img/sampath.png" style="height: 50px;" /></div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- paymodal -->

                            <!-- pay modal 2-->
                            <div class="modal" tabindex="-1" id="payModal1">
                                <div class="modal-dialog modal-dialog-centered pb-5 rounded-5" style="max-width: 350px; font-family:Arial;">
                                    <div class="modal-content">
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-12 rounded-top" style="height: 130px; background-color:#2446D7;">
                                                    <div class="row pt-2 pb-4 ps-3">
                                                        <div class="col-12 d-flex justify-content-end">
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="col-3 bg-light d-flex align-items-center justify-content-center rounded-circle" style="height: 80px;">
                                                            <img src="resource/paylogo.jpg" height="20px" />
                                                        </div>
                                                        <div class="col-9">
                                                            <div class="row text-light">
                                                                <div class="col-12 fs-5">E-Outlet</div>
                                                                <div class="col-12" style="font-size: 10px;"><?php echo ($product_data["product_name"]);  ?></div>
                                                                <div class="col-12 fw-bold fs-3">Rs. <?php echo ($product_data["price"]);  ?>.00</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 bg-light rounded-bottom">
                                                    <div class="row p-4">
                                                        <div class="col-12 text-secondary py-3">Bank Card</div>
                                                        <div class="col-12 pb-3">
                                                            <input type="text" class="form-control border border-0" placeholder="Name on Card" style="border-radius: 0px; background-color:#E5E5E5"/>
                                                        </div>
                                                        <div class="col-12 pb-3">
                                                            <input type="text" class="form-control border border-0" placeholder="Card Number" style="border-radius: 0px; background-color:#E5E5E5" maxlength="16" />
                                                        </div>
                                                        <div class="col-12 pb-3">
                                                            <input type="text" class="form-control border border-0" placeholder="CVV" style="border-radius: 0px; background-color:#E5E5E5" maxlength="3"/>
                                                        </div>
                                                        <div class="col-12 pb-3">
                                                            <input type="text" class="form-control border border-0" placeholder="Expiry MM/YY" style="border-radius: 0px; background-color:#E5E5E5" maxlength="5" />
                                                        </div>

                                                        <div class="col-12 d-grid">
                                                            <button class="btn text-light" style="background-color:#FCAC01;" onclick="payModalDisplay3();">Pay</button>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- paymodal 2-->

                             <!-- pay modal 3-->
                             <div class="modal" tabindex="-1" id="payModal2">
                                <div class="modal-dialog modal-dialog-centered pb-5 rounded-5" style="max-width: 350px; font-family:Arial;">
                                    <div class="modal-content">
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-12 rounded-top" style="height: 130px; background-color:#2446D7;">
                                                    <div class="row pt-2 pb-4 ps-3">
                                                        <div class="col-12 d-flex justify-content-end">
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="col-3 bg-light d-flex align-items-center justify-content-center rounded-circle" style="height: 80px;">
                                                            <img src="resource/paylogo.jpg" height="20px" />
                                                        </div>
                                                        <div class="col-9">
                                                            <div class="row text-light">
                                                                <div class="col-12 fs-5">E-Outlet</div>
                                                                <div class="col-12" style="font-size: 10px;"><?php echo ($product_data["product_name"]);  ?></div>
                                                                <div class="col-12 fw-bold fs-3">Rs. <?php echo ($product_data["price"]);  ?>.00</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 bg-light rounded-bottom">
                                                    <div class="row p-4">
                                                        <div class="col-12 text-secondary py-3">THANK YOU</div>
                                                        <div class="col-12 text-center"><i class="bi bi-check-circle text-success" style="font-size: 80px;"></i></div>
                                                        <div class="col-12 text-center mb-5">Payment approved</div>
                                                        <div class="col-12 d-grid">
                                                            <button class="btn btn-warning" onclick="payModalDisplay4('<?php echo ($product_data['id']); ?>');">OK</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- paymodal 3-->



                            <div class="col-12 offset-2 pt-3">
                                <?php

                                $cart_rs = Database::search("SELECT * FROM `cart` WHERE `products_id`='" . $product_data["id"] . "'");
                                $cart_num = $cart_rs->num_rows;
                                if ($cart_num == 1) {
                                ?>
                                    <button class="btn btn-secondary col-9" id="g<?php echo ($product_data["id"])  ?>" onclick="cart1(<?php echo ($product_data['id'])  ?>);" disabled>Added to Cart</button>
                                <?php
                                } else {
                                ?>

                                    <button class="btn btn-primary col-9" id="g<?php echo ($product_data["id"])  ?>" onclick="cart1(<?php echo ($product_data['id'])  ?>);">Add to Cart</button>

                                <?php
                                }
                                ?>


                            </div>
                            <div class="col-12 offset-2 pt-3 pb-3">
                                <?php

                                $watch_rs = Database::search("SELECT * FROM `watchlist` WHERE `products_id`='" . $product_data["id"] . "'");
                                $watch_num = $watch_rs->num_rows;
                                if ($watch_num == 1) {
                                ?>
                                    <button class="btn btn-danger mt-2 mt-lg-3 ms-lg-1 col-9" id="m<?php echo ($product_data["id"])  ?>" onclick="watchlist1(<?php echo ($product_data['id'])  ?>);" disabled>Added to Watchlist</button>
                                <?php
                                } else {
                                ?>

                                    <button class="btn btn-warning mt-2 col-9" id="m<?php echo ($product_data["id"])  ?>" onclick="watchlist1(<?php echo ($product_data['id'])  ?>);">Add to Watchlist</button>

                                <?php
                                }
                                ?>
                            </div>

                        </div>


                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="row">
                    <div class="col-12 text-start text-success fs-2 pt-3">Feedbacks</div>
                    <div class="col-12">
                        <div class="row">
                            <?php
                            $feed_rs = Database::search("SELECT * FROM `feedback` WHERE `products_id` = '" . $product_data["id"] . "'");
                            $feed_num = $feed_rs->num_rows;
                            if ($feed_num == "0") {
                            ?>
                                <div class="col-12 text-center fs-3 text-secondary p-5">No Feedbacks Yet.</div>
                            <?php
                            }
                            for ($n = 0; $n < $feed_num; $n++) {
                                $feed_data = $feed_rs->fetch_assoc();
                            ?>
                                <div class="col-12 col-lg-4 border border-secondary border-1 rounded" style="height: 100px;">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="row">
                                                <?php

                                                $product_rs1 = Database::search("SELECT * FROM `customer` WHERE `mobile` = '" . $feed_data["customer_mobile"] . "'");
                                                $product_data1 = $product_rs1->fetch_assoc();
                                                ?>
                                                <div class="col-6 fs-5"><?php echo ($product_data1["fname"] . " " . $product_data1["lname"]); ?></div>
                                                <div class="col-6">
                                                    <div class="row">
                                                        <?php
                                                        if ($feed_data["status"] == "0") {
                                                        ?>

                                                            <div class="col-1 offset-5"><i class="bi bi-star fs-6"></i></div>
                                                            <div class="col-1"><i class="bi bi-star fs-6"></i></div>
                                                            <div class="col-1"><i class="bi bi-star fs-6"></i></div>
                                                            <div class="col-1"><i class="bi bi-star fs-6"></i></div>
                                                            <div class="col-1"><i class="bi bi-star fs-6"></i></div>

                                                        <?php
                                                        } else if ($feed_data["status"] == "1") {
                                                        ?>
                                                            <div class="col-1 offset-5"><i class="bi bi-star-fill text-warning fs-6"></i></div>
                                                            <div class="col-1"><i class="bi bi-star fs-6"></i></div>
                                                            <div class="col-1"><i class="bi bi-star fs-6"></i></div>
                                                            <div class="col-1"><i class="bi bi-star fs-6"></i></div>
                                                            <div class="col-1"><i class="bi bi-star fs-6"></i></div>

                                                        <?php
                                                        } else if ($feed_data["status"] == "2") {
                                                        ?>
                                                            <div class="col-1 offset-5"><i class="bi bi-star-fill text-warning fs-6"></i></div>
                                                            <div class="col-1"><i class="bi bi-star-fill text-warning fs-6"></i></div>
                                                            <div class="col-1"><i class="bi bi-star fs-6"></i></div>
                                                            <div class="col-1"><i class="bi bi-star fs-6"></i></div>
                                                            <div class="col-1"><i class="bi bi-star fs-6"></i></div>

                                                        <?php
                                                        } else if ($feed_data["status"] == "3") {
                                                        ?>
                                                            <div class="col-1 offset-5"><i class="bi bi-star-fill text-warning fs-6"></i></div>
                                                            <div class="col-1"><i class="bi bi-star-fill text-warning fs-6"></i></div>
                                                            <div class="col-1"><i class="bi bi-star-fill text-warning fs-6"></i></div>
                                                            <div class="col-1"><i class="bi bi-star fs-6"></i></div>
                                                            <div class="col-1"><i class="bi bi-star fs-6"></i></div>

                                                        <?php
                                                        } else if ($feed_data["status"] == "4") {
                                                        ?>
                                                            <div class="col-1 offset-5"><i class="bi bi-star-fill text-warning fs-6"></i></div>
                                                            <div class="col-1"><i class="bi bi-star-fill text-warning fs-6"></i></div>
                                                            <div class="col-1"><i class="bi bi-star-fill text-warning fs-6"></i></div>
                                                            <div class="col-1"><i class="bi bi-star-fill text-warning fs-6"></i></div>
                                                            <div class="col-1"><i class="bi bi-star fs-6"></i></div>

                                                        <?php
                                                        } else if ($feed_data["status"] == "5") {
                                                        ?>
                                                            <div class="col-1 offset-5"><i class="bi bi-star-fill text-warning fs-6"></i></div>
                                                            <div class="col-1"><i class="bi bi-star-fill text-warning fs-6"></i></div>
                                                            <div class="col-1"><i class="bi bi-star-fill text-warning fs-6"></i></div>
                                                            <div class="col-1"><i class="bi bi-star-fill text-warning fs-6"></i></div>
                                                            <div class="col-1"><i class="bi bi-star-fill text-warning fs-6"></i></div>
                                                        <?php
                                                        }

                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <p class="text-secondary fs-6"><?php echo ($feed_data["feedback"]); ?></p>
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
        </div>


    </div>



    <?php require "footer.php"; ?>





    <script src="script.js"></script>
    <script src="bootstrap.js"></script>
    <script src="bootstrap.bundle.js"></script>
    
    <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>

</body>

</html>