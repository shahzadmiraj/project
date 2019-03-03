<?php
/**
 * Created by PhpStorm.
 * User: shahzadmiraj
 * Date: 25/02/2019
 * Time: 1:27 AM
 */
include_once "../../db_connection/connection.php";


function only_excute_mysql($get_quary)
{
    global $con;
    $result=mysqli_query($con,$get_quary);
    return mysqli_fetch_assoc($result);
}
function execute_and_return_mysql_result($get_quary)
{

    global $con;
    $result=mysqli_query($con,$get_quary);
    $array=array();
    while ($row=mysqli_fetch_assoc($result))
    {
        $array[]=$row;
    }
    return $array;

}
if(isset($_GET['insert']))
{
    $insert=$_GET['insert'];
    if($insert==1)
    {
        $order_detail_get = "SELECT d.id as dish_id,od.id,d.is_rice,d.meat_type_id,d.is_quantity_use FROM order_detail as od INNER join dish_detail dd
on(od.dish_detail_id=dd.id)
INNER join dish_price as dp
on (dd.dish_price_id=dp.id)
INNER join dish as d
on (dp.dish_id=d.id)
WHERE (od.is_active is NULL)
&&(od.order_id=1)";//change must
        $array=execute_and_return_mysql_result($order_detail_get);
        $json = json_encode($array);
        echo $json;
    }
    else if($insert==2)
    {

        if(isset($_GET["form_page"]))
        {
            $total_price=0;
            $dish_price=0;
            $dish_id=0;
            $page_no=$_GET["form_page"];
            $order_detail_id=$_GET['id'];        //which product
            $dish_detail_id_quary="SELECT dd.id FROM order_detail od INNER JOIN dish_detail dd
ON (od.dish_detail_id=dd.id) where  od.id=$order_detail_id";
            $result= execute_and_return_mysql_result($dish_detail_id_quary);
            $dish_detail_id=$result[0]['id'];
            $dish_price_and_dish_quary="SELECT dp.price,d.id FROM dish_detail as dd INNER join dish_price dp
on(dd.dish_price_id=dp.id)
INNER join dish as d
on(dp.dish_id=d.id)
WHERE
(dp.expire_date is null)&&
(dd.id=$dish_detail_id)
";
            $result=only_excute_mysql($dish_price_and_dish_quary);
            $dish_price=$result['price'];
            $dish_id=$result['id'];
            $quantity=$_GET['quantity']; //how much
            $textarea=$_GET['textarea']; //detail of product
            if($page_no==1)
            {
                //others
            }
            else if($page_no==2) {
                //both rice and meat
                $meat_price = 0;
                $rice_price = 0;
                $meat_quantity = $_GET["meat_quantity"];
                $rice_quantity = $_GET["rice_quantity"];
                $is_meat = $_GET["is_meat"];
                $rice_meat_other_detail_quary = "SELECT dd.rice_meat_others_detail_id as id  FROM dish_detail as dd
WHERE id=$dish_detail_id";
                $result=only_excute_mysql($rice_meat_other_detail_quary);
                $rice_meat_other_detail_id = $result['id']; // update use quary
                if ($is_meat == 1) {
                    //no meat
                    $meat_quantity_quary= "INSERT INTO `meat_quantity`(`id`, `quantity`, `meat_price_id`) VALUES (NULL,$qeat_quantity,NULL)";
                    $result = mysqli_query($con, $meat_quantity_quary);
                    $last_id = mysqli_insert_id($con);
                    $update_rice_meat_quary = "UPDATE rice_meat_others_detail as rmod SET rmod.meat_quantity_id=$last_id where rmod.id=$rice_meat_other_detail_id";
                    $result = mysqli_query($con, $update_rice_meat_quary);
                } else {
                    //yes meat
                    $get_meat_price = "SELECT mp.price,mp.id FROM dish_detail as dd INNER join dish_price as dp
on(dd.dish_price_id=dp.id)
inner join dish d
on(dp.dish_id=d.id)
INNER join meat_type mt
on(d.meat_type_id=mt.id)
inner join meat_price mp
on(mt.id=mp.id)
where mp.expire_date is null
&&(dd.id=$dish_detail_id)";
                    $result1    = mysqli_query($con, $get_meat_price);
                    $result =  mysqli_fetch_array($result1);
                    $meat_price = $result['price'];
                    $meat_price_id = $result['id'];
                    $meat_quantity_quary = "INSERT INTO `meat_quantity`(`id`, `quantity`, `meat_price_id`) VALUES (NULL,$meat_quantity,$meat_price_id)";
                    $result = mysqli_query($con, $meat_quantity_quary);
                    $last_id = mysqli_insert_id($con);
                    $update_rice_meat_quary = "UPDATE rice_meat_others_detail as rmod SET rmod.meat_quantity_id=$last_id where rmod.id=$rice_meat_other_detail_id";
                    $result = mysqli_query($con, $update_rice_meat_quary);

                }
                $is_rice = $_GET['is_rice'];
                if ($is_rice == 1) {
                    $rice_quantity_quary = "INSERT INTO `rice_quantity`(`id`, `quantity`, `rice_price_id`) VALUES (NULL,$rice_quantity,NULL)";
                    $result = mysqli_query($con, $meat_quantity_quary);
                    $last_id = mysqli_insert_id($con);
                    $update_rice_meat_quary = "UPDATE rice_meat_others_detail as rmod SET rmod.rice_quantity_id=$last_id where rmod.id=$rice_meat_other_detail_id";

                } else {

                    //yes use of rice which pay by own
                    $rice_type_id = $_GET['rice_type'];
                    $rice_price_quary = "SELECT rp.price,rp.id from rice_price as rp
WHERE rp.expire_date is null
&&(rp.rice_type_id=$rice_type_id)";
                    $result = mysqli_query($con, $rice_price_quary);
                    $result3 = mysqli_fetch_array($result);
                    $rice_price_id = $result3['id'];
                    $rice_price = $result3['price'];
                    $rice_quantity_quary = "INSERT INTO `rice_quantity`(`id`, `quantity`, `rice_price_id`) VALUES (NULL,$rice_quantity,$rice_price_id)";
                    $result = mysqli_query($con, $rice_quantity_quary);
                    $last_id = mysqli_insert_id($con);
                    $update_rice_meat_quary = "UPDATE rice_meat_others_detail as rmod SET rmod.rice_quantity_id=$last_id where rmod.id=$rice_meat_other_detail_id";
                    $result = mysqli_query($con, $update_rice_meat_quary);
                }
                if (isset($_GET['extra_item'])) {
                    $extra_item = $_GET['extra_item'];
                    $extra_quantity=$_GET['extra_quantity'];
                    $item_price_id=0;
                    $item_price=0;
                    for($i=0;$i<count($extra_item);$i++)
                    {
                        $item_price_quary="SELECT ip.price,ip.id from item_price as ip
WHERE ip.item_id=$extra_item[$i]
&&(ip.expire_date is NULL)";
                        $result5=only_excute_mysql($item_price_quary);
                        $item_price_id=$result5['id'];
                        $item_price=$result5['price'];
                        $total_price=$total_price+$item_price;
                        $dish_detail_dish_item_detail_quary="INSERT INTO `dish_detail_dish_item_detail`(`id`, `dish_detail_id`, `item_price_id`, `quantity`) VALUES (NULL,$dish_detail_id,$item_price_id,$extra_quantity[$i])";
                        $result=only_excute_mysql($dish_detail_dish_item_detail_quary);
                    }
                }
                $total_price=$total_price+($rice_price*$rice_quantity)+($meat_price*$meat_quantity);
                $update_dish_detail="UPDATE dish_detail as dd set dd.total_each_price=$total_price
where dd.id=$dish_detail_id";
                $result=only_excute_mysql($update_dish_detail);
                $multiply=(int)$total_price*(int)$quantity;

                $order_detail_update="UPDATE order_detail as od set od.each_price=$total_price,od.quantity=$quantity,od.total_amout=$multiply,od.description=$textarea,od.discount_price=0 where od.id=$order_detail_id";
                $result=only_excute_mysql($order_detail_update);
            }
            }
    }
    else if($insert==3)
    {
        $get_rice_types="SELECT * FROM `rice_type` WHERE 1";
        $result=mysqli_query($con,$get_rice_types);
        echo "<select name='rice_type'>";
        while ($row=mysqli_fetch_array($result))
        {
            echo "<option value=".$row['id'].">".$row['name']."</option>";
        }
        echo "</select>";

    }
    else if($insert==4)
    {
        $dishid=$_GET['dishid'];
        $sum_of_all=$_GET['sum_of_all'];
            $get_extra_detail="SELECT i.name,i.id from dish_item_detail as did INNER join item as i on(did.item_id=i.id) WHERE (did.dish_id=".$dishid.")";
            $result=mysqli_query($con,$get_extra_detail);
           echo "<div id='add_remove_add_extra_$sum_of_all'><select name='extra_item[]'>";
           while ($row=mysqli_fetch_array($result))
           {
               echo "<option value=".$row['id'].">".$row['name']."</option>";
           }
           echo "</select><input type='text' name='extra_quantity[]'><input type='button' value='*' class='remove_add_extra' id='remove_add_extra_$sum_of_all'><br ></div>";
    }

}



?>