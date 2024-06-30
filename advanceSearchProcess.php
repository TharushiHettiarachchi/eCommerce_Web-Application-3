<?php

require "connection.php";
$text = $_POST["searcha"];
$price = $_POST["price"];
$p1 = $_POST["p1"];
$p2 = $_POST["p2"];
$qty = $_POST["qty"];
$selection = $_POST["select"];


if (!empty($text) && $selection == 0) {


    if ($price == 0 && $qty == 0 && empty($p1) && empty($p2)) {
        $search1_rs = Database::search("SELECT * FROM `products` WHERE `product_name` LIKE '%" . $text . "%'");
        $search1_num = $search1_rs->num_rows;
?>
        <p class="fs-4 p-3 fw-bold"><i class="bi bi-search fs-1"></i>&nbsp; &nbsp;<?php echo ($search1_num); ?> Items Found...</p>
        <?php
        for ($x = 0; $x < $search1_num; $x++) {
            $search1_data = $search1_rs->fetch_assoc();
        ?>
            <div class="col-12 offset-2 offset-lg-0 col-lg-2 mt-3 me-5">
                <div class="card" style="width: 18rem; height:550px;">
                    <img onclick="view(<?php echo ($search1_data['id'])  ?>);" src="<?php echo ($search1_data["pic"])  ?>" class="card-img-top" style="height:190px ;">
                    <div class="card-body">
                        <div style="height:75px ;" onclick="view(<?php echo ($search_data['id'])  ?>);" class="card-title text-center fs-6 text-success fw-bold"><?php echo ($search1_data["product_name"])  ?></div>
                        <p onclick="view(<?php echo ($search1_data['id'])  ?>);" class="card-text text-center col-12"> Rs. <?php echo ($search1_data["price"]); ?>.00</p>
                        <p onclick="view(<?php echo ($search1_data['id'])  ?>);" class="card-text text-center col-12"> <?php echo ($search1_data["quantity"]); ?> Items available</p>
                        <?php
                        if ($search1_data["quantity"] == 0) {
                        ?>
                            <div class="col-12 d-grid">
                                <div class="row pe-3 ps-3 pt-0">
                                    <button class="btn btn-primary mt-3 col-12 col-lg-5" disabled>Buy Now</button>
                                    <?php
                                    $cart1_rs = Database::search("SELECT * FROM `cart` WHERE `products_id`='" . $search1_data["id"] . "'");
                                    $cart1_num = $cart1_rs->num_rows;
                                    if ($cart1_num == 1) {
                                    ?>
                                        <button class="btn btn-secondary mt-2 mt-lg-3 ms-lg-1 col-12 col-lg-6" id="s<?php echo ($search1_data["id"])  ?>" onclick="cart(<?php echo ($search1_data['id'])  ?>);" disabled>Added to Cart</button>
                                    <?php
                                    } else {
                                    ?>
                                        <button class="btn btn-primary mt-2 mt-lg-3 ms-lg-1 col-12 col-lg-6" id="s<?php echo ($search1_data["id"])  ?>" onclick="cart(<?php echo ($search1_data['id'])  ?>);">Add to Cart</button>
                                    <?php
                                    }
                                    ?>
                                    <?php

                                    $watch_rs = Database::search("SELECT * FROM `watchlist` WHERE `products_id`='" . $search1_data["id"] . "'");
                                    $watch_num = $watch_rs->num_rows;
                                    if ($watch_num == 1) {
                                    ?>
                                        <button class="btn btn-danger mt-2 mt-lg-3 ms-lg-1 col-12" id="w<?php echo ($search1_data["id"])  ?>" onclick="watchlist('<?php echo ($search1_data['id'])  ?>');" disabled>Added to Watchlist</button>
                                    <?php
                                    } else {
                                    ?>

                                        <button class="btn btn-warning mt-2 col-lg-11" id="w<?php echo ($search1_data["id"])  ?>" onclick="watchlist('<?php echo ($search1_data['id'])  ?>');">Add to Watchlist</button>

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
                                    <button class="btn btn-primary mt-3 col-12 col-lg-5" onclick="window.location='productView.php';">Buy Now</button>

                                    <?php
                                    $cart1_rs = Database::search("SELECT * FROM `cart` WHERE `products_id`='" . $search1_data["id"] . "'");
                                    $cart1_num = $cart1_rs->num_rows;
                                    if ($cart1_num == 1) {
                                    ?>
                                        <button class="btn btn-secondary mt-2 mt-lg-3 ms-lg-1 col-12 col-lg-6" id="s<?php echo ($search1_data["id"])  ?>" onclick="cart(<?php echo ($search1_data['id'])  ?>);" disabled>Added to Cart</button>
                                    <?php
                                    } else {
                                    ?>
                                        <button class="btn btn-primary mt-2 mt-lg-3 ms-lg-1 col-12 col-lg-6" id="s<?php echo ($search1_data["id"])  ?>" onclick="cart(<?php echo ($search1_data['id'])  ?>);">Add to Cart</button>
                                    <?php
                                    }
                                    ?>
                                    <?php

                                    $watch_rs = Database::search("SELECT * FROM `watchlist` WHERE `products_id`='" . $search1_data["id"] . "'");
                                    $watch_num = $watch_rs->num_rows;
                                    if ($watch_num == 1) {
                                    ?>
                                        <button class="btn btn-danger mt-2 mt-lg-3 ms-lg-1 col-12" id="w<?php echo ($search1_data["id"])  ?>" onclick="watchlist('<?php echo ($search1_data['id'])  ?>');" disabled>Added to Watchlist</button>
                                    <?php
                                    } else {
                                    ?>

                                        <button class="btn btn-warning mt-2 col-lg-11" id="w<?php echo ($search1_data["id"])  ?>" onclick="watchlist('<?php echo ($search1_data['id'])  ?>');">Add to Watchlist</button>

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
    }




    if ($price == 1 && $qty == 0) {
        $search1_rs = Database::search("SELECT * FROM `products` WHERE `product_name` LIKE '%" . $text . "%' ORDER BY `price` DESC");
        $search1_num = $search1_rs->num_rows;
        ?>
        <p class="fs-4 p-3 fw-bold"><i class="bi bi-search fs-1"></i>&nbsp; &nbsp;<?php echo ($search1_num); ?> Items Found...</p>
        <?php
        for ($x = 0; $x < $search1_num; $x++) {
            $search1_data = $search1_rs->fetch_assoc();
        ?>
            <div class="col-12 offset-2 offset-lg-0 col-lg-2 mt-3 me-5">
                <div class="card" style="width: 18rem; height:550px;">
                    <img onclick="view(<?php echo ($search1_data['id'])  ?>);" src="<?php echo ($search1_data["pic"])  ?>" class="card-img-top" style="height:190px ;">
                    <div class="card-body">
                        <div style="height:75px ;" onclick="view(<?php echo ($search_data['id'])  ?>);" class="card-title text-center fs-6 text-success fw-bold"><?php echo ($search1_data["product_name"])  ?></div>
                        <p onclick="view(<?php echo ($search1_data['id'])  ?>);" class="card-text text-center col-12"> Rs. <?php echo ($search1_data["price"]); ?>.00</p>
                        <p onclick="view(<?php echo ($search1_data['id'])  ?>);" class="card-text text-center col-12"> <?php echo ($search1_data["quantity"]); ?> Items available</p>
                        <?php
                        if ($search1_data["quantity"] == 0) {
                        ?>
                            <div class="col-12 d-grid">
                                <div class="row pe-3 ps-3 pt-0">
                                    <button class="btn btn-primary mt-3 col-12 col-lg-5" disabled>Buy Now</button>
                                    <?php

                                    $cart1_rs = Database::search("SELECT * FROM `cart` WHERE `products_id`='" . $search1_data["id"] . "'");
                                    $cart1_num = $cart1_rs->num_rows;
                                    if ($cart1_num == 1) {
                                    ?>
                                        <button class="btn btn-secondary mt-2 mt-lg-3 ms-lg-1 col-12 col-lg-6" id="s<?php echo ($search1_data["id"])  ?>" onclick="cart(<?php echo ($search1_data['id'])  ?>);" disabled>Added to Cart</button>
                                    <?php
                                    } else {
                                    ?>
                                        <button class="btn btn-primary mt-2 mt-lg-3 ms-lg-1 col-12 col-lg-6" id="s<?php echo ($search1_data["id"])  ?>" onclick="cart(<?php echo ($search1_data['id'])  ?>);">Add to Cart</button>

                                    <?php
                                    }
                                    ?>
                                    <?php

                                    $watch_rs = Database::search("SELECT * FROM `watchlist` WHERE `products_id`='" . $search1_data["id"] . "'");
                                    $watch_num = $watch_rs->num_rows;
                                    if ($watch_num == 1) {
                                    ?>
                                        <button class="btn btn-danger mt-2 mt-lg-3 ms-lg-1 col-12" id="w<?php echo ($search1_data["id"])  ?>" onclick="watchlist('<?php echo ($search1_data['id'])  ?>');" disabled>Added to Watchlist</button>
                                    <?php
                                    } else {
                                    ?>

                                        <button class="btn btn-warning mt-2 col-lg-11" id="w<?php echo ($search1_data["id"])  ?>" onclick="watchlist('<?php echo ($search1_data['id'])  ?>');">Add to Watchlist</button>

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
                                    <button class="btn btn-primary mt-3 col-12 col-lg-5" onclick="window.location='productView.php';">Buy Now</button>

                                    <?php
                                    $cart1_rs = Database::search("SELECT * FROM `cart` WHERE `products_id`='" . $search1_data["id"] . "'");
                                    $cart1_num = $cart1_rs->num_rows;
                                    if ($cart1_num == 1) {
                                    ?>
                                        <button class="btn btn-secondary mt-2 mt-lg-3 ms-lg-1 col-12 col-lg-6" id="s<?php echo ($search1_data["id"])  ?>" onclick="cart(<?php echo ($search1_data['id'])  ?>);" disabled>Added to Cart</button>
                                    <?php
                                    } else {
                                    ?>
                                        <button class="btn btn-primary mt-2 mt-lg-3 ms-lg-1 col-12 col-lg-6" id="s<?php echo ($search1_data["id"])  ?>" onclick="cart(<?php echo ($search1_data['id'])  ?>);">Add to Cart</button>
                                    <?php
                                    }
                                    ?>
                                    <?php

                                    $watch_rs = Database::search("SELECT * FROM `watchlist` WHERE `products_id`='" . $search1_data["id"] . "'");
                                    $watch_num = $watch_rs->num_rows;
                                    if ($watch_num == 1) {
                                    ?>
                                        <button class="btn btn-danger mt-2 mt-lg-3 ms-lg-1 col-12" id="w<?php echo ($search1_data["id"])  ?>" onclick="watchlist('<?php echo ($search1_data['id'])  ?>');" disabled>Added to Watchlist</button>
                                    <?php
                                    } else {
                                    ?>

                                        <button class="btn btn-warning mt-2 col-lg-11" id="w<?php echo ($search1_data["id"])  ?>" onclick="watchlist('<?php echo ($search1_data['id'])  ?>');">Add to Watchlist</button>

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
    }



    if ($price == 2 && $qty == 0) {
        $search1_rs = Database::search("SELECT * FROM `products` WHERE `product_name` LIKE '%" . $text . "%' ORDER BY `price` ASC");
        $search1_num = $search1_rs->num_rows;
        ?>
        <p class="fs-4 p-3 fw-bold"><i class="bi bi-search fs-1"></i>&nbsp; &nbsp;<?php echo ($search1_num); ?> Items Found...</p>
        <?php
        for ($x = 0; $x < $search1_num; $x++) {
            $search1_data = $search1_rs->fetch_assoc();
        ?>
            <div class="col-12 offset-2 offset-lg-0 col-lg-2 mt-3 me-5">
                <div class="card" style="width: 18rem; height:550px;">
                    <img onclick="view(<?php echo ($search1_data['id'])  ?>);" src="<?php echo ($search1_data["pic"])  ?>" class="card-img-top" style="height:190px ;">
                    <div class="card-body">
                        <div style="height:75px ;" onclick="view(<?php echo ($search_data['id'])  ?>);" class="card-title text-center fs-6 text-success fw-bold"><?php echo ($search1_data["product_name"])  ?></div>
                        <p onclick="view(<?php echo ($search1_data['id'])  ?>);" class="card-text text-center col-12"> Rs. <?php echo ($search1_data["price"]); ?>.00</p>
                        <p onclick="view(<?php echo ($search1_data['id'])  ?>);" class="card-text text-center col-12"> <?php echo ($search1_data["quantity"]); ?> Items available</p>
                        <?php
                        if ($search1_data["quantity"] == 0) {
                        ?>
                            <div class="col-12 d-grid">
                                <div class="row pe-3 ps-3 pt-0">
                                    <button class="btn btn-primary mt-3 col-12 col-lg-5" disabled>Buy Now</button>
                                    <?php

                                    $cart1_rs = Database::search("SELECT * FROM `cart` WHERE `products_id`='" . $search1_data["id"] . "'");
                                    $cart1_num = $cart1_rs->num_rows;
                                    if ($cart1_num == 1) {
                                    ?>
                                        <button class="btn btn-secondary mt-2 mt-lg-3 ms-lg-1 col-12 col-lg-6" id="s<?php echo ($search1_data["id"])  ?>" onclick="cart(<?php echo ($search1_data['id'])  ?>);" disabled>Added to Cart</button>
                                    <?php
                                    } else {
                                    ?>

                                        <button class="btn btn-primary mt-2 mt-lg-3 ms-lg-1 col-12 col-lg-6" id="s<?php echo ($search1_data["id"])  ?>" onclick="cart(<?php echo ($search1_data['id'])  ?>);">Add to Cart</button>

                                    <?php
                                    }
                                    ?>

                                    <?php

                                    $watch_rs = Database::search("SELECT * FROM `watchlist` WHERE `products_id`='" . $search1_data["id"] . "'");
                                    $watch_num = $watch_rs->num_rows;
                                    if ($watch_num == 1) {
                                    ?>
                                        <button class="btn btn-danger mt-2 mt-lg-3 ms-lg-1 col-12" id="w<?php echo ($search1_data["id"])  ?>" onclick="watchlist('<?php echo ($search1_data['id'])  ?>');" disabled>Added to Watchlist</button>
                                    <?php
                                    } else {
                                    ?>

                                        <button class="btn btn-warning mt-2 col-lg-11" id="w<?php echo ($search1_data["id"])  ?>" onclick="watchlist('<?php echo ($search1_data['id'])  ?>');">Add to Watchlist</button>

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
                                    <button class="btn btn-primary mt-3 col-12 col-lg-5" onclick="window.location='productView.php';">Buy Now</button>

                                    <?php

                                    $cart1_rs = Database::search("SELECT * FROM `cart` WHERE `products_id`='" . $search1_data["id"] . "'");
                                    $cart1_num = $cart1_rs->num_rows;
                                    if ($cart1_num == 1) {
                                    ?>
                                        <button class="btn btn-secondary mt-2 mt-lg-3 ms-lg-1 col-12 col-lg-6" id="s<?php echo ($search1_data["id"])  ?>" onclick="cart(<?php echo ($search1_data['id'])  ?>);" disabled>Added to Cart</button>
                                    <?php
                                    } else {
                                    ?>

                                        <button class="btn btn-primary mt-2 mt-lg-3 ms-lg-1 col-12 col-lg-6" id="s<?php echo ($search1_data["id"])  ?>" onclick="cart(<?php echo ($search1_data['id'])  ?>);">Add to Cart</button>

                                    <?php
                                    }
                                    ?>

                                    <?php

                                    $watch_rs = Database::search("SELECT * FROM `watchlist` WHERE `products_id`='" . $search1_data["id"] . "'");
                                    $watch_num = $watch_rs->num_rows;
                                    if ($watch_num == 1) {
                                    ?>
                                        <button class="btn btn-danger mt-2 mt-lg-3 ms-lg-1 col-12" id="w<?php echo ($search1_data["id"])  ?>" onclick="watchlist('<?php echo ($search1_data['id'])  ?>');" disabled>Added to Watchlist</button>
                                    <?php
                                    } else {
                                    ?>

                                        <button class="btn btn-warning mt-2 col-lg-11" id="w<?php echo ($search1_data["id"])  ?>" onclick="watchlist('<?php echo ($search1_data['id'])  ?>');">Add to Watchlist</button>

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
    }




    if ($price == 0 && $qty == 1) {
        $search1_rs = Database::search("SELECT * FROM `products` WHERE `product_name` LIKE '%" . $text . "%' ORDER BY `quantity` DESC");
        $search1_num = $search1_rs->num_rows;
        ?>
        <p class="fs-4 p-3 fw-bold"><i class="bi bi-search fs-1"></i>&nbsp; &nbsp;<?php echo ($search1_num); ?> Items Found...</p>
        <?php
        for ($x = 0; $x < $search1_num; $x++) {
            $search1_data = $search1_rs->fetch_assoc();
        ?>
            <div class="col-12 offset-2 offset-lg-0 col-lg-2 mt-3 me-5">
                <div class="card" style="width: 18rem; height:550px;">
                    <img onclick="view(<?php echo ($search1_data['id'])  ?>);" src="<?php echo ($search1_data["pic"])  ?>" class="card-img-top" style="height:190px ;">
                    <div class="card-body">
                        <div style="height:75px ;" onclick="view(<?php echo ($search_data['id'])  ?>);" class="card-title text-center fs-6 text-success fw-bold"><?php echo ($search1_data["product_name"])  ?></div>
                        <p onclick="view(<?php echo ($search1_data['id'])  ?>);" class="card-text text-center col-12"> Rs. <?php echo ($search1_data["price"]); ?>.00</p>
                        <p onclick="view(<?php echo ($search1_data['id'])  ?>);" class="card-text text-center col-12"> <?php echo ($search1_data["quantity"]); ?> Items available</p>
                        <?php
                        if ($search1_data["quantity"] == 0) {
                        ?>
                            <div class="col-12 d-grid">
                                <div class="row pe-3 ps-3 pt-0">
                                    <button class="btn btn-primary mt-3 col-12 col-lg-5" disabled>Buy Now</button>
                                    <?php

                                    $cart1_rs = Database::search("SELECT * FROM `cart` WHERE `products_id`='" . $search1_data["id"] . "'");
                                    $cart1_num = $cart1_rs->num_rows;
                                    if ($cart1_num == 1) {
                                    ?>
                                        <button class="btn btn-secondary mt-2 mt-lg-3 ms-lg-1 col-12 col-lg-6" id="s<?php echo ($search1_data["id"])  ?>" onclick="cart(<?php echo ($search1_data['id'])  ?>);" disabled>Added to Cart</button>
                                    <?php
                                    } else {
                                    ?>

                                        <button class="btn btn-primary mt-2 mt-lg-3 ms-lg-1 col-12 col-lg-6" id="s<?php echo ($search1_data["id"])  ?>" onclick="cart(<?php echo ($search1_data['id'])  ?>);">Add to Cart</button>

                                    <?php
                                    }
                                    ?>

                                    <?php

                                    $watch_rs = Database::search("SELECT * FROM `watchlist` WHERE `products_id`='" . $search1_data["id"] . "'");
                                    $watch_num = $watch_rs->num_rows;
                                    if ($watch_num == 1) {
                                    ?>
                                        <button class="btn btn-danger mt-2 mt-lg-3 ms-lg-1 col-12" id="w<?php echo ($search1_data["id"])  ?>" onclick="watchlist('<?php echo ($search1_data['id'])  ?>');" disabled>Added to Watchlist</button>
                                    <?php
                                    } else {
                                    ?>

                                        <button class="btn btn-warning mt-2 col-lg-11" id="w<?php echo ($search1_data["id"])  ?>" onclick="watchlist('<?php echo ($search1_data['id'])  ?>');">Add to Watchlist</button>

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
                                    <button class="btn btn-primary mt-3 col-12 col-lg-5" onclick="window.location='productView.php';">Buy Now</button>

                                    <?php

                                    $cart1_rs = Database::search("SELECT * FROM `cart` WHERE `products_id`='" . $search1_data["id"] . "'");
                                    $cart1_num = $cart1_rs->num_rows;
                                    if ($cart1_num == 1) {
                                    ?>
                                        <button class="btn btn-secondary mt-2 mt-lg-3 ms-lg-1 col-12 col-lg-6" id="s<?php echo ($search1_data["id"])  ?>" onclick="cart(<?php echo ($search1_data['id'])  ?>);" disabled>Added to Cart</button>
                                    <?php
                                    } else {
                                    ?>

                                        <button class="btn btn-primary mt-2 mt-lg-3 ms-lg-1 col-12 col-lg-6" id="s<?php echo ($search1_data["id"])  ?>" onclick="cart(<?php echo ($search1_data['id'])  ?>);">Add to Cart</button>

                                    <?php
                                    }
                                    ?>

                                    <?php

                                    $watch_rs = Database::search("SELECT * FROM `watchlist` WHERE `products_id`='" . $search1_data["id"] . "'");
                                    $watch_num = $watch_rs->num_rows;
                                    if ($watch_num == 1) {
                                    ?>
                                        <button class="btn btn-danger mt-2 mt-lg-3 ms-lg-1 col-12" id="w<?php echo ($search1_data["id"])  ?>" onclick="watchlist('<?php echo ($search1_data['id'])  ?>');" disabled>Added to Watchlist</button>
                                    <?php
                                    } else {
                                    ?>

                                        <button class="btn btn-warning mt-2 col-lg-11" id="w<?php echo ($search1_data["id"])  ?>" onclick="watchlist('<?php echo ($search1_data['id'])  ?>');">Add to Watchlist</button>

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
    <?php
    }




    if ($price == 0 && $qty == 2) {
        $search1_rs = Database::search("SELECT * FROM `products` WHERE `product_name` LIKE '%" . $text . "%' ORDER BY `quantity` ASC");
        $search1_num = $search1_rs->num_rows;
    ?>
        <p class="fs-4 p-3 fw-bold"><i class="bi bi-search fs-1"></i>&nbsp; &nbsp;<?php echo ($search1_num); ?> Items Found...</p>
        <?php
        for ($x = 0; $x < $search1_num; $x++) {
            $search1_data = $search1_rs->fetch_assoc();
        ?>
            <div class="col-12 offset-2 offset-lg-0 col-lg-2 mt-3 me-5">
                <div class="card" style="width: 18rem; height:550px;">
                    <img onclick="view(<?php echo ($search1_data['id'])  ?>);" src="<?php echo ($search1_data["pic"])  ?>" class="card-img-top" style="height:190px ;">
                    <div class="card-body">
                        <div style="height:75px ;" onclick="view(<?php echo ($search_data['id'])  ?>);" class="card-title text-center fs-6 text-success fw-bold"><?php echo ($search1_data["product_name"])  ?></div>
                        <p onclick="view(<?php echo ($search1_data['id'])  ?>);" class="card-text text-center col-12"> Rs. <?php echo ($search1_data["price"]); ?>.00</p>
                        <p onclick="view(<?php echo ($search1_data['id'])  ?>);" class="card-text text-center col-12"> <?php echo ($search1_data["quantity"]); ?> Items available</p>
                        <?php
                        if ($search1_data["quantity"] == 0) {
                        ?>
                            <div class="col-12 d-grid">
                                <div class="row pe-3 ps-3 pt-0">
                                    <button class="btn btn-primary mt-3 col-12 col-lg-5" disabled>Buy Now</button>
                                    <?php

                                    $cart1_rs = Database::search("SELECT * FROM `cart` WHERE `products_id`='" . $search1_data["id"] . "'");
                                    $cart1_num = $cart1_rs->num_rows;
                                    if ($cart1_num == 1) {
                                    ?>
                                        <button class="btn btn-secondary mt-2 mt-lg-3 ms-lg-1 col-12 col-lg-6" id="s<?php echo ($search1_data["id"])  ?>" onclick="cart(<?php echo ($search1_data['id'])  ?>);" disabled>Added to Cart</button>
                                    <?php
                                    } else {
                                    ?>

                                        <button class="btn btn-primary mt-2 mt-lg-3 ms-lg-1 col-12 col-lg-6" id="s<?php echo ($search1_data["id"])  ?>" onclick="cart(<?php echo ($search1_data['id'])  ?>);">Add to Cart</button>

                                    <?php
                                    }
                                    ?>

                                    <?php

                                    $watch_rs = Database::search("SELECT * FROM `watchlist` WHERE `products_id`='" . $search1_data["id"] . "'");
                                    $watch_num = $watch_rs->num_rows;
                                    if ($watch_num == 1) {
                                    ?>
                                        <button class="btn btn-danger mt-2 mt-lg-3 ms-lg-1 col-12" id="w<?php echo ($search1_data["id"])  ?>" onclick="watchlist('<?php echo ($search1_data['id'])  ?>');" disabled>Added to Watchlist</button>
                                    <?php
                                    } else {
                                    ?>

                                        <button class="btn btn-warning mt-2 col-lg-11" id="w<?php echo ($search1_data["id"])  ?>" onclick="watchlist('<?php echo ($search1_data['id'])  ?>');">Add to Watchlist</button>

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
                                    <button class="btn btn-primary mt-3 col-12 col-lg-5" onclick="window.location='productView.php';">Buy Now</button>

                                    <?php

                                    $cart1_rs = Database::search("SELECT * FROM `cart` WHERE `products_id`='" . $search1_data["id"] . "'");
                                    $cart1_num = $cart1_rs->num_rows;
                                    if ($cart1_num == 1) {
                                    ?>
                                        <button class="btn btn-secondary mt-2 mt-lg-3 ms-lg-1 col-12 col-lg-6" id="s<?php echo ($search1_data["id"])  ?>" onclick="cart(<?php echo ($search1_data['id'])  ?>);" disabled>Added to Cart</button>
                                    <?php
                                    } else {
                                    ?>

                                        <button class="btn btn-primary mt-2 mt-lg-3 ms-lg-1 col-12 col-lg-6" id="s<?php echo ($search1_data["id"])  ?>" onclick="cart(<?php echo ($search1_data['id'])  ?>);">Add to Cart</button>

                                    <?php
                                    }
                                    ?>

                                    <?php

                                    $watch_rs = Database::search("SELECT * FROM `watchlist` WHERE `products_id`='" . $search1_data["id"] . "'");
                                    $watch_num = $watch_rs->num_rows;
                                    if ($watch_num == 1) {
                                    ?>
                                        <button class="btn btn-danger mt-2 mt-lg-3 ms-lg-1 col-12" id="w<?php echo ($search1_data["id"])  ?>" onclick="watchlist('<?php echo ($search1_data['id'])  ?>');" disabled>Added to Watchlist</button>
                                    <?php
                                    } else {
                                    ?>

                                        <button class="btn btn-warning mt-2 col-lg-11" id="w<?php echo ($search1_data["id"])  ?>" onclick="watchlist('<?php echo ($search1_data['id'])  ?>');">Add to Watchlist</button>

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
    }




    if ($qty == 0 && $price == 0 && !empty($p1) && empty($p2)) {
        $search1_rs = Database::search("SELECT * FROM `products` WHERE `product_name` LIKE '%" . $text . "%' AND `price` >= '" . $p1 . "'");
        $search1_num = $search1_rs->num_rows;

        ?>
        <p class="fs-4 p-3 fw-bold"><i class="bi bi-search fs-1"></i>&nbsp; &nbsp;<?php echo ($search1_num); ?> Items Found...</p>
        <?php
        for ($x = 0; $x < $search1_num; $x++) {
            $search1_data = $search1_rs->fetch_assoc();
        ?>
            <div class="col-12 offset-2 offset-lg-0 col-lg-2 mt-3 me-5">
                <div class="card" style="width: 18rem; height:550px;">
                    <img onclick="view(<?php echo ($search1_data['id'])  ?>);" src="<?php echo ($search1_data["pic"])  ?>" class="card-img-top" style="height:190px ;">
                    <div class="card-body">
                        <div style="height:75px ;" onclick="view(<?php echo ($search_data['id'])  ?>);" class="card-title text-center fs-6 text-success fw-bold"><?php echo ($search1_data["product_name"])  ?></div>
                        <p onclick="view(<?php echo ($search1_data['id'])  ?>);" class="card-text text-center col-12"> Rs. <?php echo ($search1_data["price"]); ?>.00</p>
                        <p onclick="view(<?php echo ($search1_data['id'])  ?>);" class="card-text text-center col-12"> <?php echo ($search1_data["quantity"]); ?> Items available</p>
                        <?php
                        if ($search1_data["quantity"] == 0) {
                        ?>
                            <div class="col-12 d-grid">
                                <div class="row pe-3 ps-3 pt-0">
                                    <button class="btn btn-primary mt-3 col-12 col-lg-5" disabled>Buy Now</button>
                                    <?php

                                    $cart1_rs = Database::search("SELECT * FROM `cart` WHERE `products_id`='" . $search1_data["id"] . "'");
                                    $cart1_num = $cart1_rs->num_rows;
                                    if ($cart1_num == 1) {
                                    ?>
                                        <button class="btn btn-secondary mt-2 mt-lg-3 ms-lg-1 col-12 col-lg-6" id="s<?php echo ($search1_data["id"])  ?>" onclick="cart(<?php echo ($search1_data['id'])  ?>);" disabled>Added to Cart</button>
                                    <?php
                                    } else {
                                    ?>

                                        <button class="btn btn-primary mt-2 mt-lg-3 ms-lg-1 col-12 col-lg-6" id="s<?php echo ($search1_data["id"])  ?>" onclick="cart(<?php echo ($search1_data['id'])  ?>);">Add to Cart</button>

                                    <?php
                                    }
                                    ?>

                                    <?php

                                    $watch_rs = Database::search("SELECT * FROM `watchlist` WHERE `products_id`='" . $search1_data["id"] . "'");
                                    $watch_num = $watch_rs->num_rows;
                                    if ($watch_num == 1) {
                                    ?>
                                        <button class="btn btn-danger mt-2 mt-lg-3 ms-lg-1 col-12" id="w<?php echo ($search1_data["id"])  ?>" onclick="watchlist('<?php echo ($search1_data['id'])  ?>');" disabled>Added to Watchlist</button>
                                    <?php
                                    } else {
                                    ?>

                                        <button class="btn btn-warning mt-2 col-lg-11" id="w<?php echo ($search1_data["id"])  ?>" onclick="watchlist('<?php echo ($search1_data['id'])  ?>');">Add to Watchlist</button>

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
                                    <button class="btn btn-primary mt-3 col-12 col-lg-5" onclick="window.location='productView.php';">Buy Now</button>

                                    <?php

                                    $cart1_rs = Database::search("SELECT * FROM `cart` WHERE `products_id`='" . $search1_data["id"] . "'");
                                    $cart1_num = $cart1_rs->num_rows;
                                    if ($cart1_num == 1) {
                                    ?>
                                        <button class="btn btn-secondary mt-2 mt-lg-3 ms-lg-1 col-12 col-lg-6" id="s<?php echo ($search1_data["id"])  ?>" onclick="cart(<?php echo ($search1_data['id'])  ?>);" disabled>Added to Cart</button>
                                    <?php
                                    } else {
                                    ?>

                                        <button class="btn btn-primary mt-2 mt-lg-3 ms-lg-1 col-12 col-lg-6" id="s<?php echo ($search1_data["id"])  ?>" onclick="cart(<?php echo ($search1_data['id'])  ?>);">Add to Cart</button>

                                    <?php
                                    }
                                    ?>

                                    <?php

                                    $watch_rs = Database::search("SELECT * FROM `watchlist` WHERE `products_id`='" . $search1_data["id"] . "'");
                                    $watch_num = $watch_rs->num_rows;
                                    if ($watch_num == 1) {
                                    ?>
                                        <button class="btn btn-danger mt-2 mt-lg-3 ms-lg-1 col-12" id="w<?php echo ($search1_data["id"])  ?>" onclick="watchlist('<?php echo ($search1_data['id'])  ?>');" disabled>Added to Watchlist</button>
                                    <?php
                                    } else {
                                    ?>

                                        <button class="btn btn-warning mt-2 col-lg-11" id="w<?php echo ($search1_data["id"])  ?>" onclick="watchlist('<?php echo ($search1_data['id'])  ?>');">Add to Watchlist</button>

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
    }



    if ($qty == 0 && $price == 0 && !empty($p2) && empty($p1)) {
        $search1_rs = Database::search("SELECT * FROM `products`WHERE `product_name` LIKE '%" . $text . "%' AND `price` <= '" . $p2 . "'");
        $search1_num = $search1_rs->num_rows;

        ?>
        <p class="fs-4 p-3 fw-bold"><i class="bi bi-search fs-1"></i>&nbsp; &nbsp;<?php echo ($search1_num); ?> Items Found...</p>
        <?php
        for ($x = 0; $x < $search1_num; $x++) {
            $search1_data = $search1_rs->fetch_assoc();
        ?>
            <div class="col-12 offset-2 offset-lg-0 col-lg-2 mt-3 me-5">
                <div class="card" style="width: 18rem; height:550px;">
                    <img onclick="view(<?php echo ($search1_data['id'])  ?>);" src="<?php echo ($search1_data["pic"])  ?>" class="card-img-top" style="height:190px ;">
                    <div class="card-body">
                        <div style="height:75px ;" onclick="view(<?php echo ($search_data['id'])  ?>);" class="card-title text-center fs-6 text-success fw-bold"><?php echo ($search1_data["product_name"])  ?></div>
                        <p onclick="view(<?php echo ($search1_data['id'])  ?>);" class="card-text text-center col-12"> Rs. <?php echo ($search1_data["price"]); ?>.00</p>
                        <p onclick="view(<?php echo ($search1_data['id'])  ?>);" class="card-text text-center col-12"> <?php echo ($search1_data["quantity"]); ?> Items available</p>
                        <div class="col-12 d-grid">
                            <div class="row pe-3 ps-3 pt-0">
                                <button class="btn btn-primary mt-3 col-12 col-lg-5" onclick="window.location='productView.php';">Buy Now</button>

                                <?php

                                $cart1_rs = Database::search("SELECT * FROM `cart` WHERE `products_id`='" . $search1_data["id"] . "'");
                                $cart1_num = $cart1_rs->num_rows;
                                if ($cart1_num == 1) {
                                ?>
                                    <button class="btn btn-secondary mt-2 mt-lg-3 ms-lg-1 col-12 col-lg-6" id="s<?php echo ($search1_data["id"])  ?>" onclick="cart(<?php echo ($search1_data['id'])  ?>);" disabled>Added to Cart</button>
                                <?php
                                } else {
                                ?>

                                    <button class="btn btn-primary mt-2 mt-lg-3 ms-lg-1 col-12 col-lg-6" id="s<?php echo ($search1_data["id"])  ?>" onclick="cart(<?php echo ($search1_data['id'])  ?>);">Add to Cart</button>

                                <?php
                                }
                                ?>

                                <?php

                                $watch_rs = Database::search("SELECT * FROM `watchlist` WHERE `products_id`='" . $search1_data["id"] . "'");
                                $watch_num = $watch_rs->num_rows;
                                if ($watch_num == 1) {
                                ?>
                                    <button class="btn btn-danger mt-2 mt-lg-3 ms-lg-1 col-12" id="w<?php echo ($search1_data["id"])  ?>" onclick="watchlist('<?php echo ($search1_data['id'])  ?>');" disabled>Added to Watchlist</button>
                                <?php
                                } else {
                                ?>

                                    <button class="btn btn-warning mt-2 col-lg-11" id="w<?php echo ($search1_data["id"])  ?>" onclick="watchlist('<?php echo ($search1_data['id'])  ?>');">Add to Watchlist</button>

                                <?php
                                }
                                ?>

                            </div>
                        </div>

                    </div>
                </div>
            </div>



        <?php
        }
    }




    if ($qty == 0 && $price == 0 && !empty($p2) && !empty($p1)) {
        $search1_rs = Database::search("SELECT * FROM `products` WHERE `product_name` LIKE '%" . $text . "%' AND `price` BETWEEN '" . $p1 . "' AND '" . $p2 . "'");
        $search1_num = $search1_rs->num_rows;

        ?>
        <p class="fs-4 p-3 fw-bold"><i class="bi bi-search fs-1"></i>&nbsp; &nbsp;<?php echo ($search1_num); ?> Items Found...</p>
        <?php
        for ($x = 0; $x < $search1_num; $x++) {
            $search1_data = $search1_rs->fetch_assoc();
        ?>
            <div class="col-12 offset-2 offset-lg-0 col-lg-2 mt-3 me-5">
                <div class="card" style="width: 18rem; height:550px;">
                    <img onclick="view(<?php echo ($search1_data['id'])  ?>);" src="<?php echo ($search1_data["pic"])  ?>" class="card-img-top" style="height:190px ;">
                    <div class="card-body">
                        <div style="height:75px ;" onclick="view(<?php echo ($search_data['id'])  ?>);" class="card-title text-center fs-6 text-success fw-bold"><?php echo ($search1_data["product_name"])  ?></div>
                        <p onclick="view(<?php echo ($search1_data['id'])  ?>);" class="card-text text-center col-12"> Rs. <?php echo ($search1_data["price"]); ?>.00</p>
                        <p onclick="view(<?php echo ($search1_data['id'])  ?>);" class="card-text text-center col-12"> <?php echo ($search1_data["quantity"]); ?> Items available</p>
                        <div class="col-12 d-grid">
                            <div class="row pe-3 ps-3 pt-0">
                                <button class="btn btn-primary mt-3 col-12 col-lg-5" onclick="window.location='productView.php';">Buy Now</button>

                                <?php

                                $cart1_rs = Database::search("SELECT * FROM `cart` WHERE `products_id`='" . $search1_data["id"] . "'");
                                $cart1_num = $cart1_rs->num_rows;
                                if ($cart1_num == 1) {
                                ?>
                                    <button class="btn btn-secondary mt-2 mt-lg-3 ms-lg-1 col-12 col-lg-6" id="s<?php echo ($search1_data["id"])  ?>" onclick="cart(<?php echo ($search1_data['id'])  ?>);" disabled>Added to Cart</button>
                                <?php
                                } else {
                                ?>

                                    <button class="btn btn-primary mt-2 mt-lg-3 ms-lg-1 col-12 col-lg-6" id="s<?php echo ($search1_data["id"])  ?>" onclick="cart(<?php echo ($search1_data['id'])  ?>);">Add to Cart</button>

                                <?php
                                }
                                ?>
                                <?php

                                $watch_rs = Database::search("SELECT * FROM `watchlist` WHERE `products_id`='" . $search1_data["id"] . "'");
                                $watch_num = $watch_rs->num_rows;
                                if ($watch_num == 1) {
                                ?>
                                    <button class="btn btn-danger mt-2 mt-lg-3 ms-lg-1 col-12" id="w<?php echo ($search1_data["id"])  ?>" onclick="watchlist(<?php echo ($search1_data['id'])  ?>);" disabled>Added to Watchlist</button>
                                <?php
                                } else {
                                ?>

                                    <button class="btn btn-warning mt-2 col-lg-11" id="w<?php echo ($search1_data["id"])  ?>" onclick="watchlist(<?php echo ($search1_data['id'])  ?>);">Add to Watchlist</button>

                                <?php
                                }
                                ?>

                            </div>
                        </div>

                    </div>
                </div>
            </div>



        <?php
        }
    }
} else if (!empty($text) && $selection > 0) {
    if ($price == 0 && $qty == 0 && empty($p1) && empty($p2)) {
        $search1_rs = Database::search("SELECT * FROM `products` WHERE `product_name` LIKE '%" . $text . "%' AND `product_types_id` = '" . $selection . "'");
        $search1_num = $search1_rs->num_rows;
        ?>
        <p class="fs-4 p-3 fw-bold"><i class="bi bi-search fs-1"></i>&nbsp; &nbsp;<?php echo ($search1_num); ?> Items Found...</p>
        <?php
        for ($x = 0; $x < $search1_num; $x++) {
            $search1_data = $search1_rs->fetch_assoc();
        ?>
            <div class="col-12 offset-2 offset-lg-0 col-lg-2 mt-3 me-5">
                <div class="card" style="width: 18rem; height:550px;">
                    <img onclick="view(<?php echo ($search1_data['id'])  ?>);" src="<?php echo ($search1_data["pic"])  ?>" class="card-img-top" style="height:190px ;">
                    <div class="card-body">
                        <div style="height:75px ;" onclick="view(<?php echo ($search_data['id'])  ?>);" class="card-title text-center fs-6 text-success fw-bold"><?php echo ($search1_data["product_name"])  ?></div>
                        <p onclick="view(<?php echo ($search1_data['id'])  ?>);" class="card-text text-center col-12"> Rs. <?php echo ($search1_data["price"]); ?>.00</p>
                        <p onclick="view(<?php echo ($search1_data['id'])  ?>);" class="card-text text-center col-12"> <?php echo ($search1_data["quantity"]); ?> Items available</p>
                        <?php
                        if ($search1_data["quantity"] == 0) {
                        ?>
                            <div class="col-12 d-grid">
                                <div class="row pe-3 ps-3 pt-0">
                                    <button class="btn btn-primary mt-3 col-12 col-lg-5" disabled>Buy Now</button>
                                    <?php

                                    $cart1_rs = Database::search("SELECT * FROM `cart` WHERE `products_id`='" . $search1_data["id"] . "'");
                                    $cart1_num = $cart1_rs->num_rows;
                                    if ($cart1_num == 1) {
                                    ?>
                                        <button class="btn btn-secondary mt-2 mt-lg-3 ms-lg-1 col-12 col-lg-6" id="s<?php echo ($search1_data["id"])  ?>" onclick="cart(<?php echo ($search1_data['id'])  ?>);" disabled>Added to Cart</button>
                                    <?php
                                    } else {
                                    ?>

                                        <button class="btn btn-primary mt-2 mt-lg-3 ms-lg-1 col-12 col-lg-6" id="s<?php echo ($search1_data["id"])  ?>" onclick="cart(<?php echo ($search1_data['id'])  ?>);">Add to Cart</button>

                                    <?php
                                    }
                                    ?>

                                    <?php

                                    $watch_rs = Database::search("SELECT * FROM `watchlist` WHERE `products_id`='" . $search1_data["id"] . "'");
                                    $watch_num = $watch_rs->num_rows;
                                    if ($watch_num == 1) {
                                    ?>
                                        <button class="btn btn-danger mt-2 mt-lg-3 ms-lg-1 col-12" id="w<?php echo ($search1_data["id"])  ?>" onclick="watchlist('<?php echo ($search1_data['id'])  ?>');" disabled>Added to Watchlist</button>
                                    <?php
                                    } else {
                                    ?>

                                        <button class="btn btn-warning mt-2 col-lg-11" id="w<?php echo ($search1_data["id"])  ?>" onclick="watchlist('<?php echo ($search1_data['id'])  ?>');">Add to Watchlist</button>

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
                                    <button class="btn btn-primary mt-3 col-12 col-lg-5" onclick="window.location='productView.php';">Buy Now</button>

                                    <?php

                                    $cart1_rs = Database::search("SELECT * FROM `cart` WHERE `products_id`='" . $search1_data["id"] . "'");
                                    $cart1_num = $cart1_rs->num_rows;
                                    if ($cart1_num == 1) {
                                    ?>
                                        <button class="btn btn-secondary mt-2 mt-lg-3 ms-lg-1 col-12 col-lg-6" id="s<?php echo ($search1_data["id"])  ?>" onclick="cart(<?php echo ($search1_data['id'])  ?>);" disabled>Added to Cart</button>
                                    <?php
                                    } else {
                                    ?>

                                        <button class="btn btn-primary mt-2 mt-lg-3 ms-lg-1 col-12 col-lg-6" id="s<?php echo ($search1_data["id"])  ?>" onclick="cart(<?php echo ($search1_data['id'])  ?>);">Add to Cart</button>

                                    <?php
                                    }
                                    ?>

                                    <?php

                                    $watch_rs = Database::search("SELECT * FROM `watchlist` WHERE `products_id`='" . $search1_data["id"] . "'");
                                    $watch_num = $watch_rs->num_rows;
                                    if ($watch_num == 1) {
                                    ?>
                                        <button class="btn btn-danger mt-2 mt-lg-3 ms-lg-1 col-12" id="w<?php echo ($search1_data["id"])  ?>" onclick="watchlist('<?php echo ($search1_data['id'])  ?>');" disabled>Added to Watchlist</button>
                                    <?php
                                    } else {
                                    ?>

                                        <button class="btn btn-warning mt-2 col-lg-11" id="w<?php echo ($search1_data["id"])  ?>" onclick="watchlist('<?php echo ($search1_data['id'])  ?>');">Add to Watchlist</button>

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
    }




    if ($price == 1 && $qty == 0) {
        $search1_rs = Database::search("SELECT * FROM `products` WHERE `product_name` LIKE '%" . $text . "%' AND `product_types_id` = '" . $selection . "' ORDER BY `price` DESC");
        $search1_num = $search1_rs->num_rows;
        ?>
        <p class="fs-4 p-3 fw-bold"><i class="bi bi-search fs-1"></i>&nbsp; &nbsp;<?php echo ($search1_num); ?> Items Found...</p>
        <?php
        for ($x = 0; $x < $search1_num; $x++) {
            $search1_data = $search1_rs->fetch_assoc();
        ?>
            <div class="col-12 offset-2 offset-lg-0 col-lg-2 mt-3 me-5">
                <div class="card" style="width: 18rem; height:550px;">
                    <img onclick="view(<?php echo ($search1_data['id'])  ?>);" src="<?php echo ($search1_data["pic"])  ?>" class="card-img-top" style="height:190px ;">
                    <div class="card-body">
                        <div style="height:75px ;" onclick="view(<?php echo ($search_data['id'])  ?>);" class="card-title text-center fs-6 text-success fw-bold"><?php echo ($search1_data["product_name"])  ?></div>
                        <p onclick="view(<?php echo ($search1_data['id'])  ?>);" class="card-text text-center col-12"> Rs. <?php echo ($search1_data["price"]); ?>.00</p>
                        <p onclick="view(<?php echo ($search1_data['id'])  ?>);" class="card-text text-center col-12"> <?php echo ($search1_data["quantity"]); ?> Items available</p>
                        <?php
                        if ($search1_data["quantity"] == 0) {
                        ?>
                            <div class="col-12 d-grid">
                                <div class="row pe-3 ps-3 pt-0">
                                    <button class="btn btn-primary mt-3 col-12 col-lg-5" disabled>Buy Now</button>
                                    <?php

                                    $cart1_rs = Database::search("SELECT * FROM `cart` WHERE `products_id`='" . $search1_data["id"] . "'");
                                    $cart1_num = $cart1_rs->num_rows;
                                    if ($cart1_num == 1) {
                                    ?>
                                        <button class="btn btn-secondary mt-2 mt-lg-3 ms-lg-1 col-12 col-lg-6" id="s<?php echo ($search1_data["id"])  ?>" onclick="cart(<?php echo ($search1_data['id'])  ?>);" disabled>Added to Cart</button>
                                    <?php
                                    } else {
                                    ?>

                                        <button class="btn btn-primary mt-2 mt-lg-3 ms-lg-1 col-12 col-lg-6" id="s<?php echo ($search1_data["id"])  ?>" onclick="cart(<?php echo ($search1_data['id'])  ?>);">Add to Cart</button>

                                    <?php
                                    }
                                    ?>

                                    <?php

                                    $watch_rs = Database::search("SELECT * FROM `watchlist` WHERE `products_id`='" . $search1_data["id"] . "'");
                                    $watch_num = $watch_rs->num_rows;
                                    if ($watch_num == 1) {
                                    ?>
                                        <button class="btn btn-danger mt-2 mt-lg-3 ms-lg-1 col-12" id="w<?php echo ($search1_data["id"])  ?>" onclick="watchlist('<?php echo ($search1_data['id'])  ?>');" disabled>Added to Watchlist</button>
                                    <?php
                                    } else {
                                    ?>

                                        <button class="btn btn-warning mt-2 col-lg-11" id="w<?php echo ($search1_data["id"])  ?>" onclick="watchlist('<?php echo ($search1_data['id'])  ?>');">Add to Watchlist</button>

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
                                    <button class="btn btn-primary mt-3 col-12 col-lg-5" onclick="window.location='productView.php';">Buy Now</button>

                                    <?php

                                    $cart1_rs = Database::search("SELECT * FROM `cart` WHERE `products_id`='" . $search1_data["id"] . "'");
                                    $cart1_num = $cart1_rs->num_rows;
                                    if ($cart1_num == 1) {
                                    ?>
                                        <button class="btn btn-secondary mt-2 mt-lg-3 ms-lg-1 col-12 col-lg-6" id="s<?php echo ($search1_data["id"])  ?>" onclick="cart(<?php echo ($search1_data['id'])  ?>);" disabled>Added to Cart</button>
                                    <?php
                                    } else {
                                    ?>

                                        <button class="btn btn-primary mt-2 mt-lg-3 ms-lg-1 col-12 col-lg-6" id="s<?php echo ($search1_data["id"])  ?>" onclick="cart(<?php echo ($search1_data['id'])  ?>);">Add to Cart</button>

                                    <?php
                                    }
                                    ?>


                                    <?php

                                    $watch_rs = Database::search("SELECT * FROM `watchlist` WHERE `products_id`='" . $search1_data["id"] . "'");
                                    $watch_num = $watch_rs->num_rows;
                                    if ($watch_num == 1) {
                                    ?>
                                        <button class="btn btn-danger mt-2 mt-lg-3 ms-lg-1 col-12" id="w<?php echo ($search1_data["id"])  ?>" onclick="watchlist('<?php echo ($search1_data['id'])  ?>');" disabled>Added to Watchlist</button>
                                    <?php
                                    } else {
                                    ?>

                                        <button class="btn btn-warning mt-2 col-lg-11" id="w<?php echo ($search1_data["id"])  ?>" onclick="watchlist('<?php echo ($search1_data['id'])  ?>');">Add to Watchlist</button>

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
    }





    if ($price == 2 && $qty == 0) {
        $search1_rs = Database::search("SELECT * FROM `products` WHERE `product_name` LIKE '%" . $text . "%' AND `product_types_id` = '" . $selection . "' ORDER BY `price` ASC");
        $search1_num = $search1_rs->num_rows;
        ?>
        <p class="fs-4 p-3 fw-bold"><i class="bi bi-search fs-1"></i>&nbsp; &nbsp;<?php echo ($search1_num); ?> Items Found...</p>
        <?php
        for ($x = 0; $x < $search1_num; $x++) {
            $search1_data = $search1_rs->fetch_assoc();
        ?>
            <div class="col-12 offset-2 offset-lg-0 col-lg-2 mt-3 me-5">
                <div class="card" style="width: 18rem; height:550px;">
                    <img onclick="view(<?php echo ($search1_data['id'])  ?>);" src="<?php echo ($search1_data["pic"])  ?>" class="card-img-top" style="height:190px ;">
                    <div class="card-body">
                        <div style="height:75px ;" onclick="view(<?php echo ($search_data['id'])  ?>);" class="card-title text-center fs-6 text-success fw-bold"><?php echo ($search1_data["product_name"])  ?></div>
                        <p onclick="view(<?php echo ($search1_data['id'])  ?>);" class="card-text text-center col-12"> Rs. <?php echo ($search1_data["price"]); ?>.00</p>
                        <p onclick="view(<?php echo ($search1_data['id'])  ?>);" class="card-text text-center col-12"> <?php echo ($search1_data["quantity"]); ?> Items available</p>
                        <?php
                        if ($search1_data["quantity"] == 0) {
                        ?>
                            <div class="col-12 d-grid">
                                <div class="row pe-3 ps-3 pt-0">
                                    <button class="btn btn-primary mt-3 col-12 col-lg-5" disabled>Buy Now</button>
                                    <?php

                                    $cart1_rs = Database::search("SELECT * FROM `cart` WHERE `products_id`='" . $search1_data["id"] . "'");
                                    $cart1_num = $cart1_rs->num_rows;
                                    if ($cart1_num == 1) {
                                    ?>
                                        <button class="btn btn-secondary mt-2 mt-lg-3 ms-lg-1 col-12 col-lg-6" id="s<?php echo ($search1_data["id"])  ?>" onclick="cart(<?php echo ($search1_data['id'])  ?>);" disabled>Added to Cart</button>
                                    <?php
                                    } else {
                                    ?>

                                        <button class="btn btn-primary mt-2 mt-lg-3 ms-lg-1 col-12 col-lg-6" id="s<?php echo ($search1_data["id"])  ?>" onclick="cart(<?php echo ($search1_data['id'])  ?>);">Add to Cart</button>

                                    <?php
                                    }
                                    ?>

                                    <?php

                                    $watch_rs = Database::search("SELECT * FROM `watchlist` WHERE `products_id`='" . $search1_data["id"] . "'");
                                    $watch_num = $watch_rs->num_rows;
                                    if ($watch_num == 1) {
                                    ?>
                                        <button class="btn btn-danger mt-2 mt-lg-3 ms-lg-1 col-12" id="w<?php echo ($search1_data["id"])  ?>" onclick="watchlist('<?php echo ($search1_data['id'])  ?>');" disabled>Added to Watchlist</button>
                                    <?php
                                    } else {
                                    ?>

                                        <button class="btn btn-warning mt-2 col-lg-11" id="w<?php echo ($search1_data["id"])  ?>" onclick="watchlist('<?php echo ($search1_data['id'])  ?>');">Add to Watchlist</button>

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
                                    <button class="btn btn-primary mt-3 col-12 col-lg-5" onclick="window.location='productView.php';">Buy Now</button>

                                    <?php

                                    $cart1_rs = Database::search("SELECT * FROM `cart` WHERE `products_id`='" . $search1_data["id"] . "'");
                                    $cart1_num = $cart1_rs->num_rows;
                                    if ($cart1_num == 1) {
                                    ?>
                                        <button class="btn btn-secondary mt-2 mt-lg-3 ms-lg-1 col-12 col-lg-6" id="s<?php echo ($search1_data["id"])  ?>" onclick="cart(<?php echo ($search1_data['id'])  ?>);" disabled>Added to Cart</button>
                                    <?php
                                    } else {
                                    ?>

                                        <button class="btn btn-primary mt-2 mt-lg-3 ms-lg-1 col-12 col-lg-6" id="s<?php echo ($search1_data["id"])  ?>" onclick="cart(<?php echo ($search1_data['id'])  ?>);">Add to Cart</button>

                                    <?php
                                    }
                                    ?>

                                    <?php

                                    $watch_rs = Database::search("SELECT * FROM `watchlist` WHERE `products_id`='" . $search1_data["id"] . "'");
                                    $watch_num = $watch_rs->num_rows;
                                    if ($watch_num == 1) {
                                    ?>
                                        <button class="btn btn-danger mt-2 mt-lg-3 ms-lg-1 col-12" id="w<?php echo ($search1_data["id"])  ?>" onclick="watchlist('<?php echo ($search1_data['id'])  ?>');" disabled>Added to Watchlist</button>
                                    <?php
                                    } else {
                                    ?>

                                        <button class="btn btn-warning mt-2 col-lg-11" id="w<?php echo ($search1_data["id"])  ?>" onclick="watchlist('<?php echo ($search1_data['id'])  ?>');">Add to Watchlist</button>

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
    }




    if ($price == 0 && $qty == 1) {
        $search1_rs = Database::search("SELECT * FROM `products` WHERE `product_name` LIKE '%" . $text . "%' AND `product_types_id` = '" . $selection . "' ORDER BY `quantity` DESC");
        $search1_num = $search1_rs->num_rows;
        ?>
        <p class="fs-4 p-3 fw-bold"><i class="bi bi-search fs-1"></i>&nbsp; &nbsp;<?php echo ($search1_num); ?> Items Found...</p>
        <?php
        for ($x = 0; $x < $search1_num; $x++) {
            $search1_data = $search1_rs->fetch_assoc();
        ?>
            <div class="col-12 offset-2 offset-lg-0 col-lg-2 mt-3 me-5">
                <div class="card" style="width: 18rem; height:550px;">
                    <img onclick="view(<?php echo ($search1_data['id'])  ?>);" src="<?php echo ($search1_data["pic"])  ?>" class="card-img-top" style="height:190px ;">
                    <div class="card-body">
                        <div style="height:75px ;" onclick="view(<?php echo ($search_data['id'])  ?>);" class="card-title text-center fs-6 text-success fw-bold"><?php echo ($search1_data["product_name"])  ?></div>
                        <p onclick="view(<?php echo ($search1_data['id'])  ?>);" class="card-text text-center col-12"> Rs. <?php echo ($search1_data["price"]); ?>.00</p>
                        <p onclick="view(<?php echo ($search1_data['id'])  ?>);" class="card-text text-center col-12"> <?php echo ($search1_data["quantity"]); ?> Items available</p>
                        <?php
                        if ($search1_data["quantity"] == 0) {
                        ?>
                            <div class="col-12 d-grid">
                                <div class="row pe-3 ps-3 pt-0">
                                    <button class="btn btn-primary mt-3 col-12 col-lg-5" disabled>Buy Now</button>
                                    <?php
                                    $cart1_rs = Database::search("SELECT * FROM `cart` WHERE `products_id`='" . $search1_data["id"] . "'");
                                    $cart1_num = $cart1_rs->num_rows;
                                    if ($cart1_num == 1) {
                                    ?>
                                        <button class="btn btn-secondary mt-2 mt-lg-3 ms-lg-1 col-12 col-lg-6" id="s<?php echo ($search1_data["id"])  ?>" onclick="cart(<?php echo ($search1_data['id'])  ?>);" disabled>Added to Cart</button>
                                    <?php
                                    } else {
                                    ?>
                                        <button class="btn btn-primary mt-2 mt-lg-3 ms-lg-1 col-12 col-lg-6" id="s<?php echo ($search1_data["id"])  ?>" onclick="cart(<?php echo ($search1_data['id'])  ?>);">Add to Cart</button>
                                    <?php
                                    }
                                    ?>
                                    <?php

                                    $watch_rs = Database::search("SELECT * FROM `watchlist` WHERE `products_id`='" . $search1_data["id"] . "'");
                                    $watch_num = $watch_rs->num_rows;
                                    if ($watch_num == 1) {
                                    ?>
                                        <button class="btn btn-danger mt-2 mt-lg-3 ms-lg-1 col-12" id="w<?php echo ($search1_data["id"])  ?>" onclick="watchlist('<?php echo ($search1_data['id'])  ?>');" disabled>Added to Watchlist</button>
                                    <?php
                                    } else {
                                    ?>

                                        <button class="btn btn-warning mt-2 col-lg-11" id="w<?php echo ($search1_data["id"])  ?>" onclick="watchlist('<?php echo ($search1_data['id'])  ?>');">Add to Watchlist</button>

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
                                    <button class="btn btn-primary mt-3 col-12 col-lg-5" onclick="window.location='productView.php';">Buy Now</button>

                                    <?php

                                    $cart1_rs = Database::search("SELECT * FROM `cart` WHERE `products_id`='" . $search1_data["id"] . "'");
                                    $cart1_num = $cart1_rs->num_rows;
                                    if ($cart1_num == 1) {
                                    ?>
                                        <button class="btn btn-secondary mt-2 mt-lg-3 ms-lg-1 col-12 col-lg-6" id="s<?php echo ($search1_data["id"])  ?>" onclick="cart(<?php echo ($search1_data['id'])  ?>);" disabled>Added to Cart</button>
                                    <?php
                                    } else {
                                    ?>

                                        <button class="btn btn-primary mt-2 mt-lg-3 ms-lg-1 col-12 col-lg-6" id="s<?php echo ($search1_data["id"])  ?>" onclick="cart(<?php echo ($search1_data['id'])  ?>);">Add to Cart</button>

                                    <?php
                                    }
                                    ?>

                                    <?php

                                    $watch_rs = Database::search("SELECT * FROM `watchlist` WHERE `products_id`='" . $search1_data["id"] . "'");
                                    $watch_num = $watch_rs->num_rows;
                                    if ($watch_num == 1) {
                                    ?>
                                        <button class="btn btn-danger mt-2 mt-lg-3 ms-lg-1 col-12" id="w<?php echo ($search1_data["id"])  ?>" onclick="watchlist('<?php echo ($search1_data['id'])  ?>');" disabled>Added to Watchlist</button>
                                    <?php
                                    } else {
                                    ?>

                                        <button class="btn btn-warning mt-2 col-lg-11" id="w<?php echo ($search1_data["id"])  ?>" onclick="watchlist('<?php echo ($search1_data['id'])  ?>');">Add to Watchlist</button>

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
    }




    if ($price == 0 && $qty == 2) {
        $search1_rs = Database::search("SELECT * FROM `products` WHERE `product_name` LIKE '%" . $text . "%' AND `product_types_id` = '" . $selection . "' ORDER BY `quantity` ASC");
        $search1_num = $search1_rs->num_rows;
        ?>
        <p class="fs-4 p-3 fw-bold"><i class="bi bi-search fs-1"></i>&nbsp; &nbsp;<?php echo ($search1_num); ?> Items Found...</p>
        <?php
        for ($x = 0; $x < $search1_num; $x++) {
            $search1_data = $search1_rs->fetch_assoc();
        ?>
            <div class="col-12 offset-2 offset-lg-0 col-lg-2 mt-3 me-5">
                <div class="card" style="width: 18rem; height:550px;">
                    <img onclick="view(<?php echo ($search1_data['id'])  ?>);" src="<?php echo ($search1_data["pic"])  ?>" class="card-img-top" style="height:190px ;">
                    <div class="card-body">
                        <div style="height:75px ;" onclick="view(<?php echo ($search_data['id'])  ?>);" class="card-title text-center fs-6 text-success fw-bold"><?php echo ($search1_data["product_name"])  ?></div>
                        <p onclick="view(<?php echo ($search1_data['id'])  ?>);" class="card-text text-center col-12"> Rs. <?php echo ($search1_data["price"]); ?>.00</p>
                        <p onclick="view(<?php echo ($search1_data['id'])  ?>);" class="card-text text-center col-12"> <?php echo ($search1_data["quantity"]); ?> Items available</p>
                        <?php
                        if ($search1_data["quantity"] == 0) {
                        ?>
                            <div class="col-12 d-grid">
                                <div class="row pe-3 ps-3 pt-0">
                                    <button class="btn btn-primary mt-3 col-12 col-lg-5" disabled>Buy Now</button>
                                    <?php

                                    $cart1_rs = Database::search("SELECT * FROM `cart` WHERE `products_id`='" . $search1_data["id"] . "'");
                                    $cart1_num = $cart1_rs->num_rows;
                                    if ($cart1_num == 1) {
                                    ?>
                                        <button class="btn btn-secondary mt-2 mt-lg-3 ms-lg-1 col-12 col-lg-6" id="s<?php echo ($search1_data["id"])  ?>" onclick="cart(<?php echo ($search1_data['id'])  ?>);" disabled>Added to Cart</button>
                                    <?php
                                    } else {
                                    ?>

                                        <button class="btn btn-primary mt-2 mt-lg-3 ms-lg-1 col-12 col-lg-6" id="s<?php echo ($search1_data["id"])  ?>" onclick="cart(<?php echo ($search1_data['id'])  ?>);">Add to Cart</button>

                                    <?php
                                    }
                                    ?>

                                    <?php

                                    $watch_rs = Database::search("SELECT * FROM `watchlist` WHERE `products_id`='" . $search1_data["id"] . "'");
                                    $watch_num = $watch_rs->num_rows;
                                    if ($watch_num == 1) {
                                    ?>
                                        <button class="btn btn-danger mt-2 mt-lg-3 ms-lg-1 col-12" id="w<?php echo ($search1_data["id"])  ?>" onclick="watchlist('<?php echo ($search1_data['id'])  ?>');" disabled>Added to Watchlist</button>
                                    <?php
                                    } else {
                                    ?>

                                        <button class="btn btn-warning mt-2 col-lg-11" id="w<?php echo ($search1_data["id"])  ?>" onclick="watchlist('<?php echo ($search1_data['id'])  ?>');">Add to Watchlist</button>

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
                                    <button class="btn btn-primary mt-3 col-12 col-lg-5" onclick="window.location='productView.php';">Buy Now</button>

                                    <?php

                                    $cart1_rs = Database::search("SELECT * FROM `cart` WHERE `products_id`='" . $search1_data["id"] . "'");
                                    $cart1_num = $cart1_rs->num_rows;
                                    if ($cart1_num == 1) {
                                    ?>
                                        <button class="btn btn-secondary mt-2 mt-lg-3 ms-lg-1 col-12 col-lg-6" id="s<?php echo ($search1_data["id"])  ?>" onclick="cart(<?php echo ($search1_data['id'])  ?>);" disabled>Added to Cart</button>
                                    <?php
                                    } else {
                                    ?>

                                        <button class="btn btn-primary mt-2 mt-lg-3 ms-lg-1 col-12 col-lg-6" id="s<?php echo ($search1_data["id"])  ?>" onclick="cart(<?php echo ($search1_data['id'])  ?>);">Add to Cart</button>

                                    <?php
                                    }
                                    ?>



                                    <?php

                                    $watch_rs = Database::search("SELECT * FROM `watchlist` WHERE `products_id`='" . $search1_data["id"] . "'");
                                    $watch_num = $watch_rs->num_rows;
                                    if ($watch_num == 1) {
                                    ?>
                                        <button class="btn btn-danger mt-2 mt-lg-3 ms-lg-1 col-12" id="w<?php echo ($search1_data["id"])  ?>" onclick="watchlist('<?php echo ($search1_data['id'])  ?>');" disabled>Added to Watchlist</button>
                                    <?php
                                    } else {
                                    ?>

                                        <button class="btn btn-warning mt-2 col-lg-11" id="w<?php echo ($search1_data["id"])  ?>" onclick="watchlist('<?php echo ($search1_data['id'])  ?>');">Add to Watchlist</button>

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
    }


    if ($qty == 0 && $price == 0 && !empty($p1) && empty($p2)) {
        $search1_rs = Database::search("SELECT * FROM `products` WHERE `product_name` LIKE '%" . $text . "%' AND `product_types_id` = '" . $selection . "' AND `price` >= '" . $p1 . "'");
        $search1_num = $search1_rs->num_rows;

        ?>
        <p class="fs-4 p-3 fw-bold"><i class="bi bi-search fs-1"></i>&nbsp; &nbsp;<?php echo ($search1_num); ?> Items Found...</p>
        <?php
        for ($x = 0; $x < $search1_num; $x++) {
            $search1_data = $search1_rs->fetch_assoc();
        ?>
            <div class="col-12 offset-2 offset-lg-0 col-lg-2 mt-3 me-5">
                <div class="card" style="width: 18rem; height:550px;">
                    <img onclick="view(<?php echo ($search1_data['id'])  ?>);" src="<?php echo ($search1_data["pic"])  ?>" class="card-img-top" style="height:190px ;">
                    <div class="card-body">
                        <div style="height:75px ;" onclick="view(<?php echo ($search_data['id'])  ?>);" class="card-title text-center fs-6 text-success fw-bold"><?php echo ($search1_data["product_name"])  ?></div>
                        <p onclick="view(<?php echo ($search1_data['id'])  ?>);" class="card-text text-center col-12"> Rs. <?php echo ($search1_data["price"]); ?>.00</p>
                        <p onclick="view(<?php echo ($search1_data['id'])  ?>);" class="card-text text-center col-12"> <?php echo ($search1_data["quantity"]); ?> Items available</p>
                        <?php
                        if ($search1_data["quantity"] == 0) {
                        ?>
                            <div class="col-12 d-grid">
                                <div class="row pe-3 ps-3 pt-0">
                                    <button class="btn btn-primary mt-3 col-12 col-lg-5" disabled>Buy Now</button>
                                    <?php

                                    $cart1_rs = Database::search("SELECT * FROM `cart` WHERE `products_id`='" . $search1_data["id"] . "'");
                                    $cart1_num = $cart1_rs->num_rows;
                                    if ($cart1_num == 1) {
                                    ?>
                                        <button class="btn btn-secondary mt-2 mt-lg-3 ms-lg-1 col-12 col-lg-6" id="s<?php echo ($search1_data["id"])  ?>" onclick="cart(<?php echo ($search1_data['id'])  ?>);" disabled>Added to Cart</button>
                                    <?php
                                    } else {
                                    ?>

                                        <button class="btn btn-primary mt-2 mt-lg-3 ms-lg-1 col-12 col-lg-6" id="s<?php echo ($search1_data["id"])  ?>" onclick="cart(<?php echo ($search1_data['id'])  ?>);">Add to Cart</button>

                                    <?php
                                    }
                                    ?>

                                    <?php

                                    $watch_rs = Database::search("SELECT * FROM `watchlist` WHERE `products_id`='" . $search1_data["id"] . "'");
                                    $watch_num = $watch_rs->num_rows;
                                    if ($watch_num == 1) {
                                    ?>
                                        <button class="btn btn-danger mt-2 mt-lg-3 ms-lg-1 col-12" id="w<?php echo ($search1_data["id"])  ?>" onclick="watchlist('<?php echo ($search1_data['id'])  ?>');" disabled>Added to Watchlist</button>
                                    <?php
                                    } else {
                                    ?>

                                        <button class="btn btn-warning mt-2 col-lg-11" id="w<?php echo ($search1_data["id"])  ?>" onclick="watchlist('<?php echo ($search1_data['id'])  ?>');">Add to Watchlist</button>

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
                                    <button class="btn btn-primary mt-3 col-12 col-lg-5" onclick="window.location='productView.php';">Buy Now</button>

                                    <?php

                                    $cart1_rs = Database::search("SELECT * FROM `cart` WHERE `products_id`='" . $search1_data["id"] . "'");
                                    $cart1_num = $cart1_rs->num_rows;
                                    if ($cart1_num == 1) {
                                    ?>
                                        <button class="btn btn-secondary mt-2 mt-lg-3 ms-lg-1 col-12 col-lg-6" id="s<?php echo ($search1_data["id"])  ?>" onclick="cart(<?php echo ($search1_data['id'])  ?>);" disabled>Added to Cart</button>
                                    <?php
                                    } else {
                                    ?>

                                        <button class="btn btn-primary mt-2 mt-lg-3 ms-lg-1 col-12 col-lg-6" id="s<?php echo ($search1_data["id"])  ?>" onclick="cart(<?php echo ($search1_data['id'])  ?>);">Add to Cart</button>

                                    <?php
                                    }
                                    ?>


                                    <?php

                                    $watch_rs = Database::search("SELECT * FROM `watchlist` WHERE `products_id`='" . $search1_data["id"] . "'");
                                    $watch_num = $watch_rs->num_rows;
                                    if ($watch_num == 1) {
                                    ?>
                                        <button class="btn btn-danger mt-2 mt-lg-3 ms-lg-1 col-12" id="w<?php echo ($search1_data["id"])  ?>" onclick="watchlist('<?php echo ($search1_data['id'])  ?>');" disabled>Added to Watchlist</button>
                                    <?php
                                    } else {
                                    ?>

                                        <button class="btn btn-warning mt-2 col-lg-11" id="w<?php echo ($search1_data["id"])  ?>" onclick="watchlist('<?php echo ($search1_data['id'])  ?>');">Add to Watchlist</button>

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
    }



    if ($qty == 0 && $price == 0 && !empty($p2) && empty($p1)) {
        $search1_rs = Database::search("SELECT * FROM `products`WHERE `product_name` LIKE '%" . $text . "%' AND `product_types_id` = '" . $selection . "' AND `price` <= '" . $p2 . "'");
        $search1_num = $search1_rs->num_rows;

        ?>
        <p class="fs-4 p-3 fw-bold"><i class="bi bi-search fs-1"></i>&nbsp; &nbsp;<?php echo ($search1_num); ?> Items Found...</p>
        <?php
        for ($x = 0; $x < $search1_num; $x++) {
            $search1_data = $search1_rs->fetch_assoc();
        ?>
            <div class="col-12 offset-2 offset-lg-0 col-lg-2 mt-3 me-5">
                <div class="card" style="width: 18rem; height:550px;">
                    <img onclick="view(<?php echo ($search1_data['id'])  ?>);" src="<?php echo ($search1_data["pic"])  ?>" class="card-img-top" style="height:190px ;">
                    <div class="card-body">
                        <div style="height:75px ;" onclick="view(<?php echo ($search_data['id'])  ?>);" class="card-title text-center fs-6 text-success fw-bold"><?php echo ($search1_data["product_name"])  ?></div>
                        <p onclick="view(<?php echo ($search1_data['id'])  ?>);" class="card-text text-center col-12"> Rs. <?php echo ($search1_data["price"]); ?>.00</p>
                        <p onclick="view(<?php echo ($search1_data['id'])  ?>);" class="card-text text-center col-12"> <?php echo ($search1_data["quantity"]); ?> Items available</p>
                        <?php
                        if ($search1_data["quantity"] == 0) {
                        ?>
                            <div class="col-12 d-grid">
                                <div class="row pe-3 ps-3 pt-0">
                                    <button class="btn btn-primary mt-3 col-12 col-lg-5" disabled>Buy Now</button>
                                    <?php

                                    $cart1_rs = Database::search("SELECT * FROM `cart` WHERE `products_id`='" . $search1_data["id"] . "'");
                                    $cart1_num = $cart1_rs->num_rows;
                                    if ($cart1_num == 1) {
                                    ?>
                                        <button class="btn btn-secondary mt-2 mt-lg-3 ms-lg-1 col-12 col-lg-6" id="s<?php echo ($search1_data["id"])  ?>" onclick="cart(<?php echo ($search1_data['id'])  ?>);" disabled>Added to Cart</button>
                                    <?php
                                    } else {
                                    ?>

                                        <button class="btn btn-primary mt-2 mt-lg-3 ms-lg-1 col-12 col-lg-6" id="s<?php echo ($search1_data["id"])  ?>" onclick="cart(<?php echo ($search1_data['id'])  ?>);">Add to Cart</button>

                                    <?php
                                    }
                                    ?>

                                    <?php

                                    $watch_rs = Database::search("SELECT * FROM `watchlist` WHERE `products_id`='" . $search1_data["id"] . "'");
                                    $watch_num = $watch_rs->num_rows;
                                    if ($watch_num == 1) {
                                    ?>
                                        <button class="btn btn-danger mt-2 mt-lg-3 ms-lg-1 col-12" id="w<?php echo ($search1_data["id"])  ?>" onclick="watchlist('<?php echo ($search1_data['id'])  ?>');" disabled>Added to Watchlist</button>
                                    <?php
                                    } else {
                                    ?>

                                        <button class="btn btn-warning mt-2 col-lg-11" id="w<?php echo ($search1_data["id"])  ?>" onclick="watchlist('<?php echo ($search1_data['id'])  ?>');">Add to Watchlist</button>

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
                                    <button class="btn btn-primary mt-3 col-12 col-lg-5" onclick="window.location='productView.php';">Buy Now</button>

                                    <?php

                                    $cart1_rs = Database::search("SELECT * FROM `cart` WHERE `products_id`='" . $search1_data["id"] . "'");
                                    $cart1_num = $cart1_rs->num_rows;
                                    if ($cart1_num == 1) {
                                    ?>
                                        <button class="btn btn-secondary mt-2 mt-lg-3 ms-lg-1 col-12 col-lg-6" id="s<?php echo ($search1_data["id"])  ?>" onclick="cart(<?php echo ($search1_data['id'])  ?>);" disabled>Added to Cart</button>
                                    <?php
                                    } else {
                                    ?>

                                        <button class="btn btn-primary mt-2 mt-lg-3 ms-lg-1 col-12 col-lg-6" id="s<?php echo ($search1_data["id"])  ?>" onclick="cart(<?php echo ($search1_data['id'])  ?>);">Add to Cart</button>

                                    <?php
                                    }
                                    ?>


                                    <?php

                                    $watch_rs = Database::search("SELECT * FROM `watchlist` WHERE `products_id`='" . $search1_data["id"] . "'");
                                    $watch_num = $watch_rs->num_rows;
                                    if ($watch_num == 1) {
                                    ?>
                                        <button class="btn btn-danger mt-2 mt-lg-3 ms-lg-1 col-12" id="w<?php echo ($search1_data["id"])  ?>" onclick="watchlist('<?php echo ($search1_data['id'])  ?>');" disabled>Added to Watchlist</button>
                                    <?php
                                    } else {
                                    ?>

                                        <button class="btn btn-warning mt-2 col-lg-11" id="w<?php echo ($search1_data["id"])  ?>" onclick="watchlist('<?php echo ($search1_data['id'])  ?>');">Add to Watchlist</button>

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
    }


    if ($qty == 0 && $price == 0 && !empty($p2) && !empty($p1)) {
        $search1_rs = Database::search("SELECT * FROM `products` WHERE `product_name` LIKE '%" . $text . "%' AND `product_types_id` = '" . $selection . "' AND `price` BETWEEN '" . $p1 . "' AND '" . $p2 . "'");
        $search1_num = $search1_rs->num_rows;

        ?>
        <p class="fs-4 p-3 fw-bold"><i class="bi bi-search fs-1"></i>&nbsp; &nbsp;<?php echo ($search1_num); ?> Items Found...</p>
        <?php
        for ($x = 0; $x < $search1_num; $x++) {
            $search1_data = $search1_rs->fetch_assoc();
        ?>
            <div class="col-12 offset-2 offset-lg-0 col-lg-2 mt-3 me-5">
                <div class="card" style="width: 18rem; height:550px;">
                    <img onclick="view(<?php echo ($search1_data['id'])  ?>);" src="<?php echo ($search1_data["pic"])  ?>" class="card-img-top" style="height:190px ;">
                    <div class="card-body">
                        <div style="height:75px ;" onclick="view(<?php echo ($search_data['id'])  ?>);" class="card-title text-center fs-6 text-success fw-bold"><?php echo ($search1_data["product_name"])  ?></div>
                        <p onclick="view(<?php echo ($search1_data['id'])  ?>);" class="card-text text-center col-12"> Rs. <?php echo ($search1_data["price"]); ?>.00</p>
                        <p onclick="view(<?php echo ($search1_data['id'])  ?>);" class="card-text text-center col-12"> <?php echo ($search1_data["quantity"]); ?> Items available</p>
                        <?php
                        if ($search1_data["quantity"] == 0) {
                        ?>
                            <div class="col-12 d-grid">
                                <div class="row pe-3 ps-3 pt-0">
                                    <button class="btn btn-primary mt-3 col-12 col-lg-5" disabled>Buy Now</button>
                                    <?php

                                    $cart1_rs = Database::search("SELECT * FROM `cart` WHERE `products_id`='" . $search1_data["id"] . "'");
                                    $cart1_num = $cart1_rs->num_rows;
                                    if ($cart1_num == 1) {
                                    ?>
                                        <button class="btn btn-secondary mt-2 mt-lg-3 ms-lg-1 col-12 col-lg-6" id="s<?php echo ($search1_data["id"])  ?>" onclick="cart(<?php echo ($search1_data['id'])  ?>);" disabled>Added to Cart</button>
                                    <?php
                                    } else {
                                    ?>

                                        <button class="btn btn-primary mt-2 mt-lg-3 ms-lg-1 col-12 col-lg-6" id="s<?php echo ($search1_data["id"])  ?>" onclick="cart(<?php echo ($search1_data['id'])  ?>);">Add to Cart</button>

                                    <?php
                                    }
                                    ?>

                                    <?php

                                    $watch_rs = Database::search("SELECT * FROM `watchlist` WHERE `products_id`='" . $search1_data["id"] . "'");
                                    $watch_num = $watch_rs->num_rows;
                                    if ($watch_num == 1) {
                                    ?>
                                        <button class="btn btn-danger mt-2 mt-lg-3 ms-lg-1 col-12" id="w<?php echo ($search1_data["id"])  ?>" onclick="watchlist('<?php echo ($search1_data['id'])  ?>');" disabled>Added to Watchlist</button>
                                    <?php
                                    } else {
                                    ?>

                                        <button class="btn btn-warning mt-2 col-lg-11" id="w<?php echo ($search1_data["id"])  ?>" onclick="watchlist('<?php echo ($search1_data['id'])  ?>');">Add to Watchlist</button>

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
                                    <button class="btn btn-primary mt-3 col-12 col-lg-5" onclick="window.location='productView.php';">Buy Now</button>

                                    <?php

                                    $cart1_rs = Database::search("SELECT * FROM `cart` WHERE `products_id`='" . $search1_data["id"] . "'");
                                    $cart1_num = $cart1_rs->num_rows;
                                    if ($cart1_num == 1) {
                                    ?>
                                        <button class="btn btn-secondary mt-2 mt-lg-3 ms-lg-1 col-12 col-lg-6" id="s<?php echo ($search1_data["id"])  ?>" onclick="cart(<?php echo ($search1_data['id'])  ?>);" disabled>Added to Cart</button>
                                    <?php
                                    } else {
                                    ?>

                                        <button class="btn btn-primary mt-2 mt-lg-3 ms-lg-1 col-12 col-lg-6" id="s<?php echo ($search1_data["id"])  ?>" onclick="cart(<?php echo ($search1_data['id'])  ?>);">Add to Cart</button>

                                    <?php
                                    }
                                    ?>



                                    <?php

                                    $watch_rs = Database::search("SELECT * FROM `watchlist` WHERE `products_id`='" . $search1_data["id"] . "'");
                                    $watch_num = $watch_rs->num_rows;
                                    if ($watch_num == 1) {
                                    ?>
                                        <button class="btn btn-danger mt-2 mt-lg-3 ms-lg-1 col-12" id="w<?php echo ($search1_data["id"])  ?>" onclick="watchlist('<?php echo ($search1_data['id'])  ?>');" disabled>Added to Watchlist</button>
                                    <?php
                                    } else {
                                    ?>

                                        <button class="btn btn-warning mt-2 col-lg-11" id="w<?php echo ($search1_data["id"])  ?>" onclick="watchlist('<?php echo ($search1_data['id'])  ?>');">Add to Watchlist</button>

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
    }
} else if (empty($text) && $selection > 0) {
    if ($price == 0 && $qty == 0 && empty($p1) && empty($p2)) {
        $search1_rs = Database::search("SELECT * FROM `products` WHERE `product_types_id` = '" . $selection . "'");
        $search1_num = $search1_rs->num_rows;

        ?>
        <p class="fs-4 p-3 fw-bold"><i class="bi bi-search fs-1"></i>&nbsp; &nbsp;<?php echo ($search1_num); ?> Items Found...</p>
        <?php
        for ($x = 0; $x < $search1_num; $x++) {
            $search1_data = $search1_rs->fetch_assoc();
        ?>
            <div class="col-12 offset-2 offset-lg-0 col-lg-2 mt-3 me-5">
                <div class="card" style="width: 18rem; height:550px;">
                    <img onclick="view(<?php echo ($search1_data['id'])  ?>);" src="<?php echo ($search1_data["pic"])  ?>" class="card-img-top" style="height:190px ;">
                    <div class="card-body">
                        <div style="height:75px ;" onclick="view(<?php echo ($search_data['id'])  ?>);" class="card-title text-center fs-6 text-success fw-bold"><?php echo ($search1_data["product_name"])  ?></div>
                        <p onclick="view(<?php echo ($search1_data['id'])  ?>);" class="card-text text-center col-12"> Rs. <?php echo ($search1_data["price"]); ?>.00</p>
                        <p onclick="view(<?php echo ($search1_data['id'])  ?>);" class="card-text text-center col-12"> <?php echo ($search1_data["quantity"]); ?> Items available</p>
                        <?php
                        if ($search1_data["quantity"] == 0) {
                        ?>
                            <div class="col-12 d-grid">
                                <div class="row pe-3 ps-3 pt-0">
                                    <button class="btn btn-primary mt-3 col-12 col-lg-5" onclick="window.location='productView.php';" disabled>Buy Now</button>
                                    <?php

                                    $cart1_rs = Database::search("SELECT * FROM `cart` WHERE `products_id`='" . $search1_data["id"] . "'");
                                    $cart1_num = $cart1_rs->num_rows;
                                    if ($cart1_num == 1) {
                                    ?>
                                        <button class="btn btn-secondary mt-2 mt-lg-3 ms-lg-1 col-12 col-lg-6" id="s<?php echo ($search1_data["id"])  ?>" onclick="cart(<?php echo ($search1_data['id'])  ?>);" disabled>Added to Cart</button>
                                    <?php
                                    } else {
                                    ?>

                                        <button class="btn btn-primary mt-2 mt-lg-3 ms-lg-1 col-12 col-lg-6" id="s<?php echo ($search1_data["id"])  ?>" onclick="cart(<?php echo ($search1_data['id'])  ?>);">Add to Cart</button>

                                    <?php
                                    }
                                    ?>

                                    <?php

                                    $watch_rs = Database::search("SELECT * FROM `watchlist` WHERE `products_id`='" . $search1_data["id"] . "'");
                                    $watch_num = $watch_rs->num_rows;
                                    if ($watch_num == 1) {
                                    ?>
                                        <button class="btn btn-danger mt-2 mt-lg-3 ms-lg-1 col-12" id="w<?php echo ($search1_data["id"])  ?>" onclick="watchlist('<?php echo ($search1_data['id'])  ?>');" disabled>Added to Watchlist</button>
                                    <?php
                                    } else {
                                    ?>

                                        <button class="btn btn-warning mt-2 col-lg-11" id="w<?php echo ($search1_data["id"])  ?>" onclick="watchlist('<?php echo ($search1_data['id'])  ?>');">Add to Watchlist</button>

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
                                    <button class="btn btn-primary mt-3 col-12 col-lg-5" onclick="window.location='productView.php';">Buy Now</button>
                                    <?php

                                    $cart1_rs = Database::search("SELECT * FROM `cart` WHERE `products_id`='" . $search1_data["id"] . "'");
                                    $cart1_num = $cart1_rs->num_rows;
                                    if ($cart1_num == 1) {
                                    ?>
                                        <button class="btn btn-secondary mt-2 mt-lg-3 ms-lg-1 col-12 col-lg-6" id="s<?php echo ($search1_data["id"])  ?>" onclick="cart(<?php echo ($search1_data['id'])  ?>);" disabled>Added to Cart</button>
                                    <?php
                                    } else {
                                    ?>

                                        <button class="btn btn-primary mt-2 mt-lg-3 ms-lg-1 col-12 col-lg-6" id="s<?php echo ($search1_data["id"])  ?>" onclick="cart(<?php echo ($search1_data['id'])  ?>);">Add to Cart</button>

                                    <?php
                                    }
                                    ?>



                                    <?php

                                    $watch_rs = Database::search("SELECT * FROM `watchlist` WHERE `products_id`='" . $search1_data["id"] . "'");
                                    $watch_num = $watch_rs->num_rows;
                                    if ($watch_num == 1) {
                                    ?>
                                        <button class="btn btn-danger mt-2 mt-lg-3 ms-lg-1 col-12" id="w<?php echo ($search1_data["id"])  ?>" onclick="watchlist('<?php echo ($search1_data['id'])  ?>');" disabled>Added to Watchlist</button>
                                    <?php
                                    } else {
                                    ?>

                                        <button class="btn btn-warning mt-2 col-lg-11" id="w<?php echo ($search1_data["id"])  ?>" onclick="watchlist('<?php echo ($search1_data['id'])  ?>');">Add to Watchlist</button>

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
    }


    if ($price == 1 && $qty == 0) {
        $search1_rs = Database::search("SELECT * FROM `products` WHERE `product_types_id` = '" . $selection . "' ORDER BY `price` DESC");
        $search1_num = $search1_rs->num_rows;

        ?>
        <p class="fs-4 p-3 fw-bold"><i class="bi bi-search fs-1"></i>&nbsp; &nbsp;<?php echo ($search1_num); ?> Items Found...</p>
        <?php
        for ($x = 0; $x < $search1_num; $x++) {
            $search1_data = $search1_rs->fetch_assoc();
        ?>
            <div class="col-12 offset-2 offset-lg-0 col-lg-2 mt-3 me-5">
                <div class="card" style="width: 18rem; height:550px;">
                    <img onclick="view(<?php echo ($search1_data['id'])  ?>);" src="<?php echo ($search1_data["pic"])  ?>" class="card-img-top" style="height:190px ;">
                    <div class="card-body">
                        <div style="height:75px ;" onclick="view(<?php echo ($search_data['id'])  ?>);" class="card-title text-center fs-6 text-success fw-bold"><?php echo ($search1_data["product_name"])  ?></div>
                        <p onclick="view(<?php echo ($search1_data['id'])  ?>);" class="card-text text-center col-12"> Rs. <?php echo ($search1_data["price"]); ?>.00</p>
                        <p onclick="view(<?php echo ($search1_data['id'])  ?>);" class="card-text text-center col-12"> <?php echo ($search1_data["quantity"]); ?> Items available</p>
                        <?php
                        if ($search1_data["quantity"] == 0) {
                        ?>
                            <div class="col-12 d-grid">
                                <div class="row pe-3 ps-3 pt-0">
                                    <button class="btn btn-primary mt-3 col-12 col-lg-5" disabled>Buy Now</button>
                                    <?php

                                    $cart1_rs = Database::search("SELECT * FROM `cart` WHERE `products_id`='" . $search1_data["id"] . "'");
                                    $cart1_num = $cart1_rs->num_rows;
                                    if ($cart1_num == 1) {
                                    ?>
                                        <button class="btn btn-secondary mt-2 mt-lg-3 ms-lg-1 col-12 col-lg-6" id="s<?php echo ($search1_data["id"])  ?>" onclick="cart(<?php echo ($search1_data['id'])  ?>);" disabled>Added to Cart</button>
                                    <?php
                                    } else {
                                    ?>

                                        <button class="btn btn-primary mt-2 mt-lg-3 ms-lg-1 col-12 col-lg-6" id="s<?php echo ($search1_data["id"])  ?>" onclick="cart(<?php echo ($search1_data['id'])  ?>);">Add to Cart</button>

                                    <?php
                                    }
                                    ?>

                                    <?php

                                    $watch_rs = Database::search("SELECT * FROM `watchlist` WHERE `products_id`='" . $search1_data["id"] . "'");
                                    $watch_num = $watch_rs->num_rows;
                                    if ($watch_num == 1) {
                                    ?>
                                        <button class="btn btn-danger mt-2 mt-lg-3 ms-lg-1 col-12" id="w<?php echo ($search1_data["id"])  ?>" onclick="watchlist('<?php echo ($search1_data['id'])  ?>');" disabled>Added to Watchlist</button>
                                    <?php
                                    } else {
                                    ?>

                                        <button class="btn btn-warning mt-2 col-lg-11" id="w<?php echo ($search1_data["id"])  ?>" onclick="watchlist('<?php echo ($search1_data['id'])  ?>');">Add to Watchlist</button>

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
                                    <button class="btn btn-primary mt-3 col-12 col-lg-5" onclick="window.location='productView.php';">Buy Now</button>

                                    <?php

                                    $cart1_rs = Database::search("SELECT * FROM `cart` WHERE `products_id`='" . $search1_data["id"] . "'");
                                    $cart1_num = $cart1_rs->num_rows;
                                    if ($cart1_num == 1) {
                                    ?>
                                        <button class="btn btn-secondary mt-2 mt-lg-3 ms-lg-1 col-12 col-lg-6" id="s<?php echo ($search1_data["id"])  ?>" onclick="cart(<?php echo ($search1_data['id'])  ?>);" disabled>Added to Cart</button>
                                    <?php
                                    } else {
                                    ?>

                                        <button class="btn btn-primary mt-2 mt-lg-3 ms-lg-1 col-12 col-lg-6" id="s<?php echo ($search1_data["id"])  ?>" onclick="cart(<?php echo ($search1_data['id'])  ?>);">Add to Cart</button>

                                    <?php
                                    }
                                    ?>




                                    <?php

                                    $watch_rs = Database::search("SELECT * FROM `watchlist` WHERE `products_id`='" . $search1_data["id"] . "'");
                                    $watch_num = $watch_rs->num_rows;
                                    if ($watch_num == 1) {
                                    ?>
                                        <button class="btn btn-danger mt-2 mt-lg-3 ms-lg-1 col-12" id="w<?php echo ($search1_data["id"])  ?>" onclick="watchlist('<?php echo ($search1_data['id'])  ?>');" disabled>Added to Watchlist</button>
                                    <?php
                                    } else {
                                    ?>

                                        <button class="btn btn-warning mt-2 col-lg-11" id="w<?php echo ($search1_data["id"])  ?>" onclick="watchlist('<?php echo ($search1_data['id'])  ?>');">Add to Watchlist</button>

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
    }
    if ($price == 2 && $qty == 0) {
        $search1_rs = Database::search("SELECT * FROM `products` WHERE `product_types_id` = '" . $selection . "' ORDER BY `price` ASC");
        $search1_num = $search1_rs->num_rows;

        ?>
        <p class="fs-4 p-3 fw-bold"><i class="bi bi-search fs-1"></i>&nbsp; &nbsp;<?php echo ($search1_num); ?> Items Found...</p>
        <?php
        for ($x = 0; $x < $search1_num; $x++) {
            $search1_data = $search1_rs->fetch_assoc();
        ?>
            <div class="col-12 offset-2 offset-lg-0 col-lg-2 mt-3 me-5">
                <div class="card" style="width: 18rem; height:550px;">
                    <img onclick="view(<?php echo ($search1_data['id'])  ?>);" src="<?php echo ($search1_data["pic"])  ?>" class="card-img-top" style="height:190px ;">
                    <div class="card-body">
                        <div style="height:75px ;" onclick="view(<?php echo ($search_data['id'])  ?>);" class="card-title text-center fs-6 text-success fw-bold"><?php echo ($search1_data["product_name"])  ?></div>
                        <p onclick="view(<?php echo ($search1_data['id'])  ?>);" class="card-text text-center col-12"> Rs. <?php echo ($search1_data["price"]); ?>.00</p>
                        <p onclick="view(<?php echo ($search1_data['id'])  ?>);" class="card-text text-center col-12"> <?php echo ($search1_data["quantity"]); ?> Items available</p>
                        <?php
                        if ($search1_data["quantity"] == 0) {
                        ?>
                            <div class="col-12 d-grid">
                                <div class="row pe-3 ps-3 pt-0">
                                    <button class="btn btn-primary mt-3 col-12 col-lg-5" disabled>Buy Now</button>
                                    <?php

                                    $cart1_rs = Database::search("SELECT * FROM `cart` WHERE `products_id`='" . $search1_data["id"] . "'");
                                    $cart1_num = $cart1_rs->num_rows;
                                    if ($cart1_num == 1) {
                                    ?>
                                        <button class="btn btn-secondary mt-2 mt-lg-3 ms-lg-1 col-12 col-lg-6" id="s<?php echo ($search1_data["id"])  ?>" onclick="cart(<?php echo ($search1_data['id'])  ?>);" disabled>Added to Cart</button>
                                    <?php
                                    } else {
                                    ?>

                                        <button class="btn btn-primary mt-2 mt-lg-3 ms-lg-1 col-12 col-lg-6" id="s<?php echo ($search1_data["id"])  ?>" onclick="cart(<?php echo ($search1_data['id'])  ?>);">Add to Cart</button>

                                    <?php
                                    }
                                    ?>

                                    <?php

                                    $watch_rs = Database::search("SELECT * FROM `watchlist` WHERE `products_id`='" . $search1_data["id"] . "'");
                                    $watch_num = $watch_rs->num_rows;
                                    if ($watch_num == 1) {
                                    ?>
                                        <button class="btn btn-danger mt-2 mt-lg-3 ms-lg-1 col-12" id="w<?php echo ($search1_data["id"])  ?>" onclick="watchlist('<?php echo ($search1_data['id'])  ?>');" disabled>Added to Watchlist</button>
                                    <?php
                                    } else {
                                    ?>

                                        <button class="btn btn-warning mt-2 col-lg-11" id="w<?php echo ($search1_data["id"])  ?>" onclick="watchlist('<?php echo ($search1_data['id'])  ?>');">Add to Watchlist</button>

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
                                    <button class="btn btn-primary mt-3 col-12 col-lg-5" onclick="window.location='productView.php';">Buy Now</button>

                                    <?php

                                    $cart1_rs = Database::search("SELECT * FROM `cart` WHERE `products_id`='" . $search1_data["id"] . "'");
                                    $cart1_num = $cart1_rs->num_rows;
                                    if ($cart1_num == 1) {
                                    ?>
                                        <button class="btn btn-secondary mt-2 mt-lg-3 ms-lg-1 col-12 col-lg-6" id="s<?php echo ($search1_data["id"])  ?>" onclick="cart(<?php echo ($search1_data['id'])  ?>);" disabled>Added to Cart</button>
                                    <?php
                                    } else {
                                    ?>

                                        <button class="btn btn-primary mt-2 mt-lg-3 ms-lg-1 col-12 col-lg-6" id="s<?php echo ($search1_data["id"])  ?>" onclick="cart(<?php echo ($search1_data['id'])  ?>);">Add to Cart</button>

                                    <?php
                                    }
                                    ?>



                                    <?php

                                    $watch_rs = Database::search("SELECT * FROM `watchlist` WHERE `products_id`='" . $search1_data["id"] . "'");
                                    $watch_num = $watch_rs->num_rows;
                                    if ($watch_num == 1) {
                                    ?>
                                        <button class="btn btn-danger mt-2 mt-lg-3 ms-lg-1 col-12" id="w<?php echo ($search1_data["id"])  ?>" onclick="watchlist('<?php echo ($search1_data['id'])  ?>');" disabled>Added to Watchlist</button>
                                    <?php
                                    } else {
                                    ?>

                                        <button class="btn btn-warning mt-2 col-lg-11" id="w<?php echo ($search1_data["id"])  ?>" onclick="watchlist('<?php echo ($search1_data['id'])  ?>');">Add to Watchlist</button>

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
    }
    if ($qty == 1 && $price == 0) {
        $search1_rs = Database::search("SELECT * FROM `products` WHERE `product_types_id` = '" . $selection . "' ORDER BY `quantity` DESC");
        $search1_num = $search1_rs->num_rows;

        ?>
        <p class="fs-4 p-3 fw-bold"><i class="bi bi-search fs-1"></i>&nbsp; &nbsp;<?php echo ($search1_num); ?> Items Found...</p>
        <?php
        for ($x = 0; $x < $search1_num; $x++) {
            $search1_data = $search1_rs->fetch_assoc();
        ?>
            <div class="col-12 offset-2 offset-lg-0 col-lg-2 mt-3 me-5">
                <div class="card" style="width: 18rem; height:550px;">
                    <img onclick="view(<?php echo ($search1_data['id'])  ?>);" src="<?php echo ($search1_data["pic"])  ?>" class="card-img-top" style="height:190px ;">
                    <div class="card-body">
                        <div style="height:75px ;" onclick="view(<?php echo ($search_data['id'])  ?>);" class="card-title text-center fs-6 text-success fw-bold"><?php echo ($search1_data["product_name"])  ?></div>
                        <p onclick="view(<?php echo ($search1_data['id'])  ?>);" class="card-text text-center col-12"> Rs. <?php echo ($search1_data["price"]); ?>.00</p>
                        <p onclick="view(<?php echo ($search1_data['id'])  ?>);" class="card-text text-center col-12"> <?php echo ($search1_data["quantity"]); ?> Items available</p>
                        <?php
                        if ($search1_data["quantity"] == 0) {
                        ?>
                            <div class="col-12 d-grid">
                                <div class="row pe-3 ps-3 pt-0">
                                    <button class="btn btn-primary mt-3 col-12 col-lg-5" disabled>Buy Now</button>
                                    <?php

                                    $cart1_rs = Database::search("SELECT * FROM `cart` WHERE `products_id`='" . $search1_data["id"] . "'");
                                    $cart1_num = $cart1_rs->num_rows;
                                    if ($cart1_num == 1) {
                                    ?>
                                        <button class="btn btn-secondary mt-2 mt-lg-3 ms-lg-1 col-12 col-lg-6" id="s<?php echo ($search1_data["id"])  ?>" onclick="cart(<?php echo ($search1_data['id'])  ?>);" disabled>Added to Cart</button>
                                    <?php
                                    } else {
                                    ?>

                                        <button class="btn btn-primary mt-2 mt-lg-3 ms-lg-1 col-12 col-lg-6" id="s<?php echo ($search1_data["id"])  ?>" onclick="cart(<?php echo ($search1_data['id'])  ?>);">Add to Cart</button>

                                    <?php
                                    }
                                    ?>

                                    <?php

                                    $watch_rs = Database::search("SELECT * FROM `watchlist` WHERE `products_id`='" . $search1_data["id"] . "'");
                                    $watch_num = $watch_rs->num_rows;
                                    if ($watch_num == 1) {
                                    ?>
                                        <button class="btn btn-danger mt-2 mt-lg-3 ms-lg-1 col-12" id="w<?php echo ($search1_data["id"])  ?>" onclick="watchlist('<?php echo ($search1_data['id'])  ?>');" disabled>Added to Watchlist</button>
                                    <?php
                                    } else {
                                    ?>

                                        <button class="btn btn-warning mt-2 col-lg-11" id="w<?php echo ($search1_data["id"])  ?>" onclick="watchlist('<?php echo ($search1_data['id'])  ?>');">Add to Watchlist</button>

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
                                    <button class="btn btn-primary mt-3 col-12 col-lg-5" onclick="window.location='productView.php';">Buy Now</button>

                                    <?php

                                    $cart1_rs = Database::search("SELECT * FROM `cart` WHERE `products_id`='" . $search1_data["id"] . "'");
                                    $cart1_num = $cart1_rs->num_rows;
                                    if ($cart1_num == 1) {
                                    ?>
                                        <button class="btn btn-secondary mt-2 mt-lg-3 ms-lg-1 col-12 col-lg-6" id="s<?php echo ($search1_data["id"])  ?>" onclick="cart(<?php echo ($search1_data['id'])  ?>);" disabled>Added to Cart</button>
                                    <?php
                                    } else {
                                    ?>

                                        <button class="btn btn-primary mt-2 mt-lg-3 ms-lg-1 col-12 col-lg-6" id="s<?php echo ($search1_data["id"])  ?>" onclick="cart(<?php echo ($search1_data['id'])  ?>);">Add to Cart</button>

                                    <?php
                                    }
                                    ?>




                                    <?php

                                    $watch_rs = Database::search("SELECT * FROM `watchlist` WHERE `products_id`='" . $search1_data["id"] . "'");
                                    $watch_num = $watch_rs->num_rows;
                                    if ($watch_num == 1) {
                                    ?>
                                        <button class="btn btn-danger mt-2 mt-lg-3 ms-lg-1 col-12" id="w<?php echo ($search1_data["id"])  ?>" onclick="watchlist('<?php echo ($search1_data['id'])  ?>');" disabled>Added to Watchlist</button>
                                    <?php
                                    } else {
                                    ?>

                                        <button class="btn btn-warning mt-2 col-lg-11" id="w<?php echo ($search1_data["id"])  ?>" onclick="watchlist('<?php echo ($search1_data['id'])  ?>');">Add to Watchlist</button>

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
    }
    if ($qty == 2 && $price == 0) {
        $search1_rs = Database::search("SELECT * FROM `products` WHERE `product_types_id` = '" . $selection . "' ORDER BY `quantity` ASC");
        $search1_num = $search1_rs->num_rows;

        ?>
        <p class="fs-4 p-3 fw-bold"><i class="bi bi-search fs-1"></i>&nbsp; &nbsp;<?php echo ($search1_num); ?> Items Found...</p>
        <?php
        for ($x = 0; $x < $search1_num; $x++) {
            $search1_data = $search1_rs->fetch_assoc();
        ?>
            <div class="col-12 offset-2 offset-lg-0 col-lg-2 mt-3 me-5">
                <div class="card" style="width: 18rem; height:550px;">
                    <img onclick="view(<?php echo ($search1_data['id'])  ?>);" src="<?php echo ($search1_data["pic"])  ?>" class="card-img-top" style="height:190px ;">
                    <div class="card-body">
                        <div style="height:75px ;" onclick="view(<?php echo ($search_data['id'])  ?>);" class="card-title text-center fs-6 text-success fw-bold"><?php echo ($search1_data["product_name"])  ?></div>
                        <p onclick="view(<?php echo ($search1_data['id'])  ?>);" class="card-text text-center col-12"> Rs. <?php echo ($search1_data["price"]); ?>.00</p>
                        <p onclick="view(<?php echo ($search1_data['id'])  ?>);" class="card-text text-center col-12"> <?php echo ($search1_data["quantity"]); ?> Items available</p>
                        <?php
                        if ($search1_data["quantity"] == 0) {
                        ?>
                            <div class="col-12 d-grid">
                                <div class="row pe-3 ps-3 pt-0">
                                    <button class="btn btn-primary mt-3 col-12 col-lg-5" disabled>Buy Now</button>
                                    <?php

                                    $cart1_rs = Database::search("SELECT * FROM `cart` WHERE `products_id`='" . $search1_data["id"] . "'");
                                    $cart1_num = $cart1_rs->num_rows;
                                    if ($cart1_num == 1) {
                                    ?>
                                        <button class="btn btn-secondary mt-2 mt-lg-3 ms-lg-1 col-12 col-lg-6" id="s<?php echo ($search1_data["id"])  ?>" onclick="cart(<?php echo ($search1_data['id'])  ?>);" disabled>Added to Cart</button>
                                    <?php
                                    } else {
                                    ?>

                                        <button class="btn btn-primary mt-2 mt-lg-3 ms-lg-1 col-12 col-lg-6" id="s<?php echo ($search1_data["id"])  ?>" onclick="cart(<?php echo ($search1_data['id'])  ?>);">Add to Cart</button>

                                    <?php
                                    }
                                    ?>

                                    <?php

                                    $watch_rs = Database::search("SELECT * FROM `watchlist` WHERE `products_id`='" . $search1_data["id"] . "'");
                                    $watch_num = $watch_rs->num_rows;
                                    if ($watch_num == 1) {
                                    ?>
                                        <button class="btn btn-danger mt-2 mt-lg-3 ms-lg-1 col-12" id="w<?php echo ($search1_data["id"])  ?>" onclick="watchlist('<?php echo ($search1_data['id'])  ?>');" disabled>Added to Watchlist</button>
                                    <?php
                                    } else {
                                    ?>

                                        <button class="btn btn-warning mt-2 col-lg-11" id="w<?php echo ($search1_data["id"])  ?>" onclick="watchlist('<?php echo ($search1_data['id'])  ?>');">Add to Watchlist</button>

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
                                    <button class="btn btn-primary mt-3 col-12 col-lg-5" onclick="window.location='productView.php';">Buy Now</button>

                                    <?php

                                    $cart1_rs = Database::search("SELECT * FROM `cart` WHERE `products_id`='" . $search1_data["id"] . "'");
                                    $cart1_num = $cart1_rs->num_rows;
                                    if ($cart1_num == 1) {
                                    ?>
                                        <button class="btn btn-secondary mt-2 mt-lg-3 ms-lg-1 col-12 col-lg-6" id="s<?php echo ($search1_data["id"])  ?>" onclick="cart(<?php echo ($search1_data['id'])  ?>);" disabled>Added to Cart</button>
                                    <?php
                                    } else {
                                    ?>

                                        <button class="btn btn-primary mt-2 mt-lg-3 ms-lg-1 col-12 col-lg-6" id="s<?php echo ($search1_data["id"])  ?>" onclick="cart(<?php echo ($search1_data['id'])  ?>);">Add to Cart</button>

                                    <?php
                                    }
                                    ?>



                                    <?php

                                    $watch_rs = Database::search("SELECT * FROM `watchlist` WHERE `products_id`='" . $search1_data["id"] . "'");
                                    $watch_num = $watch_rs->num_rows;
                                    if ($watch_num == 1) {
                                    ?>
                                        <button class="btn btn-danger mt-2 mt-lg-3 ms-lg-1 col-12" id="w<?php echo ($search1_data["id"])  ?>" onclick="watchlist('<?php echo ($search1_data['id'])  ?>');" disabled>Added to Watchlist</button>
                                    <?php
                                    } else {
                                    ?>

                                        <button class="btn btn-warning mt-2 col-lg-11" id="w<?php echo ($search1_data["id"])  ?>" onclick="watchlist('<?php echo ($search1_data['id'])  ?>');">Add to Watchlist</button>

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
    }
    if ($qty == 0 && $price == 0 && !empty($p1) && empty($p2)) {
        $search1_rs = Database::search("SELECT * FROM `products` WHERE `product_types_id` = '" . $selection . "' AND `price` >= '" . $p1 . "'");
        $search1_num = $search1_rs->num_rows;

        ?>
        <p class="fs-4 p-3 fw-bold"><i class="bi bi-search fs-1"></i>&nbsp; &nbsp;<?php echo ($search1_num); ?> Items Found...</p>
        <?php
        for ($x = 0; $x < $search1_num; $x++) {
            $search1_data = $search1_rs->fetch_assoc();
        ?>
            <div class="col-12 offset-2 offset-lg-0 col-lg-2 mt-3 me-5">
                <div class="card" style="width: 18rem; height:550px;">
                    <img onclick="view(<?php echo ($search1_data['id'])  ?>);" src="<?php echo ($search1_data["pic"])  ?>" class="card-img-top" style="height:190px ;">
                    <div class="card-body">
                        <div style="height:75px ;" onclick="view(<?php echo ($search1_data['id'])  ?>);" class="card-title text-center fs-6 text-success fw-bold"><?php echo ($search1_data["product_name"])  ?></div>
                        <p onclick="view(<?php echo ($search1_data['id'])  ?>);" class="card-text text-center col-12"> Rs. <?php echo ($search1_data["price"]); ?>.00</p>
                        <p onclick="view(<?php echo ($search1_data['id'])  ?>);" class="card-text text-center col-12"> <?php echo ($search1_data["quantity"]); ?> Items available</p>
                        <?php
                        if ($search1_data["quantity"] == 0) {
                        ?>
                            <div class="col-12 d-grid">
                                <div class="row pe-3 ps-3 pt-0">
                                    <button class="btn btn-primary mt-3 col-12 col-lg-5" disabled>Buy Now</button>
                                    <?php

                                    $cart1_rs = Database::search("SELECT * FROM `cart` WHERE `products_id`='" . $search1_data["id"] . "'");
                                    $cart1_num = $cart1_rs->num_rows;
                                    if ($cart1_num == 1) {
                                    ?>
                                        <button class="btn btn-secondary mt-2 mt-lg-3 ms-lg-1 col-12 col-lg-6" id="s<?php echo ($search1_data["id"])  ?>" onclick="cart(<?php echo ($search1_data['id'])  ?>);" disabled>Added to Cart</button>
                                    <?php
                                    } else {
                                    ?>

                                        <button class="btn btn-primary mt-2 mt-lg-3 ms-lg-1 col-12 col-lg-6" id="s<?php echo ($search1_data["id"])  ?>" onclick="cart(<?php echo ($search1_data['id'])  ?>);">Add to Cart</button>

                                    <?php
                                    }
                                    ?>

                                    <?php

                                    $watch_rs = Database::search("SELECT * FROM `watchlist` WHERE `products_id`='" . $search1_data["id"] . "'");
                                    $watch_num = $watch_rs->num_rows;
                                    if ($watch_num == 1) {
                                    ?>
                                        <button class="btn btn-danger mt-2 mt-lg-3 ms-lg-1 col-12" id="w<?php echo ($search1_data["id"])  ?>" onclick="watchlist('<?php echo ($search1_data['id'])  ?>');" disabled>Added to Watchlist</button>
                                    <?php
                                    } else {
                                    ?>

                                        <button class="btn btn-warning mt-2 col-lg-11" id="w<?php echo ($search1_data["id"])  ?>" onclick="watchlist('<?php echo ($search1_data['id'])  ?>');">Add to Watchlist</button>

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
                                    <button class="btn btn-primary mt-3 col-12 col-lg-5" onclick="window.location='productView.php';">Buy Now</button>

                                    <?php

                                    $cart1_rs = Database::search("SELECT * FROM `cart` WHERE `products_id`='" . $search1_data["id"] . "'");
                                    $cart1_num = $cart1_rs->num_rows;
                                    if ($cart1_num == 1) {
                                    ?>
                                        <button class="btn btn-secondary mt-2 mt-lg-3 ms-lg-1 col-12 col-lg-6" id="s<?php echo ($search1_data["id"])  ?>" onclick="cart(<?php echo ($search1_data['id'])  ?>);" disabled>Added to Cart</button>
                                    <?php
                                    } else {
                                    ?>

                                        <button class="btn btn-primary mt-2 mt-lg-3 ms-lg-1 col-12 col-lg-6" id="s<?php echo ($search1_data["id"])  ?>" onclick="cart(<?php echo ($search1_data['id'])  ?>);">Add to Cart</button>

                                    <?php
                                    }
                                    ?>
                                    <?php

                                    $watch_rs = Database::search("SELECT * FROM `watchlist` WHERE `products_id`='" . $search1_data["id"] . "'");
                                    $watch_num = $watch_rs->num_rows;
                                    if ($watch_num == 1) {
                                    ?>
                                        <button class="btn btn-danger mt-2 mt-lg-3 ms-lg-1 col-12" id="w<?php echo ($search1_data["id"])  ?>" onclick="watchlist('<?php echo ($search1_data['id'])  ?>');" disabled>Added to Watchlist</button>
                                    <?php
                                    } else {
                                    ?>

                                        <button class="btn btn-warning mt-2 col-lg-11" id="w<?php echo ($search1_data["id"])  ?>" onclick="watchlist('<?php echo ($search1_data['id'])  ?>');">Add to Watchlist</button>

                                    <?php
                                    }
                                    ?>


                                </div>
                            </div>
                    </div>



            <?php
                        }
                    }
                }
                if ($qty == 0 && $price == 0 && !empty($p2) && empty($p1)) {
                    $search1_rs = Database::search("SELECT * FROM `products` WHERE `product_types_id` = '" . $selection . "' AND `price` <= '" . $p2 . "'");
                    $search1_num = $search1_rs->num_rows;

            ?>
            <p class="fs-4 p-3 fw-bold"><i class="bi bi-search fs-1"></i>&nbsp; &nbsp;<?php echo ($search1_num); ?> Items Found...</p>
            <?php
                    for ($x = 0; $x < $search1_num; $x++) {
                        $search1_data = $search1_rs->fetch_assoc();
            ?>
                <div class="col-12 offset-2 offset-lg-0 col-lg-2 mt-3 me-5">
                    <div class="card" style="width: 18rem; height:550px;">
                        <img onclick="view(<?php echo ($search1_data['id'])  ?>);" src="<?php echo ($search1_data["pic"])  ?>" class="card-img-top" style="height:190px ;">
                        <div class="card-body">
                            <div style="height:75px ;" onclick="view(<?php echo ($search_data['id'])  ?>);" class="card-title text-center fs-6 text-success fw-bold"><?php echo ($search1_data["product_name"])  ?></div>
                            <p onclick="view(<?php echo ($search1_data['id'])  ?>);" class="card-text text-center col-12"> Rs. <?php echo ($search1_data["price"]); ?>.00</p>
                            <p onclick="view(<?php echo ($search1_data['id'])  ?>);" class="card-text text-center col-12"> <?php echo ($search1_data["quantity"]); ?> Items available</p>
                            <?php
                            if ($search1_data["quantity"] == 0) {
                            ?>
                                <div class="col-12 d-grid">
                                    <div class="row pe-3 ps-3 pt-0">
                                        <button class="btn btn-primary mt-3 col-12 col-lg-5" disabled>Buy Now</button>
                                        <?php

                                        $cart1_rs = Database::search("SELECT * FROM `cart` WHERE `products_id`='" . $search1_data["id"] . "'");
                                        $cart1_num = $cart1_rs->num_rows;
                                        if ($cart1_num == 1) {
                                        ?>
                                            <button class="btn btn-secondary mt-2 mt-lg-3 ms-lg-1 col-12 col-lg-6" id="s<?php echo ($search1_data["id"])  ?>" onclick="cart(<?php echo ($search1_data['id'])  ?>);" disabled>Added to Cart</button>
                                        <?php
                                        } else {
                                        ?>

                                            <button class="btn btn-primary mt-2 mt-lg-3 ms-lg-1 col-12 col-lg-6" id="s<?php echo ($search1_data["id"])  ?>" onclick="cart(<?php echo ($search1_data['id'])  ?>);">Add to Cart</button>

                                        <?php
                                        }
                                        ?>

                                        <?php

                                        $watch_rs = Database::search("SELECT * FROM `watchlist` WHERE `products_id`='" . $search1_data["id"] . "'");
                                        $watch_num = $watch_rs->num_rows;
                                        if ($watch_num == 1) {
                                        ?>
                                            <button class="btn btn-danger mt-2 mt-lg-3 ms-lg-1 col-12" id="w<?php echo ($search1_data["id"])  ?>" onclick="watchlist('<?php echo ($search1_data['id'])  ?>');" disabled>Added to Watchlist</button>
                                        <?php
                                        } else {
                                        ?>

                                            <button class="btn btn-warning mt-2 col-lg-11" id="w<?php echo ($search1_data["id"])  ?>" onclick="watchlist('<?php echo ($search1_data['id'])  ?>');">Add to Watchlist</button>

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
                                        <button class="btn btn-primary mt-3 col-12 col-lg-5" onclick="window.location='productView.php';">Buy Now</button>

                                        <?php

                                        $cart1_rs = Database::search("SELECT * FROM `cart` WHERE `products_id`='" . $search1_data["id"] . "'");
                                        $cart1_num = $cart1_rs->num_rows;
                                        if ($cart1_num == 1) {
                                        ?>
                                            <button class="btn btn-secondary mt-2 mt-lg-3 ms-lg-1 col-12 col-lg-6" id="s<?php echo ($search1_data["id"])  ?>" onclick="cart(<?php echo ($search1_data['id'])  ?>);" disabled>Added to Cart</button>
                                        <?php
                                        } else {
                                        ?>

                                            <button class="btn btn-primary mt-2 mt-lg-3 ms-lg-1 col-12 col-lg-6" id="s<?php echo ($search1_data["id"])  ?>" onclick="cart(<?php echo ($search1_data['id'])  ?>);">Add to Cart</button>

                                        <?php
                                        }
                                        ?>
                                        <?php

                                        $watch_rs = Database::search("SELECT * FROM `watchlist` WHERE `products_id`='" . $search1_data["id"] . "'");
                                        $watch_num = $watch_rs->num_rows;
                                        if ($watch_num == 1) {
                                        ?>
                                            <button class="btn btn-danger mt-2 mt-lg-3 ms-lg-1 col-12" id="w<?php echo ($search1_data["id"])  ?>" onclick="watchlist('<?php echo ($search1_data['id'])  ?>');" disabled>Added to Watchlist</button>
                                        <?php
                                        } else {
                                        ?>

                                            <button class="btn btn-warning mt-2 col-lg-11" id="w<?php echo ($search1_data["id"])  ?>" onclick="watchlist('<?php echo ($search1_data['id'])  ?>');">Add to Watchlist</button>

                                        <?php
                                        }
                                        ?>


                                    </div>
                                </div>
                        </div>



                <?php
                            }
                        }
                    }
                    if ($qty == 0 && $price == 0 && !empty($p2) && !empty($p1)) {
                        $search1_rs = Database::search("SELECT * FROM `products` WHERE `product_types_id` = '" . $selection . "' AND `price` BETWEEN '" . $p1 . "' AND '" . $p2 . "'");
                        $search1_num = $search1_rs->num_rows;

                ?>
                <p class="fs-4 p-3 fw-bold"><i class="bi bi-search fs-1"></i>&nbsp; &nbsp;<?php echo ($search1_num); ?> Items Found...</p>
                <?php
                        for ($x = 0; $x < $search1_num; $x++) {
                            $search1_data = $search1_rs->fetch_assoc();
                ?>
                    <div class="col-12 offset-2 offset-lg-0 col-lg-2 mt-3 me-5">
                        <div class="card" style="width: 18rem; height:550px;">
                            <img onclick="view(<?php echo ($search1_data['id'])  ?>);" src="<?php echo ($search1_data["pic"])  ?>" class="card-img-top" style="height:190px ;">
                            <div class="card-body">
                                <div style="height:75px ;" onclick="view(<?php echo ($search1_data['id'])  ?>);" class="card-title text-center fs-6 text-success fw-bold"><?php echo ($search1_data["product_name"])  ?></div>
                                <p onclick="view(<?php echo ($search1_data['id'])  ?>);" class="card-text text-center col-12"> Rs. <?php echo ($search1_data["price"]); ?>.00</p>
                                <p onclick="view(<?php echo ($search1_data['id'])  ?>);" class="card-text text-center col-12"> <?php echo ($search1_data["quantity"]); ?> Items available</p>
                                <?php
                                if ($search1_data["quantity"] == 0) {
                                ?>
                                    <div class="col-12 d-grid">
                                        <div class="row pe-3 ps-3 pt-0">
                                            <button class="btn btn-primary mt-3 col-12 col-lg-5" disabled>Buy Now</button>
                                            <?php

                                            $cart1_rs = Database::search("SELECT * FROM `cart` WHERE `products_id`='" . $search1_data["id"] . "'");
                                            $cart1_num = $cart1_rs->num_rows;
                                            if ($cart1_num == 1) {
                                            ?>
                                                <button class="btn btn-secondary mt-2 mt-lg-3 ms-lg-1 col-12 col-lg-6" id="s<?php echo ($search1_data["id"])  ?>" onclick="cart(<?php echo ($search1_data['id'])  ?>);" disabled>Added to Cart</button>
                                            <?php
                                            } else {
                                            ?>

                                                <button class="btn btn-primary mt-2 mt-lg-3 ms-lg-1 col-12 col-lg-6" id="s<?php echo ($search1_data["id"])  ?>" onclick="cart(<?php echo ($search1_data['id'])  ?>);">Add to Cart</button>

                                            <?php
                                            }
                                            ?>

                                            <?php

                                            $watch_rs = Database::search("SELECT * FROM `watchlist` WHERE `products_id`='" . $search1_data["id"] . "'");
                                            $watch_num = $watch_rs->num_rows;
                                            if ($watch_num == 1) {
                                            ?>
                                                <button class="btn btn-danger mt-2 mt-lg-3 ms-lg-1 col-12" id="w<?php echo ($search1_data["id"])  ?>" onclick="watchlist('<?php echo ($search1_data['id'])  ?>');" disabled>Added to Watchlist</button>
                                            <?php
                                            } else {
                                            ?>

                                                <button class="btn btn-warning mt-2 col-lg-11" id="w<?php echo ($search1_data["id"])  ?>" onclick="watchlist('<?php echo ($search1_data['id'])  ?>');">Add to Watchlist</button>

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
                                            <button class="btn btn-primary mt-3 col-12 col-lg-5" onclick="window.location='productView.php';">Buy Now</button>

                                            <?php

                                            $cart1_rs = Database::search("SELECT * FROM `cart` WHERE `products_id`='" . $search1_data["id"] . "'");
                                            $cart1_num = $cart1_rs->num_rows;
                                            if ($cart1_num == 1) {
                                            ?>
                                                <button class="btn btn-secondary mt-2 mt-lg-3 ms-lg-1 col-12 col-lg-6" id="s<?php echo ($search1_data["id"])  ?>" onclick="cart(<?php echo ($search1_data['id'])  ?>);" disabled>Added to Cart</button>
                                            <?php
                                            } else {
                                            ?>

                                                <button class="btn btn-primary mt-2 mt-lg-3 ms-lg-1 col-12 col-lg-6" id="s<?php echo ($search1_data["id"])  ?>" onclick="cart(<?php echo ($search1_data['id'])  ?>);">Add to Cart</button>

                                            <?php
                                            }
                                            ?>
                                            <?php

                                            $watch_rs = Database::search("SELECT * FROM `watchlist` WHERE `products_id`='" . $search1_data["id"] . "'");
                                            $watch_num = $watch_rs->num_rows;
                                            if ($watch_num == 1) {
                                            ?>
                                                <button class="btn btn-danger mt-2 mt-lg-3 ms-lg-1 col-12" id="w<?php echo ($search1_data["id"])  ?>" onclick="watchlist('<?php echo ($search1_data['id'])  ?>');" disabled>Added to Watchlist</button>
                                            <?php
                                            } else {
                                            ?>

                                                <button class="btn btn-warning mt-2 col-lg-11" id="w<?php echo ($search1_data["id"])  ?>" onclick="watchlist('<?php echo ($search1_data['id'])  ?>');">Add to Watchlist</button>

                                            <?php
                                            }
                                            ?>


                                        </div>
                                    </div>
                            </div>



            <?php
                                }
                            }
                        }
                    }

            ?>