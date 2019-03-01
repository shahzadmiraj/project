<?php
/**
 * Created by PhpStorm.
 * User: shahzadmiraj
 * Date: 17/02/2019
 * Time: 1:58 PM
 */
include_once "../db_connection/connection.php";

?>


<!DOCTYPE html>
<head>
    <title>
        customer_create
    </title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js" type="text/javascript"></script>

</head>
<body>
<h1 id="con" align="center">customer_register</h1>
<form >
    name:<input id="name" name="name" type="text"><br>
    cnic:<input id="cnic" name="cnic" type="text"><br>
    addresses_city:<input id="address_city" name="address_city" type="text"><br>
    addresses__town:<input id="address_town" name="address_town" type="text"><br>
    addresses_street_no:<input id="address_street_no" name="address_street_no" type="number"><br>
    addresses_house_no:<input id="address_house_no" name="address_house_no"type="number"><br>
    <input type="button" value="+address" onclick="create_new_address()"><br>
    personality_comment:<input id="personality_comments" name="personality_comments" type="text"><br>
    numbers:<input id="number" name="number" type="text"><br>
    <input type="button" value="+number" onclick="create_new_number()"><br>
    <input id="submit1" type="button" name="submit1" value="submit">
</form>
<script src="order_js/customer.js"></script>
</body>
</html>