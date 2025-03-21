<?php
  include('partials\header.php');
  include('partials\sidebar.php');
  include('database\database.php');
  
  //$sql = "SELECT * FROM students";
  //$result = $conn->query($sql);
  

  // Your PHP BACK CODE HERE
  $search = "";
if (isset($_GET['search'])) {
    $search = $_GET['search'];
    $sql = "SELECT * FROM students 
            WHERE firstname LIKE '%$search%' 
            OR lastname LIKE '%$search%' 
            OR middlename LIKE '%$search%' 
            OR suffix LIKE '%$search%' 
            OR age LIKE '%$search%' 
            OR program LIKE '%$search%'
            OR year LIKE '%$search%'";
} else {
    $sql = "SELECT * FROM students";
}
$result = $conn->query(query: $sql);

?>
 <main id="main" class="main">
  
    <div class="pagetitle">
      <h1>Student Management System
      </h1>
      <!-- <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item">Tables</li>
          <li class="breadcrumb-item active">General</li>
        </ol>
      </nav> -->
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <div class="d-flex justify-content-between">
                <div>
                  <h5 class="card-title">Record Table</h5>
                </div>
                <div>
                  <button  type="button" class="btn btn-primary btn-sm mt-4 mx-3" data-bs-toggle="modal" data-bs-target="#addStudentModal">Add Record</button>
                </div>

              </div>

              <!-- Default Table -->
 
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">Middle Name</th>
                    <th scope="col">Suffix</th>
                    <th scope="col">Age</th>
                    <th scope="col">Program</th>
                    <th scope="col">Year</th>
                    <th scope="col" class="text-center">Action</th>
                  </tr>
                </thead>
  <tbody>
    <?php if ($result->num_rows > 0): ?>
      <?php while($row = $result->fetch_assoc()): ?>
        <tr>
          <td><?= $row['id'] ?></td>
          <td><?= $row['firstname'] ?></td>
          <td><?= $row['lastname'] ?></td>
          <td><?= $row['middlename'] ?></td>
          <td><?= $row['suffix'] ?></td>
          <td><?= $row['age'] ?></td>
          <td><?= $row['program'] ?></td>
          <td><?= $row['year'] ?></td>
          <td class="text-center">
            <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#viewStudentModal" 
                    data-id="<?= $row['id'] ?>"
                    data-firstname="<?= $row['firstname'] ?>"
                    data-lastname="<?= $row['lastname'] ?>"
                    data-middlename="<?= $row['middlename'] ?>"
                    data-suffix="<?= $row['suffix'] ?>"
                    data-age="<?= $row['age'] ?>"
                    data-program="<?= $row['program'] ?>"
                    data-year="<?= $row['year'] ?>">View</button>
            <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editStudentModal" 
                    data-id="<?= $row['id'] ?>"
                    data-firstname="<?= $row['firstname'] ?>"
                    data-lastname="<?= $row['lastname'] ?>"
                    data-middlename="<?= $row['middlename'] ?>"
                    data-suffix="<?= $row['suffix'] ?>"
                    data-age="<?= $row['age'] ?>"
                    data-program="<?= $row['program'] ?>"
                    data-year="<?= $row['year'] ?>">Edit</button>
            <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteStudentModal" data-id="<?= $row['id'] ?>">Delete</button>
          </td>
        </tr>
      <?php endwhile; ?>
    <?php else: ?>
      <tr>
        <td colspan="8" class="text-center">No record found</td>
      </tr>
    <?php endif; ?>
  </tbody>
</table>



    </div>

      <!-- Modal -->
      <div class="modal fade" id="editInfo" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editInfoLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="editInfoLabel">Employee Information</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              ...
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
    </section>

  </main><!-- End #main -->
  <!-- Add Student Modal -->
