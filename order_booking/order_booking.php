<?php
/**
 * Created by PhpStorm.
 * User: shahzadmiraj
 * Date: 17/02/2019
 * Time: 5:13 PM
 */
include_once "../db_connection/connection.php";

if(isset($_GET['submit']))
{
    $customer_id=1;
    $address_id=random_int(0,1000);
    $order_address_id=random_int(0,1000);
    $hall_id=random_int(0,1000);
    $order_id=random_int(0,1000);
    $is_hall=$_GET['destination_type'];
    $hall_name=$_GET['hall_name'];
    $address_city=$_GET['address_city'];
    $address_town=$_GET['address_town'];
    $address_street_no=$_GET['address_street_no'];
     $address_house_no=$_GET['address_house_no'];
  $order_comments=$_GET['order_comments'];
  $total_people=$_GET['total_person'];
  $date=$_GET['date1'];
  $time=$_GET['time1'];
  $is_active=$_GET['is_active'];
    global $con;
    if($is_hall==2) {

//if hall is not exist

        $order_insert_query="INSERT INTO `order` (`customer_id`, `destination_date`, `id`, `total_amount`, `remaining_amount`, `order_comments`, `total_person`, `is_active`, `is_book_hall`, `time`) VALUES ('$customer_id', '$date', '$order_id', '0', '0', '$order_comments', '$total_people', '$is_active', '1', '$time')";
        $result = mysqli_query($con, $order_insert_query);
        if (!isset($result))
            echo "error in insertion of order_table";



        $address_table_insert_query = "INSERT INTO `address` (`id`, `address_city`, `address_town`, `address_street_no`, `address_house_no`, `person_id`) VALUES ('$address_id', '$address_city', '$address_town', '$address_house_no', '$address_street_no', NULL)";
        $result = mysqli_query($con, $address_table_insert_query);
        if ($result==NULL)
           echo "error in insertion of address_table";

        $hall_table_insert_query = "INSERT INTO `hall`(`name`, `id`, `address_id`) VALUES ('$hall_name','$hall_id','$address_id')";
        $result = mysqli_query($con, $hall_table_insert_query);
        if (!isset($result))
            echo "error in insertion of hall_table2";
        $order_insertion="INSERT INTO `order_address`(`id`, `order_id`, `is_hall`, `address_id`, `hall_id`) VALUES ('NULL','$order_id',1,'$address_id','$hall_id')";
        $result = mysqli_query($con, $order_insertion);
        if (!isset($result))
            echo "error in insertion of order_address_table2";



    }
    else
    {

        $order_insert_query="INSERT INTO `order` (`customer_id`, `destination_date`, `id`, `total_amount`, `remaining_amount`, `order_comments`, `total_person`, `is_active`, `is_book_hall`, `time`) VALUES ('$customer_id', '$date', '$order_id', '0', '0', '$order_comments', '$total_people', '$is_active', '0', '$time')";
        $result = mysqli_query($con, $order_insert_query);
        if (!isset($result))
            echo "error in insertion of order_table";


        $address_table_insert_query = "INSERT INTO `address`(`id`, `address_city`, `address_town`, `address_street_no`, `address_house_no`, `person_id`) VALUES ('$address_id','$address_city','$address_town','$address_street_no','$address_house_no',NULL)";
        $result = mysqli_query($con, $address_table_insert_query);
        if (!isset($result))
            echo "error in insertion of address_table";

        $order_insertion="INSERT INTO `order_address`(`id`, `order_id`, `is_hall`, `address_id`, `hall_id`) VALUES ('$order_address_id','$order_id',NULL,'$address_id',NULL)";
        $result = mysqli_query($con, $order_insertion);
        if (!isset($result))
            echo "error in insertion of order_table2";

    }


}
?>

<html>
<head>
    <title>order_booking</title>
</head>
<body>
<h1>
    order booking
</h1>

<form action="order_booking.php" method="get">
    destination type:<select name="destination_type">
        <option value="1">custom</option>
        <option value="2">hall</option>
    </select><br>
    customer_type:<select name="is_active">
        <option value="1">booking</option>
        <option value="2">visit</option>
    </select><br>
    hall_name:<input type="text" name="hall_name"><br>
    addresses_city:<input id="address_city" name="address_city" type="text"><br>
    addresses__town:<input id="address_town" name="address_town" type="text"><br>
    addresses_street_no:<input id="address_street_no" name="address_street_no" type="number"><br>
    addresses_house_no:<input id="address_house_no" name="address_house_no"type="number"><br>
    date:<input type="date" name="date1"><br>
    time:<input type="time"name="time1"><br>
    order_comments:<input type="text" name="order_comments"><br>
    total_person:<input type="number" name="total_person"><br>
    <input type="submit" name="submit">
</form>
<script src="order_js/order_booking.js">
</script>

</body>
</html>
