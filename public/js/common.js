/*==========================================
 * 
 /*========================================
 * Use this script to fire all actions that
 * are common to each page.
 */
$(document).ready(function(e) {
    /*==========================================
     * APPEAR ANIMATION
     *==========================================*/

     $('[data-appear-animation]').appear(function(){
         var delay = $(this).attr('data-appear-delay');
         var $el = $(this);
         if(delay){
             setTimeout(function(){
                 $el.addClass("animated " + $el.attr('data-appear-animation'));
             }, delay);
         } else {
           $el.addClass("animated " + $el.attr('data-appear-animation'));
         }
     });

	 /*==========================================
     * NICE SCROLL
     *==========================================*/
	 $("html, .pro_main_body, form.scrollIfExcess>div.panel-body, div.panel-body, div.pro_under_box").niceScroll({
        bouncescroll: true,
        cursorcolor: "#666",
        cursorwidth: "8px",
        scrollspeed: 60,
        smoothscroll: true,
        zindex: "auto" | '9000'
    });

    /*==========================================
     * SHOW TOOLTIP
     *==========================================*/
    $(".showToolTip").tooltip();

    /*==========================================
     * SHOW POPOVER
     *==========================================*/
    $('[data-toggle="popover"]').popover();

    $(".firstInput").focus();

    /*==========================================
     * DELETE CONFIRMATION BOX FOR DATA
     *==========================================*/
    $('.confirmButton').click(function(e){
        var $form_id = $(this).attr('data-form-id');
        e.preventDefault();
        swal({
                title: "Are you sure?",
                text: "You will not be able to recover this data!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: '#d9534f',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: "No, cancel plz!",
                closeOnConfirm: false,
                closeOnCancel: false
            },
            function(isConfirm){
                if (isConfirm){
                    $(".pro_do_task #"+$form_id).trigger('submit');
                    //swal("Deleted!", "Your data has been deleted!", "success");
                } else {
                    swal("Cancelled", "Your data is safe :)", "error");
                }
            }
        );
    });

    /*==========================================
     * DELETE CONFIRMATION BOX FOR fILE
     *==========================================*/
    $('.pro_delete_file_button').click(function(e){
        var $form_id = $(this).attr('data-delete-form-id');
        e.preventDefault();
        swal({
                title: "Are you sure?",
                text: "You will not be able to recover this file!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: '#d9534f',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: "No, cancel plz!",
                closeOnConfirm: false,
                closeOnCancel: false
            },
            function(isConfirm){
                if (isConfirm){
                    $(".pro_do_task #"+$form_id).trigger('submit');
                    //swal("Deleted!", "Your data has been deleted!", "success");
                } else {
                    swal("Cancelled", "Your data is safe :)", "error");
                }
            }
        );
    });

    /*==========================================
     * TOGGLE ADVANCE AND LESS CONTENT
     *==========================================*/
    $('.pro_advance_button_footer').click(function(){
        var $this = $(this);
        $this.closest('form').find('.pro_advance_info').toggle('slow');
        var $toggle_id = $this.attr('data-toggle-id');
        if($toggle_id == 1){
            $this.attr('data-toggle-id','2');
            $this.html('Less <span class="glyphicon glyphicon-upload faa-tada animated-hover"></span>');
        }else{
            $this.attr('data-toggle-id','1');
            $this.html('Advance <span class="glyphicon glyphicon-download faa-tada animated-hover"></span>');
        }
    });

    $('form.showSavingOnSubmit').submit(function(){
        var $btn = $(this).find('button:submit');
        $btn.attr('disabled','disabled');
        $btn.button('loading');
    });


    $("#pro_left_history").click(function(){
        window.history.back();
    });
    $("#pro_right_history").click(function(){
        window.history.go(1);
    });
});


/*==========================================
 * DELETE SUCCESSFUL INFO
 *==========================================*/
function delete_success_info(data){
    if(!data)
        data = " the data";
    swal("Successfully Deleted!", "You just deleted the "+data+"!", "success");
}

/*==========================================
 * RECORD SUCCESSFUL INFO
 *==========================================*/
function store_success_info(data){
    if(!data)
        data = " the data";
    swal("Successfully Stored!", "You just stored the "+data+"!", "success");
}

/*==========================================
 * UPDATE SUCCESSFUL INFO
 *==========================================*/
function update_success_info(data){
    if(!data)
        data = " the data";
    swal("Successfully Updated!", "You just updated the "+data+"!", "success");
}

/*==========================================
 * DELETE FILE SUCCESSFUL INFO
 *==========================================*/
function delete_file_success_info(data){
    if(!data)
        data = " the file";
    swal("Successfully Deleted!", "You just deleted the "+data+"!", "success");
}

/*==========================================
 * REDIRECTED TO
 *==========================================*/
function redirect_to(data){
    var $mainUrl = $('#homePath').val();
    if(!data)
        data = " these data";
    swal({   title: "Your are redirected Here!!",   text: "Please add "+data+" with active status or check whether there is active record then try your previous task :).",   imageUrl: $mainUrl+"/public/images/smile1.png" });
}


/*==========================================
 * PAGE LINKER
 *==========================================*/
function page_linker(link1){

    swal({
            title: "Where do you want to go?",
            text: "Please choose the destination you want to go :) !",
            type: "success",
            showCancelButton: true,
            confirmButtonColor: '#d9534f',
            confirmButtonText: 'Lets create bill!',
            cancelButtonText: "Stay Here!",
            closeOnConfirm: false,
            closeOnCancel: false
        },
        function(isConfirm){
            if (isConfirm){
                window.location = link1;
            } else {
                swal("Data Stored Successfully!!", "Please go ahead", "success");
            }
        }
    );
}

/*==========================================
 * SEARCH AND SHOW RESULT
 *==========================================*/
function searchData($url, $val, $selector){
    $.ajax({
        url: $url,
        dataType: 'html',
        data: 'input='+$val+'&selector='+$selector,
        type: 'GET',
        cache: false,
        success: function(rval){
            $('#search_result').html(rval);
        }
    });
}