<div class="modal fade" id="addStudentModal"  tabindex="-1" aria-labelledby="addStudentModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addStudentModalLabel">Add New Student</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="post" action="database/create.php">
          <div class="form-group">
            <label for="firstname">Firstname:</label>
            <input type="text" class="form-control" id="firstname" name="firstname" required>
          </div>
          <div class="form-group">
            <label for="lastname">Lastname:</label>
            <input type="text" class="form-control" id="lastname" name="lastname" required>
          </div>
          <div class="form-group">
            <label for="middlename">Middlename:</label>
            <input type="text" class="form-control" id="middlename" name="middlename" required>
          </div>
          <div class="form-group">
            <label for="suffix">Suffix:</label>
            <input type="text" class="form-control" id="suffix" name="suffix" >
          </div>
          <div class="form-group">
            <label for="age">Age:</label>
            <input type="text" class="form-control" id="age" name="age" required>
          </div>
          <div class="form-group">
            <label for="course">Course:</label>
            <select class="form-control" id="course" name="course" required>
              <option value="BSIS">BSIS</option>
              <option value="BSIT">BSIT</option>
              <option value="BSCS">BSCS</option>
              <option value="BTVTED">BTVTED</option>
            </select>
          </div>
          <div class="form-group">
            <label for="year">Year:</label>
            <input type="text" class="form-control" id="year" name="year" required>
          </div>

          <button type="submit" class="btn btn-primary mt-3">Add Student</button><br>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </form>
      </div>
    </div>
  </div>
</div>
 <!-- View Student Modal -->
<div class="modal fade" id="viewStudentModal" tabindex="-1" aria-labelledby="viewStudentModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="viewStudentModalLabel">View Student</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Student Information Fields -->
        <p><strong>ID:</strong> <span id="view-id"></span></p>
        <p><strong>First Name:</strong> <span id="view-firstname"></span></p>
        <p><strong>Last Name:</strong> <span id="view-lastname"></span></p>
        <p><strong>Middle Name:</strong> <span id="view-middlename"></span></p>
        <p><strong>Suffix:</strong> <span id="view-suffix"></span></p>
        <p><strong>Age:</strong> <span id="view-age"></span></p>
        <p><strong>Program:</strong> <span id="view-program"></span></p>
        <p><strong>Year:</strong> <span id="view-year"></span></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>



<!-- Edit Student Modal -->
<div class="modal fade" id="editStudentModal" tabindex="-1" aria-labelledby="editStudentModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editStudentModalLabel">Edit Info</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="edit-student-form" method="post" action="database/update.php">
          <input type="hidden" name="id" id="edit-id">

          <div class="mb-3">
            <label for="edit-firstname" class="form-label">First Name</label>
            <input type="text" class="form-control" name="firstname" id="edit-firstname" required>
          </div>

          <div class="mb-3">
            <label for="edit-lastname" class="form-label">Last Name</label>
            <input type="text" class="form-control" name="lastname" id="edit-lastname" required>
          </div>

          <div class="mb-3">
            <label for="edit-middlename" class="form-label">Middle Name</label>
            <input type="text" class="form-control" name="middlename" id="edit-middlename" required>
          </div>

          <div class="mb-3">
            <label for="edit-suffix" class="form-label">Suffix</label>
            <input type="text" class="form-control" name="suffix" id="edit-suffix" >
          </div>

          <div class="mb-3">
            <label for="edit-age" class="form-label">Age</label>
            <input type="text" class="form-control" name="age" id="edit-age" required>
          </div>

          <div class="mb-3">
            <label for="edit-program" class="form-label">Program</label>
            <select class="form-control" id="program" name="program" required>
              <option value="BSIS">BSIS</option>
              <option value="BSIT">BSIT</option>
              <option value="BSCS">BSCS</option>
              <option value="BTVTED">BTVTED</option>
            </select>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Update</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>


<!-- Delete Student Modal -->
<div class="modal fade" id="deleteStudentModal" tabindex="-1" aria-labelledby="deleteStudentModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteStudentModalLabel">Delete Record</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to delete this record?</p>
      </div>
      <div class="modal-footer">
        <form id="delete-student-form" method="post" action="database/delete.php">
          <input type="hidden" name="id" id="delete-id">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-danger">Delete</button>
        </form>
      </div>
    </div>
  </div>
</div>



<!-- Include Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Include external JS file -->
<script src="assets/js/modal.js"></script>



<?php
include('partials\footer.php');
?>