$(document).ready(function() {
   
    $(".delete_form").click(function() {
        var id = $(this).attr('rel');
        var record = $(this).attr('record');
        // alert(id);
        swal({
                title: "Are you sure?",
                text: "You will not able to recover this record again!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Yes, delete it",
            },
            function() {
                window.location.href = "delete-" + record + "/" + id;
            }
        );
    });

});

$(document).ready(function() {
    $(".categories").click(function() {
        var category_id= $(this).attr("attr");
        // alert(category_id)
        $.ajax({
            type: 'get',
            url: '/admin/ajax-get-item',
            data: {
                category_id: category_id
            },
            success: function(response) {
                console.log(response)
                $("#ajaxItem").html(response);
               
            },
            error: function() {
                alert("Error");
            }
        });
    });

});


//kishor i did this
$(document).ready(function() {
    $(".add_item").click(function() {
        $("#add_item").empty()
        var item_id= $(this).attr("item_id");
        var price= $(this).attr("price");
        var name= $(this).attr("names");

        // alert(price)
        $.ajax({
            type: 'post',
            url: '/admin/ajax-food-table',
            data: {
                item_id:item_id,
                price:price,
                name:name,
            },
            success: function(response) {
                console.log(response)
                $("#add_item").html(response);
            },
            error: function() {
                alert("Error");
            }
        });
    });

});