<?php
session_start();
require "connection.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Sooper Veagn E - Outlet</title>

    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="style.css" />

    <link rel="icon" href="resource/icon.jpg" />
</head>

<body class="" style="overflow-x: hidden;">
    <div class="container-fluid m-0 p-0">
        <div class="row">
            <div class="col-6 d-none d-lg-block">
                <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="resource/10.PNG" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="resource/1.PNG" class="d-block w-100">
                        </div>
                        <div class="carousel-item">
                            <img src="resource/2.PNG" class="d-block w-100">
                        </div>
                        <div class="carousel-item">
                            <img src="resource/9.PNG" class="d-block w-100">
                        </div>
                        <div class="carousel-item">
                            <img src="resource/3.PNG" class="d-block w-100">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-6 mt-1 p-3 pb-5" id="signup">
                <div class="row p-3">
                    <div class="col-12">
                        <img class="col-2 offset-5" src="resource/icon.jpg" />
                    </div>
                    <div class="col-12 text-center pb-5">Welcome To Our E - Outlet</div>
                    <div class="col-12 text-center fw-bold fs-1 pb-4">Admin Sign In</div>
                    <div class="col-12 d-none" id="p">
                        <div class="row">
                            <div class="col-12">Enter the verification Code</div>
                            <div class="col-12">
                                <div class="row text-center p-3">
                                    <?php
                                    $d = 1;
                                    ?>
                                    <div class="col-1 offset-2">
                                        <input type="text" class="form-control border border-1 border-success" maxlength="1" onkeyup="focusNext('<?php echo ($d); ?>');" id="max<?php echo ($d); ?>" />
                                    </div>
                                    <?php

                                    for ($d = 2; $d < 9; $d++) {
                                    ?>
                                        <div class="col-1">
                                            <input type="text" class="form-control border border-1 border-success" maxlength="1" onkeyup="focusNext('<?php echo ($d); ?>');" id="max<?php echo ($d); ?>" />
                                        </div>
                                    <?php
                                    }


                                    ?>
                                    <div class="col-1">
                                        <input type="text" class="form-control d-none" maxlength="1" id="max9" />
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12" id="e">
                        <p>Enter Your Email</p>
                        <input type="email" class="form-control" id="email" />
                    </div>
                    <div class="col-12 d-grid pt-4">
                        <button class="btn btn-success" id="but" onclick="adminVerify();">Click to send the verification Code</button>
                    </div>

                </div>




                <div class="toast-container position-fixed top-0 end-0 p-3 ">
                    <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">

                        <div class="toast-body" id="msg" style="background-color: #D9F8C4;">

                        </div>
                    </div>
                </div>

            </div>






        </div>
    </div>

    <script src="script.js"></script>
    <script src="bootstrap.js"></script>
    <!-- <script src="bootstrap.bundle.js"></script> -->
</body>

</html>