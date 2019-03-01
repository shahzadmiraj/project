<?php
/**
 * Created by PhpStorm.
 * User: shahzadmiraj
 * Date: 25/02/2019
 * Time: 1:27 AM
 */
include_once "../../db_connection/connection.php";
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
        $result = mysqli_query($con, $order_detail_get);
        $array=array();
        while ($row=mysqli_fetch_assoc($result))
        {
            $array[]=$row;
        }
        $json = json_encode($array);
        echo $json;
    }
    else if($insert==2)
    {
        if(isset($_GET["form_page"]))
        {
            $page_no=$_GET["form_page"];
            $id=$_GET['id'];
            $quantity=$_GET['quantity'];
            $textarea=$_GET['textarea'];
            if($page_no==1)
            {
                //others
            }
            else if($page_no==2)
            {
                $meat_quantity=$_GET["meat_quantity"];
                $rice_quantity=$_GET["rice_quantity"];
                $is_meat=$_GET["is_meat"];
                if($is_meat==1)
                {

                }
                else
                {

                }
                $is_rice=$_GET['is_rice'];
                if($is_rice==1)
                {

                }
                else
                {

                }

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
           echo "</select><input type='button' value='*' class='remove_add_extra' id='remove_add_extra_$sum_of_all'><br ></div>";
    }

}



?>