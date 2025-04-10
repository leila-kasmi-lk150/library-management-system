<?php
session_start();
if (isset($_SESSION['idUser']) && $_SESSION['userType']=='admin') {
  ?>
  <?php
include('../includes/header.php');
include('../../../private/conn.php');
?>
<style>
    <?php include('../assets/css/section.css'); 
     include '../assets/css/addBooks.css';
        ?>
       
</style>
<?php
    if (isset($_POST['add_book'])) {
        $idCategorie = $_POST['idCategorie'];

        if ($idCategorie=='1') {
            ?>
            <style>
                #info{
                    padding: 5px;
                    border-bottom: 5px solid white;
                }
            </style>
            <?php
        } else if ($idCategorie=='2') {
            ?>
            <style>
                #maths{
                    padding: 5px;
                    border-bottom: 5px solid white;
                }
            </style>
            <?php
        } else if ($idCategorie=='3') {
            ?>
            <style>
                #physics{
                    padding: 5px;
                    border-bottom: 5px solid white;
                }
            </style>
            <?php
        }else if ($idCategorie=='4') {
            ?>
            <style>
                #chemistry{
                    padding: 5px;
                    border-bottom: 5px solid white;
                }
            </style>
            <?php
        }
        ?>
        <center>
        <form action="code/addGPcode.php" method="post" enctype="multipart/form-data" id="formValidation">
             <h2><a href="graduationProject.php?idCategorie=<?php echo $idCategorie; ?>" style="margin-right: 30px;"><i class="fa fa-reply"></i></a> Add New Graduation Project</h2>
             <?php if (isset($_GET['error'])) { ?>
     		    <p class="error"><?php echo $_GET['error']; ?></p>
     	    <?php } ?>

     	    <?php if (isset($_GET['success'])) { ?>
                <p class="success"><?php echo $_GET['success']; ?></p>
            <?php } ?>

            <input type="hidden" name="idCategorie" value="<?php echo $idCategorie; ?>">

            <div class="input-row">
                <label>Titel</label>
                <input type="text" name="titel" placeholder="Enter The Titel" value="" required>
                <br>
            </div>

            <div class="input-row">
                <label>Author 1</label>
                <input type="text" name="author1" placeholder="Enter Author" value="" required>
                <br>
            </div>
            <div class="input-row">
                <label>Code User 1</label>
                <input type="number" name="codeUser1" placeholder="Enter Code User" value="" >
                <br>
            </div>
            <br>
            <div class="input-row">
                <label>Author 2</label>
                <input type="text" name="author2" placeholder="Enter Author 2" value="" >
                <br>
            </div>
            <div class="input-row">
                <label>Code User 2</label>
                <input type="number" name="codeUser2" placeholder="Enter Code User 2" value="" >
                <br>
            </div>
        <br>
        
        <div class="input-row">
            <label >Summary</label>
            <textarea name="summary" placeholder="Summary" id=""></textarea>
            <br>
        </div>

        <div class="input-row">
            <label >Level</label><br>
            <select name="level" id="select">
                <option value="bachelors">Bachelors</option>
                <option value="master">Master</option>
            </select>
            <br>
        </div>
     	<br>
         <div class="input-row">
            <label >Year</label><br>
                <select class="form-control" name="year" id="select">
                    <?php
                        for ($year = (int)date('Y'); 1900 <= $year; $year--): ?>
                            <option value="<?php echo $year;?>"><?=$year;?></option>
                    <?php endfor; ?>
                </select>
            <!-- <input type="date" date="year" name="date_of_publisher"  placeholder="Date Of Publisher" value=""> -->
            <br>
        </div>

        <label >Language</label> <br>
        <!-- <div class="selectDiv"> -->
            <select style="width: 60%;"  name="language"  id="select" required > <!-- class="chosen" -->
                <?php
                    $query_language = "SELECT * FROM language";
                    $query_run_language = mysqli_query($conn, $query_language);
                    if(mysqli_num_rows($query_run_language) > 0)        
                        {
                            while($row_language = mysqli_fetch_assoc($query_run_language))
                                {
                ?>
                <option value="<?php echo $row_language['language']; ?>"><?=$row_language["language"]?></option>
                <?php
                                } 
                        }
                    else {
                            echo "No Record Found";
                        }
                ?>
            </select>
            <a  class="addOption" onclick="show_language()"><i class="fa fa-plus"></i></a>
            <div class="wrapper" id="wrapper_language">
                <div class="content_language">
                    <div class="input-row">
                        <label >Add language</label>
                        <input type="text" name="language2" id="language2" placeholder="Add language" style="text-transform: capitalize;">
                        <br>
                    </div>
                    <a class="CloseOption" onclick="hide_language()">Close</a>
                </div>
            </div>
        <!-- </div> -->
        <br>
        
        <div class="input-row">
            <label >Quantity</label>
            <input type="number" name="quantity"  placeholder="Quantity " required min="0">
            <br>
        </div>
        
        <div class="input-row">
            <label >Cote</label>
            <input type="text" name="cote"  placeholder="Cote" value="" required >
            <br>
        </div>

     	<div class="input-row">
            <button type="submit" name="add" >ADD</button>
        </div>
        <div style="margin: 50px;"></div>
        </form>

        <div style="margin: 100px;"></div>

</center>
        <?php
    }
        ?>

<script type="text/javascript">
       $(".chosen").chosen();
       function show_book(){
    document.getElementById('wrapper').classList.add('active');
}

function hide_book(){
    document.getElementById('wrapper').classList.remove('active');
}


function show_publisher(){
    document.getElementById('wrapper_publisher').classList.add('active');
}

function hide_publisher(){
    document.getElementById("publisher2").value = "";
    document.getElementById('wrapper_publisher').classList.remove('active');
}

function show_language(){
    document.getElementById('wrapper_language').classList.add('active');
}

function hide_language(){
    document.getElementById("language2").value = "";
    document.getElementById('wrapper_language').classList.remove('active');
}
//        const wrapper = document.querySelector(".wrapper"),
// selectBtn = wrapper.querySelector(".addOption");

// selectBtn.addEventListener("click", () => {
//     wrapper.classList.toggle("active");
// });

</script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
    <script src="../assets/js/addBookValidation.js"></script>


<?php

include('../includes/scripts.php');
?>
<?php
}else{
  header("Location: ../../home/index.php");
  exit();
}
?> 