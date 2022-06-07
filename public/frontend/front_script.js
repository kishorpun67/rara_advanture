$(document).ready(function() {
    $("#show_post").keyup(function() {
        var title = $(this).val();
        if (title != '') {
            // alert(title);
            console.log(title)

            $.ajax({
                type: "post",
                url: "/search-post",
                data: { title: title },
                success: function(data) {
                    // console.log(data);
                    $("#post").fadeIn("fast").html(data);
                }
            });
        } else {
            $("#post").fadeOut();
        }
    });

    $(document).on('click', '#post li', function() {
        $('#show_post').val($(this).text());
        $("#post").fadeOut();
    });

    // select sort by post
    $("#sort").change(function() {
        var date = $("#getDate").val();

        var minPrice = $("#min_price").val();
        var maxPrice = $("#max_price").val();
        var location = $("#get_location").val();
        var sort = $("#sort").val();
        var url = $("#url").val();
        var category_id = $("#url").attr('category_id');

        console.log(sort, url, category_id)
        var price_type = get_filter("price_type");
        var type = get_filter("type");

        if (sort === "" && url === "") {
            return false;
        }
        $.ajax({
            type: 'get',
            url: '/category/',
            data: {
                price_type: price_type,
                type: type,
                url: url,
                sort: sort,
                location: location,
                minPrice: minPrice,
                maxPrice: maxPrice,
                category_id: category_id,
                date: date,



            },
            success: function(response) {
                // alert(response);
                $(".appendAjaxList").html(response);

            },
            error: function() {
                alert('error');
            }
        });
    });

    // // sort by date 
    $("#getDate").on('click', function() {

            var date = $("#getDate").val();
            // alert(date)
            var minPrice = $("#min_price").val();
            var maxPrice = $("#max_price").val();
            var location = $("#get_location").val();
            var sort = $("#sort").val();
            var url = $("#url").val();
            var category_id = $("#url").attr('category_id');

            console.log("TEST" + date)
            var price_type = get_filter("price_type");
            var type = get_filter("type");

            if (sort === "" && url === "") {
                return false;
            }
            $.ajax({
                type: 'get',
                url: '/category/',
                data: {
                    price_type: price_type,
                    type: type,
                    url: url,
                    sort: sort,
                    location: location,
                    minPrice: minPrice,
                    maxPrice: maxPrice,
                    category_id: category_id,
                    date: date,
                },
                success: function(response) {
                    // alert(response);
                    $(".appendAjaxList").html(response);

                },
                error: function() {
                    alert('error');
                }
            });
        })
        // filter for sleeve
    $(".price_type").on('click', function() {
        var date = $("#getDate").val();

        var minPrice = $("#min_price").val();
        var maxPrice = $("#max_price").val();
        var location = $("#get_location").val();
        var url = $("#url").val();
        var category_id = $("#url").attr('category_id');

        var price_type = 'price_type';
        console.log(minPrice, maxPrice)
            // alert(url)
        var price_type = get_filter(price_type);
        var type = get_filter("type");

        // alert(price_type);
        var sort = $("#sort option:selected").val();
        $.ajax({
            type: 'get',
            url: '/category',
            data: {
                price_type: price_type,
                type: type,
                sort: sort,
                url: url,
                location: location,
                minPrice: minPrice,
                maxPrice: maxPrice,
                category_id: category_id,
                date: date,

            },
            success: function(response) {
                // alert(response);
                $(".appendAjaxList").html(response);

            },
            error: function() {
                alert('error');
            }
        });
    });

    // filter for sleeve
    $(".type").on('click', function() {
        var date = $("#getDate").val();

        var minPrice = $("#min_price").val();
        var maxPrice = $("#max_price").val();
        var url = $("#url").val();
        var category_id = $("#url").attr('category_id');

        var type = 'type';
        var location = $("#get_location").val();
        console.log(minPrice, maxPrice)

        // alert(url)
        var type = get_filter(type);
        var price_type = get_filter("price_type");
        var sort = $("#sort option:selected").val();

        console.log(type, price_type, sort)

        // alert(price_type);
        $.ajax({
            type: 'get',
            url: '/category',
            data: {
                price_type: price_type,
                type: type,
                sort: sort,
                url: url,
                location: location,
                minPrice: minPrice,
                maxPrice: maxPrice,
                category_id: category_id,
                date: date,


            },
            success: function(response) {
                // alert(response);
                $(".appendAjaxList").html(response);

            },
            error: function() {
                alert('error');
            }
        });
    });

    $("#get_location").keyup(function() {
        var date = $("#getDate").val();
        var minPrice = $("#min_price").val();
        var maxPrice = $("#max_price").val();
        var url = $("#url").val();
        var category_id = $("#url").attr('category_id');

        var location = $(this).val();
        var type = get_filter('type');
        var price_type = get_filter("price_type");
        var sort = $("#sort option:selected").val();

        console.log(type, price_type, sort)

        // alert(price_type);
        $.ajax({
            type: 'get',
            url: '/category',
            data: {
                price_type: price_type,
                type: type,
                sort: sort,
                location: location,
                url: url,
                minPrice: minPrice,
                maxPrice: maxPrice,
                category_id: category_id,
                date: date,


            },
            success: function(response) {
                // alert(response);
                $(".appendAjaxList").html(response);

            },
            error: function() {
                alert('error');
            }
        });
    });
    $("#price_range").click(function(e) {
        var date = $("#getDate").val();
        var minPrice = $("#min_price").val();
        var maxPrice = $("#max_price").val();
        var url = $("#url").val();
        var category_id = $("#url").attr('category_id');
        var location = $(this).val();
        var type = get_filter('type');
        var price_type = get_filter("price_type");
        var sort = $("#sort option:selected").val();

        if (minPrice === "" && maxPrice === "") {
            return false;
        } else {
            console.log(minPrice, maxPrice)
            $.ajax({
                type: 'get',
                url: '/category',
                data: {
                    price_type: price_type,
                    type: type,
                    sort: sort,
                    location: location,
                    url: url,
                    minPrice: minPrice,
                    maxPrice: maxPrice,
                    category_id: category_id,
                    date: date,

                },
                success: function(response) {
                    // alert(response);
                    $(".appendAjaxList").html(response);

                },
                error: function() {
                    alert('error');
                }
            });
        }

    });


    function get_filter(class_name) {
        var filter = [];
        $('.' + class_name + ':checked').each(function() {
            filter.push($(this).val());
        });
        return filter;
    }

});


