<?php 

include('connectToDatabase.php');

$firstName  = $_POST['firstName'];
$secondName = $_POST['secondName'];
$email      = $_POST['email'];
$phone      = $_POST['phone'];
$id         = $_POST['id'];

$query = "UPDATE
contacts
SET
firstName = '$firstName',
lastName  = '$secondName',
email     = '$email',
phone     = '$phone'
WHERE
`id`      = $id";

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
	$output['status']['description'] = "contact updated";
	
	mysqli_close($conn);

	echo json_encode($output); 

?>


