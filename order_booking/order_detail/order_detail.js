
$(document).ready(function (){
    var x=0;
    $("#submit").click(function () {

        //Function to get selected inner text
        var dish_name = $("#dish option:selected").text();
        //Function to get selected value
        var dish_id = $("#dish option:selected").val();

        var add_dish='<tr id="dishes'+x+'"><th><label >'+x+'</label></th><th><label>'+dish_name+'</label></th><th><input hidden name="dish[]" value="'+dish_id+'"type="input"><input type="submit" class="remove_btb" id="'+x+'"></th></tr>';
        $("#all_orders").append(add_dish);
        x++;
    });
    $(document).on('click','.remove_btb',function () {
        var which_btn=$(this).attr("id");
        $('#dishes'+which_btn+'').remove();

    });
  $('#submit1').click(function () {
    $.ajax({
     url:"order_detail_functions.php",
        type:"JSON",
     method:"GET",
        data:$('#form_add').serialize(),
        success:function (data) {
            $('#form_add')[0].reset();
        }

    });
  });


});