
<?php
include("./libs/php/getAllContacts.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact App</title>
    <!-- Vendors -->
    <link rel="stylesheet" href="./vendors/node_modules/bootstrap/dist/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/84258c69f3.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./vendors/node_modules/bs4-toast/dist/toast.min.css" />
    <!-- Styles -->
    <link rel="stylesheet" href="./libs/css/styles.css">
</head>
<body class="bg-light">

    <nav class="navbar navbar-fill sticky-top navbar-light bg-light">
        <h5 class="title">Contacts</h5>
        <a class="btn" href="#" role="button" id="add-contact" data-toggle="modal" data-target="#add-contact-modal"><i class="fas fa-plus fa-2x"></i></a>
        <button class="btn navbar-toggler fas fa-ellipsis-v fa-2x" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item dropdown ">
                  <form class="form my-2 my-lg-0">
                      <input class="form-control mr-sm-2" id="contact-search" type="search" placeholder="Search" aria-label="Search">
                    </form>
              </li>
            </ul>
        </nav>
      
    <div class="container-fluid">
        <!-- Contact List -->
        <div class="container-fluid">
            <div class="row ml-1 mr-1">
            <div class="col bg-light">
              <div class="row display-contact">
              <?php while($row=$result->fetch_object()) { ?>
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
                <a href="#" role="button" class="edit-contact" data-contactid="<?php echo $row->id ?>" data-toggle="modal" data-target="#edit-contact-modal">
                <i class="btn fas fa-user-edit float-right text-body"></i> 
              </a>
                <a href="#" role="button" class="delete-contact" data-contactid="<?php echo $row->id ?>" data-toggle="modal" data-target="#delete-contact-modal" >
                <i class="btn fas fa-minus-circle float-right text-body"></i> 
              </a>
              </div>
              </div>
              </div>
              </div>
              </div>
              <?php }
              mysqli_close($conn);
              ?>
            </div>
            </div>
            </div>
            </div>
            </div>

            <!-- Add Contact Modal -->
            <div class="modal fade" id="add-contact-modal" tabindex="-1" role="dialog" aria-labelledby="add-contact-modal-center-title" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                    <div class="modal-header bg-light">
                      <h5 class="modal-title" id="add-contact-modal-center-title">Add Contact</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                    <form id="add-contact-form">
                    <div class="form-group">
                    <input type="text" class="form-control" id="first-name" name="first-name" placeholder="First Name" required>
                    </div>
                    <div class="form-group">
                    <input type="text" class="form-control" id="last-name" name="last-name" placeholder="Last Name" required>
                    </div>
                    <div class="form-group">
                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone Number" required>
                    </div>
                    <div class="form-group">
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                    </div>
                    </form>
                    </div>
                    <div class="modal-footer bg-light">
                      <button type="button" class="btn" data-dismiss="modal">Close</button>
                      <button type="submit" form="add-contact-form" class="btn" id="add-new-contact">Submit</button>
                    </div>
                  </div>
                </div>
              </div>

            <!-- Delete Contact Modal --> 
            <div class="modal fade" id="delete-contact-modal" tabindex="-1" role="dialog" aria-labelledby="delete-contact-modal-center-title" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-light">
                    <h5 class="modal-title" id="delete-contact-modal-center-title">Are you sure?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                    <form id="delete-contact-form">
                    <div class="form-group" id="delete-contact-name">
                    
                    </div>
                    </form>
                    </div>
                    <div class="modal-footer bg-light">
                    <button type="button" class="btn" data-dismiss="modal" id="cancel-delete">Cancel</button>
                    <button type="submit" form="delete-contact-form" class="btn" id="confirm-delete">Delete</button>
                    </div>
                </div>
                </div>
            </div>

            <!-- Edit Contact Modal --> 
            <div class="modal fade" id="edit-contact-modal" tabindex="-1" role="dialog" aria-labelledby="edit-contact-modal-center-title" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                    <div class="modal-header bg-light">
                      <h5 class="modal-title" id="edit-contact-modal-center-title">Edit Contact</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body display-edit">
                      <form id="edit-contact-form">
                        <div class="form-group">
                          <input type="text" class="form-control" id="edit-first" value="" placeholder="" required>
                        </div>
                        <div class="form-group">
                          <input type="text" class="form-control" id="edit-second" value="" placeholder="" required>
                        </div>
                        <div class="form-group">
                          <input type="text" class="form-control" id="edit-phone" value="" placeholder="" required>
                        </div>
                        <div class="form-group"> 	
                          <input type="email" class="form-control" id="edit-email" value="" placeholder="" required>
                        </div>
                      </form>
                    </div>
                    <div class="modal-footer bg-light">
                      <button type="button" class="btn" data-dismiss="modal">Close</button>
                      <button type="submit" form="edit-contact-form" class="btn" id="submit-edit">Submit</button>
                    </div>
                  </div>
                </div>
              </div>

            <!-- Vendor Scripts -->
    <script src="vendors/node_modules/jquery@2/jquery-2.2.3.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="vendors/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="vendors/node_modules/bs4-toast/dist/toast.min.js"></script>
            <!-- Local Scripts -->
    <script src="./libs/js/app.js"></script>
    
</body>
</html>