<?php
/**
 * Created by PhpStorm.
 * User: shahzadmiraj
 * Date: 20/02/2019
 * Time: 7:59 PM
 */

include_once "../../db_connection/connection.php";
if(isset($_GET['dish']))
{


    $number = count($_GET["dish"]);
    if ($number > 0) {
        echo $number;
        $is_quantity_use;
        $rice_meat_other_detail;
        $datetime = date('Y-m-d H:i:s');
        $dishes_id = array();
        $dishes_id = $_GET['dish'];
        foreach ($dishes_id as $key => $dish_id)
        {
            $rice_meat_other_detail_id=random_int(0,100000);
            $dish_price_id;
            $dish_price;
            $meat_type_id;
            $is_rice;
            $get_dish_price_which_is_active_now_qury = "SELECT d.is_quantity_use,d.is_rice,d.meat_type_id,dp.id,dp.price FROM dish d INNER join dish_price dp
on(d.id=dp.dish_id)
WHERE
	(d.id='$dish_id') &&(dp.expire_date is NULL) LIMIT 1";
            $result = mysqli_query($con, $get_dish_price_which_is_active_now_qury);

            while ($row = mysqli_fetch_array($result)) {
                $dish_price_id = $row['id'];
                $dish_price=$row['price'];
                $meat_type_id=$row['meat_type_id'];
                $is_rice=$row['is_rice'];
                $is_quantity_use=$row['is_quantity_use'];
            }
            if($is_quantity_use!=NULL)
            {
                //its mean it is drinks or naan

                $insert_dish_detail="INSERT INTO `dish_detail`(`id`, `total_each_price`, `dish_price_id`, `rice_meat_others_detail_id`) VALUES ('NULL','$dish_price','$dish_price_id',NULL)";//depend on other
                $result=mysqli_query($con,$insert_dish_detail);
            }
            else if($meat_type_id=="" && $is_rice==0)
            {
                //not both use
                //it contains sadha kaleem
                    echo "not both";
                $rice_meat_other_detail="INSERT INTO `rice_meat_others_detail`(`id`, `other_quantity`, `rice_quantity_id`, `meat_quantity_id`, `is_rice`, `is_meat`) VALUES ('$rice_meat_other_detail_id',0,NULL,NULL,NULL,NULL)";
                    $result=mysqli_query($con,$rice_meat_other_detail);
                    if(!$result)
                    {
                        echo "error in both";
                    }
                $insert_dish_detail="INSERT INTO `dish_detail`(`id`, `total_each_price`, `dish_price_id`, `rice_meat_others_detail_id`) VALUES ('NULL','$dish_price','$dish_price_id','$rice_meat_other_detail_id')";//depend on other
                $result=mysqli_query($con,$insert_dish_detail);
            }
            else if($meat_type_id !="" && $is_rice==1)
            {
                //both use
                echo "both is";

                $rice_meat_other_detail="INSERT INTO `rice_meat_others_detail`(`id`, `other_quantity`, `rice_quantity_id`, `meat_quantity_id`, `is_rice`, `is_meat`) VALUES ('$rice_meat_other_detail_id',NULL,NULL,NULL,1,1)";
                $result=mysqli_query($con,$rice_meat_other_detail);
                if(!$result)
                {
                    echo "error in both";
                }
                $insert_dish_detail="INSERT INTO `dish_detail`(`id`, `total_each_price`, `dish_price_id`, `rice_meat_others_detail_id`) VALUES ('NULL','$dish_price','$dish_price_id','$rice_meat_other_detail_id')";//depend on other
                $result=mysqli_query($con,$insert_dish_detail);

            }
            else if($meat_type_id !="" && $is_rice==0)
            {
                //only meat use
                echo "only meat use";
                $rice_meat_other_detail="INSERT INTO `rice_meat_others_detail`(`id`, `other_quantity`, `rice_quantity_id`, `meat_quantity_id`, `is_rice`, `is_meat`) VALUES ('$rice_meat_other_detail_id',NULL,NULL,NULL,NULL,1)";
                $result=mysqli_query($con,$rice_meat_other_detail);
                if(!$result)
                {
                    echo "error in meat";
                }
                $insert_dish_detail="INSERT INTO `dish_detail`(`id`, `total_each_price`, `dish_price_id`, `rice_meat_others_detail_id`) VALUES ('NULL','$dish_price','$dish_price_id','$rice_meat_other_detail_id')";//depend on other
                $result=mysqli_query($con,$insert_dish_detail);

            }
            else
            {

                //only rice use
                echo "only rice use";

                $rice_meat_other_detail="INSERT INTO `rice_meat_others_detail`(`id`, `other_quantity`, `rice_quantity_id`, `meat_quantity_id`, `is_rice`, `is_meat`) VALUES ('$rice_meat_other_detail_id',NULL,NULL,NULL,1,NULL)";
                $result=mysqli_query($con,$rice_meat_other_detail);
                if(!$result)
                {
                    echo "error in rice";
                }

                $insert_dish_detail="INSERT INTO `dish_detail`(`id`, `total_each_price`, `dish_price_id`, `rice_meat_others_detail_id`) VALUES ('NULL','$dish_price','$dish_price_id','$rice_meat_other_detail_id')";//depend on other
                $result=mysqli_query($con,$insert_dish_detail);
            }

        }
    }

    mysqli_close($con);



}

?>