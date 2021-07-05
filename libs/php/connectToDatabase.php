<?php

include( "config.php" );

$conn = new mysqli( $cd_host, $cd_user, $cd_password, $cd_dbname, $cd_port, $cd_socket );

$executionStartTime = microtime(true);

if ( mysqli_connect_errno() )
{
    	$output['status']['code'] = "300";
		$output['status']['name'] = "failure";
		$output['status']['description'] = "database unavailable";
		$output['status']['returnedIn'] = (microtime(true) - $executionStartTime) / 1000 . " ms";

		mysqli_close($conn);

		echo json_encode($output);

		exit;

}

?>