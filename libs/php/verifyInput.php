<?php 

ini_set('display_errors', 'On');    
error_reporting(E_ALL);


$formData = $_POST;


foreach ( $formData as $input ) 
{
    if ( $input == "" || ctype_space( $input ) )
    {
    $output['status']['code'] = "400";
    $output['status']['name'] = "bad request";
	$output['status']['description'] = "invalid input";

	echo json_encode($output); 

	exit;
    }
}



?>