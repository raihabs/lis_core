
<?php

//process_data.php

$connect = new PDO("mysql:host=localhost;dbname=school_canteen1", "root", "");

if(isset($_POST["query"]))
{	

	$data = array();

	$condition = preg_replace('/[^A-Za-z0-9\- ]/', '', $_POST["query"]);

	$query = "SELECT dishes_name FROM dishes 
		WHERE CONCAT(dishes_name,c_name,d_image) LIKE '%$condition%' ORDER BY d_id DESC 
		LIMIT 10";


	$result = $connect->query($query);

	$replace_string = '<b>'.$condition.'</b>';

	foreach($result as $row)
	{
		$data[] = array(
			'productName'		=>	str_ireplace($condition, $replace_string, $row["dishes_name"])
		);
	}

	echo json_encode($data);
}

$post_data = json_decode(file_get_contents('php://input'), true);
if(isset($post_data['search_query']))
{

	$data = array(
		':search_query'		=>	$post_data['search_query']
	);

	$query = "
	SELECT search_id FROM recent_search 
	WHERE search_query = :search_query
	";

	$statement = $connect->prepare($query);

	$statement->execute($data);

	if($statement->rowCount() == 0)
	{
		$query = "INSERT INTO recent_search 
		(search_query) VALUES (:search_query)";

		$statement = $connect->prepare($query);

		$statement->execute($data);
	}

	$output = array(
		'success'	=>	true
	);

	echo json_encode($output);

}


if(isset($post_data['action']))
{
	if($post_data['action'] == 'fetch')
	{
		
		$query = "SELECT search_id,search_query,date,COUNT(*) as name_count FROM `recent_search`
		GROUP BY search_query
		ORDER BY `name_count` ASC LIMIT 6";

		// $query = "SELECT search_id, search_query, date, COUNT(*) as name_count FROM recent_search ORDER BY name_count DESC LIMIT 10";

		$result = $connect->query($query);

		$data = array();

		foreach($result as $row)
		{

			$data[] = array(
				'id'				=>	$row['search_id'],
				'search_query'		=>	$row["search_query"]
			);
		}

		echo json_encode($data);
	}

}
?>
