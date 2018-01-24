function buyItem(item_id) {
    var name = $('.item-header').text().split("> ")[2];
    var pri = $('#buyPays').val();
    var qty = $('.bquantity').val();
    if(qty == 1) {
        text = 'Are you sure you wish to buy '+qty+' '+name+'for $'+pri+'?';
    } else {
        text = 'Are you sure you wish to buy '+qty+' '+name+'for $'+pri+' (each)?';
    }
    swal({
        icon: "info",
        title: "Are you sure?",
        text: text,
        buttons: {
          cancel: true,
          confirm: true,
        },
    })
    .then(res => {
        if(res) {
            $.ajax({
                type: 'POST',
                url: "test.php",
                data: {
                    amount: qty,
                    item_id: item_id,
                    price: pri.replace(",",""),
                },
                success: function(response) {
                    if(response.status == 'success') {
                        if(response.message == 'order_placed') {
                            swal({
                                title: "Success!",
                                icon: "info",
                                text: "There were no avaliable sell orders at your price, a buy order has been made.",
                            });
                        }
                        if(response.message == 'order_found') {
                            swal({
                                title: "Success!",
                                icon: "info",
                                text: "A sell order has been found at $1000!\nYour item will be transferred shortly.",
                            });
                        }
                        if(response.message == 'order_failed') {
                            swal({
                                title: "Error!",
                                icon: "error",
                                text: "Sadly, there was an error placing your order!\nTry again later.",
                            });
                        }
                    } else {
                        swal({
                            title: "Error!",
                            icon: "error",
                            text: "There was a critical error in proccessing your order, contact a developer!",
                        });
                    }
                }
            });
        }
    })
    .catch(err => {
        if (err) {
            swal("Oh noes!", "The AJAX request failed! Contact a developer!", "error");
        } else {
            swal.stopLoading();
            swal.close();
        }
    });
}
function sellItem(item_id) {
    var name = $('.item-header').text().split("> ")[2];
    var pri = $('#sellerRecieve').val();
    var qty = $('.quantity').val();
    if(qty == 1) {
        text = 'Are you sure you wish to sell '+qty+' '+name+'for $'+pri+'?';
    } else {
        text = 'Are you sure you wish to sell '+qty+' '+name+'for $'+pri+' (each)?';
    }
    swal({
        icon: "info",
        title: "Are you sure?",
        text: text,
        buttons: {
          cancel: true,
          confirm: true,
        },
    })
    .then(res => {
        if(res) {
            $.ajax({
                type: 'POST',
                url: "test.php",
                data: {
                    amount: qty,
                    item_id: item_id,
                    price: pri.replace(",",""),
                },
                success: function(response) {
                    if(response.status == 'success') {
                        if(response.message == 'order_placed') {
                            swal({
                                title: "Success!",
                                icon: "info",
                                text: "There were no avaliable buy orders at your price, a sell order has been made.",
                            });
                        }
                        if(response.message == 'order_found') {
                            swal({
                                title: "Success!",
                                icon: "info",
                                text: "A buy order has been found at $1000!\nYour money will be transferred shortly.",
                            });
                        }
                        if(response.message == 'order_failed') {
                            swal({
                                title: "Error!",
                                icon: "error",
                                text: "Sadly, there was an error creating your order!\nTry again later.",
                            });
                        }
                    }
                    else if(response.status == 'user_failure') {
                        if(response.message == 'order_invalid_quantity') {
                            swal({
                                title: "Error!",
                                icon: "error",
                                text: "You do not have this many "+name+"'s!\nRefrain from trying to exploit.",
                            });
                        } else {
                            if(response.message == 'order_invalid') {
                                swal({
                                    title: "Error!",
                                    icon: "error",
                                    text: "Sadly, there was an error placing your order!\nTry again later.",
                                });
                            }
                        }
                    }
                    else {
                        swal({
                            title: "Error!",
                            icon: "error",
                            text: "There was a critical error in proccessing your order, contact a developer!",
                        });
                    }
                }
            });
        }
    })
    .catch(err => {
        if (err) {
            swal("Oh noes!", "The AJAX request failed! Contact a developer!", "error");
        } else {
            swal.stopLoading();
            swal.close();
        }
    });
}
