
<?php
//fetch.php
$connect = mysqli_connect("localhost", "root", "", "school_canteen1");
$column = array("firstname", "dishes_name",  "selling_price","date");
$query = "
 SELECT * FROM users_orders WHERE s_id = 1 AND
";

if(isset($_POST["is_days"]))
{
 $query .= "date BETWEEN CURDATE() - INTERVAL ".$_POST["is_days"]." DAY AND CURDATE() AND ";
}

if(isset($_POST["search"]["value"]))
{
 $query .= '(firstname LIKE "%'.$_POST["search"]["value"].'%" ';
 $query .= 'OR dishes_name LIKE "%'.$_POST["search"]["value"].'%" ';
 $query .= 'OR date LIKE "%'.$_POST["search"]["value"].'%") ';
 $query .= 'OR selling_price LIKE "%'.$_POST["search"]["value"].'%" ';
}

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
 $query1 .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}

$number_filter_row = mysqli_num_rows(mysqli_query($connect, $query));

$result = mysqli_query($connect, $query . $query1);

$data = array();

while($row = mysqli_fetch_array($result))
{
 $sub_array = array();
 $sub_array[] = $row["firstname"];
 $sub_array[] = $row["dishes_name"];
 $sub_array[] = $row["date"];
 $sub_array[] = $row["selling_price"];
 $data[] = $sub_array;
}

function get_all_data($connect)
{
 $query = "SELECT * FROM users_orders";
 $result = mysqli_query($connect, $query);
 return mysqli_num_rows($result);
}

$output = array(
 "draw"    => intval($_POST["draw"]),
 "recordsTotal"  =>  get_all_data($connect),
 "recordsFiltered" => $number_filter_row,
 "data"    => $data
);

echo json_encode($output);



?>
