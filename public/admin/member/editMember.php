<?php
session_start();
if (isset($_SESSION['idUser']) && $_SESSION['userType'] == 'admin') {
  ?>
  <?php
  include('../includes/header.php');
  include('../../../private/conn.php');
  ?>

  <head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/themes/smoothness/jquery-ui.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.css">
  </head>
  <style>
    <?php include('../assets/css/section.css');
    include '../assets/css/addBooks.css';
    ?>
    #member {
      padding: 5px;
      border-bottom: 5px solid white;
    }
  </style>
  <center>
    <?php
    if (isset($_POST['edit_btn'])) {
      $idUser = $_POST['edit_id'];
      $query = "SELECT * FROM users WHERE  idUser='$idUser'";
      $query_run = mysqli_query($conn, $query);
      foreach ($query_run as $row) {
        ?>

        <form action="code/editMemberCode.php" method="post" id="formValidation">
          <input type="hidden" name="edit_idUser" value="<?php echo $row['idUser'] ?>">

          <h2><a href="index.php" style="margin-right: 30px;"><i class="fa fa-reply"></i></a> Edit Member's Information</h2>
          <?php if (isset($_GET['error'])) { ?>
            <p class="error">
              <?php echo $_GET['error']; ?>
            </p>
          <?php } ?>

          <?php if (isset($_GET['success'])) { ?>
            <p class="success">
              <?php echo $_GET['success']; ?>
            </p>
          <?php } ?>
          <div class="input-row">
            <label>Code User</label>
            <input type="number" name="codeUser" id="codeUser" value="<?php echo $row['codeUser'] ?>">
            <br>
          </div>

          <label>First Name</label>
          <input type="text" name="firstName" id="firstName" value="<?php echo $row['firstName'] ?>">
          <br>

          <label>Last Name</label>
          <input type="text" name="lastName" id="lastName" value="<?php echo $row['lastName'] ?>">
          <br>


          <label>Email</label>
          <input type="email" name="email" id="email" value="<?php echo $row['email'] ?>">
          <br>
          <label>Phone</label>
          <input type="text" name="phone" id="phone" value="<?php echo $row['phone'] ?>">
          <br>

          <label>Image</label>
          <input type="file" name="image" id="">
          <!-- 
        <label >Password</label>
        <input type="text" name="pw" value="">
              <br> -->

          <label>Date of birth</label>
          <input type="date" name="dateBirth" id="dateBirth" value="<?php echo $row['dateOfBirth'] ?>">
          <br>

          <label>Place of birth</label>
          <input type="text" name="placeBirth" id="" value="<?php echo $row['PlaceOfBirth'] ?>">
          <br>


          <label>Adress</label>
          <input type="text" name="adress" id="" value="<?php echo $row['adress'] ?>">
          <br>


          <div class="input-row">
                <label>User Type</label><br>
                <select name="userType" id="select">
                    <option <?php echo $row['userType'] ?>><?php echo $row['userType'] ?></option> 
                    <option value="student">Student</option>
                    <option value="prof">Prof</option>
                </select>
                <br>
            </div>

          <label>Speciality</label><br>
          <select name="speciality" id="select" value="<?php echo $row['specialty'] ?>">
            <option value="<?php echo $row['specialty'] ?>"><?php echo $row['specialty'] ?></option>
            <option value="MI">MI</option>
            <option value="SM">SM</option>
            <option value="Computer Science">Computer Science</option>
            <option value="Maths">Maths</option>
            <option value="Physics">Physics</option>
            <option value="Chemistry">Chemistry</option>
            <option value="">Choose</option> 
          </select>
          <br>

          <label>Level</label><br>
          <select name="level" id="select" value="<?php echo $row['level'] ?>">
            <option value="<?php echo $row['level'] ?>"><?php echo $row['level'] ?></option>
            <option value="L1">L1</option>
            <option value="L2">L2</option>
            <option value="L3">L3</option>
            <option value="L4">L4</option>
            <option value="M1">M1</option>
            <option value="M2">M2</option>
          </select>
          <br>

          <div style="margin: 30px;"></div>

          <button type="submit" name="edit">Edit</button>
          <div style="margin: 50px;"></div>
          <!-- <a href="#"></a> -->
        </form>
        <div style="margin: 100px;"></div>
        <?php
      }
    }
    ?>
  </center>
  <?php


  ?>

<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
    <script src="../assets/js/addMemberValidation.js"></script>





  <script type="text/javascript">
    $(".chosen").chosen();
  </script>
  <?php
  include('../includes/scripts.php');
?>
<?php
} else {
  header("Location: ../../home/index.php");
  exit();
}
?>