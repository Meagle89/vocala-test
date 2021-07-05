<?php 

include("connectToDatabase.php");
include("verifyInput.php");

$firstName = $_POST['first-name'];
$lastName = $_POST['last-name'];
$email = $_POST['email'];
$phone = $_POST['phone'];

$query = "INSERT INTO `contacts`(`firstName`, `lastName`, `email`, `phone`) VALUES ('$firstName','$lastName','$email','$phone')";

$runQuery = $conn->query( $query );

if ( !$runQuery )
{
    $output['status']['code'] = "400";
    $output['status']['name'] = "executed";
	$output['status']['description'] = "failed";

	mysqli_close($conn);

	echo json_encode($output); 

	exit;
}

    $output['status']['code'] = "200";
	$output['status']['name'] = "ok";
	$output['status']['description'] = "contact added";
	
	mysqli_close($conn);

	echo json_encode($output); 

?>