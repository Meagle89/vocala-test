<?php

include("connectToDatabase.php");

$contactId = $_POST['id'];

$query = "SELECT firstName, lastName, email, phone FROM contacts WHERE id = $contactId";

$result = $conn->query( $query );
	
	if (!$result) {

		$output['status']['code'] = "400";
		$output['status']['name'] = "executed";
		$output['status']['description'] = "query failed";	
		$output['data'] = [];

		mysqli_close( $conn );

		echo json_encode( $output ); 

		exit;

	}

	$data = [];

	while ($row = mysqli_fetch_assoc($result)) {

		array_push($data, $row);

	}

	$output['status']['code'] = "200";
	$output['status']['name'] = "ok";
	$output['status']['description'] = "success";
	$output['data'] = $data;
	

	mysqli_close($conn);

	echo json_encode($output); 

?>