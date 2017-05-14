function createPay() {
    var data = {
        transaction_amount: 3000
    }

    $.ajax({
        url : 'https://www.mercadopago.com.ve/v1/payments',
        type : 'POST',
        data : data,
        success : function (data) {
            console.log(data);
        },
        error : function(error){
            console.log(error);
        }
    });
}