<?php
require "connection.php";
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
    <title>Sooper Vegan | Profile</title>
</head>

<body class="body" style="background-color:#DAFFB5;">

    <div class="col-12 fixed-top bg-light">
        <?php require "header.php"; ?>
    </div>

    <div class="container-fluid pt-5" style="background-color:#A8E890;height: 100vh;">
        <div class="col-12 pt-5 pt-lg-3">
            <div class="row pt-5 pt-lg-0">
                <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a class="text-success" href="home.php">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Profile</li>
                    </ol>
                </nav>
                <?php
                $customer_rs = Database::search("SELECT * FROM `customer` WHERE `mobile` ='" . $user["mobile"] . "'");
                $customer_data = $customer_rs->fetch_assoc();
                $customer_rs1 = Database::search("SELECT * FROM `customer_has_address` WHERE `customer_mobile` ='" . $user["mobile"] . "'");
                $customer_num1 = $customer_rs1->num_rows;
                $customer_data1 = $customer_rs1->fetch_assoc();


                ?>
                <div class="col-12">
                    <div class="row">
                        <div class=" col-12 col-lg-4 offset-lg-1">
                            <div class="row">
                                <div class="col-12 text-center">
                                    <?php
                                    if (!isset($customer_data["profile_pic"])) {
                                    ?>
                                        <img src="resource/q.png" id="viewImg" style="height:100px;" class="rounded-circle" />
                                    <?php
                                    } else {
                                    ?>
                                        <img src="<?php echo ($customer_data["profile_pic"]); ?>" id="viewImg" style="height:100px;" class="rounded-circle" />
                                    <?php
                                    }

                                    ?>

                                </div>
                                <div class="col-12 text-center mt-1">
                                    <input type="file" class="d-none" id="profileimg" accept="image/*" />
                                    <label for="profileimg" class="btn btn-success" onclick="changeProfilePic();">Update Profile Image</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 text-center text-lg-start col-lg-6 pt-5">
                            <span class="fs-4 fw-bold"><?php echo ($customer_data["fname"] . " " . $customer_data["lname"]); ?></span></br>
                            <span class="fs-6"><?php echo ($customer_data["email"]); ?></span></br>
                            <span><b>Joined on : </b> <?php echo ($customer_data["joined_date"]); ?></span>
                        </div>
                        <!-- <div class="col-8 offset-2"> -->
                        <hr class="border-success col-12 col-lg-8 offset-lg-2 mt-2" style="border-width: 3px;" />
                        <!-- </div> -->

                        <div class="col-12 col-lg-8 offset-lg-2" style="overflow-y:scroll ; height:450px;">
                            <div class="row">
                                <div class="col-12 fw-bold fs-4 p-3">Personal Details</div>
                                <div class="col-6 pt-1">
                                    <label class="form-label">First Name</label>
                                    <input type="text" class="form-control" value="<?php echo ($customer_data["fname"]); ?>" disabled />
                                </div>
                                <div class="col-6 pt-1">
                                    <label class="form-label">Last Name</label>
                                    <input type="text" class="form-control" value="<?php echo ($customer_data["lname"]); ?>" disabled />
                                </div>
                                <div class="col-6 pt-1">
                                    <label class="form-label">Mobile Number</label>
                                    <input type="text" class="form-control" value="<?php echo ($customer_data["mobile"]); ?>" disabled />
                                </div>
                                <div class="col-6 pt-1">
                                    <label class="form-label">Email</label>
                                    <input type="text" class="form-control" value="<?php echo ($customer_data["email"]); ?>" disabled />
                                </div>
                                <div class="col-6 pt-1">
                                    <label class="form-label">Password</label>
                                    <div class="input-group mb-3">
                                        <input class="form-control" id="password" type="password" value="<?php echo ($customer_data["password"]); ?>" disabled aria-describedby="basic-addon2">
                                        <span class="input-group-text" id="basic-addon2" onclick="reveal();"><i id="tog" class="bi bi-eye"></i></span>
                                    </div>

                                </div>
                                <div class="col-6 pt-1">
                                    <label class="form-label">Gender</label>
                                    <select class="form-select">
                                        <?php
                                        $gender_rs = Database::search("SELECT * FROM `gender`");
                                        $gender_num = $gender_rs->num_rows;
                                        for ($g = 0; $g < $gender_num; $g++) {
                                            $gender_data = $gender_rs->fetch_assoc();
                                        ?>
                                            <option value="<?php echo ($gender_data["id"]); ?>" <?php
                                                                                                if ($customer_data["gender_id"] == $gender_data["id"]) {
                                                                                                ?> selected <?php
                                                                                                        }
                                                                                                            ?>><?php echo ($gender_data["name"]); ?></option>
                                        <?php
                                        }


                                        ?>

                                    </select>
                                </div>
                                <div class="col-12 fw-bold fs-4 p-3">Billing Details</div>
                                <?php
                                if ($customer_num1 == 0) {
                                ?>
                                    <div class="col-6 pt-1">
                                        <label class="form-label">Address Line 1</label>
                                        <input type="text" class="form-control" id="line1" />
                                    </div>
                                    <div class="col-6 pt-1">
                                        <label class="form-label">Address Line 2</label>
                                        <input type="text" class="form-control" id="line2" />
                                    </div>
                                    <div class="col-6  pt-1">
                                        <label class="form-label">City</label>
                                        <select class="form-select" id="city">
                                            <?php
                                            $city_rs = Database::search("SELECT * FROM `city`");
                                            $city_num = $city_rs->num_rows;
                                            for ($c = 0; $c < $city_num; $c++) {
                                                $city_data = $city_rs->fetch_assoc();
                                            ?>
                                                <option value="<?php echo ($city_data["id"]); ?>"><?php echo ($city_data["name"]); ?></option>
                                            <?php
                                            }


                                            ?>

                                        </select>
                                    </div>
                                    <div class="col-6 pt-1">
                                        <label class="form-label">District</label>
                                        <select class="form-select" id="district">
                                            <?php
                                            $district_rs = Database::search("SELECT * FROM `district`");
                                            $district_num = $district_rs->num_rows;
                                            for ($d = 0; $d < $district_num; $d++) {
                                                $district_data = $district_rs->fetch_assoc();
                                            ?>
                                                <option value="<?php echo ($district_data["id"]); ?>" <?php
                                                                                                        if ($city_data["district_id"] == $district_data["id"]) {
                                                                                                        ?> selected <?php
                                                                                                                }
                                                                                                                    ?>><?php echo ($district_data["name"]); ?></option>
                                            <?php
                                            }


                                            ?>

                                        </select>
                                    </div>
                                    <div class="col-6 pt-1">
                                        <label class="form-label">Province</label>
                                        <select class="form-select" id="province">
                                            <?php
                                            $province_rs = Database::search("SELECT * FROM `province`");
                                            $province_num = $province_rs->num_rows;
                                            for ($p = 0; $p < $province_num; $p++) {
                                                $province_data = $province_rs->fetch_assoc();
                                            ?>
                                                <option value="<?php echo ($province_data["id"]); ?>" <?php
                                                                                                        if ($district_data["province_id"] == $province_data["id"]) {
                                                                                                        ?> selected <?php
                                                                                                                }
                                                                                                                    ?>><?php echo ($province_data["name"]); ?></option>
                                            <?php
                                            }


                                            ?>

                                        </select>
                                    </div>
                                    <div class="col-6 pt-1">
                                        <label class="form-label">Postal Code</label>
                                        <input type="text" class="form-control" id="pcode" />
                                    </div>

                                <?php

                                } else if ($customer_num1 == 1) {
                                ?>
                                    <div class="col-6 pt-1">
                                        <label class="form-label">Address Line 1</label>
                                        <input type="text" class="form-control" id="line1" value="<?php echo ($customer_data1["line1"]); ?>" />
                                    </div>
                                    <div class="col-6 pt-1">
                                        <label class="form-label">Address Line 2</label>
                                        <input type="text" class="form-control" id="line2" value="<?php echo ($customer_data1["line2"]); ?>" />
                                    </div>
                                    <div class="col-6  pt-1">
                                        <label class="form-label">City</label>
                                        <select class="form-select" id="city">
                                            <?php
                                            $city_rs = Database::search("SELECT * FROM `city`");
                                            $city_num = $city_rs->num_rows;
                                            for ($c = 0; $c < $city_num; $c++) {
                                                $city_data = $city_rs->fetch_assoc();
                                            ?>
                                                <option value="<?php echo ($city_data["id"]); ?>" <?php
                                                                                                    if ($customer_data1["city_id"] == $city_data["id"]) {
                                                                                                    ?> selected <?php
                                                                                                            }
                                                                                                                ?>><?php echo ($city_data["name"]); ?></option>
                                            <?php
                                            }


                                            ?>

                                        </select>
                                    </div>
                                    <div class="col-6 pt-1">
                                        <label class="form-label">District</label>
                                        <select class="form-select" id="district">
                                            <?php
                                            $district_rs = Database::search("SELECT * FROM `district`");
                                            $district_num = $district_rs->num_rows;
                                            for ($d = 0; $d < $district_num; $d++) {
                                                $district_data = $district_rs->fetch_assoc();
                                            ?>
                                                <option value="<?php echo ($district_data["id"]); ?>" <?php
                                                                                                        if ($city_data["district_id"] == $district_data["id"]) {
                                                                                                        ?> selected <?php
                                                                                                                }
                                                                                                                    ?>><?php echo ($district_data["name"]); ?></option>
                                            <?php
                                            }


                                            ?>

                                        </select>
                                    </div>
                                    <div class="col-6 pt-1">
                                        <label class="form-label">Province</label>
                                        <select class="form-select" id="province">
                                            <?php
                                            $province_rs = Database::search("SELECT * FROM `province`");
                                            $province_num = $province_rs->num_rows;
                                            for ($p = 0; $p < $province_num; $p++) {
                                                $province_data = $province_rs->fetch_assoc();
                                            ?>
                                                <option value="<?php echo ($province_data["id"]); ?>" <?php
                                                                                                        if ($district_data["province_id"] == $province_data["id"]) {
                                                                                                        ?> selected <?php
                                                                                                                }
                                                                                                                    ?>><?php echo ($province_data["name"]); ?></option>
                                            <?php
                                            }


                                            ?>

                                        </select>
                                    </div>
                                    <div class="col-6 pt-1">
                                        <label class="form-label">Postal Code</label>
                                        <input type="text" class="form-control" id="pcode" value="<?php echo ($customer_data1["postal_code"]); ?>" />
                                    </div>

                                <?php
                                }


                                ?>
                                <div class="col-12 d-grid mt-2 mb-2">
                                    <button class="btn btn-success" onclick="updateProfile();">Update My Profile</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>




    </div>









    <script src="script.js"></script>
    <script src="bootstrap.js"></script>
    <script src="bootstrap.bundle.js"></script>
</body>

</html>