<?php
/**
 * Created by PhpStorm.
 * User: shahzadmiraj
 * Date: 19/02/2019
 * Time: 7:02 PM
 *
 */
include_once "../../db_connection/connection.php";


global $con;
if(isset($_GET['submitdetail']))
{
    //$array = filter_input_array(INPUT_GET);
//    $newArray = array();
//    print_r($array);
}


?>
<!DOCTYPE html>
<head>
    <title>order detail</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js" type="text/javascript"></script>
</head>
<body>
<h1 align="center"> select disses </h1>
<br>
<span>dish_name:</span><select id="dish">
    <option id="select">select dish</option>
    <?php
    $dish_insert_qury="SELECT `name`, `id`, `meat_type_id`, `is_rice` FROM `dish` WHERE 1";
    $result=mysqli_query($con,$dish_insert_qury);
    while($row=mysqli_fetch_array($result))
    {
        $dish[]=$row;
        echo '<option value='.$row['id'].'>'.$row['name'].'</option>';
    }
    ?>
</select><br>
<span>quantity_no:</span>
<input type="number" id="quantity"><br>
<input value="+add_items"  type="button" id="submit" ><br>
<form name="add_name" id="form_add">
<table border="solid" style="width: 70%" id="all_orders">
    <tr>
        <th>NO#</th>
        <th>dish names</th>
        <th>delete</th>
    </tr>
</table>
<input id="submit1" type="button" name="submitdetail">

</form>


<script src="order_detail.js"></script>
</body>

</html>
