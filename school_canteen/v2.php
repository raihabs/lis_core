<!DOCTYPE html>

<head>
    <title> test ! </title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="css/index.css" />
</head>
<html>

<body>
    Cash:
    <br>
    <input type="text" id="cash1">
    <br>
    Total Order1:
    <br>
    <input type="text" id="order1">
    <br>
    Cash:
    <br>
    <input type="text" id="cash2">
    <br>
    Total Order2:
    <br>
    <input type="text" id="order2">



    <h1>
        Orders:
    </h1>

    <div class="order">
        Change 1: <input type="text" id="innerdiv1" style="border-left:none;border-top:none;border-right:none;outline:0;" readonly>
    </div>
    <div class="order">
        Change 2: <input type="text" id="innerdiv2" style="border-left:none;border-top:none;border-right:none;outline:0;" readonly>
    </div>
    <div class="order">
        Change 1: <input type="text" id="innerdiv3" style="border-left:none;border-top:none;border-right:none;outline:0;" readonly>
    </div>
    <div class="order">
        Change 2: <input type="text" id="innerdiv4" style="border-left:none;border-top:none;border-right:none;outline:0;" readonly>
    </div>
    <div class="order">
        Change 1: <div id="innerdiv1"></div>
    </div>
    <button id="mybutton">
        click me
    </button>
    <script>
        document.getElementById("mybutton").addEventListener("click", function() {
            var cash1 = document.getElementById("cash1").value;
            var order1 = document.getElementById("order1").value;

            var cash2 = document.getElementById("cash2").value;
            var order2 = document.getElementById("order2").value;

            if (parseInt(cash1) > parseInt(order1)) {
                var change1 = parseInt(cash1) - parseInt(order1);
            } else {
                var change1 = "No Change";
            }
            if (parseInt(cash2) > parseInt(order2)) {
                var change2 = parseInt(cash1) - parseInt(order2);
            } else {
                var change2 = "No Change";
            }
            document.getElementById("innerdiv1").value = change1;
            document.getElementById("innerdiv2").value = change2;
            document.getElementById("innerdiv3").value = change1;
            document.getElementById("innerdiv4").value = change2;
        });
    </script>




    <input type="text" id="text" onInput="getValue()">
    <!-- <input type="text" id="result"> -->

    <span id="result"></span>
    <script>
        function getValue() {
            var txt = document.getElementById("text");
            var txtValue = txt.value;

            var result = document.getElementById("result");
            result.innerText = txtValue;
        }
    </script>


<label for="">Cash 1:</label>
    <input type="text" id="money1" name="">
    <br>
    <br>
    <br>
    <label for="">input cash 1:</label>
    <input type="text" onkeyup="cash1(this.value)">

    <br><br>

    <label for="">Change 1:</label>
    <input type="text" id="received1" name="">
    <br>
    <br>

    <label for="">printed order 1: </label>
    <input type="text" id="ordered1" name="">
    <br>
    <br>
    <script>
        function cash1(value1) {
            var order1 = document.getElementById("ordered1").value;

            total1 = value1 - order1;

            if (total1 > 0) {
                document.getElementById("received1").value = total1;
                document.getElementById("money1").value = total1;
            } else {
                document.getElementById("received1").value = "Try Higher Amount";
            }
        }
    </script>

    <label for="">Cash 2:</label>
    <input type="text" id="money2" name="">
    <br>
    <br>
    <br>
    <label for="">input cash 2:</label>
    <input type="text" onkeyup="cash2(this.value)">

    <br><br>

    <label for="">Change 2:</label>
    <input type="text" id="received2" name="">
    <br>
    <br>

    <label for="">printed order 2: </label>
    <input type="text" id="ordered2" name="">
    <br>
    <br>
    <script>
        function cash2(value2) {
            var order2 = document.getElementById("ordered2").value;

            total2 = value2 - order2;

            if (total2 > 0) {
                document.getElementById("received2").value = total2;
                document.getElementById("money2").value = total2;
            } else {
                document.getElementById("received2").value = "Try Higher Amount";
            }
        }
    </script>

</body>

</html>