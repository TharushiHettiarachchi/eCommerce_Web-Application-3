<?php
session_start();
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
    <title>Sooper Vegan | Advanced Search</title>
</head>

<body class="body">
    <div class="col-12 fixed-top bg-light">
        <?php require "header.php"; ?>
    </div>
    <?php require "header.php"; ?>
    <div class="container-fluid body1" style="background-color: #A8E890;">
        <div class="col-12">
            <div class="row">
                <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="home.php" class="fw-bold text-success">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Advanced Search</li>
                    </ol>
                </nav>
                <div class="col-12 fs-1 text-dark text-center"><i class="bi bi-search"></i>&nbsp; &nbsp;Advanced Search</div>
                <div class="col-12 p-lg-3">
                    <div class="row">
                        <div class="col-lg-6 col-12 offset-lg-3">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Search by Category" aria-label="Text input with dropdown button" id="searcha">

                                <select class="form-select bg-transparent border-success border-1" style="max-width:150px ;" id="select">
                                    <option value="0">Category</option>
                                    <?php
                                    require "connection.php";
                                    $category_rs = Database::search("SELECT * FROM `product_types`");
                                    $category_num = $category_rs->num_rows;
                                    for ($x = 0; $x < $category_num; $x++) {
                                        $category_data = $category_rs->fetch_assoc();
                                    ?>
                                        <option value="<?php echo ($category_data["id"]);  ?>"><?php echo ($category_data["product_type"]);  ?></option>
                                    <?php
                                    }
                                    ?>

                                </select>
                                <button class="col-lg-2 col-12 rounded btn btn-success mt-3 mt-lg-0 ms-lg-3" onclick="adSearch();">Search</button>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-12">Filter By <i class="bi bi-filter"></i></div>
                <div class="col-12 p-3">
                    <div class="row">
                        <div class="col-lg-4 col-12 mt-2 mt-lg-0">
                            <select class="col-12 form-select" id="price">
                                <option value="0">Filter By Price</option>
                                <option value="1">Price Highest To Lowest</option>
                                <option value="2">Price Lowest To Highest</option>
                            </select>
                        </div>
                        <div class="col-lg-4 col-12 mt-2 mt-lg-0">
                            <select class="col-12 form-select" id="qty">
                                <option value="0">Filter By Quantity</option>
                                <option value="1">Quantity Highest To Lowest</option>
                                <option value="2">Quantity Lowest To Highest</option>
                            </select>
                        </div>

                        <div class="col-lg-4 col-12 mt-2 mt-lg-0">
                            <select class="col-12 form-select">
                                <option>Filter By Active Time</option>
                                <option>Newest to Oldest</option>
                                <option>Oldest to Newest</option>

                            </select>
                        </div>
                        <div class="col-12 p-3">
                            <div class="row">
                                <div class="col-12 col-lg-1 text-center offset-lg-1 mt-2">Price From</div>
                                <div class="col-12 col-lg-4">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text">Rs.</span>
                                        <input type="text" class="form-control" id="p1">
                                        <span class="input-group-text">.00</span>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-1 text-center mt-2">To</div>
                                <div class="col-12 col-lg-4">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text">Rs.</span>
                                        <input type="text" class="form-control" id="p2">
                                        <span class="input-group-text">.00</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 p-3">
                            <div class="row" id="searchrs">
                                <div class="col-12 border border-success border-2 rounded pt-5" style="height: 400px;">
                                    <div class="row">
                                        <i class="bi bi-search col-12 fs-1 text-center"></i>
                                        <div class="col-12 fs-1 text-secondary text-center">No Items Searched Yet...</div>
                                    </div>
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
</body>

</html>