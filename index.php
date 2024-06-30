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
                        <div class="carousel-item active"><img src="resource/10.PNG" class="d-block w-100" alt="..."> </div>
                        <div class="carousel-item"><img src="resource/1.PNG" class="d-block w-100"> </div>
                        <div class="carousel-item"><img src="resource/2.PNG" class="d-block w-100"></div>
                        <div class="carousel-item"><img src="resource/9.PNG" class="d-block w-100"></div>
                        <div class="carousel-item"><img src="resource/3.PNG" class="d-block w-100"></div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-6 mt-1 p-3 pb-5" id="signup">
                <div class="row p-3">
                    <div class="col-12">
                        <img class="col-2 offset-5" src="resource/icon.jpg" />
                    </div>
                    <div class="col-12 text-center pb-5">Welcome To Our E - Outlet</div>
                    <div class="col-12 text-center fw-bold fs-1 pb-4">Sign Up</div>
                    <div class="col-12 col-lg-6">
                        <label class="col-12 form-label border-success">First Name</label>
                        <input type="text" class="col-12 form-control" id="f1" />
                    </div>
                    <div class="col-12 col-lg-6">
                        <label class="col-12 form-label">Last Name</label>
                        <input type="text" class="col-12 form-control" id="l" />
                    </div>
                    <div class="col-12 col-lg-6 pt-3">
                        <label class="col-12 form-label">Mobile</label>
                        <input type="text" class="col-12 form-control" id="m" />
                    </div>
                    <div class="col-12 col-lg-6 pt-3">
                        <label class="col-12 form-label">Gender</label>
                        <select class="form-select col-12" id="g">
                            <?php

                            $gender_rs = Database::search("SELECT * FROM `gender`");
                            $gender_num = $gender_rs->num_rows;
                            echo ($gender_num);
                            for ($y = 0; $y < $gender_num; $y++) {
                                $gender_data = $gender_rs->fetch_assoc();
                            ?>
                                <option value="<?php echo ($gender_data["id"]);  ?>"><?php echo ($gender_data["name"]);  ?></option>

                            <?php
                            }

                            ?>


                        </select>
                    </div>
                    <div class="col-12 pt-3">
                        <label class="col-12 form-label">Email</label>
                        <input type="email" class="col-12 form-control" id="e" />
                    </div>
                    <div class="col-12 pt-3">
                        <label class="col-12 form-label">Password</label>
                        <input type="password" class="col-12 form-control" id="p" />
                    </div>
                    <div class="col-12 col-lg-6 d-grid pt-4">
                        <button class="btn btn-success" id="liveToastBtn" onclick="signUp();">Sign Up</button>
                    </div>
                    <div class="col-12 col-lg-6 d-grid pt-4">
                        <button class="btn btn-success" onclick="changePage();">Already have an Account? Sign In</button>
                    </div>
                </div>




                <div class="toast-container position-fixed top-0 end-0 p-3 ">
                    <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">

                        <div class="toast-body" id="msg" style="background-color: #D9F8C4;">

                        </div>
                    </div>
                </div>

            </div>
            <div class="col-12 col-lg-6 mt-3 p-3 pb-5 d-none" id="signin">
                <div class="row p-3">
                    <div class="col-12">
                        <img class="col-2 offset-5" src="resource/icon.jpg" />
                    </div>
                    <div class="col-12 text-center pb-5">Welcome To Our E - Outlet</div>
                    <div class="col-12 text-center fw-bold fs-1 pb-4">Sign In</div>

                    <div class="col-12 pt-3">
                    <?php
                            $email = "";
                            $password = "";

                            if (isset($_COOKIE["email"])) {
                                $email = $_COOKIE["email"];
                            }
                            if (isset($_COOKIE["password"])) {
                                $password = $_COOKIE["password"];
                            }



                            ?>
                           
                        <label class="col-12 form-label">Email</label>
                        <input type="email" class="col-12 form-control" id="e1" value="<?php echo($email); ?>" />
                    </div>
                    <div class="col-12 pt-3">
                        <label class="col-12 form-label">Password</label>
                        <input type="password" class="col-12 form-control" id="p1" value="<?php echo($password); ?>" />
                    </div>
                    <div class="col-12 p-2">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="c1" checked>
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Remember Me
                                    </label>
                                </div>
                            </div>
                            <div class="col-5 offset-1">
                                <a class="text-decoration-underline" style="cursor: pointer;" onclick="forgotPassword();">Forgot Password?</a>

                                </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 d-grid pt-4">
                        <button class="btn btn-success" id="liveToastBtn2" onclick="signIn();">Sign In</button>
                    </div>
                    <div class="col-12 col-lg-6 d-grid pt-4">
                        <button class="btn btn-success" onclick="changePage();">New to E - Outlet? Sign Up</button>
                    </div>
                </div>
                <div class="toast-container position-fixed top-0 end-0 p-3 ">
                    <div id="liveToast2" class="toast" role="alert" aria-live="assertive" aria-atomic="true">

                        <div class="toast-body" id="msg2" style="background-color: #D9F8C4;">

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