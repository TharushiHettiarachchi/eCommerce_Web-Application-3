<?php
require "connection.php";
session_start();
if (isset($_SESSION["ad"]["email"])) {
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

    <body class="body">
        <div class="container-fluid" style="background-color: rgb(181,230,29);">
            <div class="col-12">
                <div class="row">
                    <div class="col-12 col-lg-2 bg-dark pt-5 vh-100">
                        <div class="row">
                            <div class="col-12 text-center">
                                <img src="resource/prof1.jpg" class="rounded-circle" style="height:50px ;" />
                            </div>
                            <div class="col-12 text-center">
                                <span class="col-12 fw-bold fs-4 text-white">Admin</span></br>
                                <span class="col-12 fs-6 text-white">sujaninternational@gmail.com</span></br>
                            </div>
                            <div class="col-12 d-grid mt-2">
                                <button class="btn btn-success" onclick="window.location = 'myProducts.php';">Manage Products</button>
                            </div>
                            <div class="col-12 d-grid mt-2">
                                <button class="btn btn-success" onclick="window.location = 'manageCustomer.php';">Manage Customers</button>
                            </div>
                            <div class="col-12 d-grid mt-2">
                                <button class="btn btn-success" onclick="window.location = 'selling.php';">View Sellings</button>
                            </div>
                            <div class="col-12 d-grid mt-2">
                                <button class="btn btn-success" onclick="window.location = 'order.php';">Orders</button>
                            </div>
                            <div class="col-12 d-grid mt-2">
                                <button class="btn btn-success" onclick="window.location = 'dataAnalyse.php';">Data Analysis</button>
                            </div>

                            <div class="col-12 d-grid mt-2">
                                <button class="btn btn-success" onclick="window.location = 'chat.php';">Chat</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-10">
                        <div class="row">
                            <div class="col-12 fs-2"><i class="bi bi-person-fill"></i> &nbsp; Dashboard</div>
                            <div class="col-12">
                                <div class="row p-3">
                                    <div class="col-12 col-lg-3 border border-2 border-success text-center rounded pt-3 bg-success me-lg-2 offset-lg-1" style="height: 100px;">
                                        <span class="col-12">Today's Sellings</span><br />
                                        <?php
                                        $date = date("Y-m-d");
                                        $t_income = 0;

                                        $in_rs = Database::search("SELECT * FROM `invoice`");
                                        $in_num = $in_rs->num_rows;
                                        for ($u = 0; $u < $in_num; $u++) {
                                            $in_data = $in_rs->fetch_assoc();
                                            $datein = $in_data["date"];
                                            $new_date = strtotime("$datein");
                                            $new_date1 = date("Y-m-d", $new_date);


                                            if ($new_date1 == $date) {
                                                $t_income = $t_income + intval($in_data["total"]);
                                            }
                                        }
                                        $in_rs = Database::search("SELECT * FROM `deleted_purchases`");
                                        $in_num = $in_rs->num_rows;
                                        for ($u = 0; $u < $in_num; $u++) {
                                            $in_data = $in_rs->fetch_assoc();
                                            $datein = $in_data["date"];
                                            $new_date = strtotime("$datein");
                                            $new_date1 = date("Y-m-d", $new_date);


                                            if ($new_date1 == $date) {
                                                $t_income = $t_income + intval($in_data["total"]);
                                            }
                                        }




                                



                                        ?>
                                        <span class="col-12">Rs. <?php echo ($t_income);  ?> .00</span>
                                    </div>
                                    <div class="col-12 mt-2 mt-lg-0 col-lg-3 border border-2 border-success text-center rounded pt-3 bg-success me-lg-2" style="height: 100px;">
                                        <span class="col-12">Monthly Sellings</span><br />
                                        <?php
                                        $date1 = date("Y-m");
                                        $t_income1 = 0;

                                        $in_rs1 = Database::search("SELECT * FROM `invoice`");
                                        $in_num1 = $in_rs1->num_rows;
                                        for ($u1 = 0; $u1 < $in_num; $u1++) {
                                            $in_data1 = $in_rs1->fetch_assoc();
                                            if(isset( $in_data1["date"])){
                                            $datein1 = $in_data1["date"];
                                            $new_date11 = strtotime("$datein1");
                                            $new_date12 = date("Y-m", $new_date11);


                                            if ($new_date12 == $date1) {
                                                $t_income1 = $t_income1 + intval($in_data1["total"]);
                                            }
                                        }
                                        }
                                        $in_rs1 = Database::search("SELECT * FROM `deleted_purchases`");
                                        $in_num1 = $in_rs1->num_rows;
                                        for ($u1 = 0; $u1 < $in_num; $u1++) {
                                            $in_data1 = $in_rs1->fetch_assoc();
                                            if(isset( $in_data1["date"])){

                                            $datein1 = $in_data1["date"];
                                            $new_date11 = strtotime("$datein1");
                                            $new_date12 = date("Y-m", $new_date11);


                                            if ($new_date12 == $date1) {
                                                $t_income1 = $t_income1 + intval($in_data1["total"]);
                                            }
                                        }
                                        }
                                        ?>
                                        <span class="col-12">Rs. <?php echo ($t_income1);  ?> .00</span>
                                    </div>
                                    <div class="col-12 mt-2 mt-lg-0 col-lg-3 border border-2 border-success text-center rounded pt-3 bg-success" style="height: 100px;">
                                        <span class="col-12">Total Items Sold</span><br />
                                        <?php
                                        $items = Database::search("SELECT * FROM `invoice` ");
                                        $item_num = $items->num_rows;
                                        $itno = 0;
                                        for ($i = 0; $i < $item_num; $i++) {
                                            $item_data = $items->fetch_assoc();
                                            $itno = $itno + intval($item_data["qty"]);
                                            
                                        }
                                        $items = Database::search("SELECT * FROM `deleted_purchases` ");
                                        $item_num = $items->num_rows;
                                        
                                        for ($i = 0; $i < $item_num; $i++) {
                                            $item_data = $items->fetch_assoc();
                                            $itno = $itno + intval($item_data["qty"]);
                                            
                                        }



                                        ?>
                                        <span class="col-12"><?php echo ($itno);  ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">


                                <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>

                                <canvas id="myChart" class="bg-transparent text-success chart" style="max-width:70% ; margin-left:15%;"></canvas>
                                <?php
                                $today_year = date("Y");
                                $array;
                                for ($d = 1; $d < 13; $d++) {
                                    if ($d < 10) {
                                        $date15 = date("$today_year-0$d");
                                        $t_income25 = 0;

                                        $in_rs15 = Database::search("SELECT * FROM `invoice`");
                                        $in_num15 = $in_rs15->num_rows;
                                        for ($u15 = 0; $u15 < $in_num; $u15++) {
                                            $in_data15 = $in_rs15->fetch_assoc();
                                            if(isset($in_data15["date"])){
                                            $datein15 = $in_data15["date"];
                                            $new_date115 = strtotime("$datein15");
                                            $new_date125 = date("Y-m", $new_date115);


                                            if ($new_date125 == $date15) {
                                                $t_income25 = $t_income25 + intval($in_data15["total"]);
                                            }
                                        }
                                        }
                                        $in_rs15 = Database::search("SELECT * FROM `deleted_purchases`");
                                        $in_num15 = $in_rs15->num_rows;
                                        for ($u15 = 0; $u15 < $in_num; $u15++) {
                                            $in_data15 = $in_rs15->fetch_assoc();
                                            if(isset($in_data15["date"])){

                                            $datein15 = $in_data15["date"];
                                            $new_date115 = strtotime("$datein15");
                                            $new_date125 = date("Y-m", $new_date115);


                                            if ($new_date125 == $date15) {
                                                $t_income25 = $t_income25 + intval($in_data15["total"]);
                                            }
                                        }
                                        }
                                    } else {
                                        $date15 = date("$today_year-$d");
                                        $t_income25 = 0;

                                        $in_rs15 = Database::search("SELECT * FROM `invoice`");
                                        $in_num15 = $in_rs15->num_rows;
                                        for ($u15 = 0; $u15 < $in_num; $u15++) {
                                            $in_data15 = $in_rs15->fetch_assoc();
                                            if(isset($in_data15["date"])){
                                            $datein15 = $in_data15["date"];
                                            $new_date115 = strtotime("$datein15");
                                            $new_date125 = date("Y-m", $new_date115);


                                            if ($new_date125 == $date15) {
                                                $t_income25 = $t_income25 + intval($in_data15["total"]);
                                            }
                                        }
                                        }
                                        $in_rs15 = Database::search("SELECT * FROM `deleted_purchases`");
                                        $in_num15 = $in_rs15->num_rows;
                                        for ($u15 = 0; $u15 < $in_num; $u15++) {
                                            $in_data15 = $in_rs15->fetch_assoc();
                                            if(isset($in_data15["date"])){
                                            $datein15 = $in_data15["date"];
                                            $new_date115 = strtotime("$datein15");
                                            $new_date125 = date("Y-m", $new_date115);


                                            if ($new_date125 == $date15) {
                                                $t_income25 = $t_income25 + intval($in_data15["total"]);
                                            }
                                        }
                                    }

                                    }
                                    $array[$d] = $t_income25;
                                }

                                ?>
                                <script>
                                    var xyValues = [{

                                            x: 1,
                                            y: <?php echo ($array[1]); ?>
                                        },
                                        {
                                            x: 2,
                                            y: <?php echo ($array[2]); ?>

                                        },
                                        {
                                            x: 3,
                                            y: <?php echo ($array[3]); ?>
                                        },
                                        {
                                            x: 4,
                                            y: <?php echo ($array[4]); ?>
                                        },
                                        {
                                            x: 5,
                                            y: <?php echo ($array[5]); ?>
                                        },
                                        {
                                            x: 6,
                                            y: <?php echo ($array[6]); ?>
                                        },
                                        {
                                            x: 7,
                                            y: <?php echo ($array[7]); ?>
                                        },
                                        {
                                            x: 8,
                                            y: <?php echo ($array[8]); ?>
                                        },
                                        {
                                            x: 9,
                                            y: <?php echo ($array[9]); ?>
                                        },
                                        {
                                            x: 10,
                                            y: <?php echo ($array[10]); ?>
                                        },
                                        {
                                            x: 11,
                                            y: <?php echo ($array[11]); ?>
                                        },
                                        {
                                            x: 12,
                                            y: <?php echo ($array[12]); ?>
                                        }
                                    ];

                                    new Chart("myChart", {
                                        type: "scatter",
                                        data: {
                                            datasets: [{
                                                pointRadius: 4,
                                                pointBackgroundColor: "green",
                                                data: xyValues
                                            }]
                                        },
                                        options: {
                                            legend: {
                                                display: false,
                                            },
                                            scales: {
                                                xAxes: [{
                                                    text: "Months",
                                                    ticks: {
                                                        min: 0,
                                                        max: 12
                                                    }
                                                }],
                                                yAxes: [{
                                                    ticks: {
                                                        min: 0,
                                                        max: 20000
                                                    }
                                                }],
                                            },
                                            title: {
                                                display: true,
                                                text: "Sales of 2022"
                                            }

                                        }
                                    });
                                </script>





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


<?php
} else {
    echo ("Please Login First");
}
?>