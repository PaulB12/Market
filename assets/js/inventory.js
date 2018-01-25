$('.img').click(function(){
    $('.selected').removeClass("selected");
    $(this).addClass("selected");
    var itemid = $(this).siblings("span").text();
    try {
        var itemid = parseInt(itemid);
    }
    catch(err) {
        console.log("Invalid item_id");
    }
    $.ajax({
        type: 'POST',
        url: 'test.php',
        data: {
            itemid: itemid,
        },
        success: function(response) {
            if(response.status == 'success') {
                $('.inv-img').attr("src",response.img);
                $('.inventory-desc-title').text(response.item_name);
                $('.inventory-desc-description').html(response.description);
                $('.item-header').html(response.category_filepath);
                $('.category').text(response.category);
                $('.searchLink').attr("href",response.marketLink);
                $('.price').text(response.price);
            }
            else if(response.status == 'error') {
                console.log('Invalid ItemID');
            }
            else {
                console.log('AJAX Request failed, contact a developer');
            }
        }
    });
});
