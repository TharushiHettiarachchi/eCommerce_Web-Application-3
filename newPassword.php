<?php
require "connection.php";
$email = $_GET["e"];
echo($email);
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

    <div class="container-fluid mt-5" style="background-color: rgb(181,230,29);">
        <div class="row mt-5">
            <div class="col-8 offset-2 bg-white rounded mt-5 p-3">
                <div class="row">
                    <div class="col-12 fs-2 fw-bold text-center">Change Password</div>
                    <div class="col-12 p-5">
                        <span class="form-label">Email</span>
                        <input type="email" class="form-control" value="<?php echo($email); ?>" />
                    </div>
                    <div class="col-6 px-5">
                        <span class="form-label">New Password</span>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" aria-label="Recipient's username" aria-describedby="button-addon2">
                            <button class="btn btn-outline-secondary" type="button" id="button-addon2"><i class="bi bi-eye-fill"></i></button>
                        </div>
                    </div>
                    <div class="col-6 px-5">
                        <span class="form-label">Re-type Password</span>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" aria-label="Recipient's username" aria-describedby="button-addon2">
                            <button class="btn btn-outline-secondary" type="button" id="button-addon2"><i class="bi bi-eye-fill"></i></button>
                        </div>
                    </div>
                    <div class="col-6 d-grid mt-5">
                        <button class="btn btn-success">Save Password</button>
                    </div>
                    <div class="col-6 d-grid mt-5">
                        <button class="btn btn-danger">Cancel</button>
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