<?php
require "connection.php";
session_start();

$msg = $_POST["text"];
$customer = $_POST["id"];
$customer1 = "0".$customer;

$d = new DateTime();
$tz = new DateTimeZone("Asia/Colombo");
$d->setTimezone($tz);
$date = $d->format("Y-m-d H:i:s");

Database::iud("INSERT INTO `chat` (`sender_mobile`,`reciever_mobile`,`message`,`status`,`date`) VALUES ('0712301748','".$customer1."','".$msg."','0','".$date."')");
$user_rs = Database::search("SELECT * FROM `customer` WHERE `mobile` = '" . $customer1 . "'");
$user_data = $user_rs->fetch_assoc();

?>

    <div class="col-12 bg-success border-start border-3 border-dark" style="height:75px ;">
        <div class="row">
            <div class="col-1 pt-2">
                <img src="resource/prof1.jpg" style="height: 50px;" class="rounded-circle" />
            </div>

            <div class="col-10 pt-2">
                <span class="fs-6"><?php echo ($user_data["fname"] . " " . $user_data["lname"]); ?></span><br />
                <span style="font-size:12px ;">Online</span>
            </div>
            <div class="col-12 mt-4" style="height:550px ; overflow-y:scroll;">
                <div class="row p-3">
                    <?php
                    $msg_rs = Database::search("SELECT * FROM `chat` WHERE `reciever_mobile` = '0712301748' AND `sender_mobile` = '" . $customer1 . "' OR `reciever_mobile` = '" . $customer1 . "' AND `sender_mobile` = '0712301748'  ORDER BY `date` ASC");
                    $msg_num = $msg_rs->num_rows;
                    for ($g = 0; $g < $msg_num; $g++) {
                        $msg_data = $msg_rs->fetch_assoc();
                        if ($msg_data["reciever_mobile"] == "0712301748" & $msg_data["sender_mobile"] == $customer1) {
                    ?>
                            <div class="col-8">
                                <div class="row">
                                    <div class="col-12 bg-white p-1 ps-3 rounded">
                                        <span class="text-start"><?php echo($msg_data["message"]); ?></span>
                                    </div>
                                    <div class="col-12 text-end text-black-50"><?php echo($msg_data["date"]); ?></div>
                                </div>

                            </div>
                        <?php
                        } else if ($msg_data["sender_mobile"] == "0712301748" & $msg_data["reciever_mobile"] == $customer1) {
                        ?>
                            <div class="col-8 offset-4">
                                <div class="row">
                                    <div class="col-12 p-1 ps-3 rounded text-end" style="background-color: lightgreen;">
                                        <span class="text-end"><?php echo($msg_data["message"]); ?></span>
                                    </div>
                                    <div class="col-12 text-end text-black-50"><?php echo($msg_data["date"]); ?></div>
                                </div>

                            </div>




                    <?php
                        }
                    }
                    ?>

                </div>
            </div>
            <div class="col-12 p-3">
                <div class="row">
                    <div class="col-11 p-1">
                        <input type="text" class="form-control" id="text" />
                    </div>
                    <div class="col-1"><i class="bi bi-send fs-2" onclick="send(<?php echo ($customer1); ?>);"></i></div>
                </div>
            </div>
        </div>
    </div>



<?php
























?>