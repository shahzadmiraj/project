var all_orders_get=[{
    id:1,
    is_rice:1,
    meat_type_id:1,
    is_quantity_use:1,
    dish_id:1
}];
var sum_of_all=0;
function meat_and_rice_page(id,page_no) {
    $("#123").append("<form class=\"from_group\"  id=\"from_group_"+id+"\" style=\"border: solid\">\n" +
        "<input name=\"form_page\" value=\""+page_no+"\" hidden>\n"+
        "<input name=\"id\" value=\""+id+"\" hidden>\n"+
        "        <p> rice+meat_both</p>\n" +
        "    product quantity:<input name=\"quantity\"><br>\n" +
        "        quantity of meat kg:<input name=\"meat_quantity\"><br>\n" +
        "        quantity of rice kg:<input name=\"rice_quantity\"><br>\n" +
        "        is_customer provide meat:<select name=\"is_meat\">\n" +
        "        <option value=\"0\">NO</option>\n" +
        "        <option valu=\"1\">yes</option>\n" +
        "        </select><br>\n" +
        "    is_customer provide rice:<select class=\"type_rice_option\" id=\"option_"+id+"\" name=\"is_rice\">\n" +
        "        <option value=\"0\" >NO</option>\n" +
        "        <option value=\"1\">yes</option>\n" +
        "        </select><br>\n" +
        "<input value=\""+page_no+"\" id=\"tell_which_page_add_extra_"+id+"\" hidden>"+
        "<div class=\"rice_types\" id=\"type_rice_add_option_"+id+"\"></div>"+
        "    detail about product:<textarea name=\"textarea\"></textarea><br>\n" +
        "    add extra item :<input type=\"button\" value=\"+add\" class=\"add_extra\" id=\"add_extra_"+id+"\"><br>\n" +
        "    <div id=\"option_add_extra_"+id+"\"></div>\n" +
        "        <input type=\"button\" id=\""+id+"\"  class=\"submit_from\"value=\"save\">\n" +
        "        </form>");
}
function not_both_page(id,page_no) {
    $("#123").append("\n" +
        "<form class=\"from_group\"  id=\"from_group_"+id+"\" style=\"border: solid\">\n" +
        "<input name=\"form_page\" value=\""+page_no+"\" hidden>\n"+
        "<input name=\"id\" value=\""+id+"\" hidden>\n"+
        "    <p> without rice and meat</p>\n" +
        "    product quantity:<input name=\"quantity\"><br>\n" +
        "    weight in kg:<input name=\"weight\"><br>\n" +
        "    detail about product:<textarea name=\"textarea\"></textarea><br>\n" +
        "<input value=\""+page_no+"\" id=\"tell_which_page_add_extra_"+id+"\" hidden>"+
        "add extra item :<input type=\"button\" value=\"+add\" class=\"add_extra\" id=\"add_extra_"+id+"\"><br>\n" +
        "  <div id=\"option_add_extra_"+id+"\"></div>\n" +
        "    <input type=\"button\"  id=\""+id+"\" class=\"submit_from\"value=\"save\">\n" +
        "</form>");
}
function only_rice_page(id,page_no) {
    $('#123').append("<form class=\"from_group\"  id=\"from_group_"+id+"\" style=\"border: solid\">\n" +
        "<input name=\"form_page\" value=\""+page_no+"\" hidden>\n"+
        "<input name=\"id\" value=\""+id+"\" hidden>\n"+
        "    <p> only rice </p>\n" +
        "    product quantity:<input name=\"quantity\"><br>\n" +
        "    weight in kg:<input name=\"weight\"><br>\n" +
        "is_customer provide rice:<select class=\"type_rice_option\" id=\"option_"+id+"\" name=\"is_rice\">\n" +
        "        <option value=\"0\" >NO</option>\n" +
        "        <option value=\"1\">yes</option>\n" +
        "        </select><br>\n" +
        "<div class=\"rice_types\" id=\"type_rice_add_option_"+id+"\"></div>"+
        "    detail about product:<textarea name=\"textarea\"></textarea><br>\n" +
        "<input value=\""+page_no+"\" id=\"tell_which_page_add_extra_"+id+"\" hidden>"+
        "add extra item :<input type=\"button\" value=\"+add\" class=\"add_extra\" id=\"add_extra_"+id+"\"><br>\n" +
        "  <div id=\"option_add_extra_"+id+"\"></div>\n" +
        "    <input type=\"button\" id=\""+id+"\" class=\"submit_form\" value=\"save\">\n" +
        "</form>");
}
function other_page(id,page_no) {
    $("#123").append("<form class=\"from_group\"  id=\"from_group_"+id+"\" style=\"border: solid\">\n" +
        "<input name=\"form_page\" value=\""+page_no+"\" hidden>\n"+
        "<input name=\"id\" value=\""+id+"\" hidden>\n"+
        "    <p> fix varaity </p>\n" +
        "    product quantity:<input type='text' name=\"quantity\"><br>\n" +
        "    detail about product:<textarea name=\"textarea\"></textarea><br>\n" +
        "    <input type=\"button\" id=\""+id+"\" class=\"submit_from\" value=\"save\">\n" +
        "</form>");

}
function only_meat_page(id,page_no) {
    $("#123").append("\n" +
        "<form class=\"from_group\"  id=\"from_group_"+id+"\" style=\"border: solid\">\n" +
        "<input name=\"form_page\" value=\""+page_no+"\" hidden>\n"+
        "<input name=\"id\" value=\""+id+"\" hidden>\n"+
        "    <p>only meat</p>\n" +
        "    product quantity:<input name=\"product_quantity\"><br>\n" +
        "    meat quantity per kg:<input name=\"meat_quantity\"><br>\n" +
        "    is_customer provide meat:<select name=\"is_meat\">\n" +
        "        <option value=\"0\">no</option>\n" +
        "        <option value=\"1\">yes</option>\n" +
        "    </select>\n" +
        "<input value=\""+page_no+"\" id=\"tell_which_page_add_extra_"+id+"\" hidden>"+
        "add extra item :<input type=\"button\" value=\"+add\" class=\"add_extra\" id=\"add_extra_"+id+"\"><br>\n" +
        " <div id=\"option_add_extra_"+id+"\"></div>\n" +
        "    <input type=\"submit\" class=\"submit_form\" id=\""+id+"\" value=\"save\">\n" +
        "</form>");
}
function first_time_shows_all() {

    $.ajax({
        url:"order_filling_functions.php?insert=3",
        method:"GET",
        success:function (data) {
            $(".rice_types").append(data);
        }
    });
}


