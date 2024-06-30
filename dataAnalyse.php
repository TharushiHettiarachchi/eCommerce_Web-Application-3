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
            <div class="row p-3">
                <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item text-success"><a href="adminPanel.php" class="text-success fw-bold">Admin Panel</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Sales Analysis</li>
                    </ol>
                </nav>

                <div class="col-12 fs-1"><i class="bi bi-bar-chart-fill"></i>&nbsp;Sales Analysis</div>
                <div class="col-12 p-3">
                    <div class="row">
                        <div class="col-3 d-grid">
                            <button class="btn btn-success">2022</button>
                        </div>
                        <div class="col-3 d-grid">
                            <button class="btn btn-success">2023</button>
                        </div>
                    </div>
                </div>
                <div class="col-12 p-5">
                    <div class="row">
                    <div class="col-6">
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>

                    <canvas id="myChart" style="width:100%;max-width:50%px"></canvas>

                    <script>
                        var xValues = ["Beverage", "Deserts", "Spreads", "Soups", "Curries", "Dry Products", "Frozen Products"];
                        var yValues = [55, 49, 44, 24, 15, 23, 12];
                        var barColors = [
                            "#b91d47",
                            "#00aba9",
                            "#2b5797",
                            "#e8c3b9",
                            "#1e7145",
                            "yellow",
                            "orange"
                        ];

                        new Chart("myChart", {
                            type: "pie",
                            data: {
                                labels: xValues,
                                datasets: [{
                                    backgroundColor: barColors,
                                    data: yValues
                                }]
                            },
                            options: {
                                title: {
                                    display: true,
                                    text: "Sales of Product Type 2022"
                                }
                            }
                        });
                    </script>


                </div>

                <div class="col-6">


                    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>

                    <canvas id="myChart1" class="bg-transparent text-success" style="max-width:100% ;"></canvas>
                    <?php
                    $today_year = date("Y");
                    $array;
                    for ($d = 1; $d < 13; $d++) {
                        if ($d < 10) {
                            $date15 = date("$today_year-0$d");
                            $t_income25 = 0;

                            $in_rs15 = Database::search("SELECT * FROM `invoice`");
                            $in_num15 = $in_rs15->num_rows;
                            for ($u15 = 0; $u15 < $in_num15; $u15++) {
                                $in_data15 = $in_rs15->fetch_assoc();
                                $datein15 = $in_data15["date"];
                                $new_date115 = strtotime("$datein15");
                                $new_date125 = date("Y-m", $new_date115);


                                if ($new_date125 == $date15) {
                                    $t_income25 = $t_income25 + intval($in_data15["total"]);
                                }
                            }
                        } else {
                            $date15 = date("$today_year-$d");
                            $t_income25 = 0;

                            $in_rs15 = Database::search("SELECT * FROM `deleted_purchases`");
                            $in_num15 = $in_rs15->num_rows;
                            for ($u15 = 0; $u15 < $in_num15; $u15++) {
                                $in_data15 = $in_rs15->fetch_assoc();
                                $datein15 = $in_data15["date"];
                                $new_date115 = strtotime("$datein15");
                                $new_date125 = date("Y-m", $new_date115);


                                if ($new_date125 == $date15) {
                                    $t_income25 = $t_income25 + intval($in_data15["total"]);
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

                        new Chart("myChart1", {
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