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
    <title>Sooper Vegan | Message Us</title>
</head>

<body class="body" style="overflow-x: hidden; background-color:#A8E890;">
    <div class="col-12 fixed-top bg-light">
        <?php
        session_start();
        $user = $_SESSION["u"];
        require "connection.php";
        require "header.php"; ?>
    </div>

    <div class="container-fluid pt-lg-5 pt-0" style="background-color:#A8E890;">
        <div class="col-12 pt-0 pt-lg-3">
            <div class="row">

                <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a class="text-success" href="home.php">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Message Us</li>
                    </ol>
                </nav>
                <div class="col-12 fs-1 text-dark text-center"><i class="bi bi-chat-left-dots-fill"></i>&nbsp;Message Us</div>
                <div class="col-8 offset-2 border border-2 border-success rounded p-3" style="background-color: #B6E388;">
                    <div class="row">
                        <div class="col-12" style="height:65vh; overflow-y:scroll;">
                            <?php
                            $msg_rs = Database::search("SELECT * FROM `chat` WHERE `sender_mobile` = '0712301748' AND `reciever_mobile` ='" . $user["mobile"] . "' OR `reciever_mobile` = '0712301748' AND `sender_mobile` = '" . $user["mobile"] . "' ORDER BY `date` ASC");
                            $msg_num = $msg_rs->num_rows;
                            for ($a = 0; $a < $msg_num; $a++) {
                                $msg_data = $msg_rs->fetch_assoc();
                                if ($msg_data["reciever_mobile"] == '0712301748' && $msg_data["sender_mobile"] == $user["mobile"]) {
                            ?>
                                    <div class="col-8 offset-4 bg-light rounded ps-3 p-1"><?php echo ($msg_data["message"]);  ?></div>
                                    <div class="col-8 offset-4 p-1 text-end"><?php echo ($msg_data["date"]);  ?></div>

                            <?php
                                }else{
                                    ?>
                                    <div class="col-8 bg-success rounded ps-3 p-1"><?php echo ($msg_data["message"]);  ?></div>
                                    <div class="col-8 p-1 text-end"><?php echo ($msg_data["date"]);  ?></div>

                            <?php
                          

                                }
                            }


                            ?>


                        </div>
                        <div class="col-12 pt-3">
                            <div class="row">
                                <div class="col-10">
                                    <input type="text" class="form-control" id="messg" placeholder="Type your Message Here..." onkeyup="contactUs2(event);" />
                                </div>
                                <div class="col-2 d-grid">
                                    <button class="btn btn-success" onclick="contactUs();"><i class="bi bi-send-fill"></i>&nbsp;Send</button>
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