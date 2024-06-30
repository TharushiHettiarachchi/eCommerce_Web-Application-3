<?php
session_start();
require "connection.php";
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
    <title>Sooper Vegan | Purchasing History</title>
</head>

<body class="body" style="overflow-x: hidden;">
    <div class="col-12 fixed-top bg-light">
        <?php require "header.php"; ?>
    </div>
    <div class="container-fluid pt-5" style="background-color:#A8E890">
        <div class="col-12 pt-3">
            <div class="row">
                <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="home.php" class="text-success">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Purchased History</li>
                    </ol>
                </nav>
                <div class="col-12 fs-1 text-dark text-center"><i class="bi bi-bag-fill"></i>&nbsp;Purchased History</div>
                <div class="col-12 p-3">
                    <table class="table border-success">
                        <thead class="bg-success text-center">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Product</th>
                                <th scope="col">Qty</th>
                                <th scope="col">Price</th>
                                <th scope="col">Date & Time</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            <?php
                            $invoice_rs = Database::search("SELECT * FROM `invoice` WHERE `customer_mobile` = '" . $user["mobile"] . "' ORDER BY `date` DESC");
                            $invoice_num = $invoice_rs->num_rows;
                            for ($x = 0; $x < $invoice_num; $x++) {
                                $invoice_data = $invoice_rs->fetch_assoc();
                                if (isset($invoice_data["products_id"])) {

                            ?>
                                    <tr>
                                        <th scope="row"><?php echo ($invoice_data["order_id"]) ?></th>
                                        <td>
                                            <?php
                                            $product_rs = Database::search("SELECT * FROM `products` WHERE `id` = '" . $invoice_data["products_id"] . "'");
                                            $product_data = $product_rs->fetch_assoc();
                                            $product_rs1 = Database::search("SELECT * FROM `product_types` WHERE `id` = '" . $product_data["product_types_id"] . "'");
                                            $product_data1 = $product_rs1->fetch_assoc();

                                            ?>
                                            <div class="card mb-3" style="max-width: 400px;">
                                                <div class="row g-0">
                                                    <div class="col-md-4">
                                                        <img src="<?php echo ($product_data["pic"]);  ?>" class="img-fluid rounded-start" alt="...">
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="card-body text-center">
                                                            <h5 class="card-title text-center"><?php echo ($product_data["product_name"]);  ?></h5>
                                                            <span class="card-text text-center col-12 d-none">Rs. <?php echo ($product_data["price"]);  ?> .00</span><br />
                                                            <span class="card-text text-center col-12"> <?php echo ($product_data1["product_type"]);  ?></span></br>
                                                            <span class="card-text text-center col-12 d-block d-lg-none"> <?php echo ($product_data["quantity"]);  ?> Items</span></br>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class=""><?php echo ($invoice_data["qty"]);  ?></td>
                                        <td>Rs. <?php echo ($invoice_data["total"]);  ?> .00</td>
                                        <td><?php echo ($invoice_data["date"]);  ?></td>
                                        <td class="col-2">
                                            <?php

                                            if ($invoice_data["status"] == 0) {
                                            ?>
                                                <div class="row">
                                                    <div class="col-3 text-end border border-1 border-end-0 border-success rounded-start bg-white opacity-50 fw-bold"><i class="bi bi-check2-circle fs-2 text-success"></i></div>
                                                    <div class="col-9 text-start text-success border border-1 border-start-0 border-success pt-2 rounded-end bg-white opacity-50 fw-bold">Ordered</div>
                                                    <div class="col-3 text-end"><i class="bi bi-check2-circle fs-2 text-secondary" disabled></i></div>
                                                    <div class="col-9 text-start mt-2 text-secondary" disabled>Sent to Packing</div>
                                                    <div class="col-3 text-end"><i class="bi bi-check2-circle fs-2 text-secondary"></i></div>
                                                    <div class="col-9 text-start mt-2 text-secondary">Ready for Delivery</div>
                                                </div>
                                                <div class="row d-none">
                                                    <button class="col-12 col-lg-6 btn btn-primary m-1">FeedBacks</button>
                                                    <button class="col-12 col-lg-6 btn btn-danger m-1">Delete</button>
                                                </div>

                                            <?php
                                            } else if ($invoice_data["status"] == 1) {
                                            ?>
                                                <div class="row">
                                                    <div class="col-3 text-end"><i class="bi bi-check2-circle fs-2 text-success"></i></div>
                                                    <div class="col-9 text-start mt-2 text-success">Ordered</div>
                                                    <div class="col-3 text-end border border-1 border-end-0 border-success rounded-start bg-white opacity-50"><i class="bi bi-check2-circle fs-2 text-success"></i></div>
                                                    <div class="col-9 text-start text-success border border-1 border-start-0 border-success pt-2 rounded-end bg-white opacity-50 fw-bold">Sent to Packing</div>
                                                    <div class="col-3 text-end"><i class="bi bi-check2-circle fs-2 text-secondary"></i></div>
                                                    <div class="col-9 text-start mt-2 text-secondary">Ready for Delivery</div>
                                                </div>
                                                <div class="row d-none">
                                                    <button class="col-12 col-lg-6 btn btn-primary m-1">FeedBacks</button>
                                                    <button class="col-12 col-lg-6 btn btn-danger m-1">Delete</button>
                                                </div>

                                            <?php
                                            } else if ($invoice_data["status"] == 2) {
                                            ?>
                                                <div class="row">
                                                    <div class="col-3 text-end"><i class="bi bi-check2-circle fs-2 text-success"></i></div>
                                                    <div class="col-9 text-start mt-2 text-success">Ordered</div>
                                                    <div class="col-3 text-end"><i class="bi bi-check2-circle fs-2 text-success" disabled></i></div>
                                                    <div class="col-9 text-start mt-2 text-success" disabled>Sent to Packing</div>
                                                    <div class="col-3 text-end border border-1 border-end-0 border-success rounded-start bg-white opacity-50"><i class="bi bi-check2-circle fs-2 text-success"></i></div>
                                                    <div class="col-9 text-start text-success border border-1 border-start-0 border-success pt-2 rounded-end bg-white opacity-50 fw-bold">Ready For Delivery</div>
                                                </div>
                                                <div class="row d-none">
                                                    <button class="col-12 col-lg-6 btn btn-primary m-1">FeedBacks</button>
                                                    <button class="col-12 col-lg-6 btn btn-danger m-1">Delete</button>
                                                </div>

                                            <?php
                                            } else if ($invoice_data["status"] == 3) {
                                            ?>
                                                <div class="row d-none">
                                                    <div class="col-3 text-end"><i class="bi bi-check2-circle fs-2 text-success"></i></div>
                                                    <div class="col-9 text-start mt-2 text-success">Ordered</div>
                                                    <div class="col-3 text-end"><i class="bi bi-check2-circle fs-2 text-success" disabled></i></div>
                                                    <div class="col-9 text-start mt-2 text-success" disabled>Sent to Packing</div>
                                                    <div class="col-3 text-end border border-1 border-end-0 border-success rounded-start bg-white opacity-50"><i class="bi bi-check2-circle fs-2 text-success"></i></div>
                                                    <div class="col-9 text-start text-success border border-1 border-start-0 border-success pt-2 rounded-end bg-white opacity-50 fw-bold">Ready For Delivery</div>
                                                </div>
                                                <div class="row d-block">
                                                    <?php
                                                    if ($invoice_data["fid"] == 0) {
                                                    ?>
                                                        <button class="col-12 col-lg-6 btn btn-primary m-1" id="but<?php echo ($product_data["id"]); ?>" onclick="feedback('<?php echo ($product_data['id']); ?>');">FeedBacks</button>
                                                        <button class="col-12 col-lg-6 btn btn-danger m-1" onclick="deletePurchase('<?php echo ($invoice_data['id']);  ?>');">Delete</button>

                                                    <?php
                                                    } else {
                                                    ?>
                                                        <button class="col-12 col-lg-6 btn btn-primary m-1 d-none" id="but<?php echo ($product_data["id"]); ?>" onclick="feedback('<?php echo ($product_data['id']); ?>');">FeedBacks</button>
                                                        <button class="col-12 col-lg-6 btn btn-danger m-1" onclick="deletePurchase('<?php echo ($invoice_data['id']);  ?>');">Delete</button>

                                                    <?php
                                                    }
                                                    ?>
                                                </div>
                                            <?php
                                            }


                                            ?>

                                        </td>
                                    </tr>
                                    <!--  -->
                                    <div class="modal" tabindex="-1" id="feedbackModal<?php echo ($product_data["id"]);  ?>">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Add Feedbacks</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Rate our Product</p>
                                                    <div class="col-12">
                                                        <div class="row">
                                                            <?php
                                                            for ($z = 1; $z < 6; $z++) {
                                                            ?>
                                                                <div class="col-1 offset-1"><i class="bi bi-star fs-1" onclick="star('<?php echo ($z); ?>','<?php echo ($product_data['id']) ?>');" id="star<?php echo ($z . "" . $product_data["id"]); ?>"></i></div>
                                                            <?php
                                                            }
                                                            ?>

                                                        </div>

                                                    </div>
                                                    <div class="col-12 text-dark">Comment</div>
                                                    <div class="col-12">
                                                        <textarea cols="15" rows="10" class="col-12" id="comment"></textarea>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="button" class="btn btn-primary" onclick="feedback1('<?php echo ($product_data['id']);  ?>','<?php echo ($invoice_data['order_id']);  ?>');">Save Feedback</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <?php
                                } else {

                                    $new_rs = Database::search("SELECT * FROM `order` WHERE `order_id` = '" . $invoice_data["order_id"] . "'");
                                    $new_num = $new_rs->num_rows;
                                    for ($j = 0; $j < $new_num; $j++) {
                                        $new_data = $new_rs->fetch_assoc();

                                    ?>
                                        <tr>
                                            <th scope="row"><?php echo ($invoice_data["order_id"]) ?></th>
                                            <td>
                                                <?php
                                                $product_rs = Database::search("SELECT * FROM `products` WHERE `id` = '" . $new_data["products_id"] . "'");
                                                $product_data = $product_rs->fetch_assoc();
                                                $product_rs1 = Database::search("SELECT * FROM `product_types` WHERE `id` = '" . $product_data["product_types_id"] . "'");
                                                $product_data1 = $product_rs1->fetch_assoc();

                                                ?>
                                                <div class="card mb-3" style="max-width: 400px;">
                                                    <div class="row g-0">
                                                        <div class="col-md-4">
                                                            <img src="<?php echo ($product_data["pic"]);  ?>" class="img-fluid rounded-start" alt="...">
                                                        </div>
                                                        <div class="col-md-8">
                                                            <div class="card-body text-center">
                                                                <h5 class="card-title text-center"><?php echo ($product_data["product_name"]);  ?></h5>
                                                                <span class="card-text text-center col-12 d-none">Rs. <?php echo ($product_data["price"]);  ?> .00</span><br />
                                                                <span class="card-text text-center col-12"> <?php echo ($product_data1["product_type"]);  ?></span></br>
                                                                <span class="card-text text-center col-12 d-block d-lg-none"> <?php echo ($new_data["qty"]);  ?> Items</span></br>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class=""><?php echo ($new_data["qty"]);  ?></td>
                                            <td>Rs. <?php echo ($new_data["qty"] * $product_data["price"]);  ?> .00</td>
                                            <td><?php echo ($invoice_data["date"]);  ?></td>
                                            <td class="col-2">
                                                <?php

                                                if ($invoice_data["status"] == 0) {
                                                ?>
                                                    <div class="row">
                                                        <div class="col-3 text-end border border-1 border-end-0 border-success rounded-start bg-white opacity-50 fw-bold"><i class="bi bi-check2-circle fs-2 text-success"></i></div>
                                                        <div class="col-9 text-start text-success border border-1 border-start-0 border-success pt-2 rounded-end bg-white opacity-50 fw-bold">Ordered</div>
                                                        <div class="col-3 text-end"><i class="bi bi-check2-circle fs-2 text-secondary" disabled></i></div>
                                                        <div class="col-9 text-start mt-2 text-secondary" disabled>Sent to Packing</div>
                                                        <div class="col-3 text-end"><i class="bi bi-check2-circle fs-2 text-secondary"></i></div>
                                                        <div class="col-9 text-start mt-2 text-secondary">Ready for Delivery</div>
                                                    </div>
                                                    <div class="row d-none">
                                                        <button class="col-12 col-lg-6 btn btn-primary m-1">FeedBacks</button>
                                                        <button class="col-12 col-lg-6 btn btn-danger m-1">Delete</button>
                                                    </div>

                                                <?php
                                                } else if ($invoice_data["status"] == 1) {
                                                ?>
                                                    <div class="row">
                                                        <div class="col-3 text-end"><i class="bi bi-check2-circle fs-2 text-success"></i></div>
                                                        <div class="col-9 text-start mt-2 text-success">Ordered</div>
                                                        <div class="col-3 text-end border border-1 border-end-0 border-success rounded-start bg-white opacity-50"><i class="bi bi-check2-circle fs-2 text-success"></i></div>
                                                        <div class="col-9 text-start text-success border border-1 border-start-0 border-success pt-2 rounded-end bg-white opacity-50 fw-bold">Sent to Packing</div>
                                                        <div class="col-3 text-end"><i class="bi bi-check2-circle fs-2 text-secondary"></i></div>
                                                        <div class="col-9 text-start mt-2 text-secondary">Ready for Delivery</div>
                                                    </div>
                                                    <div class="row d-none">
                                                        <button class="col-12 col-lg-6 btn btn-primary m-1">FeedBacks</button>
                                                        <button class="col-12 col-lg-6 btn btn-danger m-1">Delete</button>
                                                    </div>

                                                <?php
                                                } else if ($invoice_data["status"] == 2) {
                                                ?>
                                                    <div class="row">
                                                        <div class="col-3 text-end"><i class="bi bi-check2-circle fs-2 text-success"></i></div>
                                                        <div class="col-9 text-start mt-2 text-success">Ordered</div>
                                                        <div class="col-3 text-end"><i class="bi bi-check2-circle fs-2 text-success" disabled></i></div>
                                                        <div class="col-9 text-start mt-2 text-success" disabled>Sent to Packing</div>
                                                        <div class="col-3 text-end border border-1 border-end-0 border-success rounded-start bg-white opacity-50"><i class="bi bi-check2-circle fs-2 text-success"></i></div>
                                                        <div class="col-9 text-start text-success border border-1 border-start-0 border-success pt-2 rounded-end bg-white opacity-50 fw-bold">Ready For Delivery</div>
                                                    </div>
                                                    <div class="row d-none">
                                                        <button class="col-12 col-lg-6 btn btn-primary m-1">FeedBacks</button>
                                                        <button class="col-12 col-lg-6 btn btn-danger m-1">Delete</button>
                                                    </div>

                                                <?php
                                                } else if ($invoice_data["status"] == 3) {
                                                ?>
                                                    <div class="row d-none">
                                                        <div class="col-3 text-end"><i class="bi bi-check2-circle fs-2 text-success"></i></div>
                                                        <div class="col-9 text-start mt-2 text-success">Ordered</div>
                                                        <div class="col-3 text-end"><i class="bi bi-check2-circle fs-2 text-success" disabled></i></div>
                                                        <div class="col-9 text-start mt-2 text-success" disabled>Sent to Packing</div>
                                                        <div class="col-3 text-end border border-1 border-end-0 border-success rounded-start bg-white opacity-50"><i class="bi bi-check2-circle fs-2 text-success"></i></div>
                                                        <div class="col-9 text-start text-success border border-1 border-start-0 border-success pt-2 rounded-end bg-white opacity-50 fw-bold">Ready For Delivery</div>
                                                    </div>
                                                    <div class="row d-block">
                                                        <?php
                                                        if (!isset($new_data["fid"])) {
                                                        ?>
                                                            <button class="col-12 col-lg-6 btn btn-primary m-1" id="but1<?php echo ($product_data["id"]); ?>" onclick="feedback3('<?php echo ($product_data['id']); ?>');">FeedBacks</button>
                                                            <button class="col-12 col-lg-6 btn btn-danger m-1" onclick="deletePurchase('<?php echo ($invoice_data['id']);  ?>');">Delete</button>

                                                        <?php
                                                        } else {
                                                        ?>
                                                            <button class="col-12 col-lg-6 btn btn-primary m-1 d-none" id="but1<?php echo ($product_data["id"]); ?>" onclick="feedback3('<?php echo ($product_data['id']); ?>');">FeedBacks</button>
                                                            <button class="col-12 col-lg-6 btn btn-danger m-1" onclick="deletePurchase('<?php echo ($invoice_data['id']);  ?>');">Delete</button>

                                                        <?php
                                                        }
                                                        ?>
                                                    </div>
                                                <?php
                                                }


                                                ?>

                                            </td>
                                        </tr>
                                         <!--  -->
                                <div class="modal" tabindex="-1" id="feedbackModale<?php echo ($product_data["id"]);  ?>">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Add Feedbacks</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Rate our Product</p>
                                                <div class="col-12">
                                                    <div class="row">
                                                        <?php
                                                        for ($z = 1; $z < 6; $z++) {
                                                        ?>
                                                            <div class="col-1 offset-1"><i class="bi bi-star fs-1" onclick="star('<?php echo ($z); ?>','<?php echo ($product_data['id']) ?>');" id="star<?php echo ($z . "" . $product_data["id"]); ?>"></i></div>
                                                        <?php
                                                        }
                                                        ?>

                                                    </div>

                                                </div>
                                                <div class="col-12 text-dark">Comment</div>
                                                <div class="col-12">
                                                    <textarea id="comment2" cols="15" rows="10" class="form-control"></textarea>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-primary" onclick="feedback2('<?php echo ($product_data['id']);  ?>','<?php echo ($invoice_data['order_id']);  ?>');">Save Feedback</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

 
                                <?php
                                    }
                                }
                                ?>
                                                          <?php
                            }

                            ?>

                        </tbody>
                    </table>
                </div>


                <div class="col-12 d-grid mb-5">
                    <button class="btn btn-success" style="background-color:#2EB086;" onclick="deleteRecords('<?php echo ($user['mobile']); ?>');"> Delete All Records</button>
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