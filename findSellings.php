<?php
require "connection.php";

session_start();
$from = $_POST["from"];
$to = $_POST["to"];
if(isset($from) && !isset($to)){
$sell_rs = Database::search("SELECT * FROM `invoice` WHERE `date` > '".$from."'");
$sell_num = $sell_rs->num_rows;
for($a=0; $a<$sell_num; $a++){
    $sell_data = $sell_rs->fetch_assoc();
    if (isset($sell_data["product_id"])) {

        ?>

                <tr>
                    <th scope="row"><?php echo ($sell_data["order_id"])  ?></th>
                    <td class="d-none d-lg-block">
                        <div class="card mb-3" style="max-width: 400px;">
                            <div class="row g-0">
                                <div class="col-md-4">
                                    <?php
                                    $product_rs = Database::search("SELECT * FROM `products` WHERE `id` = '" . $sell_data["product_id"] . "'");
                                    $product_data = $product_rs->fetch_assoc();
                                    $product_rs1 = Database::search("SELECT * FROM `customer` WHERE `mobile` = '" . $sell_data["customer_mobile"] . "'");
                                    $product_data1 = $product_rs1->fetch_assoc();

                                    ?>
                                    <img src="<?php echo ($product_data["pic"])  ?>" class="img-fluid rounded-start" alt="...">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body text-center">
                                        <h5 class="card-title text-center"><?php echo ($product_data["product_name"])  ?></h5>
                                        <span class="card-text text-center col-12">Rs. <?php echo ($product_data["price"])  ?> .00</span><br />
                                        <span class="card-text text-start col-12"> Buyer : <?php echo ($product_data1["fname"] . " " . $product_data1["lname"]);  ?></span></br>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td><?php echo ($sell_data["qty"])  ?></td>
                    <td>Rs. <?php echo ($sell_data["total"])  ?> .00</td>
                    <td><?php echo ($sell_data["date"])  ?></td>
                    <td class="text-center">
                        <div class="row">
                            <button class="col-12 offset-1 col-lg-6 btn btn-primary m-1">FeedBacks</button>
                            <button class="col-12 offset-1 col-lg-6 btn btn-danger m-1">Delete</button>
                            <?php
                            if ($sell_data["status"] == 0) {
                            ?>
                                <button class="col-12 offset-1 col-lg-6 btn btn-warning m-1 d-block" id="con<?php echo ($sell_data["id"]);  ?>" onclick="confirm('<?php echo ($sell_data['id']);  ?>');">Confirm</button>
                        </div>

                    </td>
                    <td class="pt-5 col-1"><i class="bi bi-check-circle text-success d-none" id="tick<?php echo ($sell_data["id"]);  ?>" style="font-size: 75px;"></i></td>
                <?php
                            } else {
                ?>
                    <button class="col-12 col-lg-6 btn btn-warning m-1 d-none" id="con<?php echo ($sell_data["id"]);  ?>" onclick="confirm('<?php echo ($sell_data['id']);  ?>');">Confirm</button>


                    </td>
                    <td class="pt-5 col-1"><i class="bi bi-check-circle text-success d-block" id="tick<?php echo ($sell_data["id"]);  ?>" style="font-size: 75px;"></i></td>
                <?php
                            }


                ?>

                </tr>
        <?php
            } else {
                $new_rs = Database::search("SELECT * FROM `order` WHERE `order_id` = '" . $sell_data["order_id"] . "'");
                $new_num = $new_rs->num_rows;
                for ($j = 0; $j < $new_num; $j++) {
                    $new_data = $new_rs->fetch_assoc();

                    ?>

                    <tr>
                        <th scope="row"><?php echo ($sell_data["order_id"])  ?></th>
                        <td class="d-none d-lg-block">
                            <div class="card mb-3" style="max-width: 400px;">
                                <div class="row g-0">
                                    <div class="col-md-4">
                                        <?php
                                        $product_rs = Database::search("SELECT * FROM `products` WHERE `id` = '" . $new_data["product_id"] . "'");
                                        $product_data = $product_rs->fetch_assoc();
                                        $product_rs1 = Database::search("SELECT * FROM `customer` WHERE `mobile` = '" . $sell_data["customer_mobile"] . "'");
                                        $product_data1 = $product_rs1->fetch_assoc();

                                        ?>
                                        <img src="<?php echo ($product_data["pic"])  ?>" class="img-fluid rounded-start" alt="...">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body text-center">
                                            <h5 class="card-title text-center"><?php echo ($product_data["product_name"])  ?></h5>
                                            <span class="card-text text-center col-12">Rs. <?php echo ($product_data["price"])  ?> .00</span><br />
                                            <span class="card-text text-start col-12"> Buyer : <?php echo ($product_data1["fname"] . " " . $product_data1["lname"]);  ?></span></br>


                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td><?php echo ($new_data["qty"])  ?></td>
                        <td>Rs. <?php echo ($new_data["qty"] * $product_data["price"]);   ?> .00</td>
                        <td><?php echo ($sell_data["date"])  ?></td>
                        <td class="text-center">
                            <div class="row">
                                <button class="col-12 offset-1 col-lg-6 btn btn-primary m-1">FeedBacks</button>
                                <button class="col-12 offset-1 col-lg-6 btn btn-danger m-1">Delete</button>
                                <?php
                                if ($sell_data["status"] == 0) {
                                ?>
                                    <button class="col-12 offset-1 col-lg-6 btn btn-warning m-1 d-block" id="con<?php echo ($sell_data["id"]);  ?>" onclick="confirm('<?php echo ($sell_data['id']);  ?>');">Confirm</button>
                            </div>

                        </td>
                        <td class="pt-5 col-1"><i class="bi bi-check-circle text-success d-none" id="tick<?php echo ($sell_data["id"]);  ?>" style="font-size: 75px;"></i></td>
                    <?php
                                } else {
                    ?>
                        <button class="col-12 col-lg-6 btn btn-warning m-1 d-none" id="con<?php echo ($sell_data["id"]);  ?>" onclick="confirm('<?php echo ($sell_data['id']);  ?>');">Confirm</button>


                        </td>
                        <td class="pt-5 col-1"><i class="bi bi-check-circle text-success d-block" id="tick<?php echo ($sell_data["id"]);  ?>" style="font-size: 75px;"></i></td>
                    <?php
                                }


                    ?>

                    </tr>
<?php
                }
            }
        }
    } else if(!isset($from) && isset($to)){
        $sell_rs = Database::search("SELECT * FROM `invoice` WHERE `date` < '".$to."'");
        $sell_num = $sell_rs->num_rows;
        for($a=0; $a<$sell_num; $a++){
            $sell_data = $sell_rs->fetch_assoc();
            if (isset($sell_data["product_id"])) {
        
                ?>
        
                        <tr>
                            <th scope="row"><?php echo ($sell_data["order_id"])  ?></th>
                            <td class="d-none d-lg-block">
                                <div class="card mb-3" style="max-width: 400px;">
                                    <div class="row g-0">
                                        <div class="col-md-4">
                                            <?php
                                            $product_rs = Database::search("SELECT * FROM `products` WHERE `id` = '" . $sell_data["product_id"] . "'");
                                            $product_data = $product_rs->fetch_assoc();
                                            $product_rs1 = Database::search("SELECT * FROM `customer` WHERE `mobile` = '" . $sell_data["customer_mobile"] . "'");
                                            $product_data1 = $product_rs1->fetch_assoc();
        
                                            ?>
                                            <img src="<?php echo ($product_data["pic"])  ?>" class="img-fluid rounded-start" alt="...">
                                        </div>
                                        <div class="col-md-8">
                                            <div class="card-body text-center">
                                                <h5 class="card-title text-center"><?php echo ($product_data["product_name"])  ?></h5>
                                                <span class="card-text text-center col-12">Rs. <?php echo ($product_data["price"])  ?> .00</span><br />
                                                <span class="card-text text-start col-12"> Buyer : <?php echo ($product_data1["fname"] . " " . $product_data1["lname"]);  ?></span></br>
        
        
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td><?php echo ($sell_data["qty"])  ?></td>
                            <td>Rs. <?php echo ($sell_data["total"])  ?> .00</td>
                            <td><?php echo ($sell_data["date"])  ?></td>
                            <td class="text-center">
                                <div class="row">
                                    <button class="col-12 offset-1 col-lg-6 btn btn-primary m-1">FeedBacks</button>
                                    <button class="col-12 offset-1 col-lg-6 btn btn-danger m-1">Delete</button>
                                    <?php
                                    if ($sell_data["status"] == 0) {
                                    ?>
                                        <button class="col-12 offset-1 col-lg-6 btn btn-warning m-1 d-block" id="con<?php echo ($sell_data["id"]);  ?>" onclick="confirm('<?php echo ($sell_data['id']);  ?>');">Confirm</button>
                                </div>
        
                            </td>
                            <td class="pt-5 col-1"><i class="bi bi-check-circle text-success d-none" id="tick<?php echo ($sell_data["id"]);  ?>" style="font-size: 75px;"></i></td>
                        <?php
                                    } else {
                        ?>
                            <button class="col-12 col-lg-6 btn btn-warning m-1 d-none" id="con<?php echo ($sell_data["id"]);  ?>" onclick="confirm('<?php echo ($sell_data['id']);  ?>');">Confirm</button>
        
        
                            </td>
                            <td class="pt-5 col-1"><i class="bi bi-check-circle text-success d-block" id="tick<?php echo ($sell_data["id"]);  ?>" style="font-size: 75px;"></i></td>
                        <?php
                                    }
        
        
                        ?>
        
                        </tr>
                <?php
                    } else {
                        $new_rs = Database::search("SELECT * FROM `order` WHERE `order_id` = '" . $sell_data["order_id"] . "'");
                        $new_num = $new_rs->num_rows;
                        for ($j = 0; $j < $new_num; $j++) {
                            $new_data = $new_rs->fetch_assoc();
        
                            ?>
        
                            <tr>
                                <th scope="row"><?php echo ($sell_data["order_id"])  ?></th>
                                <td class="d-none d-lg-block">
                                    <div class="card mb-3" style="max-width: 400px;">
                                        <div class="row g-0">
                                            <div class="col-md-4">
                                                <?php
                                                $product_rs = Database::search("SELECT * FROM `products` WHERE `id` = '" . $new_data["product_id"] . "'");
                                                $product_data = $product_rs->fetch_assoc();
                                                $product_rs1 = Database::search("SELECT * FROM `customer` WHERE `mobile` = '" . $sell_data["customer_mobile"] . "'");
                                                $product_data1 = $product_rs1->fetch_assoc();
        
                                                ?>
                                                <img src="<?php echo ($product_data["pic"])  ?>" class="img-fluid rounded-start" alt="...">
                                            </div>
                                            <div class="col-md-8">
                                                <div class="card-body text-center">
                                                    <h5 class="card-title text-center"><?php echo ($product_data["product_name"])  ?></h5>
                                                    <span class="card-text text-center col-12">Rs. <?php echo ($product_data["price"])  ?> .00</span><br />
                                                    <span class="card-text text-start col-12"> Buyer : <?php echo ($product_data1["fname"] . " " . $product_data1["lname"]);  ?></span></br>
        
        
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td><?php echo ($new_data["qty"])  ?></td>
                                <td>Rs. <?php echo ($new_data["qty"] * $product_data["price"]);   ?> .00</td>
                                <td><?php echo ($sell_data["date"])  ?></td>
                                <td class="text-center">
                                    <div class="row">
                                        <button class="col-12 offset-1 col-lg-6 btn btn-primary m-1">FeedBacks</button>
                                        <button class="col-12 offset-1 col-lg-6 btn btn-danger m-1">Delete</button>
                                        <?php
                                        if ($sell_data["status"] == 0) {
                                        ?>
                                            <button class="col-12 offset-1 col-lg-6 btn btn-warning m-1 d-block" id="con<?php echo ($sell_data["id"]);  ?>" onclick="confirm('<?php echo ($sell_data['id']);  ?>');">Confirm</button>
                                    </div>
        
                                </td>
                                <td class="pt-5 col-1"><i class="bi bi-check-circle text-success d-none" id="tick<?php echo ($sell_data["id"]);  ?>" style="font-size: 75px;"></i></td>
                            <?php
                                        } else {
                            ?>
                                <button class="col-12 col-lg-6 btn btn-warning m-1 d-none" id="con<?php echo ($sell_data["id"]);  ?>" onclick="confirm('<?php echo ($sell_data['id']);  ?>');">Confirm</button>
        
        
                                </td>
                                <td class="pt-5 col-1"><i class="bi bi-check-circle text-success d-block" id="tick<?php echo ($sell_data["id"]);  ?>" style="font-size: 75px;"></i></td>
                            <?php
                                        }
        
        
                            ?>
        
                            </tr>
        <?php
                        }
                    }
                }
            } else if(isset($from) && isset($to)){
                $sell_rs = Database::search("SELECT * FROM `invoice` WHERE `date` > '".$from."' AND `date` < '".$to."'");
                $sell_num = $sell_rs->num_rows;
                for($a=0; $a<$sell_num; $a++){
                    $sell_data = $sell_rs->fetch_assoc();
                    if (isset($sell_data["product_id"])) {
                
                        ?>
                
                                <tr>
                                    <th scope="row"><?php echo ($sell_data["order_id"])  ?></th>
                                    <td class="d-none d-lg-block">
                                        <div class="card mb-3" style="max-width: 400px;">
                                            <div class="row g-0">
                                                <div class="col-md-4">
                                                    <?php
                                                    $product_rs = Database::search("SELECT * FROM `products` WHERE `id` = '" . $sell_data["product_id"] . "'");
                                                    $product_data = $product_rs->fetch_assoc();
                                                    $product_rs1 = Database::search("SELECT * FROM `customer` WHERE `mobile` = '" . $sell_data["customer_mobile"] . "'");
                                                    $product_data1 = $product_rs1->fetch_assoc();
                
                                                    ?>
                                                    <img src="<?php echo ($product_data["pic"])  ?>" class="img-fluid rounded-start" alt="...">
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="card-body text-center">
                                                        <h5 class="card-title text-center"><?php echo ($product_data["product_name"])  ?></h5>
                                                        <span class="card-text text-center col-12">Rs. <?php echo ($product_data["price"])  ?> .00</span><br />
                                                        <span class="card-text text-start col-12"> Buyer : <?php echo ($product_data1["fname"] . " " . $product_data1["lname"]);  ?></span></br>
                
                
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td><?php echo ($sell_data["qty"])  ?></td>
                                    <td>Rs. <?php echo ($sell_data["total"])  ?> .00</td>
                                    <td><?php echo ($sell_data["date"])  ?></td>
                                    <td class="text-center">
                                        <div class="row">
                                            <button class="col-12 offset-1 col-lg-6 btn btn-primary m-1">FeedBacks</button>
                                            <button class="col-12 offset-1 col-lg-6 btn btn-danger m-1">Delete</button>
                                            <?php
                                            if ($sell_data["status"] == 0) {
                                            ?>
                                                <button class="col-12 offset-1 col-lg-6 btn btn-warning m-1 d-block" id="con<?php echo ($sell_data["id"]);  ?>" onclick="confirm('<?php echo ($sell_data['id']);  ?>');">Confirm</button>
                                        </div>
                
                                    </td>
                                    <td class="pt-5 col-1"><i class="bi bi-check-circle text-success d-none" id="tick<?php echo ($sell_data["id"]);  ?>" style="font-size: 75px;"></i></td>
                                <?php
                                            } else {
                                ?>
                                    <button class="col-12 col-lg-6 btn btn-warning m-1 d-none" id="con<?php echo ($sell_data["id"]);  ?>" onclick="confirm('<?php echo ($sell_data['id']);  ?>');">Confirm</button>
                
                
                                    </td>
                                    <td class="pt-5 col-1"><i class="bi bi-check-circle text-success d-block" id="tick<?php echo ($sell_data["id"]);  ?>" style="font-size: 75px;"></i></td>
                                <?php
                                            }
                
                
                                ?>
                
                                </tr>
                        <?php
                            } else {
                                $new_rs = Database::search("SELECT * FROM `order` WHERE `order_id` = '" . $sell_data["order_id"] . "'");
                                $new_num = $new_rs->num_rows;
                                for ($j = 0; $j < $new_num; $j++) {
                                    $new_data = $new_rs->fetch_assoc();
                
                                    ?>
                
                                    <tr>
                                        <th scope="row"><?php echo ($sell_data["order_id"])  ?></th>
                                        <td class="d-none d-lg-block">
                                            <div class="card mb-3" style="max-width: 400px;">
                                                <div class="row g-0">
                                                    <div class="col-md-4">
                                                        <?php
                                                        $product_rs = Database::search("SELECT * FROM `products` WHERE `id` = '" . $new_data["product_id"] . "'");
                                                        $product_data = $product_rs->fetch_assoc();
                                                        $product_rs1 = Database::search("SELECT * FROM `customer` WHERE `mobile` = '" . $sell_data["customer_mobile"] . "'");
                                                        $product_data1 = $product_rs1->fetch_assoc();
                
                                                        ?>
                                                        <img src="<?php echo ($product_data["pic"])  ?>" class="img-fluid rounded-start" alt="...">
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="card-body text-center">
                                                            <h5 class="card-title text-center"><?php echo ($product_data["product_name"])  ?></h5>
                                                            <span class="card-text text-center col-12">Rs. <?php echo ($product_data["price"])  ?> .00</span><br />
                                                            <span class="card-text text-start col-12"> Buyer : <?php echo ($product_data1["fname"] . " " . $product_data1["lname"]);  ?></span></br>
                
                
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td><?php echo ($new_data["qty"])  ?></td>
                                        <td>Rs. <?php echo ($new_data["qty"] * $product_data["price"]);   ?> .00</td>
                                        <td><?php echo ($sell_data["date"])  ?></td>
                                        <td class="text-center">
                                            <div class="row">
                                                <button class="col-12 offset-1 col-lg-6 btn btn-primary m-1">FeedBacks</button>
                                                <button class="col-12 offset-1 col-lg-6 btn btn-danger m-1">Delete</button>
                                                <?php
                                                if ($sell_data["status"] == 0) {
                                                ?>
                                                    <button class="col-12 offset-1 col-lg-6 btn btn-warning m-1 d-block" id="con<?php echo ($sell_data["id"]);  ?>" onclick="confirm('<?php echo ($sell_data['id']);  ?>');">Confirm</button>
                                            </div>
                
                                        </td>
                                        <td class="pt-5 col-1"><i class="bi bi-check-circle text-success d-none" id="tick<?php echo ($sell_data["id"]);  ?>" style="font-size: 75px;"></i></td>
                                    <?php
                                                } else {
                                    ?>
                                        <button class="col-12 col-lg-6 btn btn-warning m-1 d-none" id="con<?php echo ($sell_data["id"]);  ?>" onclick="confirm('<?php echo ($sell_data['id']);  ?>');">Confirm</button>
                
                
                                        </td>
                                        <td class="pt-5 col-1"><i class="bi bi-check-circle text-success d-block" id="tick<?php echo ($sell_data["id"]);  ?>" style="font-size: 75px;"></i></td>
                                    <?php
                                                }
                
                
                                    ?>
                
                                    </tr>
                <?php
                                }
                            }
                        }
                    }
        ?>




































?>