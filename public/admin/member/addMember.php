<?php
session_start();
if (isset($_SESSION['idUser']) && $_SESSION['userType'] == 'admin') {
    ?>
    <?php
    include('../includes/header.php');
    include('../../../private/conn.php');
    ?>

    <head>
    </head>
    <style>
        <?php
        include('../assets/css/section.css');
        include '../assets/css/addBooks.css';

        ?>
        #member {
            padding: 5px;
            border-bottom: 5px solid white;
        }
    </style>
    <center>

        <!--  -->
        <form method="post" action="code/addMemberCode.php" id="formValidation" >

            <h2><a href="index.php" style="margin-right: 30px;"><i class="fa fa-reply"></i></a> Add New Member</h2>
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
                <input type="number" name="codeUser" id="codeUser" placeholder="Enter Code User">
                <br>
                <span class="errorValidation" id="codeUserError"></span><br>
            </div>
            <div class="input-row">
                <label>First Name</label>
                <input type="text" name="firstName" id="firstName" placeholder="Enter First Name">
                <br>
                <span class="errorValidation" id="firstNameError"></span><br>
            </div>


            <div class="input-row">
                <label>Last Name</label>
                <input type="text" name="lastName" id="lastName" placeholder="Enter List Name">
                <br>
            </div>

            <div class="input-row">
                <label>Email</label>
                <input type="email" name="email" id="email" placeholder="Enter Email">
                <br>
            </div>

            <div class="input-row">
                <label>Phone</label>
                <input type="text" name="phone" id="phone" placeholder="Enter Phone">
                <br>
            </div>

            <div class="input-row">
                <label>Password</label>
                <input type="password" name="pw" placeholder="Enter password">
                <br>
            </div>


            <div class="input-row">
                <label>Date of birth</label>
                <input type="date" name="dateBirth" id="dateBirth">
                <br>
            </div>

            <div class="input-row">
                <label>Place of birth</label>
                <input type="text" name="placeBirth" id="" placeholder="Place of birth">
                <br>
            </div>


            <div class="input-row">
                <label>Image</label>
                <input type="file" name="my_image" value="" id="image" accept="image/*">
                <br>
            </div>


            <div class="input-row">
                <label>Adress</label>
                <input type="text" name="adress" id="" placeholder="Enter Adress">
                <br>
            </div>

            <div class="input-row">
                <label>User Type</label><br>
                <select name="userType" id="select">
                    <!-- <option selected>Choose User Type</option>  -->
                    <option value="student">Student</option>
                    <option value="prof">Prof</option>
                </select>
                <br>
            </div>

            <div class="input-row">
                <label>Speciality</label><br>
                <select name="speciality" id="select">
                    <!-- <option selected>Choose Speciality</option>  -->
                    <option value="MI">MI</option>
                    <option value="SM">SM</option>
                    <option value="Computer Science">Computer Science</option>
                    <option value="Maths">Maths</option>
                    <option value="Physics">Physics</option>
                    <option value="Chemistry">Chemistry</option>
                </select>
                <br>
            </div>

            <div class="input-row">
                <label>Level</label><br>
                <select name="level" id="select">
                    <option value="">Choose Level</option> 
                    <option value="L1">L1</option>
                    <option value="L2">L2</option>
                    <option value="L3">L3</option>
                    <option value="L4">L4</option>
                    <option value="M1">M1</option>
                    <option value="M2">M2</option>
                </select>
                <br>
            </div>


            <button type="submit" name="add">ADD</button>
            <div style="margin: 50px;"></div>
            <!-- <a href="#"></a> -->
        </form>
    </center>
    <div style="margin: 100px"></div>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script> 
   <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
    <script src="../assets/js/addMemberValidation.js"></script>
    <?php


    ?>






    <!-- <script type="text/javascript">      $(".chosen").chosen();
        document.getElementById('formValidation').addEventListener('submit', function (event) {
            event.preventDefault(); // Prevent the form from submitting

            // Call the validateInputs function
            if (validateInputs()) {
                this.submit(); // Submit the form if validation succeeds
            }
        });


        const codeUser = document.getElementById('codeUser');
        const errorDisplayCodeUser = document.getElementById('codeUserError');


        const firstName = document.getElementById('firstName');
        const errorDisplayFirstName = document.getElementById('firstNameError');


        function validateInputs() {
            const firstNameValue = firstName.value.trim();
            const codeUserValue = codeUser.value.trim();
            var valid = 0;
            if (codeUserValue === '') {
                errorDisplayCodeUser.innerText = 'Code user is required';
                codeUser.style.border = '1px solid red';

            } else {
                errorDisplayCodeUser.innerText = '';
                codeUser.style.border = '1px solid green';
                valid = valid + 1;
            }

            if (firstNameValue === '') {
                errorDisplayFirstName.innerText = 'Code user is required';
                firstName.style.border = '1px solid red';

            } else {
                errorDisplayFirstName.innerText = '';
                firstName.style.border = '1px solid green';
                valid = valid + 1;
            }



            if (valid === 2) {
                return true;
            } else {
                return false;
            }
        };
    </script>
   
   
    -->
   
   <?php
    include('../includes/scripts.php');
?>
<?php
} else {
    header("Location: ../../home/index.php");
    exit();
}
?>