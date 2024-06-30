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
    <link rel="icon" href="resource/icon.png" />
    <title>New Tech | Home</title>
</head>

<body class="body" style="overflow-x: hidden; background-color: rgb(181,230,29);">

    <div class="container-fluid" style="background-color: rgb(181,230,29);">
        <div class="col-12">
            <div class="row">
                <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a class="text-success" href="adminPanel.php">Admin Panel</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Manage Customers</li>
                    </ol>
                </nav>
                <div class="col-12 fs-1 text-dark text-center"><i class="bi bi-people-fill"></i>&nbsp;Manage Customer</div>
                <div class="col-7">
                    <div class="row">
                        <div class="input-group mb-3 offset-4">
                            <input type="text" class="form-control" id="user" placeholder="Search a User" onkeyup="userSearch();" aria-label="Recipient's username" aria-describedby="button-addon2">
                            <button class="btn btn-outline-secondary" type="button" id="button-addon2" onclick="userSearch();"><i class="bi bi-search fs-5"></i></button>
                        </div>
                    </div>
                </div>
                <div class="col-12 p-3">
                    <table class="table">
                        <thead class="bg-success">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col" class="d-none d-lg-block">Profile Photo</th>
                                <th scope="col">Name</th>
                                <th scope="col">Mobile Number</th>
                                <th scope="col" class="d-none d-lg-block">Email</th>
                                <th scope="col">Registered Date & Time</th>
                                
                            </tr>
                        </thead>
                        <tbody id="bod">
                            <?php
                            $id = 0;
                            $invoice_rs = Database::search("SELECT * FROM `customer`");
                            $invoice_num = $invoice_rs->num_rows;
                            for ($x = 0; $x < $invoice_num; $x++) {
                                $invoice_data = $invoice_rs->fetch_assoc();
                                $id = $id + 1;
                                if ($invoice_data["mobile"] !== "0712301748") {
                            ?>
                                    <tr>
                                        <th scope="row"><?php echo ($id); ?></th>
                                        <?php
                                        if (!isset($invoice_data["profile_pic"])) {
                                        ?>
                                            <td class="d-none d-lg-block pb-2"> <img src="resource/q.png" style="height:50px ;" /></td>
                                        <?php
                                        } else {
                                        ?>
                                            <td class="d-none d-lg-block pb-2"> <img src="<?php echo ($invoice_data["profile_pic"]); ?>" style="height:50px ;" /></td>
                                        <?php
                                        }

                                        ?>

                                        <td><?php echo ($invoice_data["fname"] . " " . $invoice_data["lname"]); ?></td>
                                        <th><?php echo ($invoice_data["mobile"]); ?></th>
                                        <td class="d-none d-lg-block pb-lg-4"><?php echo ($invoice_data["email"]); ?></td>
                                        <td><?php echo ($invoice_data["joined_date"]); ?></td>
                                            </tr>

                                <?php
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