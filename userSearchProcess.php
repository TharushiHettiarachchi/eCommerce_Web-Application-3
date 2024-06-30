<?php
require "connection.php";
session_start();
$user = $_GET["user"];

$user_rs = Database::search("SELECT * FROM `customer` WHERE `fname` LIKE '%" . $user . "%' OR `lname` LIKE '%" . $user . "%' OR `mobile` LIKE '%" . $user . "%' OR `email` LIKE '%" . $user . "%' ");
$user_num = $user_rs->num_rows;
$id = 0;
for ($x = 0; $x < $user_num; $x++) {
    $user_data = $user_rs->fetch_assoc();
    $id = $id + 1;
    if ($user_data["mobile"] !== "0712301748") {
?>
        <tr>
            <th scope="row"><?php echo ($id); ?></th>
            <?php
            if (!isset($user_data["profile_pic"])) {
            ?>
                <td class="d-none d-lg-block pb-2"> <img src="resource/q.png" style="height:50px ;" /></td>
            <?php
            } else {
            ?>
                <td class="d-none d-lg-block pb-2"> <img src="<?php echo ($user_data["profile_pic"]); ?>" style="height:50px ;" /></td>
            <?php
            }

            ?>

            <td><?php echo ($user_data["fname"] . " " . $user_data["lname"]); ?></td>
            <th><?php echo ($user_data["mobile"]); ?></th>
            <td class="d-none d-lg-block pb-lg-4"><?php echo ($user_data["email"]); ?></td>
            <td><?php echo ($user_data["joined_date"]); ?></td>
        </tr>

<?php
    }
}
?>




































