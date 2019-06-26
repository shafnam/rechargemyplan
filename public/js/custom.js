$(document).ready(function(){    

    /* 
        CARRIER ADD FORM 
    */  
    
    /* IMAGE UPLOAD EVENT */
    $("#carrier_logo").change(function() {
        $("#img-up-btn").html("Change Image");
    });

    /* STATUS SWITCHES */
    $('#carrier_status').change(function() {
        if (!$(this).is(':checked')) {
            $('#new_carrier_status').val('0');
        }else{
            $('#new_carrier_status').val('1');
        }
    });

    $('#plan_status').change(function() {
        if (!$(this).is(':checked')) {
            $('#new_plan_status').val('0');
        }else{
            $('#new_plan_status').val('1');
        }      
    });

    $('#sim_status').change(function() {
        if (!$(this).is(':checked')) {
            $('#new_sim_status').val('0');
        }else{
            $('#new_sim_status').val('1');
        }      
    });

    $('#plan_discount').change(function(){
        if(this.checked)
            $('#plan_discount_container').show();
        else
            $('#plan_discount_container').hide();
    });

    /* 
        PLAN ADD FORM 
    */  

    /* IMAGE UPLOAD EVENT */
    $("#plan_logo").change(function() {
        $("#img-up-btn").html("Change Image");
    });

    $('#plan_discount').change(function() {
        if (!$(this).is(':checked')) {
            $('#new_plan_discont').val('0');
        }else{
            $('#new_plan_discont').val('1');
        }      
    });

    /* 
        PLAN EDIT FORM 
    */ 
    if (!$('#plan_discount').is(':checked')) {
        $('#plan_discount_container').hide();
    }else{
        $('#plan_discount_container').show();
    }

    $('#plans').DataTable();

    /* 
        BLOG ADD FORM 
    */ 

    /* IMAGE UPLOAD EVENT */
    $("#blog_featured_image").change(function() {
        $("#img-up-btn").html("Change Image");
    });

});