function rating(rating) {
    if (rating == 1) {
        $("#star-2").removeClass('fa-star');
        $("#star-3").removeClass('fa-star');
        $("#star-4").removeClass('fa-star');
        $("#star-5").removeClass('fa-star');
        $("#star-2").addClass('fa-star-o');
        $("#star-3").addClass('fa-star-o');
        $("#star-4").addClass('fa-star-o');
        $("#star-5").addClass('fa-star-o');
    }
    if (rating == 2) {
        // console.log('2')
        var className = $("#star-2").attr('class');
        if (className == "fa fa-star-o") {
            console.log('tst')
            $("#star-2").removeClass('fa-star-o');
            $("#star-2").addClass('fa-star');
        } else {
            $("#star-2").removeClass('fa-star');
            $("#star-3").removeClass('fa-star');
            $("#star-4").removeClass('fa-star');
            $("#star-5").removeClass('fa-star');
            $("#star-2").addClass('fa-star-o');
            $("#star-3").addClass('fa-star-o');
            $("#star-4").addClass('fa-star-o');
            $("#star-5").addClass('fa-star-o');
        }
    }
    if (rating == 3) {
        // console.log('2')
        var className2 = $("#star-2").attr('class');
        var className3 = $("#star-3").attr('class');
        if (className3 == "fa fa-star-o") {
            $("#star-2").removeClass('fa-star-o');
            $("#star-2").addClass('fa-star');
            $("#star-3").removeClass('fa-star-o');
            $("#star-3").addClass('fa-star');
        } else {
            $("#star-3").removeClass('fa-star');
            $("#star-3").addClass('fa-star-o');
            $("#star-4").removeClass('fa-star');
            $("#star-5").removeClass('fa-star');
            $("#star-4").addClass('fa-star-o');
            $("#star-5").addClass('fa-star-o');


        }
    }
    if (rating == 4) {
        var className4 = $("#star-4").attr('class');
        if (className4 == "fa fa-star-o") {
            // console.log('tst')
            $("#star-2").removeClass('fa-star-o');
            $("#star-2").addClass('fa-star');
            $("#star-3").removeClass('fa-star-o');
            $("#star-3").addClass('fa-star');
            $("#star-4").removeClass('fa-star-o');
            $("#star-4").addClass('fa-star');
        } else {
            $("#star-4").removeClass('fa-star');
            $("#star-5").removeClass('fa-star');
            $("#star-4").addClass('fa-star-o');
            $("#star-5").addClass('fa-star-o');
        }
    }
    if (rating == 5) {
        var className4 = $("#star-4").attr('class');
        if (className4 == "fa fa-star-o") {
            // console.log('tst')
            $("#star-2").removeClass('fa-star-o');
            $("#star-2").addClass('fa-star');
            $("#star-3").removeClass('fa-star-o');
            $("#star-3").addClass('fa-star');
            $("#star-4").removeClass('fa-star-o');
            $("#star-4").addClass('fa-star');
            $("#star-5").removeClass('fa-star-o');
            $("#star-5").addClass('fa-star');
        } else {
            $("#star-5").removeClass('fa-star');
            $("#star-5").addClass('fa-star-o');
        }
    }
    $("#star").val(rating)

}

$(".changeImage").click(function() {
    var image = $(this).attr('src');
    $(".mainImage").attr('src', image);
    // alert(image)
})

$("#number_of_customer").click(function() {
    var number_of_customer = $("#number_of_customer").val()
    var get_post_price = $("#get_post_price").val()
    var total = number_of_customer * get_post_price;
    $("#post_price").text(total)
    $("#total_price").val(total)
})