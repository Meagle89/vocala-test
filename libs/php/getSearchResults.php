<?php

include( "connectToDatabase.php" );

$searchData = $_POST['data'];

$query = "SELECT id, lastName, firstName, email, phone 
FROM contacts 
WHERE firstName LIKE '$searchData%' OR lastName LIKE '$searchData%'
OR email LIKE '%$searchData%' OR phone LIKE '%$searchData%' ORDER BY lastName, firstName";

$result = $conn->query( $query );

if ( $result->num_rows > 0 )
{
    while ( $row=$result->fetch_object() )
    {
?>

<div class="col-xs-12 col-sm-6 col-md-6 col-xl-4">
  <div class="card mb-1">
  <div class="card-body">
    <div class="list-group mt-1">
  <div class="list-group-item bg-white mt-1 mb-1">
    <div class="d-flex w-100 justify-content-between text-break">
    <div class="flex-grow-1 align-self-center">
    <h5 class="card-title font-weight-bold text-body">
        <?php echo $row->firstName; ?>
        <?php echo $row->lastName; ?>
        </h5>  
        <small class="card-subtitle"><?php echo $row->email; ?></small> <br />
        <small><?php if ( $row->phone == "" ) { echo "N/A"; } else { echo $row->phone; }?></small> <br />
        <small><?php if ( $row->email == "" ) { echo "N/A"; } else { echo $row->email; }; ?></small> <br />
    </div>
    </div>
    <a href="#" onclick ='getContact(this, appendEdit )'role="button" class="edit-contact" data-contactid="<?php echo $row->id ?>" data-toggle="modal" data-target="#edit-contact-modal">
    <i class="btn fas fa-user-edit float-right text-body"></i>  
  </a>
    <a href="#" onclick ='getContact(this, appendDeletMsg )' role="button" class="delete-contact" data-contactid="<?php echo $row->id ?>" data-toggle="modal" data-target="#delete-contact-modal" >
    <i class="btn fas fa-minus-circle float-right text-body"></i> 
  </a>
    </div>
  </div>
  </div>
  </div>
  </div>
  <?php }
  } else 
  { ?>
    <div class="col-xs-12 col-sm-6 col-md-6 col-xl-4">
  <div class="mb-1">
  <div class="bg-warning">
    <div class="mt-1">
  <div class="bg-warning mt-1 mb-1">
    <div class="d-flex w-100 justify-content-between text-break">
    <div class="flex-grow-1 align-self-center">
    <h3 class="text-body">No results</h3>
    </div>
    </div>
  </div>
  </div>
  </div>
  </div>
  </div>

<?php } 
mysqli_close($conn);
?>