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
    $("#sort").change( function(){
        var minPrice = $("#min_price").val();
        var maxPrice = $("#max_price").val();
        var location = $("#get_location").val();
        var sort=$("#sort").val();
        var url = $("#url").val();
        console.log(sort,url)
        var price_type =  get_filter("price_type");
        var type =  get_filter("type");

        if(sort=== "" && url==="" ) {
            return false;
        }
        $.ajax({
            type: 'get',
            url:'/category/',
            data:{
                price_type:price_type,
                type:type,
                url:url,
                sort:sort,
                location: location,
                minPrice:minPrice,
                maxPrice:maxPrice

            },
            success:function(response){
                // alert(response);
                $(".appendAjaxList").html(response);

            },error:function(){
                alert('error');
            }
        });
    });
    // filter for sleeve
    $(".price_type").on('click', function(){
        var minPrice = $("#min_price").val();
        var maxPrice = $("#max_price").val();
        var location = $("#get_location").val();
        var  url= $("#url").val();
        var price_type = 'price_type';
        console.log(minPrice, maxPrice)
        // alert(url)
        var price_type = get_filter(price_type);
        var type =  get_filter("type");

        // alert(price_type);
        var sort = $("#sort option:selected").val();
        $.ajax({
            type: 'get',
            url:'/category',
            data:{
                price_type :price_type,
                type:type,
                sort:sort,
                url:url,
                location:location,
                minPrice:minPrice,
                maxPrice:maxPrice

            },
            success:function(response){
                // alert(response);
                $(".appendAjaxList").html(response);

            },error:function(){
                alert('error');
            }
        });
    });
   
    // filter for sleeve
    $(".type").on('click', function(){
        var minPrice = $("#min_price").val();
        var maxPrice = $("#max_price").val();
        var  url= $("#url").val();
        var type = 'type';
        var location = $("#get_location").val();
        console.log(minPrice,maxPrice)

        // alert(url)
        var type = get_filter(type);
        var price_type =  get_filter("price_type");
        var sort = $("#sort option:selected").val();

        console.log(type, price_type, sort)

        // alert(price_type);
        $.ajax({
            type: 'get',
            url:'/category',
            data:{
                price_type :price_type,
                type:type,
                sort:sort,
                url:url,
                location:location,
                minPrice:minPrice,
                maxPrice:maxPrice
            },
            success:function(response){
                // alert(response);
                $(".appendAjaxList").html(response);

            },error:function(){
                alert('error');
            }
        });
    });

    $("#get_location").keyup(function(){
        var minPrice = $("#min_price").val();
        var maxPrice = $("#max_price").val();
        var  url= $("#url").val();
        var location = $(this).val();
        var type = get_filter('type');
        var price_type =  get_filter("price_type");
        var sort = $("#sort option:selected").val();

        console.log(type, price_type, sort)

        // alert(price_type);
        $.ajax({
            type: 'get',
            url:'/category',
            data:{
                price_type :price_type,
                type:type,
                sort:sort,
                location:location,
                url:url,
                minPrice:minPrice,
                maxPrice:maxPrice
            },
            success:function(response){
                // alert(response);
                $(".appendAjaxList").html(response);

            },error:function(){
                alert('error');
            }
        });
    });
    $("#price_range").click(function(e) {
        var minPrice = $("#min_price").val();
        var maxPrice = $("#max_price").val();
        var  url= $("#url").val();
        var location = $(this).val();
        var type = get_filter('type');
        var price_type =  get_filter("price_type");
        var sort = $("#sort option:selected").val();

        if(minPrice=== "" && maxPrice==="" ) {
            return false;
        }else{
            console.log(minPrice, maxPrice)
            $.ajax({
                type: 'get',
                url:'/category',
                data:{
                    price_type :price_type,
                    type:type,
                    sort:sort,
                    location:location,
                    url:url,
                    minPrice:minPrice,
                    maxPrice:maxPrice
                },
                success:function(response){
                    // alert(response);
                    $(".appendAjaxList").html(response);
    
                },error:function(){
                    alert('error');
                }
            });
        }

    });
    

    function get_filter(class_name){
        var filter = [];
        $('.' + class_name + ':checked').each(function(){
            filter.push($(this).val());
        });
            return filter;
    }

});


