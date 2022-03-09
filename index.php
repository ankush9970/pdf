<?php
include "connect.php";

$sql = "select * from check_test";
$result = $con->query($sql);
// if($result->num_rows > 0){
//     $r = $result->fetch_assoc();

//     echo "<pre>";
// print_r($r);
// }
$flag = 0;
if (isset($_POST['sub'])) {
    // $flag = 0;
    $city = $_POST['city'];
    $pin = $_POST['pin'];

    if (!empty($_POST['city']) && !empty($_POST['pin'])) {
        // echo "both filled";
        $flag = 1;
        $sql_sort = "SELECT * FROM `check_test` WHERE `city` = '".$city."' AND `pincode` = '".$pin."' ";
    } else if (!empty($_POST['city']) || !empty($_POST['pin'])) {
        // echo "one filled";
        $flag = 1;
        $sql_sort = "SELECT * FROM `check_test` WHERE `city` = '".$city."' OR `pincode` = '".$pin."' ";
    } else {
        $flag = 0;
        echo "Fill atleast one field";
    }
    if ($flag == 1) {
        $result_sort = $con->query($sql_sort);
        echo "ok";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test</title>
</head>

<body>

    <form action="?" method="POST">

        <select name="city" id="city">
            <option value="">Select city</option>
            <option value="Jaipur">Jaipur</option>
            <option value="Alwar">Alwar</option>
            <option value="Kota">Kota</option>
        </select>

        <input type="text" name="pin" placeholder="Enter Pincode">
        <br>
        <input type="submit" value="Search" name="sub">
    </form>
    <br>
    <br>

    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>City</th>
                <th>Pincode</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($flag == 1) {
                while ($r_sort = $result_sort->fetch_assoc()) {
            ?>
                    <tr>
                        <td><?php echo $r_sort['name']; ?></td>
                        <td><?php echo $r_sort['city']; ?></td>
                        <td><?php echo $r_sort['pincode']; ?></td>
                    </tr>

                <?php
                }
                ?>
            <?php
            } else {
            ?>
                <?php
                while ($r = $result->fetch_assoc()) {

                ?>
                    <tr>
                        <td><?php echo $r['name']; ?></td>
                        <td><?php echo $r['city']; ?></td>
                        <td><?php echo $r['pincode']; ?></td>
                    </tr>

            <?php
                }
            }
            ?>
        </tbody>
    </table>
</body>

</html>