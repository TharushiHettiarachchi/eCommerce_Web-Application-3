<?php
session_start();
$id = $_GET["id"];
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
    <title>Sooper Vegan | Invoice</title>
</head>

<body class="body">
    <?php
    require "connection.php";
    require "header.php"; ?>
    <div class="container-fluid">
        <div class="col-12">
            <div class="row">
                <div class="col-12 p-3">
                    <div class="row">
                        <div class="col-4 col-lg-2 d-grid offset-5 offset-lg-8">
                            <button class="btn btn-danger" onclick="savePg();"> <i class="bi bi-file-earmark-pdf-fill"></i>&nbsp;Save as PDF</button>
                        </div>
                        <div class="col-3 col-lg-1 d-grid">
                            <button class="btn btn-primary" onclick="printPg();"><i class="bi bi-printer-fill"></i>&nbsp;Print</button>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <hr />
                </div>
                <div class="col-12" id="page">
                    <div class="row">
                        <div class="col-12 p-3">
                            <div class="row">
                                <div class="col-1">
                                    <img src="resource/icon.jpg" style="height:100px ;" />
                                </div>
                                <div class="col-5 col-lg-3 offset-6 offset-lg-8">
                                    <div class="row">
                                        <div class="col-12 title1 fs-3 text-success">Sooper Vegan</div>
                                        <div class="col-12">49, Industrial Estate, Katuwana, Homagama</div>
                                        <div class="col-12">0712301748</div>
                                        <a href="newtech@gmail.com">sujaninternational@gmail.com</a>
                                    </div>

                                </div>

                            </div>
                        </div>
                        <div>
                            <hr />
                        </div>
                        <div class="col-12 p-3">
                            <div class="row">
                                <div class="col-6 col-lg-3">
                                    <div class="row">
                                        <?php

                                        $customer = $_SESSION["u"];
                                        ?>
                                        <div class="col-12 fs-3">BILLED TO :</div>
                                        <div class="col-12 fs-4"><?php echo ($customer["fname"] . " " . $customer["lname"]); ?></div>
                                        <?php
                                        $address_rs = Database::search("SELECT * FROM `customer_has_address` WHERE `customer_mobile` = '" . $customer["mobile"] . "'");
                                        $address_data = $address_rs->fetch_assoc();
                                        $city_rs = Database::search("SELECT * FROM `city` WHERE `id` = '" . $address_data["city_id"] . "'");
                                        $city_data = $city_rs->fetch_assoc();

                                        ?>
                                        <div class="col-12"><?php echo ($address_data["line1"] . ", " . $address_data["line2"] . ", " . $city_data["name"]); ?></div>
                                        <a href="tharushihettiarachchi13@gmail.com"><?php echo ($customer["email"]); ?></a>
                                    </div>
                                </div>
                                <div class="col-5 col-lg-3 offset-1 offset-lg-6">
                                    <div class="row pt-3">
                                        <?php

                                        $invoice_rs = Database::search("SELECT * FROM `invoice` WHERE `order_id` = '" . $id . "'");
                                        $invoice_data = $invoice_rs->fetch_assoc();
                                        ?>
                                        <div class="col-12 fs-2">INVOICE <?php echo ($invoice_data["id"]);  ?> </div>
                                        <div class="text-secondary">Invoice Data : <?php echo ($invoice_data["date"]);  ?> </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php


                        if (isset($invoice_data["products_id"])) {
                            $product_rs = Database::search("SELECT * FROM `products` WHERE `id` = '" . $invoice_data["products_id"] . "'");
                            $product_data = $product_rs->fetch_assoc();
                        ?>

                            <div class="col-12 pt-5 p-3">

                                <table class="table">
                                    <thead>
                                        <tr class="bg-secondary">
                                            <th scope="col">#</th>
                                            <th scope="col">Product</th>
                                            <th scope="col">Unit Price</th>
                                            <th scope="col">Qty</th>
                                            <th scope="col">Total</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row">1</th>
                                            <td><?php echo ($product_data["product_name"]); ?></td>
                                            <td>Rs. <?php echo ($product_data["price"]); ?> .00 </td>
                                            <td><?php echo ($invoice_data["qty"]); ?></td>
                                            <td>Rs. <?php echo ($product_data["price"] * $invoice_data["qty"]); ?> .00</td>
                                        </tr>




                                    </tbody>
                                </table>
                            </div>
                            <div class="col-4 col-lg-2 offset-5 offset-lg-7 text-center fs-4">Sub Total</div>
                            <div class=" col-3 col-lg-2">Rs. <?php echo ($product_data["price"] * $invoice_data["qty"]); ?> .00</div>
                            <div class=" col-4 col-lg-2 offset-5 offset-lg-7 text-center fs-4">Discount</div>
                            <div class="col-3 col-lg-2">Rs. 00.00</div>
                            <div class="col-4 col-lg-2 offset-5 offset-lg-7 text-center fs-4">Grand Total</div>
                            <div class="col-3 col-lg-2 fs-6 border-end-0 border-start-0 border-3 border border-dark">Rs. <?php echo ($product_data["price"] * $invoice_data["qty"]); ?> .00</div>

                        <?php

                        } else {
                        ?>
                            <div class="col-12 pt-5 p-3">
                                <table class="table">
                                    <thead>
                                        <tr class="bg-secondary">
                                            <th scope="col">#</th>
                                            <th scope="col">Product</th>
                                            <th scope="col">Unit Price</th>
                                            <th scope="col">Qty</th>
                                            <th scope="col">Total</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $pro_rs = Database::search("SELECT * FROM `order` WHERE `order_id` = '" . $invoice_data["order_id"] . "'");
                                        $pro_num = $pro_rs->num_rows;
                                        $c = 0;
                                        $e=0;
                                        for ($b = 0; $b < $pro_num; $b++) {
                                            $pro_data = $pro_rs->fetch_assoc();
                                            $c = $c + 1;
                                            $product_rs = Database::search("SELECT * FROM `products` WHERE `id` = '" . $pro_data["products_id"] . "'");
                                            $product_data = $product_rs->fetch_assoc();


                                        ?>
                                            <tr>
                                                <th scope="row"><?php echo ($c); ?></th>
                                                <td><?php echo ($product_data["product_name"]); ?></td>
                                                <td>Rs. <?php echo ($product_data["price"]); ?> .00 </td>
                                                <td><?php echo ($pro_data["qty"]); ?></td>
                                                <td>Rs. <?php echo ($product_data["price"] * $pro_data["qty"]); ?> .00</td>
                                            </tr>

                                        <?php
                                        $e = $e + ($product_data["price"] * $pro_data["qty"]);
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-4 col-lg-2 offset-5 offset-lg-7 text-center fs-4">Sub Total</div>
                            <div class=" col-3 col-lg-2">Rs. <?php echo ($e); ?> .00</div>
                            <div class=" col-4 col-lg-2 offset-5 offset-lg-7 text-center fs-4">Delivery Fee</div>
                            <div class="col-3 col-lg-2">Rs. 300.00</div>
                            <div class="col-4 col-lg-2 offset-5 offset-lg-7 text-center fs-4">Grand Total</div>
                            <?php
                            $g = $e + 300;
                            ?>
                            <div class="col-3 col-lg-2 fs-6 border-end-0 border-start-0 border-3 border border-dark">Rs. <?php echo ($g); ?> .00</div>


                        <?php
                        }
                        ?>

                        <div class="col-12 p-3">
                            <div class="alert alert-success" role="alert">
                                Note : You Can Return the products within 2 days of delivery
                            </div>

                        </div>
                        <div class="col-12">
                            <hr />
                        </div>
                        <div class="col-12 text-secondary text-center">This is a computer generated bill. Valid without a Signature</div>
                        <div class="col-12">
                            <hr />
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
    <script src="js/jsPDF/dist/jspdf.umd.js"></script>
</body>

</html>