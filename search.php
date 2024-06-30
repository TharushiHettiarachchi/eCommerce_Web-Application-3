<?php
require "connection.php";
$search = $_GET["s"];
$search_rs = Database::search("SELECT * FROM `products` WHERE `product_name` LIKE '%".$search."%'");
$search_num = $search_rs->num_rows;
?>

<p class="fs-4 p-3 fw-bold pt-3 pt-lg-0"><i class="bi bi-search fs-1"></i>&nbsp; &nbsp;<?php echo($search_num); ?> Items Found...</p>
<?php
for($x = 0; $x < $search_num; $x++){
    $search_data = $search_rs->fetch_assoc();
    ?>
  <div class="col-12 offset-2 offset-lg-0 col-lg-2 mt-3 pt-lg-0  me-lg-5">
                                    <div class="card" style="width: 18rem; height:575px;">
                                        <img onclick="view(<?php echo ($search_data['id'])  ?>);" src="<?php echo ($search_data["pic"])  ?>" class="card-img-top" style="height:190px ;">
                                        <div class="card-body">
                                            <div style="height:75px ;" onclick="view(<?php echo ($search_data['id'])  ?>);" class="card-title text-center fs-6 text-success fw-bold"><?php echo ($search_data["product_name"])  ?></div>
                                            <p onclick="view(<?php echo ($search_data['id'])  ?>);" class="card-text text-center col-12"> Rs. <?php echo ($search_data["price"]); ?>.00</p>
                                            <p onclick="view(<?php echo ($search_data['id'])  ?>);" class="card-text text-center col-12"> 3 Items available</p>
                                            <div class="col-12 d-grid">
                                                <div class="row pe-3 ps-3 pt-0">
                                                    <button class="btn btn-primary mt-3 col-12 col-lg-5" onclick="window.location = 'productView.php';">Buy Now</button>
                                                    <?php

                                                    $cart_rs = Database::search("SELECT * FROM `cart` WHERE `products_id`='" . $search_data["id"] . "'");
                                                    $cart_num = $cart_rs->num_rows;
                                                    if ($cart_num == 1) {
                                                    ?>
                                                        <button class="btn btn-secondary mt-2 mt-lg-3 ms-lg-1 col-12 col-lg-6" id="s<?php echo ($search_data["id"])  ?>" onclick="cart(<?php echo ($search_data['id'])  ?>);" disabled>Added to Cart</button>
                                                    <?php
                                                    } else {
                                                    ?>

                                                        <button class="btn btn-primary mt-2 mt-lg-3 ms-lg-1 col-12 col-lg-6" id="s<?php echo ($search_data["id"])  ?>" onclick="cart(<?php echo ($search_data['id'])  ?>);">Add to Cart</button>

                                                    <?php
                                                    }
                                                    ?>

<?php

$watch_rs = Database::search("SELECT * FROM `watchlist` WHERE `products_id`='" . $search_data["id"] . "'");
$watch_num = $watch_rs->num_rows;
if ($watch_num == 1) {
?>
    <button class="btn btn-danger mt-2 mt-lg-3 ms-lg-1 col-12" id="w<?php echo ($search_data["id"])  ?>" onclick="watchlist(<?php echo ($search_data['id'])  ?>);" disabled>Added to Watchlist</button>
<?php
} else {
?>

    <button class="btn btn-warning mt-2 col-lg-11" id="w<?php echo ($search_data["id"])  ?>" onclick="watchlist(<?php echo ($search_data['id'])  ?>);">Add to Watchlist</button>

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

?>