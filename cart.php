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
    <title>Sooper Vegan | Cart</title>
</head>

<body class="body">
    <div class="col-12 fixed-top bg-light">
        <?php require "header.php"; ?>
    </div>

    <div class="container-fluid p-3 pt-5" style="background-color:#A8E890;height: 100vh;">
        <div class="col-12 pt-5 pt-lg-3">
            <div class="row pt-5 pt-lg-0">
                <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="home.php" class="text-success fw-bold">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Cart</li>
                    </ol>
                </nav>
                <div class="col-12 fs-1 text-dark text-center"><i class="bi bi-cart"></i> Cart</div>
                <div class="col-lg-7 col-12">
                    <div class="row">
                        <div class="input-group  mb-3 offset-lg-4">
                            <input type="text" class="form-control" placeholder="Search cart" aria-label="Recipient's username" aria-describedby="button-addon2">
                            <button class="btn border bg-light" style="border-color: gray;" type="button" id="button-addon2"><i class="bi bi-search fs-5"></i></button>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="row">
                        <div class=" col-12 col-lg-8">
                            <div class="row pb-3">


                                <?php
                                require "connection.php";

                                $cart_rs = Database::search("SELECT * FROM `cart` WHERE `customer_mobile`='" . $user["mobile"] . "'");
                                $cart_num = $cart_rs->num_rows;
                                $item = 0;
                                $proprice = 0;
                                if ($cart_num == 0) {
                                ?>
                                    <div class="col-12 offset-0 offset-lg-0 col-lg-12 mt-3">
                                        <div class="row">
                                            <div class="col-12 text-center p-3"><img src="resource/cartadd.png" style="height: 100px;" /></i></div>
                                            <div class="col-12 text-center fs-2 p-3">You have not added any product to the cart yet.</div>
                                            <div class="col-12 p-3">
                                                <a href="home.php" class="btn btn-success col-4 offset-4 ">Start Shopping</a>
                                            </div>

                                        </div>
                                    </div>
                                    <?php
                                } else {
                                    for ($x = 0; $x < $cart_num; $x++) {
                                        $cart_data = $cart_rs->fetch_assoc();
                                        $product_rs = Database::search("SELECT * FROM `products` WHERE `id` = '" . $cart_data["products_id"] . "'");
                                        $product_data = $product_rs->fetch_assoc();
                                    ?>
                                        <div class="col-8 offset-0 offset-lg-0 col-lg-4 mt-3">
                                            <div class="card" style="height:500px; min-width:18rem;">

                                                <img src="<?php echo ($product_data["pic"]); ?>" class="card-img-top" style="height:190px ;">
                                                <div class="card-body">
                                                    <div style="height:50px ;" class="card-title fs-6 fw-bold text-center border-0 pb-0 mb-0"><?php echo ($product_data["product_name"]); ?></div>
                                                    <p class="card-text text-center col-12 text-success fs-6 mt-0 pt-0"> Rs. <?php echo ($product_data["price"]); ?>.00</p>
                                                    <p class="card-text text-center col-12"> <span class="fs-6 text-danger"><?php echo ($product_data["quantity"]); ?></span>&nbsp; Items available</p>
                                                    <div class="col-12 d-grid">
                                                        <div class="row">
                                                            <div class="col-3 text-end">Qty :</div>
                                                            <?php
                                                            $cart1_rs = Database::search("SELECT `qty` FROM `cart`WHERE `products_id` = '" . $product_data["id"] . "' AND `customer_mobile` = '" . $user["mobile"] . "'");
                                                            $cart1_num = $cart1_rs->num_rows;
                                                            $cart1_data = $cart1_rs->fetch_assoc();
                                                            if ($cart1_num == 1) {
                                                            ?>
                                                                <div class="col-6">
                                                                    <input type="number" id="q<?php echo ($cart_data["products_id"]); ?>" onchange="summary(<?php echo ($product_data['id']); ?>);" min="0" value="<?php echo ($cart1_data["qty"]); ?>" class="col-12 form-control" />
                                                                </div>

                                                            <?php
                                                            } else {
                                                            ?>

                                                                <div class="col-6">
                                                                    <input type="number" id="q<?php echo ($cart_data["product_id"]); ?>" onclick="window.location='cart.php';" onchange="summary(<?php echo ($product_data['id']); ?>);" min="0" value="1" class="col-12 form-control" />
                                                                </div>
                                                            <?php
                                                            }
                                                            ?>

                                                        </div>
                                                    </div>
                                                    <div class="col-12 text-center">Delivery fee : Rs. 300.00</div>
                                                    <div class="col-12 d-grid">
                                                        <div class="row pe-1 ps-1 g-1">
                                                            <div class="col-6 p-1"> <button class="btn btn-primary mt-3 col-12" onclick="view1(<?php echo ($cart_data['products_id'])  ?>);">Buy Now</button>
                                                            </div>
                                                            <div class="col-6 p-1">
                                                                <button class="btn btn-warning mt-3 col-12" onclick="remove(<?php echo ($cart_data['products_id']) ?>);">Remove</button>
                                                            </div>

                                                        </div>
                                                    </div>

                                                </div>
                                            </div>

                                        </div>
                                <?php
                                        $item = $item + $cart_data["qty"];
                                        $proprice = intval($proprice) + intval($cart_data["qty"]) * intval($product_data["price"]);
                                    }
                                }
                                    $total = 300 + intval($proprice);
                                
                                ?>


                            </div>
                        </div>
                        <div class="col-12 col-lg-4 p-3">
                            <div class="row">
                                <div class="col-12 border-silver border border-2 rounded-top rounded-bottom p-4 bg-light">
                                    <div class="row">
                                        <div class="col-12 text-center fs-3">Summary</div>
                                        <div class="col-12 pt-4">
                                            <div class="row">
                                                <div id="items" class="col-4 text-end">Items (<?php echo ($item); ?>)</div>
                                                <div id="itemp" class="col-8 text-end">Rs. <?php echo ($proprice); ?>.00</div>
                                            </div>
                                        </div>
                                        <div class="col-12 pt-4">
                                            <div class="row">
                                                <div class="col-4 text-end">Delivery Fee</div>
                                                <div id="delivery" class="col-8 text-end">Rs. 300.00</div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <hr />
                                        </div>
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-4 text-end">Total</div>
                                                <div id="total" class="col-8 text-end">Rs. <?php echo ($total);  ?>.00</div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <hr />
                                        </div>

                                    </div>
                                </div>
                                <div class="col-12 d-grid p-3">
                                    <button class="btn btn-success col-12" onclick="buyAll();">Buy All Products</button>
                                    
                                </div>
                                <div class="col-12 d-grid p-3">
                                    <button class="btn btn-success col-12" onclick="removeAll();">Remove All Products</button>
                                </div>

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
    <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>
</body>

</html>