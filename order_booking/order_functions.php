<?php
/**
 * Created by PhpStorm.
 * User: shahzadmiraj
 * Date: 17/02/2019
 * Time: 5:20 PM
 */
include_once "../db_connection/connection.php";

if(isset($_GET['insert']))
{
    $id=random_int(0,1000);
    $name=$_GET['name'];
    $cnic=$_GET['cnic'];
    $address_city=$_GET['address_city'];
    $address_town=$_GET['address_town'];
    $address_street_no=$_GET['address_street_no'];
    $address_house_no=$_GET['address_house_no'];
    $personality_comments=$_GET['personality_comments'];
    $number=$_GET['number'];
    global $con;
    $person_table_insert_query="INSERT INTO `person`(`name`, `cnic`, `id`) VALUES ('$name','$cnic','$id')";
    $result=mysqli_query($con,$person_table_insert_query);
    if(!isset($result))
    {
        echo" error in person_insertion ";
    }
    $number_table_insert_query="INSERT INTO `number`(`number`, `id`, `is_number_active`, `person_id`) VALUES ('$number','NULL','1','$id')";
    $result=mysqli_query($con,$number_table_insert_query);
    if(!isset($result))
    {
        echo" error in person_number_insertion ";
    }
    $address_table_insert_query="INSERT INTO `address`(`id`, `address_city`, `address_town`, `address_street_no`, `address_house_no`, `person_id`) VALUES ('NULL','$address_city','$address_town','$address_street_no','$address_house_no','$id')";
    $result=mysqli_query($con,$address_table_insert_query);
    if(!isset($result))
    {
        echo" error in person_address_insertion ";
    }

    header("location:order_booking.php?person_id='$id'");
    echo "open";
}
else
    echo "not open";


?>