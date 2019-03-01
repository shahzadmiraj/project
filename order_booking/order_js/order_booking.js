var destination_type=1;
var show_address=document.getElementById("show_against_type");

function address_show()
{
    destination_type=document.getElementById("destination_type").value;
    if(destination_type==1)
    {
        show_address.innerHTML="";
    }
    else if(destination_type==2)
    {
        show_address.innerHTML='<span>hall_name=<input type="text"><br></span>';
    }
}