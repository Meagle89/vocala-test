<?php

include("connectToDatabase.php");


$query = "SELECT `id`, `firstName`, `lastName`, `email`, `phone` FROM `contacts` ORDER BY `lastName`, `firstName`";

$result = $conn->query($query);

if ( !$result )
{
  mysqli_close($conn);
  exit( "query failed" );
}
?>
