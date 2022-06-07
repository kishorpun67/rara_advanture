$(document).ready(function() {

    //update  superAdmin banner status
    $(".updateBannerStatus").click(function() {
        var status = $(this).text();
        var banner_id = $(this).attr("banner_id");
        $.ajax({
            type: 'post',
            url: '/superAdmin/update-banner-status',
            data: {
                status: status,
                banner_id: banner_id
            },
            success: function(response) {
                if (response['status'] == 0) {
                    $("#banner-" + banner_id).html("<a  class='updateBannerStatus'  href='javascript:(0);'>Inctive</a>");
                } else if (response['status'] == 1) {
                    $("#banner-" + banner_id).html(" <a  class='updateBannerStatus'  href='javascript:(0);'>Active</a>");
                }
            },
            error: function() {
                alert("Error");
            }
        });
    });

    //update  superAdmin category status
    $(".updateCategoryStatus").click(function() {
        var status = $(this).text();
        var category_id = $(this).attr("category_id");
        $.ajax({
            type: 'post',
            url: '/superAdmin/update-category-status',
            data: {
                status: status,
                category_id: category_id
            },
            success: function(response) {
                if (response['status'] == 0) {
                    $("#category-" + category_id).html("<a  class='updateCategoryStatus'  href='javascript:(0);'>Inctive</a>");
                } else if (response['status'] == 1) {
                    $("#category-" + category_id).html(" <a  class='updateCategoryStatus'  href='javascript:(0);'>Active</a>");
                }
            },
            error: function() {
                alert("Error");
            }
        });
    });

    //update  superAdmin testimonial status
    $(".updateTestimonialStatus").click(function() {
        var status = $(this).text();
        var testimonial_id = $(this).attr("testimonial_id");
        $.ajax({
            type: 'post',
            url: '/superAdmin/update-testimonial-status',
            data: {
                status: status,
                testimonial_id: testimonial_id
            },
            success: function(response) {
                if (response['status'] == 0) {
                    $("#testimonial-" + testimonial_id).html("<a  class='updateTestimonialStatus'  href='javascript:(0);'>Inctive</a>");
                } else if (response['status'] == 1) {
                    $("#testimonial-" + testimonial_id).html(" <a  class='updateTestimonialStatus'  href='javascript:(0);'>Active</a>");
                }
            },
            error: function() {
                alert("Error");
            }
        });
    });


    //update  admin post status
    $(".updatePostStatus").click(function() {
        var status = $(this).text();
        var post_id = $(this).attr("post_id");
        $.ajax({
            type: 'post',
            url: '/admin/update-post-status',
            data: {
                status: status,
                post_id: post_id
            },
            success: function(response) {
                if (response['status'] == 0) {
                    $("#post-" + post_id).html("<a  class='updatePostStatus'  href='javascript:(0);'>Inctive</a>");
                } else if (response['status'] == 1) {
                    $("#post-" + post_id).html(" <a  class='updatePostStatus'  href='javascript:(0);'>Active</a>");
                }
            },
            error: function() {
                alert("Error");
            }
        });
    });

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


    $(".categories").click(function() {
        var category_id = $(this).attr("attr");
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



    //kishor i did this
    $(".add_item").click(function() {
        $("#add_item").empty()
        var item_id = $(this).attr("item_id");
        var price = $(this).attr("price");
        var name = $(this).attr("names");

        // alert(price)
        $.ajax({
            type: 'post',
            url: '/admin/ajax-food-table',
            data: {
                item_id: item_id,
                price: price,
                name: name,
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