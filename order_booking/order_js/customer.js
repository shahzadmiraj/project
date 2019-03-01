function create_new_address()
{

}
function create_new_number()
{

}


$(document).ready(function () { //when page is loaded

    $('#submit1').click(function () {
        let name=$('#name').val();
        let  cnic=$("#cnic").val();
        let address_city=$("#address_city").val();
        let address_town=$("#address_town").val();
        let address_street_no=$("#address_street_no").val();
        let  address_house_no=$("#address_house_no").val();
        let personality_comments=$("#personality_comments").val();
        let number=$("#number").val();
        $.get("order_functions.php",{
            //send data from post by key value

            //mid:datavalue1,
            insert:1,
            name:name,
            cnic:cnic,
            address_city:address_city,
            address_town:address_town,
            address_street_no:address_street_no,
            address_house_no:address_house_no,
            personality_comments:personality_comments,
            number:number
        },function (data,status) {
            //get data at

            $("#con").html(data);


        });

        alert("ss");
    });
});