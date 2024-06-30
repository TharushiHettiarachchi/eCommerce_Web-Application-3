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
    <title>Sooper Vegan | Admin | Chat </title>
</head>

<body class="body">
    <div class="container-fluid" style="background-color: rgb(181,230,29);">
        <div class="col-12">

            <div class="row">
                <div class="col-12 col-lg-3 vh-100 bg-success">
                    <div class="row" id="navchat">

                        <div class="col-6 fs-3 p-3"><i class="bi bi-arrow-left fs-2 fw-bold" onclick="window.location = 'adminPanel.php';"></i>&nbsp; Recent</div>
                        <div class="col-6 text-end pt-3">
                            <i class="bi bi-send-plus-fill fs-2" data-bs-toggle="modal" data-bs-target="#exampleModal"></i>
                        </div>


                        <!-- Modal -->
                        <div class="modal" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Start a New Chat</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="col-2 text-end">To :</div>
                                                    <div class="col-10">
                                                        <input type="text" placeholder="Mobile Number" id="to" class="form-control" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">Message</div>
                                            <div class="col-12">
                                                <textarea cols="15" rows="10" class="col-12" id="msg1"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary" onclick="send1();"> <i class="bi bi-send-fill text-white"></i>&nbsp;Send</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-9 p-3 pe-1">
                            <input type="text" class="form-control col-10" />
                        </div>
                        <div class="col-2 mt-3 rounded text-center" style="height: 40px;">
                            <button class="btn col-12"><i class="bi bi-search fs-4 mb-2"></i></button>
                        </div>
                        <?php
                        $chat_rs = Database::search("SELECT DISTINCT `mobile` FROM `chat` INNER JOIN `customer` ON customer.mobile = chat.sender_mobile OR customer.mobile = chat.reciever_mobile WHERE `sender_mobile` = '0712301748' OR `reciever_mobile` = '0712301748'");
                        $chat_num = $chat_rs->num_rows;
                        for ($v = 0; $v < $chat_num; $v++) {
                            $chat_data = $chat_rs->fetch_assoc();
                            if ($chat_data["mobile"] !== "0712301748") {

                                $customer_rs = Database::search("SELECT * FROM `customer` WHERE `mobile` = '" . $chat_data["mobile"] . "'");
                                $customer_data = $customer_rs->fetch_assoc();
                                $message_rs = Database::search("SELECT * FROM `chat` WHERE `sender_mobile` = '" . $chat_data["mobile"] . "' OR `reciever_mobile` = '" . $chat_data["mobile"] . "' ORDER BY `date` DESC LIMIT 1 ");
                                $message_data = $message_rs->fetch_assoc();

                                if ($message_data["status"] == 0) {
                        ?>
                                    <div class="col-12 border-bottom border-success" id="d<?php echo ($chat_data['mobile'])  ?>" onclick="select('<?php echo ($chat_data['mobile'])  ?>');" style="height: 75px; background-color:lightgreen;">
                                    <?php
                                } else if ($message_data["status"] == 1 && $message_data["reciever_mobile"] == "0712301748") {
                                    ?>
                                        <div class="col-12 border-bottom border-success" id="d<?php echo ($chat_data['mobile'])  ?>" onclick="select('<?php echo ($chat_data['mobile'])  ?>');" style="height: 75px; background-color:yellow;">
                                        <?php
                                    } else if ($message_data["status"] == 1 && $message_data["reciever_mobile"] !== "0712301748") {
                                        ?>
                                            <div class="col-12 border-bottom border-success" id="d<?php echo ($chat_data['mobile'])  ?>" onclick="select('<?php echo ($chat_data['mobile'])  ?>');" style="height: 75px; background-color:lightgreen;">
                                            <?php
                                        }
                                            ?>




                                            <div class="row">


                                                <div class="col-2">
                                                    <?php
                                                    if (!isset($customer_data["profile_pic"])) {
                                                    ?>
                                                        <img src="resource/q.png" style="height: 50px; margin-top:5px;" class="rounded-circle" />

                                                    <?php
                                                    } else {
                                                    ?>
                                                        <img src="<?php echo ($customer_data["profile_pic"]);  ?>" style="height: 50px; margin-top:5px;" class="rounded-circle" />
                                                    <?php
                                                    }

                                                    ?>

                                                </div>

                                                <div class="col-8 ps-5 pt-1">

                                                    <span class="fs-6"><?php echo ($customer_data["fname"] . " " . $customer_data["lname"]); ?></span><br />
                                                    <span class="fs-6 text-secondary"><?php echo ($message_data["message"]); ?></span>
                                                </div>
                                                <div class="col-2">
                                                    <?php
                                                    $date = $message_data["date"];
                                                    $splitDate = explode(" ", $date);
                                                    $new_date = $splitDate["0"];
                                                    $new_time = $splitDate["1"];
                                                    $splitTime = explode(":", $new_time);
                                                    $splitDay = explode("-", $new_date);
                                                    $day = $splitDay["2"];
                                                    $month = $splitDay["1"];
                                                    $hour = $splitTime["0"];
                                                    $minute = $splitTime["1"];
                                                    ?>

                                                    <span class="fw-bold" style="font-size:12px ;"><?php echo ($hour . " : " . $minute); ?></span></br>
                                                    <span><?php echo ($day . "/" . $month); ?></span>
                                                </div>
                                            </div>
                                            </div>



                                    <?php

                                }
                            }


                                    ?>









                                        </div>

                                    </div>
                                    <div class="col-9" id="whole">




                                    </div>
                    </div>




                </div>
            </div>

            <script src="script.js"></script>
            <script src="bootstrap.js"></script>
            <script src="bootstrap.bundle.js"></script>




</body>

</html>