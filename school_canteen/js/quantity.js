
$(document).ready(function() {
    $('.increment-btn').click(function(e) {
        e.preventDefault();

        var qty = $(this).closest('.product_data').find('.input-qty').val();

        var value = parseInt(qty, 10);
        value = isNaN(value) ? 0 : value;

        if (value < 100) {
            value++;
            $(this).closest('.product_data').find('.input-qty').val(value);
        }
    });

    $('.decrement-btn').click(function(e) {
        e.preventDefault();

        var qty = $(this).closest('.product_data').find('.input-qty').val();

        var value = parseInt(qty, 10);
        value = isNaN(value) ? 0 : value;

        if (value > 1) {
            value--;
            $(this).closest('.product_data').find('.input-qty').val(value);
        }
    });





    $('.addToCartBtn').click(function(e) {
        e.preventDefault();

        var qty = $(this).closest('.product_data').find('.input-qty').val();
        var prod_id = $(this).val();
        Swal.fire({
            title: 'Do you want to save the changes?',
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: 'Yes',
            denyButtonText: `No`,
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {

                $.ajax({
                    method: "POST",
                    url: "handlecart.php",
                    data: {
                        "prod_id": prod_id,
                        "prod_qty": qty,
                        "scope": "add"
                    },
                    success: function(response) {

                        var res = jQuery.parseJSON(response);
                        if (res.status == 400) {
                            Swal.fire({
                                icon: 'warning',
                                title: 'Something Went Wrong.',
                                text: res.msg,
                                timer: 3000
                            })
                        } else if (res.status == 200) {
                            Swal.fire({
                                icon: 'success',
                                title: 'SUCCESS',
                                text: res.msg,
                                timer: 2000
                            }).then(function() {
                                location.reload();
                            });
                        }
                    }
                });

            }


        })
    });
});