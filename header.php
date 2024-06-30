<?php


$user = $_SESSION["u"];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
</head>

<body>
    <div class="col-12 border-bottom border-2 border-dark bg-light">
        <div class="row p-2 p-lg-0">
            <div class=" col-2 col-lg-1 text-end">
                <img src="resource/icon.jpg" style="height: 50px;" />
            </div>
            <div class="col-3 col-lg-1 dropdown">
                <div class="col-12 text-center p-3 p-lg-0 dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-list fs-2"></i> </div>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="watchlist.php"><i class="bi bi-heart-fill"></i>&nbsp;Watchlist</a></li>
                    <li><a class="dropdown-item" href="purchasedHistory.php"><i class="bi bi-bag-fill"></i>&nbsp;Purchased History</a></li>
                    <li><a class="dropdown-item" href="messageUs.php"><i class="bi bi-chat-left-dots-fill"></i>&nbsp;Message Us</a></li>

                </ul>
            </div>




            <div class="col-6 col-lg-2 text-lg-start text-end mt-3">
                <p>Hello <?php echo ($user["fname"]); ?> !</p>
            </div>
            <div id="b3" class="col-4  col-lg-1 mt-2 offset-lg-5">
                <button class="btn btn-outline-success border-0" id="b1" onclick="changeButton();" style="border-radius: 20px;">Sign Out</button>
                <button class="btn btn-outline-success d-none border-0" onclick="window.location = 'index.php'" id="b2" style="border-radius: 20px;">Sign In | Register</button>
            </div>
            <div class="col-1 offset-5 offset-sm-3 offset-md-3 offset-lg-0"><i class="bi bi-person-fill fs-2" onclick="window.location='profile.php';"></i></div>
            <div class="col-1" onclick="window.location='cart.php'"><i class="bi bi-cart-fill fs-2"></i></div>
            

        </div>

    </div>




    <script src="bootstrap.js"></script>
    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>