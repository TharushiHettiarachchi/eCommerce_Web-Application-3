<?php
session_start();
$pageno;
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
    <title>Sooper Vegan | My Products</title>
</head>

<body class="body" style="overflow-x:hidden ;">
    
    <div class="container-fluid pt-1" style="background-color:#A8E890;">
        <div class="col-12 pt-3">
            <div class="row pt-2">
                <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item text-success"><a href="adminPanel.php" class="text-success fw-bold">Admin Panel</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Manage Products</li>
                    </ol>
                </nav>
                <div class="col-12 fs-1 text-center"><i class="bi bi-basket-fill"></i>&nbsp;&nbsp;Manage Products</div>

                <div class="col-12">
                    <div class="row p-3">
                        <div class="col-12 col-lg-3 p-3">
                            <div class="col-12">
                                <div class="row pb-3">
                                    <div class="col-12">
                                        <button class="btn btn-success col-12" style="background-color:#2EB086;" onclick="window.location = 'addProduct.php';">Add Product</button>
                                    </div>
                                </div>
                            </div>
                            <div class="row border border-success border-2 p-3 rounded">
                                <div class="col-12 fs-3 pb-2">Sort By...</div>
                                <div class="input-group mb-3 col-12">
                                    <input type="text" class="form-control" placeholder="Search cart" aria-label="Recipient's username" aria-describedby="button-addon2">
                                    <button class="btn btn-outline-secondary bg-light" type="button" id="button-addon2"><i class="bi bi-search fs-5 text-dark"></i></button>
                                </div>
                                <div class="col-12">
                                    <select class="col-12 form-select s1">
                                        <option>Sort By Price</option>
                                        <option>Price Highest To Lowest</option>
                                        <option>Price Lowest To Highest</option>
                                    </select>
                                </div>
                                <div class="col-12 mt-2">
                                    <select class="col-12 form-select">
                                        <option>Sort By Quantity</option>
                                        <option>Quantity Highest To Lowest</option>
                                        <option>Quantity Lowest To Highest</option>
                                    </select>
                                </div>
                                <div class="col-12 mt-2">
                                    <select class="col-12 form-select">
                                        <option>Sort By Brand</option>
                                        <option>Apple</option>
                                        <option>Samsung</option>
                                        <option>Huawei</option>
                                    </select>
                                </div>
                                <div class="col-12 mt-2">
                                    <select class="col-12 form-select">
                                        <option>Sort By Condition</option>
                                        <option>Brand New</option>
                                        <option>Used</option>

                                    </select>
                                </div>
                                <div class="col-12 mt-2">
                                    <select class="col-12 form-select">
                                        <option>Sort By Active Time</option>
                                        <option>Newest to Oldest</option>
                                        <option>Oldest to Newest</option>

                                    </select>
                                </div>
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-6 d-grid p-3">
                                            <button class="btn btn-success" style="background-color:#2EB086;">Search</button>
                                        </div>
                                        <div class="col-6 d-grid p-3">
                                            <button class="btn btn-success" style="background-color:#2EB086;">Clear</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-9">
                            <div class="row">
                                <?php
                                require "connection.php";
                                if (isset($_GET["page"])) {
                                    $pageno = $_GET["page"];
                                } else {
                                    $pageno = 1;
                                }

                                $product_rs = Database::search("SELECT * FROM `products`");
                                $product_num = $product_rs->num_rows;

                                $results_per_page = 8;
                                $number_of_pages = ceil($product_num / $results_per_page);

                                $page_results = ($pageno - 1) * $results_per_page;
                                $selected_rs = Database::search("SELECT * FROM `products` 
LIMIT " . $results_per_page . " OFFSET " . $page_results . "");

                                $selected_num = $selected_rs->num_rows;

                                for ($x = 0; $x < $selected_num; $x++) {
                                    $selected_data = $selected_rs->fetch_assoc();

                                ?>

                                    <div class="col-lg-6 col-12">
                                        <div class="card mb-3" style="max-width: 540px;">
                                            <div class="row g-0">
                                                <div class="col-4 col-lg-4 col-md-4">
                                                    <img src="<?php echo ($selected_data["pic"]); ?>" class="card-img-top" style="height:190px ;">
                                                </div>
                                                <div class="col-8 col-lg-8 col-md-8">
                                                    <div class="card-body">
                                                        <h5 class="card-title text-center text-success"><?php echo ($selected_data["product_name"]); ?></h5>
                                                        <div class="card-text text-center col-12"> Rs. 100000.00</div>
                                                        <div class="card-text text-center col-12"> 3 Items available</div>
                                                        <div class="form-check form-switch col-12 offset-2">
                                                            <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked>
                                                            <label class="form-check-label" for="flexSwitchCheckChecked">Disable Product</label>
                                                        </div>
                                                        <div class="col-12 d-grid">
                                                            <div class="row pe-3 ps-3">
                                                                <button class="btn btn-success text-dark mt-3 col-12 col-lg-5" style="background-color: #A8DF65; border-color:rgb(181,230,29);">Update</button>
                                                                <button class="btn btn-success text-dark mt-2 mt-lg-3 ms-lg-1 col-12 col-lg-6" style="background-color: #A8DF65; border-color:rgb(181,230,29);">Delete</button>

                                                            </div>
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
            </div>
            <div class="col-12 offset-0 offset-lg-1 p-3 text-success">
                <nav aria-label="Page navigation example">
                    <ul class="pagination pagination-sm justify-content-center text-success">
                        <li class="page-item text-success">
                            <a class="page-link text-success" href="<?php if ($pageno <= 1) {
                                                            echo "#";
                                                        } else {
                                                            echo "?page=" . ($pageno - 1);
                                                        } ?>" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        <?php

                        for ($x = 1; $x <= $number_of_pages; $x++) {
                            if ($x == $pageno) {

                        ?>
                                <li class="page-item active">
                                    <a class="page-link bg-success border border-success" href="<?php echo "?page=" . ($x); ?>"><?php echo $x; ?></a>
                                </li>
                            <?php

                            } else {
                            ?>
                                <li class="page-item">
                                    <a class="page-link text-success" href="<?php echo "?page=" . ($x); ?>"><?php echo $x; ?></a>
                                </li>
                        <?php
                            }
                        }

                        ?>

                        <li class="page-item">
                            <a class="page-link text-success" href="<?php if ($pageno >= $number_of_pages) {
                                                            echo "#";
                                                        } else {
                                                            echo "?page=" . ($pageno + 1);
                                                        } ?>" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>



    <?php require "footer.php"; ?>





    <script src="script.js"></script>
    <script src="bootstrap.js"></script>
    <script src="bootstrap.bundle.js"></script>
</body>

</html>