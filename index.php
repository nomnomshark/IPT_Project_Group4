<?php
 session_start();
  include('database\database.php');
  include('partials\header.php');
  include('partials\sidebar.php');
  

  $sql = "SELECT * FROM tbstudents WHERE IS ARCHIVED = 0 AND STATUS = 1";
  // Your PHP BACK CODE HERE

  $tbstudents = $conn->query($sql);
  $status = '';
  if (isset($_SESSION['status'])) {
    $status = $_SESSION['status'];
    unset($_SESSION['status']);
  }
?>

  <main id="main" class="main">
  <!--ALLLLLEEEEEEERRRRRTT-->
    <?php if ($status == 'created'): ?>
      <div class="alert alert-success alert-dismissable fade show" role="alert">
        Student record Created Successfully.
        <button type="button" class="btn btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    <?php elseif ($status == 'updated'): ?>
      <div class="alert alert-success alert-dismissable fade show" role="alert">
        Student record Updated Successfully.
        <button type="button" class="btn btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    <?php elseif ($status == 'error'): ?>
      <div class="alert alert-success alert-dismissable fade show" role="alert">
        An Error Occured.
        <button type="button" class="btn btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    <?php if ($status == 'deleted'): ?>
      <div class="alert alert-success alert-dismissable fade show" role="alert">
        Employee record Deleted Successfully.
        <button type="button" class="btn btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    <?php endif; ?>
    <!--ALLLLLEEEEEEERRRRRTT ENNNNND-->


    <div class="pagetitle">
      <h1>Employee Information Management System</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item">Tables</li>
          <li class="breadcrumb-item active">General</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <div class="d-flex justify-content-between">
                <div>
                  <h5 class="card-title">Default Table</h5>
                </div>
                <div>
                  <button class="btn btn-primary btn-sm mt-4 mx-3" data-bs-toggle="modal" data-bs-target="#editInfo">
                    Add Employee
                  </button>
                </div>
              </div>

              <!-- MUST BE CONNECTED TO THE TABLE IN DATABASE -->
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Full Name</th>
                    <th scope="col">Suffix</th>
                    <th scope="col">Age</th>
                    <th scope="col">Program</th>
                    <th scope="col">Year</th>
                    <th scope="col" class="text-center">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if ($tbstudents->num_rows > 0): ?>
                    <?php while ($row = $tbstudents->fetch_assoc())?>
                      <tr>
                        <th scope="row"><?php echo= $row['id']; ?></th>
                        <td><?php echo= $row['firstname']. " ".$row['lastname']. " ".$row['middlename'];?></td>
                        <td><?php echo= $row['suffix'];?></td>
                        <td><?php echo= $row['age'];?></td>
                        <td><?php echo= $row['program'];?></td>
                        <td><?php echo= $row['year'];?></td>
                        <td class="d-flex justify-content-center">
                          <button class="btn btn-success btn-sm mx-1" data-bs-target="#edit">Edit</button>
                          <button class="btn btn-primary btn-sm mx-1" title="View Employee Information" data-bs-toggle="modal" data-bs-target="#view">View</button>
                          <button class="btn btn-danger btn-sm mx-1" data-bs-target="#delete">Delete</button>
                        </td>
                      </tr>
                    <?php endwhile; ?>
                  <?php else; ?>
                    <tr>
                      <td colspan="6" class="text-center">No Employees Found</td>
                    </tr>
                  <?php endif; ?>
                </tbody>
              </table>
              <!-- End Default Table Example -->
            </div>
              <!--page navigation-->
            <div class="mx-4">
              <nav aria-label="Page navigation example">
                <ul class="pagination">
                  <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                  <li class="page-item"><a class="page-link" href="#">1</a></li>
                  <li class="page-item"><a class="page-link" href="#">2</a></li>
                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                  <li class="page-item"><a class="page-link" href="#">Next</a></li>
                </ul>
              </nav>  
            </div>
          </div>

        </div>

        
      </div>

      <!-- ADD EMPLYOEE MODAL -->
      <div class="modal fade" id="editInfo" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editInfoLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <!-- FORM -->
          <form action="database/create.php" method="POST">
            <div class="modal-content">
              <!--MODAL HEADER-->
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="editInfoLabel">Employee Information</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <!--MODAL BODY-->
              <div class="modal-body">
                <div class="names mb-4">
                  <label for="firstname" class="form-label">Name</label>
                  <input type="text" name="firstname" class="form-control" id="firstname" placeholder="First Name">
                </div>
                <div class="names mb-4" >
                  <label for="lastname" class="form-label">Last Name</label>
                  <input type="text" name="lastname" class="form-control" id="lastname" placeholder="Last Name">
                </div>
                <div class="names mb-4" >
                  <label for="middlename" class="form-label">Middle Name</label>
                  <input type="text" name="middlename" class="form-control" id="middlename" placeholder="Middle Name">
                </div> 
                <div class="names mb-4" >
                  <label for="suffix" class="form-label">Suffix</label>
                  <input type="text" name="suffix" class="form-control" id="suffix" placeholder="Suffix">
                </div>
                <div class="names mb-4" >
                  <label for="age" class="form-label">Age</label>
                  <input type="number" step="1" min="0" max="150" name="age" class="form-control" id="age" placeholder="Age">
                </div>
                <div class="names mb-4" >
                  <label for="program" class="form-label">Program</label>
                  <input type="text" name="age" class="form-control" id="program" placeholder="Program">
                </div>
                <div class="names mb-4" >
                  <label for="year" step="1" min="0" max="10" class="form-label">Year</label>
                  <input type="number" name="year" class="form-control" id="year" placeholder="Year">
                </div>
              </div>
              <!--MODAL FOOTER-->
              <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              </div>
            </div>
          </form>
        </div>
      </div>




                    
        <!--EDIT MOOOOOOOOOOOOOOOOOOOOOODDDDDDDAL-->
      <div class="modal fade" id="edit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editInfoLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <!-- FORM -->
          <form action="database/update.php" method="POST">
            <div class="modal-content">
              <!--MODAL HEADER-->
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="editInfoLabel">Student Information</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <!--MODAL BODY-->
              <div class="modal-body">
                <div>
                  <label for="id" class="form-label">ID</label> 
                  <input type="text" name="id" class="form-control" id="id" placeholder="id">
                </div>
                <div class="names mb-4">
                  <label for="firstname" class="form-label">Name</label>
                  <input type="text" name="firstname" class="form-control" id="firstname" placeholder="First Name">
                </div>
                <div class="names mb-4" >
                  <label for="lastname" class="form-label">Last Name</label>
                  <input type="text" name="lastname" class="form-control" id="lastname" placeholder="Last Name">
                </div>
                <div class="names mb-4" >
                  <label for="middlename" class="form-label">Middle Name</label>
                  <input type="text" name="middlename" class="form-control" id="middlename" placeholder="Middle Name">
                </div> 
                <div class="names mb-4" >
                  <label for="suffix" class="form-label">Suffix</label>
                  <input type="text" name="suffix" class="form-control" id="suffix" placeholder="Suffix">
                </div>
                <div class="names mb-4" >
                  <label for="age" class="form-label">Age</label>
                  <input type="number" step="1" min="0" max="150" name="age" class="form-control" id="age" placeholder="Age">
                </div>
                <div class="names mb-4" >
                  <label for="program" class="form-label">Program</label>
                  <input type="text" name="age" class="form-control" id="program" placeholder="Program">
                </div>
                <div class="names mb-4" >
                  <label for="year" step="1" min="0" max="10" class="form-label">Year</label>
                  <input type="number" name="year" class="form-control" id="year" placeholder="Year">
                </div>
              </div>
              <!--MODAL FOOTER-->
              <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              </div>
            </div>
          </form>
        </div>
      </div>


                  <!--FOR DELETING MODAL-->
      <div class="modal fade" id="editInfo" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editInfoLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
              <!--MODAL BODY-->
            <div class="modal-body">
              <h1 class="text-danger" style="font-size:50px"><strong>!</strong></h1>
              <h5>Are you sure you want to delete this student?</h5>
              <h6>This action cannot be undone.</h6>
            </div>
              <!--MODAL FOOTER-->
            <div class="modal-footer d-flex justify-content-center">
              <form action="database\delete.php" method="POST">
                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Yes, Delete</button>
              </form>
            </div>
          </div>
        </div>
      </div>

         <!--FOR VIEWING MODAL-->
      <div class="modal fade" id="editInfo" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editInfoLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
              <!--MODAL HEADER-->
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="editInfoLabel">Student Information</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
              <!--MODAL BODY-->
            <div class="modal-body">
            </div>
              <!--MODAL FOOTER-->
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>

      
    </section>

  </main><!-- End #main -->
<?php
include('partials\footer.php');
?>