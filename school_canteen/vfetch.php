
<?php

//fetch.php

$connect = new PDO("mysql:host=localhost;dbname=school_canteen1", "root", "");

$column = array('firstname' ,'lastname' , 'dishes_name', 'd_qty',  'date', 'selling_price');

$query = "
SELECT * FROM users_orders WHERE s_id = 1 AND";


if(isset($_POST["is_days"]))
{
 $query .= "date BETWEEN CURDATE() - INTERVAL ".$_POST["is_days"]." DAY AND CURDATE() AND ";
}

$query .= ' firstname LIKE "%'.$_POST["search"]["value"].'%" 
OR dishes_name LIKE "%'.$_POST["search"]["value"].'%" 
OR date LIKE "%'.$_POST["search"]["value"].'%" 
OR selling_price LIKE "%'.$_POST["search"]["value"].'%" 

';

if(isset($_POST["order"]))
{
 $query .= 'ORDER BY '.$column[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' ';
}
else
{
 $query .= 'ORDER BY o_id DESC ';
}

$query1 = '';

if($_POST["length"] != -1)
{
 $query1 = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}

$statement = $connect->prepare($query);

$statement->execute();

$number_filter_row = $statement->rowCount();

$statement = $connect->prepare($query . $query1);

$statement->execute();

$result = $statement->fetchAll();

$data = array();

$total_order = 0;

foreach($result as $row)
{
 $sub_array = array();
 $sub_array[] = $row["order_code"];
 $sub_array[] = $row["firstname"]." ".$row["lastname"];
 $sub_array[] = $row["dishes_name"];
 $sub_array[] = $row["d_qty"];
 $sub_array[] = $row["status"];
 $sub_array[] = $row["date"];
 $sub_array[] = $row["selling_price"];

 $total_order = $total_order + floatval($row["selling_price"]);
 $data[] = $sub_array;
}

function count_all_data($connect)
{
 $query = "SELECT * FROM users_orders";
 $statement = $connect->prepare($query);
 $statement->execute();
 return $statement->rowCount();
}

$output = array(
 'draw'    => intval($_POST["draw"]),
 'recordsTotal'  => count_all_data($connect),
 'recordsFiltered' => $number_filter_row,
 'data'    => $data,
 'total'    => number_format($total_order, 2)
);

echo json_encode($output);


?>
