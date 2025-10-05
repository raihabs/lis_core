<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>

<body onload="MyLoad();">
    <!-- <?php
            include 'config/config.php';
            ?>
    <table>
        <thead>


            <tr>
                <th><input type="checkbox" onclick="select_one()" id="delete1" /></th>
                <th>Amount 1</th>
                <th>Amount 2</th>
            </tr>
            </tfoot>

            <tr id="box1">
                <td><input type="checkbox" id="1" name="checkbox1[]" value="1" /></td>

                <td><input name="col1" type="number" class="ALG"></td>
                <td><input name="col2" type="number" class="ALG"></td>
            </tr>
            <tr id="box2">
                <td><input type="checkbox" id="2" name="checkbox1[]" value="2" /></td>

                <td><input name="col1" type="number" class="ALG"></td>
                <td><input name="col2" type="number" class="ALG"></td>
            </tr>


            </tfoot>
            <tr>
                <th><input type="checkbox" onclick="select_two()" id="delete2"></input></th>
                <td><input id="col1_total" name="col1" type="number" class="ALG"></td>
                <td><input id="col2_total" name="col2" type="number" class="ALG"></td>
            </tr>
        </thead>
    </table> -->


    <script>
        $(document).ready(function() {

            function calculateSum() {
                var sumTotal = 0;
                $(' tbody tr').each(function() {
                    var $tr = $(this);

                    if ($tr.find('input[type="checkbox"]').prop("checked")) {

                        var $columns = $tr.find('td').next('td').next('td');

                        var $Qnty = parseInt($tr.find('input[type="text"]').val());
                        var $Cost = parseInt($columns.next('td').html().split('P')[1]);
                        sumTotal += $Qnty * $Cost;
                    }
                });

                $("#price").val(sumTotal);

            }

            $('#sum').on('click', function() {
                calculateSum();
            });

            $("input[type='text']").keyup(function() {
                calculateSum();
            });

            $("input[type='checkbox']").change(function() {
                calculateSum();
            });



        });
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

    <?php
    $res1 = mysqli_query($db, "select * from student WHERE s_id = 1");
    ?>
    <table id="table">
    <tr style="background-color: #000;
                    width: 100%; padding: 40px; background: #0C0A4A; 
                    background: -webkit-linear-gradient(bottom left, #0C0A4A, #592F95); 
                    background: -moz-linear-gradient(bottom left, #0C0A4A, #592F95); 
                    background: linear-gradient(to top right, #0C0A4A, #592F95); color: #fff; font-size: 1.2em; height: 50px;">
            <th width="15%"></th>
            <th width="25%">Product</th>
            <th width="25%">Quantity</th>
            <th width="25%">Cost</th>
            <th width="25%">REMOVE</th>
        </tr>
        <tr >
            <th width="25%"></th>
            <th width="25%"></th>
            <th width="25%"></th>
            <th width="25%"></th>
            <th width="25%"></th>
        </tr>

        <?php
        session_start();
        $userId = $_SESSION['user_id'];
        $query = "SELECT c.crt_id as crtid, c.d_id, c.d_qty, d.d_id as did, d.dishes_name, d.c_name, d.d_image, d.original_price, d.selling_price, d.stock  
        FROM cart c, dishes d WHERE c.d_id = d.d_id AND c.u_id = '$userId' AND c.s_id = 1 AND stock > 0
        ORDER BY c.crt_id DESC";

        $items = mysqli_query($db, $query);
        foreach ($items as $citem) {
        ?>
            <tr id="box<?php echo $row1['id']; ?>">
                <td width="15%">
                    <center><input type="checkbox" id="<?php echo $row1['crtid']; ?>" name="chck1[]" value="<?php echo $citem['crtid']; ?>" /></center>
                </td>

                <td width="25%">
                    <center><img src="images/dishes/<?= $citem['d_image']; ?>" alt="" width="70" class="img-fluid rounded shadow-sm"></center>
                    <center><?= $citem['dishes_name']; ?></center>
                </td>
                <td width="25%" class="product_data">
                    <center> <button class="decrement-btn">
                            <center>-</center>
                        </button>
                        <input type="text" name="prod_qty2[]" class="input-qty bg-white" style="width:60px; font-size:1rem;" value="<?= $citem['d_qty'] ?>">
                        <button class="increment-btn">
                            <center>+</center>
                        </button>

                        <input type="hidden" class="form-control text-center input-stock bg-white" style="width:50px; font-size:1.5rem;" value="<?= $citem['stock'] ?>" disabled>
                        <!-- <input type="text" name="qnty" value="<?= $citem['d_qty'] ?>"></center></td> -->
                <td width="25%">
                    <center>P<?php echo $citem['selling_price']; ?></center>
                </td>
                <td width="25%">
                    <center>DELETE</center>
                </td>

            </tr>
        <?php
        }
        ?>
    </table>
    <!-- <?php
            $res2 = mysqli_query($con, "select * from student WHERE s_id = 2");
            ?>
    <table id="table">
        <tr style="background-color: silver;">
            <th><input type="checkbox" onclick="select_two()" id="delete2" /></th>
            <th>Estimate item</th>
            <th>Quantity</th>
            <th>Cost</th>
        </tr>

        <?php
        while ($row2 = mysqli_fetch_assoc($res2)) {
        ?>
            <tr id="box<?php echo $row2['id']; ?>">
                <td><input type="checkbox" id="<?php echo $row2['id']; ?>" name="chck2[]" value="<?php echo $row2['price']; ?>" /></td>
                <td>Remove Tile</td>
                <td><input type="text" name="qnty" value="1"></td>
                <td>$<?php echo $row2['price']; ?></td>
            </tr>
        <?php
        }
        ?>
    </table> -->

    <p>Calculated Price: $<input type="text" name="price" id="price" disabled /></p>

    <!-- function checkTotal() {
		document.listForm.total.value = '';
		var sum = 0;
		for (i=0;i<document.listForm.choice.length;i++) {
		  if (document.listForm.choice[i].checked) {
		  	sum = sum + parseInt(document.listForm.choice[i].value);
		  }
		}
		document.listForm.total.value = sum;
	}
</script>

<form name="listForm">
<input type="checkbox" name="choice" value="2" onchange="checkTotal()"/>2<br/>
<input type="checkbox" name="choice" value="5" onchange="checkTotal()"/>5<br/>
<input type="checkbox" name="choice" value="10" onchange="checkTotal()"/>10<br/>
<input type="checkbox" name="choice" value="20" onchange="checkTotal()"/>20<br/>
Total: <input type="text" size="2" name="total" value="0"/> -->
</body>

<script>
    function select_one() {
        var items1 = document.getElementsByName('chck1[]');
        if (jQuery('#delete1').prop("checked")) {
            jQuery(items1).each(function() {
                jQuery('#' + this.id).prop('checked', true);
            });
        } else {
            jQuery(items1).each(function() {
                jQuery('#' + this.id).prop('checked', false);
            });
        }
    }

    function select_two() {
        var items2 = document.getElementsByName('chck2[]');
        if (jQuery('#delete2').prop("checked")) {
            jQuery(items2).each(function() {
                jQuery('#' + this.id).prop('checked', true);
            });
        } else {
            jQuery(items2).each(function() {
                jQuery('#' + this.id).prop('checked', false);
            });
        }
    }

    // function MyLoad() {

    //     const cols = document.getElementsByClassName("ALG");


    //     for (let index = 0; index < cols.length; index++) {

    //         cols[index].addEventListener('change', function() {
    //             var ls_nm = cols[index].name;

    //             Total(ls_nm);
    //         });
    //     }

    // }

    // function Total(ls_nm) {

    //     var base = document.getElementsByName(ls_nm);
    //     var ls_sum = 0;

    //     for (let index = 0; index < base.length; index++) {

    //         var ls_base = base[index].value;

    //         ls_sum = +ls_sum + +ls_base;

    //     }
    //     document.getElementById(ls_nm + "_total").value = ls_sum;

    // }


    // //////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////


    $(document).ready(function() {
        $('.increment-btn').click(function(e) {
            e.preventDefault();

            var qty = $(this).closest('.product_data').find('.input-qty').val();
            var stock = $(this).closest('.product_data').find('.input-stock').val();
            var value = parseInt(qty, 10);
            value = isNaN(value) ? 0 : value;

            if (value < stock) {
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

            $.ajax({
                method: "POST",
                url: "handlecart.php",
                data: {
                    "prod_id": prod_id,
                    "prod_qty": qty,
                    "scope": "add"
                },
            });


        });
    });
</script>

</html>