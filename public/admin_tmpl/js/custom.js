

// spiner functionality

// delete user on submit function
function userDelete(e) {
    if (confirm('Are you sure?')) {
        $(e).find('form').submit();
    }
}

// add new slider toogle
function slider_form() {
    var slide_element = $(".slider_page_box .sliders_form");

    slide_element.toggleClass('visible');

    if(slide_element.hasClass('visible')){
        $(".add_slider_btn a").html("<i class='fa fa-minus'> </i> Hide Form");
    }else{
        $(".add_slider_btn a").html("<i class='fa fa-plus'></i> Add New Slider");
    }
}


//  edit slider edit
$(document).on('click','.edit_slider',function(){
    var id = $(this).attr('data-id');

    $.ajax({
        type: "GET",
        url: '/admin/sliders/edit',
        data: {
            "_token": "{{ csrf_token() }}",
            "slider_id": id
        },
        success: function(data) {
            console.log(data);
            $(".slider_page_box .sliders_form").addClass('visible');
            $(".add_slider_btn a").html("<i class='fa fa-minus'> </i> Hide Form");
        }
    })

});