function show_rice_type(option)
{
    $.ajax({
        url:"order_filling_functions.php?insert=3",
        method:"GET",
        success:function (data) {
            $('#type_rice_add_'+option).append(data);
        }
    });
}
function append_all_dishes()
{
    var id;
    for(var i=0;i<all_orders_get.length;i++)
    {

        id=all_orders_get[i].id;
        if(all_orders_get[i].is_quantity_use!=null)
        {
            //naan drinks //number of page
            other_page(id,1);
        }
        else if(all_orders_get[i].is_rice==1 && all_orders_get[i].meat_type_id!=null)
        {
            //rice+meat
            meat_and_rice_page(id,2);
        }
        else if(all_orders_get[i].is_rice==0 && all_orders_get[i].meat_type_id==null && all_orders_get[i].is_quantity_use==null)
        {
            //not both
            not_both_page(id,3);
        }
        else if(all_orders_get[i].is_rice==1 && all_orders_get[i].meat_type_id==null)
        {
            //only rice
            only_rice_page(id,4);
        }
        else if(all_orders_get[i].is_rice==null &&all_orders_get[i].meat_type_id!=null)
        {
            //only meat
            only_meat_page(id,5);
        }
        sum_of_all=sum_of_all+id;
    }
}
$(document).ready(function () {
    //set dynamic pages
    $.ajax({
        url:"order_filling_functions.php?insert=1",
        method:"GET",
        success:function (all) {
            all_orders_get=JSON.parse(all);
            append_all_dishes();
        },
        error:function () {
            alert("error");
        }
    });


//get data from pages
    $(document).on('click','.submit_from',function () {
        var fromid=$(this).attr('id');
        $.ajax({
            url:"order_filling_functions.php?insert=2",
            method:"GET",
            type:"JSON",
            data:$("#from_group_"+fromid).serialize(),
            success:function (all) {
                window.console.log(all);
                $("#from_group_"+fromid).remove();
            },
            error:function () {
                alert("error");
            }
        });

    });
    $(document).on('change','.type_rice_option',function () {
        var option_type_rice=$(this).attr('id');
        var option=$(this).val();
        if(option==0)
        {
            //show_rice_type(option_type_rice);
            $("#type_rice_add_"+option_type_rice).show();
        }
        else
        {
            $("#type_rice_add_"+option_type_rice).hide();
        }
    });


    $(document).on('click','.add_extra',function () {
        var addextra=$(this).attr('id');

        var id=addextra.replace('add_extra_','');
        var dishid=0;
        for(let i=0;i<all_orders_get.length;i++)
        {
            if(all_orders_get[i].id==id)
            {
                dishid=all_orders_get[i].dish_id;
                break;
            }
        }
        $.ajax({
            url: "order_filling_functions.php?insert=4",
            method:"GET",
            data:{
                dishid:dishid,
                sum_of_all:sum_of_all
            },
            success:function (data) {
                $("#option_" + addextra).append(data);
            },
            error:function () {
                alert("error");
            }
        });

        sum_of_all++;
    });

    $(document).on('click','.remove_add_extra',function () {
        var removeoption=$(this).attr('id');
        $("#add_"+removeoption).remove();
    });
    first_time_shows_all();

});
