<?php

include( 'connectToDatabase.php' );

$contactId = $_POST[ 'id' ];

$query = "DELETE FROM contacts WHERE id='$contactId'";

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

	$output['status']['code'] = "200";
	$output['status']['name'] = "ok";
	$output['status']['description'] = "contact deleted";
	$output['data'] = [];
	
	mysqli_close( $conn );

	echo json_encode( $output ); 

?>