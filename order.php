<?php
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
    <title>Sooper Veagn | Orders</title>
</head>

<body class="body" style="overflow-x: hidden; background-color: #A8E890;">

    <div class="container-fluid">
        <div class="col-12">
            <div class="row">
                <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a class="text-success" href="adminPanel.php">Admin Panel</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Orders</li>
                    </ol>
                </nav>
                <div class="col-12 fs-1 text-dark text-center"><i class="bi bi-card-checklist"></i>&nbsp;Orders</div>
                <div class="col-12 p-3">
                    <table class="table">
                        <thead class="bg-success text-center">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Product</th>
                                <th scope="col">Qty</th>
                                <th scope="col">Price</th>
                                <th scope="col">Date & Time</th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            <?php
                            $invoice_rs = Database::search("SELECT * FROM `invoice` WHERE `status` = '1'");
                            $invoice_num = $invoice_rs->num_rows;
                            for ($x = 0; $x < $invoice_num; $x++) {
                                $invoice_data = $invoice_rs->fetch_assoc();
                                if (isset($invoice_data["products_id"])) {
                            ?>
                                    <tr>
                                        <th scope="row"><?php echo ($invoice_data["order_id"])  ?></th>
                                        <td>
                                            <div class="card mb-3 col-12" style="max-width: 500px;">
                                                <div class="row g-0">
                                                    <div class="col-md-4">
                                                        <?php
                                                        $product_rs = Database::search("SELECT * FROM `products` WHERE `id` = '" . $invoice_data["products_id"] . "'");
                                                        $product_data = $product_rs->fetch_assoc();
                                                        $product_rs1 = Database::search("SELECT * FROM `customer` WHERE `mobile` = '" . $invoice_data["customer_mobile"] . "'");
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
                                        <td><?php echo ($invoice_data["qty"])  ?></td>
                                        <td>Rs. <?php echo ($invoice_data["total"])  ?> .00</td>
                                        <td><?php echo ($invoice_data["date"])  ?></td>
                                        <td class="text-center">
                                            <div class="row">


                                                <?php
                                                if ($invoice_data["status"] == 1) {
                                                ?>
                                                    <button class="col-10 offset-1 col-lg-12 btn btn-warning m-1 d-block" id="con<?php echo ($invoice_data["id"]);  ?>" onclick="confirm1('<?php echo ($invoice_data['id']);  ?>');">Deliver</button>
                                            </div>

                                        </td>
                                        <td class="pt-5 col-1"><i class="bi bi-check-circle text-success d-none" id="tick<?php echo ($invoice_data["id"]);  ?>" style="font-size: 75px;"></i></td>
                                    <?php
                                                } else {
                                    ?>
                                        <button class="col-12 col-lg-12 btn btn-warning m-1 d-none" id="con<?php echo ($invoice_data["id"]);  ?>" onclick="confirm1('<?php echo ($invoice_data['id']);  ?>');">Deliver</button>


                                        </td>
                                        <td class="pt-5 col-1"><i class="bi bi-check-circle text-success d-block" id="tick<?php echo ($invoice_data["id"]);  ?>" style="font-size: 75px;"></i></td>
                                    <?php
                                                }


                                    ?>

                                    </tr>
                                    <?php
                                } else {
                                    $new_rs = Database::search("SELECT * FROM `order` WHERE `order_id` = '" . $invoice_data["order_id"] . "'");
                                    $new_num = $new_rs->num_rows;
                                    for ($j = 0; $j < $new_num; $j++) {
                                        $new_data = $new_rs->fetch_assoc();
                                    ?>
                                        <tr>
                                            <th scope="row"><?php echo ($invoice_data["order_id"])  ?></th>
                                            <td>
                                                <div class="card mb-3 col-12" style="max-width: 500px;">
                                                    <div class="row g-0">
                                                        <div class="col-md-4">
                                                            <?php
                                                            $product_rs = Database::search("SELECT * FROM `products` WHERE `id` = '" . $new_data["products_id"] . "'");
                                                            $product_data = $product_rs->fetch_assoc();
                                                            $product_rs1 = Database::search("SELECT * FROM `customer` WHERE `mobile` = '" . $invoice_data["customer_mobile"] . "'");
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
                                            <td>Rs. <?php echo ($new_data["qty"]*$product_data["price"] )  ?> .00</td>
                                            <td><?php echo ($invoice_data["date"])  ?></td>
                                            <td class="text-center">
                                                <div class="row">


                                                    <?php
                                                    if ($invoice_data["status"] == 1) {
                                                    ?>
                                                        <button class="col-10 offset-1 col-lg-12 btn btn-success m-1 d-block" style="background-color:#2EB086; border-color:#2EB086;" id="con<?php echo ($invoice_data["id"]);  ?>" onclick="confirm1('<?php echo ($invoice_data['id']);  ?>');">Deliver</button>
                                                </div>

                                            </td>
                                            <td class="pt-5 col-1"><i class="bi bi-check-circle text-success d-none" id="tick<?php echo ($invoice_data["id"]);  ?>" style="font-size: 75px;"></i></td>
                                        <?php
                                                    } else {
                                        ?>
                                            <button class="col-12 col-lg-12 btn btn-warning m-1 d-none" style="background-color:#2EB086;" id="con<?php echo ($invoice_data["id"]);  ?>" onclick="confirm1('<?php echo ($invoice_data['id']);  ?>');">Deliver</button>


                                            </td>
                                            <td class="pt-5 col-1"><i class="bi bi-check-circle text-success d-block" id="tick<?php echo ($invoice_data["id"]);  ?>" style="font-size: 75px;"></i></td>
                                        <?php
                                                    }


                                        ?>

                                        </tr>
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
            </div>
        </div>




    </div>









    <script src="script.js"></script>
    <script src="bootstrap.js"></script>
    <script src="bootstrap.bundle.js"></script>
</body>

</html>