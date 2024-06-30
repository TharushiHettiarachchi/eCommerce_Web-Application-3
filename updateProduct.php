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
        <div class="col-12">
            <div class="row">
                <div class="col-12 text-center fs-1">Update Product</div>
                <div class="col-lg-8 col-12 offset-lg-2 p-3">
                    <div class="row">
                        <div class="col-12">
                            <div class="row">
                                <label class="form-label">Product Name</label>
                                <input type="text" class="form-control" id="pname" />
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="row">
                                <label class="form-label">Product Description</label>
                                <textarea class="form-control" cols="20" rows="5" id="pdescription"></textarea>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="row">
                                <label class="form-label">Price</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text">Rs.</span>
                                    <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)" id="pprice">
                                    <span class="input-group-text">.00</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="row">
                                <label class="form-label">Product Type</label>
                                <select class="form-select" id="ptype">
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
                                </div>
                        </div>
                        <div class="col-12 d-grid">
                            <input type="file" class="d-none" accept="images/*" id="productPic"/>
                            <label for="productPic" class="btn btn-success" onclick="addProductImg();">Upload a Product photo</label>
                        </div>
                        <div class="col-12 d-flex align-items-center justify-content-center pt-3 bg-light mt-3 rounded" style="height: 230px;">
                            <div class="text-center" id="displayText">Product Image will be displayed Here</div>
                            <img src="" style="height:200px;" id="viewImg" class="d-none"/>
                        </div>
                        <div class="col-12 d-grid">
                            <button class="btn btn-success mt-3" onclick="addNewProduct();">Add Product</button>
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